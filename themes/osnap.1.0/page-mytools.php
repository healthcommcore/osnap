<?php
/*
Template Name: My Tools Page
*/
?>

<?php 
	// get the wp header
	get_header();
	
	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
	
	// common urls and image tags
	$template_url = get_bloginfo('template_url');
	$base_url = get_bloginfo('url');
	$to_do_list = $template_url."/images/to-do-list_checked3.png";
	
	// re-used text strings
	$no_background_txt = "<p>You have not yet completed the Background Information.</p>";
	$no_assessments_txt = "<p>You have not yet taken this assessment.</p>";
	$no_report_txt = "<p>You have not yet generated an assessment report. First complete a practice assessment at minimum, and then generate a report.</p>";
	$no_goals_txt = "<p>You have not yet selected goals. Once an assessment report is generated, you can select goals to add to your Action Plan.</p>";
	
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
		
	// find daily PRACTICE assesments for current user
	$my_practice_leads = array(); // an array of leads
	$practice_leads = RGFormsModel::get_leads( 4 ); // form_id=4	
		// loop results and return the first FIVE for this user
		foreach ($practice_leads as $practice_lead) {
			if($practice_lead['29']==$user_login){
				array_push($my_practice_leads, $practice_lead);
			} 
		}
		// All practice assessments for this user are now in an array. 
		// We'll use only [0]-[4].
		
	// find POLICY assesment for current user
	$my_policy_lead = null;
	$policy_leads = RGFormsModel::get_leads( 1 ); 	
		// loop results and return the first ONE for this user		
		foreach ($policy_leads as $policy_lead) {
			if($policy_lead['174']==$user_login){
				$my_policy_lead = $policy_lead;
				break;
			} 
		} 

	// find GOAL leads for current user
	$my_goal_lead = null;
	$goal_leads = RGFormsModel::get_leads( 7 );		
		// loop GOALS results and return the 1st lead that matches on user-login		
		foreach ($goal_leads as $goal_lead) {
			if($goal_lead['4']==$user_login){
				$my_goal_lead = $goal_lead;
				break;
			}
		}

	// find only if current user has any BUILDER leads
	$has_builder_lead = false;
	$builder_form_ids = array(8,10,16,17,18,19,20,21,22);
	foreach ($builder_form_ids as $form_id) {
		// get all leads for that form id
		$builder_leads = RGFormsModel::get_leads( $form_id ); 		
		// get form meta for that form id, to use for matching on user-login
		$builder_form_meta = RGFormsModel::get_form_meta( $form_id );
		// get leads that match on user-login
		$user_field_id = get_field_id_by_label('user-login', $builder_form_meta);	
		foreach ($builder_leads as $builder_lead) {
			if ($builder_lead[$user_field_id] == $user_login){
				$has_builder_lead = true;
				break;
			}
		}
	}
	
	// if user has builder leads, then they will have an ACTION PLAN
	$has_action_plan = $has_builder_lead;
	
	
	// ROWS //////////////////////////////////////////////////////		
	// BACKGROUND row 	
	if ($my_background_lead){ $background_row = "".
		"<a href='".$base_url."/tools/background-information'><div class='star-f-button'>Edit</div></a>".
		"<span>Completed on ".$my_background_lead['10']."</span>";
	} else { $background_row = "".
		"<a href='".$base_url."/tools/background-information'><div class='star-e-button'>Start</div></a>".
		"<span>".$no_background_txt."</span>";
	}
	
	// PRACTICE rows
	if ($my_practice_leads[0]){ $practice_row1 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[0][id]."'><div class='star-f-button'>Edit</div></a>".
		"<span>Completed on ".$my_practice_leads[0]['30']."</span>";
		} else { $practice_row1 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/'><div class='star-e-button'>Start</div></a>".
			"<span>".$no_assessments_txt."</span>";
		}	
	if ($my_practice_leads[1]){ $practice_row2 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[1][id]."'><div class='star-f-button'>Edit</div></a>".
		"<span>Completed on ".$my_practice_leads[1]['30']."</span>";
		} else { $practice_row2 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/'><div class='star-e-button'>Start</div></a>".
			"<span>".$no_assessments_txt."</span>";
		}	
	if ($my_practice_leads[2]){ $practice_row3 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[2][id]."'><div class='star-f-button'>Edit</div></a>".
		"<span>Completed on ".$my_practice_leads[2]['30']."</span>";
		} else { $practice_row3 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/'><div class='star-e-button'>Start</div></a>".
			"<span>".$no_assessments_txt."</span>";
		}	
	if ($my_practice_leads[3]){ $practice_row4 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[3][id]."'><div class='star-f-button'>Edit</div></a>".
		"<span>Completed on ".$my_practice_leads[3]['30']."</span>";
		} else { $practice_row4 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/'><div class='star-e-button'>Start</div></a>".
			"<span>".$no_assessments_txt."</span>";
		}	
	if ($my_practice_leads[4]){ $practice_row5 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[4][id]."'><div class='star-f-button'>Edit</div></a>".
		"<span>Completed on ".$my_practice_leads[4]['30']."</span>";
		} else { $practice_row5 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/'><div class='star-e-button'>Start</div></a>".
			"<span>".$no_assessments_txt."</span>";
		}

	// POLICY row
	if ($my_policy_lead){ $policy_row = "".
		"<a href='".$base_url."/tools/policy-assessment/policy-assessment-tool/'><div class='star-f-button'>Edit</div></a>".
		"<span>Completed on ".$my_policy_lead['176']."</span>";
	} else { $policy_row = "".
		"<a href='".$base_url."/tools/policy-assessment/policy-assessment-tool/'><div class='star-e-button'>Start</div></a>".
		"<span>".$no_assessments_txt."</span>";
	}
	
	// GOAL row		
	if ($my_goal_lead){ $goal_row = "".
		"<a href='".$base_url."/tools/self-assessment-report/#gs'><div class='star-f-button'>Edit</div></a>".
		"<span>Goals selected on ".$my_goal_lead['date_created']."</span>";
	} else { $goal_row = "".
		"<a href='".$base_url."/tools/self-assessment-report/#gs'><div class='star-e-button'>Start</div></a>".
		"<span>".$no_goals_txt."</span>";
	}
	
	// BUILDER row
	if ($has_builder_lead){ $builder_row = "".
		"<a href='".$base_url."/tools/goals-and-planning/'><div class='star-f-button'>Edit</div></a>".
		"<span>At least one Action Plan Builder was found.</span>";
	} else { $builder_row = "".
		"<div class='star-e-button'>Start</div>".
		"<span>No Action Plan Builders found. Please complete the steps above.</span>";
	}

	// ACTION PLAN row
	if ($has_action_plan){ $ap_row = "".
		"<a href='".$base_url."/tools/my-action-plan/'><div class='star-f-button'>View</div></a>".
		"<span>Your Action Plan is ready.</span>";
	} else { $ap_row = "".
		"<div class='star-e-button'>Start</div>".
		"<span>No Action Plan found. Please complete the steps above.</span>";
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
	<div id="tool-container">
	
	<h2><?php echo $fields['title'] ?></h2>
	<?php if($fields['subtitle']) {
		echo "<h4>".$fields['subtitle']."</h4>";
	}?>		
	
	<?php if ( is_user_logged_in() ) { ?>

		<div id="mytools">	
			
			<div class="mytools-row">
				<div class="leftbox">
					<img src="<?php echo $to_do_list ?>"/>
				</div>
				<div class="rightbox">
					<h3>Background Information</h3>
					<div class="mytool-subrow"><?php echo $background_row ?></div>
				</div>	
				<div class="clear"></div>
			</div>
			
			<div class="mytools-row">
				<div class="leftbox">
					<img src="<?php echo $to_do_list?>"/>
				</div>
				<div class="rightbox">
					<h3>Daily Practice Self Assessments</h3>
					<div class="mytool-subrow"><?php echo $practice_row1 ?></div>
					<div class="mytool-subrow"><?php echo $practice_row2 ?></div>
					<div class="mytool-subrow"><?php echo $practice_row3 ?></div>
					<div class="mytool-subrow"><?php echo $practice_row4 ?></div>
					<div class="mytool-subrow"><?php echo $practice_row5 ?></div>
				</div>	
				<div class="clear"></div>
			</div>
			
			<div class="mytools-row">
				<div class="leftbox">
					<img src="<?php echo $to_do_list ?>"/>
				</div>
				<div class="rightbox">
					<h3>Policy Self Assessment</h3>
					<div class="mytool-subrow"><?php echo $policy_row ?></div>
				</div>	
				<div class="clear"></div>
			</div>
			
			<div class="mytools-row">
				<div class="leftbox">
					<img src="<?php echo $to_do_list ?>"/>
				</div>
				<div class="rightbox">
					<h3>Assessment Report and Goal Selection</h3>
					<div class="mytool-subrow"><?php echo $goal_row ?></div>
				</div>
				<div class="clear"></div>			
			</div>
			
			<div class="mytools-row">
				<div class="leftbox">
					<img src="<?php echo $to_do_list ?>"/>
				</div>
				<div class="rightbox">
					<h3>Action Plan Builders</h3>
					<div class="mytool-subrow"><?php echo $builder_row ?></div>
				</div>
				<div class="clear"></div>			
			</div>
			
			<div class="mytools-row">
				<div class="leftbox">
					<img src="<?php echo $to_do_list ?>"/>
				</div>
				<div class="rightbox">
					<h3>Action Plan</h3>
					<div class="mytool-subrow"><?php echo $ap_row ?></div>
				</div>
				<div class="clear"></div>			
			</div>
			
		</div>
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

