<?php
/*
Template Name: Resources Pages
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
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Resources Left') ) : ?>    	
		<div class="widget"></div>		
	<?php endif; ?>	
	</div>

	<!-- main content area -->
	<div id="resources">
		<h2><?php echo $fields['title'] ?></h2>
		<?php if($fields['subtitle']) {
			echo "<h4>".$fields['subtitle']."</h4>";
		}?>		
		<?php if($fields['main-content']) {
			echo "<div id='main-content'>".$fields['main-content']."</div>";
		}?>
	</div>
	
	
	<?php
    // for tip sheets page only
    if ( is_page('Tip Sheets') ) { ?>
        
		<div id="tipsheets-container">
			<div id="tipsheets-left">
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/tip-sheets/fruitveg.pdf">
					<img src="<?php bloginfo('template_url'); ?>/tip-sheets/tn_fruitsnveg.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/tip-sheets/physactivity.pdf">
					<img src="<?php bloginfo('template_url'); ?>/tip-sheets/tn_physact.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/tip-sheets/notransfat.pdf">
					<img src="<?php bloginfo('template_url'); ?>/tip-sheets/tn_notransfat.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/tip-sheets/sugarbev.pdf">
					<img src="<?php bloginfo('template_url'); ?>/tip-sheets/tn_sugarbev.jpg" alt="pdf"/></a>
				</div>
			</div>
			<div id="tipsheets-right">
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/tip-sheets/turnoff.pdf">
					<img src="<?php bloginfo('template_url'); ?>/tip-sheets/tn_turnoff.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/tip-sheets/water.pdf">
					<img src="<?php bloginfo('template_url'); ?>/tip-sheets/tn_water.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/tip-sheets/wholegrains.pdf">
					<img src="<?php bloginfo('template_url'); ?>/tip-sheets/tn_wholegrains.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/tip-sheets/healthy.pdf">
					<img src="<?php bloginfo('template_url'); ?>/tip-sheets/tn_healthystaff.jpg" alt="pdf"/></a>
				</div>				
			</div>
		</div>
		
    <?php } ?>
	
	<?php
    // for fast maps page only
    if ( is_page('Fast Maps') ) { ?>
        
		<div id="tipsheets-container">
			<div id="tipsheets-left">
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/fast-maps/fruitveg.pdf">
					<img src="<?php bloginfo('template_url'); ?>/fast-maps/tn_fruitveg.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/fast-maps/physact_mod.pdf">
					<img src="<?php bloginfo('template_url'); ?>/fast-maps/tn_physact_mod.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/fast-maps/physact_vig.pdf">
					<img src="<?php bloginfo('template_url'); ?>/fast-maps/tn_physact_vig.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/fast-maps/transfats.pdf">
					<img src="<?php bloginfo('template_url'); ?>/fast-maps/tn_transfats.jpg" alt="pdf"/></a>
				</div>
			</div>
			<div id="tipsheets-right">
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/fast-maps/screentime.pdf">
					<img src="<?php bloginfo('template_url'); ?>/fast-maps/tn_screentime.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/fast-maps/water.pdf">
					<img src="<?php bloginfo('template_url'); ?>/fast-maps/tn_water.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/fast-maps/wholegrains.pdf">
					<img src="<?php bloginfo('template_url'); ?>/fast-maps/tn_wholegrains.jpg" alt="pdf"/></a>
				</div>
				<div class="thumb">
					<a href="<?php bloginfo('template_url'); ?>/fast-maps/ssb.pdf">
					<img src="<?php bloginfo('template_url'); ?>/fast-maps/tn_ssb.jpg" alt="pdf"/></a>
				</div>				
			</div>
		</div>
		
    <?php } ?>
	

	<div class="clear"></div>
	
</div>

<?php get_footer(); ?>

