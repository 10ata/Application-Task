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
        $this->render('home/index', ['services' => $application_service_formatted]);
    }

    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->modelLoader->load("User");
            $user = $userModel->getByEmailAndPassword($_POST['email'], $_POST['password']);
            
            if (empty($user)) {
                $_SESSION["errorMessage"] = "Invalid Credentials";
                header("Location: http://" . $_SERVER['SERVER_NAME'] . "/index/login");
                exit();
            }
    
            $_SESSION["user"] = (array)$user;
            header("Location: http://" . $_SERVER['SERVER_NAME'] . $_SESSION['previous_location'][0] ?? '/');
            exit();
        }
        else if (isset($_SESSION["user"])) {
            header("Location: http://" . $_SERVER['SERVER_NAME'] . "/");
            exit();
        }
        else {
            $this->render('login/index', []);
        }
        
    }

    public function logoutAction()
    {
        session_unset();
        session_destroy();
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/");
        exit();
    }
}