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

// Controller Login
use App\Http\Controllers\LoginController;

// Controller Dashboard
use App\Http\Controllers\DashboardController;

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
// use App\Http\Controllers\TeatViolationController;
use App\Http\Controllers\ViolationmigrationController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\HiViolationController;
use App\Http\Controllers\LayoffController;
use App\Http\Controllers\HiPkbController;
use App\Http\Controllers\HiArticleController;
use App\Http\Controllers\HiParagraphController;
use App\Http\Controllers\HiAlphabetController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\DeliveryletterController;
use App\Http\Controllers\TeatViolationController;

// MANAGEMENT ROLES
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\AccessMenuController;

use App\Http\Controllers\HistoryController;


use App\Http\Controllers\PDFController;

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
    Auth::logout();
    return view('login.index');
});

Route::get('/home', function () {
    Auth::logout();
    return view('login.index');
});

Route::get('/example', function () {
    $url_xtz = url()->current();
    return view('example',['url_xtz' =>$url_xtz]);
});
Route::get('/abort', function () {
    $url_xtz = url()->current();
    return view('abort',['url_xtz' =>$url_xtz]);
});

//HRD IT

// Route::get('/hi/employees', function () {
//     $employees = Employee::all();
//     return view('hi.employees.index', [ 'employees' => $employees]);
// });

// DASHBOARD 
Route::controller(dashboardController::class)->group(function(){
    Route::get('dashboards', 'index')->middleware('isrole');
    // Route::get('autocomplete', 'autocomplete')->name('autocomplete');
});


