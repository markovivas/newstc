<?php
/**
 * O arquivo da barra lateral
 *
 * @package NewSTC
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="sidebar">
    <div class="container">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</aside><!-- #secondary -->