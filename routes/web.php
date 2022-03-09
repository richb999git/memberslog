<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MembershipTypeController;
use App\Http\Controllers\MembershipPersonalDetailsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\ChangePasswordController;

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

Route::get('/', function () {
    $user = User::find(Auth::id());

    return view('home')->with('user', $user);
})->middleware(['auth'])->name('home');

Route::get('/membershipTypes', [MembershipTypeController::class, 'index'])->middleware(['auth'])->name('membershipTypes.index');
Route::get('/membershipTypes/create', [MembershipTypeController::class, 'create'])->middleware(['auth'])->name('membershipTypes/create');
Route::post('/membershipTypes/store', [MembershipTypeController::class, 'store'])->middleware(['auth'])->name('membershipTypes');
Route::get('/membershipTypes/edit/{membershipType}', [MembershipTypeController::class, 'edit'])->middleware(['auth'])->name('membershipTypes/edit/');
Route::put('/membershipTypes/update/{membershipType}', [MembershipTypeController::class, 'update'])->middleware(['auth'])->name('membershipTypes/update/');
Route::delete('/membershipTypes/delete/{membershipType}', [MembershipTypeController::class, 'destroy'])->middleware(['auth'])->name('membershipTypes/delete/');

Route::get('/membershipPersonalDetails/edit', [MembershipPersonalDetailsController::class, 'edit'])->middleware(['auth'])->name('membershipPersonalDetails/edit');
Route::put('/membershipPersonalDetails/update/{user}', [MembershipPersonalDetailsController::class, 'update'])->middleware(['auth'])->name('membershipPersonalDetails/update/');

Route::get('/members', [MemberController::class, 'index'])->middleware(['auth'])->name('members.index');
Route::get('/members/edit/{member}', [MemberController::class, 'edit'])->middleware(['auth'])->name('members/edit/');
Route::put('/members/update/{member}', [MemberController::class, 'update'])->middleware(['auth'])->name('members/update/');
Route::get('/members/showAll', [MemberController::class, 'showAll'])->middleware(['auth'])->name('members/showAll');

Route::get('/changePassword', [ChangePasswordController::class, 'edit'])->middleware(['auth'])->name('changePassword');
Route::post('/changePassword', [ChangePasswordController::class, 'store'])->middleware('auth')->name('changePasswordUpdate');
Route::get('/changeMemberPassword', [ChangePasswordController::class, 'editMember'])->middleware(['auth'])->name('changeMemberPassword');
Route::post('/changeMemberPassword', [ChangePasswordController::class, 'storeMember'])->middleware('auth')->name('changeMemberPasswordUpdate');

require __DIR__.'/auth.php';
