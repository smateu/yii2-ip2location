<?php

declare(strict_types=1);

namespace slavkluev\Ip2Location\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class Ip2LocationController extends Controller
{
    public $defaultAction = 'update';

    /**
     * Updates and reloads the database.
     */
    public function actionUpdate()
    {
        try {
            Yii::$app->ip2location->update();
            $this->stdout('Database was updated successfully.', Console::FG_GREEN);
            return ExitCode::OK;
        } catch (\Exception $exception) {
            $this->stderr($exception->getMessage(), Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}
