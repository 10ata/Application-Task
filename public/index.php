<?php
//main index file. This is the root of the project.
session_start();
require_once realpath("../vendor/autoload.php");
use src\core\App;

//defining global constants
define('ENVIRONMENT', 'development');
define('SOURCE_DIR', __DIR__ . '\..\src\\');
define('CONFIGS_DIR', __DIR__ . '\..\src\configs\\');
define('ASSETS_DIR', __DIR__);
define('VIEWS_DIR', SOURCE_DIR . 'views\\');
define('CONTROLLERS_DIR', __DIR__ . '\..\src\controllers\\');
define('MODELS_DIR', __DIR__ . '\..\src\models\\');

//public/index.php -> App handling url, calling controller and method -> Controller handling requests and renders a template.
try {
    $app = new App();
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), str_replace("#", "<br>#", $e->getTraceAsString());
}