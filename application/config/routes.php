<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'home/index';
$route['404_override'] = 'myerror/error_404';
$route['translate_uri_dashes'] = true;

$route['access_login'] = 'home/check_access';
$route['access'] = 'home/access';

$route['change_text'] = 'text/update';

$route['auth/register'] = 'auth/adduser';
$route['account/signup'] = 'auth/register';
$route['account/login'] = 'auth/getlogin';
$route['auth/login'] = 'auth/postlogin';
$route['auth/forgot_pass'] = 'auth/forgotPass';
$route['account/logout'] = 'auth/logout';
$route['account/forgotten_password'] = 'auth/forgottenPassword';
$route['account/forgot_pass'] = 'auth/forgotPass';
$route['auth/reset_password/(:any)/(:any)'] = 'auth/resetPassword/$1/$2';
$route['account/post_reset_password'] = 'auth/postResetPassword';
//$route['account/check_login/fb'] = 'auth/check_login_facebook';

//Route for varification link
$route['account/verification/(:any)'] = 'auth/verification/$1';

//Route for resend varification mail
$route['account/resend_verification_mail'] = 'auth/resendVerificationMail';

//Route for resend varification mail
$route['loadcaptch'] = 'captcha/index';

$route['account/register/fb/check'] = 'auth/registerFbCheck';
$route['account/register/fb/st1'] = 'auth/registerFbSt1';
$route['account/register/fb/st2'] = 'auth/registerFbSt2';
$route['account/register/fb/st3'] = 'auth/registerFbSt3';
$route['account/login/fb'] = 'auth/loginFb';
$route['account/login/fb/st1'] = 'auth/loginFbPost';
$route['account/register/gg'] = 'auth/registerWithGoogle';
$route['account/register/gg/st1'] = 'auth/registerGgSt1';
$route['account/register/gg/st2'] = 'auth/registerGgSt2';
$route['account/register/gg/st3'] = 'auth/registerGgSt3';
$route['account/login/gg'] = 'auth/loginGgPost';
$route['account/login_affiliate'] = 'auth/loginAffiliate';

$route['account/register/affliate'] = 'auth/registerAffliate';
$route['account/register/post_aff'] = 'auth/postRegisterAffliate';


$route['admin/dashboard'] = 'admin/dashboard/index';
$route['admin/users'] = 'admin/users/index';
$route['admin/users/add_user'] = 'admin/users/add_user';
$route['admin/users/change_pass'] = 'admin/users/change_password';
$route['admin/users/delete_user'] = 'admin/users/delete';
$route['admin/users/lock_user'] = 'admin/users/lock'    ;
$route['admin/users/unlock_user'] = 'admin/users/unlock';
$route['admin/withdrawals'] = 'admin/withdrawals/index';

$route['admin/backgrounds'] = 'admin/backgrounds/index';
$route['admin/backgrounds/loaddata'] = 'admin/backgrounds/get_all_data';
$route['admin/backgrounds/add_page'] = 'admin/backgrounds/add_page';
$route['admin/backgrounds/update_background'] ='admin/backgrounds/upload_background';

$route['admin/background-video'] = 'admin/Background_video/index';
$route['admin/video/loaddata'] = 'admin/Background_video/get_all_data';
$route['admin/video/add_page'] = 'admin/Background_video/add_page';
$route['admin/video/change-video'] = 'admin/Background_video/update';

$route['admin/blogs']               = 'admin/manager_blogs/index';
$route['admin/blog-create']         = 'admin/manager_blogs/create_blogs';
$route['admin/edit-blog']           = 'admin/manager_blogs/update_blogs';
$route['admin/delete-blog']         = 'admin/manager_blogs/delete_blogs';
$route['admin/set_keyword']         = 'admin/manager_blogs/set_keyword';
$route['admin/keyword/loaddata']    = 'admin/manager_blogs/loaddata';
$route['admin/update_key']          = 'admin/manager_blogs/update_key';
$route['blogs']                     = 'artist/blogs/list_blogs';
$route['blogs/(:any)']              = 'artist/blogs/read_blog_admin/$1';
$route['admin/blogs/unlock']        = 'admin/manager_blogs/unlock';
$route['admin/premium']                     = 'admin/premium/index';
$route['admin/premium/list/(:num)']                       = 'admin/premium/list_artist/$1';
$route['admin/premium/page']                              = 'admin/premium/index';
$route['admin/premium/page/(:num)']                       = 'admin/premium/index/$1';

