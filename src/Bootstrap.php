<?php

declare(strict_types=1);

namespace slavkluev\Ip2Location;

class Bootstrap implements \yii\base\BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $app->controllerMap['ip2location'] = 'slavkluev\Ip2Location\commands\Ip2LocationController';
        }
    }
}
