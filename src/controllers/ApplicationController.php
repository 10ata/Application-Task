<?php

namespace src\controllers;

use src\core\MVC\AbstractController;
use src\Models\Application;

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
        return $this->manageOperation(true);
    }

    public function editAction($id)
    {
        return $this->manageOperation(false, $id);
    }

    public function manageOperation($is_add = false, $id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $test = $_POST;
            $te =1;
        } else {
            $application_formatted = [];

            if (!$is_add) {
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
                    $application_service_formatted[$applicationService['id']] = $this->formatter->load("ServiceFormatter")->objectToArray()->getApplicationService($applicationService);
                }

                $application_formatted['services'] = $application_service_formatted;
            }

            $serviceModel = $this->modelLoader->load("Service");
            $services = $serviceModel->getAll();
            $services_formatted = [];
            foreach($services ?? [] as $service) {
                $services_formatted[] = $this->formatter->load("ServiceFormatter")->objectToArray()->getApplicationService($service);
            }

            $this->render('application/add_edit', ['is_add' => $is_add, 'application' => $application_formatted, 'services' => $services_formatted]);
    
        }
    }

    public function closeAction($id)
    {
        $status = 2;
        return $this->changeStatus($id, $status);
    }

    public function cancelAction($id)
    {
        $status = 3;
        return $this->changeStatus($id, $status);
    }

    public function changeStatus($id, $status)
    {

        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/application/view/" . $id);
        exit();
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