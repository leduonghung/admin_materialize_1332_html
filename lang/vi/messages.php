<?php
return [
    'canonical' =>'Đường dẫn',
    'meta_title' =>'Tiêu đề Seo',
    'meta_keyword' =>'Từ khóa Seo',
    'meta_description' =>'Mô tả Seo',
    'publish' =>'Kích hoạt',
    'image' =>'Ảnh đại diện',
    'album' =>'Album ảnh',
    'content' =>'Nội dung',
    'order' =>'Sắp xếp',
    'action' =>'Thao tác',
    'created_at' =>'Ngày tạo',
    'updated_at' =>'Ngày sửa',
    'userCreated' =>'Người tạo',
    'userUpdated' =>'Người sửa',
    'generalTitle'=>'Thông tin chung',
    'configSeo'=>'Cấu hình SEO ',
    'languages' =>'Ngôn ngữ',
    
    'role'=>[
        'index'=>'Danh sách vai trò',
        'create'=>'Thêm mới vai trò',
        'edit'=>'Chỉnh sửa vai trò',
        'store'=>'Lưu trữ vai trò',
        'name' => 'Tên vai trò',
        'display_name' => 'Mô tả vai trò',
    ],
    'user'=>[
        'index'=>'Danh sách thành viên',
        'create'=>'Thêm mới thành viên',
        'edit'=>'Chỉnh sửa thành viên',
        'name' => 'Tên',
        'phone' => 'Số điện thoại',
        'province_id' => 'Tỉnh/Thành phố',
        'district_id' => 'Quận/Huyện',
        'ward_id' => 'Phường/xã',
        'address' => 'Địa chỉ',
        'birthday' => 'Ngày sinh',
        'email' => 'Email',
        'role' => 'Vai trò',
        'content' => 'Ghi chú',
        'password' => 'Mật khẩu',
        're_password' => 'Nhập lại mật khẩu',
    ],
    'domain'=>[
        'index'=>'Quản lý tên miền',
        'create'=>'Thêm mới tên miền',
        'edit'=>'Chỉnh sửa tên miền',
        'fields' => [
            'name' =>'Tên tên miền',
            'content' =>'Ghi chú',
            'language_id' =>'Ngôn ngữ',
            'registration_date' =>'ngày đăng ký',
            'expiration_date' =>'ngày hết hạn',
            'status' =>'Kiểm tra',
            'place_registration' =>'nơi đăng ký',
            'publish' =>'Trạng thái',
            'order' =>'Sắp xếp',
            'destination' =>'Địa điểm đến',
            'year_of_extended' =>'Năm gia hạn',
            'domain_extension_id' =>'Đuôi tên miền',
        ],
        'status' => [
            0 =>'Chưa kiểm tra',
            1=>'Chưa đăng ký',
            2 =>'Không k.tra được',
            3 =>'Đã đăng ký (1)',
            4 =>'Đã đăng ký (2)',
        ],
        'publish' => [
            0 =>'Quan tâm',
            1=>'--',
        ]
    ],
    'language'=>[
        'index'=>[
            'title'=>'Quản lý ngôn ngữ',
            'tableHeading'=>'Danh sách ngôn ngữ'
        ],
        'create'=>'Thêm mới ngôn ngữ',
        'edit'=>'Chỉnh sửa ngôn ngữ',
        'fields' => [
            'name' => 'Tên',
            'flag' => 'Quốc gia',
            'publish' => 'Kích hoạt',
        ],
        'flags' => [
            'af' =>'Afghanistan',
            'al' =>'Albania',
            'dz' =>'Algeria',
            'ad' =>'Andorra',
            'ao' =>'Angola',
            'ag' =>'Antigua and Barbuda',
            'ar' =>'Argentina',
            'am' =>'Armenia',
            'au' =>'Australia',
            'at' =>'Austria',
            'az' =>'Azerbaijan',
            'bs' =>'Bahamas',
            'bh' =>'Bahrain',
            'bd' =>'Bangladesh',
            'bb' =>'Barbados',
            'by' =>'Belarus',
            'be' =>'Belgium',
            'bz' =>'Belize',
            'bj' =>'Benin',
            'bt' =>'Bhutan',
            'bo' =>'Bolivia',
            'ba' =>'Bosnia and Herzegovina',
            'bw' =>'Botswana',
            'br' =>'Brazil',
            'bn' =>'Brunei',
            'bg' =>'Bulgaria',
            'bf' =>'Burkina Faso',
            'bi' =>'Burundi',
            'cv' =>'Cabo Verde',
            'kh' =>'Cambodia',
            'cm' =>'Cameroon',
            'ca' =>'Canada',
            'cf' =>'Central African Republic',
            'td' =>'Chad',
            'cl' =>'Chile',
            'cn' =>'China',
            'co' =>'Colombia',
            'km' =>'Comoros',
            'cg' =>'Congo',
            'cr' =>'Costa Rica',
            'ci' =>'Côte d’Ivoire',
            'hr' =>'Croatia',
            'cu' =>'Cuba',
            'cy' =>'Cyprus',
            'cz' =>'Czechia',
            'dk' =>'Denmark',
            'dj' =>'Djibouti',
            'dm' =>'Dominica',
            'do' =>'Dominican Republic',
            'cd' =>'DR Congo',
            'ec' =>'Ecuador',
            'eg' =>'Egypt',
            'sv' =>'El Salvador',
            'gq' =>'Equatorial Guinea',
            'er' =>'Eritrea',
            'ee' =>'Estonia',
            'sz' =>'Eswatini',
            'et' =>'Ethiopia',
            'fj' =>'Fiji',
            'fi' =>'Finland',
            'fr' =>'France',
            'ga' =>'Gabon',
            'gm' =>'Gambia',
            'ge' =>'Georgia',
            'de' =>'Germany',
            'gh' =>'Ghana',
            'gr' =>'Greece',
            'gd' =>'Grenada',
            'gt' =>'Guatemala',
            'gn' =>'Guinea',
            'gw' =>'Guinea-Bissau',
            'gy' =>'Guyana',
            'ht' =>'Haiti',
            'va' =>'Holy See',
            'hn' =>'Honduras',
            'hu' =>'Hungary',
            'is' =>'Iceland',
            'in' =>'India',
            'id' =>'Indonesia',
            'ir' =>'Iran',
            'iq' =>'Iraq',
            'ie' =>'Ireland',
            'il' =>'Israel',
            'it' =>'Italy',
            'jm' =>'Jamaica',
            'jp' =>'Japan',
            'jo' =>'Jordan',
            'kz' =>'Kazakhstan',
            'ke' =>'Kenya',
            'ki' =>'Kiribati',
            'kw' =>'Kuwait',
            'kg' =>'Kyrgyzstan',
            'la' =>'Laos',
            'lv' =>'Latvia',
            'lb' =>'Lebanon',
            'ls' =>'Lesotho',
            'lr' =>'Liberia',
            'ly' =>'Libya',
            'li' =>'Liechtenstein',
            'lt' =>'Lithuania',
            'lu' =>'Luxembourg',
            'mg' =>'Madagascar',
            'mw' =>'Malawi',
            'my' =>'Malaysia',
            'mv' =>'Maldives',
            'ml' =>'Mali',
            'mt' =>'Malta',
            'mh' =>'Marshall Islands',
            'mr' =>'Mauritania',
            'mu' =>'Mauritius',
            'mx' =>'Mexico',
            'fm' =>'Micronesia',
            'md' =>'Moldova',
            'mc' =>'Monaco',
            'mn' =>'Mongolia',
            'me' =>'Montenegro',
            'ma' =>'Morocco',
            'mz' =>'Mozambique',
            'mm' =>'Myanmar',
            'na' =>'Namibia',
            'nr' =>'Nauru',
            'np' =>'Nepal',
            'nl' =>'Netherlands',
            'nz' =>'New Zealand',
            'ni' =>'Nicaragua',
            'ne' =>'Niger',
            'ng' =>'Nigeria',
            'kp' =>'North Korea',
            'mk' =>'North Macedonia',
            'no' =>'Norway',
            'om' =>'Oman',
            'pk' =>'Pakistan',
            'pw' =>'Palau',
            'pa' =>'Panama',
            'pg' =>'Papua New Guinea',
            'py' =>'Paraguay',
            'pe' =>'Peru',
            'ph' =>'Philippines',
            'pl' =>'Poland',
            'pt' =>'Portugal',
            'qa' =>'Qatar',
            'ro' =>'Romania',
            'ru' =>'Russia',
            'rw' =>'Rwanda',
            'kn' =>'Saint Kitts & Nevis',
            'lc' =>'Saint Lucia',
            'ws' =>'Samoa',
            'sm' =>'San Marino',
            'st' =>'Sao Tome & Principe',
            'sa' =>'Saudi Arabia',
            'sn' =>'Senegal',
            'rs' =>'Serbia',
            'sc' =>'Seychelles',
            'sl' =>'Sierra Leone',
            'sg' =>'Singapore',
            'sk' =>'Slovakia',
            'si' =>'Slovenia',
            'sb' =>'Solomon Islands',
            'so' =>'Somalia',
            'za' =>'South Africa',
            'kr' =>'South Korea',
            'ss' =>'South Sudan',
            'es' =>'Spain',
            'lk' =>'Sri Lanka',
            'vc' =>'St. Vincent & Grenadines',
            'ps' =>'State of Palestine',
            'sd' =>'Sudan',
            'sr' =>'Suriname',
            'se' =>'Sweden',
            'ch' =>'Switzerland',
            'sy' =>'Syria',
            'tj' =>'Tajikistan',
            'tz' =>'Tanzania',
            'th' =>'Thailand',
            'tl' =>'Timor-Leste',
            'tg' =>'Togo',
            'to' =>'Tonga',
            'tt' =>'Trinidad and Tobago',
            'tn' =>'Tunisia',
            'tr' =>'Turkey',
            'tm' =>'Turkmenistan',
            'tv' =>'Tuvalu',
            'ug' =>'Uganda',
            'ua' =>'Ukraine',
            'ae' =>'United Arab Emirates',
            'gb' =>'United Kingdom',
            'us' =>'United States',
            'uy' =>'Uruguay',
            'uz' =>'Uzbekistan',
            'vu' =>'Vanuatu',
            've' =>'Venezuela',
            'vn' =>'Vietnam',
            'ye' =>'Yemen',
            'zm' =>'Zambia',
            'zw' =>'Zimbabwe',
        ],
    ],

    'domain_extension'=>[
        'index'=>'Đuôi mở rộng',
        'create'=>'Thêm mới đuôi mở rộng',
        'edit'=>'Chỉnh sửa đuôi mở rộng',
        'fields' => [
            'name' =>'Tên đuôi mở rộng',
            'description' =>'Ghi chú',
            'publish' =>'Trạng thái',
            'order' =>'Sắp xếp',
        ]
    ],
    
];