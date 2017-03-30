<?php
/**
 * Created by PhpStorm.
 * User: vancuong
 * Date: 17/11/2016
 * Time: 4:34
 */
global $cores;
global $thesis;
global $post;
?>
<div class="feature_post __content_category pdtb60">
    <div class="container">
        <div class="row clearfix">
            <?php $cores->breadCrumbs(); ?>
            <div class="col-2 sidebar_">
                <?php require('sidebar.php'); ?>
            </div>
            <div class="col-10 cat_">
                <div class="__title_category ">
                    <h1>Tin tức</h1>
                </div>
                <div id="category__page" class="clearfix">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="news__s col-6">
                            <div class="thumbnail_post">
                                <?php echo $cores->getPostImage(); ?>
                            </div>
                            <h3 class="title_post">
                                <a href="<?php the_permalink(); ?>"
                                   title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php wp_pagenavi(); ?>
        </div>
    </div>
</div>