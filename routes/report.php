<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesSummeryReportController;

Route::get('sales-summery-report', SalesSummeryReportController::class);
