<?php

namespace slavkluev\Ip2Location;

use IP2Location\Database;
use PHPUnit\Framework\TestCase;
use yii\console\Application;

class Ip2LocationTest extends TestCase
{
    /**
     * @var Ip2Location
     */
    public $ip2location;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockApplication();
        $this->createIp2Location();
    }

    protected function mockApplication()
    {
        new Application([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => dirname(__DIR__) . '/vendor',
            'runtimePath' => __DIR__ . '/runtime',
        ]);
    }

    protected function createIp2Location()
    {
        $this->ip2location = \Yii::createObject(Ip2Location::class, [
            [
                'dbFile' => __DIR__ . '/fixtures/IP2LOCATION-LITE-DB1.BIN',
                'downloadToken' => 'test',
            ]
        ]);
    }

    protected function tearDown(): void
    {
        \Yii::$app = null;
        parent::tearDown();
    }

    public function testLoadDbDuringInit()
    {
        $this->assertInstanceOf(Database::class, $this->ip2location->getDb());
    }

    public function testCorrectIp()
    {
        $info = $this->ip2location->ip('127.0.0.0');
        $this->assertArrayHasKey('ipNumber', $info);
        $this->assertArrayHasKey('ipVersion', $info);
        $this->assertArrayHasKey('ipAddress', $info);
        $this->assertArrayHasKey('countryName', $info);
        $this->assertArrayHasKey('countryCode', $info);
    }

    public function testWrongIp()
    {
        $info = $this->ip2location->ip('test');
        $this->assertFalse($info);
    }
}
