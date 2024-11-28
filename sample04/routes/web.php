<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Downloader;

//Livewire
use App\Livewire\Counter;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

/* インデックスページ */
Route::get('/','App\Http\Controllers\AppController@index');
Route::get('index','App\Http\Controllers\AppController@index');


/* 検索スページ */
Route::get('/search',function(){
	return view('app/search');
});
Route::get('/search/parameta',function(){
	return view('app/search_parameta');
});


/* 検索結果ページ */
Route::get('/search/all','App\Http\Controllers\AppController@search_all');
Route::get('/search/paraName','App\Http\Controllers\AppController@search_paraName');
Route::get('/search/date','App\Http\Controllers\AppController@search_date');
Route::get('/search/range','App\Http\Controllers\AppController@search_range');
Route::get('/search/judgment','App\Http\Controllers\AppController@search_judgment');

Route::get('/search/parameta/all','App\Http\Controllers\ParametaController@search_all');
Route::get('/search/parameta/name','App\Http\Controllers\ParametaController@search_name');
Route::get('/search/parameta/date','App\Http\Controllers\ParametaController@search_date');
Route::get('/search/parameta/active','App\Http\Controllers\ParametaController@search_active');


Route::get('/test','App\Http\Controllers\AppController@test');

/* システム監視ページ */
Route::get('/monitor','App\Http\Controllers\MonitorController@index');

Route::get('/monitor', Counter::class);


//CSVダウンロード
Route::get('export-csv', [Downloader::class, 'exportCSV'])->name('export/csv');
//画像ダウンロード
Route::get('export-image', [Downloader::class, 'exportIMAGE'])->name('export/image');