$route['admin/premium/sent_email_tried_artist']           = 'admin/premium/sent_email_tried_artist';
$route['admin/premium/premium_expire']                    = 'admin/premium/premium_expire';

$route['admin/template-land']                             = 'admin/template/index';
$route['admin/tempate/lock_tempate']                      = 'admin/template/lock_tempate';
$route['admin/tempate/unlock_tempate']                    = 'admin/template/unlock_tempate';
$route['admin/template/update']                           = 'admin/template/update';
$route['admin/tempate/delete']                            = 'admin/template/delete';

$route['admin/locations']                                 = 'admin/locations/index';
$route['admin/locations/do_upload']                       = 'admin/locations';
//$route['locations/do_upload'] = 'locations/do_upload';
$route['admin/locations/do_upload']                       ='admin/locations/do_upload';
$route['admin/locations/view_location']                   ='admin/locations/view_location';
$route['admin/locations/list/(:num)']                     = 'admin/locations/view_location/$1';
$route['admin/delete-location']                           ='admin/locations/delete_location';
$route['admin/edit-location']                             ='admin/locations/edit_location';
$route['admin/add-location']                              ='admin/locations/add_location';
//$route['admin/locations/(:num)']                          = 'admin/locations/index/$1';
$route['admin/locations/page']                            = 'admin/locations/index';
$route['admin/locations/page/(:num)']                     = 'admin/locations/index/$1';
$route['admin/locations/search']                          = 'admin/locations/index';
$route['admin/locations/create']                          = 'admin/locations/creater_lat_lng';
$route['cronjob']                                         = 'cronjob/index';

$route['gigs_events']                                     = 'gigs_events/view_event';
$route['artist/managerevent']                             = 'gigs_events/index';
$route['gigs_events/create']                              = 'gigs_events/create';
$route['gigs_events/edit/(:num)']                         = 'gigs_events/edit/$1';
$route['artist/gigs_events/update/(:num)']                = 'gigs_events/update/$1';
$route['artist/gigs_events/delete']                       = 'gigs_events/delete';
$route['gigs_events/getdata']                             = 'gigs_events/getdata';
$route['gigs_events/read/(:any)']                         = 'gigs_events/read_event/$1';
$route['gigs_events/read_delete']                              = 'gigs_events/delete_event';

$route['the_total_tour/members/(:num)/(:num)'] = 'member/index/$1/$2';
$route['the_total_tour/members/(:num)'] = 'member/index/$1/$2';
$route['members/delete_member'] = 'member/delete_member';

$route['members/update_price'] = 'member/update_price';
$route['members/delete_price'] = 'member/delete_price';

$route['members/get_event'] = 'member/get_event';
$route['members/data_event'] = 'member/data_event';

$route['members/update_member'] = 'member/update_member';
$route['members/getdatamember'] = 'member/getdatamember';
$route['members/addcaculate'] = 'member/addcaculate';

$route['the_total_tour/caculate/(:num)/(:num)/(:num)'] = 'member/caculate/$1/$2/$3';
$route['the_total_tour/caculate/(:num)/(:num)'] = 'member/caculate/$1/$2/$3';
$route['the_total_tour/caculate/(:num)'] = 'member/caculate/$1/$2/$3';
$route['the_total_tour/event/(:num)/(:num)'] = 'member/event/$1/$2';
$route['the_total_tour/event/(:num)'] = 'member/event/$1/$2';
$route['the_total_tour/tax_caculate'] = 'more_ttt/tax_caculate';
$route['the_total_tour/income_tax'] = 'more_ttt/income_tax';


$route['the_total_tour'] = 'the_total_tour/index';
$route['the_total_tour/actvie_member/(:any)']      = 'the_total_tour/actvie_member/$1';
$route['the_total_tour/find_locations/send_mail']  = 'locations/send_mail';
$route['the_total_tour/find_locations/find_state'] = 'locations/find_locations_state';
$route['the_total_tour/find_locations/find_city']  = 'locations/find_locations_city';
$route['the_total_tour/find_locations/(:num)']       = 'locations/locations/$1';


