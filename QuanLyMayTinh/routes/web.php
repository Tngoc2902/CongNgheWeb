<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssuesController;

Route::get("/", [IssuesController::class, "index"])->name("issues.index");
Route::get("/issues/create", [IssuesController::class, "create"])->name("issues.create");
Route::post("/issues", [IssuesController::class, "store"])->name("issues.store");
Route::get("/issues/show/{id}", [IssuesController::class, "show"])->name("issues.show");
Route::get("/issues/edit/{id}", [IssuesController::class, "edit"])->name("issues.edit");
Route::put('/issues/{id}', [IssuesController::class, 'update'])->name('issues.update');
Route::delete('/issues/{id}', [IssuesController::class, 'destroy'])->name('issues.destroy');