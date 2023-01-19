<?php

namespace src\core\Constants;
//generic constants to avoid repeating the same values.
class General
{
    const CONTROLLER_SUFFIX = 'controller';
    const METHOD_SUFFIX = 'Action';
    const CONTROLLERS_DIR = "src\controllers\\";
    const MODELS_DIR = "src\Models\\";
    const MODULES_DIR = "src\Modules\\";
    const FORMATTERS_DIR = "src\\formatters\\";

    const GENDER_MAP = [
        'M' => 'Male',
        'F' => 'Female'
    ];

    const APPLICATION_STATUS_MAP = [
        1 => 'Open',
        2 => 'Closed',
        3 => 'Cancelled'
    ];

    const APPLICATION_STATUS_OPEN = 1;
    const APPLICATION_STATUS_CLOSED = 2;
    const APPLICATION_STATUS_CANCELLED = 3;
}