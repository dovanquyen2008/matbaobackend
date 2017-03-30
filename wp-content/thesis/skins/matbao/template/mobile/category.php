<?php
/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 17/11/2016
 * Time: 4:34
 */
global $cores;
global $thesis;
$term_id = get_queried_object()->term_id;
?>
<div class="feature_post __content_category pdtb60">
    <div class="containers mobile">
        <div class="row clearfix">
            <?php $cores->breadCrumbs(); ?>
            <div class="cat_">
                <div class="__title_category ">
                    <?php if (is_search()): ?>
                        <h1 class="page-title"><?php printf( __( 'Tìm Kiếm: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    <?php else: ?>
                        <h1><?php echo get_cat_name($term_id); ?></h1>
                    <?php endif; ?>
                </div>
                <?php $content = $thesis->wp->terms[$term_id]['thesis_archive_content']['content']; ?>
                <?php if(isset($content) && !empty($content)): ?>
                    <div class="description_cat">
                        <?php echo str_replace('\"',"",$content); ?>
                    </div>
                <?php endif; ?>
                <div id="category__page" class="clearfix">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="product_post col-6">
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
                            <?php $cores->checkProductCount(); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php wp_pagenavi(); ?>
        </div>
    </div>
</div>