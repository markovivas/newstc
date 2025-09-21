<?php
/**
 * Terra do Rei functions and definitions
 *
 * @package TerraDoRei
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Definição de constantes do tema
define('TERRADOREI_VERSION', '1.0.0');
define('TERRADOREI_TEMPLATE_DIR', get_template_directory());
define('TERRADOREI_TEMPLATE_URI', get_template_directory_uri());

// Configuração do tema
if (!function_exists('terradorei_setup')) :
    function terradorei_setup() {
        // Suporte a traduções
        load_theme_textdomain('terradorei', TERRADOREI_TEMPLATE_DIR . '/languages');

        // Suporte a tags do HTML5
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Suporte a título
        add_theme_support('title-tag');

        // Suporte a thumbnails
        add_theme_support('post-thumbnails');

        // Tamanhos de imagem personalizados
        add_image_size('terradorei-featured', 800, 500, true);
        add_image_size('terradorei-card', 400, 250, true);
        add_image_size('terradorei-thumbnail', 150, 150, true);

        // Suporte a menus
        register_nav_menus(array(
            'primary' => __('Menu Principal', 'terradorei'),
            'footer' => __('Menu do Rodapé', 'terradorei'),
        ));

        // Suporte a widgets
        add_theme_support('widgets');
        add_theme_support('widgets-block-editor');

        // Suporte a logo personalizada
        add_theme_support('custom-logo', array(
            'height' => 60,
            'width' => 200,
            'flex-height' => true,
            'flex-width' => true,
        ));

        // Suporte a wide alignment no editor
        add_theme_support('align-wide');

        // Suporte a estilos do editor
        add_theme_support('editor-styles');
        add_editor_style('assets/css/editor-style.css');

        // Suporte a core block patterns
        add_theme_support('core-block-patterns');

        // Remover estilos padrão da galeria
        add_filter('use_default_gallery_style', '__return_false');
    }
endif;
add_action('after_setup_theme', 'terradorei_setup');

// Enfileirar scripts e estilos
function terradorei_scripts() {
    // Estilo principal
    wp_enqueue_style('terradorei-style', get_stylesheet_uri(), array(), TERRADOREI_VERSION);
    
    // Google Fonts
    wp_enqueue_style('terradorei-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap', array(), null);
    
    // Font Awesome
    wp_enqueue_style('terradorei-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Script principal
    wp_enqueue_script('terradorei-script', TERRADOREI_TEMPLATE_URI . '/assets/js/main.js', array(), TERRADOREI_VERSION, true);
    
    // Adiciona dados para scripts
    wp_localize_script('terradorei-script', 'terradorei_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('terradorei_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'terradorei_scripts');

/**
 * Adiciona opções ao Personalizador do WordPress.
 */
