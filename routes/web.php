<?php

use App\Http\Controllers\Admin\BibagController;
use App\Http\Controllers\Admin\ExpenseHeadController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SreniController;
use App\Http\Controllers\Admin\StudentController;



use App\Http\Controllers\NewsTypeController;


use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PurposeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

use App\Models\Notice;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Bibag;
use App\Models\Sreni;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\ComplaintController;
use App\Models\Attachment;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubCategoryController;




// Controller
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\GodownController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\GroupUnderController;
use App\Http\Controllers\AccountGroupController;
use App\Http\Controllers\AccountLedgerController;
use App\Http\Controllers\SalesManController;
use App\Http\Controllers\ProductController;







// Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/', function() {
    return redirect()->route('login' );
});



Route::prefix('panel')->group(function () {
    Auth::routes();
});


Route::prefix('panel/{user_id}')->middleware(['auth', 'checkUserOwnership'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


    Route::resource('units', UnitController::class);
    Route::resource('currencies', CurrencyController::class);
    Route::resource('godowns', GodownController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('natures', NatureController::class);
    Route::resource('group_unders', GroupUnderController::class);
    Route::resource('account_groups', AccountGroupController::class);
    Route::resource('account_ledgers', AccountLedgerController::class);
    Route::resource('salesman', SalesManController::class); 
    Route::resource('products', ProductController::class);

































































































    // List all subcategories
    Route::middleware(['permission:category_view'])->get('subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');
    Route::middleware(['permission:category_add'])->get('subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
    Route::middleware(['permission:category_add'])->post('subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::middleware(['permission:category_edit'])->get('subcategories/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
    Route::middleware(['permission:category_edit'])->put('subcategories/{subCategory}', [SubCategoryController::class, 'update'])->name('subcategories.update');
    Route::middleware(['permission:category_delete'])->delete('subcategories/{subCategory}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');


    // Display news type 
    Route::middleware(['permission:category_view'])->get('newsTypes', [NewsTypeController::class, 'index'])->name('news_types.index');
    Route::middleware(['permission:category_add'])->get('newsTypes/create', [NewsTypeController::class, 'create'])->name('news_types.create');
    Route::middleware(['permission:category_add'])->post('newsTypes', [NewsTypeController::class, 'store'])->name('news_types.store');
    // Route::get('newsTypes/{slug}/edit', [NewsTypeController::class, 'edit'])->name('news_types.edit');
    // Route::put('newsTypes/{slug}', [NewsTypeController::class, 'update'])->name('news_types.update');
    // Route::delete('newsTypes/{slug}', [NewsTypeController::class, 'destroy'])->name('news_types.destroy');
    


    // Show list of posts (Index)
    Route::middleware(['permission:post_view'])->get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::middleware(['permission:post_add'])->get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::middleware(['permission:post_add'])->post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::middleware(['permission:post_edit'])->get('/posts/{slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::middleware(['permission:post_edit'])->put('/posts/{slug}', [PostController::class, 'update'])->name('posts.update');
    Route::middleware(['permission:post_delete'])->delete('/posts/{slug}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::middleware(['permission:post_view'])->get('/posts/pending', [PostController::class, 'pending'])->name('posts.pending');

    









    // Role 
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    
    // Permission 
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // User 
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    // 🟢 Gallery Admin Routes with Spatie Permissions
    Route::middleware(['permission:gallery_view'])->get('/gallery/list', [GalleryController::class, 'index'])->name('gallery.list'); // Show all gallery items
    Route::middleware(['permission:gallery_add'])->get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create'); // Show form to add a new gallery item
    Route::middleware(['permission:gallery_add'])->post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store'); // Store new gallery item
    Route::middleware(['permission:gallery_edit'])->get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit'); // Show form to edit gallery item
    Route::middleware(['permission:gallery_edit'])->put('/gallery/{id}/update', [GalleryController::class, 'update'])->name('gallery.update'); // Update gallery item
    Route::middleware(['permission:gallery_delete'])->delete('/gallery/{id}/destroy', [GalleryController::class, 'destroy'])->name('gallery.destroy'); // Delete gallery item




    
    Route::get("expense/report", [ExpenseController::class, 'export_report'])->name('expense.report');
    Route::get("payments/report", [PaymentController::class, 'payment_report'])->name('payments.report');





    Route::middleware(['permission:setting_view'])->resource('setting', SettingController::class);

    Route::post('/change-password', [SettingController::class, 'changePassword'])->name('password.change');



    Route::middleware(['permission:notice_view'])->get('notices/list', [NoticeController::class, 'index'])->name('notices.list');
    Route::middleware(['permission:notice_add'])->get('notices/add', [NoticeController::class, 'create'])->name('notices.add');
    Route::middleware(['permission:notice_add'])->post('notices/store', [NoticeController::class, 'store'])->name('notices.store');
    Route::middleware(['permission:notice_edit'])->get('notices/{id}/edit', [NoticeController::class, 'edit'])->name('notices.edit');
    Route::middleware(['permission:notice_edit'])->put('notices/{id}/update', [NoticeController::class, 'update'])->name('notices.update');
    Route::middleware(['permission:notice_delete'])->delete('notices/{id}', [NoticeController::class, 'destroy'])->name('notices.delete');





    // 🟢 Complaint Box Routes with Spatie Permissions
    Route::middleware(['permission:complaint_view'])->get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index'); // View complaints list
    Route::middleware(['permission:complaint_view'])->get('/complaints/{id}', [ComplaintController::class, 'show'])->name('complaints.show'); // View a single complaint
    Route::middleware(['permission:complaint_delete'])->delete('/complaints/{id}', [ComplaintController::class, 'destroy'])->name('complaints.destroy'); // Delete a complaint





    // export Attendance

    Route::get('/attendance/export/excel', [AttendanceController::class, 'exportExcel'])->name('attendance.export.excel');
    Route::get('/attendance/export/pdf', [AttendanceController::class, 'exportPDF'])->name('attendance.export.pdf');


});



