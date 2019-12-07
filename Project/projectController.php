<?php
require('../connection.php');
error_reporting(0);

    function getProjectList()
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT * FROM project");
        $stmt->execute();
        $projects = $stmt->fetchAll();
	    return $projects;
    }

    function getTicketList($projectId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT * FROM ticket WHERE projectId = ?");
        $stmt->execute([$projectId]);
        $tickets = $stmt->fetchAll();
	    return $tickets;

    }

    if ($_GET['projectId'])
    {
       echo json_encode(getTicketList($_GET['projectId']));
       // Echo is made to ensure XMLHttpRequest gets it
    }
    else
    {
        // Should not go anything
    }
?>