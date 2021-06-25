<?php
namespace Lmaoo\Controller;

use Lmaoo\Core\Constant;
use Lmaoo\Utility\Library;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Model\Feature;
use Lmaoo\Utility\Validation;

class FeatureController extends BaseController
{
    public static function createFeature($json)
    {
        $data = json_decode($json, true);
        Feature::create($data);
    }

    public static function readFeatures($projectId, $active)
    {
        $features = Feature::read(Constant::$FEATURE_COLUMNS, array("projectId" => $projectId));
        $returnFeatures = array();
        foreach ($features as $feature)
        {
            if ($feature->active == $active) {
                array_push($returnFeatures, $feature);
            }
        }
        return $returnFeatures;
    }

    public static function activateFeature($featureId)
    {
        $data = array("active" => "1");
        Feature::update($featureId, $data);
    }

    public static function deactivateFeature($featureId)
    {
        $data = array("active" => "0");
        Feature::update($featureId, $data);
    }
}
