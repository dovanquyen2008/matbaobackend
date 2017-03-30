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
    <div class="container">
        <div class="row clearfix">
            <?php $cores->breadCrumbs(); ?>
            <div class="col-2 sidebar_">
                <?php require('sidebar.php'); ?>
            </div>
            <div class="col-10 single_">
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

                <?php
                global $post;
                    $posts = get_posts('numberposts=20&post_type=tin-tuc&exclude=' . $current_post);
                    echo '<h2 class="news_title_relates">Tin tức khác liên quan</h2>';
                    echo '<ul class="news-relates clearfix" >';
                    foreach ($posts as $post) :
                        ?>
                        <li class="product_post">
                            <h3 class="title_post">
                                <a href="<?php the_permalink(); ?>"
                                   title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </li>
                        <?php
                    endforeach;
                    echo '</ul>';
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>
</div>
