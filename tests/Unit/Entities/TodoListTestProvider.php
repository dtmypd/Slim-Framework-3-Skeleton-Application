<?php namespace Unit\Entities;

class TodoListTestProvider
{
    /**
     * @return array
     */
    public function provideEntityTestValues()
    {
        return [
            [
                'id'           => 1,
                'expectedId'   => 1,
                'name'         => 'name 1',
                'expectedName' => 'name 1',
            ],
            [
                'id'           => 2,
                'expectedId'   => 2,
                'name'         => 'name 2',
                'expectedName' => 'name 2',
            ],
            [
                'id'           => 3,
                'expectedId'   => 3,
                'name'         => 'name 3',
                'expectedName' => 'name 3',
            ]
        ];
    }
}