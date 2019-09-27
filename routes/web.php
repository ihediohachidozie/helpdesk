<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('profile', 'ProfileController');
Route::resource('department', 'DepartmentController');

Route::resource('software', 'SoftwareController');

Route::resource('customer', 'CustomerController');

Route::get('customer.department', 'CustomerController@getDept');

Route::resource('issueCategory', 'IssueCategoryController');

Route::resource('device', 'DeviceController');
Route::get('device.customer', 'DeviceController@getCust');

Route::resource('ticket', 'TicketController');
Route::get('ticket.users', 'TicketController@getUsers');
Route::get('ticket.prority', 'TicketController@getPrority');
Route::get('ticket.status', 'TicketController@getStatus');
Route::get('ticket.issuecategory', 'TicketController@getCat');
Route::get('ticket.search/{id}/{search}', 'TicketController@getSearch');
Route::get('ticket.both/{x}/{y}', 'TicketController@getBoth');
Route::get('ticket.customer', 'TicketController@getCust');
Route::get('ticket.open', 'TicketController@openTickets');
Route::get('ticket.opentickets', 'TicketController@getOpenTickets');
Route::get('ticket.wiptickets', 'TicketController@getWIPTickets');
Route::get('ticket.closedtickets', 'TicketController@getClosedTickets');

Route::get('ticket.agents', 'TicketController@getAgents');

Route::post('formSubmit', 'ProfileController@formSubmit');
Route::view('blank', 'blank');
Route::view('thankyou', 'thankyou');

Route::resource('survey', 'SurveyController');
