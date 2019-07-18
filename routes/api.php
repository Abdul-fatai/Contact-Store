<?php

use Illuminate\Http\Request;
use App\Contact;

Route::group(['middleware' => 'api'], function(){

    //Fetch Contacts
    Route::get('contacts', function(){
        return Contact::latest()->orderBy('created_at', 'desc')->get();
    });

    //Get Single Contact
    Route::get('contact/{id}', function($id){
        return Contact::findOrfail($id);
    });

    //Add Contact
    Route::post('contsct/store', function(Request $request){
        return Contact::create(['name' => $request->input(['name']), 'email' => $request->input(['email']), 'phone' => $request->input(['phone'])]);
    });

    //Update Contact
    Route::patch('contact/{id}', function(Request $request, $id){
        Contact::findOrfail($id)->update(['name' => $request->input(['name']), 'email' => $request->input(['email']), 'phone' => $request->input(['phone'])]);
    });

    //Delete Contact 
    Route::delete('contact/{id}', function($id){
        return Contact::destory($id);
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});