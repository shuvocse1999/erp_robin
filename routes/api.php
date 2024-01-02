<?php

use App\Http\Controllers\Admin\Api\PasswordChangeController;
use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MessungenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BerichteController;
use App\Http\Controllers\Admin\Api\FormularController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class,'login']);
Route::post('/forget-password', [ForgetPasswordController::class, 'submitForgetPassword'])->name('submit.forget.password');


Route::group(['middleware' => ['auth:api'], 'namespace' => 'admin'], function () {
    Route::get('/berichte/begehung', [BerichteController::class, 'begehung'])->name('berichte.begehung');
    Route::get('/berichte/beinaheunfall', [BerichteController::class, 'beinaheunfall'])->name('berichte.beinaheunfall');
    Route::get('/berichte/interne-unfallmeldung', [BerichteController::class, 'interne_unfallmeldung'])->name('berichte.interne_unfallmeldung');
    Route::get('/berichte/maschinenabnahme', [BerichteController::class, 'maschinenabnahme'])->name('berichte.maschinenabnahme');
    Route::get('/berichte/tatigkeitsbericht', [BerichteController::class, 'tatigkeitsbericht'])->name('berichte.tatigkeitsbericht');

    Route::get('/get-kunden', [FormularController::class, 'kunde']);
    Route::get('/berichte-data', [FormularController::class, 'berichte']);
    Route::post('/assign-kunden', [FormularController::class, 'assignKunde']);

    Route::get('/formular-data', [FormularController::class, 'data']);
    Route::post('/formulare-store', [FormularController::class, 'store']);
    Route::post('/formulare-update/{id}', [FormularController::class, 'update']);
    Route::get('/single-formular-data', [FormularController::class, 'singleData']);
    Route::post('/formular-answer-submission', [FormularController::class, 'answerSubmission']);
    Route::post('/change-password', [PasswordChangeController::class, 'changePassword']);

    Route::get('/messunger-data', [MessungenController::class, 'messungerData']);
    Route::get('/messunger-list-data', [MessungenController::class, 'messungerlistData']);
    Route::get('/get-pdf',[FormularController::class,'getPdf'])->name('getPdf');
    Route::get('/unfallermittlung', [FormularController::class, 'unfallermittlungIndex'])->name('unfallermittlung.index');

    Route::get('/submissions-edit', [FormularController::class, 'submissionEdit'])->name('submission.edit');
    Route::get('/submissions-photo-delete', [FormularController::class, 'submissionPhotoDelete'])->name('submission.photo.delete');

    Route::post('/submissions-update', [FormularController::class, 'submissionUpdate'])->name('formular.submission.update');

});
