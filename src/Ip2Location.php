<?php

declare(strict_types=1);

namespace slavkluev\Ip2Location;

use IP2Location\Database;
use Yii;
use yii\base\Component;

class Ip2Location extends Component
{
    /**
     * @var string
     */
    public $dbFile;

    /**
     * @var string
     */
    public $downloadToken;

    /**
     * @var string
     */
    public $downloadCode = 'DB1LITEBIN';

    /**
     * @var int
     */
    public $mode = Database::FILE_IO;

    /**
     * @var int
     */
    public $defaultFields = Database::ALL;

    /**
     * @var Database
     */
    protected $db;

    /**
     * @throws \Exception
     */
    public function init()
    {
        parent::init();
        $this->loadDb();
    }

    /**
     * @throws \Exception
     */
    public function loadDb()
    {
        $this->db = new Database($this->getDbFile(), $this->mode, $this->defaultFields);
    }

    /**
     * @param string|null $ip
     *
     * @return array|bool|mixed
     */
    public function ip(?string $ip = null)
    {
        if ($ip === null) {
            $ip = Yii::$app->request->getUserIP();
        }

        return $this->db->lookup($ip);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function update()
    {
        $uploader = new Uploader();
        $uploader->update($this->downloadToken, $this->downloadCode, $this->getDbFile());
        $this->loadDb();
    }

    protected function getDbFile()
    {
        return $this->dbFile ?: Yii::getAlias('@vendor/slavkluev/yii2-ip2location/database/IP2LOCATION-LITE-DB1.BIN');
    }
}
