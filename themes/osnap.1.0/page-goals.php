<?php
/*
Template Name: Goals and Planning
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

	
		// get the form meta for the GOALS AND PLANNING form 
		$form = RGFormsModel::get_form_meta( 7 );
		// get the field with the checkboxed goals
		$field = RGFormsModel::get_field($form, 2);
		// get the labels for each option in that field
		$label_s1 = $field["choices"][0]["text"];
		$label_s2 = $field["choices"][1]["text"];
		$label_s3 = $field["choices"][2]["text"];
		$label_s4 = $field["choices"][3]["text"];
		$label_s5 = $field["choices"][4]["text"];
		$label_s6 = $field["choices"][5]["text"];
		$label_s7 = $field["choices"][6]["text"];
		$label_s8 = $field["choices"][7]["text"];
		$label_s9 = $field["choices"][8]["text"];		

		
		// find GOALS leads for current user
		$goal_leads = RGFormsModel::get_leads( 7 ); // form_id=7
		
		// loop GOALS results and return the 1st lead that matches on user-login
		$my_goal_lead = null;
		$has_goal_lead = false;
		foreach ($goal_leads as $goal_lead) {
			if($goal_lead['4']==$user_login){
				$my_goal_lead = $goal_lead;
				$has_goal_lead = true;
				break;
			}
		}
		
		// find which goals were checked/selected in this lead			
		$buttons_div = "<div class='goal-buttons-div'>";
		if ($my_goal_lead['2.1']) {
			$buttons_div = $buttons_div."<p><a href='".$site_url."/tools/action-plan-builder/mod-pa/' class='btn btn-block'>".$label_s1."</a></p>";
		}
		if ($my_goal_lead['2.2']) {
			$buttons_div = $buttons_div."<p><a href='".$site_url."/tools/action-plan-builder/vig-pa/' class='btn btn-block'>".$label_s2."</a></p>";
		}
		if ($my_goal_lead['2.3']) {
			$buttons_div = $buttons_div."<p><a href='".$site_url."/tools/action-plan-builder/screen-time/' class='btn btn-block'>".$label_s3."</a></p>";
		}
		if ($my_goal_lead['2.4']) {
			$buttons_div = $buttons_div."<p><a href='".$site_url."/tools/action-plan-builder/screen-time/' class='btn btn-block'>".$label_s4."</a></p>";
		}
		if ($my_goal_lead['2.5']) {
			$buttons_div = $buttons_div."<p><a href='".$site_url."/tools/action-plan-builder/veg/' class='btn btn-block'>".$label_s5."</a></p>";
		}
		if ($my_goal_lead['2.6']) {
			$buttons_div = $buttons_div."<p><a href='".$site_url."/tools/action-plan-builder/grains/' class='btn btn-block'>".$label_s6."</a></p>";
		}
		if ($my_goal_lead['2.7']) {
			$buttons_div = $buttons_div."<p><a href='".$site_url."/tools/action-plan-builder/no-ssb-int/' class='btn btn-block'>".$label_s7."</a></p>";
		}
		if ($my_goal_lead['2.8']) {
			$buttons_div = $buttons_div."<p><a href='".$site_url."/tools/action-plan-builder/water/' class='btn btn-block'>".$label_s8."</a></p>";
		}
		if ($my_goal_lead['2.9']) {
			$buttons_div = $buttons_div."<p><a href='".$site_url."/tools/action-plan-builder/no-ssb-ext/' class='btn btn-block'>".$label_s9."</a></p>";
		}		
		$buttons_div = $buttons_div."</div>";

	//}		
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
			<?php } elseif (!$has_goal_lead) { ?>	
				<div style="border: 1px solid gray; padding: 16px;">
					<h4>No Action Plan Builders found.</h4>
					<p>You must first complete one practice self-assessment at minimum, and then from
					the generated report select up to 3 goals you'd like to work on.</p>
					<p>If you've already completed the policy self-assessment, go to 
					<a href='<?php echo $site_url ?>/tools/self-assessment-report/'>The Report</a> now.</p>
				</div>
			<?php } else { ?>			
				<div class="goal-buttons">
					<h2><?php echo $fields['buttons-header'] ?></h2>
					<?php echo $buttons_div ?>				
				</div>
				<div class="goal-buttons">
					<p></p>
					<p>For a more complete action plan, answer all questions in each section above. When you are ready to see your generated action plan, click below.</p>
					<div class='goal-buttons-div'>
						<p><a href='<?php echo $site_url ?>/tools/my-action-plan/' class='btn btn-block'>My Action Plan</a></p>
					</div>
				</div>
			<?php } ?>
		</div>
		
		<div class="clear"></div>

	</div>

</div>

<?php get_footer(); ?>

