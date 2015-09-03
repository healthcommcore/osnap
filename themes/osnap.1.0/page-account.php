<?php
/**
 * Template Name: User Account
 *
 * Allow users to update their profiles/account info from Frontend.
 *
 */

/* Get user info. */
global $current_user, $wp_roles;
get_currentuserinfo();

/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();    

/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->id, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */    
	if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  Please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
            $error[] = __('This email is already in use by another user.  Please try a different one.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->id, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }
    if ( !empty( $_POST['first-name'] ) )
        update_usermeta( $current_user->id, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_usermeta($current_user->id, 'last_name', esc_attr( $_POST['last-name'] ) );

		
    /* Redirect so the page will show updated info.*/

    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->id);
        wp_redirect( get_permalink() );
        exit;
    }
}
?>



<?php get_header(); ?>

<div class="banner"><?php the_post_thumbnail( 'page' ); ?></div>

<div id="content" class="row">

	<!-- load the left sidebar widgets -->
	<div class="sidebar left">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Tools Left') ) : ?>    	
		<div class="widget"></div>		
	<?php endif; ?>	
	</div>
	

	<div class="my-account-form">

        <div <?php post_class(); ?> id="page-<?php the_ID(); ?>">
		
    
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>">
					<div class="entry-content entry">
						<?php the_content(); ?>
						<?php if ( !is_user_logged_in() ) : ?>
								<div class="warning">
									<?php _e('<h4>You must be logged in to edit your account information. Use the login form on the left to log in.</h4>', 'profile'); ?>
								</div>
						<?php else : ?>
							<?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
							<form method="post" id="adduser" action="<?php the_permalink(); ?>">
								<div class="userformleft">
									<div>
										<label for="first-name"><?php _e('First Name', 'profile'); ?></label>
										<input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'user_firstname', $current_user->id ); ?>" />
									</div>
									<div>
										<label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
										<input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'user_lastname', $current_user->id ); ?>" />
									</div>
									<div>
										<label for="email"><?php _e('E-mail', 'profile'); ?></label>
										<input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->id ); ?>" />
									</div>
								</div>
								<div class="userformright">
									<div class="form-password">
										<label for="pass1"><?php _e('New Password', 'profile'); ?> </label>
										<input class="text-input" name="pass1" type="password" id="pass1" />
									</div>
									<div class="form-password">
										<label for="pass2"><?php _e('Repeat Password', 'profile'); ?></label>
										<input class="text-input" name="pass2" type="password" id="pass2" />
									</div>
									<p>If you would like to change your password, enter a new one in the fields above. Otherwise leave these fields blank.</p>
								</div>
								<div class="clear"></div>

								<?php 
									//action hook for plugin and extra fields
									//do_action('edit_user_profile',$current_user); 
								?>
								<div class="form-submit">
									<?php echo $referer; ?>
									<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile'); ?>" />
									<?php wp_nonce_field( 'update-user' ) ?>
									<input name="action" type="hidden" id="action" value="update-user" />
								</div>
							</form>
							<br/>
							<br/>
							<br/>
						<?php endif; ?>
					</div>
				</div>
				<?php endwhile; ?>
			<?php else: ?>
				<div class="no-data">
					<?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
				</div>
			<?php endif; ?>


 
        </div>
        
    </div>

    <div class="four columns">
    	<?php //include(TEMPLATEPATH."/sidebar.php");?>
    </div>

</div>

<?php get_footer(); ?>