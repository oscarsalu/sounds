<?php
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '1452082045093489','1630d731bfffe3d3ec4497c67c4cd5ba' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper(base_url().'account/login/fb' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
    $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
    $fbfirstname = $graphObject->getProperty('first_name'); // To Get Facebook full name
    $fblastname = $graphObject->getProperty('last_name'); // To Get Facebook last name
    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
    $fgender =  $graphObject->getProperty('gender');
    /* ---- Session Variables -----*/
    $_SESSION['FB_ID'] = $fbid;           
    $_SESSION['FB_FIRSTNAME'] = $fbfirstname;
    $_SESSION['FB_LASTSNAME'] = $fblastname;
    $_SESSION['EMAIL'] =  $femail;
    $_SESSION['FB_GENDER'] =  $fgender;
    /* ---- header location after session ----*/
    header("Location: ".base_url('account/login/fb/st1'));
    //header("Location: ".base_url('account/register/fb/check'));
} else {
     //var_dump('adsdsf');die;
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}
?>