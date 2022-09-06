```php
    $client = new Client();
    $res    = $client->request('POST', 'https://analyst.123job.vn/analyst', [
        'form_params' => $this->getData(),
    ]);
    $data   = json_decode($res->getBody(), true);

    dd($data);
```

```php
    private function getData()
    {
        return [
            "position"      => "Nhân viên kế toán",
            "sub_position"  => "Tôi đang muốn tìm việc kế toán",
            "name"          => "Đình Hướng",
            "phone"         => "0979102110",
            "email"         => "namem@gmail.com",
            "attribute"     => [
                "rank"      => [
                    "name" => "Nhân viên"
                ],
                "exp"       => [
                    "name" => "1 Năm"
                ],
                "work_type" => [
                    "name" => "Part-time"
                ],
                "salary"    => [
                    "name" => "Thỏa thuận"
                ],
                "degree"    => [
                    "name" => "Đại học"
                ],
                "location"  => [
                    "raw" => "Bà Rịa Vũng Tàu"
                ],
                "gender"    => [
                    "name" => "Nam"
                ],
                "age"       => [
                    "name" => "20/07/1996"
                ],
                "career"    => [
                    "name" => "Xây dựng"
                ],
            ],
            "school"        => [
                [
                    "school" => "Đại Học Kinh Tế Đà Nẵng",
                    "cert"   => "",
                    "majors" => "Kinh Tế",
                    "code"   => ""
                ],
                [
                    "school" => "Đại Học Kinh Tế Đà Nẵng",
                    "cert"   => "",
                    "majors" => "Kinh Tế",
                    "code"   => ""
                ]
            ],
            "company"       => [
                [
                    "company"  => "Công Ty Cổ Phần Dệt May",
                    "position" => "Trợ lý"
                ],
                [
                    "company"  => "VNP Group",
                    "position" => "Trợ lý"
                ]
            ],
            "skill"         => [
                "Tiếng Anh",
                "Kỹ năng cứng",
                "Chuyên ngành",
                "Kỹ năng mềm",
                "Kiến thức",
                "Ngoại Ngữ"
            ],
            "intro_content" => "1 đoạn giới thiệeje, tin đăng việc làm",
        ];
    }
```

##Data send to reporter example
```PHP
$data = [
    "feed_hash"      => "pQkMxvzxLY",
    "name"           => "Phạm Ngọc Thạch",
    "phone"          => "0362687183",
    "email"          => "thachxdvt@gmail.com",
    "link"           => null,
    "avatar"         => null,
    "position"       => "cán bộ kỹ thuật công trường",
    "sub_position"   => "CÁN BỘ KỸ THUẬT CÔNG TRƯỜNG",
    "care"           => "Kỹ thuật môi trường, mô trường", // Ngành nghề quan tâm khác
    "location_id"    => 9,
    "location_text"  => "Bà Rịa Vũng Tàu",
    "address"        => "Địa chỉ 1, Bà Rịa Vũng Tàu",
    "address_work"   => null,
    "career_int"     => 79,
    "career_text"    => "Xây dựng",
    "rank_int"       => 1678,
    "rank_text"      => "Nhân viên",
    "gender_int"     => 0,
    "gender_text"    => null,
    "work_type_int"  => 0,
    "work_type_text" => null,
    "exp_int"        => 0,
    "exp_text"       => null,
    "degree_int"     => 1686,
    "degree_text"    => "Đại học",
    "birth_date"     => null,
    "age_int"        => 0,
    "age_text"       => null,
    "salary_int"     => 0,
    "salary_text"    => "Thỏa thuận",
    "school"         => [
        [
            "school" => "Đại Học Kinh Tế Đà Nẵng",
            "cert"   => "",
            "majors" => "Kinh Tế",
            "code"   => ""
        ],
        [
            "school" => "Đại Học Kinh Tế Đà Nẵng",
            "cert"   => "",
            "majors" => "Kinh Tế",
            "code"   => ""
        ]
    ],
    "company"        => [
        [
            "company"  => "Công Ty Cổ Phần Dệt May",
            "position" => "Trợ lý"
        ],
        [
            "company"  => "VNP Group",
            "position" => "Trợ lý"
        ]
    ],
    "skill"          => [
        "Tiếng Anh",
        "Kỹ năng cứng",
        "Chuyên ngành",
        "Kỹ năng mềm",
        "Kiến thức",
        "Ngoại Ngữ"
    ],
    "intro"          => "Kính chào nhà tuyển dụng, tôi là Phạm Ngọc Thạch đang mong muốn làm việc vị trí , tôi đã có kinh nghiệm làm việc. Tôi có tinh thần làm việc trách nhiệm cao. Tôi có thể nhận làm việc ngay. Nếu có thể tôi muốn làm việc tại Bà Rịa Vũng Tàu. Rất mong nhận được đề nghị làm việc. Tôi xin cảm ơn",
    "cv_path"        => "2020_03_01______af2f02430ce5f7ee80927955078ebe3d.doc",
    "cv_type"        => 2,
    "status"         => 1,
    "source_int"     => 0,
    "source_text"    => "apply",
    "meta_info"      => [

    ],
    "added_at"       => "2020-03-03 00:01:07",
    "timestamp"      => 1583168467, //Được chuyển từ added_at
];
```
