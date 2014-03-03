;(function($) {
	window.main = {
		vars: {},
		init: function(){

			var header = main.vars.header = $('#header'),
				footer = main.vars.footer = $('#footer'),
				sidebar = main.vars.sidebar = $('#sidebar'),
				templates = main.vars.templates = {},
				sidebarTemplate = main.vars.templates.sidebar = $('#template-sidebar'),
				headerNavigation = main.vars.header.navigation = $('.main-navigation', header),
				footerNavigation = main.vars.footer.navigation = $('.main-navigation', footer);

			$('nav a[href="#footer"]').on('click', function(event){
		        event.preventDefault();
		        $height = $(document).height();
		        $footer = $('#footer').outerHeight();
		        $header = $('header').outerHeight();

		        if($('#header').css('position') == 'fixed'){
		        	$('html,body').animate({scrollTop: $height-$footer+$header},1500);
		        } else{
		        	$('html,body').animate({scrollTop: $height-$footer},1500);
		        }

		    });

			 $('.product-icon svg').attr({width: '60px', height: '60px'});

		    
			
			this.lightbox.init();
			this.responsiveMenu.init();
			// this.scroller.init();
			// this.testimonials.init();
			
			// this.accordion.init();
			
			$(window).on('resize', this.resize).trigger('resize');

		},

		lightbox: {
			init: function(){
				var container = main.lightbox.container = $('#lightbox'),
					overlay = main.lightbox.overlay = $('.overlay', container),
					content = main.lightbox.content = $('.content', container),
					loader = main.lightbox.loader = $('.loader', container);

				$('.lightbox-btn').on('click', main.lightbox.open);
				overlay.on('click', main.lightbox.close);
				$(document).on('click', '#lightbox', main.lightbox.close);
			},
			open: function(e){
				e.preventDefault();
				main.lightbox.load($(this).attr('href'));
			},
			load: function(url){
				var container = main.lightbox.container,
					overlay = main.lightbox.overlay,
					content = main.lightbox.content,
					loader = main.lightbox.loader,
					documentHeight = $(document).height(),
					windowHeight = $(window).height(),
					windowWidth = $(window).width(),
					scrollTop = $(window).scrollTop(),
					ajaxUrl = main.addToUrl(url, 'ajax'),
					ajaxUrl = main.addToUrl(ajaxUrl, 'lightbox');

				container.height(documentHeight);
				content.height(windowHeight);
				container.show();
				loader.fadeIn();
				content.hide();
				overlay.fadeIn('slow', function(){
					
					if(url.match(/\.(jpeg|jpg|gif|png)$/) != null) {
						content.html('<img class="lightbox-supermotherfucker" src="'+ url + '">');

						$('.lightbox-supermotherfucker').load(function(){

							loader.fadeOut(function(){
								var top = scrollTop + (windowHeight - content.height()) / 2;
								var left = (windowWidth - content.width()) /2
								if(top + content.height() > documentHeight){
									top = documentHeight - content.height();
								}

								content.animate({top: top, left: left}, function(){
									content.fadeIn();
								});
							});
						});

					} else {
						$.get(ajaxUrl, function(data) {
							content.html(data)
							loader.fadeOut(function(){
								
								if($.fn.imagesLoaded){
									content.imagesLoaded(function(){
										var top = scrollTop + (windowHeight - content.height()) / 2;
										if(top + content.height() > documentHeight - 60){
											top = documentHeight - content.height() - 60;
										}
										content.animate({top: top}, function(){
											content.fadeIn();
										});
									});
								} else {
									var top = scrollTop + (windowHeight - content.height()) / 2;
									if(top + content.height() > documentHeight - 60){
										top = documentHeight - content.height() - 60;
									}
									container.animate({top: top}, function(){
										content.fadeIn();
									});
								}	
							});	
							
						});
					}
				});	

			},
			close: function(){
				var container = main.lightbox.container,
					overlay = main.lightbox.overlay,
					content = main.lightbox.content;

				content.fadeOut(function(){
					overlay.fadeOut(function(){
						container.hide();
					});
					content.html();
				});
			}
		},

		ajaxPage: {
			init: function(){
				var container = main.ajaxPage.container = $('#ajax-page'),
					//currUrl = main.ajaxPage.currUrl = window.location.href;
					pageUrl = main.ajaxPage.pageUrl = window.location.href;
				
				$('.ajax-btn').on('click', function(e){
					main.ajaxPage.load($(this).attr('href'));
					return false;
				});

				$(document).on('click', '#ajax-page .close-btn', function(){
					main.ajaxPage.close();
				});

			},
			load: function(url){

				var container = main.ajaxPage.container,
					ajaxUrl = main.addToUrl(url, 'ajax');

				
				//container.slideDown(2000);
			    if($('.content', container).length == 0){
			    	container.show();
			    	loader = $('<div class="loader"></div>');
					loader.hide();
					container.html(loader);

					container.animate({height: loader.actual('outerHeight')}, function(){
						loader.fadeIn();

						$.get(ajaxUrl, function(data) {
							var content = $('<div class="content"></div>');
							content.hide();
							container.append(content);
							content.html(data);
							loader.fadeOut(function(){
								if($.fn.imagesLoaded){
									content.imagesLoaded(function(){
										container.animate({'height': content.height()}, function(){
											container.css({'height': 'auto'});
											content.fadeIn();
											container.slideDown('slow');
											//main.facebook.setCanvasHeight();
										});
									});
								} else {
									container.animate({'height': content.actual('height')}, function(){
										container.css({'height': 'auto'});
										content.fadeIn();
										// main.facebook.setCanvasHeight();
									});
								}	
							});

						});
					});
				} else {
					var content = $('.content', container),
						loader = $('<div class="loader"></div>').hide();
					container.prepend(loader);
					content.fadeTo(300, 0, function(){
						loader.fadeIn();
						$.get(ajaxUrl, function(data) {
							content.html(data);
							loader.fadeOut(function(){
								container.animate({'height': content.actual('height')}, function(){
									content.fadeTo(300, 1);
									container.css({'height': 'auto'});
									// main.facebook.setCanvasHeight();
								});
							});
						});
					});
				}

				//main.ajaxPage.currUrl = url;
			}, 
			close: function(){
				var container = main.ajaxPage.container;

				container.slideUp(function(){
					container.html('');
				});

				//if(Modernizr.history) history.pushState(null, null, main.ajaxPage.pageUrl);
			}
		},

		addToUrl: function(url, query){
			var regex = new RegExp('(\\?|\\&)'+query+'=.*?(?=(&|$))'),
		        qstring = /\?.+$/;

			if (regex.test(url)){
		        url = url.replace(regex, '$1'+query+'=true');
		    } else if (qstring.test(url)) {
		        url = url + '&'+query+'=true';
		    } else {
		        url =  url + '?'+query+'=true';
		    }

		    return url;		
		},

		scrollTo: function(target){
			if(target.length){
				$('html, body').animate({scrollTop: target.offset().top});
			}
		},

		responsiveMenu: {
			init: function(){
				$('.nav-title').on('click', function(e){

					if($('.nav-title').hasClass('mobile')){
						e.preventDefault();
						$(this).parent().siblings(".sub-menu").toggleClass('show');
					}
				});
			},
			resize: function(){
				var width = $(window).width();
				if(width <= 480){
					$('.nav-title').addClass('mobile');
				} else{
					$('.nav-title').removeClass('mobile');
   				}
			}
		},
		resize: function(){
			main.responsiveMenu.resize();
		}

	}
	// end of main

	$(function(){
		main.init();
	});

	$(window).load(function(){

		var currentTallest = 0,
		    currentRowStart = 0,
		    rowDivs = new Array();
		
		function setConformingHeight(el, newHeight) {
			// set the height to something new, but remember the original height in case things change
			el.data("originalHeight", (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight")));
			el.height(newHeight);
		}
		
		function getOriginalHeight(el) {
			// if the height has changed, send the originalHeight
			return (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight"));
		}
		
		function columnConform() {
		
			// find the tallest DIV in the row, and set the heights of all of the DIVs to match it.
			$('.equal > li').each(function() {
			
				// "caching"
				var $el = $(this);
				
				var topPosition = $el.position().top;
		
				if (currentRowStart != topPosition) {
		
					// we just came to a new row.  Set all the heights on the completed row
					for(currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);
		
					// set the variables for the new row
					rowDivs.length = 0; // empty the array
					currentRowStart = topPosition;
					currentTallest = getOriginalHeight($el);
					rowDivs.push($el);
		
				} else {
		
					// another div on the current row.  Add it to the list and check if it's taller
					rowDivs.push($el);
					currentTallest = (currentTallest < getOriginalHeight($el)) ? (getOriginalHeight($el)) : (currentTallest);
		
				}
				// do the last row
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);
		
			});
		
		}
		
		columnConform();

	}); // end of load

})(jQuery);