<?php

add_action('rest_api_init', function () {
    // API #7: Order Payment Compensation
    register_rest_route('emathsmart/v1', '/orderPaymentCompensate', [
        'methods'  => 'POST',
        'callback' => 'restapi_order_payment_compensate',
        'permission_callback' => '__return_true'
    ]);

    // API #8: Order Refund Notice Compensation
    register_rest_route('emathsmart/v1', '/orderRefundCompensate', [
        'methods'  => 'POST',
        'callback' => 'restapi_order_refund_compensate',
        'permission_callback' => '__return_true'
    ]);
});

/**
 * Bypass global REST authentication blockers for eMathSmart routes.
 * The WP OAuth Server plugin blocks unauthenticated REST access by default.
 */
add_filter('rest_authentication_errors', function($result) {
    if (!empty($result)) {
        // If the request is for our eMathSmart endpoints, bypass the error
        if (strpos($_SERVER['REQUEST_URI'], '/wp-json/emathsmart/v1/') !== false) {
            return null;
        }
    }
    return $result;
}, 99);

/**
 * Handle API #7: Order Payment Compensation
 */
function restapi_order_payment_compensate($request) {
    return handle_emathsmart_compensation($request, 'Payment');
}

/**
 * Handle API #8: Order Refund Notice Compensation
 */
function restapi_order_refund_compensate($request) {
    return handle_emathsmart_compensation($request, 'refund');
}

/**
 * Core logic for handling incoming compensation queries
 */
function handle_emathsmart_compensation($request, $type) {
    $params = $request->get_json_params();
    
    // 1. Signature Verification
    $debug_mode = false; 
    if (!$debug_mode) {
        if (!verify_emathsmart_incoming_signature($params)) {
             return new WP_REST_Response([
                'code' => 40001,
                'message' => 'Invalid Signature',
                'traceId' => bin2hex(random_bytes(6))
            ], 200);
        }
    }

    // 2. Extract Query Parameters
    $startTime = isset($params['startTime']) ? (int)$params['startTime'] : 0;
    $endTime = isset($params['endTime']) ? (int)$params['endTime'] : time();
    $pageNo = isset($params['pageNo']) ? (int)$params['pageNo'] : 1;
    $pageSize = isset($params['pageSize']) ? (int)$params['pageSize'] : 20;

    if ($startTime == 0 || $startTime > $endTime) {
        return new WP_REST_Response([
            'code' => 40401,
            'message' => 'Time Window Invalid',
            'traceId' => bin2hex(random_bytes(6))
        ], 200);
    }

    // 3. Query WooCommerce Orders
    $args = [
        'limit' => $pageSize,
        'paged' => $pageNo,
        'return' => 'objects',
        'paginate' => true,
    ];

    if ($type == 'Payment') {
        $args['status'] = ['completed', 'processing'];
        $args['date_completed'] = $startTime . '...' . $endTime;
    } else {
        $args['status'] = ['refunded'];
        $args['date_modified'] = $startTime . '...' . $endTime;
    }

    $results = wc_get_orders($args);
    $orders = $results->orders;
    
    $list = [];
    foreach ($orders as $order) {
        // Only include if it's a subscription order
        if (function_exists('wcs_get_subscriptions_for_order')) {
            $subs = wcs_get_subscriptions_for_order($order->get_id(), array('order_type' => 'any'));
            if (empty($subs)) continue;
        }
        
        $list[] = map_order_to_emathsmart_payload_compensation($order, $type);
    }

    // 4. Return Response
    return new WP_REST_Response([
        'code' => 200,
        'message' => 'success',
        'traceId' => bin2hex(random_bytes(6)),
        'data' => [
            'pageNo' => $pageNo,
            'pageSize' => $pageSize,
            'totalCount' => (int)$results->total,
            'totalPages' => (int)$results->max_num_pages,
            'list' => $list
        ]
    ], 200);
}

/**
 * Verifies incoming HMAC-SHA256 signature
 */
function verify_emathsmart_incoming_signature($params) {
    if (!isset($params['signature'])) return false;
    
    $incoming_sig = $params['signature'];
    $secret = "yZ.qmUuVYz,h_=Wzj:4!naWAoxW.vjLm";
    
    unset($params['signature']);
    ksort($params, SORT_STRING);
    
    $pairs = [];
    foreach ($params as $k => $v) {
        if (!is_null($v) && $v !== '') {
            $pairs[] = $k . '=' . (string)$v;
        }
    }
    $plaintext = implode('&', $pairs);
    
    $hash = hash_hmac('sha256', $plaintext, $secret, true);
    $calculated_sig = rtrim(strtr(base64_encode($hash), '+/', '-_'), '=');
    
    return hash_equals($calculated_sig, $incoming_sig);
}

/**
 * Maps a WC_Order object to the eMathSmart payload schema
 */
function map_order_to_emathsmart_payload_compensation($order, $type) {
    $payload = [
        'appId' => 'ParentClub',
        'orderId' => (string)$order->get_id(),
        'parentClubParentId' => 'PID' . $order->get_user_id(),
    ];

    if ($type == 'Payment') {
        $payload['payStatus'] = ($order->get_status() == 'completed') ? 1 : 2;
        $payload['payAmount'] = number_format((float)$order->get_total(), 2, '.', '');
        $date_completed = $order->get_date_completed();
        $payload['payTimestamp'] = $date_completed ? $date_completed->getTimestamp() : $order->get_date_created()->getTimestamp();
        
        $payload['type'] = 1; // Default to Subscribe
        $payload['subscribeId'] = 'SID' . $order->get_user_id();

        // Check for subscriptions to determine type/period
        if (function_exists('wcs_get_subscriptions_for_order')) {
            $subscriptions = wcs_get_subscriptions_for_order($order->get_id(), array('order_type' => 'any'));
            foreach ($subscriptions as $sub) {
                $billing_period = $sub->get_billing_period();
                $trial_end = $sub->get_date('trial_end');

                if (!empty($trial_end)) {
                    $payload['subscriptionType'] = 1;
                    $payload['trialType'] = 1;
                } else if ($billing_period == "month") {
                    $payload['subscriptionType'] = 2;
                } else if ($billing_period == "year") {
                    $payload['subscriptionType'] = 3;
                }
            }
        }
    } else {
        $date_modified = $order->get_date_modified();
        $payload['refundTimestamp'] = $date_modified ? $date_modified->getTimestamp() : time();
    }

    return $payload;
}
