<?php
    return[
        [
            'label'=>'Tài khoản',
            'route'=>'admin.index',
            'icon'=>'fa-user-circle',
            'item'=>[
                [
                    'label'=>'Đăng xuất',
                    'route'=>'dangxuat'
                ],
                [
                    'label'=>'Thông tin cá nhân',
                    'route'=>'profile.index'
                ]
               
               
            ]
        ],

        [
            'label'=>'Home',
            'route'=>'admin.index',
            'icon'=>'fa-home'
        ],
        [
            'label'=>'Danh mục',
            'route'=>'danhmuc.index',
            'icon'=>'fa-clipboard'
        ],

        [
            'label'=>'Khách hàng',
            'route'=>'khachhang.index',
            'icon'=>'fa-users'
            

        ],

        [
            'label'=>'Danh mục con',
            'route'=>'admin.index',
            'icon'=>'fa-tags',
            'item'=>[
                [
                    'label'=>'Nhãn hiệu',
                    'route'=>'nhanhieu.index'
                ],
                [
                    'label'=>'Chất liệu',
                    'route'=>'chatlieu.index'
                ],
                [
                    'label'=>'Đặc tính',
                    'route'=>'dactinh.index'
                ],
                [
                    'label'=>'Phân loại',
                    'route'=>'phanloai.index'
                ],
                [
                    'label'=>'Khuyến mãi',
                    'route'=>'khuyenmai.index'
                ],
                [
                    'label'=>'Tình trạng',
                    'route'=>'tinhtrang.index'
                ]
               
            ]
        ],
        [
            'label'=>'Sản phẩm',
            'route'=>'sanpham.index',
            'icon'=>'fa-tshirt'

        ],
        [
            'label'=>'Chức vụ',
            'route'=>'chucvu.index',
            'icon'=>'fa-home'

        ],
        [
            'label'=>'Nhân viên',
            'route'=>'nhanvien.index',
            'icon'=>'fa-users-cog'

        ],
        [
            'label'=>'Đơn hàng',
            'route'=>'dathang.index',
            'icon'=>'fa-shopping-cart'

        ],
        [
            'label'=>'Thống kê đơn hàng',
            'route'=>'thongke.index',
            'icon'=>'fa-shopping-cart'

        ]
    



    ]


?>