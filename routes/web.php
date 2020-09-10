<?php
Route::get('/',                                 ['as' => 'frontend.index',      'uses' => 'Frontend\IndexController@index']);


// Authentication Routes...
Route::get('/login',                            ['as' => 'frontend.show_login_form',        'uses' => 'Frontend\Auth\LoginController@showLoginForm']);
Route::post('login',                            ['as' => 'frontend.login',                  'uses' => 'Frontend\Auth\LoginController@login']);
Route::post('logout',                           ['as' => 'frontend.logout',                 'uses' => 'Frontend\Auth\LoginController@logout']);
Route::get('register',                          ['as' => 'frontend.show_register_form',     'uses' => 'Frontend\Auth\RegisterController@showRegistrationForm']);
Route::post('register',                         ['as' => 'frontend.register',               'uses' => 'Frontend\Auth\RegisterController@register']);
Route::get('password/reset',                    ['as' => 'password.request',                'uses' => 'Frontend\Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email',                   ['as' => 'password.email',                  'uses' => 'Frontend\Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}',            ['as' => 'password.reset',                  'uses' => 'Frontend\Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset',                   ['as' => 'password.update',                 'uses' => 'Frontend\Auth\ResetPasswordController@reset']);
Route::get('email/verify',                      ['as' => 'verification.notice',             'uses' => 'Frontend\Auth\VerificationController@show']);
Route::get('/email/verify/{id}/{hash}',         ['as' => 'verification.verify',             'uses' => 'Frontend\Auth\VerificationController@verify']);
Route::post('email/resend',                     ['as' => 'verification.resend',             'uses' => 'Frontend\Auth\VerificationController@resend']);


Route::group(['middleware' => 'verified'], function () {
    Route::get('/dashboard',                    ['as' => 'frontend.dashboard',              'uses' => 'Frontend\UsersController@index']);

    #######################Manegement Post#################

    //create post
    Route::get('/create-post',                  ['as' => 'users.post.create',               'uses' => 'Frontend\UsersController@create_post']);
    Route::post('/create-post',                 ['as' => 'users.post.store',                'uses' => 'Frontend\UsersController@store_post']);
    //edit post
    Route::get('/edit-post/{post_id}',          ['as' => 'users.post.edit',                 'uses' => 'Frontend\UsersController@edit_post']);
    Route::put('/edit-post/{post_id}',          ['as' => 'users.post.update',               'uses' => 'Frontend\UsersController@update_post']);
    //delete post
    Route::delete('/delete-post/{post_id}',     ['as' => 'users.post.destroy',              'uses' => 'Frontend\UsersController@destroy_post']);
    Route::post('/delete-post-media/{post_id}', ['as' => 'users.post.media.destroy',        'uses' => 'Frontend\UsersController@destroy_post_media']);

    #######################Management Comments#################

    Route::get('/comments',                     ['as' =>'users.comments',                    'uses'=>'Frontend\UsersController@show_comments']);
    //edit comments
    Route::get('/edit-comments/{comment_id}',          ['as' => 'users.comment.edit',                 'uses' => 'Frontend\UsersController@edit_comment']);
    Route::put('/edit-comments/{comment_id}',          ['as' => 'users.comment.update',               'uses' => 'Frontend\UsersController@update_comment']);
    //delete comments
    Route::delete('/delete-comments/{comment_id}',     ['as' => 'users.comment.destroy',              'uses' => 'Frontend\UsersController@destroy_comment']);

    #######################Manegement info User#################

    //edit & store info
    Route::get('/edit-info',                    ['as' => 'users.edit_info',                  'uses' => 'Frontend\UsersController@edit_info']);
    Route::post('/create-post',                 ['as' => 'users.update_info',                'uses' => 'Frontend\UsersController@update_info']);
    Route::post('/update-password',              ['as' => 'users.update_password',           'uses' => 'Frontend\UsersController@update_password']);
});



Route::group(['prefix' => 'admin'], function () {
    // Authentication Routes...
    Route::get('/login',                            ['as' => 'admin.show_login_form',       'uses' => 'Backend\Auth\LoginController@showLoginForm']);
    Route::post('login',                            ['as' => 'admin.login',                 'uses' => 'Backend\Auth\LoginController@login']);
    Route::post('logout',                           ['as' => 'admin.logout',                'uses' => 'Backend\Auth\LoginController@logout']);
    Route::get('password/reset',                    ['as' => 'admin.password.request',      'uses' => 'Backend\Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email',                   ['as' => 'admin.password.email',        'uses' => 'Backend\Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}',            ['as' => 'admin.password.reset',        'uses' => 'Backend\Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset',                   ['as' => 'admin.password.update',       'uses' => 'Backend\Auth\ResetPasswordController@reset']);
    Route::get('email/verify',                      ['as' => 'admin.verification.notice',   'uses' => 'Backend\Auth\VerificationController@show']);
    Route::get('/email/verify/{id}/{hash}',         ['as' => 'admin.verification.verify',   'uses' => 'Backend\Auth\VerificationController@verify']);
    Route::post('email/resend',                     ['as' => 'admin.verification.resend',   'uses' => 'Backend\Auth\VerificationController@resend']);


});

Route::get('/contact-us',                       ['as' => 'frontend.contact',                'uses' => 'Frontend\IndexController@contact']);
Route::post('/contact-us',                      ['as' => 'frontend.do_contact',             'uses' => 'Frontend\IndexController@do_contact']);
Route::get('/category/{category_slug}',         ['as' => 'frontend.category.posts',         'uses' => 'Frontend\IndexController@category']);
Route::get('/archive/{date}',                   ['as' => 'frontend.archive.posts',          'uses' => 'Frontend\IndexController@archive']);
Route::get('/author/{username}',                ['as' => 'frontend.author.posts',           'uses' => 'Frontend\IndexController@author']);
Route::get('/search',                           ['as' => 'frontend.search',                 'uses' => 'Frontend\IndexController@search']);
Route::get('/{post}',                           ['as' => 'posts.show',                      'uses' => 'Frontend\IndexController@post_show']);
Route::post('/{post}',                          ['as' => 'posts.add_comment',               'uses' => 'Frontend\IndexController@store_comment']);
