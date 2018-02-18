<?php namespace App\Repositories;

abstract class AbstractTable
{
    const ENTITY_FIELDS = [];

    /**
     * Returns the field names with the aliased table name prepended to them
     * @param string $alias
     *
     * @return array
     */
    public static function getAliasedTableColumnNames(string $alias) : array
    {
        return array_map(function($value) use ($alias) {return $alias . "." . $value;}, static::ENTITY_FIELDS);
    }
}
