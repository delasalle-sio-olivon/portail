<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function () use ($app) {
    /*
    Categories
    */
    $app->get('categories','CategorieController@index');

    $app->get('categories/{unix}','CategorieController@getCategorie');
      
    $app->post('categories','CategorieController@createCategorie');
      
    $app->put('categories/{unix}','CategorieController@updateCategorie');
      
    $app->delete('categories/{unix}','CategorieController@deleteCategorie');


    $app->get('categories/{unix}/enfants/categories','CategorieController@getCategorieEnfantsCategories');

    $app->post('categories/{unix}/enfants/categories/{unixEnfant}','CategorieController@createCategorieEnfantsCategories');

    $app->delete('categories/{unix}/enfants/categories/{unixEnfant}','CategorieController@deleteCategorieEnfantsCategories');


    /*
    Informations
    */
    $app->get('informations','InformationController@index');
  
    $app->get('informations/{unix}','InformationController@getInformation');
      
    $app->post('informations','InformationController@createInformation');
      
    $app->put('informations/{unix}','InformationController@updateInformation');
      
    $app->delete('informations/{unix}','InformationController@deleteInformation');


    $app->get('categories/{unix}/enfants/informations','InformationController@getCategorieEnfantsInformations');

    $app->post('categories/{unix}/enfants/informations/{unixEnfant}','InformationController@createCategorieEnfantsInformations');

    $app->delete('categories/{unix}/enfants/informations/{unixEnfant}','InformationController@deleteCategorieEnfantsInformations');

});


