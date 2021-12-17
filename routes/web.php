<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\FrontendController::class, 'FrontIndex'])->name('front.index');
Route::get('/new', [App\Http\Controllers\RegistersController::class, 'index'])->name('register.index');
Route::post('/new', [App\Http\Controllers\RegistersController::class, 'NewUser'])->name('user.register');
Route::get('/login/new', [App\Http\Controllers\RegistersController::class, 'NewUserLogin'])->name('user.login.new');
Route::get('/login/reset', [App\Http\Controllers\FrontendController::class, 'UserLoginReset'])->name('user.login.reset');
Route::post('/login/reset/send', [App\Http\Controllers\FrontendController::class, 'PasswordResetSend'])->name('user.password.reset.send');
Route::get('/update/cryptos/all', [App\Http\Controllers\LivedataController::class, 'GetCryptosAllFront'])->name('update.cryptos.all.front');
Route::get('/blogs/{link}', [App\Http\Controllers\FrontendController::class, 'FrontBlogPage'])->name('front.blog.page');
Route::post('/blogs/comment/add', [App\Http\Controllers\FrontendController::class, 'BlogCommentAdd'])->name('blog.comments.add');
Route::get('/page/{link}', [App\Http\Controllers\FrontendController::class, 'FrontSinglePage'])->name('front.single.page');
Route::get('/contact', [App\Http\Controllers\FrontendController::class, 'ContactPage'])->name('front.contact.page');
Route::get('/crypto/exchange/widget/{refid}', [App\Http\Controllers\FrontendController::class, 'CryptoExchangeWidget'])->name('crypto.exchange.widget');

Auth::routes();

/** Start User */
Route::get('/dashboard/test-code/{symbol}', [App\Http\Controllers\UserController::class, 'TestingCode'])->name('test.code');
Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/dashboard/referral', [App\Http\Controllers\UserController::class, 'ReferralIndex'])->name('referral');
Route::get('/dashboard/profile', [App\Http\Controllers\UserController::class, 'UserProfile'])->name('user.profile');
Route::get('/dashboard/auth/email', [App\Http\Controllers\UserController::class, 'EmailVerify'])->name('auth.email');
Route::get('/dashboard/trade/spot/{ids}', [App\Http\Controllers\UserController::class, 'SingleCryptoPage'])->name('crypto.page');
Route::get('/dashboard/trade/spot/amount/by/balance/{ids}', [App\Http\Controllers\UserController::class, 'CryptoBuyAmountFromBalance'])->name('crypto.get.price');
Route::get('/dashboard/account/main', [App\Http\Controllers\UserController::class, 'MainAccount'])->name('account.main');
Route::get('/dashboard/account/main/deposit/methods', [App\Http\Controllers\UserController::class, 'MainAccountDepositMethods'])->name('account.main.dmethods');
Route::get('/dashboard/balances/cryptos', [App\Http\Controllers\UserController::class, 'GetCryptoBalanceAll'])->name('crypto.balance.all');
Route::get('/dashboard/cryptos/all', [App\Http\Controllers\UserController::class, 'CryptosAll'])->name('crypto.balance.all');
Route::get('/dashboard/crypto/order/cancel/{symbol}/{OrderID}/{refid}/{userid}', [App\Http\Controllers\UserController::class, 'OrderCancel'])->name('order.cancel');
Route::get('/dashboard/user/{id}/themechange/{set}', [App\Http\Controllers\UserController::class, 'UserThemeColorChange'])->name('user.theme.change');


