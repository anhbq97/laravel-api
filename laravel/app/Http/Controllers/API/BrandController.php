<?php

namespace App\Http\Controllers\API;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PermissionController;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read')->only('index', 'show');
        $this->middleware('permission:create')->only('create', 'store');
        $this->middleware('permission:update')->only('edit', 'update');
        $this->middleware('permission:delete')->only('destroy');
    }
    
    public function index()
    {
        $response = $this->response();

        try {
            $brands = Brand::where('status', Constants::BRAND_STATUS_ACTIVE)->orderBy('brand.created_at', 'desc')->paginate(3);
        
            if ($brands) {
                $response['data'] = $brands;
                $response['message'] = 'Get List Brand success';
                $response['code'] = 200;
            }
        } catch (\Exception $e) {
            echo 'Something Error in' . $e->getMessage() . "\n";
        }

        return response()->json($response);
    }

    public function create()
    {
        return 'view create';
    }

    public function store(Request $request)
    {
        $response = $this->response();

        try {
            $validator = Validator($request->only('name', 'logo'), [
                'name' => 'max:255|string',
                'logo' => 'string'
            ]);
    
            if ($validator->fails()) {
                $response['data'] = $validator->errors();
                $response['message'] = 'Validator fails';
    
                return response()->json($response);
            }
    
            $brand = Brand::create([
                'name' => $request->name,
                'logo' => $request->logo,
                'status' => Constants::BRAND_STATUS_ACTIVE
            ]);
    
            if ($brand) {
                $response['data'] = $brand;
                $response['message'] = 'New Brand created success';
                $response['code'] = 200;
            }
        } catch (\Exception $e) {
            echo 'Something Error in' . $e->getMessage() . "\n";
        }

        return response()->json($response);
    }

    public function show($id)
    {
        $response = $this->response();

        try {
            $brand = Brand::where('id', $id)->first();

            if ($brand) {
                $response['data'] = $brand;
                $response['message'] = 'Get data success';
            }
        } catch (\Exception $e) {
            echo 'Something Error in' . $e->getMessage() . "\n";
        }

        return response()->json($response);
    }

    public function edit()
    {
        return 'view edit';
    }

    public function update(Request $request, $id)
    {
        $response = $this->response();

        try {
            $validator = Validator($request->only('name', 'logo'), [
                'name' => 'max:255|string',
                'logo' => 'string'
            ]);
    
            if ($validator->fails()) {
                $response['data'] = $validator->errors();
    
                return response()->json($response);
            }
    
            $brand = Brand::where('id', $id)
            ->where('status', Constants::BRAND_STATUS_ACTIVE)
            ->update([
                'name' => $request->name,
                'logo' => $request->logo
            ]);
    
            if ($brand) {
                $response['data'] = $brand;
                $response['message'] = 'Update success';
                $response['code'] = 200;
            }
        } catch (\Exception $e) {
            echo 'Something Error in' . $e->getMessage() . "\n";
        }

        return response()->json($response);
    }

    public function destroy($id)
    {
        $response = $this->response();

        try {
            $brand = Brand::where('id', $id)
            ->where('status', Constants::BRAND_STATUS_ACTIVE)
            ->update([
                'status' => Constants::BRAND_STATUS_DEACTIVE
            ]);
    
            if ($brand) {
                $response['message'] = 'Delete success!';
            }
        } catch (\Exception $e) {
            echo 'Something Error in' . $e->getMessage() . "\n";
        }

        return response()->json($response);
    }
}
