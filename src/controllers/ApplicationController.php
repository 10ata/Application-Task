<?php

namespace src\controllers;

use src\core\MVC\AbstractController;
use src\Models\Application;
use src\Models\ApplicationService;
use src\Models\Service;
use src\core\Constants\General;

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

    public function managePostOperation($is_add, $id = null)
    {
        $applicationModel = $this->modelLoader->load("Application");
        $applicationServiceModel = $this->modelLoader->load("ApplicationService");
        $serviceModel = $this->modelLoader->load("Service");

        $request_data = $this->getRequestedData();
            
        foreach($request_data['services'] ?? [] as $service_id) {
            $service = $serviceModel->getById($service_id);
            if (empty($service)) {
                return $this->redirect("/", "Unexpected System Error: Service with ID `$service_id` could not be found in the DB!", true);
            }
        }

        if ($is_add) {
            $application = new Application();
        } else {
            if (!isset($id)) {
                return $this->redirect("/", "Invalid Application ID Provided", true);
            }
    
            $application = $applicationModel->getById($id);
    
            if (empty($application)) {
                return $this->redirect("/", "Application with ID `$id` not found!", true);
            }

            if ($application->status != General::APPLICATION_STATUS_OPEN) {
                return $this->redirect("/", "Application with ID `$id` has been already processed!", true);
            }
    
            $applicationServices = $applicationServiceModel->getByApplicationId($id);
            
            foreach($applicationServices ?? [] as $applicationService) {
                $key = array_search($applicationService['id'], $request_data['services']);
                if ($key === false) {
                    $applicationService = $applicationServiceModel->getByApplicationIdAndServiceId($application->id, $applicationService['id']);
                    $applicationService->delete();
                }
                else {
                    unset($request_data['services'][$key]);
                }
            }

            
        }
        $application->save($request_data);
        foreach($request_data['services'] ?? [] as $service_id) {
            $applicationService = new ApplicationService();
            $applicationService->application_id = $application->id;
            $applicationService->service_id = $service_id;
            $applicationService->save();
        }

        return $this->redirect("/application/edit/" . $application->id, "Application Saved Successfully!");
    }

    public function manageGetOperation($is_add, $id = null)
    {

        $applicationModel = $this->modelLoader->load("Application");
        $applicationServiceModel = $this->modelLoader->load("ApplicationService");
        $serviceModel = $this->modelLoader->load("Service");

        $application_formatted = [];

        if (!$is_add) {
            if (!isset($id)) {
                return $this->redirect("/", "Invalid Application ID Provided", true);
            }
    
            $application = $applicationModel->getById($id);
    
            if (empty($application)) {
                return $this->redirect("/", "Application with ID `$id` not found!", true);
            }

            if ($application->status != General::APPLICATION_STATUS_OPEN) {
                return $this->redirect("/", "Application with ID `$id` has been already processed!", true);
            }
    
            $application_formatted = $this->formatter->load("ApplicationFormatter")->objectToArray()->getApplication($application);
    
            $applicationServices = $applicationServiceModel->getByApplicationId($id);
            $application_service_formatted = [];
            foreach($applicationServices ?? [] as $applicationService) {
                $application_service_formatted[$applicationService['id']] = $this->formatter->load("ServiceFormatter")->objectToArray()->getApplicationService($applicationService);
            }

            $application_formatted['services'] = $application_service_formatted;
        }

        $services = $serviceModel->getAll();
        $services_formatted = [];
        foreach($services ?? [] as $service) {
            $services_formatted[] = $this->formatter->load("ServiceFormatter")->objectToArray()->getApplicationService($service);
        }

        $this->render('application/add_edit', ['is_add' => $is_add, 'application' => $application_formatted, 'services' => $services_formatted]);
    }

    public function manageOperation($is_add = false, $id = null)
    {
        if ($this->isPost()) {
            $this->managePostOperation($is_add, $id);
        } else {
            $this->manageGetOperation($is_add, $id);
        }
    }

    public function closeAction($id)
    {
        $status = General::APPLICATION_STATUS_CLOSED;
        return $this->changeStatus($id, $status);
    }

    public function cancelAction($id)
    {
        $status = General::APPLICATION_STATUS_CANCELLED;
        return $this->changeStatus($id, $status);
    }

    public function unlockAction($id)
    {
        $status = General::APPLICATION_STATUS_OPEN;
        return $this->changeStatus($id, $status);
    }

    public function changeStatus($id, $status)
    {
        $applicationModel = $this->modelLoader->load("Application");
        $application = $applicationModel->getById($id);

        if (empty($application)) {
            return $this->redirect("/", "Application with ID `$id` not found!", true);
        }

        $application->status = $status;
        $application->save();

        $action = $status == General::APPLICATION_STATUS_OPEN ? 'edit' : 'view';
        return $this->redirect("/application/$action/" . $id, "Status updated successfully!");
    }

    public function viewAction($id = null)
    {
        if (!isset($id)) {
            return $this->redirect("/", "Invalid Application ID Provided", true);
        }

        $applicationModel = $this->modelLoader->load("Application");
        $application = $applicationModel->getById($id);

        if (empty($application)) {
            return $this->redirect("/", "Application with ID `$id` not found!", true);
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