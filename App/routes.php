<?php

// This is Routing File, all of routes are controlled here.
// format $router->method_name('/uri', 'NameController@Method')

$router->get('/', 'PagesController@index');
$router->get('/books', 'PagesController@booksList');
$router->get('/books/detail/{id}', 'PagesController@booksDetail');
$router->get('/carts', 'PagesController@cart');
$router->get('/admin', 'PagesController@adminadmin');

$router->post('/add/cart', 'UserController@addCart');

$router->get('/dashboard', 'PagesController@dashboard');

// get data
$router->get('/get/categories', 'CategoryController@category');
$router->get('/get/books', 'BooksController@getAllBooks');
$router->get('/get/distributor', 'DistributorController@getAllDistributor');
$router->get('/get/cart', 'UserController@getCart');

$router->post('/upload/picture', 'BooksController@uploadPicture');

// authentication module
$router->get('/logout', 'AuthController@logout');
$router->post('/auth/login/{type}', 'AuthController@login');
$router->post('/auth/register', 'AuthController@register');

// admin module
$router->get('/admin/login', 'AuthController@loginPage');
$router->get('/admin/dashboard', 'PagesController@adminDashboard');

// category module
$router->get('/admin/categories', 'CategoryController@index');
$router->get('/admin/categories/detail/{id}', 'CategoryController@detail');
$router->post('/admin/categories/create', 'CategoryController@store');
$router->put('/admin/categories/update/{id}', 'CategoryController@update');
$router->delete('/admin/categories/delete/{id}', 'CategoryController@delete');

// category module
$router->get('/admin/labels', 'LabelController@index');
$router->get('/admin/labels/detail/{id}', 'LabelController@detail');
$router->post('/admin/labels/create', 'LabelController@store');
$router->put('/admin/labels/update/{id}', 'LabelController@update');
$router->delete('/admin/labels/delete/{id}', 'LabelController@delete');

$router->post('/admin/booklabels', 'LabelController@labelBooksStore');
$router->put('/admin/booklabels', 'LabelController@labelBooksSave');
$router->delete('/admin/booklabels/delete/{id}', 'LabelController@labelBooksDelete');


// distributor module
$router->get('/admin/distributor/detail/{id}', 'DistributorController@getDistributor');
$router->post('/admin/distributor/create', 'DistributorController@store');
$router->put('/admin/distributor/update/{id}', 'DistributorController@update');
$router->delete('/admin/distributor/delete/{id}', 'DistributorController@delete');

// books module
$router->get('/admin/books', 'BooksController@index');
$router->get('/admin/books/detail/{id}', 'BooksController@getBooks');
$router->get('/admin/books/create', 'BooksController@create');
$router->post('/admin/books/create', 'BooksController@store');
$router->put('/admin/books/update/{id}', 'BooksController@update');
$router->delete('/admin/books/delete/{id}', 'BooksController@delete');

// stock module
$router->post('/admin/stock/create', 'StockTransactionController@store');

// books to category module
$router->post('/admin/books/categories', 'BooksController@categoriesStore');
$router->post('/admin/books/categories/{book_id}/{category_id}', 'BooksController@categoriesUpdate');

// payment module

$router->get('/admin/payment', 'PaymentController@index');
$router->get('/admin/payment/detail/{id}', 'PaymentController@detail');
$router->put('/admin/payment/update/{id}', 'PaymentController@update');
$router->get('/admin/payment/history', 'PaymentController@history');

// user data & roles module
$router->get('/admin/user', 'AdminController@index');

/*

$router->post('/search', 'PagesController@search');
*/