function terradorei_customize_register( $wp_customize ) {
    // Seção Hero
    $wp_customize->add_section('terradorei_hero_section', array(
        'title' => __('Seção Hero', 'terradorei'),
        'description' => __('Opções para a seção Hero na página inicial.', 'terradorei'),
        'priority' => 30,
    ));

    // Título
    $wp_customize->add_setting('hero_title', ['default' => __('Notícias Corporativas', 'terradorei'), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('hero_title', ['label' => __('Título', 'terradorei'), 'section' => 'terradorei_hero_section', 'type' => 'text']);

    // Descrição
    $wp_customize->add_setting('hero_description', ['default' => __('Mantenha-se atualizado com as últimas notícias e informações da empresa', 'terradorei'), 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage']);
    $wp_customize->add_control('hero_description', ['label' => __('Descrição', 'terradorei'), 'section' => 'terradorei_hero_section', 'type' => 'textarea']);

    // Imagem de Fundo
    $wp_customize->add_setting('hero_background_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image', ['label' => __('Imagem de Fundo', 'terradorei'), 'section' => 'terradorei_hero_section']));

    // Texto do Botão Primário
    $wp_customize->add_setting('hero_button_primary_text', ['default' => __('Ver Notícias', 'terradorei'), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('hero_button_primary_text', ['label' => __('Texto do Botão Primário', 'terradorei'), 'section' => 'terradorei_hero_section', 'type' => 'text']);

    // Link do Botão Primário
    $wp_customize->add_setting('hero_button_primary_link', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('hero_button_primary_link', ['label' => __('Link do Botão Primário', 'terradorei'), 'section' => 'terradorei_hero_section', 'type' => 'url']);

    // Texto do Botão Secundário
    $wp_customize->add_setting('hero_button_secondary_text', ['default' => __('Saiba Mais', 'terradorei'), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage']);
    $wp_customize->add_control('hero_button_secondary_text', ['label' => __('Texto do Botão Secundário', 'terradorei'), 'section' => 'terradorei_hero_section', 'type' => 'text']);

    // Link do Botão Secundário
    $wp_customize->add_setting('hero_button_secondary_link', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('hero_button_secondary_link', ['label' => __('Link do Botão Secundário', 'terradorei'), 'section' => 'terradorei_hero_section', 'type' => 'url']);

    // Habilitar Live Preview
    $wp_customize->get_setting('hero_title')->transport = 'postMessage';
    $wp_customize->get_setting('hero_description')->transport = 'postMessage';
    $wp_customize->get_setting('hero_button_primary_text')->transport = 'postMessage';
    $wp_customize->get_setting('hero_button_secondary_text')->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial('hero_title', [
        'selector' => '.hero-content h1',
        'render_callback' => function() { return get_theme_mod('hero_title'); },
    ]);
    $wp_customize->selective_refresh->add_partial('hero_description', [
        'selector' => '.hero-content p',
        'render_callback' => function() { return get_theme_mod('hero_description'); },
    ]);
}
add_action('customize_register', 'terradorei_customize_register');

/**
 * Enfileira script para o live preview do Customizer.
 */
function terradorei_customizer_live_preview() {
    wp_enqueue_script(
        'terradorei-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array('jquery', 'customize-preview'),
        TERRADOREI_VERSION,
        true
    );
}
add_action('customize_preview_init', 'terradorei_customizer_live_preview');

// Registrar áreas de widgets
function terradorei_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Principal', 'terradorei'),
        'id' => 'sidebar-1',
        'description' => __('Widgets que aparecem na sidebar principal.', 'terradorei'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Rodapé - Coluna 1', 'terradorei'),
        'id' => 'footer-1',
        'description' => __('Widgets que aparecem na primeira coluna do rodapé.', 'terradorei'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Rodapé - Coluna 2', 'terradorei'),
        'id' => 'footer-2',
        'description' => __('Widgets que aparecem na segunda coluna do rodapé.', 'terradorei'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Rodapé - Coluna 3', 'terradorei'),
        'id' => 'footer-3',
        'description' => __('Widgets que aparecem na terceira coluna do rodapé.', 'terradorei'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'terradorei_widgets_init');

// Funções personalizadas
function terradorei_post_meta() {
    $reading_time = terradorei_reading_time();

    echo '<div class="post-meta">';
    echo '<span class="post-date"><i class="far fa-calendar-alt"></i> ' . get_the_date() . '</span>';
    echo '<span class="post-reading-time"><i class="far fa-clock"></i> ' . esc_html($reading_time) . '</span>';
    echo '</div>';
}

function terradorei_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Média de 200 palavras por minuto

    if ($reading_time < 1) {
        return __('Menos de 1 min de leitura', 'terradorei');
    }

    $time_string = sprintf(_n('%s min de leitura', '%s min de leitura', $reading_time, 'terradorei'), $reading_time);
    return $time_string;
}

// Função para botões de compartilhamento social
function terradorei_social_share() {
    $post_url = urlencode(get_permalink());
    $post_title = urlencode(get_the_title());
    
    $social_links = [
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url,
        'twitter' => 'https://twitter.com/intent/tweet?text=' . $post_title . '&url=' . $post_url,
        'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_url . '&title=' . $post_title,
        'whatsapp' => 'https://api.whatsapp.com/send?text=' . $post_title . ' ' . $post_url,
        'instagram' => 'https://www.instagram.com', // O Instagram não tem URL de compartilhamento direto. Este link pode ser alterado para o perfil da empresa.
    ];
    
    echo '<div class="post-share">';
    echo '<span class="share-label">' . esc_html__('Compartilhar:', 'terradorei') . '</span>';
    echo '<div class="share-buttons">';
    
    foreach ($social_links as $platform => $link) {
        echo '<a href="' . esc_url($link) . '" class="share-btn ' . esc_attr($platform) . '" target="_blank" rel="noopener noreferrer">';
        echo '<i class="fab fa-' . esc_attr($platform) . '"></i>';
        echo '</a>';
    }
    
    // Botão de Imprimir
    echo '<button onclick="window.print()" class="share-btn print-btn" title="' . esc_attr__('Imprimir', 'terradorei') . '">';
    echo '<i class="fas fa-print"></i>';
    echo '</button>';
    echo '</div></div>';
}

// Shortcodes personalizados
function terradorei_calendar_shortcode($atts) {
    $atts = shortcode_atts(array(
        'show_title' => true,
        'show_navigation' => true
    ), $atts);
    
    ob_start();
    ?>
    <div class="terradorei-calendar">
        <?php if ($atts['show_title']) : ?>
            <h3><?php _e('Calendário de Eventos', 'terradorei'); ?></h3>
        <?php endif; ?>
        <?php echo do_shortcode('[mostra-calendario-widget]'); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('terradorei_calendar', 'terradorei_calendar_shortcode');

function terradorei_events_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 5,
        'show_title' => true
    ), $atts);
    
    ob_start();
    ?>
    <div class="terradorei-events">
        <?php if ($atts['show_title']) : ?>
            <h3><?php _e('Próximos Eventos', 'terradorei'); ?></h3>
        <?php endif; ?>
        <?php echo do_shortcode('[mostra-prox-eventos]'); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('terradorei_events', 'terradorei_events_shortcode');

// Otimizações e funcionalidades adicionais
function terradorei_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'terradorei_excerpt_length');

function terradorei_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'terradorei_excerpt_more');

// Suporte a SVG
function terradorei_svg_support($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'terradorei_svg_support');

// Remover emojis do WordPress (para melhor performance)
function terradorei_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'terradorei_disable_emojis');

// Otimizar consultas do WordPress
function terradorei_optimize_queries($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_home() || $query->is_front_page()) {
            $query->set('posts_per_page', 6);
        }
    }
}
add_action('pre_get_posts', 'terradorei_optimize_queries');

// Adicionar suporte a WebP
function terradorei_webp_support($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('mime_types', 'terradorei_webp_support');

// Customizar a pesquisa
function terradorei_search_filter($query) {
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'terradorei_search_filter');

// Adicionar suporte a lazy loading para imagens
function terradorei_lazy_load_images($content) {
    if (is_feed() || is_admin()) {
        return $content;
    }
    
    $content = preg_replace_callback('/<img[^>]+/', function($matches) {
        $img = $matches[0];
        
        // Skip if already has lazy loading
        if (strpos($img, 'loading=') !== false) {
            return $img;
        }
        
        // Add loading="lazy" attribute
        $img = preg_replace('/<img(.*?)>/i', '<img$1 loading="lazy">', $img);
        
        return $img;
    }, $content);
    
    return $content;
}
add_filter('the_content', 'terradorei_lazy_load_images');

// Adicionar schema markup para melhor SEO
function terradorei_schema_markup() {
    if (is_single()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => get_the_title(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author()
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => wp_get_attachment_url(get_theme_mod('custom_logo'))
                )
            )
        );
        
        if (has_post_thumbnail()) {
            $schema['image'] = array(
                '@type' => 'ImageObject',
                'url' => get_the_post_thumbnail_url(),
                'width' => 1200,
                'height' => 630
            );
        }
        
        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'terradorei_schema_markup');

/**
 * Custom Post Type para Botões de Acesso Rápido.
 */
function terradorei_register_quick_access_cpt() {
    $labels = array(
        'name'                  => _x( 'Botões de Acesso Rápido', 'Post Type General Name', 'terradorei' ),
        'singular_name'         => _x( 'Botão de Acesso Rápido', 'Post Type Singular Name', 'terradorei' ),
        'menu_name'             => __( 'Acesso Rápido', 'terradorei' ),
        'name_admin_bar'        => __( 'Botão de Acesso Rápido', 'terradorei' ),
        'archives'              => __( 'Arquivos de Botões', 'terradorei' ),
        'attributes'            => __( 'Atributos do Botão', 'terradorei' ),
        'parent_item_colon'     => __( 'Botão Pai:', 'terradorei' ),
        'all_items'             => __( 'Todos os Botões', 'terradorei' ),
        'add_new_item'          => __( 'Adicionar Novo Botão', 'terradorei' ),
        'add_new'               => __( 'Adicionar Novo', 'terradorei' ),
        'new_item'              => __( 'Novo Botão', 'terradorei' ),
        'edit_item'             => __( 'Editar Botão', 'terradorei' ),
        'update_item'           => __( 'Atualizar Botão', 'terradorei' ),
        'view_item'             => __( 'Ver Botão', 'terradorei' ),
        'view_items'            => __( 'Ver Botões', 'terradorei' ),
        'search_items'          => __( 'Procurar Botão', 'terradorei' ),
    );
    $args = array(
        'label'                 => __( 'Botão de Acesso Rápido', 'terradorei' ),
        'description'           => __( 'Botões para a seção de acesso rápido na home.', 'terradorei' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-screenoptions',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'page',
    );
    register_post_type( 'quick_access_button', $args );
}
add_action( 'init', 'terradorei_register_quick_access_cpt', 0 );

/**
 * Meta Box para campos extras dos botões.
 */
function terradorei_quick_access_meta_box() {
    add_meta_box( 'quick_access_details', __( 'Detalhes do Botão', 'terradorei' ), 'terradorei_quick_access_meta_box_callback', 'quick_access_button' );
}
add_action( 'add_meta_boxes', 'terradorei_quick_access_meta_box' );

function terradorei_quick_access_meta_box_callback( $post ) {
    wp_nonce_field( 'terradorei_save_quick_access_meta', 'terradorei_quick_access_nonce' );
    $icon = get_post_meta( $post->ID, '_button_icon', true );
    $link = get_post_meta( $post->ID, '_button_link', true );
    ?>
    <p>
        <label for="button_icon"><?php esc_html_e( 'Ícone (ex: fas fa-newspaper):', 'terradorei' ); ?></label>
        <input type="text" id="button_icon" name="button_icon" value="<?php echo esc_attr( $icon ); ?>" style="width:100%;" />
        <small><?php echo sprintf( __( 'Encontre ícones no site do %s.', 'terradorei' ), '<a href="https://fontawesome.com/icons" target="_blank">Font Awesome</a>' ); ?></small>
    </p>
    <p>
        <label for="button_link"><?php esc_html_e( 'Link do Botão:', 'terradorei' ); ?></label>
        <input type="url" id="button_link" name="button_link" value="<?php echo esc_url( $link ); ?>" style="width:100%;" />
    </p>
    <?php
}

function terradorei_save_quick_access_meta( $post_id ) {
    if ( ! isset( $_POST['terradorei_quick_access_nonce'] ) || ! wp_verify_nonce( $_POST['terradorei_quick_access_nonce'], 'terradorei_save_quick_access_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    update_post_meta( $post_id, '_button_icon', sanitize_text_field( $_POST['button_icon'] ?? '' ) );
    update_post_meta( $post_id, '_button_link', esc_url_raw( $_POST['button_link'] ?? '' ) );
}
add_action( 'save_post', 'terradorei_save_quick_access_meta' );

/**
 * Configura as páginas padrão na ativação do tema.
 * Cria as páginas 'Início' e 'Blog' e as define nas configurações de leitura.
 */
function terradorei_setup_default_pages() {
    // Verifica se a página 'Início' já existe
    $home_page = get_page_by_title( 'Início' );

    if ( ! $home_page ) {
        $home_page_id = wp_insert_post( array(
            'post_title'   => 'Início',
            'post_content' => '<!-- wp:paragraph -->Esta é a sua página inicial. Edite-a para adicionar seu próprio conteúdo.<!-- /wp:paragraph -->',
            'post_status'  => 'publish',
            'post_author'  => 1,
            'post_type'    => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
        ) );
    } else {
        $home_page_id = $home_page->ID;
    }

    // Verifica se a página 'Blog' já existe
    $blog_page = get_page_by_title( 'Blog' );

    if ( ! $blog_page ) {
        $blog_page_id = wp_insert_post( array(
            'post_title'   => 'Blog',
            'post_content' => '<!-- wp:paragraph -->Esta página exibirá suas últimas notícias.<!-- /wp:paragraph -->',
            'post_status'  => 'publish',
            'post_author'  => 1,
            'post_type'    => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
        ) );
    } else {
        $blog_page_id = $blog_page->ID;
    }

    // Define as páginas nas configurações de Leitura do WordPress
    if ( isset( $home_page_id ) && isset( $blog_page_id ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_page_id );
        update_option( 'page_for_posts', $blog_page_id );
    }
}
add_action( 'after_switch_theme', 'terradorei_setup_default_pages' );