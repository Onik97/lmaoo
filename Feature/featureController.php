<?php require_once(__DIR__ . "/../connection.php");
$featureController = new featureController();

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
else { return; }

class featureController
{
    public function loadFeatures($projectId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT * FROM feature WHERE projectId = ?");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll();
    }

    public function featureExistance($featureName, $projectId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT name FROM feature WHERE name = ? AND projectId = ?");
        $stmt->execute([$featureName, $projectId]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public function createFeature($featureName, $projectId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO feature (name, projectId) VALUES (?, ?)");
        $stmt->execute([$featureName, $projectId]);
    }
}

?>