<?php



/**********************-------- code V2  -----------***********************************/
/**
 * @package ShopTaV2
 * @category Core
 * @author HoangNE0
 */

if ( ! class_exists( 'Shoptav002' ) ) :

class Shoptav002
{
	public $cat_news = array(15);
	function Shoptav002()
	{
		 $this->init_hooks();
		 add_action( 'wp_enqueue_scripts', array( $this, 'add_style_header_web' ) );
		 add_action( 'wp_footer', array( $this, 'add_jquery_footer_web' ) );
		 $this->add_action_hook();
         add_action( 'wp_head', array( $this, 'show_style_thesis' ) );
	}

	/**
     * Hook into actions and filters
     * @since  1.0
     */
    public function init_hooks() {
    	//error_reporting(0);
        /*--------------------------CLEAN WordPress DEFAULT ------------------------*/
        //Remove emoji css from head tag -------------------------------------------
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        //Remove Recent Comments Style --------------------------------------------
        add_action( 'widgets_init', array( $this, 'remove_recent_comments_style' ) );
        //Remove API----------------------------------------------------------------
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
        // Disable oEmbed Discovery Links
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
        // Disable REST API link in HTTP headers
        remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
        //Remove scripts -------------------------------------------------------
        add_action('wp_enqueue_scripts', array( $this, 'remove_default_scripts' ) );
        //Remove scripts plugin------------------------------------------
        add_action('wp_enqueue_scripts', array( $this, 'remove_default_scripts_plugin' ) );
        //add_action( 'wp_enqueue_scripts', array( $this, 'modify_jquery' ), 0 );
        //Maps ajax
        add_action( 'wp_ajax_load_into_alertify', array( $this, 'load_into_alertify_callback' ) );
        add_action( 'wp_ajax_nopriv_load_into_alertify', array( $this, 'load_into_alertify_callback' ) );
  
    }
    /**
     * Modify jQuery
     */
    public function modify_jquery() {

        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', get_site_url() . '/wp-content/thesis/skins/classic-r/js/jquery.min.js', array(), '1.12.1', true );

    }
    /**
     * Remove Recent Commonts style
     */
    public function remove_recent_comments_style() {
        global $wp_widget_factory;
        remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
    }
    public function remove_default_scripts(){
        wp_deregister_script( 'wp-embed' );
        wp_deregister_script('comment-reply');
    }
    public function remove_default_scripts_plugin(){
        wp_dequeue_style( 'wp-pagenavi' );
    }
    //end reset css and js default wdpress;

