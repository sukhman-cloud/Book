<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SemesterController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/category',function () {
//     return view('category.index');
// });

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

//    Category


Route::get('/category', [CategoryController::class, 'fetchCategoryData'])->name('category');
Route::post('/addCategory', [CategoryController::class, 'insertCategory'])->name('addCategory');
Route::delete('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('categories.destroy');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCategory']);


        // Course
Route::get('/course',[CourseController::class, 'fetchCourseData'])->name('course');
Route::post('/addCourse', [CourseController::class, 'insertCourseData'])->name('addCourse');
Route::get('/course/edit/{id}', [CourseController::class, 'editCourse']);
Route::delete('/course/delete/{id}', [CourseController::class, 'deleteCourse']);


        // Semester
// Route::get('/course',[SemesterController::class, 'fetchCourseData']);
// Route::post('/addSemester', [SemesterController::class, 'insertSemesterData'])->name('addSemester');
// Route::get('/course/edit/{id}', [SemesterController::class, 'editCourse']);
// Route::delete('/course/delete/{id}', [SemesterController::class, 'deleteCourse']);


// Show the modal for adding a semester
Route::get('/showSemester', [SemesterController::class, 'semesterShow'])->name('showSemester');

// Get semesters by course ID
Route::get('/getSemestersByCourse/{courseId}', [SemesterController::class, 'getSemestersByCourse']);

Route::get('/showmodal', [SemesterController::class, 'fetchCourseSem'])->name('showmodal');

// Get all categories for the semester
Route::get('/getCategories', [SemesterController::class, 'getCategories']);

// Add a new semester
Route::post('/addSemester', [SemesterController::class, 'insertSemesterData'])->name('addSemester');

// Edit a semester
Route::get('/semester/edit/{semesterId}', [SemesterController::class, 'editSemester']);

// Update a semester (you can handle this within the `addSemester` method by checking the request type)
Route::put('/semester/update/{semesterId}', [SemesterController::class, 'updateSemester'])->name('semester.update');

// Delete a semester
Route::delete('/semester/delete/{semesterId}', [SemesterController::class, 'deleteSemester'])->name('semester.delete');

require __DIR__.'/auth.php';