//EXCEL IMPORT END EXPORT
Route::controller(UserController::class)->group(function(){
    Route::get('users/export', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');

    //CRUD USER
    Route::get('users', 'list')->name('users.list')->middleware('isrole');
    Route::get('users/create', 'create')->name('users.create')->middleware('isrole');
    Route::get('users/{users:id}/edit', 'edit')->name('users.edit')->middleware('isrole');

    Route::get('users/{users:id}/password', 'password')->name('users.password')->middleware('isrole');
    Route::post('users/store', 'store')->name('users.store')->middleware('isrole');
    Route::put('users/update', 'update')->name('users.update')->middleware('isrole');
    Route::put('users/changepassword', 'changepassword')->name('users.changepassword')->middleware('isrole');
    // Route::post('users-import', 'import')->name('users.import')->middleware('isrole');
});

//SELECT2 
Route::controller(SearchController::class)->group(function(){
    Route::get('demo-search', 'index');
    Route::get('autocomplete', 'autocomplete')->name('autocomplete');
});


// JOBS
Route::resource('jobs', JobController::class)->middleware('isrole');

// DEPARTMENTS
Route::resource('departments', DepartmentController::class)->middleware('isrole');


// DATA MASTER EMPLOYEES
Route::resource('/employees', DatamasterEmployeeController::class)->middleware('isrole');

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(EmployeeController::class)->group(function(){
    // Route::get('users', 'index');
    Route::get('exportemployees', 'export')->name('users.export');
    Route::post('importemployees', 'import')->name('employees.import');
    Route::post('updateemployees', 'update')->name('employees.update');
});

// DATA MASTER PROMOTION
Route::resource('/promotions', DatamasterPromotionController::class)->middleware('isrole');

Route::get('/promotions/{promotions:id}/getedit', [DatamasterPromotionController::class, 'getedit'])->middleware('isrole');

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(ExcelPromotionController::class)->group(function(){
    // Route::get('users', 'index');
    Route::get('exportpromotions', 'export')->name('promotions.export')->middleware('isrole');
    Route::post('importpromotions', 'import')->name('promotions.import')->middleware('isrole');
    Route::post('updatepromotions', 'update')->name('promotions.update')->middleware('isrole');
});

// DATA MASTER DEMOTION
Route::resource('/demotions', DatamasterDemotionController::class);

Route::get('/demotions/{demotions:id}/getedit', [DatamasterDemotionController::class, 'getedit'])->middleware('isrole');

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(ExcelDemotionController::class)->group(function(){
    Route::get('exportdemotions', 'export')->name('demotions.export')->middleware('isrole');
    Route::post('importdemotions', 'import')->name('demotions.import')->middleware('isrole');
    Route::post('updatedemotions', 'update')->name('demotions.update')->middleware('isrole');
});

// DATA MASTER MUTATION
Route::resource('/mutations', DatamasterMutationController::class)->middleware('isrole');

Route::get('/mutations/{demotions:id}/getedit', [DatamasterMutationController::class, 'getedit'])->middleware('isrole');

//EXCEL IMPORT END EXPORT EMPLOYEES
Route::controller(ExcelMutationController::class)->group(function(){
    Route::get('exportmutations', 'export')->name('mutations.export')->middleware('isrole');
    Route::post('importmutations', 'import')->name('mutations.import')->middleware('isrole');
    Route::post('updatemutations', 'update')->name('mutations.update')->middleware('isrole');
});


// DATA EMPLOYE HI Violations
Route::resource('/violations', ViolationController::class)->middleware('isrole');

// EDIT 
Route::post('/violationeditexcel', [ViolationController::class, 'violationeditexcel']);

// test SP  
Route::get('/violations/{id}/testedit', [ViolationController::class, 'testedit']);



// DATA VIOLATIONS
Route::get('/hiviolations', [HiViolationController::class, 'index'])->middleware('isrole');

Route::resource('/hiviolations', HiViolationController::class)->middleware('isrole');

Route::controller(HiViolationController::class)->group(function(){
    Route::get('/hiviolations/{id}/getedit', 'getedit')->middleware('isrole');
    Route::post('/hiviolations/update', 'update');
    Route::post('/hiviolations/updateimport', 'updateimport');
    Route::get('exportviolations', 'export')->name('violations.export');
    Route::post('importviolations', 'import')->name('violations.import');
    Route::post('violationmigrations', 'violationmigrations')->name('violationmigrations.import');
    Route::post('deleteviolations', 'hapus')->name('deleteviolations');
    Route::post('cancelviolations', 'cancel')->name('cancelviolations');
    Route::post('importmigration', 'importmigration')->name('importmigration.import');
});

// DATA EMPLOYE HI Violations
Route::resource('/deliveryletters', DeliveryletterController::class);

// ajax alphabet_id get on create
Route::post('violation/get_type_violation', [ViolationController::class, 'get_type_violation'])->name('get_type_violation');


// ajax alphabet_id get on edit
Route::post('hiviolation/get_type_hiviolation', [HiViolationController::class, 'get_type_hiviolation'])->name('get_type_hiviolation');

Route::get('/teatviolations', [TeatViolationController::class, 'index']);

// ajax alphabet_id get on TeatViolationController
Route::post('/teatviolation/get_type_violation', [TeatViolationController::class, 'get_type_violation'])->name('get_type_teatviolation');


// Route::post('/teatviolation/get_type_violation', [TeatViolationController::class, 'get_type_violation'])->name('get_type_teatviolation');

Route::post('/teatviolation/store', [TeatViolationController::class, 'store'])->name('teatstore');
Route::post('/teatviolation/import', [TeatViolationController::class, 'import'])->name('teatimport');
Route::post('/teatviolation/update', [TeatViolationController::class, 'update'])->name('teatupdate');
Route::post('/teatviolation/updateimport', [TeatViolationController::class, 'updateimport'])->name('teatupdateimport');


///Migrasi Violation
Route::controller(ViolationmigrationController::class)->group(function(){
    Route::get('violationmigrations', 'index')->name('violationmigrations.index');
    Route::get('violationmigrations/{violationmigrations:id}', 'show');
    // Route::post('importviolations', 'import')->name('violations.import');
    // Route::post('deleteviolations', 'hapus')->name('deleteviolations');
});

// Route::get('/hi', function () {
//     return view('hi.employees');
// });

// PKB
Route::resource('/pkb', HiPkbController::class)->middleware('isrole');

// PKB -> articles
Route::resource('/articles', HiArticleController::class)->middleware('isrole');

// PKB -> paragraphs
Route::resource('/paragraphs', HiParagraphController::class)->middleware('isrole');

// PKB -> alphabets
Route::resource('/alphabets', HiAlphabetController::class)->middleware('isrole');

//EXCEL IMPORT END EXPORT VIOLATIONS
Route::controller(HiAlphabetController::class)->group(function(){
    Route::get('exportalphabets', 'export')->name('alphabets.export');
    Route::post('importalphabets', 'import')->name('alphabets.import')->middleware('isrole');
    // Route::post('updatealphabets', 'update')->name('alphabets.update');
});

// SIGNATURES
Route::resource('/signatures', SignatureController::class)->middleware('isrole');
Route::post('signatures/get_type_violation', [SignatureController::class, 'get_signature'])->name('get_signature');
Route::get('get_signature_employee', [SignatureController::class, 'get_signature_employee'])->name('get_signature_employee');


// LAYOFFS
Route::resource('/layoffs', LayoffController::class)->middleware('isrole');

Route::post('layoffs/get_karyawan_phk', [LayoffController::class, 'get_karyawan_phk'])->name('get_karyawan_phk')->middleware('isrole');

Route::get('layoffs/karyawan_phk', [LayoffController::class, 'karyawan_phk'])->name('karyawan_phk')->middleware('isrole');

Route::post('layoffs/get_pasal_phk', [LayoffController::class, 'get_pasal_phk'])->name('get_pasal_phk')->middleware('isrole');

// LOGIN AUTHENTICATION
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


// ROLES
Route::resource('/roles', RoleController::class)->middleware('isrole');

// MENUS
Route::resource('/menus', MenuController::class)->middleware('isrole');

// SUB MENUS
Route::resource('/sub_menus', SubMenuController::class)->middleware('isrole');

// ACCESS MENUS
Route::resource('/access_menus', AccessMenuController::class)->middleware('isrole');
Route::post('access_menus/changeaccess', [AccessMenuController::class, 'changeaccess'])->name('changeaccess')->middleware('isrole');
Route::post('access_menus/changeaccess_method', [AccessMenuController::class, 'changeaccess_method'])->name('changeaccess_method');

//PDF
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
Route::post('violation-pdf', [PDFController::class, 'violationPDF']);

// Livewire
Route::get('history-datatables', function () {
    return view('histories.default');
});

Route::controller(historyController::class)->group(function(){
    Route::get('histories', 'index')->name('histories');
    Route::post('histories_view', 'histories_view')->name('histories_view');
    // Route::post('updatealphabets', 'update')->name('alphabets.update');
});

// Route::get('histories', function () {
   
//     return view('histories.index', [
//         'histories' => DB::table('histories')->get()->paginate(10)
//     ]);
// });