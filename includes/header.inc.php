<?php
	//àéè
	defined('vSecureInstaRP') or header('Location: /');
	
function Header_HTML($Title="", $IncludeHeader="") {
	$ret='<!doctype html>
<html lang="en" ng-app="appRoot">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="French">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="instagram rp">
    <meta name="keywords" content="insta,rp,united,photo,gta,five,fivem,gta online,gta server">
    <meta name="author" content="LeGrizzly#0341">

    <title>'.$Title.'</title>

    <!--
      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      Instagram RP - 0.1.9
      Updated: January 11, 2021
      Theme by: LeGrizzly - LeGrizzly#0341
      Support: LeGrizzly#0341
       _                _____          _               _         
      | |              / ____|        (_)             | |        
      | |        ___  | |  __   _ __   _   ____  ____ | |  _   _ 
      | |       / _ \ | | |_ | | \'__| | | |_  / |_  / | | | | | |
      | |____  |  __/ | |__| | | |    | |  / /   / /  | | | |_| |
      |______|  \___|  \_____| |_|    |_| /___| /___| |_|  \__, |
                                                            __/ |
                                                            |___/
      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    -->

    <!-- Bootstrap core CSS -->
    <link href="/assets/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/Bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="/assets/Bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="/assets/Bootstrap/css/bootstrap-utilities.min.css" rel="stylesheet">

    <!-- Favicons -->
    <!-- <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico"> -->
    <meta name="theme-color" content="#7952b3">

    <!-- AngularJs -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="/assets/js/app-angular.js"></script>
    <script src="/assets/js/infinite-scroll.js"></script>

    <!-- Script init -->
    <script src="/assets/jQuery/js/jquery.min.js"></script>

    <!-- SweetAlert2 -->
    <link href="/assets/SweetAlert2/css/sweetalert2.min.css" rel="stylesheet">
    <script src="/assets/SweetAlert2/js/sweetalert2.min.js"></script>

    <script src="/assets/Bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/Isotope/js/isotope.pkgd.min.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-11FC0M78QZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag("js", new Date());

      gtag("config", "G-11FC0M78QZ");
    </script>


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="/assets/css/home.css?v=1.1.5" rel="stylesheet">
	
	<!-- Import Auto script -->
	'.$IncludeHeader.'

  </head>
  <body>';
	return $ret;
}
	
function Footer_HTML($IncludeFooter="") {
	$ret='    </body>
</html>';
	return $ret;
}