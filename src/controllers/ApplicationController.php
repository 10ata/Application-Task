<?php

namespace src\controllers;

use src\core\MVC\AbstractController;
use src\Models\ApplicationService;
use src\formatters\ServiceFormatter;


class ApplicationController extends AbstractController
{
    
    public function indexAction($test = null)
    {
        $this->filterAction();
    }

    public function filterAction()
    {
        $applicationServiceModel = $this->modelLoader->load("ApplicationService");
        $applicationServices = $applicationServiceModel->getResultFromLastSevenDays();
        $application_service_formatted = [];
        foreach($applicationServices ?? [] as $applicationService) {
            $application_service_formatted[] = $this->formatter->load("ServiceFormatter")->objectToArray()->getApplicationService($applicationService);
        }
        $this->render('application/filter', ['services' => $application_service_formatted]);
    }

}