<?php
/*
Template Name: All Archives
*/
?>

<?php 
	// get the wp header
	get_header();
	
	// get all of the Advanced Custom Fields for this page	
	$fields = get_fields();
	
	// common urls
	$template_url = get_bloginfo('template_url');
	$base_url = get_bloginfo('url');

	// get current user 
	$user_login = $current_user->user_login;
	
?>


<div id="content" class="row">

	<!-- left sidebar-->
	<div class="sidebar left">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Tools Left') ) : ?>    	
		<div class="widget"></div>		
	<?php endif; ?>	
	</div>

	<!-- main content area -->
	<div id="tool-container">
	
	<h4><?php echo $fields['title-1'] ?></h4>
	<?php if($fields['subtitle']) {
		echo "<h4>".$fields['subtitle']."</h4>";
	}?>		
	
	<?php if ( is_user_logged_in() ) { ?>


		<!-- ARCHIVES -->
		<h4><?php echo $fields['title-2'] ?></h4>
		<div id="archives-box">
			<div class="mytools-row">
				<div class="rightbox">

					<h3>Existing Archives</h3>



					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		            
		            <div class="article">
			            <?php the_content(__("Read More", 'organicthemes')); ?>
			            <div style="clear:both;"></div>
			            <p><?php edit_post_link(__("(Edit)", 'organicthemes'), '', ''); ?></p> 
			        </div>

		            
		            <?php endwhile; endif; ?>





					
					<div class="archived assessments">
						<span><b>Assessment Reports</b></span>
						<table id="assessment-reports-tbl" class="table table-bordered table-striped">
						<?php
							ini_set('error_reporting', E_ALL);
							ini_set('display_errors', 'On');  
							echo findFileRowsForUser( 'pdf-assessment-reports', 'all-users' );
						?>
						</table>
					</div>
					<div class="archived reports">
						<span><b>Action Plans</b></span>
						<table id="action-plans-tbl" class="table table-bordered table-striped">
						<?php 
							echo findFileRowsForUser( 'pdf-action-plans', 'all-users' );
						?>
						</table>
					</div>

					<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

					
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
					
					<script>
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
					
					</script>

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

