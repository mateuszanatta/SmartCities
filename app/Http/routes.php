<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('cities', 'CitiesController@index');
Route::get('citiesCategories', 'CitiesController@category');
Route::get('social', 'SocialController@index');
Route::get('cidades', 'SocialController@cidades');
Route::get('facebook', 'FbController@index');
Route::get('rank', 'RankController@index');
Route::get('showRank', 'RankController@showRank');
Route::get('profile', 'CityProfileController@index');
//Criar link para efetuar login
Route::get('facebook/login', ['as' => 'facebook.login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
  //Envia um array com permissoes a serem solicitadas
  $login_url = $fb->getLoginUrl(['email']);
  return $login_url;
}]);

//Depois da tentativa de login no Facebook sera redirecionado paara endpoint
Route::get('facebook/callback', ['as' => 'facebook.callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
  //obtain access token
  try{
    $token = $fb->getAccessTokenFromRedirect();
  }catch (Facebook\Exceptions\FacebookSDKException $e)
  {
    dd($e->getMessage);
  }

  if(!$token){
    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    $helper = $fb->getRedirectLoginHelper();
    if(!$helper->getError()){
      abort(403, 'Unauthorized action.');
    }
    //user denied Request
    dd(
      $helper->getError(),
      $helper->getErrorCode(),
      $helper->getErrorReason(),
      $helper->getErrorDescrption()
    );
  }

  //Try to get long lived token_name
  if(!$token->isLongLived()){
    //OAuth 2.0 client handlers
    $oauth_client = $fb->getOAuth2Client();

    //Extend the access token
    try{
      $token = $oauth_client->getLongLivedAccessToken($token);
    }catch(Facebook\Exceptions\FacebookSDKException $e){
      dd($e->getMessage());
    }
  }

  $fb->setDefaultAccessToken($token);

  //save the token for later
  Session::put('fb_user_access_token', (string) $token);

  //Get basic info on the user from facebook
  try{
    $response = $fb->get('/me?fields=id,name');
  }catch(Facebook\Exceptions\FacebookSDKException $e){
    dd($e->getMessage());
  }

  //Convert the response to a Facebook\GraphNodes/GraphUser collection
  $facebook_user = array_dot($response->getGraphUser());
  Session::put('fb_user_info', $facebook_user);
  Session::put('isFBLogged', true);
  Session::put('username', $facebook_user['name']);
  Session::put('picture', $facebook_user['picture']['url']);
  // echo '<pre>';
  // print_r($facebook_user);
  // echo '</pre>';
  return redirect()->action('FbController@index');

}]);
