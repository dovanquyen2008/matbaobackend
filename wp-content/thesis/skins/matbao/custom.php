<?php
/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 16/11/2016
 * Time: 1:15
 */
if (!class_exists('CustomThemeThesis')) :

    class CustomThemeThesis
    {
        public function __construct()
        {
            /**
             * reset js and css wordpress theme
             */
            require('include/resetwp.php');
            /**
             * khoi tao cac lenh cores
             */
            require('include/CustomFunction.php');
            /**
             * dang ky thuoc tinh wp
             */
            require('include/RegisterWp.php');
            /**
             * setting for template
             */
            $this->styleTheme();
            /**
             * get template
             */
            add_action( 'wp_head',  array( $this, 'getTemplateCss' ), 2 );
            if (wp_is_mobile())
            {
                add_action( 'hook_top_headerHook',  array( $this, 'getTemplateHeaderMobile' ) );
                add_action( 'hook_top_footerHook',  array( $this, 'getTemplateFooterMobile' ) );
                add_action( 'hook_top_indexHook',  array( $this, 'getTemplateIndexMobile' ) );
                add_action( 'hook_top_categoryHook',  array( $this, 'getTemplateCategoryMobile' ) );
                add_action( 'hook_top_singleHook',  array( $this, 'getTemplateSingleMobile' ) );
                add_action( 'hook_top_pageHook',  array( $this, 'getTemplatePageMobile' ) );
                add_action( 'hook_top_checkoutHook',  array( $this, 'getTemplateCheckoutMobile' ) );
            }
            else{
                add_action( 'hook_top_headerHook',  array( $this, 'getTemplateHeader' ) );
                add_action( 'hook_top_footerHook',  array( $this, 'getTemplateFooter' ) );
                add_action( 'hook_top_indexHook',  array( $this, 'getTemplateIndex' ) );
                add_action( 'hook_top_categoryHook',  array( $this, 'getTemplateCategory' ) );
                add_action( 'hook_top_singleHook',  array( $this, 'getTemplateSingle' ) );
                add_action( 'hook_top_pageHook',  array( $this, 'getTemplatePage' ) );
                add_action( 'hook_top_checkoutHook',  array( $this, 'getTemplateCheckout' ) );
                add_action( 'hook_top_domainHook',  array( $this, 'getTemplateDomain' ) );
                add_action( 'hook_top_mbContentHook',  array( $this, 'getTemplateMbContent' ) );
            }

            add_action( 'hook_top_newsHook',  array( $this, 'getTemplateNews' ) );
            add_action( 'hook_top_singleNewsHook',  array( $this, 'getTemplateSingleNews' ) );
        }

        /**
         * add style js and css for theme
         * root public
         */
        public function styleTheme()
        {
            if (!is_admin()):
            /*** add css website ***/

            /** add js footer website */
            add_action( 'wp_footer', array( $this, 'registerJs' ) );
            endif;
        }

        /**
         *  register js
         */
        public function registerJs()
        {
            //wp_enqueue_script( 'bootstrap', '/public/js/bootstrap.min.js', array(), '1.1' );
            //wp_enqueue_script( 'jquery', '/public/js/quyen.js',array(),'',FALSE );
        }

        /**
         * get display css into hook
         */
        public function getTemplateCss()
        {
            require('template/style.php');
        }

        /**
         * get template header into hook
         */
        public function getTemplateHeader()
        {
            require('template/header.php');
        }
        /**
         * get template header mobile into hook
         */
        public function getTemplateHeaderMobile()
        {
            require('template/mobile/header.php');
        }

        /**
         * get template index into hook
         */
        public function getTemplateIndex()
        {
            require('template/index.php');
        }
        /**
         * get template index mobile into hook
         */
        public function getTemplateIndexMobile()
        {
            require('template/mobile/index.php');
        }

        /**
         * get template footer into hook
         */
        public function getTemplateFooter()
        {
            require('template/footer.php');
        }

        /**
         * get template footer mobile into hook
         */
        public function getTemplateFooterMobile()
        {
            require('template/mobile/footer.php');
        }

        /**
         * get template category into hook
         */
        public function getTemplateCategory()
        {
            require('template/category.php');
        }
        /**
         * get template category mobile into hook
         */
        public function getTemplateCategoryMobile()
        {
            require('template/mobile/category.php');
        }

        /**
         * get template Page into hook
         */
        public function getTemplatePage()
        {
            require('template/page.php');
        }
        /**
         * get template Page mobile into hook
         */
        public function getTemplatePageMobile()
        {
            require('template/mobile/page.php');
        }

        /**
         * get template Single product into hook
         */
        public function getTemplateSingle()
        {
            require('template/single.php');
        }
        /**
         * get template Single product mobile into hook
         */
        public function getTemplateSingleMobile()
        {
            require('template/mobile/single.php');
        }

        /**
         * get template checkout into hook
         */
        public function getTemplateCheckout()
        {
            require('template/checkout.php');
        }
        /**
         * get template checkout mobile into hook
         */
        public function getTemplateCheckoutMobile()
        {
            require('template/mobile/checkout.php');
        }

        /**
         * get template news into hook
         */
        public function getTemplateNews()
        {
            require('template/news.php');
        }
        /**
         * get template single news into hook
         */
        public function getTemplateSingleNews()
        {
            require('template/singlenews.php');
        }
        
        public function getTemplateDomain()
        {
            require('template/domain.php');
        }
        public function getTemplateMbContent(){
              require('template/mbcontent.php');
        }
    }

    /**
     *check class is exit
     * call class
     * time: 16/11/2016
     * localtion: ho chi minh city
     */

    function customthemthesis()
    {
        global $customthemthesis;

        if (!isset($customthemthesis)) {
            $customthemthesis = new CustomThemeThesis();
        }

        return $resetwp;
    }

    customthemthesis();


endif;