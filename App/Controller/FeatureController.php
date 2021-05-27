<?php
namespace App\Controller;

use App\Utility\Library;
use App\Model\Feature;

class FeatureController
{
    public static function createFeature($featureName, $projectId)
    {
		if (Library::hasNull($featureName, $projectId)) return Library::redirectWithMessage("Something went wrong, please try again later", "/feature");
        $data = array("name" => $featureName, "projectId" => $projectId);
        Feature::create($data);
    }

    public static function readFeatures($projectId, $active)
    {
        $features = Feature::withProjectId($projectId);
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
