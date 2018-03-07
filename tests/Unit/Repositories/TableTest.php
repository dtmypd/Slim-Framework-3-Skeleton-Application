<?php

use ExtendedSlim\Tests\AbstractTest;
use App\Repositories\AbstractTable;

class TestTable extends AbstractTable
{
    const TABLE_NAME = 'test_table';

    const FIELD_ID      = 'id';
    const FIELD_NAME    = 'name';
    const FIELD_USER = 'user';

    const ENTITY_FIELDS = [
        self::FIELD_ID,
        self::FIELD_NAME,
        self::FIELD_USER,
    ];
}

class TableTest extends AbstractTest
{
    /**
     * @test
     */
    public function getAliasedTableColumnNames_AbstractTable_perfect()
    {
        $expectedResult = [
            'aliased_table.id',
            'aliased_table.name',
            'aliased_table.user',
        ];

        $result = TestTable::getAliasedTableColumnNames('aliased_table');

        $this->assertEquals($expectedResult, $result, 'getaliasedTableNameColumn function returns incorrect values');
    }
}
