<?php

use App\Models\Banner;

return [
    'title' => '轮播图',
    'single' => '轮播图',
    'model' => Banner::class,

    'permission' => function () {
        return Auth::user()->can('manage_contents');
    },

    'columns' => [
        'id',
        'image' => [
            'title' => '图片',
            'output' => function ($image, $model){
                return empty($image) ? 'N/A' : '<img src="' . $image . '" width="100">';
            },
            'sortable' => false
        ],
        'article' => [
            'title' => '文章标题',
            'output' => function ($value, $model) {
                return make_link($model->article);
            }
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false
        ]
    ],

    'edit_fields' => [
        'image' => [
            'type' => 'image',
            'title' => '图片',
            'location' => public_path() . "/uploads/images/banners/"
        ],
        'article' => [
            'title' => '文章',
            'type' => 'relationship',
            'name_field' => 'title',
        ]
    ],
    'filters' => [
        'article' => [
            'title' => '文章标题',
            'type' => 'relationship',
            'name_field' => 'title'
        ]
    ],

    'rules' => [
        'image' => 'required',
        'article_id' => 'required'
    ],
    'messages' => [
        'image.required' => '未选择图片',
        'article_id.required' => '未选择关联文章'
    ]
];