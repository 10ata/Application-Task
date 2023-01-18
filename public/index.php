<?php

require_once realpath("../vendor/autoload.php");
use src\core\App;

define('ENVIRONMENT', 'development');
define('SOURCE_DIR', __DIR__ . '\..\src\\');
define('CONFIGS_DIR', __DIR__ . '\..\src\configs\\');
define('ASSETS_DIR', __DIR__);
define('VIEWS_DIR', SOURCE_DIR . 'views\\');
define('CONTROLLERS_DIR', __DIR__ . '\..\src\controllers\\');
define('MODELS_DIR', __DIR__ . '\..\src\models\\');

try {
    $app = new App();
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), str_replace("#", "<br>#", $e->getTraceAsString());
}