<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect('/api');
});

Route::get('/{string}', function($string){
    if($string !== "api")
        return redirect('/api');
});
