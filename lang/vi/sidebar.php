<?php
return [
    
    [
        'name' => ['user'],
        'title' => 'Quản lý thành viên',
        'icon'=>'icon-people',
        'subModule'=>[
            [
                'title'=>'Quản lý thành viên',
                'route'=>'admin.user'
            ],
            [
                'title'=>'Thêm mới thành viên',
                'route'=>'admin.user.create'
            ],
            /* [
                'title'=>'Danh sách Quyen',
                'route'=>'admin.permission.create'
            ], */
        ]
    ],
    
    [
        'name' => ['domain'],
        'title' => 'Quản lý '.__('messages.domain.index'),
        'icon'=>'icon-people',
        'route'=>'admin.domain',
        'subModule'=>[
            [
                'title'=>'Quản lý '.__('messages.domain.index'),
                'route'=>'admin.domain'
            ],
            /* [
                'title'=>'Danh sách Quyen',
                'route'=>'admin.permission.create'
            ], */
        ]
    ],
    // [
    //     'name' =>['domain_extension'],
    //     'title'=>__('messages.domain_extension.index'),
    //     'icon'=>'icon-settings',
    //     'route'=>'admin.domain.extension',
        
    // ],
    // [
    //     'name' =>['system','language'],
    //     'title'=>'Cấu hình chung',
    //     'icon'=>'icon-settings',
    //     'subModule'=>[
    //         [
    //             'title'=>'QL ngôn ngữ',
    //             'route'=>'admin.language'
    //         ],
    //         [
    //             'title'=>'Cấu hình hệ thống',
    //             'route'=>'admin.system'
    //         ],
    //     ]
    // ],
];