$route['social_media'] = 'social_media/index';
$route['social_media/insert_db'] = 'social_media/insert_db';
$route['social_media/fbPost_video'] = 'social_media/fbPost_video';
$route['social_media/fbpost_photo'] = 'social_media/fbpost_photo';
$route['mds'] = 'mds/index';
$route['make_money'] = 'make_money/index';
$route['world_wide_featured'] = 'world_wide_featured/index';

$route['plans'] = 'our_plans/index';
$route['fancapture'] = 'fancapture/index';
$route['fancapture/filter_genre/(:num)'] = 'fancapture/filter_genre/$1';
$route['fancapture/load_list_artist_search'] = 'fancapture/load_list_artist_search';
$route['fancapture/search_fcp'] = 'fancapture/search';
$route['fancapture/call_print'] = 'fancapture/call_print';
$route['fancapture/load_list_artist'] = 'fancapture/load_list_artist';
$route['fancapture/load_list_artist_genre'] = 'fancapture/load_list_artist_genre';

$route['find-a-musician'] = 'find_a_musician/index';
$route['find-a-musician/search'] = 'find_a_musician/search';
$route['find-a-musician/(:any)'] = 'find_a_musician/musicians/$1';
$route['find-a-musician/music_list/(:num)/(:any)'] ='find_a_musician/add_music_list/$1/$2';



$route['local-featured'] = 'artist/local_featured/index';
$route['top-100-list'] = 'fan/fan/top_100_list';
$route['fan/fan_load_more'] = 'fan/fan/fan_load_more';
$route['features/local_featured_load_more'] = 'artist/local_featured/local_featured_load_more';

$route['fan/fan_pics'] = 'fan/fan/fan_pics';
$route['fan/flp'] = 'fan/fan/flp';
$route['features/find-a-fan'] = 'features/find_a_fan/index';
$route['features/find-an-artist'] = 'features/find_an_artist/index';
$route['features/new-trending'] = 'features/new_trending/index';
$route['find-a-show'] = 'features/find_a_show/index';
    
    
$route['musicians/create'] = 'musicians_bands/create';
$route['musicians/edit/(:num)'] = 'musicians_bands/edit/$1';
$route['musicians/update/(:num)'] = 'musicians_bands/update/$1';
$route['musicians/delete/(:num)'] = 'musicians_bands/delete/$1';

$route['artists'] = 'artist/all_artist/index';

$route['artists/ajax_data'] = 'artist/all_artist/load_ajax';
$route['artists/search_artists'] = 'artist/all_artist/search_artists';
$route['artists/get_total_rows'] = 'artist/all_artist/get_total_rows';

$route['artist/new_song'] = 'artist/audio/new_song';
$route['artist/update_song'] = 'artist/audio/update_song';
$route['artist/upload_song'] = 'artist/audio/upload_song';
$route['artist/upload_file_audio'] = 'artist/audio/upload_file_audio';
$route['artist/upload_file_video'] = 'artist/audio/upload_file_video';
$route['artist/delete_file_video'] = 'artist/audio/delete_file_video';
$route['artist/load_duration'] = 'artist/audio/load_duration';
$route['artist/finish_upload_song'] = 'artist/audio/finish_upload_song';

$route['artist/edit_song/(:num)/(:num)'] = 'artist/audio/view_edit_song/$1/$2';
/*Lyrics*/
$route['artist/edit_lyric/(:num)/(:num)'] = 'artist/audio/view_edit_lyric/$1/$2';
$route['artist/lyriclist/(:num)'] = 'artist/audio/lyrics/$1';
$route['artist/addlyrics'] = 'artist/audio/updatelyrics';
$route['artist/update_lyrics'] = 'artist/audio/update_lyrics';
/* Get Lyrics */
$route['artist/lyricmanager'] = 'artist/audio/get_lyric';

$route['artist/finish_edit_song'] = 'artist/audio/finish_edit_song';
$route['artist/playlist/new_song/(:num)'] = 'artist/audio/view_upload_song/$1';
$route['artist/managersong'] = 'artist/audio/manager';
$route['artist/deletesong'] = 'artist/audio/deletesong';

$route['artist/downloadsong/(:num)'] = 'artist/audio/downloadsong/$1';
$route['artist/newplaylist'] = 'artist/audio/new_playsit';
$route['artist/editplaylist'] = 'artist/audio/editplaylist';
$route['artist/deleteplaylist'] = 'artist/audio/deleteplaylist';
$route['artist/playlist/(:num)'] = 'artist/audio/manager_song/$1';


