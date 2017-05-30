<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Facebook App details
| -------------------------------------------------------------------
|
| To get an facebook app details you have to be a registered developer
| at http://developer.facebook.com and create an app for your project.
|
|  facebook_app_id               string  Your facebook app ID.
|  facebook_app_secret           string  Your facebook app secret.
|  facebook_login_type           string  Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string  URL tor redirect back to after login. Do not include domain.
|  facebook_logout_redirect_url  string  URL tor redirect back to after login. Do not include domain.
|  facebook_permissions          array   The permissions you need.
*/
/*
$config['facebook_app_id']              = '922149794570645'; 
$config['facebook_app_secret']          = '2e5a9a99c35c20e58bd48a5b24f626e7';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = base_url().'social_media/fbPost';
$config['facebook_logout_redirect_url'] = 'social_media';
$config['facebook_permissions']         = array('publish_actions','email');
$config['facebook_graph_version']       = 'v2.5';

$config['facebook_login_redirect_url_ttt']  = base_url().'the_total_tour/social_media/fbPost';
$config['facebook_logout_redirect_url_ttt'] = 'the_total_tour/social_media';

*/


$config['facebook_app_id']              = '625925940949384';
$config['facebook_app_secret']          = 'd91cee9725031035f9566317a81bc107';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  =  base_url().'social_media/fbPost';
$config['facebook_logout_redirect_url'] = 'social_media';
$config['facebook_permissions']         = array('publish_actions','email');
$config['facebook_graph_version']       = 'v2.5';



