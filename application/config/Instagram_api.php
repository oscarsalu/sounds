<?php

/*
|--------------------------------------------------------------------------
| Instagram
|--------------------------------------------------------------------------
|
| Instagram client details
|
*/

$config['instagram_client_name']	= 'social_media_ci';
$config['instagram_client_id']		= 'de859c0e50534ebabc893f0ffc4f8245';
$config['instagram_client_secret']	= '48a5f115b3c8420c8fd6e0612ba39c7b';
$config['instagram_callback_url']	= base_url().'index.php/Social_media/instagramShare';
$config['instagram_website']		= base_url().'index.php/Social_media';
$config['instagram_description']	= 'App to post data to social media';

/**
 * Instagram provides the following scope permissions which can be combined as likes+comments
 * 
 * basic - to read any and all data related to a user (e.g. following/followed-by lists, photos, etc.) (granted by default)
 * comments - to create or delete comments on a user’s behalf
 * relationships - to follow and unfollow users on a user’s behalf
 * likes - to like and unlike items on a user’s behalf
 * 
 */
$config['instagram_scope'] = 'basic';

// There was issues with some servers not being able to retrieve the data through https
// If you have this problem set the following to FALSE 
// See https://github.com/ianckc/CodeIgniter-Instagram-Library/issues/5 for a discussion on this
$config['instagram_ssl_verify']		= False;
