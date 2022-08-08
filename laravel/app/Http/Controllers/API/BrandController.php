<?php

namespace App\Http\Controllers\API;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:destroy')->only('destroy');
    }
    
    public function index()
    {
        $response = [
            'data' => [],
            'message' => 'Get List Brand false'
        ];

        $brands = Brand::where('status', Constants::BRAND_STATUS_ACTIVE)->orderBy('brand.created_at', 'desc')->paginate(3);
        
        if ($brands) {
            $response['data'] = $brands;
            $response['message'] = 'Get List Brand success';
        }

        return response()->json($response);
    }

    public function create()
    {
        return 'view create';
    }

    public function store(Request $request)
    {
        $response = [
            'data' => [],
            'message' => 'New Brand Created fail'
        ];

        $validator = Validator($request->only('name', 'logo'), [
            'name' => 'max:255|string',
            'logo' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), $response['message'], ]);
        }

        $brand = Brand::create([
            'name' => $request->name,
            'logo' => $request->logo,
            'status' => Constants::BRAND_STATUS_ACTIVE
        ]);

        if ($brand) {
            $response['data'] = $brand;
            $response['message'] = 'New Brand created success';
        }

        return response()->json($response);
    }

    public function show($id)
    {
        $response = [
            'data' => [],
            'message' => 'Get data false'
        ];

        $validator = Validator(['id'], [
            'id' => 'integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([$validator->errors(), 'Request need contain only id']);
        }

        $brand = Brand::where('id', $id)->first();

        if ($brand) {
            $response['data'] = $brand;
            $response['message'] = 'Get data success';
        }

        return response()->json($response);
    }

    public function edit()
    {
        return 'view edit';
    }

    public function update(Request $request, $id)
    {
        $response = [
            'data' => [],
            'message' => 'Update fails'
        ];

        $validator = Validator($request->only('name', 'logo'), [
            'name' => 'max:255|string',
            'logo' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        }

        $brand = Brand::where('id', $id)
        ->where('status', Constants::BRAND_STATUS_ACTIVE)
        ->update([
            'name' => $request->name,
            'logo' => $request->logo
        ]);

        if ($brand) {
            $response['message'] = 'Update success';
        }

        return response()->json($response);
    }

    public function destroy($id)
    {
        $response = [
            'data' => [],
            'message' => 'Delete false',
        ];

        $brand = Brand::where('id', $id)
        ->where('status', Constants::BRAND_STATUS_ACTIVE)
        ->update([
            'status' => Constants::BRAND_STATUS_DEACTIVE
        ]);

        if ($brand) {
            $response['message'] = 'Delete success!';
        }

        return response()->json($response);
    }
}
