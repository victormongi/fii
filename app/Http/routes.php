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
    return "<h1>Selamat Datang Vicky</h1>";
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

Route::get('update_book', function() {

    Schema::table('books', function(Blueprint $table)
    {
        $table->index('title');

        $table->integer('author_id')->unsigned();
        $table->foreign('author_id')->references('id')->on('authors');
    });
});
Route::get('update_publisher', function() {
        Schema::table('books', function(Blueprint $table)
        {
            $table->dropColumn('publisher_id');
        });

        Schema::drop('publishers');
});

Route::get('book_create', function() {

    // $author = New \App\Author;
    // $author->first_name = 'Victor';
    // $author->last_name = 'Mongi';
    // $author->save();

    $book = New \App\Book;
    $book->title = 'Buku Ketujuh!';
    $book->pages_count = 178;
    $book->price = 144.5;
    $book->description = 'Sebuah buku yang sangat simpel lorem ipsum dolor sit amet.....';
    $book->author_id = 1;
    $book->save();
    echo 'Book: ' . $book->id . ' tersimpan!';
});

Route::get('get_all_books', function(){
    $book = New \App\Book;
    $book::all();
});

Route::get('get_book/{id}', function($id) {
    $book = New \App\Book;
    $buku_dicari = $book::find($id);
    if (is_null($buku_dicari)) {
        echo 'Buku tidak ditemukan';
    } else
    {
        echo $buku_dicari->title;
    }
});

Route::get('get_book_where', function() {
    $hasil = \App\Book::where('pages_count', '>', 1000)->get();
    return $hasil;
});

Route::get('get_book_where_chained', function() {
    $hasil = \App\Book::where('pages_count', '<', 1000)
    ->where('title', '=', 'Buku Pertamaku!')
    ->get();
    return $hasil;
});

Route::get('get_book_where_iterate', function() {
    $hasil = \App\Book::where('pages_count', '<', 1000)->get();
    if (count($hasil) > 0) {
        foreach($hasil as $buku) {
            echo 'Buku: ' . $buku->title . ' - Jumlah Halaman: '
            . $buku->pages_count . '<br/>';
        }
    } else
    {
        echo "Tidak ditemukan!";
    }
    return '';
});


Route::get('update_buku', function() {
    $buku = \App\Book::find(3);
    $buku->title = 'Update Buku Pertamaku!';
    $buku->pages_count = 150;
    $buku->save();

    $buku = \App\Book::find(3);
    echo $buku;
});

Route::get('buku_get_where_complex', function() {
    $hasil = \App\Book::where('title', 'LIKE', '%enam%')
    ->orWhere('pages_count', '>', 1001)
    ->get();

    return $hasil;
});

//victor mongi

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
