<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'site.index')->name('home');
Route::view('/login', 'site.login')->name('login');
Route::view('/account', 'site.account')->name('account');
Route::view('/delivery-location', 'site.delivery-location')->name('delivery-location');
Route::redirect('/admin', '/admin/dashboard');
Route::view('/admin/login', 'site.admin-login')->name('admin.login');
Route::view('/admin/dashboard', 'site.admin-dashboard')->name('admin.dashboard');

Route::get('/{page}.html', function (string $page) {
	$aliases = [
		'cart' => 'cart2',
		'cookie-policy' => 'cookie-privacy',
		'feedback' => 'contact',
		'terms-of-service' => 'term-service',
		'terms-of-use' => 'term of use',
	];
	foreach (range(2, 18) as $cartPage) {
		$aliases['cart' . $cartPage] = 'cart2';
	}
	$view = 'site.' . ($aliases[$page] ?? $page);

	abort_unless(view()->exists($view), 404);

	return view($view);
})
	->where('page', '[A-Za-z0-9 -]+');
