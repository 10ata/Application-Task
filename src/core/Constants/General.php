<?php

namespace src\core\Constants;

class General
{
    const CONTROLLER_SUFFIX = 'controller';
    const METHOD_SUFFIX = 'Action';
    const CONTROLLERS_DIR = "src\controllers\\";
    const MODELS_DIR = "src\Models\\";
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
}