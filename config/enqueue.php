<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DEFAULT SCRIPTS
| -------------------------------------------------------------------
| Array of arrays that stores the defaults scripts for enqueue on all
| of the request to the Enqueue Library
|
| Use:
|   $config['enqueue_default_script']['name_of_script']['variable'] = 'value';
| 
| Variables:
|   ['path']    String - Path of the Script relative to root directory of
|               application. Example: 'assets/js/script.js'.
|   ['deps']    Optional. Array - Names of scripts this script depends on.
|               Must be registered somewhere on the code, so it can be
|               enqueue first. Default to FALSE.
|   ['async']   Optional. TRUE/FALSE - Whether the script is loaded
|               synchronously or not. Default to FALSE.
|   ['footer']  Optional. TRUE/FALSE - Whether the script is loaded
|               between <head> tags or at the end of <body>.
|               Default to FALSE
*/

$config['enqueue_default_script'] = array();

/*
$config['enqueue_default_script']['jquery']['path'] = 'assets/js/jquery.js';
$config['enqueue_default_script']['jquery']['deps'] = FALSE;
$config['enqueue_default_script']['jquery']['async'] = FALSE;
$config['enqueue_default_script']['jquery']['footer'] = TRUE;
*/

/*
| -------------------------------------------------------------------
| DEFAULT STYLES
| -------------------------------------------------------------------
| Array of arrays that stores the defaults styles for enqueue on all
| the request to the Enqueue Library
|
| Use:
|   $config['enqueue_default_style']['name_of_style']['variable'] = 'value';
|
| Variables:
|   ['path']    String - Path of the Style relative to root directory
|               of the application. Example: 'assets/css/style.css'.
|   ['deps']    Optional. Array - Names of the styles this style 
|               depends on. Must been registered somewhere on the code,
|               so it can be enqueue first. Default to FALSE.
|   ['media']   Optional. String - Media type for what the stylesheet
|               has been defined. Example: 'all','screen', 'print'.
|               Default to 'all'.
|
*/

$config['enqueue_default_style'] = array();