Route::post('/dashboard/auth/email/success', [App\Http\Controllers\UserController::class, 'EmailVerifySuccess'])->name('auth.email.success');
Route::get('/dashboard/account/main/deposit/process', [App\Http\Controllers\UserController::class, 'MainAccountDepositProcess'])->name('account.deposit.process');
Route::post('/dashboard/account/main/deposit/add/txid', [App\Http\Controllers\UserController::class, 'MainAccountDepositAddTxID'])->name('account.deposit.txid');
Route::post('/dashboard/account/main/send', [App\Http\Controllers\UserController::class, 'SendMoney'])->name('send.money');
Route::post('/dashboard/account/main/withdraw', [App\Http\Controllers\UserController::class, 'WithdrawMoney'])->name('withdraw.money');
Route::post('/dashboard/account/crypto/withdraw', [App\Http\Controllers\UserController::class, 'WithdrawCrypto'])->name('withdraw.crypto');
Route::post('/dashboard/crypto/buy', [App\Http\Controllers\UserController::class, 'CryptoBuy'])->name('crypto.buy');
Route::post('/dashboard/crypto/sell', [App\Http\Controllers\UserController::class, 'CryptoSell'])->name('crypto.sell');
Route::post('/dashboard/crypto/limit', [App\Http\Controllers\UserController::class, 'CryptoLimit'])->name('crypto.limit');
Route::post('/dashboard/profile/upload/image', [App\Http\Controllers\UserController::class, 'ProfileImage'])->name('profile.image');
Route::post('/dashboard/profile/data/update', [App\Http\Controllers\UserController::class, 'ProfileDataUpdate'])->name('profile.data.update');

Route::get('/dashboard/crypto/mining/cloud', [App\Http\Controllers\UserController::class, 'CryptoMining'])->name('crypto.mining.home');

/** Payment Controller Rout */
Route::get('/rave/callback', [App\Http\Controllers\FlutterwaveController::class, 'callback'])->name('callback');
Route::get('/dashboard/payment/gt/stripe', [App\Http\Controllers\StripeController::class, 'stripe']);
Route::post('/dashboard/payment/gt/stripe/post', [App\Http\Controllers\StripeController::class, 'stripePost'])->name('stripe.post');


/** Live Data Update */
Route::get('/dashboard/update/balances', [App\Http\Controllers\LivedataController::class, 'getbalance'])->name('update.balances');
Route::get('/dashboard/update/cryptos', [App\Http\Controllers\LivedataController::class, 'getcryptos'])->name('update.cryptos');
Route::get('/dashboard/update/cryptos/balance', [App\Http\Controllers\LivedataController::class, 'GetCryptoBalance'])->name('update.crypto.balance');
Route::get('/dashboard/update/cryptos/balance/all', [App\Http\Controllers\LivedataController::class, 'GetCryptoBalanceAll'])->name('update.crypto.balance.all');
Route::get('/admin/update/cryptos/balance/all', [App\Http\Controllers\AdminController::class, 'GetCryptoBalanceAll'])->name('admin.crypto.balance.all');
Route::get('/dashboard/update/cryptos/all', [App\Http\Controllers\LivedataController::class, 'GetCryptosAll'])->name('update.cryptos.all');
Route::get('/dashboard/get/crypto/orders/{id}', [App\Http\Controllers\LivedataController::class, 'GetCryptosOrders'])->name('get.cryptos.orders');
Route::get('/dashboard/crypto/mining/assets/update', [App\Http\Controllers\LivedataController::class, 'CryptoMiningAssetsUpdate'])->name('crypto.mining.assets.update');
Route::get('/dashboard/crypto/mining/assets/update/shortinfo', [App\Http\Controllers\LivedataController::class, 'CryptoMiningAssetsUpdateShortInfos'])->name('crypto.mining.assets.update.shortinfos');


/** Emails Routs */
Route::get('/dashboard/emails/userverification/{name}/{emailcode}', [App\Http\Controllers\MailController::class, 'UserVerification']);


/** Start Admin */
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/admin/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('admin.settings');
Route::post('/admin/settings/update', [App\Http\Controllers\AdminController::class, 'SettingsUpdate'])->name('admin.settings.update');
Route::get('/admin/finance', [App\Http\Controllers\AdminController::class, 'FinanceArea'])->name('admin.deposits');
Route::get('/admin/deposit/confirmed/{id}/{user_id}', [App\Http\Controllers\AdminController::class, 'DepositConfirmed'])->name('admin.deposit.confirmed');
Route::get('/admin/deposits/our/address/{symbol}', [App\Http\Controllers\AdminController::class, 'GetOurCoinsAddress'])->name('admin.get.ourcryptoaddress');
Route::get('/admin/withdraw', [App\Http\Controllers\AdminController::class, 'withdraw'])->name('admin.withdraw');
Route::get('/admin/deposit/getaways', [App\Http\Controllers\AdminController::class, 'AllGetawaysAdmin'])->name('admin.getaways.all');
Route::post('/admin/withdraw/confirmed', [App\Http\Controllers\AdminController::class, 'WithdrawConfirmed'])->name('admin.withdraw.confirmed');
Route::post('/admin/settings/images/upload', [App\Http\Controllers\AdminController::class, 'SettingsImages'])->name('admin.settings.images');
Route::post('/admin/deposit/getaways/add', [App\Http\Controllers\AdminController::class, 'GetawaysAddNew'])->name('admin.getaways.add.new');
Route::get('/admin/deposit/getaways/disabled/{id}', [App\Http\Controllers\AdminController::class, 'GetawaysDisabled'])->name('admin.getaways.disabled');
Route::get('/admin/deposit/getaways/activated/{id}', [App\Http\Controllers\AdminController::class, 'GetawaysActivated'])->name('admin.getaways.activated');

