<?php
use Illuminate\Support\Facades\Route;

Auth::routes();
//Auth::routes(['register' => false]);
// Guest Member Non Authentication
Route::group(['middleware' => 'guest'], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});
// Member Already Authentication
Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]],
    function()
    {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        // Dashboard Home Controller
        Route::get('/dashboard', 'HomeController@index')->name('dashboard.home');

        // Settings Route Resources
        Route::group(['namespace' => 'Settings'], function () {
            Route::resource('Settings', 'SettingController');
        });

        // Grade Route Resources
        Route::group(['namespace' => 'Grades'], function () {
            Route::resource('Grades', 'GradeController');
        });

        // Classrooms Route Resources
        Route::group(['namespace' => 'Classrooms'], function () {
            Route::resource('Classrooms', 'ClassroomController');
            Route::post('Classrooms/Filter', 'ClassroomController@classesFilter')->name('classes_filter');
            Route::post('Excel/Export', 'ClassroomController@excelExport')->name('export_excel');
            Route::post('Delete/All', 'ClassroomController@destroyAll')->name('delete_all');
        });

        // Sections Route Resources
        Route::group(['namespace' => 'Sections'], function () {
            Route::resource('Sections', 'SectionController');
            Route::get('/classes/{id}', 'SectionController@getclasses');
        });

        // Livewire Parents Route
         Route::view('Parents','livewire.Parents.show_Form');

        //==============================Teachers============================
        Route::group(['namespace' => 'Teachers'], function () {
            Route::resource('Teachers', 'TeacherController');
        });

    }
);
