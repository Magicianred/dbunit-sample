<?php

namespace peter;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

class MyDbTest extends TestCase
{
    use TestCaseTrait;

    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        $pdo = new \PDO('sqlite::memory:');
        $pdo->exec(
            "CREATE TABLE IF NOT EXISTS guestbook (
                id INTEGER PRIMARY KEY, 
                content TEXT, 
                user TEXT, 
                created INTEGER)"
        );
        return $this->createDefaultDBConnection($pdo, ':memory:');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__).'/_files/guestbook-seed.xml');
    }

    public function testRowCount()
    {
        $this->assertEquals(0, $this->getConnection()->getRowCount('guestbook'), "Pre-Condition");
    }
}
