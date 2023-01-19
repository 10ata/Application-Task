<?php

namespace src\controllers;

use src\core\MVC\AbstractController;
use src\Models\ApplicationService;
use src\formatters\ServiceFormatter;


class IndexController extends AbstractController
{
    //home page, prepare table stats
    public function indexAction($test = null)
    {
        $applicationServiceModel = $this->modelLoader->load("ApplicationService");
        $applicationServices = $applicationServiceModel->getResultFromLastSevenDays();
        $application_service_formatted = [];
        foreach($applicationServices ?? [] as $applicationService) {
            $application_service_formatted[] = $this->formatter->load("ServiceFormatter")->objectToArray()->getApplicationService($applicationService);
        }
        
        $test = 1;
        $this->render('home/index', ['services' => $application_service_formatted]);
    }

    //login (GET/POST)
    public function loginAction()
    {
        if ($this->isPost()) {
            $userModel = $this->modelLoader->load("User");
            $user = $userModel->getByEmailAndPassword($_POST['email'], $_POST['password']);
            
            if (empty($user)) {
                return $this->redirect("/index/login", "Invalid Credentials!", true);
            }
    
            $_SESSION["user"] = (array)$user;
            return $this->redirect($_SESSION['previous_location'][0] ?? '/');
        }
        else if (isset($_SESSION["user"])) {
            return $this->redirect("/");
        }
        else {
            $this->render('login/index', []);
        }
        
    }

    //logout, destroy session and session variables
    public function logoutAction()
    {
        session_unset();
        session_destroy();
        return $this->redirect("/");
    }
}