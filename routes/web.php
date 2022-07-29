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
Route::get('/', 'UserController@welcome')->name('welcome');
Auth::routes();
//boking
// end boking
Route::get('show-recipes', 'HomeController@recipes')->name('all.recipes');
Route::get('show-recipes/{recipecat}', 'HomeController@recipesByCategory')->name('recipesByCategory');
Route::middleware(['admin'])->group(function () {
    Route::get('all-paypal-payment-history','UserController@paypalPayment')->name('paypal.payment');
    Route::delete('delete-payment-history/{payment}','UserController@deletePaypalpayment')->name('delete.paypalPayment');
    Route::get('/admin/dashboard', 'UserController@AdminIndex')->name('admin.index');
    Route::get('/admin/Profile/{user}', 'UserController@adminProfile')->name('admin.profile');
    Route::get('/admin/profile-edit/{user}', 'UserController@editAdmin')->name('admin.profileEdit');
    Route::patch('admin/profile-update/{user}', 'UserController@updateAdmin')->name('admin.update');
    Route::get('admin/all-users', 'UserController@allUser')->name('user.all');
    Route::patch('admin/make-admin/{user}', 'UserController@makeAdmin')->name('make.admin');
    Route::get('admin/show-all-admin', 'UserController@allAdmin')->name('admin.all');
    Route::patch('admin/make-user/{user}', 'UserController@makeUser')->name('make.user');
    Route::get('add-instagram-post', 'InstagramController@index')->name('add.instagram');
    Route::post('store-post', 'InstagramController@store')->name('store.instagram');
    Route::delete('delete-instagram/{instagram}', 'InstagramController@delete')->name('instagram.delete');
    Route::get('edit-instagram/{instagram}', 'InstagramController@edit')->name('edit.instagram');
    Route::patch('update-instagram/{instagram}', 'InstagramController@update')->name('update.instagram');

    Route::get('add-recipe', 'RecipeController@index')->name('add.recipe');
    Route::post('store-recipes', 'RecipeController@store')->name('store.recipe');
    Route::get('edit-recipe/{recipe}', 'RecipeController@editRecipe')->name('edit.recipe');
    Route::patch('update-recipe/{recipe}', 'RecipeController@updateRecipe')->name('update.recipe');
    Route::delete('delete-recipe/{recipe}', 'RecipeController@delete')->name('delete.recipe');
    // category
    Route::get('admin/product-category/all', 'ProductCategoryController@index')->name('category.index');
    Route::post('admin/store-product-category', 'ProductCategoryController@store')->name('store.category');
    Route::get('admin/updatde-category/{category}', 'ProductCategoryController@edit')->name('category.edit');
    Route::delete('admin/delete-category/{category}', 'ProductCategoryController@delete')->name('category.delete');
    Route::patch('admin/update-category/{category}', 'ProductCategoryController@update')->name('category.update');
    // banner
    Route::get('admin/add-slider', 'BannerController@addBanner')->name('banner.add');
    Route::post('admin/store-banner', 'BannerController@storeBanner')->name('store.banner');
    Route::delete('admin/delete-Banner/{banner}', 'BannerController@delete')->name('banner.delete');
    // band
    Route::get('admin/add-brand', 'BrandController@brand')->name('add.brand');
    Route::post('admin/store-brand', 'BrandController@StoreBand')->name('store.brand');
    Route::delete('admin/delete-brand/{brand}', 'BrandController@delete')->name('brand.delete');
    // product
    Route::get('admin/add-product', 'ProductController@addProduct')->name('product.add');
    Route::post('admin/store-product', 'ProductController@storeProduct')->name('product.store');
    Route::get('admin/all-product', 'ProductController@allProduct')->name('product.all');
    Route::delete('admin/product-delete/{product}', 'ProductController@delete')->name('product.delete');
    Route::get('admin/edit-product/{product}', 'ProductController@editProduct')->name('product.edit');
    Route::patch('admin/update-product/{product}', 'ProductController@updateProduct')->name('update.product');
    Route::delete('admin/delete-product-image/{image}', 'ProductController@singleImageDelete')->name('delete.image');
    //category banner
    Route::get('admin/add-category-banner', 'CategoryBannerController@index')->name('add.categroybanner');
    Route::post('admin/store-category-banner', 'CategoryBannerController@storeCategoryBanner')->name('store.categorybanner');
    Route::delete('admin/delete-category-banner/{banner}', 'CategoryBannerController@delete')->name('delete.banner');
    Route::get('admin/edit-category-banner/{banner}', 'CategoryBannerController@edit')->name('edit.categorybanner');
    Route::patch('admin/store-category-banner/{banner}', 'CategoryBannerController@updateCategoryBanner')->name('update.categorybanner');
    // brand banner
    Route::get('admin/add-brand-banner', 'BrandBannerController@index')->name('add.brandbanner');
    Route::post('admin/store-brand-banner', 'BrandBannerController@brandBranner')->name('store.brandbanner');
    Route::delete('admin/delete-brand-branner/{banner}', 'BrandBannerController@delete')->name('delete.brandbanner');
    Route::get('admin/edit-brand-banner/{banner}', 'BrandBannerController@edit')->name('edit.brandbanner');
    Route::patch('admin/update-brandbanner/{banner}', 'BrandBannerController@updateBrandBanner')->name('update.brandbanner');
    // product offer
    Route::get('admin/offers', 'ProductOfferController@index')->name('product.offers');
    Route::post('admin/offers', 'ProductOfferController@store')->name('store.offer');
    Route::get('admin/offers/{offer}', 'ProductOfferController@edit')->name('offer.edit');
    Route::post('admin/offers/{offer}', 'ProductOfferController@store')->name('update.offer');
    Route::get('admin/all-cash-on-delivery', 'HomeController@showtimeDeliveryOrder')->name('cash.on.delivery.show');
    Route::delete('admin-cash-on-delivery/{time}', 'OrderController@deleteDelivertime')->name('deliverytime.delete');
    Route::get('admin/top/{product}', 'ProductController@is_top')->name('top');
    Route::get('admin/not-top/{product}', 'ProductController@is_not_top')->name('not.top');
    Route::get('admin/most-view/{product}', 'ProductController@most_view')->name('most_view');
    Route::get('admin/not-most-view/{product}', 'ProductController@most_view_remove')->name('not.most_view');
    Route::get('admin/is-hide/{product}', 'ProductController@is_hide')->name('hide');
    Route::get('admin/unhide/{product}', 'ProductController@remove_hide')->name('unhide');
    //order
    Route::get('admin/confirm-order/{order}', 'OrderController@cashondeliveryconfirmOrder')->name('order.confirm');
    Route::get('admin/cancel-order/{order}', 'OrderController@adminCancelOrder')->name('order.cancel.admin');
    Route::get('admin/confirm-order-paypal/{order}', 'OrderController@paypalconfirmOrder')->name('order.paypal');
    Route::get('Shipping-product/{order}', 'OrderController@productshipped')->name('product.shift');
    Route::delete('delete-order/{order}', 'OrderController@deleteOrder')->name('order.delete');
    //postcode
    Route::get('add-post-code', 'PostCodeController@index')->name('postcode');
    Route::post('store-post-code', 'PostCodeController@store')->name('store.code');
    Route::get('add-video', 'VideoController@index')->name('add.video');
    Route::post('store-video', 'VideoController@store')->name('store.video');
    Route::delete('video-delete/{video}', 'VideoController@delete')->name('video.delete');
    Route::delete('delete-post-code/{post}', 'PostCodeController@delete')->name('delete.post');
    //find us
    Route::get('show-find-us', 'BusController@bus')->name('find.us');
    Route::post('store-bus-info', 'BusController@store')->name('bus.store');
    Route::post('store-car-info', 'CarController@store')->name('car.store');

    Route::delete('delete-bus-info/{bus}', 'BusController@delete')->name('delete.bus');
    Route::post('train-info', 'TrainController@store')->name('train.store');
    Route::delete('train-info/{train}', 'TrainController@delete')->name('train.delete');
    Route::delete('Car-bus-info/{car}', 'CarController@delete')->name('car.delete');
    Route::get('edit-bus-info/{bus}', 'BusController@edit')->name('bus.edit');
    Route::get('edit-car-info/{car}', 'CarController@edit')->name('car.edit');
    Route::get('edit-train-info/{train}', 'TrainController@edit')->name('train.edit');
    Route::patch('update-bus/{bus}', 'BusController@update')->name('update.bus');
    Route::patch('update-car/{car}', 'CarController@update')->name('update.car');
    Route::patch('update-train/{train}', 'TrainController@update')->name('update.train');

    //delivery
    Route::get('all-delivery-slots','HomeController@delivery')->name('delivery.all');
    Route::get('slot-update/{delivery}','DeliveryController@deliveryStatus')->name('delivery.update');
    Route::delete('delivery-time-delete/{delivery}','DeliveryController@delete')->name('delivery.delete');
});
Route::middleware(['user', 'auth'])->group(function () {
    Route::get('paymentsuccess', 'HomeController@payment_success');
    Route::get('paymenterror', 'HomeController@payment_error');
    Route::get('user/my-profile/{user}', 'UserController@userProfile')->name('user.profile');
    Route::get('user/edit-user/{user}', 'UserController@editUser')->name('edit.profile');
    Route::patch('user/store-user/{user}', 'UserController@updateUser')->name('store.user');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('store-order', 'OrderController@store')->name('store.order');
    Route::get('show-payment-method/{order}', 'HomeController@payment')->name('show.payemnt.method');
    Route::post('store-order/{order}', 'HomeController@cashOnDelivery')->name('order.payment');
    Route::get('order-cancle/{order}', 'OrderController@UsercancelOrder')->name('user.order.cancel');
    Route::get('/profile/update', 'UserProfileController@updateProfile')->name('user.profile.update');
    Route::post('/profile/update', 'UserProfileController@saveProfile')->name('user.profile.update.save');
    Route::post('/profile/contact/update', 'UserProfileController@saveProfileContact')->name('user.contact.update');
    Route::post('/profile/changepassword', 'UserProfileController@changePassword')->name('user.password.change');
    Route::get('/user/checkemail/{email}', 'UserProfileController@checkemail');
    Route::get('/user/checkout/{lat}/{lon}', 'UserController@userCheckout')->name('user.checkout');
    Route::post('delivery-booking', 'HomeController@bookingDelivery')->name('delivery.slots');
    //click and collect
    //wishlist routes
    Route::get('/wishlist', 'UserController@wishlist')->name('wishlist');
    Route::get('/wishlist/add/product/{product}', 'WishlistController@add')->name('add.to.wishlist');
    Route::delete('/wishlist/{wish}/delete', 'WishlistController@delete')->name('deletewishlist');
    Route::post('/order/rating/{order}', 'OrderController@orderRating')->name('user.product.rating');
});
// cart routes
Route::post('add-to-cart/{product}', 'ProductController@addCart')->name('add.cart');
Route::post('ajax-add-to-cart/{product}', 'ProductController@ajaxaddCart')->name('ajaxadd.cart');
Route::delete('Delete-cart/{product}', 'ProductController@removeCart')->name('delete.cart');
Route::patch('update-cart/{product}', 'ProductController@updateCart')->name('update.cart');
Route::get('update-cart-item/{product}', 'ProductController@ajaxupdateCart')->name('update.cartitem');

