<?php
	//àéè
	defined('vSecureInstaRP') or header('Location: /');
	
function Header_HTML($Title="", $IncludeHeader="") {
	$ret='<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="LeGrizzly#0341, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>'.$Title.'</title>

    <!--
      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      Instagram RP - 0.0.5
      Updated: January 11, 2021
      Theme by: LeGrizzly - LeGrizzly#0341
      Support: LeGrizzly#0341
        _____ __        __        __  __      __       __
        / ___// /___  __/ /__     / / / /___ _/ /______/ /_
        \__ \/ __/ / / / / _ \   / /_/ / __ `/ __/ ___/ __ \
      ___/ / /_/ /_/ / /  __/  / __  / /_/ / /_/ /__/ / / /
      /____/\__/\__, /_/\___/  /_/ /_/\__,_/\__/\___/_/ /_/
              /____/
      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    -->

    <!-- Bootstrap core CSS -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="./assets/bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="./assets/bootstrap/css/bootstrap-utilities.min.css" rel="stylesheet">

    <!-- Favicons -->
    <!-- <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico"> -->
    <meta name="theme-color" content="#7952b3">

    <!-- Script init -->
    <script src="./assets/jQuery/js/jquery.min.js"></script>

    <!-- SweetAlert2 -->
    <link href="./assets/SweetAlert2/css/sweetalert2.min.css" rel="stylesheet">
    <script src="./assets/SweetAlert2/js/sweetalert2.min.js"></script>

    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script src="./assets/Isotope/js/isotope.pkgd.min.js"></script>
    <!-- script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.js" crossorigin="anonymous"></script -->
    

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
    <link href="./assets/css/home.css?v=0.1" rel="stylesheet">
	
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