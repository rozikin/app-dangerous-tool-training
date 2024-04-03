<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\RoleController;
use Spatie\Permission\Contracts\Permission;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductAllocationController;
use App\Http\Controllers\ProductInController;
use App\Http\Controllers\SupplierController;

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
    return view('admin.admin_login');
});

Route::get('/login', function () {
    return view('admin.admin_login');
});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//admin group middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


Route::middleware(['auth', 'role:admin'])->group(function () {

    //property all route
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'AllType')->name('all.type')->middleware('can:all.type');
        Route::get('/add/type', 'AddType')->name('add.type')->middleware('can:add.type');
        Route::get('/cari/type', 'CariType')->name('cari.type')->middleware('can:all.type');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type')->middleware('can:edit.type');
        Route::post('/update/type', 'UpdateType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
    });
});


Route::middleware(['auth', 'role:admin'])->group(function () {

    //permission all route
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission')->middleware('can:add.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission')->middleware('can:add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission')->middleware('can:add.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission')->middleware('can:delete.permission');
        Route::get('/import/permission', 'ImportPermission')->name('import.permission');
        Route::get('/export', 'Export')->name('export');
        Route::post('/import', 'Import')->name('import');
    });

    //role all route
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'AllRoles')->name('all.roles')->middleware('can:all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles')->middleware('can:add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles')->middleware('can:edit.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles')->middleware('can:delete.roles');


        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission')->middleware('can:add.roles.permission');
        Route::post('/add/permission/store', 'RolesPermissionStore')->name('roles.permission.store');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission')->middleware('can:all.roles.permission');
        Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles')->middleware('can:admin.edit.roles');
        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles')->middleware('can:admin.delete.roles');
    });


    //Admin User All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/admin', 'AllAdmin')->name('all.admin')->middleware('can:all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin')->middleware('can:add.admin');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin')->middleware('can:edit.admin');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin')->middleware('can:delete.admin');
    });


       //product User All Route
       Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product')->middleware('can:all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product')->middleware('can:add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product')->middleware('can:edit.product');
        Route::post('/update/product/{id}', 'UpdateProduct')->name('update.product');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
        Route::get('/export/product', 'ExportProduct')->name('export.product');
        Route::get('/get/productin', 'GetProductin')->name('get.productin')->middleware('can:all.product');
      
    });

      //color User All Color
      Route::controller(ColorController::class)->group(function () {
        Route::get('/all/color', 'AllColor')->name('all.color')->middleware('can:all.color');
        Route::get('/get/color', 'GetColor')->name('get.color')->middleware('can:all.color');
        Route::get('/get/colorglobal', 'GetColorGlobal')->name('get.colorGlobal');
        Route::get('/add/color', 'AddColor')->name('add.color')->middleware('can:add.color');
      
        Route::post('/store/color', 'StoreColor')->name('store.color');
        Route::get('/edit/color/{id}', 'EditColor')->name('edit.color')->middleware('can:edit.color');
        Route::post('/update/color/{id}', 'UpdateColor')->name('update.color');
        Route::get('/delete/color/{id}', 'DeleteColor')->name('delete.color');
        Route::get('/export/color', 'ExportColor')->name('export.color');
    });

       //color User All Category
       Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category')->middleware('can:all.category');
        Route::get('/get/category', 'GetCategory')->name('get.category')->middleware('can:all.category');
        Route::get('/get/categoryprod', 'GetCategoryProd')->name('get.categoryprod');
        Route::get('/add/category', 'AddCategory')->name('add.category')->middleware('can:add.category');
      
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category')->middleware('can:edit.category');
        Route::post('/update/category/{id}', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
        Route::get('/export/category', 'ExportCategory')->name('export.category');
    });

     //product User All Route
     Route::controller(ProductAllocationController::class)->group(function () {
        Route::get('/all/product_allocation', 'AllProductAllocation')->name('all.product_allocation')->middleware('can:all.product_allocation');
        Route::get('/add/product_allocation', 'AddProductAllocation')->name('add.product_allocation')->middleware('can:add.product_allocation');
        Route::get('/get/product_allocation', 'GetProductAllocation')->name('get.product_allocation')->middleware('can:get.product_allocation');
        Route::get('/get/product_allocationglobal', 'GetProductAllocationGlobal')->name('get.product_allocationglobal');
      
        Route::post('/store/product_allocation', 'StoreProductAllocation')->name('store.product_allocation');
        Route::get('/edit/product_allocation/{id}', 'EditProductAllocation')->name('edit.product_allocation')->middleware('can:edit.product_allocation');
        Route::post('/update/product_allocation/{id}', 'UpdateProductAllocation')->name('update.product_allocation');
        Route::get('/delete/product_allocation/{id}', 'DeleteProductAllocation')->name('delete.product_allocation');
        Route::get('/export/product_allocation', 'ExportProductAllocation')->name('export.product_allocation');
    });

    
    
     //product User All Route
     Route::controller(ProductInController::class)->group(function () {
        Route::get('/all/productin', 'AllProductIn')->name('all.productin')->middleware('can:all.productin');
        Route::get('/add/productin', 'AddProductIn')->name('add.productin')->middleware('can:add.productin');
        Route::post('/store/productin', 'StoreProductIn')->name('store.productin');
        Route::get('/edit/productin/{id}', 'EditProductIn')->name('edit.productin')->middleware('can:edit.productin');
        Route::post('/update/productin/{id}', 'UpdateProductIn')->name('update.productin');
        Route::get('/delete/productin/{id}', 'DeleteProductIn')->name('delete.productin');
        Route::get('/export/productin', 'ExportProductIn')->name('export.productin');
        Route::get('/getkodein/productin', 'KodeOtomatisIN')->name('getkodein.kodein');
    
    });

    Route::controller(SupplierController::class)->group(function () {
        Route::get('/all/supplier', 'Allsupplier')->name('all.supplier')->middleware('can:all.supplier');
        Route::get('/add/supplier', 'Addsupplier')->name('add.supplier')->middleware('can:add.supplier');
        Route::post('/store/supplier', 'Storesupplier')->name('store.supplier');
        Route::get('/edit/supplier/{id}', 'Editsupplier')->name('edit.supplier')->middleware('can:edit.supplier');
        Route::post('/update/supplier/{id}', 'Updatesupplier')->name('update.supplier');
        Route::get('/delete/supplier/{id}', 'Deletesupplier')->name('delete.supplier');
        Route::get('/export/supplier', 'Exportsupplier')->name('export.supplier');
        Route::get('/get/supplier', 'Getsupplier')->name('get.supplier')->middleware('can:all.supplier');
        Route::get('/get/supplierin', 'GetSupplierin')->name('get.supplierin')->middleware('can:all.supplier');
      
    });


          

      
    

}); //end admin middleware
