    </div> <!-- End div.row -->
    <div class="row">
        <div class="col-lg-9 col-offset-3">
            <?php wp_nav_menu(array('theme_location' => 'footer')); ?>
        </div>
    </div>
</div> <!-- End div.container -->
</body>
</html>
<?php echo $ebrands->conditional->get('js_foot'); ?>
<!-- Start wp_footer() -->
<?php wp_footer(); ?>
<!-- End wp_footer() -->
</body>