<?php
return [
    
    
    
    [
        'name' => ['domain'],
        'title' => 'Quản lý '.__('messages.domain.index'),
        'icon'=>'ri-apps-2-add-line text-info',
        'route'=>'admin.domain',
        // 'subModule'=>[
        //     [ri-basketball-fill ri-22px text-info me-4
        //         'title'=>'Quản lý '.__('messages.domain.index'),
        //         'route'=>'admin.domain'
        //     ],
        // ]
    ],
    [
        'name' =>['domain_extension'],
        'title'=>__('messages.domain_extension.index'),
        'icon'=>'ri-more-line',
        'route'=>'admin.domain.extension',
        
    ],
    [
        'name' => ['user'],
        'title' => 'Quản lý thành viên',
        'icon'=>'ri-admin-fill text-success',
        'route'=>'admin.user'
        // 'subModule'=>[
        //     [
        //         'title'=>'Quản lý thành viên',
        //         'route'=>'admin.user'
        //     ],
        //     [
        //         'title'=>'Thêm mới thành viên',
        //         'route'=>'admin.user.create'
        //     ],
        // ]
    ],
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
