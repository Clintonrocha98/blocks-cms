<?php

use App\Http\Controllers\PagePreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/preview/page/{id}', [PagePreviewController::class, 'show']);
