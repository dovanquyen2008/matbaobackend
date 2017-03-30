<?php
/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 17/11/2016
 * Time: 23:36
 */
global $cores;
global $shoppingcart;
global $resetwp;
$resetwp->addLibraryJs();
?>
<div class="__single_page pdtb20">
    <div class="containers mobile">
        <div class="row clearfix">
            <div class="form_checkout">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="post __post_04 __post_page clearfix pd12">
                        <header class="__post_header_ pdtb5">
                            <h1><?php the_title(); ?></h1>
                        </header>
                        <div class="__post_content_">
                            <div class="detail_cart col-12">
                                <h2 class="chi_tiet_title">Chi tiết sản phẩm</h2>
                                <?php $shoppingcart->displayInCheckout(); ?>
                            </div>
                            <div class="col-12">
                                <?php the_content(); ?>
                                <?php echo '<div id="row_list_product">' . $shoppingcart->rowInCheckout() . '</div>'; ?>
                                <script type="text/javascript">
                                    var value = $('#row_list_product').html();
                                    $('#field_7_8').html(value);
                                    $('#field_7_9').html('');
                                </script>
                                <style type="text/css">
                                    #field_7_8, .validation_error{ display: none; }
                                </style>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
