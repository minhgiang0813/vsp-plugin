<?php
require_once plugin_dir_path(__FILE__) . '../models/vsp_antoan.php';

class VspAntoanController
{
    private $model;

    public function __construct()
    {
        $this->model = new VspAntoan();
    }

    public function handle_request()
    {
        // Thêm mới
        if (isset($_POST['action']) && $_POST['action'] == 'add') {
            $data = $this->sanitize($_POST);
            $this->model->insert($data);
            echo '<div class="updated"><p>Đã thêm mới!</p></div>';
        }

        // Sửa
        if (isset($_POST['action']) && $_POST['action'] == 'edit' && isset($_POST['id'])) {
            $data = $this->sanitize($_POST);
            $this->model->update(intval($_POST['id']), $data);
            echo '<div class="updated"><p>Đã cập nhật!</p></div>';
        }

        // Xoá
        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
            $this->model->delete(intval($_GET['id']));
            echo '<div class="updated"><p>Đã xoá!</p></div>';
        }

        // Import CSV
        if (isset($_POST['action']) && $_POST['action'] == 'import_csv' && isset($_FILES['csv_file'])) {
            $file = $_FILES['csv_file']['tmp_name'];
            if (($handle = fopen($file, "r")) !== false) {
                // Đọc dòng tiêu đề và chuyển về UTF-8 nếu cần
                $header = fgetcsv($handle);
                foreach ($header as &$h) {
                    $h = mb_convert_encoding($h, 'UTF-8', 'auto');
                }
                unset($h);

                while (($row = fgetcsv($handle)) !== false) {
                    foreach ($row as &$cell) {
                        $cell = mb_convert_encoding($cell, 'UTF-8', 'auto');
                    }
                    unset($cell);

                    $data = array_combine($header, $row);
                    // Đảm bảo đúng tên cột và sanitize
                    $insert_data = [
                        'hoten'           => sanitize_text_field($data['hoten'] ?? ''),
                        'danhso'          => sanitize_text_field($data['danhso'] ?? ''),
                        'phongban'        => sanitize_text_field($data['phongban'] ?? ''),
                        'xuongnhom'       => sanitize_text_field($data['xuongnhom'] ?? ''),
                        'khachhang'       => sanitize_text_field($data['khachhang'] ?? ''),
                        'loaiduan'        => sanitize_text_field($data['loaiduan'] ?? ''),
                        'khuvuc'          => sanitize_text_field($data['khuvuc'] ?? ''),
                        'ngayhuydong'     => $this->parse_date($data['ngayhuydong'] ?? ''),
                        'tinhtrangdichvu' => sanitize_text_field($data['tinhtrangdichvu'] ?? ''),
                    ];
                    $this->model->insert($insert_data);
                }
                fclose($handle);
                echo '<div class="updated"><p>Import thành công!</p></div>';
            } else {
                echo '<div class="error"><p>Không thể đọc file CSV.</p></div>';
            }
        }
    }

    public function get_items()
    {
        return $this->model->get_all();
    }

    public function get_item($id)
    {
        return $this->model->get_by_id($id);
    }

    public function get_model()
    {
        return $this->model;
    }

    private function parse_date($date_str)
    {
        $date = DateTime::createFromFormat('d/m/Y', $date_str);
        return $date ? $date->format('Y-m-d') : null;
    }

    private function sanitize($input)
    {
        return [
            'hoten'           => sanitize_text_field($input['hoten']),
            'danhso'          => sanitize_text_field($input['danhso']),
            'phongban'        => sanitize_text_field($input['phongban']),
            'xuongnhom'       => sanitize_text_field($input['xuongnhom']),
            'khachhang'       => sanitize_text_field($input['khachhang']),
            'loaiduan'        => sanitize_text_field($input['loaiduan']),
            'khuvuc'          => sanitize_text_field($input['khuvuc']),
            'ngayhuydong'     => $this->parse_date($input['ngayhuydong']),
            'tinhtrangdichvu' => sanitize_text_field($input['tinhtrangdichvu']),
        ];
    }

    public function search_items($search_params)
    {

        global $wpdb;
        $table = $this->model->get_table();

        $where = 'WHERE 1=1'; // Điều kiện mặc định

        if (! empty($search_params['hoten'])) {
            $where .= $wpdb->prepare(" AND hoten LIKE %s", '%' . $wpdb->esc_like($search_params['hoten']) . '%');
        }

        if (! empty($search_params['danhso'])) {
            $where .= $wpdb->prepare(" AND danhso LIKE %s", '%' . $wpdb->esc_like($search_params['danhso']) . '%');
        }

        if (! empty($search_params['phongban'])) {
            $where .= $wpdb->prepare(" AND phongban = %s", $search_params['phongban']);
        }

        if (! empty($search_params['xuongnhom'])) {
            $where .= $wpdb->prepare(" AND xuongnhom = %s", $search_params['xuongnhom']);
        }

        if (! empty($search_params['khachhang'])) {
            $where .= $wpdb->prepare(" AND khachhang = %s", $search_params['khachhang']);
        }

        if (! empty($search_params['khuvuc'])) {
            $where .= $wpdb->prepare(" AND khuvuc = %s", $search_params['khuvuc']);
        }

        if (! empty($search_params['tinhtrangdichvu'])) {
            $where .= $wpdb->prepare(" AND tinhtrangdichvu = %s", $search_params['tinhtrangdichvu']);
        }

        $query = "SELECT * FROM $table $where";

        $results = $wpdb->get_results($query, ARRAY_A);
        return $results;
    }
}