$route['artist/uploadvideo'] = 'artist/videos/uploadvideo';
$route['artist/managervideo'] = 'artist/videos/manager';
$route['artist/editvideo'] = 'artist/videos/editvideo';
$route['artist/deletevideo'] = 'artist/videos/deletevideo';
$route['artist/addvideo'] = 'artist/videos/addvideo';
$route['artist/upfile_video'] = 'artist/videos/upfile_video';
$route['artist/allvideos/(:num)'] = 'artist/videos/allvideos/$1';

$route['artist/change_avatar']  = 'artist/cropavatar';
$route['artist/crop_banner']  = 'artist/cropbanner';
$route['artist/newphoto'] = 'artist/photos/newphoto';
$route['artist/uploadphoto'] = 'artist/photos/uploadphoto';
$route['artist/managerphoto'] = 'artist/photos/manager';
$route['artist/updatephoto/(:num)'] = 'artist/photos/update/$1';
$route['artist/delete/(:num)'] = 'artist/photos/delete/$1';
$route['artist/load_data_photo'] = 'artist/photos/load_data_photo';

$route['artist/addblogs'] = 'artist/blogs/addblogs';
$route['artist/blogsmanager'] = 'artist/blogs/manager';
$route['artist/editblogs'] = 'artist/blogs/editblogs';
$route['artist/deleteblogs'] = 'artist/blogs/deleteblogs';
$route['artist/addnewblogs'] = 'artist/blogs/addnewblogs';
$route['artist/allblogs/(:num)'] = 'artist/blogs/allblogs/$1';
$route['artist/allblogs/(:num)/(:num)'] = 'artist/blogs/allblogs/$1/$2';

$route['artist/blogs/comment-blog'] = 'artist/blogs/comment';

$route['(:any)'] = 'artist/member/index/$1';
$route['(:any)/photos'] = 'artist/member/allphoto/$1';
$route['(:any)/songs'] = 'artist/member/allsong/$1';
$route['artist/comefan/(:num)/(:any)'] = 'artist/member/becomefan/$1/$2';
$route['artist/membercomment'] = 'artist/member/membercomment';
$route['artist/profile'] = 'artist/admin_profile/index';
$route['artist/allsong/(:num)'] = 'artist/admin_profile/allsong/$1';
$route['artist/addbio'] = 'artist/admin_profile/addbio';
$route['artist/basic_info'] = 'artist/admin_profile/basic_info';
/* Get Bio */
$route['artist/biomanager'] = 'artist/admin_profile/get_bio';


$route['artist/upadate_general'] = 'artist/admin_profile/upadate_general';
$route['artist/upadate_contact'] = 'artist/admin_profile/upadate_contact';
$route['artist/changelayout'] = 'artist/admin_profile/changelayout';
$route['artist/update_social'] = 'artist/admin_profile/update_social';
$route['artist/upadate_bio'] = 'artist/admin_profile/upadate_bio';
/* Update Lyrics*/
$route['artist/update_lyric'] = 'artist/admin_profile/update_lyric';

$route['artist/updatebanner'] = 'artist/admin_profile/updatebanner';
$route['artist/newstatus'] = 'artist/admin_profile/newstatus';
$route['artist/comment'] = 'artist/admin_profile/addcomment';

$route['artist/manager-comment'] ='artist/admin_profile/managercomment';
$route['artist/allcomment/(:num)'] = 'artist/admin_profile/allcomment/$1';
$route['artist/delete-comment/(:num)'] = 'artist/admin_profile/deletecomment/$1';


$route['features/artist_premium'] = 'features/artist/artist_premium';
$route['features/artist_premium_load_more'] = 'features/artist/artist_premium_load_more';
$route['features/artist_premium_load/(:num)'] = 'features/artist/artist_premium_load/$1';
$route['features/hot_video_picks'] = 'features/artist/hot_video_picks';

$route['features/fan_feature'] = 'features/fan/fan_feature';

$route['notifications/all'] = 'notices/index';
$route['notifications/remove/(:num)'] ='notices/remove/$1';
$route['artist/allfans/(:num)'] = 'artist/admin_profile/allfans/$1';
$route['artist/delete-fan/(:num)'] = 'artist/admin_profile/deletefan/$1';
$route['artist/fans/(:num)'] = 'artist/member/fans/$1';
$route['artist/change_password'] = 'artist/admin_profile/change_password';

