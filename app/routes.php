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

Route::get('/', array(
  'as' => 'home',
  'uses' => 'UserController@index',
));

Route::get('tags/{group}', array(
  'as' => 'tags',
  'uses' => 'TagController@index',
));

Route::post('tags/search', 'TagController@postSearch');

Route::get('tweets/{group}', array(
  'as' => 'tweets',
  'uses' => 'TweetController@index'
));

Route::get('tweets/search/circle', array(
  'as' => 'tweets.search.circle',
  'uses' => 'TweetController@getSearchTweets'
));

Route::post('tweets/search/circle', 'TweetController@postSearchTweets');

Route::post('tweets/search', 
  'TweetController@postSearch');

Route::get('tweets/popular/{group}', array(
  'as' => 'tweets.popular',
  'uses' => 'TweetController@getPopular',
));

Route::get('users/mentions-by/{group}', array(
  'as' => 'users.mentions-by',
  'uses' => 'UserController@getMentionsBy',
));

Route::post('users/search/mentions-by', 
  'UserController@postSearchMentionsBy');

Route::get('users/retweets-by/{group}', array(
  'as' => 'users.retweets-by',
  'uses' => 'UserController@getRetweetsBy',
));

Route::get('users/search', array(
  'as' => 'users.search',
  'uses' => 'UserController@getSearch',
));

Route::post('users/search', 'UserController@postSearch');

Route::post('users/search/retweets-by',
  'UserController@postSearchRetweetsBy');

Route::get('user/{screen_name}', array(
  'as' => 'user',
  'uses' => 'UserController@show',
));


