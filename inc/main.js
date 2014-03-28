;(function($) {
	window.main = {
		vars: {},
		init: function(){

			var wrap = main.vars.wrap = $('#wrap'),
				header = main.vars.header = $('#header'),
				footer = main.vars.footer = $('#footer'),
				sidebar = main.vars.sidebar = $('#sidebar'),
				templates = main.vars.templates = {},
				sidebarTemplate = main.vars.templates.sidebar = $('#template-sidebar'),
				headerNavigation = main.vars.header.navigation = $('.main-navigation', header),
				footerNavigation = main.vars.footer.navigation = $('.main-navigation', footer);
				nav = main.vars.nav = $('.main-nav');



			 $('.product-icon svg').attr({width: '60px', height: '60px'});
			 $('.product-overlay .product-icon svg').attr({width: '150px', height: '150px'});
		
			this.lightbox.init();
			this.menu.init();
			this.responsiveMenu.init();

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
				var windowWidth = $(window).width(),
					windowHeight = $(window).height();
					header = $('#header');

				if(windowWidth <= 480){
					$('.nav-title').addClass('mobile');
				} else{
					$('.nav-title').removeClass('mobile');
   				}

   				if(main.vars.footer.height() > windowHeight) {
   					main.vars.wrap.removeClass('fixed-footer');
   				} else {
   					$('#main').css('margin-top', header.outerHeight());
 					main.vars.wrap.addClass('fixed-footer')
   				}

			}
		},

		menu:{
			init: function(){
				this.body = $('body');
		 		this.header = $('header');
		 		this.wrap = $('#wrap');
		 		this.mainDiv = $('#main');
		 		this.footer = $('#footer');

				this.docHeight = this.body.outerHeight();
		       	this.footerHeight = this.footer.outerHeight();
		        this.headerHeight = this.header.outerHeight();

		 		console.log(main.menu.docHeight);
		 		console.log(main.menu.footerHeight);
		 		console.log(main.menu.headerHeight);

		 		this.handlers();
		 		this.testMargin();

			},

			handlers: function(){

				$('nav a[href="#footer"]').on('click', function(event){
			        event.preventDefault();

			        if(!main.menu.body.hasClass('home') && main.menu.wrap.hasClass('fixed-footer')){
			        	main.menu.mainDiv.addClass('marginator');
			        	main.menu.animate();
			        }else{
			        	main.menu.animate();
			        }
			    });
			},

			animate: function(){
				if(main.menu.header.css('position') == 'fixed'){

		        	$('body').animate({scrollTop: (main.menu.docHeight - main.menu.footerHeight) - main.menu.headerHeight},1000);
		        } else{
		        	$('body').animate({scrollTop: (main.menu.docHeight - main.menu.footerHeight)},1000);
		        }
			},

			testMargin: function(){
				if(main.menu.body.hasClass('home') && main.menu.wrap.hasClass('fixed-footer')){
					main.menu.mainDiv.addClass('marginator');
				}
			},

			resize: function(){
				testMargin();
			}
		},

		resize: function(){
			main.responsiveMenu.resize();
			main.menu.testMargin();
		}

	}
	// end of main

	$(function(){
		main.init();

	});

	$(window).load(function(){
		// main.setFooterHeight();
		console.log(main.menu.docHeight);
		 		console.log(main.menu.footerHeight);
		 		console.log(main.menu.headerHeight);

	})

})(jQuery);