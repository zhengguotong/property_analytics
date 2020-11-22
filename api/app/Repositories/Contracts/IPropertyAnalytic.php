<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IPropertyAnalytic
{
    public function filterLocation(Request $request);
}
