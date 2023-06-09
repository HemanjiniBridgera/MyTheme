<?php get_header();?>

<div class="container">
    <h1><?php the_title();?></h1>
    <?php 
if(has_post_thumbnail( )):?>

    <img src="<?php the_post_thumbnail_url("blog_large");?>" alt="<?php the_title();?>"
        class="img-fluid mb-9 img-thumbnail">
    <?php endif; ?>



    <div class="row">
        <div class="col-lg-6">
            <?php get_template_part('includes/section','cars');?>

            <?php wp_link_pages();?>
        </div>
        <div class="col-lg-6">
            <?php get_template_part('includes/form','enquiry');?>

            <ul>


                <li>Colour: <?php the_field('colour');?></li>


                <li>Registration: <?php the_field('registration'); ?></li>


                <li>Price: <?php the_field('price'); ?></li>

            </ul>
        </div>
    </div>





</div>



<?php get_footer();?>