$route['artist/addmember'] = 'artist/Managermember/addmember';
$route['artist/managermember'] = 'artist/Managermember/manager';
$route['artist/addmember_new'] = 'artist/Managermember/addmember_new';
$route['artist/editmember'] = 'artist/Managermember/editmember';
$route['artist/cancelinvite/(:num)'] = 'artist/Managermember/cancel/$1';
$route['artist/member/(:any)/(:any)'] = 'artist/Managermember/active_member/$1/$2';
#press kit electronic
$route['epk/(:any)'] = 'artist/presskit/index/$1';
$route['artist/presskit/sendmail/(:num)'] = 'artist/presskit/sendmail/$1';
$route['artist/dashboard_epk'] = 'artist/presskit/presskit';
$route['artist/dashboard_epk/load_tpl_email/(:num)'] = 'artist/presskit/load_tpl_email/$1';
$route['artist/dashboard_epk/download/bio/(:num)'] = 'artist/presskit/download_bio/$1';
$route['artist/update_tplepk'] = 'artist/presskit/update_tplepk';
$route['artist/presskit/contact'] = 'artist/presskit/contact';
$route['epk/download/photo/(:num)/(:any)'] ='artist/presskit/download_photo/$1/$2';
$route['epk/download/video/(:num)/(:any)'] ='artist/presskit/download_video/$1/$2';

$route['artist/presskit/customize'] = 'artist/presskit/getcustomize';
$route['artist/presskit/postcustomize'] = 'artist/presskit/postcustomize';
$route['artist/presskit/email_contact'] = 'artist/presskit/email_contact';
$route['epk/download/song/(:num)'] = 'artist/presskit/download_song/$1';
#end epk
$route['artist/call_ajax_data_song'] = 'artist/audio/call_ajax_data_song';
$route['artist/addpress'] = 'artist/press/addpress';
$route['artist/allpress/(:num)'] = 'artist/press/allpress/$1';
$route['artist/addnewpress'] = 'artist/press/addnewpress';
$route['artist/managerpress'] = 'artist/press/manager';
$route['artist/editpress'] = 'artist/press/editpress';
$route['artist/deletepress'] = 'artist/press/deletepress';

$route['chat/(:num)'] = 'chat/chat/index/$1';
$route['chat/ajax_messages/(:num)'] = 'chat/chat/ajax_messages/$1';
$route['chat/ajax_send/(:num)'] = 'chat/chat/ajax_send/$1';
$route['chat/ajax_update/(:num)'] = 'chat/chat/ajax_update/$1';
$route['chat/dashboard'] = 'chat/dashboard/index';
$route['chat/search'] = 'chat/dashboard/search';
$route['chat/addfriend'] = 'chat/dashboard/addfriend';
$route['chat/invite_contact'] = 'chat/dashboard/invite_contact';
$route['chat/deleteinvite'] = 'chat/dashboard/deleteinvite';
$route['chat/load_recent_chat'] = 'chat/dashboard/load_recent_chat';

$route['chat/addgroup'] = 'chat/dashboard/addgroup';
$route['chat/editgroup'] = 'chat/dashboard/editgroup';
$route['chat/delgroup'] = 'chat/dashboard/delgroup';

$route['chat/channel/(:any)'] = 'chat/channel/index/$1';
$route['chat/channel/ajax_messages/(:num)'] = 'chat/channel/ajax_messages/$1';
$route['chat/channel/ajax_send/(:num)'] = 'chat/channel/ajax_send/$1';
$route['chat/channel/ajax_update/(:num)'] = 'chat/channel/ajax_update/$1';
$route['chat/spam_word/(:any)'] = 'chat/channel/ajax_word_check/$1';

$route['chat/group/(:num)'] = 'chat/groups/index/$1';
$route['chat/group/ajax_messages/(:num)'] = 'chat/groups/ajax_messages/$1';
$route['chat/group/ajax_send/(:num)'] = 'chat/groups/ajax_send/$1';
$route['chat/group/ajax_update/(:num)'] = 'chat/groups/ajax_update/$1';


$route['chat/artist/(:any)'] = 'chat/artist/index/$1';
$route['chat/artist/ajax_messages/(:num)'] = 'chat/artist/ajax_messages/$1';
$route['chat/artist/ajax_send/(:num)'] = 'chat/artist/ajax_send/$1';
$route['chat/artist/ajax_update/(:num)'] = 'chat/artist/ajax_update/$1';

