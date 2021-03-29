<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class FeatureController
{
    public static function loadActiveFeatures($projectId)
    {
        $feature = new Feature();
        return $feature->getActiveFeature($projectId);
    }

    public static function loadInactiveFeatures($projectId)
    {
        $feature = new Feature();
        return $feature->getInactiveFeature($projectId);
    }

    public static function activateFeature($featureId)
    {
        $feature = new Feature();
        return $feature->activateFeature($featureId);
    }

    public static function deactivateFeature($featureId)
    {
        $feature = new Feature();
        return $feature->deactivateFeature($featureId);
    }

    public static function featureExistance($featureName, $projectId)
    {
        $feature = new Feature();
        return $feature->doesFeatureExists($featureName, $projectId);
    }

    public static function createFeature($featureName, $projectId)
    {
        $feature = new Feature();
        $feature->createFeature($featureName, $projectId);
    }
}

?>