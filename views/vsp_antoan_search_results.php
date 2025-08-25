<?php
    /**
     * View for displaying search results.
     *
     * @package VSP-Plugin
     */

    if (! defined('ABSPATH')) {
        exit; // Exit if accessed directly.
    }

?>
<h2>Kết quả tìm kiếm:</h2>
<?php if (count($results) > 0): ?>
	<table class="wp-list-table striped">
		<thead>
			<tr>
				<th>Số thứ tự</th>
				<th>Họ tên</th>
				<th>Danh số</th>
				<th>Phòng ban</th>
				<th>Xưởng/Nhóm</th>
				<th>Khách hàng</th>
				<th>Loại dự án</th>
				<th>Khu vực</th>
				<th>Ngày huy động</th>
				<th>Tình trạng dịch vụ</th>
			</tr>
		</thead>
		<tbody>
			<?php $stt = 1; ?>
<?php foreach ($results as $result): ?>
				<tr>
					<td><?php echo $stt++; ?></td>
					<td><?php echo esc_html($result['hoten']); ?></td>
					<td><?php echo esc_html($result['danhso']); ?></td>
					<td><?php echo esc_html($result['phongban']); ?></td>
					<td><?php echo esc_html($result['xuongnhom']); ?></td>
					<td><?php echo esc_html($result['khachhang']); ?></td>
					<td><?php echo esc_html($result['loaiduan']); ?></td>
					<td><?php echo esc_html($result['khuvuc']); ?></td>
					<td><?php echo esc_html($result['ngayhuydong']); ?></td>
					<td><?php echo esc_html($result['tinhtrangdichvu']); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p>Không tìm thấy kết quả nào.</p>
<?php endif; ?>