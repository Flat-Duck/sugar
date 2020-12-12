<?php

use Illuminate\Support\Facades\Route;

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

// Admin routes
Route::name('admin.')->prefix('admin')->namespace('Admin')->group(function () {
    Route::post('/doctors/{user}', 'DoctorsController@destroy')->name('doctors.activate');
    Route::resource('doctors', 'DoctorsController');

    Route::group(['middleware' => ['auth','verified','isAdmin']], function () {
    //     // Login
    //     Route::get('/', 'LoginController@showLoginForm')->name('login');
    //     Route::post('/', 'LoginController@login');

    //     // Forget and reset Password
    //     Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('forgot_password');
    //     Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail');
    //     Route::get('password/reset/{token}/{email?}', 'ResetPasswordController@showResetForm')->name('reset_password_link');
    //     Route::post('password/reset', 'ResetPasswordController@reset')->name('reset_password');
    // });

    // // Logged in admin user required
    // Route::group(['middleware' => 'auth:admin'], function () {
    //     // Dashboard
         Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
         Route::get('/orders', 'DoctorsController@orders')->name('orders.index');
         Route::post('/orders/{user}', 'DoctorsController@action')->name('orders.action');

         Route::get('/patients/move/', 'PatientsController@show_move')->name('patients.move');
         Route::resource('patients', 'PatientsController');

         Route::post('/patients/{patient}/move', 'PatientsController@move')->name('patient.move');
    
         //     // Profile
         Route::get('/profile', 'AdminController@profile')->name('profile');
         Route::post('/profile', 'AdminController@profileUpdate');
         Route::post('/password', 'AdminController@passwordUpdate')->name('password_update');

    //     // Logout
         Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
     });
});


// Admin routes
Route::name('doctor.')->prefix('doctor')->namespace('Doctor')->group(function () {
    
    // Route::namespace('Auth')->middleware('guest')->group(function () {
    //     // Login
    //     Route::get('/', 'LoginController@showLoginForm')->name('login');
    //     Route::post('/', 'LoginController@login');

    //     // Forget and reset Password
    //     Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('forgot_password');
    //     Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail');
    //     Route::get('password/reset/{token}/{email?}', 'ResetPasswordController@showResetForm')->name('reset_password_link');
    //     Route::post('password/reset', 'ResetPasswordController@reset')->name('reset_password');
    // });

    // Logged in admin user required
    Route::group(['middleware' => ['auth','verified','isDoctor']], function () {
        // Dashboard
      Route::get('/dashboard', 'DoctorController@dashboard')->name('dashboard');

        Route::get('/patients/move/', 'PatientsController@show_move')->name('patients.move');
        Route::get('/chats', 'ChatController@index')->name('chats.index');
        Route::get('/chats/{patient}', 'ChatController@show')->name('chats.show');
        Route::post('/chats/{patient}', 'ChatController@send')->name('chats');
        Route::resource('patients', 'PatientsController');

        Route::get('/appointments', 'AppointmentsController@index')->name('appointments.index');
        Route::get('/appointments/{patient}/', 'AppointmentsController@add')->name('appointments.add');
        Route::post('/appointments/{patient}/', 'AppointmentsController@store')->name('appointments.store');
        
        Route::post('/patients/{patient}/move', 'PatientsController@move')->name('patient.move');
        // Route::resource('providers', 'ProviderController');

        // Route::resource('services', 'ServiceController');

        // // Profile
        Route::get('/profile', 'DoctorController@profile')->name('profile');
         Route::post('/profile', 'DoctorController@profileUpdate');
         Route::post('/password', 'DoctorController@passwordUpdate')->name('password_update');

        // // Logout
      
    });
    
});
Route::get('/logout', 'Auth\LoginController@logout')->name('doctor.logout');
// Route::auth();
//Auth::routes();
Auth::routes(['verify' => true]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
