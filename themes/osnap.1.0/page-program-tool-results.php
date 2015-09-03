<?php
/*
Template Name: Program Obs. Tool Results
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
	
		<h2><?php echo $fields['title'] ?></h2>
		<?php if($fields['subtitle']) {
			echo "<h4>".$fields['subtitle']."</h4>";
		}?>	
	
		<?php 		
		// image tags
		$template_url = get_bloginfo('template_url');
		$greencheck_url = $template_url."/images/icon-green-check.png";
		$orangemark_url = $template_url."/images/icon-orange-ex-point.png";
		$redex_url = $template_url."/images/icon-red-ex.png";
		
		//user info
		$user_login = $current_user->user_login;
		
		// find leads for current user
		//function get_leads($form_id, $sort_field_number=0, $sort_direction='DESC', $search='', $offset=0, $page_size=30, $star=null, $read=null, $is_numeric_sort = false, $start_date=null, $end_date=null, $status='active')

		$leads = RGFormsModel::get_leads( 1, 0, 'DESC', $user_login);

		
		//<?php if ($entry_count > 0) { code hidden here... }; 
		
		
		

		
		
		
		?>

		
		<div class="results-table">
		
		<!-- only write out the results table if results were found -->
		<?php if ($results_found == 'false') {
			echo "<div class='no-results'><p><b>No results were found for your IP</b> (".$ip .")</p>";
			echo "<p>&nbsp;</p>";
			echo "<p>You must first complete the interview questions. </p>";
			echo "<p>Use the link to the left to start the interview, and make sure to click submit when you are done.</p></div>";
		} else {
		?>
		
		<table class="table table-striped" >
			<thead>
				<tr>
					<td>OSNAP Standard</td>
					<td>Policy Status</td>
				<tr>
			</thead>
			<tbody>
				<tr>
					<td class="standard">Include 30 minutes of moderate physical activity for every child every day (include outdoor activity if possible).</td>
					<td>
						<?php if ($eq03a==2) { 
							//echo "<img alt='check mark' src='".$greencheck_url."' />";
							echo "<div class='fullymeets'></div>";
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs03;
						} elseif ($eq03a==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs03;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-physical-activity/'>Physical Activity section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";
						} ?>
					</td>
				</tr>
				<tr>
					<td class="standard">Offer 20 minutes of vigorous physical activity 3 times per week.</td>
					<td>
						<?php if ($eq04==2) {
							echo "<div class='fullymeets'></div>";						
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs04;
						} elseif ($eq04==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs04;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-physical-activity/'>Physical Activity section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";					
						} ?>
					</td>			
				</tr>
				<tr>
					<td class="standard">Eliminate use of commercial broadcast TV/movies.</td>
					<td>
						<?php if ($eq05==9) { 
							echo "<p>Not applicable for your program.</p>";
						} elseif ($eq05==2) { 
							echo "<div class='fullymeets'></div>";
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs05;
						} elseif ($eq05==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs05;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-screen-time/'>Screen Time section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";						
						} ?>
					</td>
				</tr>
				<tr>
					<td class="standard">Limit computer and digital device time to homework or instructional only.</td>
					<td>
						<?php if ($eq06==9) { 
							echo "<p>Not applicable for your program.</p>";
						} elseif ($eq06==2) { 
							echo "<div class='fullymeets'></div>";
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs06;
						} elseif ($eq06==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs06;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-screen-time/'>Screen Time section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";						
						} ?>
					</td>
				</tr>
				
				<?php if ($q0801=='Y') { ?>
					<tr>
						<td class="standard">Offer a fruit or vegetable option every day at snack.</td>
						<td>
						<?php if ($eq09==2) { 
							echo "<div class='fullymeets'></div>";
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs09;
						} elseif ($eq09==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs09;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-snacks/'>Snacks section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";						
						} ?>
						</td>
					</tr>
					<tr>
						<td class="standard">When serving grains, serve whole grains.</td>
						<td>
						<?php if ($eq10==2) { 
							echo "<div class='fullymeets'></div>";
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs10;
						} elseif ($eq10==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs10;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-snacks/'>Snacks section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";						
						} ?>
						</td>
					</tr>
					<tr>
						<td class="standard">Do not serve foods with trans fats. </td>
						<td>
						<?php if ($eq11==2) { 
							echo "<div class='fullymeets'></div>";
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs11;
						} elseif ($eq11==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs11;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-snacks/'>Snacks section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";						
						} ?>
						</td>
					</tr>
					<tr>
						<td class="standard">Do not serve  sugar-sweetened drinks.</td>
						<td>
						<?php if ($eq12==2) {
							echo "<div class='fullymeets'></div>";						
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs12;
						} elseif ($eq12==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs12;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-snacks/'>Snacks section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";						
						} ?>
						</td>
					</tr>
					<tr>
						<td class="standard">Offer water as a beverage at snack every day.</td>
						<td>
						<?php if ($eq13==2) {
							echo "<div class='fullymeets'></div>";
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs13;
						} elseif ($eq13==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs13;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-snacks/'>Snacks section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";						
						} ?>
						</td>
					</tr>
					<tr>
						<td class="standard">Do not allow sugar-sweetened drinks to be brought in from outside the snack program.</td>
						<td>
						<?php if ($eq14==2) { 
							echo "<div class='fullymeets'></div>";
							echo "<p>Meets goals, as written in the following document(s):</p>";
							echo $docs14;
						} elseif ($eq14==1) { 
							echo "<div class='partiallymeets'></div>";
							echo "<p>Partially meets goals, as written in the following document(s):</p>";
							echo $docs14;
						} else { 
							echo "<div class='doesntmeet'></div>";
							echo "<p>Does not meet these goals. Find specific help in the 
							<a target='_blank' href='/clients/osnap/resources/policy-writing-guide/policy-language-snacks/'>Snacks section</a> 
							of our <a target='_blank' href='/clients/osnap/resources/policy-writing-guide/'>Policy Writing Guide</a>.</p>";						
						} ?>
						</td>
					</tr>					
				
				<?php } else { ?>
					<tr>
						<td class="standard">NOTE: All snack related standards have been skipped because they do not apply to your program.</td>
						<td></td>
					</tr>
				<?php } ?>
  
	
			</tbody>
		</table>
		
		</div>
		
		<div id="date-and-ip">
			<p>This report generated from an interview completed 
			<b><?php echo $datestamp ?></b> 
			<br/>from a device with the IP address
			<b><?php echo $ipaddr ?></b>.</p>
		</div>
		
		<?php } ?>
		
	</div>
	
</div>


<?php get_footer(); ?>

