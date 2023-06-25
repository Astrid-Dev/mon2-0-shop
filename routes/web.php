<?php

use App\Http\Livewire\Features\Dashboard\Pages\AddProduct;
use App\Http\Livewire\Features\Dashboard\Pages\Information;
use App\Http\Livewire\Features\Dashboard\Pages\Profile;
use App\Http\Livewire\Features\Home\Pages\Categories;
use App\Http\Livewire\Features\Home\Pages\Home;
use App\Http\Livewire\Features\Products\Pages\Products;
use App\Http\Livewire\Features\Products\Pages\ProductsDetails;
use App\Http\Livewire\Features\Provider\Pages\BecomeProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\RoutePath;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;
use Laravel\Jetstream\Jetstream;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
//    return view('welcome');
    return redirect()->to(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeUrl('/home'));
});

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified'
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});


Route::prefix(LaravelLocalization::setLocale())
    ->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'localize' ])
    ->group(function () {

        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified'
        ])->group(function () {
            Route::get(LaravelLocalization::transRoute('routes.become_a_seller'), BecomeProvider::class);
            Route::prefix(LaravelLocalization::transRoute('routes.dashboard'))
                ->middleware('localize')
                ->group(function () {
                    Route::get('/', function () {return redirect()->to(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeUrl('/dashboard/profile'));});
                    Route::get(LaravelLocalization::transRoute('routes.profile'), Profile::class)
                        ->name('dashboard.profile');
                    Route::get(LaravelLocalization::transRoute('routes.information'), Information::class)
                        ->name('dashboard.information');
                    Route::get(LaravelLocalization::transRoute('routes.add_product'), AddProduct::class)
                        ->name('dashboard.add_product');
                });
        });

        Route::get(LaravelLocalization::transRoute('routes.home'), Home::class);
        Route::get(LaravelLocalization::transRoute('routes.categories'), Categories::class);
        Route::prefix(LaravelLocalization::transRoute('routes.products'))
            ->middleware('localize')
            ->group(function () {
                Route::get('/', Products::class);
                Route::get(LaravelLocalization::transRoute('routes.products-details'), ProductsDetails::class)
                    ->name('products.details');
            });

        Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
            if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
                Route::get('/terms-of-service', [TermsOfServiceController::class, 'show'])->name('terms.show');
                Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');
            }

            $authMiddleware = config('jetstream.guard')
                ? 'auth:'.config('jetstream.guard')
                : 'auth';

            $authSessionMiddleware = config('jetstream.auth_session', false)
                ? config('jetstream.auth_session')
                : null;

            Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware]))], function () {
                // User & Profile...
                Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');

                Route::group(['middleware' => 'verified'], function () {
                    // API...
                    if (Jetstream::hasApiFeatures()) {
                        Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
                    }

                    // Teams...
                    if (Jetstream::hasTeamFeatures()) {
                        Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                        Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                        Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');

                        Route::get('/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
                            ->middleware(['signed'])
                            ->name('team-invitations.accept');
                    }
                });
            });
        });

        Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
            $enableViews = config('fortify.views', true);

            // Authentication...
            if ($enableViews) {
                Route::get(RoutePath::for('login', LaravelLocalization::transRoute('routes.login')), [AuthenticatedSessionController::class, 'create'])
                    ->middleware(['guest:'.config('fortify.guard')])
                    ->name('login');
            }

            $limiter = config('fortify.limiters.login');
            $twoFactorLimiter = config('fortify.limiters.two-factor');
            $verificationLimiter = config('fortify.limiters.verification', '6,1');

            Route::post(RoutePath::for('login', LaravelLocalization::transRoute('routes.login')), [AuthenticatedSessionController::class, 'store'])
                ->middleware(array_filter([
                    'guest:'.config('fortify.guard'),
                    $limiter ? 'throttle:'.$limiter : null,
                ]));

            Route::post(RoutePath::for('logout', '/logout'), [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

            // Password Reset...
            if (Features::enabled(Features::resetPasswords())) {
                if ($enableViews) {
                    Route::get(RoutePath::for('password.request', '/forgot-password'), [PasswordResetLinkController::class, 'create'])
                        ->middleware(['guest:'.config('fortify.guard')])
                        ->name('password.request');

                    Route::get(RoutePath::for('password.reset', '/reset-password/{token}'), [NewPasswordController::class, 'create'])
                        ->middleware(['guest:'.config('fortify.guard')])
                        ->name('password.reset');
                }

                Route::post(RoutePath::for('password.email', '/forgot-password'), [PasswordResetLinkController::class, 'store'])
                    ->middleware(['guest:'.config('fortify.guard')])
                    ->name('password.email');

                Route::post(RoutePath::for('password.update', '/reset-password'), [NewPasswordController::class, 'store'])
                    ->middleware(['guest:'.config('fortify.guard')])
                    ->name('password.update');
            }

            // Registration...
            if (Features::enabled(Features::registration())) {
                if ($enableViews) {
                    Route::get(RoutePath::for('register', LaravelLocalization::transRoute('routes.register')), [RegisteredUserController::class, 'create'])
                        ->middleware(['guest:'.config('fortify.guard')])
                        ->name('register');
                }

                Route::post(RoutePath::for('register', LaravelLocalization::transRoute('routes.register')), [RegisteredUserController::class, 'store'])
                    ->middleware(['guest:'.config('fortify.guard')]);
            }

            // Email Verification...
            if (Features::enabled(Features::emailVerification())) {
                if ($enableViews) {
                    Route::get(RoutePath::for('verification.notice', '/email/verify'), [EmailVerificationPromptController::class, '__invoke'])
                        ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
                        ->name('verification.notice');
                }

                Route::get(RoutePath::for('verification.verify', '/email/verify/{id}/{hash}'), [VerifyEmailController::class, '__invoke'])
                    ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'signed', 'throttle:'.$verificationLimiter])
                    ->name('verification.verify');

                Route::post(RoutePath::for('verification.send', '/email/verification-notification'), [EmailVerificationNotificationController::class, 'store'])
                    ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'throttle:'.$verificationLimiter])
                    ->name('verification.send');
            }

            // Profile Information...
            if (Features::enabled(Features::updateProfileInformation())) {
                Route::put(RoutePath::for('user-profile-information.update', '/user/profile-information'), [ProfileInformationController::class, 'update'])
                    ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
                    ->name('user-profile-information.update');
            }

            // Passwords...
            if (Features::enabled(Features::updatePasswords())) {
                Route::put(RoutePath::for('user-password.update', '/user/password'), [PasswordController::class, 'update'])
                    ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
                    ->name('user-password.update');
            }

            // Password Confirmation...
            if ($enableViews) {
                Route::get(RoutePath::for('password.confirm', '/user/confirm-password'), [ConfirmablePasswordController::class, 'show'])
                    ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')]);
            }

            Route::get(RoutePath::for('password.confirmation', '/user/confirmed-password-status'), [ConfirmedPasswordStatusController::class, 'show'])
                ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
                ->name('password.confirmation');

            Route::post(RoutePath::for('password.confirm', '/user/confirm-password'), [ConfirmablePasswordController::class, 'store'])
                ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
                ->name('password.confirm');

            // Two Factor Authentication...
            if (Features::enabled(Features::twoFactorAuthentication())) {
                if ($enableViews) {
                    Route::get(RoutePath::for('two-factor.login', '/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'create'])
                        ->middleware(['guest:'.config('fortify.guard')])
                        ->name('two-factor.login');
                }

                Route::post(RoutePath::for('two-factor.login', '/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'store'])
                    ->middleware(array_filter([
                        'guest:'.config('fortify.guard'),
                        $twoFactorLimiter ? 'throttle:'.$twoFactorLimiter : null,
                    ]));

                $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
                    ? [config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'password.confirm']
                    : [config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')];

                Route::post(RoutePath::for('two-factor.enable', '/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'store'])
                    ->middleware($twoFactorMiddleware)
                    ->name('two-factor.enable');

                Route::post(RoutePath::for('two-factor.confirm', '/user/confirmed-two-factor-authentication'), [ConfirmedTwoFactorAuthenticationController::class, 'store'])
                    ->middleware($twoFactorMiddleware)
                    ->name('two-factor.confirm');

                Route::delete(RoutePath::for('two-factor.disable', '/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'destroy'])
                    ->middleware($twoFactorMiddleware)
                    ->name('two-factor.disable');

                Route::get(RoutePath::for('two-factor.qr-code', '/user/two-factor-qr-code'), [TwoFactorQrCodeController::class, 'show'])
                    ->middleware($twoFactorMiddleware)
                    ->name('two-factor.qr-code');

                Route::get(RoutePath::for('two-factor.secret-key', '/user/two-factor-secret-key'), [TwoFactorSecretKeyController::class, 'show'])
                    ->middleware($twoFactorMiddleware)
                    ->name('two-factor.secret-key');

                Route::get(RoutePath::for('two-factor.recovery-codes', '/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'index'])
                    ->middleware($twoFactorMiddleware)
                    ->name('two-factor.recovery-codes');

                Route::post(RoutePath::for('two-factor.recovery-codes', '/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'store'])
                    ->middleware($twoFactorMiddleware);
            }
        });
    });

