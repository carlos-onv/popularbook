<?php
/**
 * eMathSmart Admin Interface - Error Logs
 */

if (!defined('ABSPATH')) exit;

/**
 * Register the submenu under WooCommerce
 */
add_action('admin_menu', 'emathsmart_add_logs_page', 99);
function emathsmart_add_logs_page() {
    add_submenu_page(
        'woocommerce',
        'eMathSmart API Logs',
        'eMathSmart Logs',
        'manage_woocommerce',
        'emathsmart-logs',
        'emathsmart_render_logs_page'
    );
}

function emathsmart_render_logs_page() {
    if (!current_user_can('manage_woocommerce')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'emathsmart_log';

    // Pagination Logic
    $per_page = 20;
    $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $offset = ($current_page - 1) * $per_page;

    // Filters
    $where = "1=1";
    $params = [];

    if (!empty($_GET['order_id'])) {
        $where .= " AND order_id = %d";
        $params[] = intval($_GET['order_id']);
    }

    if (!empty($_GET['api_type'])) {
        $where .= " AND api_type = %s";
        $params[] = sanitize_text_field($_GET['api_type']);
    }

    if (!empty($_GET['date_from'])) {
        $where .= " AND created_at >= %s";
        $params[] = sanitize_text_field($_GET['date_from']) . ' 00:00:00';
    }

    if (!empty($_GET['date_to'])) {
        $where .= " AND created_at <= %s";
        $params[] = sanitize_text_field($_GET['date_to']) . ' 23:59:59';
    }

    $total_items = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE $where", $params));
    $num_pages = ceil($total_items / $per_page);

    $sql = "SELECT * FROM $table_name WHERE $where ORDER BY id DESC LIMIT %d OFFSET %d";
    $query_params = array_merge($params, [$per_page, $offset]);
    $logs = $wpdb->get_results($wpdb->prepare($sql, $query_params));
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">eMathSmart API Logs</h1>
        <hr class="wp-header-end">

        <div class="notice notice-info is-dismissible">
            <p>This page displays communication logs for eMathSmart APIs. Only failures and manual resends are logged here for debugging.</p>
        </div>

        <!-- Filters Form -->
        <form method="get" style="margin-bottom: 20px; background: #fff; padding: 15px; border: 1px solid #ccd0d4; border-radius: 4px;">
            <input type="hidden" name="page" value="emathsmart-logs">
            
            <div style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
                <div>
                    <label for="order_id">Order ID</label><br>
                    <input type="number" name="order_id" id="order_id" value="<?php echo isset($_GET['order_id']) ? esc_attr($_GET['order_id']) : ''; ?>" placeholder="e.g. 116377">
                </div>
                
                <div>
                    <label for="api_type">API Type</label><br>
                    <select name="api_type" id="api_type">
                        <option value="">All Types</option>
                        <option value="Payment" <?php selected(isset($_GET['api_type']) && $_GET['api_type'] == 'Payment'); ?>>Payment</option>
                        <option value="refund" <?php selected(isset($_GET['api_type']) && $_GET['api_type'] == 'refund'); ?>>Refund</option>
                        <option value="public_exams" <?php selected(isset($_GET['api_type']) && $_GET['api_type'] == 'public_exams'); ?>>Public Exams</option>
                    </select>
                </div>
                
                <div>
                    <label for="date_from">From Date</label><br>
                    <input type="date" name="date_from" id="date_from" value="<?php echo isset($_GET['date_from']) ? esc_attr($_GET['date_from']) : ''; ?>">
                </div>
                
                <div>
                    <label for="date_to">To Date</label><br>
                    <input type="date" name="date_to" id="date_to" value="<?php echo isset($_GET['date_to']) ? esc_attr($_GET['date_to']) : ''; ?>">
                </div>
                
                <div>
                    <button type="submit" class="button button-primary">Filter Logs</button>
                    <a href="admin.php?page=emathsmart-logs" class="button">Clear</a>
                </div>
            </div>
        </form>

        <div class="tablenav top">
            <div class="tablenav-pages">
                <span class="displaying-num"><?php printf(_n('%s item', '%s items', $total_items), number_format_i18n($total_items)); ?></span>
                <?php
                echo paginate_links(array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'prev_text' => __('&laquo;'),
                    'next_text' => __('&raquo;'),
                    'total' => $num_pages,
                    'current' => $current_page
                ));
                ?>
            </div>
            <br class="clear">
        </div>

        <table class="wp-list-table widefat fixed striped posts">
            <thead>
                <tr>
                    <th scope="col" style="width: 60px;">ID</th>
                    <th scope="col" style="width: 100px;">Order</th>
                    <th scope="col" style="width: 120px;">API Type</th>
                    <th scope="col" style="width: 80px;">Attempt</th>
                    <th scope="col" style="width: 120px;">Code</th>
                    <th scope="col" style="width: 100px;">HTTP</th>
                    <th scope="col">Date (Local)</th>
                    <th scope="col" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody id="the-list">
                <?php if ($logs): ?>
                    <?php foreach ($logs as $log): 
                        $status_class = '';
                        $badge_class = 'badge-success';
                        $status_text = 'Success';

                        if ($log->http_status >= 500 || $log->http_status == 0) {
                            $status_class = 'log-error-critical';
                            $badge_class = 'badge-error';
                            $status_text = 'Critical Error';
                        } elseif ($log->response_code != 200 && !in_array($log->response_code, [40101, 40201, 40202])) {
                            $status_class = 'log-error-warning';
                            $badge_class = 'badge-warning';
                            $status_text = 'API Error';
                        } elseif (in_array($log->response_code, [40101, 40201, 40202])) {
                            $badge_class = 'badge-info';
                            $status_text = 'Info';
                        }

                        // Try to pretty print JSON
                        $pretty_payload = $log->request_payload;
                        $json_payload = json_decode($log->request_payload);
                        if ($json_payload) $pretty_payload = json_encode($json_payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

                        $pretty_response = $log->response_body;
                        $json_response = json_decode($log->response_body);
                        if ($json_response) $pretty_response = json_encode($json_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    ?>
                        <tr class="<?php echo $status_class; ?>">
                            <td><?php echo $log->id; ?></td>
                            <td>
                                <a href="<?php echo get_edit_post_link($log->order_id); ?>" target="_blank" style="font-weight:600;">
                                    #<?php echo $log->order_id; ?>
                                </a>
                            </td>
                            <td><code style="background:#eee; padding:2px 4px; border-radius:3px;"><?php echo esc_html($log->api_type); ?></code></td>
                            <td><?php echo $log->attempt; ?></td>
                            <td>
                                <span class="log-badge <?php echo $badge_class; ?>">
                                    <?php echo $log->response_code ?: 'N/A'; ?>
                                </span>
                            </td>
                            <td><?php echo $log->http_status; ?></td>
                            <td><?php echo date('M j, Y H:i:s', strtotime($log->created_at)); ?></td>
                            <td>
                                <button type="button" class="button button-small" onclick="toggleLogDetails(<?php echo $log->id; ?>)">Details</button>
                            </td>
                        </tr>
                        <tr id="log-details-<?php echo $log->id; ?>" style="display:none;" class="log-details-row">
                            <td colspan="8">
                                <div class="log-details-content">
                                    <div class="log-details-grid">
                                        <div class="log-details-col">
                                            <strong>Request Payload:</strong>
                                            <pre><?php echo esc_html($pretty_payload); ?></pre>
                                        </div>
                                        <div class="log-details-col">
                                            <strong>Response Body:</strong>
                                            <pre><?php echo esc_html($pretty_response); ?></pre>
                                        </div>
                                    </div>
                                    
                                    <?php if ($log->curl_error): ?>
                                        <div style="margin-top:15px;">
                                            <strong style="color:#d63638;">cURL Error:</strong>
                                            <pre style="border-left: 4px solid #d63638; background: #fffcfc;"><?php echo esc_html($log->curl_error); ?></pre>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8">No logs found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="tablenav bottom">
            <div class="tablenav-pages">
                <?php
                echo paginate_links(array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'prev_text' => __('&laquo;'),
                    'next_text' => __('&raquo;'),
                    'total' => $num_pages,
                    'current' => $current_page
                ));
                ?>
            </div>
            <br class="clear">
        </div>
    </div>

    <script>
    function toggleLogDetails(id) {
        var el = document.getElementById('log-details-' + id);
        if (el.style.display === 'none') {
            el.style.display = 'table-row';
        } else {
            el.style.display = 'none';
        }
    }
    </script>

    <style>
        .log-error-critical { background-color: #fff8f8 !important; }
        .log-error-warning { background-color: #fffcf5 !important; }
        .log-details-row td { padding: 0 !important; border-top: none !important; }
        .log-details-content { padding: 20px; background: #fdfdfd; border: 1px solid #e5e5e5; border-top: none; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); }
        .log-details-grid { display: flex; gap: 20px; }
        .log-details-col { flex: 1; min-width: 0; }
        .log-details-content pre { 
            white-space: pre-wrap; 
            word-break: break-all; 
            background: #fff; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 3px;
            font-size: 11px;
            line-height: 1.4;
            max-height: 400px;
            overflow-y: auto;
        }
        .log-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            line-height: 1.2;
        }
        .badge-success { background: #e7f4e9; color: #1e7e34; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-error { background: #f8d7da; color: #721c24; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .tablenav-pages { float: right; }
        .displaying-num { margin-right: 10px; }
    </style>
    <?php
}


