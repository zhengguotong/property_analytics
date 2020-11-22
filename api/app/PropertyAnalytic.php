<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAnalytic extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'analytic_type_id',
        'value',
    ];

    /**
    * Get the property that owns the analytic.
    */
    public function property()
    {
        return $this->belongsTo('App\Property');
    }

    /**
     * get the analytic type of this property analytic is belong to
     */
    public function analyticType()
    {
        return $this->belongsTo('App\AnalyticType');
    }

    /**
     * Scope a query to only include properties of a suburb.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfSuburb($query, $suburb)
    {
        return $query->whereHas('property', function ($q) use ($suburb) {
            $q->where('suburb', '=', $suburb);
        });
    }

    /**
    * Scope a query to only include properties of a suburb.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @param  mixed  $type
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeOfState($query, $state)
    {
        return $query->whereHas('property', function ($q) use ($state) {
            $q->where('state', '=', $state);
        });
    }

    /**
     * Scope a query to only include properties of a suburb.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCountry($query, $country)
    {
        return $query->whereHas('property', function ($q) use ($country) {
            $q->where('country', '=', $country);
        });
    }
}
