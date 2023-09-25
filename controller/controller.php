<?php
include_once("model/model.php");
include_once("view/view.php");
include_once("dboprosnik.php");

class SurveyController {
    private $model;
    private $view;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->model = new SurveyModel($pdo);
        $this->view = new SurveyView();
    }

    public function processSurvey() {
        $responses = $this->model->getAllResponses();
        $this->view->renderTable($responses);
    }
}


?>