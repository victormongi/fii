<?php
use Illuminate\Database\Schema\Blueprint;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return "Mner James";
});

Route::get('create_users_table', function() {
    Schema::table('users', function($table)
    {
        $table->string('fam', 29)->change();
    });

});

Route::get('books', function() {
    Schema::table('books', function(Blueprint $table)
    {
        $table->string('title', 30)->change();
    });
});

Route::get('authors', function() {

    Schema::create('authors', function (Blueprint $table) {
        $table->increments('id');
        $table->string('first_name');
        $table->string('last_name');
        $table->timestamps();
    });

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
