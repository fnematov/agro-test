<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = [], $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json($data, $code);
    }

    /**
     * @param $errors
     * @param $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($errors, $message, int $code = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'errors' => $errors,
            'message' => $message
        ], $code);
    }
}
