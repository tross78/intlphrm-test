<?php

use Illuminate\Http\Request;

Route::get('/v1/members', 'MemberController@index');

Route::post('/v1/members', function (Request $request) { 
    
});