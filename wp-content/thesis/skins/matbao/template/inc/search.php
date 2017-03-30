<?php
/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 16/12/2016
 * Time: 22:50
 */
?>

<form class="_search_intel" action="<?php echo home_url('/'); ?>tim-kiem/" method="post">
    <div class="form_group">
        <input class="input_value" type="text" value="" name="code_product" placeholder="Mã sản phẩm">
    </div>
    <hr/>
    <div class="form_group">
        <select class="input_value" type="text" name="category">
            <option value="0">Chọn Chuyên mục</option>
            <option value="4"><?php echo get_cat_name(4); ?></option>
            <option value="10"><?php echo get_cat_name(10); ?></option>
            <option value="662"><?php echo get_cat_name(662); ?></option>
            <option value="281"><?php echo get_cat_name(281); ?></option>
            <option value="13"><?php echo get_cat_name(13); ?></option>
            <option value="11"><?php echo get_cat_name(11); ?></option>
            <option value="5"><?php echo get_cat_name(5); ?></option>
            <option value="7"><?php echo get_cat_name(7); ?></option>
            <option value="6"><?php echo get_cat_name(6); ?></option>
            <option value="9"><?php echo get_cat_name(9); ?></option>
            <option value="27"><?php echo get_cat_name(27); ?></option>
        </select>
    </div>
    <div class="form_group">
        <select class="input_value" type="text" name="trademark">
            <option value="0">Chọn thương hiệu</option>
            <option value="175"><?php echo get_cat_name(175); ?></option>
            <option value="157"><?php echo get_cat_name(157); ?></option>
            <option value="159"><?php echo get_cat_name(159); ?></option>
            <option value="123"><?php echo get_cat_name(123); ?></option>
            <option value="127"><?php echo get_cat_name(127); ?></option>
            <option value="201"><?php echo get_cat_name(201); ?></option>
            <option value="141"><?php echo get_cat_name(141); ?></option>
            <option value="203"><?php echo get_cat_name(203); ?></option>
            <option value="181"><?php echo get_cat_name(181); ?></option>
            <option value="151"><?php echo get_cat_name(151); ?></option>
            <option value="155"><?php echo get_cat_name(155); ?></option>
            <option value="173"><?php echo get_cat_name(173); ?></option>
            <option value="153"><?php echo get_cat_name(153); ?></option>
            <option value="1">Thương hiệu khác</option>
        </select>
    </div>
    <div class="form_group">
        <select class="input_value" type="text" name="price">
            <option value="0">Chọn mức giá</option>
            <option value="200000">Dưới 200.000</option>
            <option value="500000">200.000 - 500.000</option>
            <option value="1000000">500.000 - 1.000.000</option>
            <option value="2000000">1.000.000 - 2.000.000</option>
            <option value="3000000">2.000.000 - 3.000.000</option>
            <option value="5000000">3.000.000 - 5.000.000</option>
            <option value="20000000">Trên 5.000.000</option>
        </select>
    </div>
    <div class="form_group">
        <button type="submit" class="button_submit">Tìm kiếm</button>
    </div>
</form>
