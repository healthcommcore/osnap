<?php
/*
Template Name: About Pages
*/
?>

<?php 
	// get the wp header
	get_header(); 

	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
?>


<div id="content" class="row">

	<!-- load the left sidebar widgets -->
	<div class="sidebar left">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('About Left') ) : ?>    	
		<div class="widget"></div>		
	<?php endif; ?>	
	</div>

	<!-- main content area -->
	<div id="about">
		<h2><?php echo $fields['title'] ?></h2>
		<?php if($fields['subtitle']) {
			echo "<h4>".$fields['subtitle']."</h4>";
		}?>		
		<div id="main-content"><?php echo $fields['main-content'] ?></div>		
	</div>
	
</div>

<?php get_footer(); ?>

