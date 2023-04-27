<?php get_header();?>

<div class="container">
    <?php 
if(has_post_thumbnail( )):?>

    <img src="<?php the_post_thumbnail_url("blog_small");?>" alt="<?php the_title();?>"
        class="img-fluid mb-9 img-thumbnail">
    <?php endif; ?>

    <h1><?php the_title();?></h1>



    <?php get_template_part('includes/section','blogcontent');?>

    <?php wp_link_pages();?>

</div>



<?php get_footer();?>