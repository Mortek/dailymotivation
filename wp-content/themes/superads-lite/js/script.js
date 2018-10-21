jQuery.fn.exists = function(callback) {
    var args = [].slice.call(arguments, 1);
    if (this.length) {
        callback.call(this, args);
    }
    return this;
};
(function ($) {
	'use strict';

	var TCSuperAds = {
		
		initReady: function() {
			this.stickyMenu();
			this.bannerHome();
			this.mobileMenu();
			this.scrollTop();
			this.pinterest();
			this.loadSocialScript(document, 'script');

			if (typeof loadStyle != 'undefined') {
				if (loadStyle === 'infinite') {
					this.infiniteScroll();
				} else {
					this.infiniteLoading();	
				}
			}
		},
		stickyMenu: function() {
			var self = this;

			var catcher = $('#catcher'),
				sticky  = $('#sticky'),
				bodyTop = $('body').offset().top;

			if ( sticky.length ) {
				$(window).scroll(function() {
					self.stickThatMenu(sticky,catcher,bodyTop);
				});
				$(window).resize(function() {
					self.stickThatMenu(sticky,catcher,bodyTop);
				});
			}
		},
		isScrolledTo: function(elem,top) {
			var docViewTop = $(window).scrollTop();
			var docViewBottom = docViewTop + $(window).height();

			var elemTop = $(elem).offset().top - top;
			var elemBottom = elemTop + $(elem).height();

			return ((elemTop <= docViewTop));
		},
		stickThatMenu: function(sticky,catcher,top) {
			var self = this;

			if(self.isScrolledTo(sticky,top)) {
				sticky.addClass('sticky-nav');
				catcher.height(sticky.height());
			} 
			var stopHeight = catcher.offset().top;
			if ( stopHeight > sticky.offset().top) {
				sticky.removeClass('sticky-nav');
				catcher.height(0);
			}
		},
		bannerHome: function() {
			if($('.flexslider').length) {
				$('.flexslider').flexslider({
					animation: 'slide',
					prevText: '',
					nextText: '', 
				});
			}
		},
		mobileMenu: function() {
			var $top_menu = $('.primary-navigation');
			var $secondary_menu = $('.secondary-navigation');
			var $first_menu = '';
			var $second_menu = '';

			if ($top_menu.length == 0 && $secondary_menu.length == 0) {
				return;
			} else {
				if ($top_menu.length) {
					$first_menu = $top_menu;
					if($secondary_menu.length) {
						$second_menu = $secondary_menu;
						$('.top-nav').addClass('has-second-menu');
					}
				} else {
					$first_menu = $secondary_menu;
				}
			}
			var menu_wrapper = $first_menu
			.clone().attr('class', 'mobile-menu')
			.wrap('<div id="mobile-menu-wrapper" class="mobile-only"></div>').parent().hide()
			.appendTo('body');
			
			// Add items from the other menu
			if ($second_menu.length) {
				$second_menu.find('ul.menu').clone().appendTo('.mobile-menu .inner');
			}
			
			$('.toggle-mobile-menu').click(function(e) {
				e.preventDefault();
				e.stopPropagation();
				$('#mobile-menu-wrapper').show(); // only required once
				$('body').toggleClass('mobile-menu-active');
			});

			$('.container').click(function() {
				if ($('body').hasClass('mobile-menu-active')) {
					$('body').removeClass('mobile-menu-active');
				}
				if($('.menu-item-has-children .arrow-sub-menu').hasClass('fa-chevron-down')) {
					$('.menu-item-has-children .arrow-sub-menu').removeClass('fa-chevron-down').addClass('fa-chevron-right');
				}
			});

			$('<i class="fa arrow-sub-menu fa-chevron-right"></i>').insertAfter($('.menu-item-has-children > a'));

			if($('#wpadminbar').length) {
				$('#mobile-menu-wrapper').addClass('wpadminbar-active');
			}

			$('.menu-item-has-children .arrow-sub-menu').click(function(e) {
				e.preventDefault();
				var active = $(this).hasClass('fa-chevron-down');
				if(!active) {
					$(this).removeClass('fa-chevron-right').addClass('fa-chevron-down');
					$(this).next().slideDown();
				} else {
					$(this).removeClass('fa-chevron-down').addClass('fa-chevron-right');
					$(this).next().slideUp();
				}
			});

		},
		infiniteLoading: function() {
			var pageNumber = 2;
			
			$('#load-more-post').on('click', function(e) {

				if (pageNumber <= totalPages) {
					var that = this;
					e.preventDefault();
					$.ajax({
						url: SuperAdsAjax.ajaxurl,
						type:'POST',
						data: 'action=infinite_scroll&page_no='+ pageNumber + '&loop_file=content',
						beforeSend : function() {
							$(that).html($(that).data('loading'));
						}
						
					}).done(function(html) {
						$('#post-container').append(html); 
						$(that).html($(that).data('more'));
					});
					pageNumber++;

					if ( pageNumber > totalPages ) {
						$(this).parent().hide();
					}
				}

				e.preventDefault();
			});
		},
		infiniteScroll: function() {
			var pageNumber = 2;
			var isLoading = false;
			jQuery(window).scroll(function(){
				
				if($(window).scrollTop() + $(window).height() > $('#main').height()) {

					if (pageNumber <= totalPages && isLoading === false) {
						jQuery.ajax({
							url: SuperAdsAjax.ajaxurl,
							type: 'POST',
							data: 'action=infinite_scroll&page_no='+ pageNumber + '&loop_file=content',
							beforeSend: function () {
								isLoading = true;
								$('.scroll-loading').show();
							},
							success: function (data) {
								jQuery('#post-container').append(data); 
								isLoading = false;
								pageNumber++;
								$('.scroll-loading').removeAttr('style');
							}
							
						});
					}
				}
			}); 
		},
		scrollTop: function() {
			var scrollDes = 'html,body';  
			// Opera does a strange thing if we use 'html' and 'body' together so my solution is to do the UA sniffing thing
			if(navigator.userAgent.match(/opera/i)){
				scrollDes = 'html';
			}
			// Show ,Hide
			$(window).scroll(function () {
				if ($(this).scrollTop() > 130) {
					$('.back-to-top').addClass('filling').removeClass('hiding');
					$('.sharing-top-float').fadeIn();
				} else {
					$('.back-to-top').removeClass('filling').addClass('hiding');
					$('.sharing-top-float').fadeOut();
				}
			});
			// Scroll to top when click
			$('.back-to-top').click(function () {
				$(scrollDes).animate({ 
					scrollTop: 0
				},{
					duration :500
				});

			});
		},
		pinterest: function() {
			if ( $('main.site-main').hasClass('enable-pinterest') ) {

				// Skip Pinterest
				this.skipPinterest();

				$('.entry-content').find('img').each(function() {

					if (! $(this).hasClass('skip-pin')) {
						var imgWidth = $(this).width();
						var imgHeight = $(this).height();

						var classImg = '';

						if($(this).hasClass('alignleft')) {
							classImg = ' alignleft';
						} else if ($(this).hasClass('aligncenter')) {
							classImg = ' aligncenter';
						} else if($(this).hasClass('alignright')) {
							classImg = ' alignright';
						} else {
							classImg = ' alignnone';
						}

						if (  imgWidth > '99' && imgHeight > '49' ) {
							$(this).wrap('<div class="pinterest-wrap' + classImg + '"></div>');

							var url = document.url;
							var media = $(this).attr('src');
							var title = document.title;
							var pinterest = "<div class='btn-pin'><span data-val='https://pinterest.com/pin/create/button/?url="+url+"&media="+media+"&description="+title+"' class='pinterest'></span></div>";
							$(pinterest).prependTo($(this).parent());

						} else if (  imgWidth > '499' ) {
							$(this).wrap('<div class="pinterest-wrap' + classImg + '"></div>');
							var url = document.url;
							var media = $(this).attr('src');
							var title = document.title;
							var pinterest = "<div class='btn-pin'><span data-val='https://pinterest.com/pin/create/button/?url="+url+"&media="+media+"&description="+title+"' class='pinterest'></span></div>";
							$(pinterest).prependTo($(this).parent());
							
						}
					}
				});
				
				$('.pinterest').live('click', function(e) {
					e.preventDefault();
					var pinterestURL = $(this).attr('data-val');
					window.open(pinterestURL, 'asdas', 'toolbars=0,width=800,height=350,left=200,top=200,scrollbars=1,resizable=1');
				});
			}

		},
		skipPinterest: function() {
			$('.entry-content .ads-banner-block img').addClass('skip-pin');
			
		},

		loadSocialScript: function(d,s) {
        	var js, fjs = d.getElementsByTagName(s)[0],
            load = function(url, id) {
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.src = url;
                js.id = id;
                fjs.parentNode.insertBefore(js, fjs);
            };
	        jQuery('span.facebookbtn, .fb-like-box').exists(function() {
	            load('//connect.facebook.net/en_US/all.js#xfbml=1', 'fbjssdk');
	        });
	        jQuery('span.gplusbtn').exists(function() {
	            load('https://apis.google.com/js/plusone.js', 'gplus1js');
	        });
	        jQuery('span.twitterbtn').exists(function() {
	            load('//platform.twitter.com/widgets.js', 'tweetjs');
	        });
	        jQuery('span.linkedinbtn').exists(function() {
	            load('//platform.linkedin.com/in.js', 'linkedinjs');
	        });
	        jQuery('span.pinbtn, .tc-pinterest-profile').exists(function() {
	            load('//assets.pinterest.com/js/pinit.js', 'pinterestjs');
	        });
	        jQuery('span.stumblebtn').exists(function() {
	            load('//platform.stumbleupon.com/1/widgets.js', 'stumbleuponjs');
	        });

        }
	}

	$(document).ready(function () {
		TCSuperAds.initReady();

		
	});

})(jQuery);