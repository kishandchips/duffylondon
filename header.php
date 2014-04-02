<!DOCTYPE html>
<!--[if lt IE 7]>      <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <script type="text/javascript">
		var themeUrl = '<?php bloginfo( 'template_url' ); ?>';
		var baseUrl = '<?php bloginfo( 'url' ); ?>';

	</script>

	<?php wp_head(); ?>
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-5955967-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
</head>
<body <?php body_class(); ?>>

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
<div id="lightbox">
    <div class="content"></div>
    <div class="loader"></div>
    <div class="overlay"></div>
</div>
<div id="wrap" class="site-container clearfix">
    
    <header id="header">
        <nav>

            <h1 class="logo-container">
                <a href="<?php echo site_url(); ?>" class="logo">Duffy London</a>
            </h1>

            <a href="#footer" class="menu button black left">
                Menu
            </a>

            <a href="<?php echo site_url(); ?>/cart" class="cart button black right">
                <i class="icon-cart"></i>
                <?php global $woocommerce; ?> 
                <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>
            </a>


<!--             <?php if(function_exists('pll_the_languages') && is_product()): ?>
            <ul class="language-selector clearfix"><?php pll_the_languages(array('hide_if_no_translation' => 1)); ?></ul>
            <?php endif; ?> -->


        </nav>
    </header>

    <main id="main" class="clearfix">