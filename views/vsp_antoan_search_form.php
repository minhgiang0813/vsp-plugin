<?php

    function vsp_antoan_search_form($controller)
    {
        $loaiduan_options        = $controller->get_model()->get_unique_loaiduan();
        $phongban_options        = $controller->get_model()->get_unique_phongban();
        $xuongnhom_options       = $controller->get_model()->get_unique_xuongnhom();
        $khachhang_options       = $controller->get_model()->get_unique_khachhang();
        $khuvuc_options          = $controller->get_model()->get_unique_khuvuc();
        $tinhtrangdichvu_options = $controller->get_model()->get_unique_tinhtrangdichvu();
    ?>
    <form method="GET" class="vsp-search-form">
        <div class="search-form-row">
            <p>
                <label for="hoten">Họ tên:</label>
                <input type="text" id="hoten" name="hoten" value="<?php echo isset($_GET['hoten']) ? esc_attr($_GET['hoten']) : ''; ?>">
            </p>
            <p>
                <label for="danhso">Danh số:</label>
                <input type="text" id="danhso" name="danhso" value="<?php echo isset($_GET['danhso']) ? esc_attr($_GET['danhso']) : ''; ?>">
            </p>
        </div>

        <div class="search-form-row">
            <p>
                <label for="phongban">Phòng ban:</label>
                <select id="phongban" name="phongban">
                    <option value="">Tất cả</option>
                    <?php foreach ($phongban_options as $option): ?>
                        <option value="<?php echo esc_attr($option); ?>"<?php selected(isset($_GET['phongban']) ? $_GET['phongban'] : '', $option); ?>><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="xuongnhom">Xưởng/Nhóm:</label>
                <select id="xuongnhom" name="xuongnhom">
                    <option value="">Tất cả</option>
                    <?php foreach ($xuongnhom_options as $option): ?>
                        <option value="<?php echo esc_attr($option); ?>"<?php selected(isset($_GET['xuongnhom']) ? $_GET['xuongnhom'] : '', $option); ?>><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="khachhang">Khách hàng:</label>
                <select id="khachhang" name="khachhang">
                    <option value="">Tất cả</option>
                    <?php foreach ($khachhang_options as $option): ?>
                        <option value="<?php echo esc_attr($option); ?>"<?php selected(isset($_GET['khachhang']) ? $_GET['khachhang'] : '', $option); ?>><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        </div>
        <div class="search-form-row">
            <p>
                <label for="loaiduan">Loại dự án:</label>
                <select id="loaiduan" name="loaiduan">
                    <option value="">Tất cả</option>
                    <?php foreach ($loaiduan_options as $option): ?>
                        <option value="<?php echo esc_attr($option); ?>"<?php selected(isset($_GET['loaiduan']) ? $_GET['loaiduan'] : '', $option); ?>><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="khuvuc">Khu vực:</label>
                <select id="khuvuc" name="khuvuc">
                    <option value="">Tất cả</option>
                    <?php foreach ($khuvuc_options as $option): ?>
                        <option value="<?php echo esc_attr($option); ?>"<?php selected(isset($_GET['khuvuc']) ? $_GET['khuvuc'] : '', $option); ?>><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
             <p>
                <label for="tinhtrangdichvu">Tình trạng dịch vụ:</label>
                <select id="tinhtrangdichvu" name="tinhtrangdichvu">
                    <option value="">Tất cả</option>
                    <?php foreach ($tinhtrangdichvu_options as $option): ?>
                        <option value="<?php echo esc_attr($option); ?>"<?php selected(isset($_GET['tinhtrangdichvu']) ? $_GET['tinhtrangdichvu'] : '', $option); ?>><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        </div>

        <p><input type="submit" value="Tìm kiếm"></p>
    </form>
    <div id="result"></div>
    <?php
    }