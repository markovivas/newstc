<?php
/**
 * Template Name: Página com Largura Total
 *
 * Este é o template para páginas que precisam ocupar a largura total da tela,
 * sem o container padrão.
 *
 * @package NewSTC
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('page-content-full-width'); ?>>
            <header class="entry-header" style="padding: var(--spacing-xl) var(--spacing-lg) 0;">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php the_content(); ?>
            </div><!-- .entry-content -->

        </article><!-- #post-<?php the_ID(); ?> -->
        <?php
    endwhile; // Fim do loop.
    ?>
</main><!-- #main -->

<?php
get_footer();