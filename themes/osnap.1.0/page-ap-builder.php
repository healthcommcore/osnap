<?php
/*
Template Name: Action Plan Builder
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
			echo "<span class='goal-subtitle'>".$fields['subtitle']."</span>";
		}?>		
		<!--
		<div id="main-content"><?php echo $fields['main-content'] ?></div>	
		-->
		<div id="main-content">
		<?php 
			echo apply_filters( 'the_content', $fields['form-code'] );
		?>
		</div>
		<div class="clear"></div>
			
	
	</div>

</div>

<?php get_footer(); ?>

