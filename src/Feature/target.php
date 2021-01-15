<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php");

$featureController = new FeatureController();
if($_POST['function'] == "loadFeatures")
{
    echo json_encode($featureController->loadFeatures($_POST['projectId']));
}
else if ($_POST['function'] == "checkFeatureExistance")
{
    echo $featureController->featureExistance($_POST['featureName'], $_POST['projectId']);
}
else if ($_POST['function'] == "createFeature")
{
    $featureController->createFeature($_POST['featureName'], $_POST['projectId']);
}
else 
{
    Library::notFoundMessage();
}   