<?php

namespace App\Http\Controllers;

use App\Constants;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($data = [], $message = 'Something Wrong!', $code = 404)
    {
        return [
            'data' => $data,
            'message' => $message,
            'code' => $code
        ];
    }

    public function permission()
    {
        $user = Auth::user();
        dd($user);
    }


}
