<?php
    /**
     * View for displaying search public results.
     *
     * @package VSP-Plugin
     */

    if (! defined('ABSPATH')) {
        exit; // Exit if accessed directly.
    }

    // Xử lý mảng results để nhóm các thành phần duy nhất và đếm số lần xuất hiện.
    $processed_results = [];
    if (is_array($results) && count($results) > 0) {
        foreach ($results as $result) {
            // Tạo một key duy nhất cho mỗi hàng để nhóm chúng lại.
            // Sử dụng json_encode là một cách đáng tin cậy để làm điều này cho các mảng kết hợp.
            $key = json_encode($result);

            if (! isset($processed_results[$key])) {
                // Nếu đây là lần đầu tiên chúng ta thấy hàng duy nhất này, hãy khởi tạo nó.
                $processed_results[$key]          = $result;
                $processed_results[$key]['count'] = 1; // Thêm bộ đếm
            } else {
                // Nếu chúng ta đã thấy hàng này trước đây, chỉ cần tăng bộ đếm.
                $processed_results[$key]['count']++;
            }
        }
        // Chuyển đổi mảng kết hợp trở lại thành một mảng được lập chỉ mục đơn giản.
        $processed_results = array_values($processed_results);
    }

?>
<h2>Kết quả tìm kiếm:</h2>
<?php if (count($processed_results) > 0): ?>
	<table class="wp-list-table striped">
		<thead>
			<tr>
				<th>Số thứ tự</th>
				<th>Khách hàng</th>
				<th>Loại dự án</th>
				<th>Khu vực</th>
				<th>Tình trạng dịch vụ</th>
				<th>Số người thực hiện</th>
			</tr>
		</thead>
		<tbody>
			<?php $stt = 1; ?>
<?php foreach ($processed_results as $result): ?>
				<tr>
					<td><?php echo $stt++; ?></td>
					<td><?php echo esc_html($result['khachhang']); ?></td>
					<td><?php echo esc_html($result['loaiduan']); ?></td>
					<td><?php echo esc_html($result['khuvuc']); ?></td>
					<td><?php echo esc_html($result['tinhtrangdichvu']); ?></td>
					<td><?php echo intval($result['count']); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p>Không tìm thấy kết quả nào.</p>
<?php endif; ?>