    public function add_action_hook(){
		add_action( 'hook_bottom_archive_intro', array( $this, 'dimox_breadcrumbs' ) );
        add_shortcode('show-content-slider', array( $this, 'show_post_slider' ) );
        // price product -----------------------------------------------------
		add_action( 'hook_top_price-produc',  array( $this, 'get_price_product' ) );
		// post images -----------------------------------------------------
		add_action( 'hook_top_post-images',  array( $this, 'get_post_images' ) );
		// add button gio hang
		add_action( 'hook_after_price-produc', array( $this,'get_button_gio_hang' ) );
		// view link single prroduct
		add_action( 'hook_after_price-produc', array( $this,'view_singgle_product' ) );
		// phan trang
		add_action( 'hook_after_phan-trang', array( $this,'showWPPageNaVi' ) );
		// get list images post -----------------------------------------------------
		add_action( 'hook_top_images-single',  array( $this, 'ds_anh_single' ) );
		// get custom field -----------------------------------------------------
		add_action( 'hook_top_single-right',  array( $this, 'get_custom_field' ) );
        //check product
        add_action( 'thesis_html_container_isproduct_show',  array( $this, 'isProduct' ) );
        // Rename Posts to News in Menu
        add_action( 'admin_menu', array( $this,'wptutsplus_change_post_menu_label' ) );
        // Edit submenus
        add_action( 'admin_menu', array( $this,'wptutsplus_change_post_object_label' ) );
        // add form search
        add_action('hook_top_searchcustom', array( $this, 'add_fomtimkiem' ) );
        //show product search
        add_action('hook_top_showsearchcustom', array( $this, 'xuly_timkiem' ) );
        //is cart
        add_action( 'thesis_html_container_isincart_show',  array( $this, 'check_in_cart' ) );
	}
	public function add_style_header_web(){
		/*** add css website ***/
		wp_enqueue_style( 'load-bootstrap_css', '/style/css/bootstrap.min.css', '', '1.0' );
		/*-- main stylesheet -->*/
 

        wp_enqueue_style( 'social_css_1', '/style/social/ml-social-buttons.css', '', '1.0' );
        wp_enqueue_style( 'social_css_2', '/style/social/font/font.css', '', '1.0' );
        wp_enqueue_style( 'bxslider-css', '/style/css/jquery.bxslider.css', '', '1.0' );
        wp_enqueue_style( 'font-icon-css', '/style/css/font-awesome.min.css', '', '1.0' );
	}
	public function add_jquery_footer_web(){
		wp_enqueue_script( 'bootstrap-js', '/style/js/bootstrap.min.js', array( 'jquery' ), '1.1' );
        wp_enqueue_script( 'menu-js', '/style/js/scroll-menu.js', array( 'jquery' ), '1.1' );
        wp_enqueue_script( 'bxslider-js', '/style/js/jquery.bxslider.js', array( 'jquery' ), '1.1' );
	}
    public function show_style_thesis(){
    	global $post;
        $home_link    = home_url('/');
        echo "<link rel='stylesheet' href='".$home_link."wp-content/thesis/skins/classic-r/css.css?ver=1.3' type='text/css' media='all' />";
    }
    /*** get custom values *****/
	public function get_custom_field_value($szKey, $bPrint=false)
	{
		global $post;
		$szValue=get_post_meta($post->ID, $szKey, true);
		if ($bPrint==false) return $szValue; else echo $szValue;
	}
    /**
     * Check User Agent is Product
     * @return bool
     */
    public function isProduct(){
        global $post;
        $terms = get_terms(  array('taxonomy' =>'category') );
        $category_id = array();
        foreach ($terms as $value) {
            $category_id[] = $value->term_id;
        }
        
        return in_category($category_id);
    }
    // Rename Posts to News in Menu
    public function wptutsplus_change_post_menu_label() {
        global $menu;
        global $submenu;
        $menu[5][0] = 'Sản phẩm';
        $submenu['edit.php'][5][0] = 'Sản phẩm mới';
        $submenu['edit.php'][10][0] = 'Thêm sản phẩm';
    }
    // Edit submenus
    public function wptutsplus_change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'News';
        $labels->singular_name = 'Sản phẩm mới';
        $labels->add_new = 'Thêm sản phẩm';
        $labels->add_new_item = 'Thêm sản phẩm';
        $labels->edit_item = 'Sửa sản phẩm';
        $labels->new_item = 'Sản phẩm mới';
        $labels->view_item = 'Xem sản phẩm';
        $labels->search_items = 'Tìm sản phẩm';
        $labels->not_found = 'Không có sản phẩm tìm thấy';
    }

	/**
     * Breadcrumbs bar
     */
    public function dimox_breadcrumbs() {
        /* === OPTIONS === */
        $text['home']     = 'Trang chủ'; // text for the 'Home' link
        $text['category'] = '%s'; // text for a category page
        $text['search']   = '%s'; // text for a search results page
        $text['tag']      = '%s'; // text for a tag page
        $text['author']   = '%s'; // text for an author page
        $text['404']      = 'Error 404'; // text for the 404 page

        $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
        $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
        $show_title     = 1; // 1 - show the title for the links, 0 - don't show
        $delimiter      = '  <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> '; // delimiter between crumbs
        $before         = '<span class="current">'; // tag before the current crumb
        $after          = '</span>'; // tag after the current crumb
        /* === END OF OPTIONS === */

        global $post;
        $home_link    = home_url('/');
        $link_before  = '<span typeof="v:Breadcrumb">';
        $link_after   = '</span>';
        $link_attr    = ' rel="v:url" property="v:title"';
        $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
        $parent_id    = $parent_id_2 = $post->post_parent;
        $frontpage_id = get_option('page_on_front');

        if (is_home() || is_front_page()) {

            if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

        } else {

            echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
            if ($show_home_link == 1) {
                echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
                if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
            }

            if ( is_tag() || is_category() ) {
                $this_cat = get_category(get_query_var('cat'), false);
                if ($this_cat->parent != 0) {
                    $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                    if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                    if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                    echo $cats;
                }
                if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

            } elseif ( is_search() ) {
                echo $before . sprintf($text['search'], get_search_query()) . $after;

            } elseif ( is_day() ) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
                echo $before . get_the_time('d') . $after;

            } elseif ( is_month() ) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo $before . get_the_time('F') . $after;

            } elseif ( is_year() ) {
                echo $before . get_the_time('Y') . $after;

            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                    if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, $delimiter);
                    if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                    if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                    echo $cats;
                    if ($show_current == 1) echo $before . get_the_title() . $after;
                }

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;

            } elseif ( is_attachment() ) {
                $parent = get_post($parent_id);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                if ($cat) {
                    $cats = get_category_parents($cat, TRUE, $delimiter);
                    $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                    if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                    echo $cats;
                }
                printf($link, get_permalink($parent), $parent->post_title);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif ( is_page() && !$parent_id ) {
                if ($show_current == 1) echo $before . get_the_title() . $after;

            } elseif ( is_page() && $parent_id ) {
                if ($parent_id != $frontpage_id) {
                    $breadcrumbs = array();
                    while ($parent_id) {
                        $page = get_page($parent_id);
                        if ($parent_id != $frontpage_id) {
                            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                        }
                        $parent_id = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    for ($i = 0; $i < count($breadcrumbs); $i++) {
                        echo $breadcrumbs[$i];
                        if ($i != count($breadcrumbs)-1) echo $delimiter;
                    }
                }
                if ($show_current == 1) {
                    if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                    echo $before . get_the_title() . $after;
                }

            } elseif ( is_tag() ) {
                echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . sprintf($text['author'], $userdata->display_name) . $after;

            } elseif ( is_404() ) {
                echo $before . $text['404'] . $after;
            }

            if ( get_query_var('paged') ) {
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                echo __('Page') . ' ' . get_query_var('paged');
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
            }

            echo '</div><!-- .breadcrumbs -->';

        }
    } // end dimox_breadcrumbs()
	/* Phan trang **/ 
	public function showWPPageNaVi(){
        if( function_exists('wp_pagenavi') ) {
			echo "<div class='clearfix'></div>";
            wp_pagenavi();
        }
    }
    public function show_post_slider($atts) {
        global $post;
        $post = get_post($atts['id']);
        return '<div class="slider-content">
        ' . apply_filters('the_content', $post->post_content) . '
        </div>';
    }
    public function get_post_images($id = ''){
		global $post;
		$home_link    = '';
		$anhsd = $this->get_custom_field_value('_thesis_post_image',false);
		$url = $anhsd['image']['url'];
        if($id == ''){
            echo "<div class='thumb' style='background-image:url(".$home_link.$url.")'><a href='".get_the_permalink()."' title='".get_the_title()."'></a></div>";
        }else{
            echo "<div class='thumb' style='background-image:url(".$home_link.$url.")'><a href='".get_the_permalink($id)."' title='".get_the_title($id)."'></a></div>";
        }
	}
	public function view_singgle_product($id = ''){
		global $post;
        if($id == ''){
            echo "<a class='view-single' href='".get_the_permalink()."' title='".get_the_title()."'>Xem chi tiết</a>";
        }else{
            echo "<a class='view-single' href='".get_the_permalink($id)."' title='".get_the_title($id)."'>Xem chi tiết</a>";
        }
	}
	public function get_price_product(){
		global $post;
		$khuyenmai = $this->get_custom_field_value('khuyen_mai',false);
		$giaban = $this->get_custom_field_value('gia_ban',false);
		echo "<span class='price_product'>";
		if($khuyenmai != 0)
		{
			//echo "<em>".number_format($giaban , 0, ",", ".")."đ</em>";
			echo number_format( ($giaban-$khuyenmai) , 0, ",", ".");
			echo " đ";
		}elseif( $giaban != 0 )
		{
			echo number_format( $giaban, 0, ",", ".");
			echo " đ";
		}
		else{
			echo 'Liên hệ.';
		}
		echo "</span>";
	}
	/******* list images *********/
	//hinh anh post
	public function ds_anh_single()
	{
		if( !in_category($this->cat_product) ){
			global $post;
			$home_link    = "";
			$post_image_data = get_post_meta($post->ID, '_thesis_post_image', true);
			$linkanh = $post_image_data['image']['url'];
			if( strpos($linkanh,'x') == false ){ $linkanhs = $linkanh; }else{ $linkanhs =  substr($linkanh,0,-12).substr($linkanh,-4); }
			$linkanhd = $home_link.$linkanhs;
			//thu vien post
			$gallerys = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image') );
			$gallery = array();
			//print_r( $gallerys );
			foreach ( $gallerys as $attachment_id => $attachment ) {
				array_push($gallery, $attachment->guid);
			}
			// show single
			if( !wp_is_mobile() )
			{
				echo "<ul class='list-images-post' >";
				$i = 0;
				foreach ($gallery as $value){
					echo "<li class='thum-img' rel='".$value."'><img src='".substr($value,0,-4)."-150x150".substr($value,-4)."' alt='Click view'></li>";
					$i++;
					if( $i >4 ) break;
				}
				echo "</ul>";
				echo "<div class='image_thum image_list' style='background-image:url(".$linkanhd .")'></div>";
			}else{
				echo "<ul class='list-images-post' >";
				$i = 0;
				foreach ($gallery as $value){
					echo "<li class='thum-img' rel='".$value."'><img src='".substr($value,0,-4)."-150x150".substr($value,-4)."' alt='Click view'></li>";
					$i++;
					if( $i >4 ) break;
				}
				echo "</ul>";
				echo "<div class='image_thum image_list' style='background-image:url(".$linkanh .")'></div>";
			}
			echo "<div class='clearfix'></div>";
			echo "<div class='info-post-product'><h3>Thông tin chi tiết sản phẩm</h3></div>";
		}
	}
	/******* get custom field  ********/
	public function get_custom_field(){
		global $post;
		echo '<div class="line"><span class=\'blue\'>Mã sản phẩm: </span><span class=\'best_baohanh_space1\'></span>';
		$this->get_custom_field_value('ma_sanpham',true);
		echo '</div><div class="line thuonghieu-vc"><span class=\'blue\'>Hãng: </span>';
		$linkth = mb_strtolower(str_replace(' ','-',trim($this->get_custom_field_value('nha_san_xuat',false))), 'UTF-8');
		echo "<a rel='nofollow' href='http://shopta.vn/".$linkth."/' title='".$this->get_custom_field_value('nha_san_xuat',false)."'>";
		$this->get_custom_field_value('nha_san_xuat',true);
        echo '</a></div>';

        echo '<div class="line"><span class=\'blue\'>Trạng thái: </span><span class=\'best_baohanh_space3\'></span>';
		if( !$this->check_in_cart() ) echo 'Còn hàng'; else echo 'Hết hàng';
		echo '</div><div class="line">';
		$this->get_price_product();
		echo "</div>";
		echo "<div class='click-here'><img src='http://balothenorthface.net/images/click_here.gif' alt='click vào đây'></div>";
		$this->get_button_gio_hang(true);
		echo '<div id="support_single" class="line"><a href="tel:+84987350678 ">0987 350 678</a></div>';
	}
	public function check_in_cart(){
		global $post;
		$hang = $this->get_custom_field_value('trang_thai',false);
		$check = true;
		if( $hang != "Hết hàng" ){
			$check = false;
		}
		return $check;
	}
	// check post -> product have promotion
	public function check_is_promotion(){
		global $post;
		$promotion = $this->get_custom_field_value('khuyen_mai',false);
		$check = false;
		if( $promotion != 0 && $promotion != '0' && $promotion != '' && is_numeric( $promotion ) ){
			$check = true;
		}
		return $check;
	}
	/******* Get bottun gio hang *******/
	public function get_button_gio_hang($single = false){
		global $post;
		global $SESDHVC;
		if ( isset($SESDHVC) ) {
			if( $single ){
				$SESDHVC->add_buttom_cart();
			}else{
				$SESDHVC->add_buttom_cart_list();
			}

		}
	}
    //tim kiếm nâng cao.
    public function add_fomtimkiem(){
        global $wpdb;
        $query="SELECT distinct * FROM $wpdb->terms t JOIN $wpdb->term_taxonomy ta ON t.term_id  = ta.term_id WHERE ta.taxonomy = 'category' AND t.term_id in (3,4,5,6,281,8,9,10,11,12,27) ORDER BY t.name ";
        $theloai = $wpdb->get_results($query);
        $query="SELECT distinct meta_value FROM $wpdb->postmeta WHERE meta_key='nha_san_xuat' ORDER BY meta_value";
        $nhasx = $wpdb->get_results($query);
        ?>
            <div id="timkiemct">
                <div class="formtim">
                    <form name="timkiemnc" action="<?php bloginfo('url'); ?>/tim-kiem/" method="POST" id="form_timkiem_nangcao">
                        <p class="title">Tìm SẢN PHẨM</p>
                        <div class="input_tim">
                            <input name="tensp" id="tensp" class="texttk" type="text" placeholder="Tên sản phẩm"/>
                            <input name="masp" id="masp" class="texttk" type="text" placeholder="Mã sản phẩm"/>
                            <select name="theloai" id="theloai" class="selecttk">
                                <option value="0">Chon thể loại</option>
                                <?php
                                    foreach($theloai as $theloais)
                                    {
                                        if( $theloais->term_id != 1 ){
                                            echo  "<option value='$theloais->term_id'>$theloais->name</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <select name="nhasx" id="nhasx" class="selecttk">
                                <option value="0">Chọn nhà sản xuất</option>
                                <?php
                                    foreach($nhasx as $nhasxs)
                                    {
                                        if( $nhasxs->meta_value != "" )
                                        echo "<option value='$nhasxs->meta_value'>$nhasxs->meta_value</option>";
                                    }
                                ?>
                            </select>
                            <label id="lbgia">Chọn giá : </label>
                            <span> Từ </span>
                            <input name="gia1" id="gia1" class="texttk textgia" type="text" value="0" /> -
                            <input name="gia2" id="gia2" class="texttk textgia" type="text" /><br/>
                            <span> Sản phẩm khuyến mãi </span><input type="checkbox" name="khuyenmai" value="khuyenmai" />
                        </div>
                            <input name="submidtk" id="submidtk" type="submit" value="Tìm Kiếm" />
                            <?php if( is_home() ){  echo " <a id='close_search' href='#' title='đóng'>Đóng</a>"; }  ?>
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery("#clicknangcao").click( function(){
                        jQuery("#searchcustom").css('display','block');
                        
                    });
                    jQuery("#close_search").click( function(){
                        jQuery("#searchcustom").css('display','none');
                        
                    });
                });
            </script>
        <?php
    }
    //ket qua tim kiem
    public function xuly_timkiem(){
        global $wpdb;
        global $post;
        if( isset($_POST['submidtk']) )
        {
            $setdk = "";
            
            if( isset($_POST['theloai']) && $_POST['theloai'] != 0 )
                $setdk .= " AND $wpdb->terms.term_id = '".$_POST['theloai']."' ";
                
            if( isset($_POST['gia1']) && $_POST['gia1'] != "" && isset($_POST['gia2']) && $_POST['gia2'] != "" && $_POST['gia1'] < $_POST['gia2'] )
                $setdk .= " AND $wpdb->postmeta.meta_key = 'gia_ban' AND $wpdb->postmeta.meta_value BETWEEN ".$_POST['gia1']." AND ".$_POST['gia2']." ";
            
            if( isset($_POST['tensp']) && $_POST['tensp'] != "" )
                $setdk = " AND $wpdb->posts.post_title = '".$_POST['tensp']."' ";
                
            if( isset($_POST['masp']) && $_POST['masp'] != "" )
                $setdk = " AND $wpdb->postmeta.meta_key = 'ma_sanpham' AND REPLACE($wpdb->postmeta.meta_value,' ','') = REPLACE('".$_POST['masp']."',' ','') "; 
            $querystr = "SELECT distinct ID FROM $wpdb->posts
                        LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
                        LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
                        LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
                        LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
                        WHERE $wpdb->term_taxonomy.taxonomy = 'category'
                        AND $wpdb->posts.post_status = 'publish'
                        AND $wpdb->posts.post_type = 'post' $setdk
                        ORDER BY $wpdb->posts.post_date DESC
                    ";
            
            $posts = $wpdb->get_results($querystr, OBJECT);
            foreach($posts as $post) :  ?>
            <div class="post_box products padding-span5 col-lg-3 col-md-3 col-sm-6 col-xs-12" > 
                <?php 
                    echo '<div class="post-images">';
                    $this->get_post_images($post->ID);
                    echo '</div>'; 
                    echo '<div class="price-product">';
                    $this->get_price_product();
                    echo '</div>';
                    $this->get_button_gio_hang();
                    $this->view_singgle_product($post->ID);
                ?>
                
                <h2 class="headline"><a href="<?php echo get_permalink($post->ID); ?>" rel="bookmark" title="<?php echo get_the_title($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h2>
            </div>
            <?php endforeach;
            echo '<div class="clearfix"></div>';
        } 
    }
}
endif;

/**
* khoi tao clacss
*/
new Shoptav002;