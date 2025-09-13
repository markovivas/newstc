<?php
/**
 * The header for our theme
 *
 * @package NewSTC
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link sr-only" href="#primary"><?php esc_html_e('Pular para o conteúdo', 'newstc'); ?></a>

    <header id="masthead" class="site-header">
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-contact">
                    <?php
                    $phone = get_theme_mod('newstc_phone');
                    $email = get_theme_mod('newstc_email');
                    
                    if ($phone) : ?>
                        <a href="tel:<?php echo esc_attr($phone); ?>">
                            <i class="fas fa-phone"></i>
                            <?php echo esc_html($phone); ?>
                        </a>
                    <?php endif;
                    
                    if ($email) : ?>
                        <a href="mailto:<?php echo esc_attr($email); ?>">
                            <i class="fas fa-envelope"></i>
                            <?php echo esc_html($email); ?>
                        </a>
                    <?php endif; ?>
                </div>
                
                <div class="top-bar-social">
                    <?php
                    $social_links = array(
                        'facebook' => get_theme_mod('newstc_facebook'),
                        'twitter' => get_theme_mod('newstc_twitter'),
                        'instagram' => get_theme_mod('newstc_instagram'),
                        'linkedin' => get_theme_mod('newstc_linkedin')
                    );
                    
                    foreach ($social_links as $platform => $url) {
                        if ($url) {
                            echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer">';
                            echo '<i class="fab fa-' . esc_attr($platform) . '"></i>';
                            echo '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="main-header">
            <div class="container">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<div class="site-title-wrap">';
                        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></h1>';
                        if (get_bloginfo('description')) {
                            echo '<p class="site-description">' . get_bloginfo('description') . '</p>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>

                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                        <span class="sr-only"><?php esc_html_e('Menu Principal', 'newstc'); ?></span>
                    </button>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id' => 'primary-menu',
                        'container' => false,
                        'menu_class' => 'primary-menu',
                        'fallback_cb' => false
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </header>