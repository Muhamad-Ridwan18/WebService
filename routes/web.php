<?php
/** @var \Laravel\Lumen\Routing\Router $router /

*/

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
$router->get('/users/{userId}', 'UserController@show');
$router->get('/categories', 'CategoryController@index');
$router->get('/users', 'UserController@index');
$router->get('/tags', 'TagController@index');
$router->get('/comments', 'CommentController@index');

// Route for PostController
$router->get('/posts', 'PostController@index');
$router->get('/posts/{id}', 'PostController@show');
$router->post('/posts', 'PostController@store');
$router->put('/posts/{id}', 'PostController@update');
$router->delete('/posts/{id}', 'PostController@destroy');