$route['home/post_notify'] = 'home/post_notify';
$route['chat/endcontact/(:num)'] = 'chat/dashboard/endcontact/$1';
$route['subscriptions/upgrade'] = 'subscriptions/upgrade';
$route['subscriptions/postupgrade'] = 'subscriptions/postupgrade';
$route['subscriptions/checkout/(:any)'] = 'subscriptions/checkout_card/$1';
$route['subscriptions/create_hostedpages'] = 'subscriptions/create_hostedpages';
$route['subscriptions/success/(:any)'] = 'subscriptions/success_create/$1';
$route['subscriptions/subscriptions_plan'] = 'subscriptions/subscriptions_plan';
$route['subscriptions/get_subscription'] = 'subscriptions/get_subscription';
$route['account/credit'] = 'subscriptions/credit_info';
$route['account/billing_history'] = 'subscriptions/billing_history';
$route['subscriptions/cancel'] = 'subscriptions/cancel';
$route['subscriptions/retrieve/(:num)'] = 'subscriptions/reactivate_subscription/$1';
$route['subscriptions/popup'] = 'subscriptions/popup';
$route['subscriptions/retrieve/(:num)'] = 'subscriptions/reactivate_subscription/$1';
$route['subscriptions/update_card'] = 'subscriptions/update_card';
$route['subscriptions/checkout_paypal'] = 'subscriptions/checkout_paypal';
$route['view_invoice/(:num)'] = 'subscriptions/view_invoice/$1';

$route['map/get_audio'] = 'artist/map/get_audio';
$route['map/get_epk_audio'] = 'artist/map/get_epk_audio';
$route['map/get_song'] = 'artist/map/get_song';
$route['map/buycart'] = 'artist/map/buycart';
$route['map/execute_payment'] = 'artist/map/execute_payment';
$route['map/download_songs'] = 'artist/map/download_songs';
$route['map/map_download_song/(:any)/(:num)'] = 'artist/map/map_download_song/$1/$2';
$route['map/cancel_buy'] = 'artist/map/cancel';
$route['map/payment_paypal'] = 'artist/map/payment_paypal';

$route['map/MakePayment/(:any)/(:num)']='artist/map/MakePayment/$1/$2';
$route['amper/become_affiliate/(:any)'] =  'amper/amper/become_affiliate/$1';
$route['amper/confirm_amper'] =  'amper/amper/confirm_register';
$route['amper/register_post'] =  'amper/amper/register_post';
$route['amper/profile'] =  'amper/amper/profile';
$route['amper/edit_profile'] =  'amper/amper/edit_profile';
$route['amper/settingwitdget'] =  'amper/amper/settingwitdget';
$route['amper/dashboard_setting_amp'] =  'amper/amper/dashboard_setting_amp';

