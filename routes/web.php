<?php
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\User\UsersController;

use App\Http\Controllers\Admin\ClearCacheController;
use Illuminate\Support\Facades\Route;
use App\Models\Settings;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\NotificationController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use App\Http\Controllers\AutoTaskController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\User\DashboardController;

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

require __DIR__ . '/admin/web.php';
require __DIR__ . '/user/web.php';
require __DIR__ . '/botman.php';

// Authentication routes
Route::get('/login', function () {
    return view('auth.modern_login');
})->name('login')->middleware('guest');

// Ensure Fortify handles the login POST so the application's tests and auth flow work
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::get('/register', function () {
    return view('auth.modern_register');
})->name('register')->middleware('guest');



//cron url
Route::get('/cron', [AutoTaskController::class, 'autotopup'])->name('cron');

//Front Pages Route
Route::controller(HomePageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('book_celebrity', 'book')->name('book');
    Route::get('membership_card/{id}', 'membership_card')->name('membership_card');
    Route::get('donate/{id}', 'donate')->name('donate');
    Route::post('bookingstore', 'bookingstore')->name('bookingstore');
});

// New modern booking system routes
Route::controller(BookingController::class)->group(function () {
    Route::get('celebrity/book/{id}', 'showBookingForm')->name('booking.form');
    Route::post('celebrity/booking/process', 'processBooking')->name('processBooking');
    Route::get('celebrity/booking/deposit/{reference}', 'showDepositPage')->name('booking.deposit');
    Route::post('celebrity/booking/payment', 'processPayment')->name('processPayment');
    Route::get('celebrity/booking/receipt/{reference}', 'showReceiptPage')->name('booking.receipt');
    Route::get('book_celebrity_now/{id}', 'showBookingForm')->name('book_celebrity_now');
});

// Modern Dashboard route
Route::get('user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard')->middleware(['auth']);

// Profile routes
Route::middleware(['auth'])->controller(ProfileController::class)->group(function () {
    Route::get('user/profile', 'show')->name('profile.show');
    Route::put('user/profile', 'updateProfile')->name('profile.update');
    Route::put('user/profile/password', 'updatePassword')->name('profile.password.update');
    Route::put('user/profile/photo', 'updatePhoto')->name('profile.photo.update');
    Route::delete('user/profile/photo', 'deletePhoto')->name('profile.photo.delete');
});

// Notification routes
Route::middleware(['auth'])->controller(NotificationController::class)->group(function () {
    Route::get('user/notifications', 'index')->name('notifications.index');
    Route::post('user/notifications/{id}/read', 'markAsRead')->name('notifications.read');
    Route::post('user/notifications/read-all', 'markAllAsRead')->name('notifications.read-all');
    Route::delete('user/notifications/{id}', 'destroy')->name('notifications.destroy');
});

// Celebrity browsing routes
Route::get('celebrities', [HomePageController::class, 'book'])->name('celebrities.index');
Route::get('celebrities/{id}', [HomePageController::class, 'book'])->name('celebrities.show');

// Modern Booking management routes
Route::controller(BookingController::class)->group(function () {
    Route::get('booking/history', 'index')->name('booking.history')->middleware(['auth']);
    Route::get('booking/{reference}', 'show')->name('booking.show');
    Route::get('booking/{reference}/edit', 'edit')->name('booking.edit');
    Route::put('booking/{reference}', 'update')->name('booking.update');
    Route::post('booking/{reference}/cancel', 'cancelBooking')->name('booking.cancel');
    Route::post('booking/guest/find', 'findGuestBooking')->name('booking.guest.find');
    Route::get('celebrity/check-availability/{id}', 'checkAvailability')->name('booking.checkAvailability');
});

Route::controller(HomePageController::class)->group(function () {
    Route::post('donate_store', 'donate_store')->name('donate_store');
    Route::post('apply_membership_card', 'apply_membership_card')->name('apply_membership_card');
    Route::post('loan_application', 'loan_application')->name('loan_application');
});

Route::controller(HomePageController::class)->group(function () {
    Route::get('terms', 'terms')->name('terms');
    Route::get('privacy', 'privacy')->name('privacy');
});
Route::post('sendcontact', [UsersController::class, 'sendcontact'])->name('enquiry');

// Contact routes
Route::controller(ContactController::class)->group(function () {
    Route::get('contact', 'index')->name('contact');
    Route::post('contact/send', 'send')->name('contact.send');
});

// Newsletter routes
Route::controller(NewsletterController::class)->group(function () {
    Route::post('newsletter/subscribe', 'subscribe')->name('newsletter.subscribe');
    Route::post('newsletter/unsubscribe', 'unsubscribe')->name('newsletter.unsubscribe');
});
