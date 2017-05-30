<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array(
	// 'database', 
	'session', 
	'user_agent',
    'database',
    'form_validation',
    'template'
);
$autoload['drivers'] = array();
$autoload['helper'] = array(
	'url', 
	'cookie', 
	'form', 
	'security',
    'my_helper',
    'thumb_helper'
);
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('M_user','M_setting','M_notify');