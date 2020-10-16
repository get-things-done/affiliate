<?php

use Illuminate\Support\Facades\Route;


Route::get('r/{invite_code}',function($invite_code){

    session(
        compact('invite_code')
    );

    return redirect('register');

});