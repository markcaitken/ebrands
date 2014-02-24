<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php echo get_bloginfo('name'); ?></title>
<meta name="description" content="<?php echo get_bloginfo('description'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes" />
<?php echo $ebrands->conditional->get('meta'); ?>
<link rel="shortcut icon" type="image/x-icon" href="/assets/img/ico/favicon.ico" />
<link rel="apple-touch-icon-precomposed" type="image/png" href="/assets/img/ico/favicon_57.png" />
<link rel="apple-touch-icon-precomposed" type="image/png" href="/assets/img/ico/favicon_72.png" sizes="72x72" />
<link rel="apple-touch-icon-precomposed" type="image/png" href="/assets/img/ico/favicon_114.png" sizes="114x114" />
<link rel="apple-touch-icon-precomposed" type="image/png" href="/assets/img/ico/favicon_144.png" sizes="144x144" />
<?php echo $ebrands->conditional->get('css'); ?>
<?php echo $ebrands->conditional->get('js_head'); ?>
<!-- Start wp_head() -->
<?php wp_head(); ?>
<!-- End wp_head() -->
</head>
<body class="<?php echo $ebrands->conditional->get('classes'); ?>">
<div class="container">
    <div class="row" style="background: grey; height: 300px;">
        Header Image
    </div>
    <div class="row">
        

      