#AMP Comments
$route['amper/membercomment'] =  'amper/comments/membercomment';
$route['amper/member_post_comment'] =  'amper/comments/member_post_comment';
$route['amper/allcomment/(:any)'] = 'amper/comments/allcomment/$1';
#END AMP Comments
#AMP manager_audios
$route['amper/manager_audios'] =  'amper/manager_audio/index';
$route['amper/tree_json_edit/(:num)'] =  'amper/manager_audio/tree_json_edit/$1';
$route['amper/delete_my_playlist/(:num)'] =  'amper/manager_audio/delete_my_playlist/$1';
$route['amper/edit_album'] =  'amper/manager_audio/edit_album';
$route['amper/get_data_playlist'] =  'amper/manager_audio/get_data_playlist';
#end AMP manager_audios
#AMP affiliate
$route['amper/dashboard_affiliates'] =  'amper/affiliate/dashboard_affiliates';
$route['amper/affiliates/load_level'] =  'amper/affiliate/load_list_level';
$route['amper/affiliates/load_new_affiliate'] = 'amper/affiliate/load_new_affiliate';
$route['amper/affiliates/allow_afiliate/(:any)'] = 'amper/affiliate/allow_afiliate/$1';
$route['amper/affiliates/delete_afiliate/(:any)'] = 'amper/affiliate/delete_afiliate/$1';
$route['amper/post_commission'] =  'amper/affiliate/update_commission';
$route['amper/post_limit_affiliates'] =  'amper/affiliate/update_limit_afiliates';
$route['amper/affiliates/lock/(:any)'] = 'amper/affiliate/lock/$1';
$route['amper/affiliates/unlock/(:any)'] = 'amper/affiliate/unlock/$1';
#end AMP affiliate
#AMP blog
$route['amper/blog'] =  'amper/blogs/index';
$route['amper/upload/blog'] =  'amper/blogs/upload_blog';
$route['amper/delete/blog/(:num)'] =  'amper/blogs/blog_delete/$1';
$route['amper/read/blog/(:num)'] =  'amper/blogs/blog_read/$1';
$route['amper/edit/blog'] =  'amper/blogs/blog_edit/$1';
$route['amper/allblogs/(:any)'] = 'amper/blogs/allblogs/$1';
#AMP blog
#AMP stats
$route['amper/stats'] =  'amper/stats/index';
$route['amper/call_stats'] =  'amper/stats/call_stats';
$route['amper/stats/onoffswitch'] =  'amper/stats/onoffswitch';
$route['amper/counter_song'] =  'amper/stats/counter_song';
#end AMP stats
# AMP chat
$route['amper/chat'] =  'amper/chat/index';
$route['amper/chat/load_level'] =  'amper/chat/load_list_level';
$route['amper/chat/load_artist_chat'] =  'amper/chat/load_artist_chat';
$route['amper/chat/load_recent_chat'] =  'amper/chat/load_recent_chat';
#end AMP chat
#AMP notifications
$route['amper/notifications'] =  'amper/notifications/index';
$route['amper/notifications/onoff_notifi'] =  'amper/notifications/onoff_notifi';
#end AMP notifications
$route['amper/selectalbums/affiliate/(:any)'] =  'amper/amper/selectalbums/$1';
$route['amper/load_changed_songs'] =  'amper/amper/load_changed_songs';
$route['amper/create_album'] =  'amper/amper/create_album';
$route['amper/create_album_finish'] =  'amper/amper/create_album_finish';
#AMP dashbard
$route['amper/dashboard'] =  'amper/amper/dashboard';
$route['amper/upload/bios'] =  'amper/amper/upload_bios';
$route['amper/upload/photo'] =  'amper/amper/upload_photo';
$route['amper/delete/photo/(:num)'] =  'amper/amper/del_photo/$1';
$route['amper/upload/link_video'] =  'amper/amper/link_video';
$route['amper/upload/file_video'] =  'amper/amper/file_video';
$route['amper/delete/video/(:num)'] =  'amper/amper/del_video/$1';
$route['amper/changelayout'] =  'amper/amper/changelayout';
//
$route['amper/change_avatar']  = 'amper/cropavatar';
$route['amper/crop_banner']  = 'amper/cropbanner';
#end AMP dashbard
$route['amp/(:any)/detailsblogs'] =  'amper/amper/detailsblogs/$1';

$route['map/inbox'] = 'artist/map/inbox';
$route['artists/shows/(:any)'] = 'artist/presskit/get_shows/$1';
$route['amper/post_option_widget'] =  'amper/amper/post_option_widget';
$route['map/get_option_widget'] = 'artist/map/get_option_widget';
$route['map/get_option_widget_user_id'] = 'artist/map/get_option_widget_user_id';
$route['video_embed/(:num)'] = 'video_embed/index/$1';
$route['amp/embed/(:any)'] = 'artist/amp/amp_embed/$1';
$route['amp/song_embed/(:any)/(:any)/(:any)'] = 'artist/amp/song_embed/$1/$2/$3';
$route['footer/copyright'] = 'home/coppy_right';
$route['footer/refun'] = 'home/refun';
$route['footer/privacy-policy'] = 'home/privacy_policy';
$route['footer/abuse-policy'] = 'home/abuse_policy';
$route['footer/terms'] = 'home/terms';
$route['footer/our_team'] = 'home/our_team';
$route['footer/amp_form']='auth/amp_form';
$route['amp/(:any)'] =  'amper/amper/index/$1';
$route['the_total_tour/save_tour'] = 'the_total_tour/save_tour';


$route['account/payout'] = 'Payment/payout/';
$route['gigs_events/(:any)']='gigs_events/view_event';
$route['artist/event_search'] = 'artist/event_search/search';

