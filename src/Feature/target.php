<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php");

try
{
    if (!Validator::validateUserLoggedIn()) { http_response_code(401); return; }
    RouteController::Post("loadFeatures", Validator::validateDeveloper(), 'FeatureController::loadFeatures', [@$_POST['projectId']]);
    RouteController::Post("checkFeatureExistance", Validator::validateDeveloper(), 'FeatureController::featureExistance', [@$_POST['featureName'], @$_POST['projectId']]);
    RouteController::Post("createFeature", Validator::validateDeveloper(), 'FeatureController::createFeature', [@$_POST['projectId']]);
    Validator::ThrowNotFound();
}
catch(Throwable $e)
{
    http_response_code(500);
}