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
      
    $app->put('categories','CategorieController@updateCategorie');
      
    $app->delete('categories/{unix}','CategorieController@deleteCategorie');


    $app->get('categories/{unix}/enfants/categories','CategorieController@getCategorieEnfantsCategories');

    /*$app->post('categories/{unix}/enfants/categories/{unixEnfant}','CategorieController@createCategorieEnfantsCategories');

    $app->delete('categories/{unix}/enfants/categories/{unixEnfant}','CategorieController@deleteCategorieEnfantsCategories');
    */

    /*
    Informations
    */
    $app->get('informations','InformationController@index');
  
    $app->get('informations/{unix}','InformationController@getInformation');
      
    $app->post('informations','InformationController@createInformation');
      
    $app->put('informations','InformationController@updateInformation');
      
    $app->delete('informations/{unix}','InformationController@deleteInformation');


    $app->get('categories/{unix}/enfants/informations','InformationController@getCategorieEnfantsInformations');

    /*$app->post('categories/{unix}/enfants/informations/{unixEnfant}','InformationController@createCategorieEnfantsInformations');

    $app->delete('categories/{unix}/enfants/informations/{unixEnfant}','InformationController@deleteCategorieEnfantsInformations');
    */

    $app->get('links/categories','LinkController@categories');

    //$app->put('links/categories','LinkController@updateAllCats');

    $app->post('links/categories','LinkController@addLinkCat');

    $app->post('links/informations','LinkController@addLinkInfo');

    $app->get('links/informations','LinkController@informations');

    //$app->put('links/informations','LinkController@updateAllInfos');

    $app->delete('links/informations/{idParent}/{idEnfant}','LinkController@delLinkInfo');

    $app->delete('links/categories/{idParent}/{idEnfant}','LinkController@delLinkCat');

    $app->post('image/{unix}','ImageController@addImage');

    $app->put('image/{unix}','ImageController@updateImage');

});

$app->group(['prefix' => 'portail', 'namespace' => 'App\Http\Controllers'], function () use ($app) {
    $app->get('','PortailController@index');
});