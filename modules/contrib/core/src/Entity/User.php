<?php

namespace NextFramework\Core\Entity;

use NextFramework\Core\Extend\EntityExtend;

class User extends EntityExtend {
    private function schema() {
        return [
            'config' => [
                'table' => 'users'
            ],

            'fields' => [
                'id',
                'mail' => [
                    'type' => 'email',
                    'length' => 100,
                    'required' => true,
                    'unique' => true
                ],
                'password' => [
                    'type' => 'password',
                    'length' => 32,
                    'required' => true,
                    'encode' => true,
                    'readable' => false
                ],
                'roles' =>  [
                    'type' => 'string',
                    'length' => -1,
                    'multiple' => true
                ],
                'created' => [
                    'type' => 'datetime',
                    'update' => 'on create'
                ],
                'updated' => [
                    'type' => 'datetime',
                    'update' => 'on update'
                ]
            ]
        ];
    }
}