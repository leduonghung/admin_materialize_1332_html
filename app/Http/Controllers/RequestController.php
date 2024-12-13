<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function domain(Request $request)
    {
        $id = request()->id ? ',' . request()->id : '';
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:domains,name' . $id, 
        ]);
        // echo $id;
        if ($validator->passes()) {
            return response()->json([
                'message' => 'Tên miền này hợp lệ !',
            ], 200);
            // return response()->json(['success' => 'Added new records.']);
        }
        return response()->json([
            'message' => 'Tên miền này ko hợp lệ !',
            'error' => $validator->errors()->all()
        ], 201);
        // return response()->json(['error' => $validator->errors()->all()]);
    }
    public function dotDomain(Request $request)
    {
        $id = request()->id ? ',' . request()->id : '';
        // dd($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:domain_extensions,name' . $id, 
        ]);
        if ($validator->passes()) {
            return response()->json([
                'message' => 'đuôi mở rộng này hợp lệ !',
            ], 200);
            // return response()->json(['success' => 'Added new records.']);
        }
        return response()->json([
            'message' => 'đuôi mở rộng này ko hợp lệ !',
            'error' => $validator->errors()->all()
        ], 201);
        // return response()->json(['error' => $validator->errors()->all()]);
    }
}
