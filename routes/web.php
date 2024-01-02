<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\BerichteController;
use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FormularController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\KategorienController;
use App\Http\Controllers\MessungenController;
use App\Http\Controllers\RiskassessmentController;
use App\Http\Controllers\User\FormsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DangerController;

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

//Route::get('/', function () {
//    return view('auth.login');
//});


\Illuminate\Support\Facades\Auth::routes();
Route::get('/', function () {
    return redirect()->route('users.login');
});

Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'showLoginForm'])->name('users.login');
Route::post('/users/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('users.login.post');

//Route::get('/forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('forget.password.get');
//Route::post('/forget-password', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
//Route::get('reset-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
//Route::post('reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('forget-password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('create-password/{token}/{userId}', [ForgetPasswordController::class, 'createPasswordForm'])->name('password.create');
Route::post('/create-password', [ForgetPasswordController::class, 'createPassword'])->name('create-password-submit');


Route::get('/new-password', [ForgetPasswordController::class, 'newPassword'])->name('new.password');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth'], 'namespace' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/my-profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/edit-profile', [AdminController::class, 'profileEdit'])->name('admin.profile.edit');
    Route::post('/update-profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::post('/update-password', [AdminController::class, 'profileUpdatePassword'])->name('admin.profile.update-password');

//    Route::get('/manage-admin',[AdminController::class,'index'])->name('admin.index');
//    Route::get('/manage-admin-create',[AdminController::class,'create'])->name('admin.create');
//    Route::post('/manage-admin-store',[AdminController::class,'store'])->name('admin.store');
//    Route::get('/manage-admin-edit/{id}',[AdminController::class,'edit'])->name('admin.edit');
//    Route::post('/manage-admin-update/{id}',[AdminController::class,'update'])->name('admin.update');
//    Route::get('/manage-admin-delete/{id}',[AdminController::class,'delete'])->name('admin.delete');
//
    Route::get('/manage-user', [AdminUserController::class, 'index'])->name('admin.user.index');
    Route::get('/manage-user-create', [AdminUserController::class, 'create'])->name('admin.user.create');
    Route::post('/manage-user-store', [AdminUserController::class, 'store'])->name('admin.user.store');
    Route::get('/manage-user-edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/manage-user-update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::get('/manage-user-delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete');


//    Route::get('/berichte/begehung', [BerichteController::class, 'begehung'])->name('berichte.begehung');
//    Route::get('/berichte/beinaheunfall', [BerichteController::class, 'beinaheunfall'])->name('berichte.beinaheunfall');
//    Route::get('/berichte/interne-unfallmeldung', [BerichteController::class, 'interne_unfallmeldung'])->name('berichte.interne_unfallmeldung');
//    Route::get('/berichte/maschinenabnahme', [BerichteController::class, 'maschinenabnahme'])->name('berichte.maschinenabnahme');
//    Route::get('/berichte/tatigkeitsbericht', [BerichteController::class, 'tatigkeitsbericht'])->name('berichte.tatigkeitsbericht');

    Route::get('/formular', [FormularController::class, 'index'])->name('formular.index');
    Route::get('/formular-create', [FormularController::class, 'create'])->name('formular.create');
    Route::post('/formular-store', [FormularController::class, 'store'])->name('formular.store');

    Route::get('/formular-edit/{id}', [FormularController::class, 'edit'])->name('formular.edit');
    Route::post('/formular-update/{id}', [FormularController::class, 'update'])->name('formular.update');
    Route::get('/formular-destroy/{id}', [FormularController::class, 'destroy'])->name('formular.destroy');
    Route::post('/answersheet-store', [FormularController::class, 'answerSheet'])->name('answersheet.store');

    Route::get('/submissions', [FormularController::class, 'submission'])->name('formular.submission');
    Route::post('/update-status', [FormularController::class, 'updateStatus'])->name('update-status');
    Route::post('/send-email', [FormularController::class, 'sendEmail'])->name('send-email');

    Route::get('/submissions-photo-delete', [FormularController::class, 'submissionPhotoDelete'])->name('submission.photo.delete');

    Route::get('/submissions-view/{id}/{user_id}', [FormularController::class, 'submissionView'])->name('formular.submission.view');
    Route::get('/submissions-edit/{id}', [FormularController::class, 'submissionEdit'])->name('formular.submission.edit');
    Route::post('/submissions-update/{id}', [FormularController::class, 'submissionUpdate'])->name('formular.submission.update');

    Route::get('/submissions-destroy/{id}', [FormularController::class, 'submissionDestroy'])->name('formular.submission.destroy');
    Route::post('/generate-pdf', [FormularController::class, 'generatePdf'])->name('generate-pdf');
    Route::get('/view-generate-pdf/{id}', [FormularController::class, 'viewgeneratePdf'])->name('view-generate-pdf');

    Route::get('/kunden', [UserController::class, 'index'])->name('user.index');
    Route::get('/kunden-create', [UserController::class, 'create'])->name('user.create');
    Route::post('/kunden-store', [UserController::class, 'store'])->name('user.store');
    Route::get('/kunden-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/kunden-update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/kunden-delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/online-verbandsbuch', [FormularController::class, 'onlineVerbandsbuch'])->name('online.verbandsbuch');
    Route::get('/psychische-belastung', [FormularController::class, 'psychischeBelastung'])->name('psychische.belastung');
    Route::get('/unfallermittlung', [FormularController::class, 'unfallermittlungIndex'])->name('unfallermittlung.index');


    Route::get('/risk-assessment-create', [RiskassessmentController::class, 'create'])->name('assessment.create');

    Route::get('/local-data', [RiskassessmentController::class, 'localData'])->name('local.data');

    Route::get('/kategorien', [KategorienController::class, 'index'])->name('kategorien.index');
    Route::get('/kategorien-create', [KategorienController::class, 'create'])->name('kategorien.create');
    Route::post('/kategorien-store', [KategorienController::class, 'store'])->name('kategorien.store');
    Route::get('/kategorien-edit/{id}', [KategorienController::class, 'edit'])->name('kategorien.edit');
    Route::post('/kategorien-update/{id}', [KategorienController::class, 'update'])->name('kategorien.update');

    Route::get('/kategorien-delete/{id}', [KategorienController::class, 'delete'])->name('kategorien.delete');



    Route::post('/import', [ImportController::class, 'import'])->name('excel.import');

    Route::get('/messungen', [MessungenController::class, 'index'])->name('messungen.index');
    Route::get('/messungen-delete/{id}', [MessungenController::class, 'delete'])->name('messungen.destroy');
    Route::post('/kunde-assign', [MessungenController::class, 'assign'])->name('kunde.assign');

    Route::get('/vorlagen-antworten-index', [FormularController::class, 'vorlagenAntwortenIndex'])->name('vorlagen.antworten.index');
    Route::get('/vorlagen-antworten', [FormularController::class, 'vorlagenAntworten'])->name('vorlagen.antworten');
    Route::post('/vorlagen-antworten-store', [FormularController::class, 'vorlagenAntwortenStore'])->name('vorlagen.antworten.store');
    Route::get('/vorlagen-antworten-edit/{id}', [FormularController::class, 'vorlagenAntwortenEdit'])->name('vorlagen.antworten.edit');
    Route::post('/vorlagen-antworten-update/{id}', [FormularController::class, 'vorlagenAntwortenUpdate'])->name('vorlagen.antworten.update');

    Route::get('/vorlagen-antworten-destroy/{id}', [FormularController::class, 'antwortenDestroy'])->name('vorlagen.antworten.destroy');


//    Route::get('/forms',[\App\Http\Controllers\Admin\FormsController::class,'index'])->name('forms.index');
//    Route::get('/specific-forms',[\App\Http\Controllers\Admin\FormsController::class,'specificForms'])->name('specificForms.index');
//    Route::get('/specific-forms/{id}',[\App\Http\Controllers\Admin\FormsController::class,'specificFormsShow'])->name('specificForms.show');
//
//    Route::post('/client-submit', [FormsController::class,'submitForm'])->name('client.submit');
//
//    Route::get('/clients',[\App\Http\Controllers\ClientController::class,'index'])->name('clients.index');
//    Route::get('/clients-create',[\App\Http\Controllers\ClientController::class,'create'])->name('clients.create');
//    Route::post('/clients-store',[\App\Http\Controllers\ClientController::class,'store'])->name('clients.store');
//    Route::get('/clients-edit/{id}',[\App\Http\Controllers\ClientController::class,'edit'])->name('clients.edit');
//    Route::post('/clients-update/{id}',[\App\Http\Controllers\ClientController::class,'update'])->name('clients.update');
//    Route::get('/clients-delete/{id}',[\App\Http\Controllers\ClientController::class,'delete'])->name('clients.delete');
});

Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'user'], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/my-profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/edit-profile', [UserController::class, 'profileEdit'])->name('user.profile.edit');
    Route::post('/update-profile', [UserController::class, 'profileUpdate'])->name('user.profile.update');
    Route::post('/update-password', [UserController::class, 'profileUpdatePassword'])->name('user.profile.update-password');

    Route::get('/vorlagen', [FormularController::class, 'vorlagen'])->name('vorlagen.index');
    Route::get('/berichte', [\App\Http\Controllers\User\FormularController::class, 'index'])->name('berichte.index');

    Route::get('/messungen', [MessungenController::class, 'messungenIndex'])->name('user.messungen.index');
//    Route::get('/forms',[FormsController::class,'index'])->name('forms.index');
//    Route::get('/manage-user',[UserController::class,'index'])->name('user.index');
//    Route::get('/manage-user-create',[UserController::class,'create'])->name('user.create');
//    Route::post('/manage-user-store',[UserController::class,'store'])->name('user.store');
//    Route::get('/manage-user-edit/{id}',[UserController::class,'edit'])->name('user.edit');
//    Route::post('/manage-user-update/{id}',[UserController::class,'update'])->name('user.update');
//    Route::get('/manage-user-delete/{id}',[UserController::class,'delete'])->name('user.delete');
});



Route::post('/current_danger', [DangerController::class, 'insert']);
Route::get('/admin/step2', [DangerController::class, 'step2']);

Route::post('/current_category', [DangerController::class, 'insert2']);
Route::get('/admin/step3', [DangerController::class, 'step3']);

Route::post('/insert3', [DangerController::class, 'insert3']);
