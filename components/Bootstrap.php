<?php
namespace app\components;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Here you can refer to Application object through $app variable
        $app->params['uploadPath'] = $app->basePath . '/web/uploads/';
        $app->params['uploadUrl'] = $app->urlManager->baseUrl . '/web/uploads/';
    }     
}