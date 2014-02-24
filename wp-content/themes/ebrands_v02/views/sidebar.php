<div class="col-lg-3">
    <div class="bs-sidebar">
        <?php wp_nav_menu(array('theme_location' => 'navigation', 'menu_class' => 'nav bs-sidenav', 'walker' => new Custom_Walker_Nav_Menu())); ?>
    </div>
</div>