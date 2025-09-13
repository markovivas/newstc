<?php
/**
 * O template para exibir todos os posts individuais
 *
 * @package NewSTC
 */

get_header();
?>

<div class="single-post-container">
    <main id="primary" class="site-main">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-content-area'); ?>>
                
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-featured-image">
                        <?php the_post_thumbnail('newstc-featured'); ?>
                    </div>
                <?php endif; ?>

                <div class="post-content-wrapper">
                    <header class="entry-header">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="post-category">' . esc_html( $categories[0]->name ) . '</a>';
                        }
                        ?>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <?php newstc_post_meta(); ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php
                        // Se existem tags, exibe-as
                        if (has_tag()) :
                            ?>
                            <div class="post-tags">
                                <span class="tags-label"><?php esc_html_e('Tags:', 'newstc'); ?></span>
                                <?php the_tags('', '', ''); ?>
                            </div>
                        <?php endif; ?>

                        <?php newstc_social_share(); ?>
                    </footer><!-- .entry-footer -->
                </div>
            </article><!-- #post-<?php the_ID(); ?> -->

            <div class="post-navigation-container">
                <?php
                the_post_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle"><i class="fas fa-arrow-left"></i> ' . esc_html__( 'Post Anterior', 'newstc' ) . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Próximo Post', 'newstc' ) . ' <i class="fas fa-arrow-right"></i></span> <span class="nav-title">%title</span>',
                    )
                );
                ?>
            </div>

            <?php
            // Se os comentários estão abertos ou temos pelo menos um comentário, carregue o template de comentários.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>
            <?php
        endwhile; // Fim do loop.
        ?>
    </main><!-- #main -->
</div>

<?php
get_footer();