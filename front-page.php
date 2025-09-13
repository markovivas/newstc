<?php
/**
 * Template para a página inicial
 *
 * @package NewSTC
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1><?php esc_html_e('Notícias Corporativas', 'newstc'); ?></h1>
                <p><?php esc_html_e('Mantenha-se atualizado com as últimas notícias e informações da empresa', 'newstc'); ?></p>
                <div class="hero-cta">
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-white">
                        <i class="fas fa-newspaper"></i> <?php esc_html_e('Ver Notícias', 'newstc'); ?>
                    </a>
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-info-circle"></i> <?php esc_html_e('Saiba Mais', 'newstc'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <section class="quick-access">
        <div class="container">
            <div class="quick-access-buttons">
                <?php
                $buttons_query = new WP_Query(array(
                    'post_type' => 'quick_access_button',
                    'posts_per_page' => -1, // Mostra todos os botões
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));

                if ($buttons_query->have_posts()) :
                    while ($buttons_query->have_posts()) : $buttons_query->the_post();
                        $icon = get_post_meta(get_the_ID(), '_button_icon', true);
                        $link = get_post_meta(get_the_ID(), '_button_link', true);
                        ?>
                        <a href="<?php echo esc_url($link); ?>" class="quick-access-button">
                            <?php if ($icon) : ?>
                                <div class="quick-access-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                            <?php endif; ?>
                            <h3 class="quick-access-title"><?php the_title(); ?></h3>
                            <div class="quick-access-description"><?php the_content(); ?></div>
                        </a>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
    
    <section class="featured-news">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('Notícias em Destaque', 'newstc'); ?></h2>
            
            <div class="featured-news-container">
                <div class="news-main">
                    <div class="featured-news-grid">
                        <?php
                        $featured_args = array(
                            'posts_per_page'      => 2,
                            'category_name'       => 'destaque', // Mostra posts da categoria "destaque"
                            'ignore_sticky_posts' => 1,
                        );
                        
                        $featured_query = new WP_Query($featured_args);
                        
                        if ($featured_query->have_posts()) :
                            while ($featured_query->have_posts()) : $featured_query->the_post();
                                ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('featured-news-item'); ?>>
                                    <div class="featured-thumbnail">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('large'); ?>
                                            </a>
                                        <?php endif; ?>
                                        <div class="featured-badge"><?php esc_html_e('Destaque', 'newstc'); ?></div>
                                    </div>
                                    <div class="featured-content">
                                        <header class="featured-header">
                                            <h3 class="featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php newstc_post_meta(); ?>
                                        </header>
                                        <div class="featured-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <footer class="featured-footer">
                                            <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e('Leia mais', 'newstc'); ?></a>
                                        </footer>
                                    </div>
                                </article>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <p><?php esc_html_e('Nenhuma notícia em destaque encontrada.', 'newstc'); ?></p>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
                
                <div class="sidebar">
                    <div class="sidebar-widget calendar-widget">
                        <div class="calendar-container">
                            <?php echo do_shortcode('[mostra-calendario-widget]'); ?>
                        </div>
                    </div>
                    
                    <div class="sidebar-widget events-widget">
                        <div class="events-list">
                            <?php echo do_shortcode('[mostra-prox-eventos]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="latest-news">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('Últimas Notícias', 'newstc'); ?></h2>
            <div class="news-grid">
                <?php
                $latest_args = array(
                    'posts_per_page' => 6,
                    'ignore_sticky_posts' => 1
                );
                
                $latest_query = new WP_Query($latest_args);
                
                if ($latest_query->have_posts()) :
                    while ($latest_query->have_posts()) : $latest_query->the_post();
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
                                    <h3 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="news-meta">
                                        <span class="news-date"><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                                        <span class="news-author"><i class="far fa-user"></i> <?php the_author(); ?></span>
                                    </div>
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
                    wp_reset_postdata();
                else :
                    ?>
                    <p><?php esc_html_e('Nenhuma notícia encontrada.', 'newstc'); ?></p>
                    <?php
                endif;
                ?>
            </div>
            <div class="view-all">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-primary"><?php esc_html_e('Ver todas as notícias', 'newstc'); ?></a>
            </div>
        </div>
    </section>
</main><!-- #main -->

<?php
get_footer();