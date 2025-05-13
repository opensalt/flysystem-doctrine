<?php

namespace WGG\Flysystem\Doctrine\Tests;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use League\Flysystem\AdapterTestUtilities\FilesystemAdapterTestCase;
use League\Flysystem\FilesystemAdapter;
use WGG\Flysystem\Doctrine\DoctrineDBALAdapter;

use function dirname;

/**
 * @covers \WGG\Flysystem\Doctrine\DoctrineDBALAdapter
 */
class DoctrineDBALAdapterWithPrefixTest extends FilesystemAdapterTestCase
{
    protected static function createFilesystemAdapter(): FilesystemAdapter
    {
        $dsnParser = new DsnParser();
        $connection = DriverManager::getConnection(
            $dsnParser->parse('pdo-sqlite:///:memory:')
        );

        $connection->executeStatement((string) file_get_contents(dirname(__DIR__).'/schema/sqlite.sql'));
        $connection->executeStatement('DELETE FROM flysystem_files;');

        return new DoctrineDBALAdapter(connection: $connection, prefix: 'prefix_test');
    }
}
