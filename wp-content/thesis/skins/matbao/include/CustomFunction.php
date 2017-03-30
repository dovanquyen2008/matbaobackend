<?php



/**

 * Created by PhpStorm.

 * User: vancuong

 * Date: 16/11/2016

 * Time: 19:11

 */

if (!class_exists('CustomFunction')):

    class CustomFunction

    {

        public function __construct()

        {

            /**

             * khai bao function

             */

            add_shortcode('SearchField', array( $this, 'searchCustomField') );

        }



        /*** get custom values *****/

        public function getCustomFieldValue($szKey, $bPrint = false)

        {

            global $post;

            $szValue = get_post_meta($post->ID, $szKey, true);

            if ($bPrint == false) return $szValue; else echo $szValue;

        }



        /*** get attribute values *****/

        public function getAttributeValue($id, $szKey, $bPrint = false)

        {

            try {

                $terms = get_the_terms($id, 'pa_' . $szKey);



                if (isset($terms) && !empty($terms)) {

                    $value = $terms[0]->name;

                } else {

                    $value = '';

                }



                if ($bPrint == false) return $value; else echo $value;

            } catch (Exception $e) {

                echo '.';

            }



        }



        /*** get attribute values *****/

        public function getPriceProductValue($bPrint = false)

        {

            global $post;

            $gia_ban = get_post_meta($post->ID, 'gia_ban', true);

            $gia_km = get_post_meta($post->ID, 'khuyen_mai', true);



            if (isset($gia_ban) && !empty($gia_ban) && $gia_ban != 0) {

                if (isset($gia_km) && !empty($gia_km) && $gia_km != 0 && $gia_km < $gia_ban) {

                    $szValue = number_format($gia_ban - $gia_km) . 'đ';

                } else {

                    $szValue = number_format($gia_ban) . 'đ';

                }

            } else {

                $szValue = 'Liên hệ';

            }

            if ($bPrint == false) return $szValue; else echo $szValue;

        }



        /**

         * function get post image in thesis

         */

        public function getPostImage()

        {

            $anhsd = $this->getCustomFieldValue('_thesis_post_image', false);

            $url = $anhsd['image']['url'];

            return "<a href='" . get_the_permalink() . "' title='" . get_the_title() . "'><img src='" . $url . "' alt='" . get_the_title() . "'></a>";

        }



        /**

         * function get thumb image in thesis

         */

        public function getThumbNailImage()

        {

            $anhsd = $this->getCustomFieldValue('_thesis_post_thumbnail', false);

            $url = $anhsd['image']['url'];

            return "<a href='" . get_the_permalink() . "' title='" . get_the_title() . "'><img src='" . $url . "' alt='" . get_the_title() . "'></a>";

        }



        /**

         * Breadcrumbs bar

         */

        public function breadCrumbs()

        {

            /* === OPTIONS === */

            $text['home'] = 'Trang chủ'; // text for the 'Home' link

            $text['category'] = '%s'; // text for a category page

            $text['search'] = '%s'; // text for a search results page

            $text['tag'] = '%s'; // text for a tag page

            $text['author'] = '%s'; // text for an author page

            $text['404'] = 'Error 404'; // text for the 404 page



            $show_current = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show

            $show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

            $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show

            $show_title = 1; // 1 - show the title for the links, 0 - don't show

            $delimiter = '  > '; // delimiter between crumbs

            $before = '<span class="current">'; // tag before the current crumb

            $after = '</span>'; // tag after the current crumb

            /* === END OF OPTIONS === */



            global $post;

            $home_link = home_url('/');

            $link_before = '<span typeof="v:Breadcrumb">';

            $link_after = '</span>';

            $link_attr = ' rel="v:url" property="v:title"';

            $link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;

            $parent_id = $parent_id_2 = $post->post_parent;

            $frontpage_id = get_option('page_on_front');



            if (is_home() || is_front_page()) {



                if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';



            } else {



                echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';

                if ($show_home_link == 1) {

                    echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';

                    if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;

                }



                if (is_tag() || is_category() || is_taxonomy('product_cat')) {

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



                } elseif (is_search()) {

                    echo $before . sprintf($text['search'], get_search_query()) . $after;



                } elseif (is_day()) {

                    echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;

                    echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;

                    echo $before . get_the_time('d') . $after;



                } elseif (is_month()) {

                    echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;

                    echo $before . get_the_time('F') . $after;



                } elseif (is_year()) {

                    echo $before . get_the_time('Y') . $after;



                } elseif (is_single() && !is_attachment()) {

                    if (get_post_type() != 'post') {

                        $post_type = get_post_type_object(get_post_type());

                        $slug = $post_type->rewrite;

                        printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);

                        if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

                    } else {

                        $cat = get_the_category();

                        $cat = $cat[0];

                        $cats = get_category_parents($cat, TRUE, $delimiter);

                        if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);

                        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);

                        $cats = str_replace('</a>', '</a>' . $link_after, $cats);

                        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);

                        echo $cats;

                        if ($show_current == 1) echo $before . get_the_title() . $after;

                    }



                } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {

                    $post_type = get_post_type_object(get_post_type());

                    echo $before . $post_type->labels->singular_name . $after;



                } elseif (is_attachment()) {

                    $parent = get_post($parent_id);

                    $cat = get_the_category($parent->ID);

                    $cat = $cat[0];

                    if ($cat) {

                        $cats = get_category_parents($cat, TRUE, $delimiter);

                        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);

                        $cats = str_replace('</a>', '</a>' . $link_after, $cats);

                        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);

                        echo $cats;

                    }

                    printf($link, get_permalink($parent), $parent->post_title);

                    if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;



                } elseif (is_page() && !$parent_id) {

                    if ($show_current == 1) echo $before . get_the_title() . $after;



                } elseif (is_page() && $parent_id) {

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

                            if ($i != count($breadcrumbs) - 1) echo $delimiter;

                        }

                    }

                    if ($show_current == 1) {

                        if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;

                        echo $before . get_the_title() . $after;

                    }



                } elseif (is_tag()) {

                    echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;



                } elseif (is_author()) {

                    global $author;

                    $userdata = get_userdata($author);

                    echo $before . sprintf($text['author'], $userdata->display_name) . $after;



                } elseif (is_404()) {

                    echo $before . $text['404'] . $after;

                }



                if (get_query_var('paged')) {

                    if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';

                    echo __('Page') . ' ' . get_query_var('paged');

                    if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';

                }



                echo '</div><!-- .breadcrumbs -->';



            }

        }



        /**

         * list category recent post

         */

        public function listCategoryRecentPost($prefix = ',')

        {

            $cats = get_the_category();

            $i = 1;

            foreach ($cats as $cat):

                if ($cat->term_id != 6):

                    if ($i != 1) echo $prefix . ' ';

                    $i++;

                    echo "<a href='" . get_category_link($cat->term_id) . "' title='" . $cat->name . "'>" . $cat->name . "</a> ";

                endif;

            endforeach;

        }



        /**

         * display tag by is post

         */

        public function getTagByIdPost($prefix = '')

        {

            global $post;

            $tags = get_the_tags($post->ID);

            $i = 1;

            if (!empty($tags)):

                foreach ($tags as $tag) :

                    if ($i != 1) echo $prefix . ' ';

                    $i++;

                    echo "<a href='" . home_url('/') . "tag/" . $tag->slug . "/' title='" . $tag->name . "'>" . $tag->name . "</a>";

                endforeach;

            endif;

        }



        /**

         * list images post

         */

        public function ds_anh_single()

        {

            global $post;

            $home_link = "";

            $post_image_data = get_post_meta($post->ID, '_thesis_post_image', true);

            $linkanh = $post_image_data['image']['url'];

            if (strpos($linkanh, 'x') == false) {

                $linkanhs = $linkanh;

            } else {

                $linkanhs = substr($linkanh, 0, -12) . substr($linkanh, -4);

            }

            $linkanhd = $home_link . $linkanhs;

            //thu vien post

            $gallerys = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image'));

            $gallery = array();

            //print_r( $gallerys );

            foreach ($gallerys as $attachment_id => $attachment) {

                array_push($gallery, $attachment->guid);

            }

            // show single

            if (!wp_is_mobile()) {

                echo "<ul class='list-images-post' >";

                $i = 0;

                foreach ($gallery as $value) {

                    echo "<li class='thum-img' rel='" . $value . "'><img src='" . substr($value, 0, -4) . "-150x150" . substr($value, -4) . "' alt='Click view'></li>";

                    $i++;

                    if ($i > 4) break;

                }

                echo "</ul>";

                echo "<div class='image_thum image_list' style='background-image:url(" . $linkanhd . ")'></div>";

            } else {

                echo "<ul class='list-images-post' >";

                $i = 0;

                foreach ($gallery as $value) {

                    echo "<li class='thum-img' rel='" . $value . "'><img src='" . substr($value, 0, -4) . "-150x150" . substr($value, -4) . "' alt='Click view'></li>";

                    $i++;

                    if ($i > 4) break;

                }

                echo "</ul>";

                echo "<div class='image_thum image_list' style='background-image:url(" . $linkanh . ")'></div>";

            }

            echo "<div class='clearfix'></div>";

            echo "<div class='info-post-product'><h3>Thông tin chi tiết sản phẩm</h3></div>";

        }



        /**

         * check cart

         */

        public function checkInCart()

        {

            global $post;

            $hang = $this->getCustomFieldValue('trang_thai', false);

            $check = true;

            if ($hang != "Hết hàng") {

                $check = false;

            }

            return $check;

        }



        /******* get custom field  ********/

        public function getCustomField()

        {

            global $post;

            echo '<div class="line"><span class=\'blue\'>Trạng thái: </span><span class=\'best_baohanh_space3\'></span>';

            if (!$this->checkInCart()) echo 'Còn hàng'; else echo 'Hết hàng';

            echo '</div><div class="line"><span class="price_product">';

            $this->getPriceProductValue(true);

            echo "</span></div>";

            echo '';

        }



        /**

         * Relates post by Category

         */

        public function bestRelatedPosts()

        {

            global $post;

            $current_post = $post->ID;

            $categories_lq = get_the_category();

            foreach ($categories_lq as $category) :

                echo '<div class="clearfix"></div>';

                echo '<div class="title_cat_re">';

                echo '<h2>Sản phẩm liên quan: <a href="' . get_category_link($category->term_id) . '" title="' . $category->cat_name . '">' . $category->cat_name . '</a></h2>';

                echo '</div>';

                $posts = get_posts('numberposts=20&category=' . $category->term_id . '&exclude=' . $current_post);

                echo '<ul class="produc-relates" >';

                foreach ($posts as $post) :

                    ?>

                    <li class="product_post">

                        <div class="thumbnail_post">

                            <?php echo $this->getPostImage(); ?>

                        </div>

                        <div class="price-product">

                            <?php $this->getPriceProductValue(true); ?>

                        </div>

                        <h3 class="title_post">

                            <a href="<?php the_permalink(); ?>"

                               title="<?php the_title(); ?>"><?php the_title(); ?></a>

                        </h3>

                    </li>

                    <?php

                endforeach;

                echo '<div class="clearfix"></div></ul>';

                break;

            endforeach;

            wp_reset_query();

        }



        /**

         * kiem tra con hang

         */

        public function checkProductCount()

        {

            global $post;

            $hang = $this->getCustomFieldValue('trang_thai', false);

            if ($hang == "Hết hàng") {

                echo '<i class="is-in-cart"></i>';

            }

        }



        /**

         * Search custom field

         */

        public function searchCustomField()

        {

            global $post;

            $code = $_POST['code_product'];

            $cat = $_POST['category'];

            $trade = $_POST['trademark'];

            $price = $_POST['price'];



            $meta_query = array();

            $category = '';

            if (isset($code) && !empty($code)){

                $meta_query[] = array(

                    'key' => 'ma_sanpham',

                    'value' => $code,

                );

            }else{

                if (isset($cat) && $cat != 0){

                    $category = $cat;

                }else{

                    if (isset($trade) && $trade != 0 && $trade != 1){

                        $category = $trade;

                    }

                }

                if (isset($price) && $price != 0){

                    $meta_query[] = array(

                        'key' => 'gia_ban',

                        'value' => $price,

                        'compare' => '<=',

                        'type' => 'NUMERIC',

                    );

                    if ($price == 500000){

                        $meta_query[] = array(

                            'key' => 'gia_ban',

                            'value' => 200000,

                            'compare' => '>',

                            'type' => 'NUMERIC',

                        );

                    }

                    if ($price == 1000000){

                        $meta_query[] = array(

                            'key' => 'gia_ban',

                            'value' => 500000,

                            'compare' => '>',

                            'type' => 'NUMERIC',

                        );

                    }

                    if ($price == 2000000){

                        $meta_query[] = array(

                            'key' => 'gia_ban',

                            'value' => 1000000,

                            'compare' => '>',

                            'type' => 'NUMERIC',

                        );

                    }

                    if ($price == 3000000){

                        $meta_query[] = array(

                            'key' => 'gia_ban',

                            'value' => 2000000,

                            'compare' => '>',

                            'type' => 'NUMERIC',

                        );

                    }

                    if ($price == 5000000){

                        $meta_query[] = array(

                            'key' => 'gia_ban',

                            'value' => 3000000,

                            'compare' => '>',

                            'type' => 'NUMERIC',

                        );

                    }

                    if ($price == 20000000){

                        $meta_query[] = array(

                            'key' => 'gia_ban',

                            'value' => 5000000,

                            'compare' => '>',

                            'type' => 'NUMERIC',

                        );

                    }

                }

            }



            $args = array(

                'posts_per_page'   => 20,

                'offset'           => 0,

                'category'         => $category,

                'category_name'    => '',

                'orderby'          => 'date',

                'order'            => 'DESC',

                'include'          => '',

                'exclude'          => '',

                'meta_key'         => '',

                'meta_value'       => '',

                'post_type'        => 'post',

                'post_mime_type'   => '',

                'post_parent'      => '',

                'author'	   => '',

                'author_name'	   => '',

                'post_status'      => 'publish',

                'suppress_filters' => true,

                'meta_query'       =>  $meta_query

            );



            $posts_array = get_posts( $args );

            echo '<div id="category__page" class="clearfix">';

            foreach ($posts_array as $post): ?>

                <div class="product_post col-3">

                    <div class="thumbnail_post">

                        <?php echo $this->getPostImage(); ?>

                    </div>

                    <div class="price-product">

                        <?php $this->getPriceProductValue(true); ?>

                    </div>

                    <h3 class="title_post">

                        <a href="<?php the_permalink(); ?>"

                           title="<?php the_title(); ?>"><?php the_title(); ?></a>

                    </h3>

                    <?php $this->checkProductCount(); ?>

                </div>

            <?php endforeach;

            echo '</div>';

        }



    }





    /**

     *check class is exit

     * call class

     * time: 16/11/2016

     * localtion: ho chi minh city

     */



    function customfunction()

    {

        global $cores;



        if (!isset($cores)) {

            $cores = new CustomFunction();

        }



        return $cores;

    }



    customfunction();





endif;