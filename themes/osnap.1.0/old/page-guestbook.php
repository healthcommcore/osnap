<?php
/*
Template Name: Guestbook
*/
?>

<?php get_header(); ?>

<div class="banner"><?php the_post_thumbnail( 'page' ); ?></div>

<div id="content" class="row">

	<div class="eight columns">

        <div <?php post_class(); ?> id="page-<?php the_ID(); ?>">
    
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h1 class="headline page"><?php the_title(); ?></h1>
            
            <div class="article">
	            <?php the_content(__("Read More", 'organicthemes')); ?>
	            <div style="clear:both;"></div>
	            <p><?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?></p>
            </div>
            
            <div class="postcomments">
            	<?php comments_template('',true); ?>
            </div>
            
            <?php endwhile; else: ?>
            
            <p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>
			
			<?php endif; ?>
            
        </div>
        
    </div>

    <div class="four columns">
    	<?php include(TEMPLATEPATH."/sidebar.php");?>
    </div>

</div>

<?php get_footer(); ?>