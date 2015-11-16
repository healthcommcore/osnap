<?php
/*
Template Name: Assessment Report
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
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Tools Left') ) : ?>    	
		<div class="widget"></div>		
	<?php endif; ?>	
	</div>

	<!-- main content area -->
	<div id="tool-container">
	
		<?php 
		// image tags
		$template_url = get_bloginfo('template_url');
		$site_url = get_site_url();
		$greencheck_url = $template_url."/images/icon-green-check.png";
		$orangemark_url = $template_url."/images/icon-orange-ex-point.png";
		$redex_url = $template_url."/images/icon-red-ex.png";

		// user info
		$user_login = $current_user->user_login;
		?>
		
		<div class="results-table" id="the-report">	
		<?php if ( is_user_logged_in() ) { ?>	
			
			<!-- start PRACTICE report -->
			<?php
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
			
			// loop these leads and find which dates didnt meet goals
			//
			$dates_g1_not_met = "";
			$dates_g2_not_met = "";
			$dates_g3_not_met = "";
			$dates_g4_not_met = "";
			$dates_g5_not_met = "";
			$dates_g6_not_met = "";
			$dates_g7_not_met = "";
			$dates_g8_not_met = "";
			$dates_g9_not_met = "";
			
			$total_g1_not_met = 0;
			$total_g2_not_met = 0;
			$total_g3_not_met = 0;
			$total_g4_not_met = 0;
			$total_g5_not_met = 0;
			$total_g6_not_met = 0;
			$total_g7_not_met = 0;
			$total_g8_not_met = 0;
			$total_g9_not_met = 0;			
			
			foreach ($my_practice_leads as $my_practice_lead) {
			
				$for_date_uk = $my_practice_lead['2'];				
				$for_date = date('m/d/Y', strtotime($for_date_uk));				

				$g1_met = $my_practice_lead['32'];
				$g2_met = $my_practice_lead['33'];
				$g3_met = $my_practice_lead['34'];
				$g4_met = $my_practice_lead['35'];
				$g5_met = $my_practice_lead['36'];
				$g6_met = $my_practice_lead['37'];
				$g7_met = $my_practice_lead['38'];
				$g8_met = $my_practice_lead['39'];
				$g9_met = $my_practice_lead['40'];
				
				if ($g1_met == 'no') {$dates_g1_not_met .= "<li>".$for_date."</li>"; $total_g1_not_met++;}
				if ($g2_met == 'no') {$dates_g2_not_met .= "<li>".$for_date."</li>"; $total_g2_not_met++;}
				if ($g3_met == 'no') {$dates_g3_not_met .= "<li>".$for_date."</li>"; $total_g3_not_met++;}
				if ($g4_met == 'no') {$dates_g4_not_met .= "<li>".$for_date."</li>"; $total_g4_not_met++;}
				if ($g5_met == 'no') {$dates_g5_not_met .= "<li>".$for_date."</li>"; $total_g5_not_met++;}
				if ($g6_met == 'no') {$dates_g6_not_met .= "<li>".$for_date."</li>"; $total_g6_not_met++;}
				if ($g7_met == 'no') {$dates_g7_not_met .= "<li>".$for_date."</li>"; $total_g7_not_met++;}
				if ($g8_met == 'no') {$dates_g8_not_met .= "<li>".$for_date."</li>"; $total_g8_not_met++;}
				if ($g9_met == 'no') {$dates_g9_not_met .= "<li>".$for_date."</li>"; $total_g9_not_met++;}

			}	
			
			// find POLICY leads for current user
			$policy_leads = RGFormsModel::get_leads( 1 ); // form_id=1
			
			// loop POLICY results and return the 1st one that matches on user-login
			$my_policy_lead = null;
			$has_policy_lead = false;
			foreach ($policy_leads as $policy_lead) {
				if($policy_lead['174']==$user_login){
					$my_policy_lead = $policy_lead;
					$has_policy_lead = true;
					break;
				}
			}
			
			if ($has_practice_lead) {
			
				$date_created = $my_policy_lead['date_created'];
				$days_per_week = $my_policy_lead['1'];
				
				$c_username = $my_policy_lead['174'];
				$c_userinfo = get_userdatabylogin($c_username);
				if($c_userinfo){
					$completed_by = $c_userinfo->first_name." ".$c_userinfo->last_name;
					$completed_on = $my_policy_lead['176'];
				}		
				
				$q3amet = $my_policy_lead['177'];
				$q3adocs = $my_policy_lead['178'];
				$q4met = $my_policy_lead['154'];
				$q4docs = $my_policy_lead['155'];
				$q5met = $my_policy_lead['156'];
				$q5docs = $my_policy_lead['157'];
				$q6met = $my_policy_lead['158'];
				$q6docs = $my_policy_lead['159'];
				$q7met = $my_policy_lead['160'];
				$q7docs = $my_policy_lead['161'];
				$q9met = $my_policy_lead['162'];
				$q9docs = $my_policy_lead['163'];
				$q10met = $my_policy_lead['164'];
				$q10docs = $my_policy_lead['165'];
				$q11met = $my_policy_lead['166'];
				$q11docs = $my_policy_lead['167'];
				$q12met = $my_policy_lead['168'];
				$q12docs = $my_policy_lead['169'];
				$q13met = $my_policy_lead['170'];
				$q13docs = $my_policy_lead['171'];
				$q14met = $my_policy_lead['172'];
				$q14docs = $my_policy_lead['173'];
				
				$has_computer = $my_policy_lead['68.1']; // "no-computer"
				$has_tv = $my_policy_lead['76.1'];
				$has_snack = $my_policy_lead['95'];

				$policy_meets_txt = $fields['policy_meets_txt'];
				$policy_meets_partial_txt1 = $fields['policy_meets_partial_txt1'];
				$policy_meets_partial_txt2 = $fields['policy_meets_partial_txt2'];
				$policy_meets_none_txt = $fields['policy_meets_none_txt'];

				// create all HELP lists / ul's
				$s1_help = "<ul>";
				$s2_help = "<ul>";
				$s3_help = "<ul>";
				$s4_help = "<ul>";
				$s5_help = "<ul>";
				$s6_help = "<ul>";
				$s7_help = "<ul>";
				$s8_help = "<ul>";
				$s9_help = "<ul>";
				
				foreach ($fields['s1_help'] as $page) { 
					$ptitle = get_the_title( $page->ID ); 
					$plink = get_page_link( $page->ID );					
					$s1_help .= "<li><a href='".$plink."#g1'>".$ptitle."</a></li>";
				}
				foreach ($fields['s2_help'] as $page) { 
					$ptitle = get_the_title( $page->ID ); 
					$plink = get_page_link( $page->ID );					
					$s2_help .= "<li><a href='".$plink."#g2'>".$ptitle."</a></li>";
				}
				foreach ($fields['s3_help'] as $page) { 
					$ptitle = get_the_title( $page->ID ); 
					$plink = get_page_link( $page->ID );					
					$s3_help .= "<li><a href='".$plink."#g3'>".$ptitle."</a></li>";
				}
				foreach ($fields['s4_help'] as $page) { 
					$ptitle = get_the_title( $page->ID ); 
					$plink = get_page_link( $page->ID );					
					$s4_help .= "<li><a href='".$plink."#g4'>".$ptitle."</a></li>";
				}
				foreach ($fields['s5_help'] as $page) { 
					$ptitle = get_the_title( $page->ID ); 
					$plink = get_page_link( $page->ID );					
					$s5_help .= "<li><a href='".$plink."#g5'>".$ptitle."</a></li>";
				}
				foreach ($fields['s6_help'] as $page) { 
					$ptitle = get_the_title( $page->ID ); 
					$plink = get_page_link( $page->ID );					
					$s6_help .= "<li><a href='".$plink."#g6'>".$ptitle."</a></li>";
				}
				foreach ($fields['s7_help'] as $page) { 
					$ptitle = get_the_title( $page->ID ); 
					$plink = get_page_link( $page->ID );					
					$s7_help .= "<li><a href='".$plink."#g7'>".$ptitle."</a></li>";
				}
				foreach ($fields['s8_help'] as $page) { 
					$ptitle = get_the_title( $page->ID ); 
					$plink = get_page_link( $page->ID );					
					$s8_help .= "<li><a href='".$plink."#g8'>".$ptitle."</a></li>";
				}
				foreach ($fields['s9_help'] as $page) { 
					$ptitle = get_the_title( $page->ID ); 
					$plink = get_page_link( $page->ID );					
					$s9_help .= "<li><a href='".$plink."#g9'>".$ptitle."</a></li>";
				}
				
				$s1_help .= "</ul>"; 
				$s2_help .= "</ul>";
				$s3_help .= "</ul>";
				$s4_help .= "</ul>";
				$s5_help .= "</ul>";
				$s6_help .= "</ul>";
				$s7_help .= "</ul>";
				$s8_help .= "</ul>";
				$s9_help .= "</ul>";
			
				// common used text strings
				$practice_meets_txt = $fields['practice_meets_txt'];	
				$practice_meets_partial_txt = $fields['practice_meets_partial_txt'];			
				$practice_meets_none_txt = $fields['practice_meets_none_txt'];
				$not_applicable_txt = $fields['not_applicable_txt']; 
				$policy_assessment_not_completed = "<div class=\'pol-ass-not-done\'><a href=\'".$site_url."/tools/policy-assessment/\'>Policy assessment</a><br/>not completed.</div>";

				?>
<?php
  /*
    * OSNAP Standards: $fields
    * practice date, met or not met $my_practice_leads;
    * policy date, met or not met $my_policy_lead;
    * 
   */
    echo '<p><strong>' . count($fields) . ' fields</strong></p>';
    //print_r($fields);
    echo '<hr />';
    /*
    $meta = GFAPI::get_form(4);
    foreach($meta['fields'] as $field) {
      print_r($field->label);
    }
     */
    //print_r($my_practice_leads[0]);
    $entries = GFAPI::get_entries(4);
    print_r($entries[0][43]);
    $dates = array();
    foreach( $my_practice_leads as $lead) {
      $dates[] = date('m/d/Y', $lead[2]);
    }
