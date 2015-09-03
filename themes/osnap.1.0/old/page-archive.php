<?php
/*
Template Name: Site Archives
*/
?>

<?php get_header(); ?>

<div id="content" class="row">

	<div class="eight columns">

        <div <?php post_class(); ?> id="page-<?php the_ID(); ?>">
    
			<h1 class="headline page"><?php the_title(); ?></h1> 
			
			<div class="article">      
				
				<div class="half first">
					<h6><?php _e("By Page:", 'organicthemes'); ?></h6>
					<ul><?php wp_list_pages('title_li='); ?></ul>
				
					<h6><?php _e("By Month:", 'organicthemes'); ?></h6>
					<ul><?php wp_get_archives('type=monthly'); ?></ul>
							
					<h6><?php _e("By Category:", 'organicthemes'); ?></h6>
					<ul><?php wp_list_categories('sort_column=name&title_li='); ?></ul>
				</div>
				
				<div class="half second">	
					<h6><?php _e("By Post:", 'organicthemes'); ?></h6>
					<ul><?php wp_get_archives('type=postbypost&limit=100'); ?></ul>
				</div>
			
			</div>
			            
        </div>
		
	</div>
			
	<div class="four columns">
		<?php include(TEMPLATEPATH."/sidebar.php");?>
	</div>

</div>

<?php get_footer(); ?>