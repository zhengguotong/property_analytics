<?php

namespace App\Repositories\Eloquent;

use App\PropertyAnalytic;
use App\Repositories\Contracts\IPropertyAnalytic;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class PropertyAnalyticRepository extends BaseRepository implements IPropertyAnalytic
{
    public function model()
    {
        return PropertyAnalytic::class;
    }

    /**
     * filter properties by location filters
     * .suburb
     * .state
     * .country
     *
     *
     * @param Request $request
     * @return void
     */
    public function filterLocation(Request $request)
    {
        $values = array();
        $data = array();
        $total_property = 0;

        if ($request->suburb) {
            $data = $this->model->ofSuburb($request->suburb)->get();
            $total_property = $this->getPropertyCount('suburb', $request->suburb);
        } elseif ($request->state) {
            $data = $this->model->ofState($request->state)->get();
            $total_property = $this->getPropertyCount('state', $request->state);
        } elseif ($request->country) {
            $data = $this->model->ofCountry($request->country)->get();
            $total_property = $this->getPropertyCount('country', $request->country);
        }

        if (!empty($data) && count($data) > 0) {
            //group values base on analytic type id
            $data->map(function ($item) use (&$values) {
                //if not set this analytic before
                if (!isset($values[$item->analytic_type_id])) {
                    $values[$item->analytic_type_id] = array(
                        'units' => $item->analyticType->units,
                        'is_numeric' => $item->analyticType->is_numeric,
                        'analytic_name' => $item->analyticType->name,
                        'decimal_place' => $item->analyticType->num_decimal_places,
                    );
                }

                $values[$item->analytic_type_id]['values'][] = $item->value;
            });
            return
                response()->json([
                    'data' => $this->formatAnalyticValues($values, $total_property)
                ], 200);
        }
        return response()->json([
            'status' => 'Not Found',
            'message' => 'Not properties analytic matched given search criteria',
        ], 404);
    }
    
    /**
     * Get total property count base on filter key and value
     *
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    protected function getPropertyCount($key, $value)
    {
        return DB::table('properties')->where($key, $value)->count();
    }

    /**
     * get Analytic Values
     * min value, max value, median value, percentage properties with a value,
     * percentage properties without a value
     *
     * @param array $values
     * @param int $total_property
     * @return array
     */
    protected function formatAnalyticValues(array $values, $total_property)
    {
        $return = array();
        if (!empty($values)) {
            foreach ($values as $key => $value) {
                $tmp = $value['values'];
                //only  consider numerical value for now
                sort($tmp, SORT_NUMERIC);
                $count = count($tmp);
                $return[] = array(
                    'units' => $value['units'],
                    'analytic_name' => $value['analytic_name'],
                    'min_value' => $tmp[0],
                    'max_value' => $tmp[$count - 1],
                    'median_value' => $this->getMedianValue($tmp, $count, $value['decimal_place']),
                    'percentage_properties_with_value' => number_format($count / $total_property, 2),
                    'percentage_properties_without_value' => number_format(($total_property - $count) / $total_property, 2)
                );
            }
        }

        return $return;
    }

    /**
     * get property analytic median value
     *
     * @param array $value
     * @param integer $count
     * @param integer $decimal_place
     * @return number
     */
    protected function getMedianValue(array $value, int $count, int $decimal_place)
    {
        //check is event number
        $middle = ($count + 1) / 2;

        //is not event number so, median number is the middle number
        if (is_int($middle)) {
            return $value[$middle - 1];
        } else { //need to avg of  two values
            $middle = floor($middle);
            return number_format(($value[$middle - 1] +  $value[$middle]) / 2, $decimal_place, '.', '');
        }
    }
}
