<?php
include_once("controller/controller.php");
include_once("dboprosnik.php"); 

$controller = new SurveyController($pdo); 
$controller->processSurvey();

?>
