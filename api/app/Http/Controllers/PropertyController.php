<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\IProperty;
use Illuminate\Http\Request;
use Validator;

class PropertyController extends Controller
{
    protected $property;

    public function __construct(IProperty $property)
    {
        $this->property = $property;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'suburb' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return  response()->json([
                'status' => 'failed',
               'message' => $validator->errors()
            ], 401);
        }

        return $this->property->store($request);
    }

    public function analytics($id)
    {
        return $this->property->analytics($id);
    }

    public function addAnalytic($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',//only consider numeric for now
            'analytic_type_id' => 'required|exists:analytic_types,id',
        ]);

        if ($validator->fails()) {
            return  response()->json([
               'status' => 'failed',
               'message' => $validator->errors()
            ], 401);
        }

        return $this->property->addAnalytic($id, $request);
    }
}
