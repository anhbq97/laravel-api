<?php

namespace App\Http\Controllers\API;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $response = $this->response();

        try {
            $product = ProductCategory::orderBy('product_category.created_at', 'desc')->paginate(3);
        
            if ($product) {
                $response['data'] = $product;
                $response['message'] = 'Get List Product Category success';
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
            $validator = Validator($request->only('name'), [
                'name' => 'max:255|string',
            ]);
    
            if ($validator->fails()) {
                $response['data'] = $validator->errors();
                $response['message'] = 'Validator fails';

                return response()->json($response);
            }
    
            $product_category = ProductCategory::create([
                'name' => $request->name,
            ]);
    
            if ($product_category) {
                $response['data'] = $product_category;
                $response['message'] = 'New Product category created success';
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
            $brand = ProductCategory::where('id', $id)->first();

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
            $validator = Validator($request->only('name'), [
                'name' => 'max:255|string',
            ]);
    
            if ($validator->fails()) {
                $response['data'] = $validator->errors();

                return response()->json($response);
            }
    
            $brand = ProductCategory::where('id', $id)
            ->update([
                'name' => $request->name,
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
            $brand = ProductCategory::where('id', $id)
            ->where('status', Constants::PRODUCT_CATEGORY_STATUS_ACTIVE)
            ->update([
                'status' => Constants::PRODUCT_CATEGORY_STATUS_DEACTIVE
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
