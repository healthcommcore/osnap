<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

<div class="banner"><?php the_post_thumbnail( 'page' ); ?></div>

<div id="content" class="row">

	<div class="eight columns">

        <div <?php post_class(); ?> id="page-<?php the_ID(); ?>">
							
			<?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_blog'),'posts_per_page'=>of_get_option('postnumber_blog'),'paged'=>$paged)); ?>
			<?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>
            <?php global $more; $more = 0; ?>
            
            <div class="article blog">
            
				<h1 class="headline"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	            
	            <div class="postauthor">
	            	<p><?php _e("Posted by", 'organicthemes'); ?> <?php the_author_posts_link(); ?> <?php _e("on", 'organicthemes'); ?> <?php the_time(__("F j, Y", 'organicthemes')); ?> &middot; <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Leave a Comment", 'organicthemes'), __("1 Comment", 'organicthemes'), __("% Comments", 'organicthemes')); ?></a> &nbsp; <?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?></p>      
	            </div>
	            
	            <?php if(of_get_option('display_feature_blog') == '1') { ?>
	                <?php if ( $video ) : ?>
	                	<div class="featurevid"><?php echo $video; ?></div>
	                <?php else: ?>
	                    <a class="featureimg" href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail( 'post' ); ?></a>
	                <?php endif; ?> 
	            <?php } else { ?>
	            <?php } ?>
            
	            <?php the_content(__("Read More", 'organicthemes')); ?>
	            
	            <?php if(of_get_option('display_social_blog') == '1') { ?>
	            <div class="social">
	            	<div class="like_btn">
	            	  	<div class="fb-like" href="<?php echo urlencode(get_permalink($post->ID)); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
	            	</div>
	            	<div class="tweet_btn">
	            		<a href="http://twitter.com/share" class="twitter-share-button"
	            		data-url="<?php the_permalink(); ?>"
	            		data-via="<?php echo of_get_option('twitter_user'); ?>"
	            		data-text="<?php the_title(); ?>"
	            		data-related=""
	            		data-count="horizontal"><?php _e("Tweet", 'organicthemes'); ?></a>
	            	</div>
	            	<div class="plus_btn">
	            		<g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone>
	            	</div>
	            </div>
	            <?php } else { ?>
	            <?php } ?>
            				
				<div class="postmeta">
					<p><?php _e("Category:", 'organicthemes'); ?> <?php the_category(', ') ?> &middot; <?php _e("Tags:", 'organicthemes'); ?> <?php the_tags('') ?></p>
				</div>
			
			</div>
							
			<?php endwhile; ?>
			
			<div class="pagination">
            	<?php if (function_exists("number_paginate")) { number_paginate(); } ?>
            </div>
            
            <?php else : // do not delete ?>

            <h3><?php _e("Page Not Found", 'organicthemes'); ?></h3>
            <p><?php _e("We're sorry, but the page you're looking for isn't here.", 'organicthemes'); ?></p>
            <p><?php _e("Try searching for the page you are looking for or using the navigation in the header or sidebar", 'organicthemes'); ?></p>

			<?php endif; // do not delete ?>
		
		</div>
		
	</div>
    
    <div class="four columns">
    	<?php include(TEMPLATEPATH."/sidebar.php");?>
    </div>
		
</div>

<?php get_footer(); ?>