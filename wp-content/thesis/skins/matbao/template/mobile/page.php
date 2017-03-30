<?php
/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 17/11/2016
 * Time: 23:36
 */
global $cores;
?>
<div class="__single_page pdtb20">
    <div class="containers mobile">
        <div class="row clearfix">
            <?php $cores->breadCrumbs(); ?>
            <div class="col-12 single_">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="post __post_04 __post_page clearfix pd12">
                        <header class="__post_header_ pdtb5">
                            <h1><?php the_title(); ?></h1>
                        </header>
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
            </div>
        </div>
    </div>
</div>
