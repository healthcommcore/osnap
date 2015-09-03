<?php
/*
Template Name: Quick Start
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
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Quickstart Left') ) : ?>    	
		<div class="widget"></div>		
	<?php endif; ?>	
	</div>
	
	<!-- main content area -->
	<div id="quickstart-content">
	
		<div id="quickstart-content-top">
			<img src="<?php echo $fields['banner-image']; ?>" alt="background image"/>
			<div class="white-bg"></div>
			<div class="toptitle">
				<h1><?php echo $fields['title']; ?></h1>
			</div>
		</div>			
		<div class="clear"></div>
		
		<div id="quickstart-content-middle">
			<div class="callout" style="background-image:url('<?php echo $fields['callout-image'] ?>');">
				<?php echo $fields['call-out'] ?>
			</div>
			<div class="main-content">
				<?php echo $fields['main-content'] ?>
			</div>					
		</div>
		<div class="clear"></div>
		
		<div id="quickstart-content-bottom">
			<h2><?php echo $fields['bottom-content-title'] ?></h2>
			<div class="clear"></div>
			<div class="col1"><?php echo $fields['bottom-content-col1'] ?></div>
			<div class="col2"><?php echo $fields['bottom-content-col2'] ?></div>
			<div class="col3"><?php echo $fields['bottom-content-col3'] ?></div>
			<div class="clear"></div>
		</div>
		
	</div>


	

</div>

<?php get_footer(); ?>

