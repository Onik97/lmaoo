<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php");

try
{
    if (!Validator::validateUserLoggedIn()) { http_response_code(401); return; }
    RouteController::Post("loadActiveFeatures", Validator::validateDeveloper(), 'FeatureController::loadActiveFeatures', [@$_POST['projectId']]);
    RouteController::Post("loadInactiveFeatures", Validator::validateDeveloper(), 'FeatureController::loadInactiveFeatures', [@$_POST['projectId']]);
    RouteController::Post("activateFeature", Validator::validateDeveloper(), 'FeatureController::activateFeature', [@$_POST['projectId']]);
    RouteController::Post("deactivateFeature", Validator::validateDeveloper(), 'FeatureController::deactivateFeature', [@$_POST['projectId']]);
    RouteController::Post("checkFeatureExistance", Validator::validateDeveloper(), 'FeatureController::featureExistance', [@$_POST['featureName'], @$_POST['projectId']]);
    RouteController::Post("createFeature", Validator::validateManager(), 'FeatureController::createFeature', [@$_POST['featureName'], @$_POST['projectId']]);
    Validator::ThrowNotFound();
}
catch(Throwable $e)
{
    http_response_code(500);
}