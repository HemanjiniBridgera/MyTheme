<?php if(have_posts()): while(have_posts()): the_post();?>

<div class="card mb-3">

    <div class="card-body">
        <?php 
if(has_post_thumbnail( )):?>

        <img src="<?php the_post_thumbnail_url("blog_small");?>" alt="<?php the_title();?>"
            class="img-fluid mb-9 img-thumbnail">
        <?php endif; ?>

        <h3><?php the_title();?></h3>

        <?php the_excerpt();?>

        <a href="<?php the_permalink();?>" class="btn btn-sucess"> Read More </a>
    </div>
</div>



<?php endwhile; else: ?>
There are no results for "<?php echo get_search_query();?>"
<?php endif;?>