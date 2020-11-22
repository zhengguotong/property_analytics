<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IProperty
{
    public function store(Request $request);
}
