<?php

declare(strict_types=1);

namespace slavkluev\Ip2Location\commands;

use yii\console\Controller;

class Ip2LocationController extends Controller
{
    public $defaultAction = 'update';

    public function actionUpdate()
    {
        try {
            \Yii::$app->ip2location->update();
            echo 'Database was updated successfully.' . PHP_EOL;
        } catch (\Exception $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    }
}
