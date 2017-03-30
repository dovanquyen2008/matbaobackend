<?php

/**

 * Created by PhpStorm.

 * User: vancuong

 * Date: 16/11/2016

 * Time: 0:51

 * Template header.

 */

?>

<span class="icon_menu_mobile">Menu</span>

<div class="containers mobile">

    <div class="row clearfix">

        <div class="logo">

            <?php if (is_home()) : ?>

                <h1><a href="<?php echo home_url('/') ?>" title=""><img src="/public/logo.png"

                                                                        alt="Bán cựa gà"></a></h1>

            <?php else: ?>

                <h2><a href="<?php echo home_url('/') ?>" title=""><img src="/public/logo.png"

                                                                        alt="Bán cựa gà"></a></h2>

            <?php endif; ?>

        </div>

        <div class="clearfix __right_header">

            <div class="info__header clearfix">



                    <p class="hotline">

                        <strong>HOTLINE:</strong>

                        <a href="tel:+84937546639">0937 546 639</a>

                        <strong>( Mr. Khoa )</strong>

                    </p>

                    <p class="diachi">

                        <strong>ĐC : 252 Đường Cao Đạt, Phường 2 Quận 5 TP.HCM</strong>

                    </p>


            </div>

        </div>

    </div>

</div>

<div class="__menu_01 _menu_mobile">

    <span class="menu_close_mobile">close</span>

    <div class="containers mobile">

        <div class="row clearfix">

            <div class="mai__menu">

                <?php if (has_nav_menu('primary_mobile')) : ?>

                    <nav id="site-navigation" class="navbar" role="navigation">

                        <?php

                        wp_nav_menu(array(

                            'theme_location' => 'primary_mobile',

                            'menu_class' => 'nav clearfix',

                            'menu_id' => 'main-menu-page',

                        ));

                        ?>

                    </nav><!-- .main-navigation -->

                <?php endif; ?>



            </div>

        </div>

    </div>

</div>

