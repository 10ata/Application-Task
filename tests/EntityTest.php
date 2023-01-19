<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\Models\Country;
use src\core\Helpers\ModelLoader;

//1 Unit test to check Entity <-DBManager-> MySQL relation
final class EntityTest extends \PHPUnit\Framework\TestCase {
    
    public function testDBResult()
    {
        define('ENVIRONMENT', 'development');
        define('SOURCE_DIR', __DIR__ . '\..\src\\');
        define('CONFIGS_DIR', __DIR__ . '\..\src\configs\\');
        define('ASSETS_DIR', __DIR__);
        define('VIEWS_DIR', SOURCE_DIR . 'views\\');
        define('CONTROLLERS_DIR', __DIR__ . '\..\src\controllers\\');
        define('MODELS_DIR', __DIR__ . '\..\src\models\\');

        $modelLoader = ModelLoader::getInstance();

        /** @var Country $countryModel */
        $countryModel = $modelLoader->load("Country");

        /** @var Country $country */
        $country = $countryModel->getByIso2('BG');
        $expected_country = 'Bulgaria';

        $this->assertSame($expected_country, $country->name);
    }
}