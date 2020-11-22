<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\IPropertyAnalytic;
use Illuminate\Http\Request;

class PropertyAnalyticController extends Controller
{
    protected $propertyAnalytic;

    public function __construct(IPropertyAnalytic $propertyAnalytic)
    {
        $this->propertyAnalytic = $propertyAnalytic;
    }

    public function search(Request $request)
    {
        return $this->propertyAnalytic->filterLocation($request);
    }
}
