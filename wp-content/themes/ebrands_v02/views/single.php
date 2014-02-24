<div class="col-lg-9">
    <?php while (have_posts()) : the_post(); ?>
    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php the_content(); ?>
    </div>
    <?php endwhile; ?>
    <?php global $post; echo $ebrands->portfolio->display($post->post_name); ?>
</div>