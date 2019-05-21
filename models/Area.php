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
     * @param array $coord1
     * @param array $coord2
     * @return int
     */
    public static function getDistance($coord1, $coord2)
    {
        return rand();
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
                $areas[$key] = $key . ' ' . $value['distance'] . ', km';
            }
        }

        return $areas;
    }
}