// general routes
Route::get('/contact-us', 'HomeController@contact')->name('contact');
Route::get('/about-us', 'HomeController@about')->name('about');
Route::get('/free-delivery', 'HomeController@freedelivery')->name('freeDelivery');
Route::get('/offer-products', 'HomeController@offeredProducts')->name('offerProducts');
Route::get('/shop', 'HomeController@shop')->name('shop');
Route::get('/product-details/{product}_{slug}', 'HomeController@productDetails')->name('productDetails');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('category/{category}/products', 'ProductCategoryController@categoywiseProduct')->name('category.product');
Route::get('brand/{brand}/products', 'BrandController@brandwiseProduct')->name('brand.product');
Route::get('search-product', 'HomeController@search')->name('search.product');
Route::get('product-range-wish-search', 'UserController@productSearchRange')->name('range.search');
Route::get('new-product', 'HomeController@newProduct')->name('new.product');
Route::get('value-1 euro-product', 'HomeController@value1')->name('value1.product');
Route::get('cart', 'ProductController@cartshow')->name('show.cart');

Route::middleware(['auth'])->group(function () {
    Route::get('show-order-details/{order}', 'OrderController@details')->name('order.details');
    Route::post('click-and-collect', 'CollectController@store')->name('click.collect');
});
Route::get('booking', 'UserController@delivery')->name('booking');

// check post code routes
Route::get('postcode/check/{chkcode}', 'UserController@checkPostcode');
Route::get('postcode/remove/', 'UserController@removePostcode');
Route::get('mail', 'HomeController@mail')->name('mail');
