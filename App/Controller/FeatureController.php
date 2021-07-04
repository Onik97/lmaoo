<?php
namespace Lmaoo\Controller;

use Lmaoo\Core\Constant;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Model\Feature;
use Lmaoo\Utility\Validation;

class FeatureController extends BaseController
{
    public function createFeature($json)
    {
        $data = json_decode($json, true); $validation = Validation::createFeature($data);
        if ($validation == null)
        {
            $latestId = Feature::create($data);
            echo json_encode(Feature::read(Constant::$FEATURE_COLUMNS, array("featureId" => $latestId)));
        }
        else
        {
            APIResponse::BadRequest($validation);
        }
    }

    public function readFeatures($projectId, $active)
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

    public function readWithId($featureId)
    {
        echo json_encode(Feature::read(Constant::$FEATURE_COLUMNS , array("featureId" => $featureId)));
    }

    public function updateFeatures($json)
    {
        $data = json_decode($json, true); $validation = Validation::updateFeature($data);
        $featureId = $data['featureId'];

        $validation == null ? Feature::update($featureId,$data) : APIResponse::BadRequest($validation);
    }

    public static function deactivateFeature($json)
    {
        $data = array("active" => "0");
        $featureIddata = $json['featureId'];
        $featureId = (int) $featureIddata;
        Feature::update($featureId, $data);
    }
}
