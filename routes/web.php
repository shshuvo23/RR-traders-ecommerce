<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
// admin
use App\Http\Controllers\HomeController;
// user
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\User\CardController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\WishlistController;

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

Route::get('test-email', [HomeController::class, 'testEmail'])->name('test.email');
Route::get('/cc', [HomeController::class, 'cacheClear'])->name('cacheClear');

Route::get('/', [HomeController::class, 'index'])->name('home');




Route::get('about', [HomeController::class, 'about'])->name('frontend.about');
Route::get('contact', [HomeController::class, 'contact'])->name('frontend.contact');
Route::post('contact-submit', [HomeController::class, 'contactSub'])->name('frontend.contact.submit');
Route::get('pricing', [HomeController::class, 'pricing'])->name('frontend.pricing');
Route::get('faq', [HomeController::class, 'faq'])->name('frontend.faq');
Route::get('terms-of-use', [HomeController::class, 'termsOfUse'])->name('frontend.termsOfUse');

Route::get('/shop/{cat_slug?}', [HomeController::class, 'shop'])->name('shop');
Route::get('/product-details/{slug?}', [HomeController::class, 'productDetails'])->name('productDetails');


Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('frontend.privacy-policy');
Route::get('terms-condition', [HomeController::class, 'termsCondition'])->name('frontend.terms-condition');
Route::get('imprint', [HomeController::class, 'imprint'])->name('frontend.imprint');
Route::get('right-of-withdrawal', [HomeController::class, 'rightOfWithdrawal'])->name('frontend.right-of-withdrawal');
Route::get('general-terms-and-conditions', [HomeController::class, 'generalTermsConditions'])->name('frontend.general-terms-and-conditions');
Route::get('data-protection-declaration', [HomeController::class, 'dataProtectionDeclaration'])->name('frontend.data-protection-declaration');
Route::get('shipping', [HomeController::class, 'shippingConditions'])->name('frontend.shipping-conditions');
Route::get('how-to-shop', [HomeController::class, 'HowToShop'])->name('frontend.HowToShop');
Route::get('money-back-guarantee', [HomeController::class, 'moneyBackGuarantee'])->name('frontend.moneyBackGuarantee');
Route::get('returns', [HomeController::class, 'returns'])->name('frontend.returns');
Route::post('user-register', [HomeController::class, 'userRegister'])->name('user-register');

Route::get('carts', [CartController::class, 'carts'])->name('carts');
Route::post('/add/cart', [CartController::class, 'addToCart'])->name('add.cart');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::get('/cart/remove/{id?}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/add/wishlist', [WishlistController::class, 'addToWishlist'])->name('add.wishlist');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/proccess-checkout', [PaymentController::class, 'processOrder'])->name('order.process');
Route::get('/get-states/{countryId}', [CheckoutController::class, 'getStates'])->name('getStates');
Route::get('/get-shipping/{stateId}', [CheckoutController::class, 'getShippingFee'])->name('getshippingFee');
Route::get('order/success', [PaymentController::class, 'success'])->name('order.success');
Route::get('stripe/paymentSuccess', [PaymentController::class, 'stripePaymentSuccess'])->name('stripe.payment.success');
Route::get('order/cancel', [PaymentController::class, 'paymentCancel'])->name('order.cancel');

Route::post('/success', [PaymentController::class, 'success'])->name('sslcommerz.success');
Route::post('/fail', [PaymentController::class, 'sslFail'])->name('sslcommerz.fail');
Route::post('/cancel', [PaymentController::class, 'sslCancel'])->name('sslcommerz.cancel');

Route::post('/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('apply.coupon');

Auth::routes();
Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['auth']], function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
    Route::get('/setting', [UserDashboardController::class, 'setting'])->name('setting');
    Route::post('/profile/update', [UserDashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/password/update', [UserDashboardController::class, 'passwordUpdate'])->name('password.update');
    Route::get('/upgrade-plan', [UserDashboardController::class, 'upgradePlan'])->name('upgrade.plan');
    Route::get('/order-list', [UserDashboardController::class, 'orderList'])->name('order.list');
    Route::get('/order-details/{orderNumber}', [UserDashboardController::class, 'orderDetails'])->name('order.details');


    Route::get('wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
    Route::get('/remove-wishlist/{product_id}', [WishlistController::class, 'removeFromWishlist'])->name('remove.wishlist');



    Route::post('/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('remove.coupon');


    Route::group(['as' => 'transaction.', 'prefix' => 'transaction'], function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('{id}/invoice-download', [TransactionController::class, 'invoiceDownload'])->name('invoice.download');
    });

    Route::group(['as' => 'analytics.', 'prefix' => 'analytics'], function () {
        Route::get('/', [CardController::class, 'analytics'])->name('index');
    });
});



Route::get('/admin', function () {
    return redirect('/admin/login');
});
