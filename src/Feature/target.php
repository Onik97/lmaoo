<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php");

try
{
    RouteController::Post("loadFeatures", Validator::validateManager(), FeatureController::loadFeatures($_POST['projectId']));
    RouteController::Post("checkFeatureExistance", Validator::validateManager(), FeatureController::featureExistance($_POST['featureName'], $_POST['projectId']));
    RouteController::Post("createFeature", Validator::validateManager(), FeatureController::createFeature($_POST['featureName'], $_POST['projectId']));
    Validator::ThrowNotFound();
}
catch(Throwable $e)
{
    http_response_code(500);
}