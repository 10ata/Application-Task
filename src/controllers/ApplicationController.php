<?php

namespace src\controllers;

use src\core\MVC\AbstractController;
use src\Models\Application;
use src\formatters\ServiceFormatter;


class ApplicationController extends AbstractController
{
    
    public function indexAction($test = null)
    {
        $this->filterAction();
    }

    public function filterAction()
    {
        $applicationModel = $this->modelLoader->load("Application");
        $applications = $applicationModel->getAllDescending();
        $applications_formatted = [];
        foreach($applications ?? [] as $application) {
            $applications_formatted[] = $this->formatter->load("ApplicationFormatter")->objectToArray()->getApplication($application);
        }
        $this->render('application/filter', ['applications' => $applications_formatted]);
    }

    public function addAction()
    {
        $this->render('application/add_edit', ['is_add' => true]);
    }

    public function editAction()
    {
        $this->render('application/add_edit', ['is_add' => false]);
    }

    public function viewAction($id = null)
    {
        if (!isset($id)) {
            $_SESSION["errorMessage"] = "Invalid Application ID Provided";
            header("Location: http://" . $_SERVER['SERVER_NAME'] . "/");
            exit();
        }

        $applicationModel = $this->modelLoader->load("Application");
        $application = $applicationModel->getById($id);

        if (empty($application)) {
            $_SESSION["errorMessage"] = "Application with ID `$id` not found!";
            header("Location: http://" . $_SERVER['SERVER_NAME'] . "/");
            exit();
        }

        $application_formatted = $this->formatter->load("ApplicationFormatter")->objectToArray()->getApplication($application);

        $applicationServiceModel = $this->modelLoader->load("ApplicationService");
        $applicationServices = $applicationServiceModel->getByApplicationId($id);
        $application_service_formatted = [];
        foreach($applicationServices ?? [] as $applicationService) {
            $application_service_formatted[] = $this->formatter->load("ServiceFormatter")->objectToArray()->getApplicationService($applicationService);
        }

        $this->render('application/view', ['application' => $application_formatted, 'services' => $application_service_formatted]);
    }

}