<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
    <script type="text/javascript">
		var themeUrl = '<?php bloginfo( 'template_url' ); ?>';
		var baseUrl = '<?php bloginfo( 'url' ); ?>';
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
        <!--[if lt IE 9]>
            <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/style-ie.css"/>
        <![endif]-->
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
<div id="lightbox">
        <div class="content"></div>
        <div class="loader"></div>
        <div class="overlay"></div>
</div>
<div class="site-container clearfix">
    
    <header id="header">
        <nav>

            <h1 class="mob-logo">
                <a href="<?php echo home_url(); ?>" class="logo">Duffy London</a>
            </h1>
            <a href="#footer" class="button black left">
                Menu
            </a>

            <h1 class="logo-container">
                <a href="<?php echo home_url(); ?>" class="logo">Duffy London</a>
            </h1>

            <a href="<?php echo site_url(); ?>/cart" class="button black right">
                <i class="icon-cart"></i>
                <?php global $woocommerce; ?> 
                <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>
            </a>
        </nav>
    </header>

    <main id="main" class="clearfix">