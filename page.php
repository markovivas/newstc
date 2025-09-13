<?php
/**
 * O template para exibir todas as páginas
 *
 * @package NewSTC
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container" style="padding-top: var(--spacing-xl); padding-bottom: var(--spacing-xl);">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->
            <?php
        endwhile; // Fim do loop.
        ?>
    </div>
</main><!-- #main -->

<?php
get_footer();