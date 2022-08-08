<?php

namespace App\Http\Controllers\API;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:destroy')->only('destroy');
    }

    public function index()
    {
        $response = $this->response();

        try {
            $product = Product::products();
        
            if ($product) {
                $response['data'] = $product;
                $response['message'] = 'Get List Product success';
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
            $validator = Validator($request->only('name', 'price', 'brand_id', 'product_category_id'), [
                'name' => 'max:255|string',
                'price' => 'numeric',
                'brand_id' => 'integer',
                'product_category_id' => 'integer'
            ]);
    
            if ($validator->fails()) {
                $response['data'] = $validator->errors();
                $response['message'] = 'Validator fails';

                return response()->json($response);
            }
    
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'brand_id' => $request->brand_id,
                'product_category_id' => $request->product_category_id,
                'status' => Constants::PRODUCT_STATUS_ACTIVE
            ]);
    
            if ($product) {
                $response['data'] = $product;
                $response['message'] = 'New Product created success';
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
            $brand = Product::where('id', $id)->first();
    
            if ($brand) {
                $response['data'] = $brand;
                $response['message'] = 'Get single product success';
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
            $validator = Validator($request->only('name', 'price', 'brand_id', 'product_category_id'), [
                'name' => 'max:255|string',
                'price' => 'numeric',
                'brand_id' => 'integer',
                'product_category_id' => 'integer'
            ]);
    
            if ($validator->fails()) {
                $response['data'] = $validator->errors();
                $response['message'] = 'Validator fails';

                return response()->json($response);
            }
    
            $brand = Product::where('id', $id)
            ->where('status', Constants::PRODUCT_STATUS_ACTIVE)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'brand_id' => $request->brand_id,
                'product_category_id' => $request->product_category_id,
            ]);
    
            if ($brand) {
                $response['message'] = 'Update success';
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
            $brand = Product::where('id', $id)
            ->where('status', Constants::PRODUCT_STATUS_ACTIVE)
            ->update([
                'status' => Constants::PRODUCT_STATUS_DEACTIVE
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
