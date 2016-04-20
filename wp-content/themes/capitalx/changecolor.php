<?php

session_start();


 
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
require_once( $parse_uri[0] . 'wp-config.php' );



header("Content-type: text/css; charset=utf-8");

global $sampleReduxFramework;

$sampleReduxFramework = new Redux_Framework_sample_config();

$_SESSION['theme_color'] = "#".$_POST['color_code'];





?>