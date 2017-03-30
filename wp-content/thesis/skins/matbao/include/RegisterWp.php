<?php

/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 17/11/2016
 * Time: 3:11
 */

if (!class_exists('RegisterWp')):
    class RegisterWp
    {
        public function __construct()
        {
            /**
             * dang ky methot wp
             */
            $this->hookMenu();
            add_action( 'widgets_init', array($this, 'customWidgetsInit') );
        }
        /**
         * create new hook menu
         * Primary Menu and Social Links Menu
         */
        public function hookMenu()
        {
            // This theme uses wp_nav_menu() in two locations.
            register_nav_menus( array(
                'primary' => __( 'Primary Menu', 'customtheme' ),
                'primary_mobile' => __( 'Primary Menu Mobile', 'customtheme' ),
                'top_site'  => __( 'Top menu', 'customtheme' ),
            ) );
        }
        /**
         * create widgets
         */
        public function customWidgetsInit()
        {
            register_sidebar( array(
                'name'          => __( 'Info', 'customtheme' ),
                'id'            => 'info-1',
                'description'   => __( 'Add widgets here to appear in your footer.', 'customtheme' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => __( 'About', 'customtheme' ),
                'id'            => 'about-1',
                'description'   => __( 'Add widgets here to appear in your footer.', 'customtheme' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => __( 'Mua Hàng', 'customtheme' ),
                'id'            => 'mua-hang',
                'description'   => __( 'Add widgets here to appear in your footer.', 'customtheme' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => __( 'Chứng nhận', 'customtheme' ),
                'id'            => 'chung-nhan',
                'description'   => __( 'Add widgets here to appear in your footer.', 'customtheme' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => __( 'List Category', 'customtheme' ),
                'id'            => 'list-cat',
                'description'   => __( 'Add widgets here to appear in your footer.', 'customtheme' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => __( 'Menu Sidebar', 'customtheme' ),
                'id'            => 'menu-sidebar',
                'description'   => __( 'Add widgets here to appear in your footer.', 'customtheme' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => __( 'Cart', 'customtheme' ),
                'id'            => 'cart_head',
                'description'   => __( 'Add widgets cart.', 'customtheme' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );
        }

    }

    /**
     *check class is exit
     * call class
     * time: 16/11/2016
     * localtion: ho chi minh city
     */

    function registerwp()
    {
        global $registerwp;

        if (!isset($registerwp)) {
            $registerwp = new RegisterWp();
        }

        return $registerwp;
    }

    registerwp();
endif;