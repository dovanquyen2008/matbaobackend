<?php

/**

 * Created by PhpStorm.

 * User: vancuong

 * Date: 16/11/2016

 * Time: 15:54

 */



if (is_home()):

    global $post;

    global $cores;

    $banner = 16325 ;

    ?>

    <div class="__sliders_block pdtb5">

        <div class="containers mobile">

            <div class="row">

                <a href="<?php echo get_post_meta($banner, 'link_banner_a', true) ?>" title="Balo ShopTA">

                    <?php echo wp_get_attachment_image( get_post_meta($banner, 'banner_a', true), "large", "", array( "class" => "img-responsive" ) ); ?>

                </a>

            </div>

        </div>

    </div>

    <div id="post-gioi-thieu">

        <div class="containers mobile">

            <div class="row">

                <div class="__post_content_">

                    <?php

                        $about = get_post(253);

                        $output =  apply_filters( 'the_content', $about->post_content );

                        echo $output;

                    ?>

                </div>

            </div>

        </div>

    </div>
    <div id="product-home">

        <div class="container mobile">

            <div class="row">

                <div id="moi-nhat" class="" style="display: block">

                    <h2 class="title-home-product">Sản phẩm cựa gà</h2>

                    <?php

                    $args = array(

                        'posts_per_page' => 16,

                        'orderby' => 'date',

                        'order' => 'DESC',

                        'post_type' => 'post',

                        'post_status' => 'publish',

                        'suppress_filters' => true

                    );

                    $posts = get_posts($args);

                    echo '<ul id="category__page" class="clearfix" style="padding:0">';

                    foreach ($posts as $post):

                        ?>

                        <li class="product_post col-6">

                            <div class="thumbnail_post">

                                <?php echo $cores->getPostImage(); ?>

                            </div>

                            <div class="price-product">

                                <?php $cores->getPriceProductValue(true); ?>

                            </div>

                            <h3 class="title_post">

                                <a href="<?php the_permalink(); ?>"

                                   title="<?php the_title(); ?>"><?php the_title(); ?></a>

                            </h3>

                        </li>

                    <?php endforeach; ?>

                    <?php echo '</ul>'; ?>

                </div>

            </div>

        </div>

    </div>

    <?php

endif;