?>
<h3>Dave's report</h3>

<?php
  /*

   */
?>
				<div class="report-top">
					<div class="report-top-left">
						<h3><?php echo $fields['practice_title'] ?></h3>
						<?php echo $fields['practice_text'] ?>
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
						<td><?php echo $fields['table_head_c1'] ?></td>
						<td><?php echo 'Practice Status' ?></td>
						<td><?php echo 'Policy Status' ?></td>
					<tr>
				</thead>
				<tbody>
					<tr>
						<td class="standard"><?php echo $fields['s1'] ?></td>
						<td class="practice-status">
							<?php if ($total_g1_not_met == 0) {
								echo "<div class='fullymeets'></div>";
								echo $practice_meets_txt;
							} elseif ($total_g1_not_met == $total_practice_leads) { 
								echo "<div class=' doesntmeet'></div>";
								echo $practice_meets_none_txt."<ul>".$dates_g1_not_met."</ul>";
							} else { 
								echo "<div class='partiallymeets'></div>";
								echo $practice_meets_partial_txt."<ul>".$dates_g1_not_met."</ul>";
							} ?>
						</td>
						<td class="policy-status">
							<?php if ($q3amet=='yes') { 
								echo "<div class='fullymeets'></div>";
								echo $policy_meets_txt.$q3adocs;
							} elseif ($q3amet=='partial') { 
								echo "<div class='partiallymeets'></div>";
								echo $policy_meets_partial_txt1.$q3adocs.$policy_meets_partial_txt2.$s1_help;
							} else { 
								echo "<div class='doesntmeet'></div>";
								echo $policy_meets_none_txt.$s1_help;
							} ?>
						</td>
					</tr>
					<tr>
						<td class="standard"><?php echo $fields['s2'] ?></td>
						<td class="practice-status">
							<?php if ($total_g2_not_met == 0) {
								echo "<div class='fullymeets'></div>";
								echo $practice_meets_txt;
							} elseif ($total_g2_not_met == $total_practice_leads) { 
								echo "<div class=' doesntmeet'></div>";
								echo $practice_meets_none_txt."<ul>".$dates_g2_not_met."</ul>";
							} else { 
								echo "<div class='partiallymeets'></div>";
								echo $practice_meets_partial_txt."<ul>".$dates_g2_not_met."</ul>";
							} ?>
						</td>	
						<td class="policy-status">
							<?php if ($q4met=='yes') { 
								echo "<div class='fullymeets'></div>";
								echo $policy_meets_txt.$q4docs;
							} elseif ($q4met=='partial') { 
								echo "<div class='partiallymeets'></div>";
								echo $policy_meets_partial_txt1.$q4docs.$policy_meets_partial_txt2.$s2_help;
							} else { 
								echo "<div class='doesntmeet'></div>";
								echo $policy_meets_none_txt.$s2_help;
							} ?>
						</td>						
					</tr>
					<tr>
						<td class="standard"><?php echo $fields['s3'] ?></td>
						<td class="practice-status">
							<?php if ($total_g3_not_met == 0) {
								echo "<div class='fullymeets'></div>";
								echo $practice_meets_txt;
							} elseif ($total_g3_not_met == $total_practice_leads) { 
								echo "<div class=' doesntmeet'></div>";
								echo $practice_meets_none_txt."<ul>".$dates_g3_not_met."</ul>";
							} else { 
								echo "<div class='partiallymeets'></div>";
								echo $practice_meets_partial_txt."<ul>".$dates_g3_not_met."</ul>";
							} ?>
						</td>	
						<td class="policy-status">
							<?php if ($has_computer=="no-computer") {  
								echo "<div></div>";
								echo $not_applicable_txt;
							} elseif ($q5met=='yes') { 
								echo "<div class='fullymeets'></div>";
								echo $policy_meets_txt.$q5docs;
							} elseif ($q5met=='partial') { 
								echo "<div class='partiallymeets'></div>";
								echo $policy_meets_partial_txt1.$q5docs.$policy_meets_partial_txt2.$s3_help;
							} else { 
								echo "<div class='doesntmeet'></div>";
								echo $policy_meets_none_txt.$s3_help;
							} ?>
						</td>
					</tr>
					<tr>
						<td class="standard"><?php echo $fields['s4'] ?></td>
						<td class="practice-status">
							<?php if ($total_g4_not_met == 0) {
								echo "<div class='fullymeets'></div>";
								echo $practice_meets_txt;
							} elseif ($total_g4_not_met == $total_practice_leads) { 
								echo "<div class=' doesntmeet'></div>";
								echo $practice_meets_none_txt."<ul>".$dates_g4_not_met."</ul>";
							} else { 
								echo "<div class='partiallymeets'></div>";
								echo $practice_meets_partial_txt."<ul>".$dates_g4_not_met."</ul>";
							} ?>
						</td>
						<td class="policy-status">
							<?php if ($has_tv=="no-tv") { 
								echo "<div></div>";
								echo $not_applicable_txt;
							} elseif ($q6met=='yes') { 
								echo "<div class='fullymeets'></div>";
								echo $policy_meets_txt.$q6docs;
							} elseif ($q6met=='partial') { 
								echo "<div class='partiallymeets'></div>";
								echo $policy_meets_partial_txt1.$q6docs.$policy_meets_partial_txt2.$s4_help;
							} else { 
								echo "<div class='doesntmeet'></div>";
								echo $policy_meets_none_txt.$s4_help;
							} ?>
						</td>
					</tr>					
					<tr>
						<td class="standard"><?php echo $fields['s5'] ?></td>
						<td class="practice-status">
							<?php if ($total_g5_not_met == 0) {
								echo "<div class='fullymeets'></div>";
								echo $practice_meets_txt;
							} elseif ($total_g5_not_met == $total_practice_leads) { 
								echo "<div class=' doesntmeet'></div>";
								echo $practice_meets_none_txt."<ul>".$dates_g5_not_met."</ul>";
							} else { 
								echo "<div class='partiallymeets'></div>";
								echo $practice_meets_partial_txt."<ul>".$dates_g5_not_met."</ul>";
							} ?>
						</td>
						<td class="policy-status">
							<?php if ($has_snack != 'Yes') { 
								echo "<div></div>";
								echo $not_applicable_txt;
							} elseif ($q9met=='yes') { 
								echo "<div class='fullymeets'></div>";
								echo $policy_meets_txt.$q9docs;
							} elseif ($q9met=='partial') { 
								echo "<div class='partiallymeets'></div>";
								echo $policy_meets_partial_txt1.$q9docs.$policy_meets_partial_txt2.$s5_help;
							} else { 
								echo "<div class='doesntmeet'></div>";
								echo $policy_meets_none_txt.$s5_help;
							} ?>
						</td>
					</tr>
					<tr>
						<td class="standard"><?php echo $fields['s6'] ?></td>
						<td class="practice-status">
							<?php if ($total_g6_not_met == 0) {
								echo "<div class='fullymeets'></div>";
								echo $practice_meets_txt;
							} elseif ($total_g6_not_met == $total_practice_leads) { 
								echo "<div class=' doesntmeet'></div>";
								echo $practice_meets_none_txt."<ul>".$dates_g6_not_met."</ul>";
							} else { 
								echo "<div class='partiallymeets'></div>";
								echo $practice_meets_partial_txt."<ul>".$dates_g6_not_met."</ul>";
							} ?>
						</td>
						<td class="policy-status">
							<?php if ($has_snack != 'Yes') { 
								echo "<div></div>";
								echo $not_applicable_txt;
							} elseif ($q10met=='yes') { 
								echo "<div class='fullymeets'></div>";
								echo $policy_meets_txt.$q10docs;
							} elseif ($q10met=='partial') { 
								echo "<div class='partiallymeets'></div>";
								echo $policy_meets_partial_txt1.$q10docs.$policy_meets_partial_txt2.$s6_help;
							} else { 
								echo "<div class='doesntmeet'></div>";
								echo $policy_meets_none_txt.$s6_help;
							} ?>
						</td>
					</tr>
					<tr>
						<td class="standard"><?php echo $fields['s7'] ?></td>
						<td class="practice-status">
							<?php if ($total_g7_not_met == 0) {
								echo "<div class='fullymeets'></div>";
								echo $practice_meets_txt;
							} elseif ($total_g7_not_met == $total_practice_leads) { 
								echo "<div class=' doesntmeet'></div>";
								echo $practice_meets_none_txt."<ul>".$dates_g7_not_met."</ul>";
							} else { 
								echo "<div class='partiallymeets'></div>";
								echo $practice_meets_partial_txt."<ul>".$dates_g7_not_met."</ul>";
							} ?>
						</td>
						<td class="policy-status">
							<?php if ($has_snack != 'Yes') { 
								echo "<div></div>";
								echo $not_applicable_txt;
							} elseif ($q12met=='yes') { 
								echo "<div class='fullymeets'></div>";
								echo $policy_meets_txt.$q12docs;
							} elseif ($q12met=='partial') { 
								echo "<div class='partiallymeets'></div>";
								echo $policy_meets_partial_txt1.$q12docs.$policy_meets_partial_txt2.$s7_help;
							} else { 
								echo "<div class='doesntmeet'></div>";
								echo $policy_meets_none_txt.$s7_help;
							} ?>
						</td>
					</tr>
					<tr>
						<td class="standard"><?php echo $fields['s8'] ?></td>
						<td class="practice-status">
							<?php if ($total_g8_not_met == 0) {
								echo "<div class='fullymeets'></div>";
								echo $practice_meets_txt;
							} elseif ($total_g8_not_met == $total_practice_leads) { 
								echo "<div class=' doesntmeet'></div>";
								echo $practice_meets_none_txt."<ul>".$dates_g8_not_met."</ul>";
							} else { 
								echo "<div class='partiallymeets'></div>";
								echo $practice_meets_partial_txt."<ul>".$dates_g8_not_met."</ul>";
							} ?>
						</td>
						<td class="policy-status">
							<?php if ($has_snack != 'Yes') { 
								echo "<div></div>";
								echo $not_applicable_txt;
							} elseif ($q13met=='yes') { 
								echo "<div class='fullymeets'></div>";
								echo $policy_meets_txt.$q13docs;
							} elseif ($q13met=='partial') { 
								echo "<div class='partiallymeets'></div>";
								echo $policy_meets_partial_txt1.$q13docs.$policy_meets_partial_txt2.$s8_help;
							} else { 
								echo "<div class='doesntmeet'></div>";
								echo $policy_meets_none_txt.$s8_help;
							} ?>
						</td>
					</tr>
					<tr>
						<td class="standard"><?php echo $fields['s9'] ?></td>
						<td class="practice-status">
							<?php if ($total_g9_not_met == 0) {
								echo "<div class='fullymeets'></div>";
								echo $practice_meets_txt;
							} elseif ($total_g9_not_met == $total_practice_leads) { 
								echo "<div class=' doesntmeet'></div>";
								echo $practice_meets_none_txt."<ul>".$dates_g9_not_met."</ul>";
							} else { 
								echo "<div class='partiallymeets'></div>";
								echo $practice_meets_partial_txt."<ul>".$dates_g9_not_met."</ul>";
							} ?>
						</td>
						<td class="policy-status">
							<?php if ($has_snack != 'Yes') { 
								echo "<div></div>";
								echo $not_applicable_txt;
							} elseif ($q14met=='yes') { 
								echo "<div class='fullymeets'></div>";
								echo $policy_meets_txt.$q14docs;
							} elseif ($q14met=='partial') { 
								echo "<div class='partiallymeets'></div>";
								echo $policy_meets_partial_txt1.$q14docs.$policy_meets_partial_txt2.$s9_help;
							} else { 
								echo "<div class='doesntmeet'></div>";
								echo $policy_meets_none_txt.$s9_help;
							} ?>
						</td>
					</tr>					
				</tbody>
				</table>


				<!-- define jq function to hide policy divs if policy assessment hasn't been done -->
				<?php if (!$has_policy_lead) { ?>
					<script>$('td.policy-status').html('<?php echo $policy_assessment_not_completed ?>');</script>	
				<?php } ?>
				
			<?php				
			} else { ?>
				<div class="assessment-not-done">
					<h4>No daily practice self-assessments have been completed.</h4>
					<p>Use the menu on the left to explore the introduction and 'Getting Started', 
					or jump to <a href="<?php echo $site_url ?>/tools/practice-assessment/practice-assessment-create/">the practice self-assessment</a>.</p>
				</div>		
			<?php } ?>			
			
			<!-- bottom form area -->
			<div class="goals-form">
			<?php if ($has_practice_lead) { ?>				
				<div class="report-top">
					<h3><?php echo $fields['action_title'] ?></h3>
				</div>	
				<!-- insert form -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; else: ?>
				<?php endif; ?> 
			<?php } ?>
			</div>
			<!-- end bottom form area -->			
		
		<?php } else {	?><!-- user is not logged in -->		
			<p>&nbsp;</p>
			<h4>Please log in using the menu on the left.</h4>
			<p class="no-login-sub">If you do not yet have a login account, create one using the tab labeled 'register'.</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>		
		<?php } ?>
		
		</div>		
	</div>
</div>


<?php get_footer(); ?>
