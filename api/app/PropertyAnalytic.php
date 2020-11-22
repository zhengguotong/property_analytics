<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAnalytic extends Model
{
    use HasFactory;

    /**
    * Get the property that owns the analytic.
    */
    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }

    /**
     * get the analytic type of this property analytic is belong to
     */
    public function analyticType()
    {
        return $this->belongsTo('App\Models\AnalyticType');
    }
}
