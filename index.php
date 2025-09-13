<?php
/**
 * O template principal
 *
 * Este é o template mais genérico no WordPress e um dos
 * dois arquivos obrigatórios para um tema (o outro é style.css).
 *
 * @package NewSTC
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="latest-news">
            <h1 class="page-title">
                <?php
                if ( is_home() && ! is_front_page() ) :
                    single_post_title();
                else :
                    esc_html_e( 'Últimas Notícias', 'newstc' );
                endif;
                ?>
            </h1>

            <?php if ( have_posts() ) : ?>
                <div class="news-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('news-card'); ?>>
                            <div class="news-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="news-content">
                                <header class="news-header">
                                    <h2 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php newstc_post_meta(); ?>
                                </header>
                                <div class="news-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <footer class="news-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e('Leia mais', 'newstc'); ?></a>
                                </footer>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>

                <?php
                the_posts_pagination(
                    array(
                        'prev_text' => '<i class="fas fa-arrow-left"></i> ' . esc_html__( 'Anterior', 'newstc' ),
                        'next_text' => esc_html__( 'Próximo', 'newstc' ) . ' <i class="fas fa-arrow-right"></i>',
                    )
                );
            else :
                ?>
                <p><?php esc_html_e('Nenhuma notícia encontrada.', 'newstc'); ?></p>
                <?php
            endif;
            ?>
        </div>
    </div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();