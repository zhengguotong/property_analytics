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

    /**
     * Search property analytic given by location filter
     * 1.suburb
     * 2.state
     * 3.country
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        return $this->propertyAnalytic->filterLocation($request);
    }
}
