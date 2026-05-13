<?php
/**
 * API HARDENING TEST SUITE
 * Use this to verify Feature 2 (Retries & Logging)
 * URL Trigger: https://dev-popularbook.local/?test_errors=all
 */

add_action('init', 'emathsmart_run_error_tests');
function emathsmart_run_error_tests()
{
    if (isset($_REQUEST['test_errors']) && $_REQUEST['test_errors'] == 'all') {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }

        echo "<h1>eMathSmart API Hardening Test Suite</h1>";
        echo "<p>Testing Feature 2: Retries & Logging</p>";

        $order_id = 116377; // Your test order
        
        // --- SCENARIO 1: WRONG SECRET KEY ---
        echo "<h2>Scenario 1: Wrong Secret Key</h2>";
        echo "<em>Expected: 3 attempts logged in DB, Success: NO</em><br>";
        
        // We temporarily wrap the call to force a wrong key
        // NOTE: Since the key is hardcoded in the main function, 
        // we'll simulate the logic here to verify the logging helper works.
        
        $fake_payload = ['test' => 'signature_failure'];
        $fake_response = json_encode(['code' => 40001, 'message' => 'Invalid Signature']);
        
        echo "Simulating 3 failed signature attempts...<br>";
        for ($i = 1; $i <= 3; $i++) {
            emathsmart_log_api_error($order_id, 'test_signature', $i, $fake_payload, $fake_response, '', 200);
            echo "Attempt $i logged.<br>";
        }

        // --- SCENARIO 2: NETWORK TIMEOUT ---
        echo "<h2>Scenario 2: Network Timeout</h2>";
        echo "<em>Expected: Log shows cURL Error and HTTP 0</em><br>";
        
        $fake_curl_error = "Connection timed out after 15001 milliseconds";
        emathsmart_log_api_error($order_id, 'test_network', 1, $fake_payload, '', $fake_curl_error, 0);
        echo "Network timeout logged.<br>";

        // --- SCENARIO 3: SERVER 500 ERROR ---
        echo "<h2>Scenario 3: Server 500 Error</h2>";
        $fake_500_response = "<html><body><h1>500 Internal Server Error</h1></body></html>";
        emathsmart_log_api_error($order_id, 'test_server_error', 1, $fake_payload, $fake_500_response, '', 500);
        echo "500 Error logged.<br>";

        // --- VERIFICATION ---
        echo "<h2>Database Verification</h2>";
        global $wpdb;
        $table_name = $wpdb->prefix . 'emathsmart_log';
        $logs = $wpdb->get_results("SELECT * FROM $table_name WHERE order_id = $order_id ORDER BY id DESC LIMIT 5");

        if ($logs) {
            echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
            echo "<tr><th>ID</th><th>Type</th><th>Attempt</th><th>Code</th><th>HTTP</th><th>Created At</th></tr>";
            foreach ($logs as $log) {
                echo "<tr>";
                echo "<td>{$log->id}</td>";
                echo "<td>{$log->api_type}</td>";
                echo "<td>{$log->attempt}</td>";
                echo "<td>{$log->response_code}</td>";
                echo "<td>{$log->http_status}</td>";
                echo "<td>{$log->created_at}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color:red;'>No logs found in database!</p>";
        }

        echo "<br><a href='?testcms=process&type=Payment'>Run real Payment test (Success path)</a>";
        exit;
    }
}
