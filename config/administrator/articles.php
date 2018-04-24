<?php

use App\Models\Article;

return [
    'title' => '文章',
    'single' => '文章',
    'model' => Article::class,

    'permission' => function () {
        return Auth::user()->can('manage_contents');
    },

    'action_permissions' => [
        'create' => function () {
            return false;
        }
    ],

    'columns' => [
        'id',
        'title' => [
            'title' => '标题',
            'sortable' => false,
            'output' => function ($value, $model) {
                return make_link($model);
            }
        ],
        'user' => [
            'title' => '作者',
            'sortable' => false,
            'output' => function ($value, $model) {
                $url = config('app.url') . '/users/' . $model->user->id;
                return '<a href="' . $url . '">' . $model->user->name . '</a>';
            }
        ],
        'category' => [
            'title' => '分类',
            'sortable' => false,
            'output' => function ($value, $model) {
                return $model->category->name;
            }
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false
        ]
    ],

    'edit_fields' => [
        'title' => [
            'title' => '标题'
        ],
        'user' => [
            'title' => '作者',
            'type' => 'relationship',
            'name_field' => 'name'
        ],
        'category' => [
            'title' => '分类',
            'type' => 'relationship',
            'name_field' => 'name'
        ]
    ],

    'filters' => [
        'title' => [
            'title' => '标题',
        ],
        'user' => [
            'title' => '作者',
            'type' => 'relationship',
            'name_field' => 'name'
        ],
        'category' => [
            'title' => '分类',
            'type' => 'relationship',
            'name_field' => 'name'
        ]
    ],

    'rules' => [
        'title' => 'required|min:1',
//        'user_id' => 'required',
        'category_id' => 'required'
    ],

    'messages' => [
        'title.required' => '请输入标题',
        'title.min' => '标题最少一个字',
//        'user_id.required' => '请选择作者',
        'category_id.required' => '请选择分类'
    ]
];