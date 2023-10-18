<?php

// use Illuminate\Support\Facades\Route;


// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/hello-lumen', function () {
    return "<h1>Hello Lumen</h1><p>Hi Developer</P>";
});

$router->get('/check-age', ['middleware' => 'checkAge', function () {
    $age = app('request')->input('age');
    return "You are $age years old and allowed to access this page.";
}]);

$router->get('/check-gender', ['middleware' => 'checkGender', function () {
    $gender = app('request')->input('gender');
    return "Your gender is $gender.";
}]);

$router->get('/check-language', ['middleware' => 'checkLanguage', function () {
    $language = app('request')->input('language');
    return "Your preferred language is $language.";
}]);

$router->get('/data', ['middleware' => ['checkName', 'checkPass'], function () {
    $name = app('request')->input('name');
    $pass = app('request')->input('pass');
    return "Hello, $name! Your password is $pass.";
}]);





$router->get('/home', 'HomeController@index');
$router->get('/dashboard', 'DashboardController@index');
$router->get('/dashboard/data', 'DashboardController@getData');
$router->get('/category', 'CategoryController@index');
$router->get('/article', 'ArticleController@index');


$router->get('/', 'UserController@getStatus');
$router->get('/users', 'UserController@index');
$router->get('/users/{userId}', 'UserController@show');
$router->get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
$router->get('/users', [App\Http\Controllers\UserController::class, 'index']);
$router->get('/tags', [App\Http\Controllers\TagController::class, 'index']);
$router->get('/comments', [App\Http\Controllers\CommentController::class, 'index']);

// Route for PostController
$router->get('/posts', [App\Http\Controllers\PostController::class, 'index']);
$router->get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show']);
$router->post('/posts', [App\Http\Controllers\PostController::class, 'store']);
$router->put('/posts/{id}', [App\Http\Controllers\PostController::class, 'update']);
$router->delete('/posts/{id}', [App\Http\Controllers\PostController::class, 'destroy']);




