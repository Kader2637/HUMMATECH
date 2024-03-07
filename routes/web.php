<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\CollabCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CollabMitraController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ForceController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\HomeVacancyController;
use App\Http\Controllers\ImageUploader;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesPackageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SosialMediaController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TermsconditionController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\VisionAndMisionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();


Route::get('about-us', [AboutUsController::class, 'index']);
Route::get('berita/{slugnews}', [NewsController::class, 'showNews'])->name('news.slug');
Route::get('layanan/{slugService}', [ServiceController::class, 'ShowService']);
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('contact', function () {
    return view('landing.contact');
})->name('contact');


Route::get('message-approval', function () {
    return view('admin.pages.message-approval.index');
});
Route::get('/testimonial', function () {
    return view('admin.pages.testimonial.index');
});
Route::resource('gallery', GalleryController::class);
Route::put('galery/update/{galeryImage}' , [GalleryController::class ,'update']);
Route::delete('galery/delete/{galeryImage}' , [GalleryController::class ,'destroy']);
Route::get('category-news' , [CategoryNewsController::class , 'index']);
Route::get('collab' , [CollabMitraController::class ,'index']);
Route::get('category-collab' , [CollabCategoryController::class ,'index']);
Route::resource('sale', SaleController::class);
Route::resource('service', ServiceController::class);
Route::resource('product', ProductController::class);
Route::get('branch' , [BranchController::class ,'index']);
Route::resource('force', ForceController::class);
Route::get('social-media' , [SosialMediaController::class ,'index']);
Route::resource('procedure', ProcedureController::class);
Route::resource('faq', FaqController::class);
Route::resource('terms_condition', TermsconditionController::class);
Route::get('vision-mision' , [VisionAndMisionController::class ,'index'])->name('vision.mision');
Route::get('hero-section', [SectionController::class , 'index'])->name('hero.section');



Route::get('/testimonial', function () {
    return view('admin.pages.testimonial.index');
});

Route::get('/category-testimonial', function () {
    return view('admin.pages.testimonial-category.index');
});

Route::get('/hero-section/edit', function () {
    return view('admin.pages.hero-section.edit');
});


Route::get('/setting/terms-condition/edit', function () {
    return view('admin.pages.terms-condition.edit');
});

Route::get('/setting/faq', function () {
    return view('admin.pages.faq.index');
});




// category news berita
Route::post('create/category/news' , [CategoryNewsController::class , 'store'])->name('create.category.news');
Route::delete('delete/category/news/{categoryNews}' ,[CategoryNewsController::class ,'destroy'])->name('delete.category.news');
Route::put('update/category/news/{categoryNews}' ,[CategoryNewsController::class ,'update'])->name('update.category.news');
// end category news berita

// news
// end news

// branch
Route::post('branch/create' ,[BranchController::class ,'store']);
Route::put('branch/update/{branch}' , [BranchController::class ,'update']);
Route::delete('brach/delete/{branch}' , [BranchController::class ,'destroy']);
// end branch

//category mitra
Route::post('create/category/mitra' , [CollabCategoryController::class , 'store'])->name('create.category.mitra');
Route::put('update/category/mitra/{collabCategory}' ,[CollabCategoryController::class ,'update'])->name('update.category.mitra');
Route::delete('delete/category/mitra/{collabCategory}' ,[CollabCategoryController::class ,'destroy'])->name('delete.category.mitra');
// end category mitra


//mitra
Route::delete('delete/collab/mitra/{collabMitra}' ,[CollabMitraController::class ,'destroy'])->name('delete.collab.mitra');
Route::post('create/collab/mitra' , [CollabMitraController::class , 'store'])->name('create.collab.mitra');
Route::put('update/collab/mitra/{collabMitra}' ,[CollabMitraController::class ,'update'])->name('update.collab.mitra');

//product
Route::delete('product/feature/{ProductFeature}' ,[ProductController::class ,'feature'])->name('product.feature');

Route::resource('sales-package', SalesPackageController::class);

// news
Route::get('news/index' , [NewsController::class , 'index']);

Route::post('create/service' , [ServiceController::class , 'store'])->name('create.service');
Route::get('detail/service/{service}' , [ServiceController::class , 'show'])->name('detail.service');
Route::get('hero-section/create' , [SectionController::class , 'create']);
Route::post('create/section' , [SectionController::class ,'store'])->name('create.section');
Route::get('edit/section/{section}', [SectionController::class ,'edit'])->name('hero.edit');
Route::put('edit/section/{section}', [SectionController::class ,'update'])->name('hero.update');
Route::delete('delete/section/{section}', [SectionController::class ,'destroy'])->name('hero.delete');