$route['artist/showgigs/(:any)/(:any)'] = 'artist/showgigs/index/$1/$2';
$route['artist/showgigs'] = 'artist/showgigs/index/52.130766083388174/-106.56900182499999';
$route['artist/showgigs/star'] = 'artist/showgigs/get_star';
$route['artist/my_location'] = 'artist/my_location/index';
$route['artist/my_location/(:any)'] = 'artist/showgigs/index'; 
$route['artist/detailsVenus/:any'] = 'artist/detailsVenus/index';
$route['artist/showgigs/rate_venue'] = 'artist/showgigs/rate_venue';
$route['artist/showgigs/booking_request'] = 'artist/showgigs/booking_request';
$route['artist/showgigs/delete'] = 'artist/showgigs/delete_comment';

$route['the_total_tour/schedules/(:num)'] = 'More_ttt/schedules/$1/$2';
$route['the_total_tour/schedules/(:num)/(:num)'] = 'More_ttt/schedules/$1/$2';
$route['the_total_tour/mj_schedules/(:num)'] = 'More_ttt/mj_schedules/$1/$2';
$route['the_total_tour/mj_schedules/(:num)/(:num)'] = 'More_ttt/mj_schedules/$1/$2';

$route['the_total_tour/social_media/(:num)']               = 'social_ttt/index/$1/$2';
$route['the_total_tour/chat_members/(:num)']               = 'chat_members/index/$1';
$route['the_total_tour/chat_members/ajax_messages/(:num)'] = 'chat_members/ajax_messages/$1';
$route['the_total_tour/chat_members/ajax_send/(:num)']    = 'chat_members/ajax_send/$1';
$route['the_total_tour/chat_members/ajax_update/(:num)']   = 'chat_members/ajax_update/$1';

$route['the_total_tour/chat_members/sent_message'] = 'chat_members/sent_message';

$route['the_total_tour/social_media/(:num)/(:num)'] = 'social_ttt/index/$1/$2';
$route['the_total_tour/social_share/(:num)/(:num)'] = 'social_ttt/social_share/$1/$2';

$route['the_total_tour/fbpost_photo'] = 'social_ttt/fbpost_photo';

$route['the_total_tour/social_media/fbPost'] = 'social_ttt/fbPost';

$route['more_ttt/data_schedule'] = 'More_ttt/data_schedule';
$route['more_ttt/get_schedule'] = 'More_ttt/get_schedule';
$route['more_ttt/edit_des_tour'] = 'More_ttt/edit_des_tour';

$route['more_ttt/edit_detail_tour'] = 'More_ttt/edit_detail_tour';
$route['more_ttt/edit_detail_tour_view'] = 'More_ttt/edit_detail_tour_view';
$route['more_ttt/edit_detail_tour_delete'] = 'More_ttt/edit_detail_tour_delete';

$route['more_ttt/get_city_from_country'] = 'More_ttt/get_city_from_country';
$route['more_ttt/show_location_db'] = 'More_ttt/show_location_db';


$route['the_total_tour/find_locations/(:num)'] = 'Locations/locations/$1';


$route['the_total_tour/add_tax_calculate'] = 'More_ttt/add_tax_calculate';
$route['the_total_tour/delete_tax/(:num)'] = 'More_ttt/delete_tax/$1';

$route['the_total_tour/roadtour/(:num)']                = 'More_ttt/roadtour/$1';
$route['the_total_tour/roadtourdata/(:any)']            = 'More_ttt/roadtourdata/$1';
$route['the_total_tour/roadtour/sent_mail']             = 'More_ttt/send_mail_roadtour';
$route['the_total_tour/roadtour/save_itinerary']        = 'More_ttt/save_itinerary_roadtour';
$route['the_total_tour/roadtour/sent_itinerary_mail']   = 'More_ttt/send_mail_itinerary';

$route['the_total_tour/bookashow/(:num)']               = 'More_ttt/bookashow/$1/$2';
$route['the_total_tour/bookashow/(:num)/(:num)']        = 'More_ttt/bookashow/$1/$2';
$route['the_total_tour/bookashow_update']               = 'More_ttt/book_update';
$route['the_total_tour/bookashow_delete']               = 'More_ttt/bookashow_delete';
//$route['the_total_tour/share/(:num)/(:num)']               = 'social_ttt/shareEv/$1/$2';





