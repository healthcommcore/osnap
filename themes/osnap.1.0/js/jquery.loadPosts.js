var $j = jQuery.noConflict();
$j(document).ready(function() {

	var pageNum = parseInt(pbd_alp.startPage) + 1;
	var max = parseInt(pbd_alp.maxPages);
	var nextLink = pbd_alp.nextLink;
	
	if(pageNum <= max) {
		// Insert the "More Posts" link.
		$j('.post.first')
			.append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
			.append('<h5 id="pbd-alp-load-posts"><a href="#">Load More Posts</a></h5>');
			
		// Remove the traditional navigation.
		$j('.navigation').remove();
	}
	
	$j('#pbd-alp-load-posts a').click(function() {
	
		// Are there more posts to load?
		if(pageNum <= max) {
		
			// Show that we're working.
			$j(this).text('Loading Posts...');
			
			$j('.pbd-alp-placeholder-'+ pageNum).load(nextLink + ' .holder.single',
				function() {
					// Update page number and nextLink.
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
					
					// Add a new placeholder, for when user clicks again.
					$j('#pbd-alp-load-posts')
						.before('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
					
					// Update the button message.
					if(pageNum <= max) {
						$j('#pbd-alp-load-posts a').text('Load More Posts');
					} else {
						$j('#pbd-alp-load-posts a').text('All Posts Loaded');
					}
				}
			);
		} else {
//			$j('#pbd-alp-load-posts a').append('.');
		}	
		
		return false;
	});
});