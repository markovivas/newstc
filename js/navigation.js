/**
 * Arquivo para gerenciar a navegação responsiva
 */
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const primaryMenu = document.querySelector('.primary-menu');
    
    if (!menuToggle || !primaryMenu) return;
    
    menuToggle.addEventListener('click', function() {
        const expanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;