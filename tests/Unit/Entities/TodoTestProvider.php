<?php namespace Unit\Entities;

class TodoTestProvider
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
                'userId'           => 11,
                'expectedUserId'   => 11,
            ],
            [
                'id'           => 2,
                'expectedId'   => 2,
                'name'         => 'name 2',
                'expectedName' => 'name 2',
                'userId'           => 22,
                'expectedUserId'   => 22,
            ],
            [
                'id'           => 3,
                'expectedId'   => 3,
                'name'         => 'name 3',
                'expectedName' => 'name 3',
                'userId'           => 33,
                'expectedUserId'   => 33,
            ],
            [
                'id'           => null,
                'expectedId'   => null,
                'name'         => 'name 3',
                'expectedName' => 'name 3',
                'userId'           => 33,
                'expectedUserId'   => 33,
            ]
        ];
    }
}
