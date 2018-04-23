<?php

use App\Models\Category;

return [
    'title' => '分类',
    'single' => '分类',
    'model' => Category::class,

    'permission' => function () {
        return Auth::user()->can('manage_contents');
    },

    'columns' => [
        'id',
        'name' => [
            'title' => '名称',
            'sortable' => false
        ],
        'operations' => [
            'title' => '管理',
            'sortable' => false
        ]
    ],

    'edit_fields' => [
        'name' => [
            'title' => '名称',
        ]
    ],
    'filters' => [
        'id',
        'name' => [
            'title' => '名称'
        ]
    ],
    'rules' => [
        'name' => 'required|min:1|unique:categories'
    ],
    'messages' => [
        'name.required' => '请确保分类名字数在一个字以上',
        'name.unique' => '分类名有重复'
    ]
];