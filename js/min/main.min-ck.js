!function(i){window.main={vars:{},init:function(){var n=main.vars.wrap=i("#wrap"),e=main.vars.header=i("#header"),a=main.vars.footer=i("#footer"),t=main.vars.sidebar=i("#sidebar"),o=main.vars.templates={},h=main.vars.templates.sidebar=i("#template-sidebar"),r=main.vars.header.navigation=i(".main-navigation",e),s=main.vars.footer.navigation=i(".main-navigation",a);nav=main.vars.nav=i(".main-nav"),i(".product-icon svg").attr({width:"60px",height:"60px"}),i(".product-overlay .product-icon svg").attr({width:"150px",height:"150px"}),this.lightbox.init(),this.menu.init(),this.responsiveMenu.init(),i(window).on("resize",this.resize).trigger("resize")},lightbox:{init:function(){var n=main.lightbox.container=i("#lightbox"),e=main.lightbox.overlay=i(".overlay",n),a=main.lightbox.content=i(".content",n),t=main.lightbox.loader=i(".loader",n);i(".lightbox-btn").on("click",main.lightbox.open),e.on("click",main.lightbox.close),i(document).on("click","#lightbox",main.lightbox.close)},open:function(n){n.preventDefault(),main.lightbox.load(i(this).attr("href"))},load:function(n){var e=main.lightbox.container,a=main.lightbox.overlay,t=main.lightbox.content,o=main.lightbox.loader,h=i(document).height(),r=i(window).height(),s=i(window).width(),d=i(window).scrollTop(),l=main.addToUrl(n,"ajax"),l=main.addToUrl(l,"lightbox");e.height(h),t.height(r),e.show(),o.fadeIn(),t.hide(),a.fadeIn("slow",function(){null!=n.match(/\.(jpeg|jpg|gif|png)$/)?(t.html('<img class="lightbox-supermotherfucker" src="'+n+'">'),i(".lightbox-supermotherfucker").load(function(){o.fadeOut(function(){var i=d+(r-t.height())/2,n=(s-t.width())/2;i+t.height()>h&&(i=h-t.height()),t.animate({top:i,left:n},function(){t.fadeIn()})})})):i.get(l,function(n){t.html(n),o.fadeOut(function(){if(i.fn.imagesLoaded)t.imagesLoaded(function(){var i=d+(r-t.height())/2;i+t.height()>h-60&&(i=h-t.height()-60),t.animate({top:i},function(){t.fadeIn()})});else{var n=d+(r-t.height())/2;n+t.height()>h-60&&(n=h-t.height()-60),e.animate({top:n},function(){t.fadeIn()})}})})})},close:function(){var i=main.lightbox.container,n=main.lightbox.overlay,e=main.lightbox.content;e.fadeOut(function(){n.fadeOut(function(){i.hide()}),e.html()})}},ajaxPage:{init:function(){var n=main.ajaxPage.container=i("#ajax-page"),e=main.ajaxPage.pageUrl=window.location.href;i(".ajax-btn").on("click",function(n){return main.ajaxPage.load(i(this).attr("href")),!1}),i(document).on("click","#ajax-page .close-btn",function(){main.ajaxPage.close()})},load:function(n){var e=main.ajaxPage.container,a=main.addToUrl(n,"ajax");if(0==i(".content",e).length)e.show(),o=i('<div class="loader"></div>'),o.hide(),e.html(o),e.animate({height:o.actual("outerHeight")},function(){o.fadeIn(),i.get(a,function(n){var a=i('<div class="content"></div>');a.hide(),e.append(a),a.html(n),o.fadeOut(function(){i.fn.imagesLoaded?a.imagesLoaded(function(){e.animate({height:a.height()},function(){e.css({height:"auto"}),a.fadeIn(),e.slideDown("slow")})}):e.animate({height:a.actual("height")},function(){e.css({height:"auto"}),a.fadeIn()})})})});else{var t=i(".content",e),o=i('<div class="loader"></div>').hide();e.prepend(o),t.fadeTo(300,0,function(){o.fadeIn(),i.get(a,function(i){t.html(i),o.fadeOut(function(){e.animate({height:t.actual("height")},function(){t.fadeTo(300,1),e.css({height:"auto"})})})})})}},close:function(){var i=main.ajaxPage.container;i.slideUp(function(){i.html("")})}},addToUrl:function(i,n){var e=new RegExp("(\\?|\\&)"+n+"=.*?(?=(&|$))"),a=/\?.+$/;return i=e.test(i)?i.replace(e,"$1"+n+"=true"):a.test(i)?i+"&"+n+"=true":i+"?"+n+"=true"},scrollTo:function(n){n.length&&i("html, body").animate({scrollTop:n.offset().top})},responsiveMenu:{init:function(){i(".nav-title").on("click",function(n){i(".nav-title").hasClass("mobile")&&(n.preventDefault(),i(this).parent().siblings(".sub-menu").toggleClass("show"))})},resize:function(){var n=i(window).width(),e=i(window).height();header=i("#header"),480>=n?i(".nav-title").addClass("mobile"):i(".nav-title").removeClass("mobile"),main.vars.footer.height()>e?main.vars.wrap.removeClass("fixed-footer"):(i("#main").css("margin-top",header.outerHeight()),main.vars.wrap.addClass("fixed-footer"))}},menu:{init:function(){this.body=i("body"),this.header=i("header"),this.wrap=i("#wrap"),this.mainDiv=i("#main"),this.footer=i("#footer"),this.footerHeight=this.footer.outerHeight(),this.headerHeight=this.header.outerHeight(),this.handlers(),this.testMargin()},handlers:function(){body=i("body"),i('nav a[href="#footer"]').on("click",function(i){i.preventDefault(),bodyHeight=body.outerHeight(),!main.menu.body.hasClass("home")&&main.menu.wrap.hasClass("fixed-footer")?(main.menu.mainDiv.addClass("marginator"),bodyHeight=body.outerHeight(),main.menu.animate(bodyHeight)):main.menu.animate(bodyHeight)})},animate:function(n){"fixed"==main.menu.header.css("position")?i("body").animate({scrollTop:n-main.menu.footerHeight-main.menu.headerHeight},1e3):i("body").animate({scrollTop:n-main.menu.footerHeight},1e3)},testMargin:function(){main.menu.body.hasClass("home")&&main.menu.wrap.hasClass("fixed-footer")&&main.menu.mainDiv.addClass("marginator")},resize:function(){testMargin()}},resize:function(){main.responsiveMenu.resize(),main.menu.testMargin()}},i(function(){main.init()}),i(window).load(function(){})}(jQuery);