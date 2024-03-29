<?php
declare(strict_types=1);

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\OwnQuestions\Delete as DeleteOwnQuestion;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ShowAnswer;
use App\Http\Controllers\UserController;
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

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])
     ->middleware([
         'guest',
     ])
     ->name('login');
Route::post('login', [LoginController::class, 'login'])
     ->middleware([
         'guest',
     ]);
Route::post('logout', [LoginController::class, 'logout'])
     ->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])
     ->middleware([
         'guest',
     ])
     ->name('register');
Route::post('register', [RegisterController::class, 'register'])
     ->middleware([
         'guest',
     ]);

// Password Reset Routes...
Route::get(
    'password/reset',
    [ForgotPasswordController::class, 'showLinkRequestForm']
)
     ->name('password.request');
Route::post(
    'password/email',
    [ForgotPasswordController::class, 'sendResetLinkEmail']
)
     ->name('password.email');
Route::get(
    'password/reset/{token}',
    [ResetPasswordController::class, 'showResetForm']
)
     ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
     ->name('password.update');

// Password Confirmation Routes...
Route::get('password/confirm',
    [ConfirmPasswordController::class, 'showConfirmForm'])
     ->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm'])
     ->middleware([
         'auth',
     ]);

// Email Verification Routes...
Route::get('email/verify', [VerificationController::class, 'show'])
     ->middleware([
         'auth',
     ])
     ->name('verification.notice');
Route::get('email/verify/{id}/{hash}',
    [VerificationController::class, 'verify'])
     ->middleware([
         'auth',
         'signed',
     ])
     ->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])
     ->middleware([
         'auth',
         'signed',
         'throttle:6,1',
     ])
     ->name('verification.resend');

Route::middleware([
    'auth'
])
     ->group(static function () {
         //dashboard route
         Route::get('/dashboard', DashboardController::class)
              ->name('pages.dashboard');
         //
         // Question routes
         //
         // Create questions
         Route::get('/user/questions/new',
             [QuestionController::class, 'create'])
              ->name('questions.create');
         Route::post('/user/questions', [QuestionController::class, 'store'])
              ->name('questions.store');
         // Edit questions
         Route::get('/user/questions/{question}/edit', [QuestionController::class, 'edit'])
              ->name('questions.edit');
         Route::post('/user/questions/{question}', [QuestionController::class, 'update'])
              ->name('questions.update');
         // View own questions
         Route::get('user/questions', [QuestionController::class, 'list'])
              ->name('questions.list');
         Route::get('user/questions/{question}', [QuestionController::class, 'detail'])
              ->name('questions.detail');
         // Delete own question
         Route::delete('user/questions/{question}', DeleteOwnQuestion::class);

         // Feed
         Route::get('feed', [FeedController::class, 'list'])
              ->name('feed.list');
         Route::get('feed/{question}', [FeedController::class, 'detail'])
              ->name('feed.detail');
         Route::get('feed/{question}/answer/', [FeedController::class, 'answer'])
              ->name('feed.answer');
         // @todo: refactor to API route
         Route::post('feed/{question}/answer/', [FeedController::class, 'answered'])
              ->name('feed.answered');
         Route::get('feed/{question}/{answer}/', ShowAnswer::class)
              ->name('feed.answer.show');

         //Marketplace route
         Route::get('marketplace', MarketplaceController::class)
              ->name('marketplace.home');
          
          //Profile routes.
          //
          // View profile of specific user. 
          Route::get('profiles/{user}', [UserController::class, 'view'])
              ->name('profiles.view');
          //Account routes. 
          //
          // View currently logged in user values and Change default account values.
          Route::get('account', [AccountController::class, 'view'])
               ->name('account.view');
          //Gets called on form submit.
          Route::put('account/edit', [AccountController::class, 'edit'])
               ->name('account.edit');
          //Categories routes.
          Route::post('categories/create', [CategoryController::class, 'create'])
               ->name('categories.create');
          });

// Application routes
Route::get('/', HomeController::class)
     ->name('home');
Route::get('/contact', ContactController::class)
     ->name('contact');
Route::get('/info', InfoController::class)
     ->name('info');
