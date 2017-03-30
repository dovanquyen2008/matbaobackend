<?php
/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 16/11/2016
 * Time: 0:53
 */
?>
<?php if (has_nav_menu('primary')) : ?>
    <nav id="site-navigation" class="navbar" role="navigation">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class' => 'nav clearfix',
            'menu_id' => 'main-menu-page',
        ));
        ?>
    </nav><!-- .main-navigation -->
<?php endif; ?>

