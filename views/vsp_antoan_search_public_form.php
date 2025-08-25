<?php

    function vsp_antoan_search_public_form($controller)
    {
        $loaiduan_options        = $controller->get_model()->get_unique_loaiduan();
        $khachhang_options       = $controller->get_model()->get_unique_khachhang();
        $khuvuc_options          = $controller->get_model()->get_unique_khuvuc();
        $tinhtrangdichvu_options = $controller->get_model()->get_unique_tinhtrangdichvu();
    ?>
    <form method="GET" class="vsp-search-form">
        <div class="search-form-row">
            <p>
                <label for="khachhang">Khách hàng:</label>
                <select id="khachhang" name="khachhang">
                    <option value="">Tất cả</option>
                    <?php foreach ($khachhang_options as $option): ?>
                        <option value="<?php echo esc_attr($option); ?>"<?php selected(isset($_GET['khachhang']) ? $_GET['khachhang'] : '', $option); ?>><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="loaiduan">Loại dự án:</label>
                <select id="loaiduan" name="loaiduan">
                    <option value="">Tất cả</option>
                    <?php foreach ($loaiduan_options as $option): ?>
                        <option value="<?php echo esc_attr($option); ?>"<?php selected(isset($_GET['loaiduan']) ? $_GET['loaiduan'] : '', $option); ?>><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        </div>
        <div class="search-form-row">
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