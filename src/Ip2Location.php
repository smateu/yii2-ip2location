<?php

declare(strict_types=1);

namespace slavkluev\Ip2Location;

use IP2Location\Database;
use Yii;
use yii\base\Component;

class Ip2Location extends Component
{
    /**
     * Path to database file.
     * @var string
     */
    public $dbFile;

    /**
     * Unique download token to download IP2Location databases.
     * @var string
     */
    public $downloadToken;

    /**
     * Database code for downloading.
     * @var string
     */
    public $downloadCode = 'DB1LITEBIN';

    /**
     * Caching mode (one of FILE_IO, MEMORY_CACHE, or SHARED_MEMORY).
     * @var int
     */
    public $mode = Database::FILE_IO;

    /**
     * Field(s) to return.
     * @var array|int
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
     * This function will look the given IP address up in the database and return the result(s) asked for.
     *
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
     * Updates and reloads the database.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function update()
    {
        $uploader = new Uploader();
        $uploader->update($this->downloadToken, $this->downloadCode, $this->getDbFile());
        $this->loadDb();
    }

    /**
     * @return Database
     */
    public function getDb(): Database
    {
        return $this->db;
    }

    protected function getDbFile()
    {
        return $this->dbFile ?: Yii::getAlias('@vendor/slavkluev/yii2-ip2location/database/DB.BIN');
    }
}
