<?php

class VspAntoan
{
    private $table;

    public function __construct()
    {
        global $wpdb;
        $this->table = $wpdb->prefix . 'vsp_antoan';
    }

    public function get_table()
    {
        return $this->table;
    }

    // Lấy tất cả dữ liệu
    public function get_all()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM {$this->table}", ARRAY_A);
    }

    // Lấy dữ liệu theo ID
    public function get_by_id($id)
    {
        global $wpdb;
        return $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$this->table} WHERE id = %d", $id),
            ARRAY_A
        );
    }

    // Thêm mới bản ghi
    public function insert($data)
    {
        global $wpdb;
        $wpdb->insert($this->table, $data);
        return $wpdb->insert_id;
    }

    // Cập nhật bản ghi
    public function update($id, $data)
    {
        global $wpdb;
        return $wpdb->update($this->table, $data, ['id' => $id]);
    }

    // Xóa bản ghi
    public function delete($id)
    {
        global $wpdb;
        return $wpdb->delete($this->table, ['id' => $id]);
    }

    // Lấy danh sách phòng ban duy nhất
    public function get_unique_phongban()
    {
        global $wpdb;
        $query   = "SELECT DISTINCT phongban FROM {$this->table}";
        $results = $wpdb->get_col($query);
        return $results;
    }

    // Lấy danh sách xưởng nhóm duy nhất
    public function get_unique_xuongnhom()
    {
        global $wpdb;
        $query   = "SELECT DISTINCT xuongnhom FROM {$this->table}";
        $results = $wpdb->get_col($query);
        return $results;
    }

    // Lấy danh sách khách hàng duy nhất
    public function get_unique_khachhang()
    {
        global $wpdb;
        $query   = "SELECT DISTINCT khachhang FROM {$this->table}";
        $results = $wpdb->get_col($query);
        return $results;
    }

    // Lấy danh sách loại dự án duy nhất
    public function get_unique_loaiduan()
    {
        global $wpdb;
        $query   = "SELECT DISTINCT loaiduan FROM {$this->table}";
        $results = $wpdb->get_col($query);
        return $results;
    }

    // Lấy danh sách khu vực duy nhất
    public function get_unique_khuvuc()
    {
        global $wpdb;
        $query   = "SELECT DISTINCT khuvuc FROM {$this->table}";
        $results = $wpdb->get_col($query);
        return $results;
    }

    // Lấy danh sách tình trạng dịch vụ duy nhất
    public function get_unique_tinhtrangdichvu()
    {
        global $wpdb;
        $query   = "SELECT DISTINCT tinhtrangdichvu FROM {$this->table}";
        $results = $wpdb->get_col($query);
        return $results;
    }
}
