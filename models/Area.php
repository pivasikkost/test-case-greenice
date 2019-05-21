<?php

namespace app\models;

use \yii\base\BaseObject;
use \yii\helpers\ArrayHelper;

class Area extends BaseObject
{
    const VIEW_WITH_COORDS = 0;
    const VIEW_WITH_DISTANCE = 1;

    public $id;
    public $address;
    public $lat;
    public $lng;
    public $distance;


    /**
     * Returns a list of areas
     *
     * @param string $area
     * @return array
     */
    public static function getList($area = null)
    {
        $areas = include __DIR__ . '/areas.php';

        if (isset($areas[$area])) {
            $areas = static::sortByDistance($areas, $area);
            $areas = static::prepareForView($areas, static::VIEW_WITH_DISTANCE);
        } else {
            $areas = static::sortAlphabetically($areas, $area);
            $areas = static::prepareForView($areas, static::VIEW_WITH_COORDS);
        }

        return $areas;
    }

    /**
     * Sorts areas by distance from the selected area
     *
     * @param array $areas
     * @param string $area
     * @return array
     */
    public static function sortByDistance($areas, $area)
    {
        foreach ($areas as $key => $value) {
            $areas[$key]['distance'] = static::getDistance($areas[$area], $value);
        }
        ArrayHelper::multisort($areas, 'distance', SORT_ASC, SORT_NUMERIC);
        return $areas;
    }

    /**
     * Sorts areas alphabetically
     *
     * @param array $areas
     * @param string $area
     * @return array
     */
    public static function sortAlphabetically($areas, $area)
    {
        foreach ($areas as $key => $value) {
            $areas[$key]['address'] = $key;
        }
        ArrayHelper::multisort($areas, 'address', SORT_ASC, SORT_STRING);
        return $areas;
    }

    /**
     * Returns the distance between coordinates, in kilometers
     *
     * This uses the ‘haversine’ formula to calculate the great-circle distance between two points – that is,
     * the shortest distance over the earth’s surface – giving an ‘as-the-crow-flies’ distance between the points
     * (ignoring any hills they fly over, of course!).
     *
     * Collected from answers on
     * https://stackoverflow.com/questions/27928/calculate-distance-between-two-latitude-longitude-points-haversine-formula
     *
     * @param array $coord1
     * @param array $coord2
     * @return int
     */
    public static function getDistance($coord1, $coord2)
    {
        if (($coord1['lat'] == $coord2['lat']) && ($coord1['long'] == $coord2['long'])) {
            return 0;
        }

        $lat1 = deg2rad($coord1['lat']); // deg * (Math.PI/180)
        $lon1 = deg2rad($coord1['long']);
        $lat2 = deg2rad($coord2['lat']);
        $lon2 = deg2rad($coord2['long']);

        $r = 6372.797; // Radius of the earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $r * $c; // Distance in km

        return round($d);
    }

    /**
     * Returns a list of areas in a format convenient for use in view
     *
     * @param array $areas
     * @param int $format
     * @return array
     */
    public static function prepareForView($areas, $format)
    {
        if ($format === static::VIEW_WITH_COORDS) {
            foreach ($areas as $key => $value) {
                $areas[$key] = $key . ' ' . $value['lat'] . ' ' . $value['long'];
            }
        } elseif ($format === static::VIEW_WITH_DISTANCE) {
            foreach ($areas as $key => $value) {
                $areas[$key] = $key . ' ' . $value['distance'] . ', kms';
            }
        }

        return $areas;
    }
}
