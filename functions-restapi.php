<?php




// Fixed hardcoded paths
function wo_before_authorize_function_login_redirect( $request ){
	// file_put_contents("logoauth.txt",date("Y-m-d H:i:s")."\n"."wo_before_authorize_method ::: ".serialize($request)."\nPOST:::".serialize($_POST)."\n\n\n\n",FILE_APPEND);
}
add_action('wo_before_authorize_method', 'wo_before_authorize_function_login_redirect');

function wo_before_authorize_function_login_redirect1( $request ){
	// file_put_contents("logoauth.txt",date("Y-m-d H:i:s")."\n"."wo_before_create_client ::: ".serialize($request)."\nPOST:::".serialize($_POST)."\n\n\n\n",FILE_APPEND);
}
add_action('wo_before_create_client', 'wo_before_authorize_function_login_redirect1');


if(
str_contains(serialize($_POST), 'client_id') ||
str_contains(serialize($_REQUEST), 'client_id') ||
str_contains(serialize(getallheaders()), 'Bearer')
    )
{

if(isset($_POST) && count($_POST)>0)
{
    // file_put_contents("logoauth.txt",date("Y-m-d H:i:s")."\n"."wo_POST ::: "."\nPOST:::".serialize($_POST)."\nHeaders ::: ".serialize(getallheaders())."\n\n\n\n",FILE_APPEND);
}

// file_put_contents("logoauth.txt",date("Y-m-d H:i:s")."\n"."wo_REQUEST ::: "."\nREQUEST:::".serialize($_REQUEST)."\nHeaders ::: ".serialize(getallheaders())."\n\n\n\n",FILE_APPEND);

}











add_action('rest_api_init', function () {
    // API #3: Obtain User Information
    // Documentation says: /api/user-center/user/info
    register_rest_route('wp/v2', '/user-center/user/info', [
        'methods'  => ['GET', 'POST'],
        'callback' => 'restapi_getuserinfo_by_token',
        'permission_callback' => '__return_true'
    ]);

    // Legacy/Jatin's route
    register_rest_route('wp/v2', '/getUserInfo', [
        'methods'  => 'POST',
        'callback' => 'restapi_getuserinfo_by_token',
        'permission_callback' => '__return_true'
    ]);
});

/**
 * Bypass global REST authentication blockers for user info routes.
 * The WP OAuth Server plugin blocks unauthenticated REST access by default.
 */
add_filter('rest_authentication_errors', function($result) {
    if (!empty($result)) {
        if (strpos($_SERVER['REQUEST_URI'], '/wp-json/wp/v2/user-center/user/info') !== false || 
            strpos($_SERVER['REQUEST_URI'], '/wp-json/wp/v2/getUserInfo') !== false) {
            return null;
        }
    }
    return $result;
}, 99);

/**
 * Identify the user by their OAuth access_token (Bearer token)
 */
function restapi_getuserinfo_by_token($request) {
    $user = null;

    // 1. Try to identify user via Access Token (OAuth Bearer)
    $auth_header = $request->get_header('Authorization');
    if ($auth_header && strpos($auth_header, 'Bearer ') === 0) {
        $access_token = str_replace('Bearer ', '', $auth_header);
        if (function_exists('wo_public_get_access_token')) {
            $token_data = wo_public_get_access_token($access_token);
            if ($token_data && isset($token_data['user_id'])) {
                $user = get_user_by('ID', $token_data['user_id']);
            }
        }
    }

    // 2. Fallback to params (Legacy/Search mode)
    if (!$user) {
        $params = $request->get_json_params();
        if (empty($params)) {
             $params = $_REQUEST;
        }

        if (!empty($params['email'])) {
            $user = get_user_by('email', sanitize_email($params['email']));
        } else if (!empty($params['parentId'])) {
            $user = get_user_by('ID', (int)$params['parentId']);
        }
    }

    if (!$user) {
        return new WP_REST_Response([
            'success' => 0,
            'message' => 'User not found. Please provide a valid Authorization: Bearer {token} header.'
        ], 200);
    }

    return new WP_REST_Response([
        'success' => 1,
        'data' => [
            'parentId'       => $user->ID,
            'email'    => $user->user_email,
            'userName'    => $user->user_login,
            'firstName'     => $user->first_name,
            'lastName'     => $user->last_name,
        ]
    ], 200);
}













add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/pay', [
        'methods'  => 'GET',
        'callback' => 'restapi_pay',
        'permission_callback' => '__return_true'
    ]);
});

function restapi_pay($request) {
    $params = $request->get_json_params();
    
    /*
    appId:eMathSmart
    type:1/Subscribe / 2/Additional Package
    subscribeId :  Parent Club subscription ID
    */
    if(isset($_GET['appId']) && $_GET['appId']=="eMathSmart")
    {
        $type=1;
        if(isset($_GET['type']) && is_numeric($_GET['type']) && $_GET['type']>0 && $_GET['type']<3)
        {
            $type = $_GET['type'];
        }
        $duration=1;
        if(isset($_GET['duration']) && is_numeric($_GET['duration']) && $_GET['duration']>0 && $_GET['duration']<3)
        {
            $duration = $_GET['duration'];
        }
        if(isset($_GET['subscribeId']) && is_numeric($_GET['subscribeId']) && $_GET['subscribeId']>0)
        {
            
        }
        if($duration==1)
        return new WP_REST_Response([
            'success' => 1,
            'data' => [
                'type'       => 'redirect',
                'uri'     => 'https://dev.popularbook.ca/product/monthly-subscription',
            ]
        ], 200);
        if($duration==2)
        return new WP_REST_Response([
            'success' => 1,
            'data' => [
                'type'       => 'redirect',
                'uri'     => 'https://dev.popularbook.ca/product/yearly-subscription',
            ]
        ], 200);
    }
    else
    {
        return new WP_REST_Response([
            'success' => 0,
            'message' => 'appId is required.'
        ], 200);
    }

}







?>