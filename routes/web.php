<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ArticleController;

use App\Http\Controllers\BillingController;

use Illuminate\Http\Request;

use App\Http\Controllers\WebhookController;

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

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('products/{product}/pay', [ProductController::class, 'pay'])->middleware('auth')->name('product.pay');

Route::get('articles', [ArticleController::class, 'index'])->name('article.index');

Route::get('articles/{article}', [ArticleController::class, 'show'])->middleware(['auth', 'subscription'])->name('article.show');

Route::get('billing', [BillingController::class, 'index'])->middleware('auth')->name('billing.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/* Esta ruta es para descargar la factura de un usuario */
Route::get('/user/invoice/{invoice}', function (Request $request, $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId, [
        'vendor' => 'Your Company',
        'product' => 'Your Product',
    ]);
});


/* Nos permite sobrescribir la ruta de webhooks */
Route::post(
    '/stripe/webhook',
    [WebhookController::class, 'handleWebhook']
);
