<?php
    function vsp_antoan_view($controller)
    {
        // Hiển thị form sửa nếu có id
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            $item = $controller->get_item(intval($_GET['id']));
        ?>
        <h2>Sửa thông tin</h2>
        <form method="post">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo esc_attr($item['id']); ?>">
            <p>Họ tên: <input type="text" name="hoten" value="<?php echo esc_attr($item['hoten']); ?>"></p>
            <p>Danh số: <input type="text" name="danhso" value="<?php echo esc_attr($item['danhso']); ?>"></p>
            <p>Phòng ban: <input type="text" name="phongban" value="<?php echo esc_attr($item['phongban']); ?>"></p>
            <p>Xưởng/nhóm: <input type="text" name="xuongnhom" value="<?php echo esc_attr($item['xuongnhom']); ?>"></p>
            <p>Khách hàng: <input type="text" name="khachhang" value="<?php echo esc_attr($item['khachhang']); ?>"></p>
            <p>Loại dự án: <input type="text" name="loaiduan" value="<?php echo esc_attr($item['loaiduan']); ?>"></p>
            <p>Khu vực: <input type="text" name="khuvuc" value="<?php echo esc_attr($item['khuvuc']); ?>"></p>
            <p>Ngày huy động: <input type="text" name="ngayhuydong" value="<?php echo isset($item['ngayhuydong']) ? esc_attr(date('d/m/Y', strtotime($item['ngayhuydong']))) : ''; ?>" placeholder="dd/mm/yyyy"></p>
            <p>Tình trạng dịch vụ: <input type="text" name="tinhtrangdichvu" value="<?php echo esc_attr($item['tinhtrangdichvu']); ?>"></p>
            <p><input type="submit" value="Cập nhật" class="button button-primary"></p>
        </form>
        <hr>
        <?php
            } else {
                    // Form import CSV
                ?>
        <h2>Import từ file CSV</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="import_csv">
            <p><input type="file" name="csv_file" accept=".csv" required></p>
            <p><input type="submit" value="Import" class="button button-primary"></p>
        </form>
        <hr>
        <?php
            }

                // Hiển thị danh sách
                $items = $controller->get_items();
            ?>
    <h2>Danh sách</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Danh số</th>
                <th>Phòng ban</th>
                <th>Xưởng/nhóm</th>
                <th>Khách hàng</th>
                <th>Loại dự án</th>
                <th>Khu vực</th>
                <th>Ngày huy động</th>
                <th>Tình trạng dịch vụ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo esc_html($item['id']); ?></td>
                <td><?php echo esc_html($item['hoten']); ?></td>
                <td><?php echo esc_html($item['danhso']); ?></td>
                <td><?php echo esc_html($item['phongban']); ?></td>
                <td><?php echo esc_html($item['xuongnhom']); ?></td>
                <td><?php echo esc_html($item['khachhang']); ?></td>
                <td><?php echo esc_html($item['loaiduan']); ?></td>
                <td><?php echo esc_html($item['khuvuc']); ?></td>
                <td><?php echo esc_html($item['ngayhuydong']); ?></td>
                <td><?php echo esc_html($item['tinhtrangdichvu']); ?></td>
                <td>
                    <a href="?page=vsp-antoan&action=edit&id=<?php echo esc_attr($item['id']); ?>">Sửa</a> |
                    <a href="?page=vsp-antoan&action=delete&id=<?php echo esc_attr($item['id']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xoá?');">Xoá</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    }