Route::post('/admin/crypto/fees/new', [App\Http\Controllers\AdminController::class, 'CryptoFeesNew'])->name('admin.crypto.fees.add');
Route::get('/admin/crypto/fees/disabled/{id}', [App\Http\Controllers\AdminController::class, 'CryptoFeesDisabled'])->name('admin.crypto.fees.disabled');
Route::get('/admin/crypto/fees/activated/{id}', [App\Http\Controllers\AdminController::class, 'CryptoFeesActivated'])->name('admin.crypto.fees.activated');

Route::get('/admin/crypto/lists', [App\Http\Controllers\AdminController::class, 'AllCryptoLists'])->name('admin.crypto.list.list');
Route::post('/admin/crypto/list/new', [App\Http\Controllers\AdminController::class, 'CryptoListNew'])->name('admin.crypto.list.add');
Route::get('/admin/crypto/list/disabled/{id}', [App\Http\Controllers\AdminController::class, 'CryptoListDisabled'])->name('admin.crypto.list.disabled');
Route::get('/admin/crypto/list/delete/{id}', [App\Http\Controllers\AdminController::class, 'CryptoListDelete'])->name('admin.crypto.list.delete');
Route::get('/admin/crypto/list/activated/{id}', [App\Http\Controllers\AdminController::class, 'CryptoListActivated'])->name('admin.crypto.list.activated');

Route::get('/admin/ui/ads', [App\Http\Controllers\AdminController::class, 'AdminAds'])->name('admin.ui.ads');
Route::post('/admin/ui/ads/new', [App\Http\Controllers\AdminController::class, 'AdminAdsNew'])->name('admin.ui.ads.new');
Route::post('/admin/ui/ads/edit', [App\Http\Controllers\AdminController::class, 'AdminAdsEdit'])->name('admin.ui.ads.edit');
Route::get('/admin/ui/ads/delete/{id}', [App\Http\Controllers\AdminController::class, 'AdminAdsDelete'])->name('admin.ui.ads.delete');

Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'UsersAll'])->name('admin.users.all');
Route::get('/admin/user/{email}', [App\Http\Controllers\AdminController::class, 'UsersEdit'])->name('admin.users.edit');
Route::post('/admin/user/update', [App\Http\Controllers\AdminController::class, 'UsersEditSave'])->name('admin.users.edit.save');

Route::get('/admin/crypto/mining/devices', [App\Http\Controllers\AdminController::class, 'CryptoMiningDevices'])->name('crypto.mining.devices');
Route::post('/admin/crypto/mining/devices/add', [App\Http\Controllers\AdminController::class, 'CryptoMiningDevicesAdd'])->name('crypto.mining.devices.add');
Route::get('/admin/crypto/mining/devices/purchased/active/{id}', [App\Http\Controllers\AdminController::class, 'PurchasedDeviceActive'])->name('mining.devices.status.active');


