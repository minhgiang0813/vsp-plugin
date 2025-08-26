<?php
/**
 * Plugin Name: VSP Plugin
 * Plugin URI: https://webdesignvungtau.com
 * Description: VSP Plugin
 * Version: 1.0
 * Author: Webdesign VungTau
 * Author URI: https://webdesignvungtau.com
 */

// * Tạo bảng trong cơ sở dữ liệu khi kích hoạt plugin
register_activation_hook(__FILE__, 'vsp_create_custom_table');
function vsp_create_custom_table()
{
    global $wpdb;
    $table_name      = $wpdb->prefix . 'vsp_antoan';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        hoten varchar(255) NOT NULL,
        danhso varchar(255) NOT NULL,
        phongban varchar(255) NOT NULL,
        xuongnhom varchar(255) NOT NULL,
        khachhang varchar(255) NOT NULL,
        loaiduan varchar(255) NOT NULL,
        khuvuc varchar(255) NOT NULL,
        ngayhuydong date DEFAULT NULL,
        tinhtrangdichvu varchar(255) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

// * Thêm menu vào trang quản trị
function vsp_antoan_admin_page()
{
    require_once plugin_dir_path(__FILE__) . 'controllers/vsp_antoan_controller.php';
    require_once plugin_dir_path(__FILE__) . 'views/vsp_antoan_view.php';
    $controller = new VspAntoanController();
    $controller->handle_request();
    vsp_antoan_view($controller);
}

// * Đăng ký menu trong trang quản trị
add_action('admin_menu', 'vsp_register_antoan_menu');
function vsp_register_antoan_menu()
{
    add_menu_page(
        'An Toàn',              // Tiêu đề trang
        'An Toàn',              // Tên menu
        'edit_posts',            // Quyền truy cập
        'vsp-antoan',            // slug
        'vsp_antoan_admin_page', // Callback hiển thị nội dung
        'dashicons-shield',      // Icon
        26                       // Vị trí
    );
}

// * Đăng ký shortcode để hiển thị form tìm kiếm
add_shortcode('vsp_antoan_search_form', 'vsp_antoan_search_form_shortcode');

function vsp_antoan_search_form_shortcode()
{
    if (is_user_logged_in()) {
        ob_start();
        require_once plugin_dir_path(__FILE__) . 'controllers/vsp_antoan_controller.php';
        require_once plugin_dir_path(__FILE__) . 'views/vsp_antoan_search_form.php';
        $controller = new VspAntoanController();
        vsp_antoan_search_form($controller); // Gọi hàm hiển thị form
        return ob_get_clean();
    } else {
        ob_start();
        require_once plugin_dir_path(__FILE__) . 'controllers/vsp_antoan_controller.php';
        require_once plugin_dir_path(__FILE__) . 'views/vsp_antoan_search_public_form.php';
        $controller = new VspAntoanController();
        vsp_antoan_search_public_form($controller); // Gọi hàm hiển thị form
        return ob_get_clean();

    }

}

// * Enqueue styles for the plugin and localize script for AJAX
function vsp_enqueue_styles()
{
    wp_enqueue_style('vsp-plugin-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');

    // Register the script
    wp_register_script('vsp-plugin-script', plugin_dir_url(__FILE__) . 'assets/js/vsp-plugin-script.js', ['jquery'], '1.0', true);

    // Localize the script with the ajaxurl variable
    wp_localize_script('vsp-plugin-script', 'vsp_ajax_object', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);

    // Enqueued script with localized data.
    wp_enqueue_script('vsp-plugin-script');

}

add_action('wp_enqueue_scripts', 'vsp_enqueue_styles');

// * AJAX callback cho form tìm kiếm
add_action('wp_ajax_vsp_antoan_search', 'vsp_antoan_search_callback');
add_action('wp_ajax_nopriv_vsp_antoan_search', 'vsp_antoan_search_callback'); // Vô hiệu hóa cho người dùng chưa đăng nhập

function vsp_antoan_search_callback()
{
    require_once plugin_dir_path(__FILE__) . 'controllers/vsp_antoan_controller.php';
    $controller = new VspAntoanController();
    if (is_user_logged_in()) {

        $results = $controller->search_items($_POST, false);
    } else {
        $results = $controller->search_items($_POST, true);
    }

    // Bắt đầu output buffering để lấy nội dung từ file view
    ob_start();

    // Tải file view và truyền biến $results
    if (is_user_logged_in()) {
        require_once plugin_dir_path(__FILE__) . 'views/vsp_antoan_search_results.php';
    } else {
        require_once plugin_dir_path(__FILE__) . 'views/vsp_antoan_search_public_results.php';
    }

    // Lấy nội dung từ buffer và làm sạch nó
    $output = ob_get_clean();

    echo $output;

    wp_die(); // Bắt buộc để kết thúc AJAX request
}
