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
Route::get('rank', 'RankController@index');
Route::get('showRank', 'RankController@showRank');
Route::get('socialWorker', 'SocialWorkerController@index');

//These routes are used to social section of the web site
Route::get('social/overview', 'SocialController@index');
Route::get('social/cidades', 'SocialController@cidades');
Route::get('social/allTagsTopTen', 'SocialController@allTagsTopTen');
Route::get('social/sumAllTags', 'SocialController@sumAllTags');
Route::get('social/allTags', 'SocialController@selectAllTags');
Route::get('social/userAgeRange', 'SocialController@userAgeRange');
Route::get('social/peopleFrom', 'SocialController@peopleFrom');
Route::get('facebook', 'FbController@index');

//These routes will be used to request the charts for the profile page
Route::get('profiles/{cityName}', 'CityProfileController@index');
Route::get('profiles/profile/{cityName}', 'CityProfileController@profile');
Route::get('profiles/education/{cityName}', 'CityProfileController@educationDomain');
Route::get('profiles/governmentExpenditures/{cityName}', 'CityProfileController@governmentExpendituresDomain');
Route::get('profiles/health/{cityName}', 'CityProfileController@healthDomain');
Route::get('profiles/economy/{cityName}', 'CityProfileController@economyDomain');
Route::get('profiles/employment/{cityName}', 'CityProfileController@employmentDomain');
Route::get('profiles/environment/{cityName}', 'CityProfileController@environmentDomain');
//END profile routes

//Criar link para efetuar login
Route::get('social/facebook/login', ['as' => 'facebook.login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb){
  //Envia um array com permissoes a serem solicitadas
  $login_url = $fb->getLoginUrl(['email', 'user_posts', 'user_location', 'user_birthday']);
  return $login_url;
}]);

//Depois da tentativa de login no Facebook sera redirecionado paara endpoint
Route::get('facebook/callback', ['as' => 'facebook.callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb){
  //obtain access token
  try{
    $token = $fb->getAccessTokenFromRedirect();
  }catch (Facebook\Exceptions\FacebookSDKException $e)
  {
    dd($e->getMessage());
    return redirect()->action('FbController@index');
  }

  if(!$token){
    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    $helper = $fb->getRedirectLoginHelper();
    if(!$helper->getError()){
      abort(403, 'Unauthorized action.');
    }
    //user denied Request
    return redirect()->action('FbController@index');
    //dd(
      //$helper->getError(),
      //$helper->getErrorCode(),
      //$helper->getErrorReason()//,
      //$helper->getErrorDescrption()
    //);
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
    $response = $fb->get('/me?fields=id,name,birthday,location, email');
  }catch(Facebook\Exceptions\FacebookSDKException $e){
    dd($e->getMessage());
  }

  //Convert the response to a Facebook\GraphNodes/GraphUser collection
  $facebook_user = array_dot($response->getGraphUser());
  Session::put('fb_user_info', $facebook_user);
  Session::put('isFBLogged', true);

  return redirect()->action('FbController@index');

}]);