/** Admin Frontend Update */
Route::get('/admin/ui/home', [App\Http\Controllers\FrontendController::class, 'UiHomeUpdate'])->name('admin.ui.home');
Route::post('/admin/ui/social/links', [App\Http\Controllers\FrontendController::class, 'UiSocialLinks'])->name('admin.ui.social.links');
Route::get('/admin/ui/navigation', [App\Http\Controllers\FrontendController::class, 'UiNavigation'])->name('admin.ui.navigation');
Route::post('/admin/ui/navigation/main/add', [App\Http\Controllers\FrontendController::class, 'MainNevAdd'])->name('admin.main.nev.add');
Route::get('/admin/ui/navigation/main/delete/{id}', [App\Http\Controllers\FrontendController::class, 'MainNevDelete'])->name('admin.main.nev.delete');
Route::post('/admin/ui/navigation/sub/add', [App\Http\Controllers\FrontendController::class, 'SubNevAdd'])->name('admin.sub.nev.add');
Route::get('/admin/ui/navigation/sub/delete/{id}', [App\Http\Controllers\FrontendController::class, 'SubNevDelete'])->name('admin.sub.nev.delete');
Route::post('/admin/ui/header/main/edit', [App\Http\Controllers\FrontendController::class, 'MainNevEdit'])->name('admin.main.nev.edit');
Route::post('/admin/ui/header/sub/edit', [App\Http\Controllers\FrontendController::class, 'SubNevEdit'])->name('admin.sub.nev.edit');
Route::post('/admin/ui/navigation/footer/main/add', [App\Http\Controllers\FrontendController::class, 'FooterMainNevAdd'])->name('admin.footer.main.nev.add');
Route::get('/admin/ui/navigation/footer/main/delete/{id}', [App\Http\Controllers\FrontendController::class, 'FooterMainNevDelete'])->name('admin.ftr.main.nev.delete');
Route::post('/admin/ui/navigation/footer/sub/add', [App\Http\Controllers\FrontendController::class, 'FooterSubNevAdd'])->name('admin.footer.sub.nev.add');
Route::get('/admin/ui/navigation/footer/sub/delete/{id}', [App\Http\Controllers\FrontendController::class, 'FooterSubNevDelete'])->name('admin.ftr.sub.nev.delete');
Route::post('/admin/ui/footer/main/edit', [App\Http\Controllers\FrontendController::class, 'FooterMainNevEdit'])->name('admin.ftr.main.nev.edit');
Route::post('/admin/ui/footer/sub/edit', [App\Http\Controllers\FrontendController::class, 'FooterSubNevEdit'])->name('admin.ftr.sub.nev.edit');
Route::post('/admin/ui/home/section1/text', [App\Http\Controllers\FrontendController::class, 'UiSection1Text'])->name('update.ui.section1.text');
Route::post('/admin/ui/home/section1/widget', [App\Http\Controllers\FrontendController::class, 'UiSection1Widget'])->name('update.ui.section1.widget');
Route::post('/admin/ui/home/section2/all', [App\Http\Controllers\FrontendController::class, 'UiSection2All'])->name('update.ui.section2.all');
Route::post('/admin/ui/home/section3/text-icons', [App\Http\Controllers\FrontendController::class, 'UiSection3TextIcons'])->name('update.ui.section3.text.icons');
Route::post('/admin/ui/home/section3/image', [App\Http\Controllers\FrontendController::class, 'UiSection3Image'])->name('update.ui.section3.image');
Route::post('/admin/ui/home/section4/text-icons', [App\Http\Controllers\FrontendController::class, 'UiSection4TextIcons'])->name('update.ui.section4.text.icons');

Route::get('/admin/page', [App\Http\Controllers\FrontendController::class, 'PageNew'])->name('page.new');
Route::get('/admin/page/e/{link}/{type}', [App\Http\Controllers\FrontendController::class, 'PageEditPage'])->name('page.edit');
Route::get('/admin/blogs', [App\Http\Controllers\FrontendController::class, 'BlogsList'])->name('blogs.list');
Route::post('/admin/page/add', [App\Http\Controllers\FrontendController::class, 'PageAdd'])->name('page.page.add');
Route::get('/admin/blog/delete/{id}', [App\Http\Controllers\FrontendController::class, 'BlogDelete'])->name('blog.delete');
Route::post('/admin/catagories/add', [App\Http\Controllers\FrontendController::class, 'CatagoriesAdd'])->name('catagories.add');
Route::get('/admin/catagories/delete/{id}', [App\Http\Controllers\FrontendController::class, 'CatagoriesDelete'])->name('catagories.delete');

Route::get('/admin/pages', [App\Http\Controllers\FrontendController::class, 'PagesLists'])->name('pages.list');
Route::get('/admin/page/e/{link}/{type}', [App\Http\Controllers\FrontendController::class, 'PageEditPage'])->name('page.edit');
Route::get('/admin/page/delete/{id}', [App\Http\Controllers\FrontendController::class, 'PageDelete'])->name('page.delete');