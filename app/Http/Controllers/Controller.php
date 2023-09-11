<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function welcome()
    {

    }

    public static function response($status, $message, $data = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data ?? new \stdClass(),
        ], $code);
    }
}
