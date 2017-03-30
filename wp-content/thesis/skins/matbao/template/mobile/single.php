<?php
/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 17/11/2016
 * Time: 23:36
 */
global $cores;
global $shoppingcart;
global $post;
?>
<div class="__single_page">
    <div class="containers mobile">
        <div class="row clearfix">
            <?php $cores->breadCrumbs(); ?>
            <div class="single_">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="post __post_04 __post_page clearfix pd12">
                        <header class="__post_header_ pdtb5">
                            <h1><?php the_title(); ?></h1>
                        </header>
                        <div class="_info__post clearfix">
                            <div class="col-12 images-roduct">
                                <?php $cores->ds_anh_single(); ?>
                            </div>
                            <div class="col-12 single-right">
                                <?php $cores->getCustomField(); ?>
                                <?php $shoppingcart->addToCartButton(); ?>
                            </div>
                        </div>
                        <div class="__post_content_">
                            <?php
                            the_content();
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'custom' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'custom' ) . ' </span>%',
                                'separator'   => '<span class="screen-reader-text">, </span>',
                            ) );
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php $cores->bestRelatedPosts(); ?>
                <?php $ghj = get_the_tags($post->ID); if (!empty($ghj)): ?>
                    <div class="__post_tag">
                        <i class="glyphicon-tags"></i>
                        <?php $cores->getTagByIdPost(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