// position
Route::get('setting/departement' , [PositionController::class , 'index'])->name('setting.departement');
Route::post('create/position' , [PositionController::class , 'store'])->name('create.position');
Route::put('update/position/{position}', [PositionController::class ,'update'])->name('update.position');
Route::delete('delete/position/{position}' , [PositionController::class , 'destroy'])->name('delete.position');


// team
Route::get('setting/teams' , [TeamController::class , 'index'])->name('setting.teams');
Route::post('create/team' , [TeamController::class , 'store'])->name('create.team');
Route::put('update/team/{team}', [TeamController::class ,'update'])->name('update.team');
Route::delete('delete/team/{team}' , [TeamController::class , 'destroy'])->name('delete.team');



Route::get('data/product',[HomeProductController::class ,'index']);

Route::get('detail/{product:slug}',[ProductController::class ,'showproduct'])->name('detail.product');


// show pdf
Route::get('showpdf/{sale}' , [SaleController::class ,'showpdf']);


//social media
Route::post('create/social/media/' , [SosialMediaController::class , 'store'])->name('create.social.media');
Route::delete('delete/social/media/{sosialMedia}' ,[SosialMediaController::class ,'destroy'])->name('delete.social.media');
Route::put('update/social/media/{sosialMedia}' ,[SosialMediaController::class ,'update'])->name('update.social.media');

//profile
Route::get('setting/profile', [ProfileController::class, 'index']);
Route::post('store/profile' , [ProfileController::class, 'store'])->name('store.profile');
Route::put('update/profile/{profile}' ,[ProfileController::class ,'update'])->name('update.profile');

//alumni-detail
Route::get('alumni-detail', function (){
    return view('landing.service.alumni-detail');
});

Route::get('data/lowongan', HomeVacancyController::class);

//beranda
Route::get('/', [HomePageController::class, 'index']);

// vision & mision
Route::post('create/vision/mision/' , [VisionAndMisionController::class , 'store'])->name('create.vision.mision');
Route::put('update/vision/mision/{visionAndMision}' ,[VisionAndMisionController::class ,'update'])->name('update.vision.mision');
Route::put('update/mision/mision/{misionItems}' ,[VisionAndMisionController::class ,'updatemision'])->name('update.mision.mision');
Route::delete('delete/vision/mision/{visionAndMision}', [VisionAndMisionController::class, 'destroy'])->name('destroy.vision.mision');
Route::delete('delete/mision/mision/{misionItems}', [VisionAndMisionController::class, 'destroymision'])->name('destroy.mision.mision');

Route::post('image-uploader', ImageUploader::class)->name('image-uploader');

// News
Route::resource('news' , NewsController::class);

// Company
// Route::resource('enterprise-structure' , EnterpriseStructureController::class);

Route::prefix('setting')->name('company.')->group(function() {
    Route::get('company', [\App\Http\Controllers\EnterpriseStructureController::class, 'index'])->name('index');
    Route::post('company/store', [\App\Http\Controllers\EnterpriseStructureController::class, 'store'])->name('store');
    Route::put('company/{enterpriseStructure}', [\App\Http\Controllers\EnterpriseStructureController::class, 'update'])->name('update');
    Route::delete('company/{enterpriseStructure}', [\App\Http\Controllers\EnterpriseStructureController::class, 'destroy'])->name('destroy');
});

Route::resource('testimonial', TestimonialController::class);


Route::get('layanan', function () {
    return view('landing.service.service-detail');
});

Route::get('layanan/pelatihan', function () {
    return view('landing.service.training-detail');
});

Route::get('/about-us', [AboutUsController::class, 'index']);
Route::controller(VacancyController::class)->name('vacancy.')->prefix('/vacancy')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::put('/{vacancy}/update', 'update')->name('update');
});

Route::post('setting/structure/create', [StructureController::class, 'store'])->name('structure.create');

Route::get('setting/structure', [StructureController::class, 'index'])->name('structure.index');
Route::put('setting/structure/update/{structure}', [StructureController::class, 'update'])->name('structure.update');
Route::delete('setting/structure/delete/{structure}', [StructureController::class, 'destroy'])->name('structure.delete');
Route::get('berita', [NewsController::class, 'news']);

require_once __DIR__ . '/kader.php';
require_once __DIR__ . '/farah.php';
require_once __DIR__ . '/nesa.php';
require_once __DIR__ . '/adi.php';
require_once __DIR__ . '/rendi.php';
