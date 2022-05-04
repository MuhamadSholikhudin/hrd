<?php

use Illuminate\Support\Facades\Route;

// Models Data master
use App\Models\Employee;
use App\Models\Job;
use App\Models\Department;

//Model Hi
use App\Models\HiEmployee;
use App\Models\Paragraph;
use App\Models\Article;
use App\Models\Alphabet;

use App\Http\Controllers\LoginController;

//Controller Datamaster
use App\Http\Controllers\JobController;
use App\Http\Controllers\DatamasterEmployeeController;
use App\Http\Controllers\DatamasterPromotionController;
use App\Http\Controllers\DatamasterDemotionController;
use App\Http\Controllers\DatamasterMutationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExcelPromotionController;
use App\Http\Controllers\ExcelDemotionController;
use App\Http\Controllers\ExcelMutationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HiEmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

// Controller HI
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\HiViolationController;
use App\Http\Controllers\LayoffController;
use App\Http\Controllers\HiPkbController;
use App\Http\Controllers\HiArticleController;
use App\Http\Controllers\HiParagraphController;
use App\Http\Controllers\HiAlphabetController;
use App\Http\Controllers\SignatureController;

// MANAGEMENT ROLES
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\AccessMenuController;




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
    return view('welcome');
});



Route::get('/example', function () {
    return view('example');
});
//HRD IT

// Route::get('/hi/employees', function () {
//     $employees = Employee::all();
//     return view('hi.employees.index', [ 'employees' => $employees]);
// });



//EXCEL IMPORT END EXPORT
Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');

    //CRUD USER
    Route::get('userslist', 'list')->name('users.list')->middleware('auth');
    Route::get('users/create', 'create')->name('users.create')->middleware('auth');
    Route::get('users/{users:id}/edit', 'edit')->name('users.edit')->middleware('auth');

    Route::get('users/{users:id}/password', 'password')->name('users.password')->middleware('auth');
    Route::post('users/store', 'store')->name('users.store')->middleware('auth');
    Route::put('users/update', 'update')->name('users.update')->middleware('auth');
    Route::put('users/changepassword', 'changepassword')->name('users.changepassword')->middleware('auth');
    Route::post('users-import', 'import')->name('users.import')->middleware('auth');
});

//SELECT2 
Route::controller(SearchController::class)->group(function(){
    Route::get('demo-search', 'index');
    Route::get('autocomplete', 'autocomplete')->name('autocomplete');
});


// JOBS
Route::resource('jobs', JobController::class)->middleware('auth');

// DEPARTMENTS
Route::resource('departments', DepartmentController::class)->middleware('auth');


// DATA MASTER EMPLOYEES
Route::resource('datamaster/employees', DatamasterEmployeeController::class)->middleware('auth');

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(EmployeeController::class)->group(function(){
    // Route::get('users', 'index');
    Route::get('exportemployees', 'export')->name('users.export');
    Route::post('importemployees', 'import')->name('employees.import')->middleware('auth');
    Route::post('updateemployees', 'update')->name('employees.update')->middleware('auth');
});

// DATA MASTER PROMOTION
Route::resource('datamaster/promotions', DatamasterPromotionController::class)->middleware('auth');

Route::get('/datamaster/promotions/{promotions:id}/getedit', [DatamasterPromotionController::class, 'getedit'])->middleware('auth');

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(ExcelPromotionController::class)->group(function(){
    // Route::get('users', 'index');
    Route::get('exportpromotions', 'export')->name('promotions.export')->middleware('auth');
    Route::post('importpromotions', 'import')->name('promotions.import')->middleware('auth');
    Route::post('updatepromotions', 'update')->name('promotions.update')->middleware('auth');
});

// DATA MASTER DEMOTION
Route::resource('datamaster/demotions', DatamasterDemotionController::class);

Route::get('/datamaster/demotions/{demotions:id}/getedit', [DatamasterDemotionController::class, 'getedit'])->middleware('auth');

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(ExcelDemotionController::class)->group(function(){
    Route::get('exportdemotions', 'export')->name('demotions.export')->middleware('auth');
    Route::post('importdemotions', 'import')->name('demotions.import')->middleware('auth');
    Route::post('updatedemotions', 'update')->name('demotions.update')->middleware('auth');
});

// DATA MASTER MUTATION
Route::resource('datamaster/mutations', DatamasterMutationController::class)->middleware('auth');

Route::get('/datamaster/mutations/{demotions:id}/getedit', [DatamasterMutationController::class, 'getedit'])->middleware('auth');

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(ExcelMutationController::class)->group(function(){
    Route::get('exportmutations', 'export')->name('mutations.export')->middleware('auth');
    Route::post('importmutations', 'import')->name('mutations.import')->middleware('auth');
    Route::post('updatemutations', 'update')->name('mutations.update')->middleware('auth');
});


// DATA HI Violations
Route::resource('hi/violations', ViolationController::class)->middleware('auth');

Route::get('/violations/list', [ViolationController::class, 'list'])->middleware('auth');

Route::resource('hi/hiviolations', HiViolationController::class)->middleware('auth');

Route::controller(HiViolationController::class)->group(function(){
    Route::get('exportviolations', 'export')->name('violations.export')->middleware('auth');
    Route::post('importviolations', 'import')->name('violations.import')->middleware('auth');
    // Route::post('updatealphabets', 'update')->name('alphabets.update');
});

Route::post('violation/get_type_violation', [ViolationController::class, 'get_type_violation'])->name('get_type_violation');

// Route::get('/hi', function () {
//     return view('hi.employees');
// });

// PKB
Route::resource('/hi/pkb', HiPkbController::class)->middleware('auth');

// PKB -> articles
Route::resource('/hi/articles', HiArticleController::class)->middleware('auth');

// PKB -> paragraphs
Route::resource('/hi/paragraphs', HiParagraphController::class)->middleware('auth');

// PKB -> alphabets
Route::resource('/hi/alphabets', HiAlphabetController::class)->middleware('auth');

//EXCEL IMPORT END EXPORT VIOLATIONS
Route::controller(HiAlphabetController::class)->group(function(){
    Route::get('exportalphabets', 'export')->name('alphabets.export')->middleware('auth');
    Route::post('importalphabets', 'import')->name('alphabets.import')->middleware('auth');
    // Route::post('updatealphabets', 'update')->name('alphabets.update');
});

// SIGNATURES
Route::resource('/hi/signatures', SignatureController::class)->middleware('auth');
Route::post('signatures/get_type_violation', [SignatureController::class, 'get_signature'])->name('get_signature');


// LAYOFFS
Route::resource('/hi/layoffs', LayoffController::class)->middleware('auth');

Route::post('layoffs/get_karyawan_phk', [LayoffController::class, 'get_karyawan_phk'])->name('get_karyawan_phk')->middleware('auth');

Route::get('layoffs/karyawan_phk', [LayoffController::class, 'karyawan_phk'])->name('karyawan_phk')->middleware('auth');

Route::post('layoffs/get_pasal_phk', [LayoffController::class, 'get_pasal_phk'])->name('get_pasal_phk')->middleware('auth');

// LOGIN AUTHENTICATION
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


// ROLES
Route::resource('/roles', RoleController::class)->middleware('auth');


// MENUS
Route::resource('/menus', MenuController::class)->middleware('auth');

// SUB MENUS
Route::resource('/sub_menus', SubMenuController::class)->middleware('auth');

// ACCESS MENUS
Route::resource('/access_menus', AccessMenuController::class)->middleware('auth');
Route::post('access_menus/changeaccess', [AccessMenuController::class, 'changeaccess'])->name('changeaccess')->middleware('auth');



