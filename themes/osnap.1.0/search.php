<?php get_header(); ?>

<div id="content" class="row">

	<div class="two columns">
		<?php include(TEMPLATEPATH."/sidebar-left.php");?>
	</div>
	
	<div class="six columns">
	
		<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>

			<div class="article archive">
			
	            <h2 class="headline smaller"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	            <h6 class="text-date"><?php the_time(__("l, F j, Y", 'organicthemes')); ?></h6>
	                
				<?php if ( $video ) : ?>
	                <div class="featurevid"><?php echo $video; ?></div>
	            <?php else: ?>
	                <a class="featureimg" href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail( 'category-thumbnail' ); ?></a>
	            <?php endif; ?>
			
            	<?php the_excerpt(); ?>
            	<p><a class="more-link" href="<?php the_permalink() ?>" rel="bookmark"><?php _e("Read More", 'organicthemes'); ?></a></p>
            	
            </div>

			<?php endwhile; else: ?>         
            <p><?php _e("Sorry, no posts matched your criteria. ", 'organicthemes'); ?></p>
			<?php endif; ?>
            
            <div class="pagination">
            	<?php if (function_exists("number_paginate")) { number_paginate(); } ?>
            </div>

        </div>
        
    </div>

	<div class="four columns">
		<?php include(TEMPLATEPATH."/sidebar.php");?>
	</div>
	
</div>

<?php get_footer(); ?>