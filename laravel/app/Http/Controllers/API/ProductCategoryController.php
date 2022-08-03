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
        $response = [
            'data' => [],
            'message' => 'Get List Product Category false'
        ];

        $product = ProductCategory::orderBy('product_category.created_at', 'desc')->paginate(3);
        
        if ($product) {
            $response['data'] = $product;
            $response['message'] = 'Get List Product Category success';
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
            'message' => 'New Product category Created fail'
        ];

        $validator = Validator($request->only('name'), [
            'name' => 'max:255|string',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), $response['message'], ]);
        }

        $product_category = ProductCategory::create([
            'name' => $request->name,
        ]);

        if ($product_category) {
            $response['data'] = $product_category;
            $response['message'] = 'New Product category created success';
        }

        return response()->json($response);
    }

    public function show($id)
    {
        $response = [
            'data' => [],
            'message' => 'Get single product false'
        ];

        $validator = Validator(['id'], [
            'id' => 'integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([$validator->errors(), 'Request need contain only id']);
        }

        $brand = ProductCategory::where('id', $id)->first();

        if ($brand) {
            $response['data'] = $brand;
            $response['message'] = 'Get single product success';
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

        $validator = Validator($request->only('name'), [
            'name' => 'max:255|string',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        }

        $brand = ProductCategory::where('id', $id)
        ->update([
            'name' => $request->name,
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

        $brand = ProductCategory::where('id', $id)
        ->where('status', Constants::PRODUCT_CATEGORY_STATUS_ACTIVE)
        ->update([
            'status' => Constants::PRODUCT_CATEGORY_STATUS_DEACTIVE
        ]);

        if ($brand) {
            $response['message'] = 'Delete success!';
        }

        return response()->json($response);
    }
}
