<?php
/*
Template Name: Tools Supporting Page
*/
?>

<?php 
	// get the wp header
	get_header(); 

	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
	
	// find prev/next page in menu
	$pagelist = get_pages('sort_column=menu_order&sort_order=asc');
	$pages = array();
	foreach ($pagelist as $page) {
	   $pages[] += $page->ID;
	}
	$current = array_search(get_the_ID(), $pages);
	$prevID = $pages[$current-1];
	$nextID = $pages[$current+1];
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
			<?php echo $fields['main-content'] ?>
			<?php echo do_shortcode( get_field('form-code') ); ?>
		</div>	
		
		<div class="clear"></div>
			
		<div class="bottom-nav">
		<?php if (!empty($prevID)) { ?>
		<!--
			<button class="btn btn-large btn-primary" type="button">
				<a href="<?php echo get_permalink($prevID); ?>"
					title="<?php echo get_the_title($prevID); ?>">Previous</a>
			</button>
		-->
		<?php }
		if (!is_page( array( 439 ) )) {
			if (!empty($nextID)) { ?>
				<span class="btn btn-large" type="button">
					<a href="<?php echo get_permalink($nextID); ?>" 
						title="<?php echo get_the_title($nextID); ?>">Next</a>
				</span>
			<?php } ?>
		<?php } ?>
		</div><!-- .bottom-nav -->
	
	</div>

</div>

<?php get_footer(); ?>

