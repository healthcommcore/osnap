<?php
/*
Template Name: Pre-Report
*/
?>

<?php 
	// get the wp header
	get_header(); 

	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
	
	// wordpress urls
	$template_url = get_bloginfo('template_url');
	$site_url = get_site_url();
		
	// user info
	$user_login = $current_user->user_login;
		
	
	// find prev/next page in menu
	$pagelist = get_pages('sort_column=menu_order&sort_order=asc');
	$pages = array();
	foreach ($pagelist as $page) {
	   $pages[] += $page->ID;
	}
	$current = array_search(get_the_ID(), $pages);
	$prevID = $pages[$current-1];
	$nextID = $pages[$current+1];

	
	// find all PRACTICE leads 
	$practice_leads = RGFormsModel::get_leads( 4 ); // practice form_id=4
	
	// gather the first 5 (or fewer) leads for this user
	$my_practice_leads = array();
	$has_practice_lead = false;
	$total_practice_leads = 0;
	$i = 0;
	foreach ($practice_leads as $practice_lead) {
		if($practice_lead['29']==$user_login){
			array_push($my_practice_leads, $practice_lead);
			$has_practice_lead = true;
			$total_practice_leads++;
			if (++$i == 4) {break;}	
		}				
	}
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
			
			<?php if ( !is_user_logged_in() ) { ?>
				<div style="border: 1px solid gray; padding: 16px;">
					<p>&nbsp;</p>
					<h4>Please log in using the menu on the left.</h4>
					<p class="no-login-sub">If you do not yet have a login account, create one using the tab labeled 'register'.</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			<?php } else { ?>	
				<div class="goal-buttons-div">
					<div class="goal-buttons">
						<p><a href='<?php echo $site_url ?>/tools/practice-assessment/practice-assessment-create/' class='btn btn-block'>Complete another Daily Practice Self-Assessment</a></p>
						<p><a href='<?php echo $site_url ?>/tools/policy-assessment/policy-assessment-tool/' class='btn btn-block'>Complete or edit Policy Self-Assessment</a></p>
					</div>
				</div>
				<p></p>
				<div class="goal-buttons-div">
					<div class="goal-buttons">
						<?php if ( $has_practice_lead ) { ?>
							<p><a href='<?php echo $site_url ?>/tools/self-assessment-report/' class='btn btn-block'>Generate Report</a></p>						
						<?php } else { ?>			
							<div><p>Once you have completed at least one daily practice assessment, you will have the option to generate and see a report.</p></div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
		
		<div class="clear"></div>

	</div>

</div>

<?php get_footer(); ?>

