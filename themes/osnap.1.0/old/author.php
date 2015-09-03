<?php get_header(); ?>

<div id="content" class="row">

	<div class="eight columns">
	
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        
			<?php if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif; ?>
	        
			<h2 class="headline smaller"><?php echo $curauth->display_name; ?></h2>
	        
	        <?php if(function_exists('get_avatar')) { echo get_avatar($author, '120'); } ?>
	        
	        <div class="article author">
	        	
	            <h6><?php _e("Website:", 'organicthemes'); ?></h6>
	            <p><a href="<?php echo $curauth->user_url; ?>" rel="bookmark" target="_blank"><?php echo $curauth->user_url; ?></a></p>
	            
	            <h6><?php _e("Profile:", 'organicthemes'); ?></h6>
	            <p><?php echo $curauth->user_description; ?></p>
	            
	            <h6><?php _e("Posts by", 'organicthemes'); ?> <?php echo $curauth->display_name; ?>:</h6>
	            
	            <ul>
	                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	                <li>
	                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	                    <?php the_title(); ?></a>
	                </li>
	                <?php endwhile; else: ?>
	                <p><?php _e("No posts by this author.", 'organicthemes'); ?></p>
	                <?php endif; ?>
	            </ul>
	        
	        </div>
	        
	    </div>
        
	</div>
			
	<div class="four columns">
		<?php include(TEMPLATEPATH."/sidebar.php");?>
	</div>

</div>

<?php get_footer(); ?>