<?php
/*
Template Name: Tool Page
*/
?>

<?php 
	// get the wp header
	get_header(); 

	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
	
	// get current user 
	$user_login = $current_user->user_login;

	
	// find BACKGROUND info for current user
	$my_background_lead = null;
	$background_leads = RGFormsModel::get_leads( 6 ); // form_id=6	
	
		// loop results and return the first ONE for this user		
		foreach ($background_leads as $background_lead) {
	
			if($background_lead['9']==$user_login){
				$my_background_lead = $background_lead;
				break;
			} 
		} 

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
	
	<!-- only show the form if user HAS submitted background info, --> 
	<!-- or if this is the background info page -->
	
	<?php //if (!empty($my_background_lead) || is_page( 'background-information' )) { ?>
	<?php if (!empty($my_background_lead) || is_page( 'background-information' )) { ?>
	
		<div id="tools-supporting">
			<h2><?php echo $fields['title'] ?></h2>
			<?php if($fields['subtitle']) {
				echo "<h4>".$fields['subtitle']."</h4>";
			}?>		
			<div id="main-content">
				<?php echo $fields['main-content'] ?>
				<!-- insert form -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; else: ?>
				<?php endif; ?> 
				<!-- end form -->
			</div>
			<div class="clear"></div>
		</div>
	
	<!-- if user has NOT submitted background info -->
	<?php } else { ?>
		
		<div id="tools-supporting">
			<h2><?php echo $fields['title'] ?></h2>
			<?php if($fields['subtitle']) {
				echo "<h4>".$fields['subtitle']."</h4>";
			}?>		
			<div id="main-content">
				<h4> Background Information Not Found</h4>
				<p>Please first complete and submit background information. You can find a link to Background Information in the menu on the left. </p>
			</div>
			<div class="clear"></div>
		</div>
		
	<?php } ?>

</div>

<?php get_footer(); ?>


