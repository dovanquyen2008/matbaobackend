<?php
/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 16/11/2016
 * Time: 0:59
 */
if (!class_exists('ReSetWp')):

    class ReSetWp
    {
        public function __construct()
        {
            remove_action('wp_head', 'wp_resource_hints', 2);
            // REMOVE WP EMOJI
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');

            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('admin_print_styles', 'print_emoji_styles');

            add_action('wp_enqueue_scripts', array( $this, 'remove_default_scripts_plugin' ) );

            add_action('wp_footer', array($this, 'my_deregister_scripts'));

            add_action('wp_print_scripts', array($this, 'theme_slug_dequeue_footer_jquery'));
            add_action('wp_footer', array($this, 'addLibraryJs'));
            add_action('wp_footer', array($this, 'checkMobileJs'));

            add_action( 'pre_get_posts', array( $this, 'foo_modify_query_order' ) );

            add_filter( 'pre_get_posts', array( $this, 'prefix_limit_post_types_in_search' ) );

        }

        public function my_deregister_scripts()
        {
            wp_deregister_script('wp-embed');
        }

        public function theme_slug_dequeue_footer_jquery()
        {
            if (!is_admin()) {
                wp_deregister_script('jquery');
            }
        }

        /**
         * add library Js
         */
        public function addLibraryJs()
        {
            echo '<script type=\'text/javascript\' src=\'' . get_home_url() . '/public/js/jquery.min.js?ver=1.12.4\'></script>';
        }

        /**
         * check by mobile
         */
        public function checkMobileJs()
        {
            if (!wp_is_mobile()):
                echo '<script type=\'text/javascript\' charset=\'utf-8\'>!(function($){';
                echo '$( document ).ready(function(){ $(\'body\').addClass(\'desktop-screen-body\'); });';
                echo '})(jQuery); </script>';
            else:
                echo '<script type=\'text/javascript\' charset=\'utf-8\'>!(function($){';
                echo '$( document ).ready(function(){ $(\'body\').addClass(\'mobile-screen-body\'); });';
                echo '})(jQuery); </script>';
            endif;
        }
        /**
         * remove css pagenavi
         */
        public function remove_default_scripts_plugin(){
            wp_dequeue_style( 'wp-pagenavi' );
        }

        /**
         * order by date
         */
        public function foo_modify_query_order( $query ) {
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC' );
        }
        /**
         * search post
         */
        public function prefix_limit_post_types_in_search( $query ) {
            if ( $query->is_search ) {
                $query->set( 'post_type', array( 'post' ) );
            }
            return $query;
        }
    }

    /**
     *check class is exit
     * call class
     * time: 16/11/2016
     * localtion: ho chi minh city
     */

    function resetwp()
    {
        global $resetwp;

        if (!isset($resetwp)) {
            $resetwp = new ReSetWp();
        }

        return $resetwp;
    }

    resetwp();


endif; // class_exists check

