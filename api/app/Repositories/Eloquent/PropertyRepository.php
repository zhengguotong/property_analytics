<?php

namespace App\Repositories\Eloquent;

use App\Property;
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

        $model = $this->model::create($fields);

        return response()->json([
            'status' => 'success',
            'message' => 'New model created',
            'data' => $model
        ]);
    }
}
