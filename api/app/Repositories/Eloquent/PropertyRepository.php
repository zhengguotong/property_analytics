<?php

namespace App\Repositories\Eloquent;

use App\Property;
use App\Http\Resources\PropertyAnalytic as PropertyAnalyticResource;
use App\Repositories\Contracts\IProperty;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PropertyRepository extends BaseRepository implements IProperty
{
    public function model()
    {
        return Property::class;
    }

    public function store(Request $request)
    {
        $fields = $request->all();

        //generate UUID for this property
        $fields['guid'] = (string) Str::uuid();

        $this->model::create($fields);
        
        return response()->json([
            'status' => 'success',
            'message' => 'New property created',
        ]);
    }

    public function analytics($id)
    {
        $model = $this->model->find($id);
        if ($model) {
            return PropertyAnalyticResource::collection($model->analytics);
        } else {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Given property id not found',
            ], 404);
        }
    }

    public function addAnalytic($id, Request $request)
    {
        $model = $this->model->find($id);
        if ($model) {
            $condition['analytic_type_id'] = $request->analytic_type_id;
            $data['value'] =  $request->value;
            $model->analytics()->updateOrCreate($condition, $data);
           
            return response()->json([
            'status' => 'success',
            'message' => 'property analytic success created/updated     ',
        ]);
        } else {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Given property id not found',
            ], 404);
        }
    }
}
