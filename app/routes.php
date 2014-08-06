<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Controller possibilities
 * / =-> home
   /profile =-> all users
   /profile/{screen_name} =-> specific user
   /tag
   /search
   /leaders
   /
 */

Route::get('/', array(
  'as'   => 'home',
  'uses' => 'UserController@index'
));

/**
 * Leaders
 */
Route::get('leaders/tweets', array(
  'as'   => 'leader.tweets',
  'uses' => 'LeaderController@getTweets'
));

Route::get('leaders/tweets/popular', array(
  'as' => 'leader.tweets.popular',
  'uses' => 'LeaderController@getTweetsPopular'
));

Route::post('leaders/tweets/search', 
  'LeaderController@postSearchTweets');

Route::get('leaders/mentions', array(
  'as' => 'leader.mentions',
  'uses' => 'LeaderController@getMentions'
));

Route::post('leaders/mentions/search', 
  'LeaderController@postSearchUsers');

Route::get('leaders/retweets', array(
  'as' => 'leader.retweets',
  'uses' => 'LeaderController@getRetweets'
));

Route::post('leaders/retweets/search', 
  'LeaderController@postSearchUsers');

Route::get('leaders/tags', array(
  'as' => 'leader.tags',
  'uses' => 'LeaderController@getTags'
));

Route::post('leaders/tags/search', 
  'LeaderController@postSearchTags');


Route::get('engagement-account/{acct}', function($acct) {

  $q = "
    SELECT *
    FROM tc_user
    WHERE screen_name = ?
  ";

  $user = DB::select($q, array($acct));

  return View::make('engagement-account')
    ->with('acct', $acct)
    ->with('user', $user[0]);

});


// names the route 'profile'; 
// we refer to this route in the view in order to make some links;
// in the array arg, notice as pass the controller with 'uses'
Route::get('/user/{screen_name}', array(
  'as' => 'user', 
  'uses' => 'UserController@show'
));


// test mysql connection
Route::get('mysql-test', function() {
  
  // use the DB component to select all the databases
  $results = DB::select('show databases');

  echo Paste\Pre::r($results);

});

// test Eloquent ORM
Route::get('/practice-reading', function() {
  //$user_id = 19262807;

  // get TheDO
  $tweet = Tweet::first();
  //$user = User::find($user_id);
  $user = User::where('user_id', '=', '19262807');
    //->first();
  //$user = User::first();

  echo Paste\Pre::r($user->first()->screen_name);

});

// from susan's notes
Route::get('/debug', function() {
  
  echo '<pre>';

  echo '<h1>environment.php</h1>';
  $path = base_path() . '/environment.php';
  
  try {
    $contents = 'Contents: ' . File::getRequire($path);
    $exists = 'Yes';
  } catch (Exception $e) {
    $exists = 'No. Defaulting to `production`';
    $contents = '';
  }

  echo '</pre>';
});

Route::get('tweets/{screen_name}', function($screen_name) {

  $user = User::where('screen_name', '=', $screen_name)
    ->first();

});
