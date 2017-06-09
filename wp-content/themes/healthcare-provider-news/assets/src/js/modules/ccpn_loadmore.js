var CCPN_Loadmore = (function ($) {

	var start;
	var quant;
	var postCount;
	var categoryId;
	var searchTerms;
	var endpoint;
	var container = $('#feedList');
	var windowProtocol = window.location.protocol+'//';
	var windowHost = window.location.host;
	var button = $('#loadMore');


	/**
	 * 
	 * @todo document this method
	 * 
	 * @author Adam Meyer <dev@apmeyer.com>
	 * 
	 */
	var init = function() {
		
		categoryId = $(container).data('category-id');
		quant = $(container).data('posts-per-page');
		postCount = $(container).data('post-count');
		searchTerms = $(container).data('search-terms');

		// make sure we have a categoryId a quantity value and
		// the total number of posts is greater than the quantity loaded
		if ( categoryId && quant && postCount > quant ) {

			start = quant;

			$(button).on('click',function(e){			
				e.preventDefault();
				getPosts();
			});

		} else {

			$(button).hide();

		}

	};



	/**
	 * 
	 * @todo document this method
	 * 
	 * @author Adam Meyer <dev@apmeyer.com>
	 * 
	 */
	var getPosts = function () {

		var resultCount = 0;

		// if categoryId is 'all' then we'll use the endpoint to get all posts
		if ( categoryId === 'all' ) {
			
			endpoint = windowProtocol+windowHost+'/wp-json/wp/v2/posts?per_page='+quant+'&offset='+start;

		// if this is a site search...
		} else if ( categoryId === 'search' ) {

			endpoint = windowProtocol+windowHost+'/wp-json/wp/v2/posts?search='+encodeURI(searchTerms)+'&per_page='+quant+'&offset='+start;

		// otherwise we'll filter the post by ID
		} else {
		
			endpoint = windowProtocol+windowHost+'/wp-json/wp/v2/posts?categories='+categoryId+'&per_page='+quant+'&offset='+start;
		
		}

		$.getJSON(endpoint, function(data) {

			for (var i = 0; i < data.length; i++) {
				var meta = data[i];
				$(container).append(buildHtml(meta));
				resultCount = resultCount + 1;
			}

		}).done(function() {

			// increase the start value for the next batch
			start = start + quant;
			console.log(endpoint);

			// if there were fewer results returned than quant, hide the button
			if ( resultCount < quant ) {
				$('#loadMore').hide();
				$('#loadMoreMessage').hide().delay(500).html('<p class="text-center pt-2"><em>All articles have been loaded</em></p>').fadeIn();
			}
	  
		});

	};


	/**
	 * 
	 * @todo document this method
	 * 
	 * @author Adam Meyer <dev@apmeyer.com>
	 * 
	 */
	var formatTheDate = function(string) {

		if (!string) { return; }

		var date = new Date(string);

		var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		return monthNames[m] + ' ' + d + ', ' + y;
	};


	/**
	 * 
	 * @todo document this method
	 * 
	 * @author Adam Meyer <dev@apmeyer.com>
	 * 
	 */
	var getThumbnail = function(meta) {

		if (!meta) { return; }

		var endpoint = windowProtocol+windowHost+'/wp-json/wp/v2/media/'+meta.featured_media;

		$.getJSON(endpoint, function(data) {
			var html = '<a href="'+meta.link+'"><img src="'+data.media_details.sizes.thumbnail.source_url+'" /></a>';
			$('#post_media_'+meta.id).html(html);
		});

	};


	/**
	 * @todo document this method
	 * 
	 * @author Adam Meyer <dev@apmeyer.com>
	 * 
	 */
	var buildHtml = function(meta) {

		if (!meta) { return; }

		var permalink = meta.link;
		var title 		= meta.title.rendered;
		var excerpt 	= meta.excerpt.rendered;
		var date 			= formatTheDate(meta.date);

		var html = '<li class="feed-item mb-2">';
		html += '<div class="feed-item__media" id="post_media_'+meta.id+'"></div>';
		html += '<div class="feed-item__content">';
		html += 	'<span class="feed-item__date p">'+date+'</span>';
		html += 	'<h3 class="feed-item__title h3 mb-0-5"><a class="feed-item__title-link" href="'+permalink+'">'+title+'</a></h3>';
		html += 	'<div class="feed-item__excerpt wysiwyg">'+excerpt+'</div>';
		html += '</div>';
		html += '</li>';

		if ( meta.featured_media ) {
			getThumbnail(meta);
		}

		return html;

	};


	return {
		init : init
	};

})(jQuery);