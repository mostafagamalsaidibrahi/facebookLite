<?php

/* Route for index view */

Route::get('/', function () {
    return view('index');
});

// Route for sign up [ creating new account ]
Route::post('/signUp' , "AccountController@signUp")->name('signUp');

// Route for login [ creating login ]
Route::post('login' , "AccountController@login")->name('login');

// Route for getting home page
Route::get('home' , "HomeController@getHome")->name('home');

// Route for getting user profile page
Route::get('profile/{id}' , "HomeController@getProfile");

// Route for adding new post
Route::post('addPost' , "HomeController@addPost")->name('addPost');

// Route for delete post
Route::post('deletePost' , "HomeController@deletePost")->name('deletePost');

// Route for like post
Route::post('likePost' , "HomeController@likePost")->name('likePost');

// Route for comment on post
Route::post('commentOnPost' , "HomeController@commentOnPost")->name('commentOnPost');

// Route for show comments of post
Route::get('showCommentOfPost/{postId}' , "HomeController@showCommentOfPost");
Route::post('showCommentOfPost/{postId}' , "HomeController@showCommentOfPost");

// Route for making share posts
Route::post('sharePost' , "HomeController@sharePost")->name('sharePost');

// Route for update profile picture
Route::get('/updateProfilePicture' , "HomeController@updateProfilePicture");
Route::post('/updateProfilePicture' , "HomeController@updateProfilePicture");

// Route for getting friends section
Route::get('/friends', "HomeController@gettingFriendsSectionData");

// Route for add friend
Route::post('addFriend' , "HomeController@addFriend")->name('addFriend');

// Route for Accepting friend request
Route::get('acceptFriend/{fId}' , "HomeController@acceptFriend");
Route::post('acceptFriend/{fId}' , "HomeController@acceptFriend");

// Route for rejecting friend request
Route::get('rejectFriend/{fId}' , "HomeController@rejectFriend");
Route::post('rejectFriend/{fId}' , "HomeController@rejectFriend");

// Route for getting user profile
Route::get('friendProfile/{fId}' , "HomeController@friendProfile");

// Route for sign Out
Route::get('signOut' , "AccountController@signOut");

// Route for sending messege
Route::post('sendMsg' , "HomeController@sendMsg")->name('sendMsg');

// Route for getting messege
Route::get('getMsg' , "HomeController@getMsg")->name('getMsg');

// Route for going to friend chat view
Route::get('face_Messenger/{fId}' , "HomeController@goToFriendChat")->name('face_Messenger');

// Route for getting messenger view
Route::get('messenger' , "HomeController@messenger");
