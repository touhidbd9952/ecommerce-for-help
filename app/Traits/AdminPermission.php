<?php

namespace App\Traits;

Trait AdminPermission{

    public function checkRequestPermission(){
        if (
            empty(auth()->user()->role->permission['permission']['slider']['list'])  && \Route::is('sliders') ||
            // empty(auth()->user()->role->permission['permission']['slider']['add'])  && \Route::is('sliders') ||
            // empty(auth()->user()->role->permission['permission']['slider']['edit'])  && \Route::is('sliders') ||
            // empty(auth()->user()->role->permission['permission']['slider']['view'])  && \Route::is('sliders') ||
            // empty(auth()->user()->role->permission['permission']['slider']['delete'])  && \Route::is('sliders') ||

            empty(auth()->user()->role->permission['permission']['product']['list'])  && \Route::is('manage-product') ||
            empty(auth()->user()->role->permission['permission']['product']['add'])  && \Route::is('add-product')
        ) {
           return response()->view('admin.home');
        }
    }
}
