<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('position', 'PositionCrudController');
    Route::crud('author', 'AuthorCrudController');
    Route::crud('publisher', 'PublisherCrudController');
    Route::crud('book-author', 'BookAuthorCrudController');
    Route::crud('book', 'BookCrudController');
    Route::crud('subject', 'SubjectCrudController');
    Route::crud('book-subject', 'BookSubjectCrudController');
    Route::crud('book-publisher', 'BookPublisherCrudController');
    Route::crud('member', 'MemberCrudController');
    Route::crud('book-loans', 'BookLoansCrudController');
    Route::crud('loan-configuration', 'LoanConfigurationCrudController');
    Route::crud('serie', 'SerieCrudController');
    Route::crud('book-serie', 'BookSerieCrudController');
    Route::crud('edition', 'EditionCrudController');
    Route::crud('book-edition', 'BookEditionCrudController');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
