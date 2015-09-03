<style type="text/css" media="screen">
<?php  
	$link_color = of_get_option('link_color'); 
	$heading_link_color = of_get_option('heading_link_color');
	$link_hover_color = of_get_option('link_hover_color');
	$heading_link_hover_color = of_get_option('heading_link_hover_color');
	$link_background_color = of_get_option('link_background_color');
?>

#content a, #content a:link, #content a:visited,
#homepage a, #homepage a:link, #homepage a:visited,
#slideshow a, #slideshow a:link, #slideshow a:visited {
<?php 
	if ($link_color) {
	    echo 'color: ' .$link_color. ';';
    }; 
?>
}

#content a:hover, #content a:focus, #content a:active,
#homepage a:hover, #homepage a:focus, #homepage a:active,
#slideshow a:hover, #slideshow a:focus, #slideshow a:active {
<?php 
	if ($link_hover_color) {
	    echo 'color: ' .$link_hover_color. ';';
    }; 
?>
}

.container h1 a, .container h2 a, .container h3 a, .container h4 a, .container h5 a, .container h6 a,
.container h1 a:link, .container h2 a:link, .container h3 a:link, .container h4 a:link, .container h5 a:link, .container h6 a:link,
.container h1 a:visited, .container h2 a:visited, .container h3 a:visited, .container h4 a:visited, .container h5 a:visited, .container h6 a:visited {
<?php 
	if ($heading_link_color) {
	    echo 'color: ' .$heading_link_color. '!important;';
    }; 
?>
}

.container h1 a:hover, .container h2 a:hover, .container h3 a:hover, .container h4 a:hover, .container h5 a:hover, .container h6 a:hover,
.container h1 a:focus, .container h2 a:focus, .container h3 a:focus, .container h4 a:focus, .container h5 a:focus, .container h6 a:focus,
.container h1 a:active, .container h2 a:active, .container h3 a:active, .container h4 a:active, .container h5 a:active, .container h6 a:active {
<?php 
	if ($heading_link_hover_color) {
	    echo 'color: ' .$heading_link_hover_color. '!important;';
    }; 
?>
}

#submit:hover, #comments #respond input#submit:hover, #searchsubmit:hover, #pbd-alp-load-posts a:hover, #pbd-alp-load-posts a:active, .reply a:hover, .gallery img:hover, .gform_wrapper input.button:hover, .number-paginate a:hover, .number-paginate a:active, .number-paginate .number-current, .flex-direction-nav li .prev:hover, .flex-direction-nav li .next:hover {
<?php 
	if ($link_background_color) {
	    echo 'background-color: ' .$link_background_color. ' !important;';
    }; 
?>
}
</style>