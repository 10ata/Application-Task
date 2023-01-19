<?php

namespace src\controllers;

use src\core\MVC\AbstractController;
use src\Models\ApplicationService;
use src\formatters\ServiceFormatter;


class IndexController extends AbstractController
{
    
    public function indexAction($test = null)
    {
        $applicationServiceModel = $this->modelLoader->load("ApplicationService");
        $applicationServices = $applicationServiceModel->getResultFromLastSevenDays();
        $application_service_formatted = [];
        foreach($applicationServices ?? [] as $applicationService) {
            $application_service_formatted[] = $this->formatter->load("ServiceFormatter")->objectToArray()->getApplicationService($applicationService);
        }
        
        $test = 1;
        $this->render('home/index', ['test' => 1, 'services' => $application_service_formatted]);
    }

    public function logoutAction()
    {
        echo $_SERVER['SERVER_NAME'];
        echo $_SERVER['REQUEST_URI'];
        echo $_SERVER['HTTP_HOST'];die;
        session_unset();
        session_destroy();
    }
}