<?php
/*
Template Name: All Archives
*/
?>

<?php 
	// get the wp header
	get_header();
	
	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
	
	// common urls
	$template_url = get_bloginfo('template_url');
	$base_url = get_bloginfo('url');

	// get current user 
	$user_login = $current_user->user_login;
	
?>


<div id="content" class="row">

	<!-- left sidebar-->
	<div class="sidebar left">

		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Tools Left') ) : ?>    	
			<div class="widget"></div>	
		<?php endif; ?>	

		<!-- if user is admin, add buttons to see all archives -->
		<div>
			<?php if ( current_user_can( 'manage_options' ) ) { ?>
				<h3>Admin Tools</h3>
				<a href="<?php echo $base_url ?>/tools/all-archives-ar" class='btn btn-default input-block-level' >All Assessment Reports</a>
				<br/>
				<a href="<?php echo $base_url ?>/tools/all-archives-ap" class='btn btn-default input-block-level' >All Action Plans</a>
			<?php } ?>
		</div>	

	</div>

	<!-- main content area -->
	<div id="tool-container">

	<?php if ( is_user_logged_in() ) { ?>

		<?php if ( current_user_can( 'manage_options' ) ) { ?>


			<!-- ARCHIVES -->
			<h4><?php echo $fields['title-1'] ?></h4>
			<div id="archives-box">
				<div class="mytools-row">
					<div class="rightbox">
						<h3><?php echo $fields['title-2'] ?></h3>
						
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				            <div class="article">
					            <?php the_content(__("Read More", 'organicthemes')); ?>
					            <div style="clear:both;"></div>
					            <p><?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?></p> 
					        </div>	            
			            <?php endwhile; endif; ?>

					</div>	
					<div class="clear"></div>
				</div>
			</div>

		<?php } else { ?>

			<div class="no-login-div">
				<h4>You have reached an Admin Only area.</h4>
				<span>(And you do not currently have admin privileges.)</span>
			</div>

		<?php } ?>

	<?php } else { ?>
	
		<div class="no-login-div">
			<h4>Please log in using the menu on the left.</h4>
			<p class="no-login-sub">If you do not yet have a login account, create one using the tab labeled 'register'.</p>
		</div>
				
	<?php } ?>
	
	<div class="clear"></div>
	</div>
	
</div>

<?php get_footer(); ?>

