<?php
/*
Template Name: Action Plan TEST
*/
?>

<?php 
	// get the wp header
	get_header(); 
	
	// wordpress urls
	$template_url = get_bloginfo('template_url');
	$site_url = get_site_url();
		
	// user info
	$user_login = $current_user->user_login;

?>

<div id="content" class="row">

	<!-- load the left sidebar widgets -->
	<div class="sidebar left">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Tools Left') ) : ?>    	
		<div class="widget"></div>		
	<?php endif; ?>	
	</div>

	<!-- main content area -->
	<div id="tools-supporting">
		<h2><?php echo $fields['title'] ?></h2>
		<?php if($fields['subtitle']) {
			echo "<h4>".$fields['subtitle']."</h4>";
		}?>		
		<div id="main-content">
			<div style="border: 3px solid gray">
				<?php 
					$formid = '47';
					echo apply_filters( 'the_content',' [gravityform id='.$formid.' field_values="people=blahblah" single="true"] ');
				?>
			</div>

		</div>
		
		<div class="clear"></div>

	</div>

</div>

<?php get_footer(); ?>

