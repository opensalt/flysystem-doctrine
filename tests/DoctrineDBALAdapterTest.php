<?php

namespace WGG\Flysystem\Doctrine\Tests;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use League\Flysystem\AdapterTestUtilities\FilesystemAdapterTestCase;
use League\Flysystem\FilesystemAdapter;
use WGG\Flysystem\Doctrine\DoctrineDBALAdapter;

use function dirname;
use function file_get_contents;

/**
 * @covers \WGG\Flysystem\Doctrine\DoctrineDBALAdapter
 */
class DoctrineDBALAdapterTest extends FilesystemAdapterTestCase
{
    protected static function createFilesystemAdapter(): FilesystemAdapter
    {
        $dsnParser = new DsnParser();
        $connection = DriverManager::getConnection(
            $dsnParser->parse('pdo-sqlite:///:memory:')
        );

        $connection->executeStatement((string) file_get_contents(dirname(__DIR__).'/schema/sqlite.sql'));

        return new DoctrineDBALAdapter($connection);
    }
}
