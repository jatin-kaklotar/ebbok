<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function setErrorLogOfApi($response)
    {
        if (isset($response['errorMessage'])) {
            Log::info("Product Fetch:");
            Log::error($response['errorMessage']);
        }
    }

    protected function getFormatedDate($dateTime, $format = 'M Y')
    {
        return $dateTime ? Carbon::parse($dateTime)->format($format) : null;
    }
}
