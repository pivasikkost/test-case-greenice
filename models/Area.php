<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\helpers\ArrayHelper;

/**
 * This is the model class for table "places".
 *
 * @property int $id
 * @property string $address
 * @property double $lat
 * @property double $lng
 */
class Area extends ActiveRecord
{
    const VIEW_WITH_COORDS = 0;
    const VIEW_WITH_DISTANCE = 1;

    public $distance;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'places';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'lat', 'lng'], 'required'],
            [['lat', 'lng'], 'number'],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'address' => Yii::t('app', 'Address'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
        ];
    }

    /**
     * Returns a list of areas
     *
     * @param string $area
     * @return array
     */
    public static function getList($area = null)
    {
        $areas = static::find()->orderBy('address')->indexBy('address')->all();

        if (isset($areas[$area])) {
            $areas = static::sortByDistance($areas, $area);
            $areas = static::prepareForView($areas, static::VIEW_WITH_DISTANCE);
        } else {
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
        if (($coord1['lat'] == $coord2['lat']) && ($coord1['lng'] == $coord2['lng'])) {
            return 0;
        }

        $lat1 = deg2rad($coord1['lat']); // deg * (Math.PI/180)
        $lon1 = deg2rad($coord1['lng']);
        $lat2 = deg2rad($coord2['lat']);
        $lon2 = deg2rad($coord2['lng']);

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
                $areas[$key] = $value['address'] . ' ' . $value['lat'] . ' ' . $value['lng'];
            }
        } elseif ($format === static::VIEW_WITH_DISTANCE) {
            foreach ($areas as $key => $value) {
                $areas[$key] = $value['address'] . ' ' . $value['distance'] . ', kms';
            }
        }

        return $areas;
    }
}
