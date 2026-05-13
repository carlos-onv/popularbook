<?php
/**
 * API HARDENING TEST SUITE - REAL FLOW VERSION
 * Use this to verify Feature 2 & 3 (Retries, Logging & WC Notes)
 * URL Trigger: https://dev-popularbook.local/?test_errors=all
 */

add_action('init', 'emathsmart_run_error_tests');
function emathsmart_run_error_tests()
{
    if (isset($_REQUEST['test_errors']) && $_REQUEST['test_errors'] == 'all') {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }

        echo "<h1>eMathSmart API Hardening Test Suite (Real Flow)</h1>";
        echo "<p>This suite triggers the REAL 3-attempt logic and real WooCommerce notes.</p>";

        $order_id = 116377; // Your test order
        
        // --- SCENARIO 1: WRONG SECRET KEY (REAL FLOW) ---
        echo "<h2>Scenario 1: Triggering Real Signature Retry Loop</h2>";
        echo "<em>Expected: 3 attempts, Success: NO, Check WC Order Notes afterwards.</em><br>";
        
        $GLOBALS['emathsmart_debug_override'] = 'wrong_key';
        process_subscription_custom($order_id, 'Payment', true);
        unset($GLOBALS['emathsmart_debug_override']);

        echo "<hr>";

        // --- SCENARIO 2: NETWORK TIMEOUT (REAL FLOW) ---
        echo "<h2>Scenario 2: Triggering Real Network Timeout</h2>";
        echo "<em>Expected: 3 attempts (due to network failure), Check WC Order Notes.</em><br>";
        
        $GLOBALS['emathsmart_debug_override'] = 'dead_url';
        process_subscription_custom($order_id, 'Payment', true);
        unset($GLOBALS['emathsmart_debug_override']);

        // --- VERIFICATION ---
        echo "<h2>Database Verification (Latest Logs)</h2>";
        global $wpdb;
        $table_name = $wpdb->prefix . 'emathsmart_log';
        $logs = $wpdb->get_results("SELECT * FROM $table_name WHERE order_id = $order_id ORDER BY id DESC LIMIT 10");

        if ($logs) {
            echo "<table border='1' cellpadding='5' style='border-collapse: collapse; width: 100%;'>";
            echo "<tr><th>ID</th><th>Type</th><th>Attempt</th><th>Code</th><th>HTTP</th><th>Created At</th><th>Response Body Preview</th></tr>";
            foreach ($logs as $log) {
                echo "<tr>";
                echo "<td>{$log->id}</td>";
                echo "<td>{$log->api_type}</td>";
                echo "<td>{$log->attempt}</td>";
                echo "<td>{$log->response_code}</td>";
                echo "<td>{$log->http_status}</td>";
                echo "<td>{$log->created_at}</td>";
                echo "<td><small>" . esc_html(substr($log->response_body, 0, 50)) . "...</small></td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        echo "<br><a href='?testcms=process&type=Payment'>Run real Payment test (Success path)</a>";
        exit;
    }
}
