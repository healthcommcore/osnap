<?php get_header(); ?>

<div id="content" class="row">


        <div <?php post_class(); ?> id="page-<?php the_ID(); ?>">
             
			<div style="width: 400px; margin:80px auto 150px;"> 
            <h1>Oops!</h1>
			<h3>There has been some kind of error.</h3>
            <p>The page you are looking for could not be found.</p>
            </div>
        </div>

			
	<div class="four columns">
		<?php //include(TEMPLATEPATH."/sidebar.php");?>
	</div>

</div>

<?php get_footer(); ?>