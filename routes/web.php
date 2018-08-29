<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/*
 * PAINEL
 */
Route::group([
                'domain' => 'painel.'.str_replace('http://','',env('APP_URL')),
                'namespace' => 'Painel',
                'middleware' => 'auth'
            ], function() 
{
    //Painel
    Route::get('/', 'PainelController@index')->name('painel.index');
    Route::resource('banners', 'BannerController');
    Route::resource('services', 'ServiceController');
    Route::resource('portfolios', 'PortfolioController');
    Route::resource('videos', 'VideoController');
    Route::resource('page_categories', 'PageCategoryController');
    Route::resource('pages', 'PageController');
    Route::resource('product_categories', 'ProductCategoryController');
    Route::get('product_categories/getSubcategoriesCombo/{id}', 'ProductCategoryController@getSubcategoriesCombo')->name('products.getSubcategoriesCombo');
    Route::resource('product_subcategories', 'ProductSubcategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('socialmedias', 'SocialMediaController');
    Route::resource('faqs', 'FaqController');
    Route::resource('depoiments', 'DepoimentController');
    Route::resource('users', 'UserController');
    
    //Blog
    Route::resource('post_categories', 'PostCategoryController');
    Route::resource('posts', 'PostController');

    //Adminstrativo
    Route::resource('clients', 'ClientController');
    Route::post('sales/refund/{id}', 'SaleController@refund')->name('sale.refund');
    Route::resource('sales', 'SaleController');
    Route::post('comissions/refund/{id}', 'ComissionController@refund')->name('comission.refund');
    Route::resource('comissions', 'ComissionController');

    //Empresa
    Route::resource('business_info', 'BusinessInfoController');
    Route::resource('address-categories', 'AddressCategoryController');
    Route::resource('addresses', 'AddressController');
    Route::resource('telephones', 'TelephoneController');
    Route::resource('emails', 'EmailController');


    //Validações Video
    Route::post('videos/verificaUrlCurta', 'VideoController@verifyShortenUrl')->name('videos.verificaUrlCurta');
    Route::post('videos/verificaUrlYoutubeValida', 'VideoController@verifyValidYoutubeUrl')->name('videos.verificaUrlYoutubeValida');
    Route::post('videos/obtemImagemYoutube', 'VideoController@getYoutubeThumb')->name('videos.obtemImagemYoutube');

    //Upload
    Route::get('upload', 'UploadController@index');
    Route::get('/upload/tinymce', 'UploadController@index');
    Route::post('upload/upload', 'UploadController@upload')->name('upload.upload');
    Route::get('upload/delete/{file}', 'UploadController@delete')->name('upload.delete');

    //Ativo/Inativo
    Route::post('/activate-inactivate', 'ActivateController@activateInactivate')->name('activate-inactivate');

    Route::get('/charts/{name}', 'ChartsController@show');



    /*
     * PAINEL
    */
    Route::group([
                'namespace' => 'Investor',
                'as'=>'painel.investor.'
            ], function() 
    {
        Route::get('meus-titulos/success-payment', 'PaypalController@successPayment')->name('meus-titulos.success-payment');
        Route::get('meus-titulos/cancel-payment', 'PaypalController@cancelPayment')->name('meus-titulos.cancel-payment');
        Route::resource('meus-titulos', 'SaleController');
        Route::get('comissoes', 'ComissionController@index')->name('comissoes.index');
        Route::get('indicacao', 'IndicationController@index')->name('indication');
    });
});



/*
 * Site
 */
Route::group([
                'namespace' => 'Site',
                'middleware' => [
                                    'getSocialMedia', 
                                    'getDolar', 
                                    'siteFooter'
                                ]
            ], function() 
{
    Route::get('/', 'HomeController@index')->name('site.index');
    Route::get('/home', 'HomeController@index')->name('site.home');
    Route::get('/faq', 'FaqController@index')->name('site.faq');
    Route::get('/empresa', 'BusinessController@index')->name('site.empresa');
    Route::get('/investimentos', 'InvestmentsController@index')->name('site.investimentos');
    Route::get('/contato', 'ContactController@index')->name('site.contato');
    Route::get('/cadastro', 'RegisterController@index')->name('site.cadastro');
    Route::get('/cadastro/{hash}', 'RegisterController@index')->name('site.cadastro.hash');
    Route::post('/cadastro', 'RegisterController@store')->name('site.cadastro.store');
});


/*
 * BLOG
 */
Route::group([
                'prefix' => 'blog',
                'namespace' => 'Blog',
                'middleware' => [
                                    'getSocialMedia', 
                                    'getDolar',
                                    'siteFooter', 
                                    'blogSidebar'
                                ]
            ], function() 
{
    Route::get('/', 'BlogController@index')->name('blog.index');
    Route::get('/materia/{title}/{id}', 'BlogController@show')->name('blog.show');
    Route::get('/categoria/{category}/{id}', 'BlogController@category')->name('blog.category');
    Route::get('/arquivo/{year}/{month}', 'BlogController@archive')->name('blog.archive');
    Route::post('/search', 'BlogController@search')->name('blog.search');
});