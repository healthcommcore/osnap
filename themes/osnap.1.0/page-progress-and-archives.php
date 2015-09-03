<?php
/*
Template Name: Progress Overview and Archives
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
		
	// find POLICY assessment for current user
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
	//if ($my_background_lead){ $background_row = "".
	//	"<a href='".$base_url."/tools/background-information'><div class='star-f-button'>Edit</div></a>".
	//	"<span>Completed on ".$my_background_lead['10']."</span>";
	//} else { $background_row = "".
	//	"<a href='".$base_url."/tools/background-information'><div class='star-e-button'>Start</div></a>".
	//	"<span>".$no_background_txt."</span>";
	//}
	if ($my_background_lead){ $background_row = "".
		"<a href='".$base_url."/tools/background-information' class='btn btn-default' ><i class='icon-star'></i>&nbsp;Edit</a>".
		"<span>Completed on ".$my_background_lead['10']."</span>";
	} else { $background_row = "".
		"<a href='".$base_url."/tools/background-information' class='btn btn-default' ><i class='icon-star-empty'></i>&nbsp;Start</a>".
		"<span>".$no_background_txt."</span>";
	}

	
	// PRACTICE rows
	if ($my_practice_leads[0]){ $practice_row1 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[0][id]."' class='btn btn-default' ><i class='icon-star'></i>&nbsp;Edit</a>".
		"<span>Completed on ".$my_practice_leads[0]['30']."</span>";
		} else { $practice_row1 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/' class='btn btn-default' ><i class='icon-star-empty'></i>&nbsp;Start</a>".
			"<span>".$no_assessments_txt."</span>";
		}	
	if ($my_practice_leads[1]){ $practice_row2 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[1][id]."' class='btn btn-default' ><i class='icon-star'></i>&nbsp;Edit</a>".
		"<span>Completed on ".$my_practice_leads[1]['30']."</span>";
		} else { $practice_row2 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/' class='btn btn-default' ><i class='icon-star-empty'></i>&nbsp;Start</a>".
			"<span>".$no_assessments_txt."</span>";
		}	
	if ($my_practice_leads[2]){ $practice_row3 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[2][id]."' class='btn btn-default' ><i class='icon-star'></i>&nbsp;Edit</a>".
		"<span>Completed on ".$my_practice_leads[2]['30']."</span>";
		} else { $practice_row3 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/' class='btn btn-default' ><i class='icon-star-empty'></i>&nbsp;Start</a>".
			"<span>".$no_assessments_txt."</span>";
		}	
	if ($my_practice_leads[3]){ $practice_row4 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[3][id]."' class='btn btn-default' ><i class='icon-star'></i>&nbsp;Edit</a>".
		"<span>Completed on ".$my_practice_leads[3]['30']."</span>";
		} else { $practice_row4 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/' class='btn btn-default' ><i class='icon-star-empty'></i>&nbsp;Start</a>".
			"<span>".$no_assessments_txt."</span>";
		}	
	if ($my_practice_leads[4]){ $practice_row5 = "".
		"<a href='".$base_url."/tools/practice-assessment/practice-assessment-edit/?rid=".$my_practice_leads[4][id]."' class='btn btn-default' ><i class='icon-star'></i>&nbsp;Edit</a>".
		"<span>Completed on ".$my_practice_leads[4]['30']."</span>";
		} else { $practice_row5 = "".
			"<a href='".$base_url."/tools/practice-assessment/practice-assessment-create/' class='btn btn-default' ><i class='icon-star-empty'></i>&nbsp;Start</a>".
			"<span>".$no_assessments_txt."</span>";
		}

	// POLICY row
	if ($my_policy_lead){ $policy_row = "".
		"<a href='".$base_url."/tools/policy-assessment/policy-assessment-tool/' class='btn btn-default' ><i class='icon-star'></i>&nbsp;Edit</a>".
		"<span>Completed on ".$my_policy_lead['176']."</span>";
	} else { $policy_row = "".
		"<a href='".$base_url."/tools/policy-assessment/policy-assessment-tool/' class='btn btn-default' ><i class='icon-star-empty'></i>&nbsp;Start</a>".
		"<span>".$no_assessments_txt."</span>";
	}
	
	// GOAL row		
	if ($my_goal_lead){ $goal_row = "".
		"<a href='".$base_url."/tools/self-assessment-report/#gs' class='btn btn-default' ><i class='icon-star'></i>&nbsp;Edit</a>".
		"<span>Goals selected on ".$my_goal_lead['date_created']."</span>";
	} else { $goal_row = "".
		"<a href='".$base_url."/tools/self-assessment-report/#gs' class='btn btn-default' ><i class='icon-star-empty'></i>&nbsp;Start</a>".
		"<span>".$no_goals_txt."</span>";
	}
	
	// BUILDER row
	if ($has_builder_lead){ $builder_row = "".
		"<a href='".$base_url."/tools/goals-and-planning/' class='btn btn-default' ><i class='icon-star'></i>&nbsp;Edit</a>".
		"<span>At least one Action Plan Builder was found.</span>";
	} else { $builder_row = "".
		"<span>No Action Plan Builders found. Please complete the steps above.</span>";
	}

	// ACTION PLAN row
	if ($has_action_plan){ $ap_row = "".
		"<a href='".$base_url."/tools/my-action-plan/' class='btn btn-default' ><i class='icon-star'></i>&nbsp;View</a>".
		"<span>Your Action Plan is ready.</span>";
	} else { $ap_row = "".
		"<span>No Action Plan found. Please complete the steps above.</span>";
	}

?>


<div id="content" class="row">

	<!-- left sidebar-->
	<div class="sidebar left">

		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Tools Left') ) : ?>    	
			<div class="widget"></div>	
		<?php endif; ?>	

		<!-- if user is admin, add buttons to see all archives -->
		<div>
			<?php if ( current_user_can( 'manage_options' ) ) { ?>
				<h3>Admin Tools</h3>
				<a href="<?php echo $base_url ?>/tools/all-archives-ar" class='btn btn-default input-block-level' >All Assessment Reports</a>
				<br/>
				<a href="<?php echo $base_url ?>/tools/all-archives-ap" class='btn btn-default input-block-level' >All Action Plans</a>
			<?php } ?>
		</div>	

	</div>

	<!-- main content area -->
	<div id="tool-container">
	
	<h4><?php echo $fields['title-1'] ?></h4>
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
		<!-- ARCHIVES -->
		<h4><?php echo $fields['title-2'] ?></h4>
		<div id="archives-box">
			<div class="mytools-row">
				<div class="rightbox">

					<h3>Existing Archives</h3>
					
					<div class="archived assessments">
						<span><b>Assessment Reports</b></span>
						<table id="assessment-reports-tbl" class="table table-bordered table-striped">
						<?php
							ini_set('error_reporting', E_ALL);
							ini_set('display_errors', 'On');  
							echo findFileRowsForUser( 'pdf-assessment-reports', $user_login );
						?>
						</table>
					</div>
					<div class="archived reports">
						<span><b>Action Plans</b></span>
						<table id="action-plans-tbl" class="table table-bordered table-striped">
						<?php 
							echo findFileRowsForUser( 'pdf-action-plans', $user_login );
						?>
						</table>
					</div>

					<h3>Create an Archive Set</h3>
					<p>Using the button below you can create a PDF archive of the current Assessment Report 
						and Action Plan. These PDFs can be viewed or downloaded on future visits to this site.</p>
					<p>
						<span id="archive-ar" class="btn btn-default">Archive the Current Assessment Report</span>
						<span id="archive-ap" class="btn btn-default">Archive the Current Action Plan</span>
					</p>
					

					<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
					

					<div id="archive-dialog" title="Archive Tool">
						<div class="loader"><span>Please wait. Creating PDF archive...</span></div>
						<div class="result"></div>
					</div>
					
					<div id="delete-AR-dialog" title="Delete Archive File">
						<div class="confirm-text">Are you sure you want to delete this file?
							<br><br>Once deleted, this cannot be undone.
						</div>
						<div class="result"></div>
					</div>
					
					<div id="delete-AP-dialog" title="Delete Archive File">
						<div class="confirm-text">Are you sure you want to delete this file?
							<br><br>Once deleted, this cannot be undone.
						</div>
						<div class="result">Once deleted, this cannot be undone.</div>
					</div>
					
					<!--
					<div id="reset-dialog" title="RESET ALL">
						<div class="loader">
							<span>Please wait. Finding and deleting all previous assessment reports and action plans...</span>
						</div>
						<div class="result"></div>
					</div>
					-->
					
					<script>					
					//////////////////////////////
					// Create archives
					//////////////////////////////
					
					// define the dialog
					$( "#archive-dialog" ).dialog({ 
						autoOpen:false, 
						modal:true,
						buttons: { 
							'Cancel': {
								'class': 'btn',
								text: 'Cancel',
								click: function() {
									// reset div content and button text before closing
									$( "#archive-dialog div" ).html('<span>Please wait. Creating PDF archive...</span>');
									$(".ui-dialog-buttonpane button:contains('OK')").text('Cancel');
									$(this).dialog('close');
								}
							}
						}
					});
					$( "#reset-dialog" ).dialog({ 
						autoOpen:false, 
						modal:true,
						buttons: { 
							'Cancel': {
								'class': 'btn',
								text: 'Cancel',
								click: function() {
									// reset div content and button text before closing
									$( "#reset-dialog div" ).html('<span>Please wait.  Finding and deleting all previous assessment reports and action plans...</span>');
									$(".ui-dialog-buttonpane button:contains('OK')").text('Cancel');
									$(this).dialog('close');
								}
							}
						}
					});
					
					// action when clicking on button to create Assessment Report archive 
					$( "#archive-ar" ).click(function() {
						$( "#archive-dialog" ).dialog( "open" );
						$( "#archive-dialog .loader" ).show();
						$( "#archive-dialog .result" ).load( 'http://osnap.org/wp-content/themes/osnap.1.0/pdf-assessment-reports.php?userlogin=<?php echo $user_login ?>', function() {

							// hide loader image and change cancel button text
							$(this).parent().find('.loader').hide();
							$(this).parent().parent().find('button:contains("Cancel")').text('OK'); 
							
							// get the new list of file from php tool and load into table
							$toolUrl = 'http://osnap.org/wp-content/themes/osnap.1.0/list-files.php?endDir=pdf-assessment-reports&userName=<?php echo $user_login ?>';
							$( '#assessment-reports-tbl' ).load( $toolUrl );
							
							//TODO: make sure list-files and delete-files php tools are not accessible
						});
					}); 
					
					// action when clicking on button to create Action Plan archive
					$( "#archive-ap" ).click(function() {
						$( "#archive-dialog" ).dialog( "open" );
						$( "#archive-dialog .loader" ).show();
						$( "#archive-dialog .result" ).load( "http://osnap.org/wp-content/themes/osnap.1.0/pdf-action-plans.php?userlogin=<?php echo $user_login ?>", function() {
							
							// hide loader image and change cancel button text
							$(this).parent().find('.loader').hide();
							$(this).parent().parent().find('button:contains("Cancel")').text('OK'); 
							
							// get the new list of file from php tool and load into table
							$toolUrl = 'http://osnap.org/wp-content/themes/osnap.1.0/list-files.php?endDir=pdf-action-plans&userName=<?php echo $user_login ?>';
							$( '#action-plans-tbl' ).load( $toolUrl );
						});
					});
					
					
					
					
					////////////////////////////////////////
					// Delete Action Plan archive
					////////////////////////////////////////

					// attach the action on click
					$( "body" ).on( "click", ".delete-AP-pdf", function() {
						
						// show delete button, change the text of cancel button, and set result div html
						$('.delete-AP.btn').show();
						$('.cancel-delete-AP.btn').text('Cancel'); 
						$( "#delete-AP-dialog .confirm-text" ).show();
						$( "#delete-AP-dialog .result" ).html('');
						
						// open the dialog and attach the 'this' data
						$( "#delete-AP-dialog" )
							.data( 'link', this )
							.dialog( "open" );
					});

					// define the dialog
					$( "#delete-AP-dialog" ).dialog({ 
						autoOpen:false, 
						modal:true,
						buttons: { 
							'Delete': {
								'class': 'delete-AP btn',
								text: 'Delete',
								click: function() {
								
									// get file name to delete from id of link
									var fileToDelete = $(this).data('link').id;
									
									// delete the file
									var deleteFileToolUrl = "http://osnap.org/wp-content/themes/osnap.1.0/pdf-action-plan-delete.php?filename=" + fileToDelete;
									$( "#delete-AP-dialog .result" ).load( deleteFileToolUrl, function() {
										$(this).parent().parent().find('button:contains("Delete")').hide(); 
										$(this).parent().parent().find('button:contains("Cancel")').text('OK');
										$( "#delete-AP-dialog .confirm-text" ).hide();										
									});
									
									// get the new list of file from php tool and load into table
									$toolUrl = 'http://osnap.org/wp-content/themes/osnap.1.0/list-files.php?endDir=pdf-action-plans&userName=<?php echo $user_login ?>';
									$( '#action-plans-tbl' ).load( $toolUrl );
								}
							},
							'Cancel': {
								'class': 'cancel-delete-AP btn',
								text: 'Cancel',
								click: function() {
								// reset buttons, messages and close dialog
									$(this).parent().parent().find('button:contains("Delete")').show();
									$(this).parent().parent().find('button:contains("OK")').text('Cancel');
									$(this).dialog('close');
								}
							}
						}
					});
					
					
					
					
					
					////////////////////////////////////////
					// Delete Assessment Report archive
					////////////////////////////////////////
					
					// attach the action on click
					$( "body" ).on( "click", ".delete-AR-pdf", function() {

						// show delete button, change the text of cancel button, and set result div html
						$('.delete-AR.btn').show();
						$('.cancel-delete-AR.btn').text('Cancel'); 
						$( "#delete-AR-dialog .confirm-text" ).show();
						$( "#delete-AR-dialog .result" ).html('');

						// open the dialog and attach the 'this' data
						$( "#delete-AR-dialog" )
							.data( 'link', this )
							.dialog( "open" );
					});

					// define the dialog
					$( "#delete-AR-dialog" ).dialog({ 
						autoOpen:false, 
						modal:true,
						buttons: { 
							'Delete': {
								'class': 'delete-AR btn',
								text: 'Delete',
								click: function() {
								
									// get file name to delete from id of link
									var fileToDelete = $(this).data('link').id;
									
									// delete the file
									var deleteFileToolUrl = "http://osnap.org/wp-content/themes/osnap.1.0/pdf-assessment-report-delete.php?filename=" + fileToDelete;
									$( "#delete-AR-dialog .result" ).load( deleteFileToolUrl, function() {
										$(this).parent().parent().find('button:contains("Delete")').hide(); 
										$(this).parent().parent().find('button:contains("Cancel")').text('OK'); 
										$( "#delete-AR-dialog .confirm-text" ).hide();
									});
									
									// get the new list of file from php tool and load into table
									$toolUrl = 'http://osnap.org/wp-content/themes/osnap.1.0/list-files.php?endDir=pdf-assessment-reports&userName=<?php echo $user_login ?>';
									$( '#assessment-reports-tbl' ).load( $toolUrl );
							
								}
							},
							'Cancel': {
								'class': 'cancel-delete-AR btn',
								text: 'Cancel',
								click: function() {
									// reset buttons, messages and close dialog
									$(this).parent().parent().find('button:contains("Delete")').show();
									$(this).parent().parent().find('button:contains("OK")').text('Cancel');
									$(this).dialog('close');
								}
							}
						}
					});
					

					
					</script>

				</div>	
				<div class="clear"></div>
			</div>

		</div>

		<!-- RESET 
		<h4><?php echo $fields['title-3'] ?></h4>
		<div id="archives-box">
			<div class="mytools-row">
				<div class="rightbox">
					<p>If you'd like to start a new set of assessments to generate a new report and 
						action plan, you can reset all forms using the button below.</p>
					<p>Please be sure you have created an archive of the current Assessment Report 
						and Action Plan if you want access to them at a later date.</p>
					<p>Once you click RESET ALL, all assessments, all reports, and the action plan will be 
						erased so that you can start anew. Only the Archived versions will remain.</p> 
					<div class="mytool-subrow">
						<span id="reset-all" class="btn btn-default">RESET ALL</span>
					</div>
				</div>	
				<div class="clear"></div>
			</div>
		</div>
		-->
		
		
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

