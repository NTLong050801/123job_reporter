<?php

namespace Workable\Candidate\Database\Seeders;

use Faker\Factory;
use Illuminate\Support\Facades\Schema;
use Modules\Company\Database\Seeders\PermissionTableSeeder;
use Workable\Candidate\Models\Candidate;

class ReportResumeTableSeeder extends PermissionTableSeeder
{
    const AGE    = [
        "1" => "18 - 20 tuổi",
        "2" => "20 - 25 tuổi",
        "3" => "25 - 30 tuổi",
        "4" => "30 - 35 tuổi",
        "5" => "Trên 35 tuổi"
    ];
    const SALARY = [
        "1" => "Dưới 3 triệu",
        "2" => "3 - 5 triệu",
        "3" => "7 - 10 triệu",
        "4" => "10 - 15 triệu",
        "5" => "15 - 18 triệu",
        "6" => "20 - 25 triệu",
        "7" => "25 - 30 triệu",
        "8" => "trên 30 triệu",
    ];
    const SKILL  = [
        'Giao tiếp thông qua nói và viết',
        'Làm việc theo nhóm',
        'Tiếp thu phản hồi',
        'Tư duy sáng tạo',
        'Đáp ứng các thời hạn',
        'Giải quyết vấn đề',
        'Nói trước công chúng',
        'Quản lý thời gian',
        'Quản lý nhóm',
        'Hướng dẫn',
        'Viết báo cáo và đề xuất',
        'Photoshop',
        'Dựng mẫu 3D',
        'Trình bày in',
        'Typography',
        'Maya',
        'C++', 'Python',
        'Vận hành hệ thống',
        'Linux', 'Mac OS X', 'Windows 8', 'Ubuntu',
        'Phân tích dữ liệu',
        'Phát triển các ứng dụng iOS',
        'Khắc phục sự cố',
        'Phát triển Android',
        'Cải tiến quy trình',
        'Soạn thảo văn bản kỹ thuật',
        'Quảng cáo trên Facebook',
        'Video tiếp thị',
        'Liên kết xây dựng',
        'Phân tích trên Google',
        'Viết quảng cáo',
        'Tối ưu hóa công cụ tìm kiếm (SEO)',
        'Quảng cáo thông qua người ảnh hưởng',
        'Kế toán',
        'Sổ sách kế toán',
        'Quản lý dự án',
        'MS Excel',
        'Viết tắt',
        'SQL',
        'Nguồn nhân lực',
        'Quản lý nhân tài',
        'Tuyển dụng kỹ thuật',
    ];

    public function run()
    {
        $this->fakeCandidate();
        //        $this->fakeCvReport();
        //        $this->fakeCareerReport();
        //        $this->fakeRankReport();
        //        $this->fakeDegreeReport();
    }

    private function fakeCandidate()
    {
        Schema::disableForeignKeyConstraints();
        Candidate::truncate();
        Schema::enableForeignKeyConstraints();

        $faker = Factory::create('vi_VN');
        $limit = 2000;

        for ($i = 0; $i < $limit; $i++)
        {
            Candidate::create([
                'name'           => $faker->name,
                'phone'          => str_replace('+', '', $faker->unique()->e164PhoneNumber),
                'email'          => $faker->randomElement([null, $faker->unique()->safeEmail]),
                'link'           => $faker->randomElement([null, $faker->url]),
                'avatar'         => null,
                'position'       => $faker->randomElement(['Kế toán văn phòng', 'Nhân viên kinh doanh', 'Thợ sửa ống nước', 'Nhân viên bán bảo hiểm', 'Nhân viên lập trình']),
                'sub_position'   => $faker->randomElement(['Kế toán văn phòng', 'Nhân viên kinh doanh', 'Thợ sửa ống nước', 'Nhân viên bán bảo hiểm', 'Nhân viên lập trình']),
                'care'           => $faker->randomElement(['Kế toán văn phòng', 'Nhân viên kinh doanh', 'Thợ sửa ống nước', 'Nhân viên bán bảo hiểm', 'Nhân viên lập trình']),
                'location_id'    => $id = $faker->numberBetween(1, 63),
                'location_text'  => $city = $this->getLocation($id),
                'address'        => $faker->address . ' - ' . $city,
                'address_work'   => $faker->address . ' - ' . $city,
                'career_int'     => $id = $faker->numberBetween(1, 84),
                'career_text'    => $career = $this->getCareer($id),
                'rank_int'       => $id = $faker->randomElement([1677, 1678, 1679, 1680, 1681, 1682, 1683]), //type = 5
                'rank_text'      => $this->getAttribute($id),
                'gender_int'     => $id = $faker->numberBetween(0, 2),
                'gender_text'    => $this->getGender($id),
                'work_type_int'  => $id = $faker->randomElement([1668, 1669, 1670, 1671, 1672, 1673, 1674, 1675, 1676]), //type = 4
                'work_type_text' => $this->getAttribute($id),
                'exp_int'        => $id = $faker->randomElement([1928, 1929, 1930, 1931, 1932, 1933, 1934, 1935]), //type = 7
                'exp_text'       => $this->getAttribute($id),
                'degree_int'     => $id = $faker->randomElement([1684, 1685, 1686, 1687, 1688, 1689, 1690]), //type = 6
                'degree_text'    => $this->getAttribute($id),
                'birth_date'     => date('Y-m-d', strtotime($faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now')->getTimestamp())),
                'age_int'        => $id = $faker->numberBetween(1, 5),
                'age_text'       => self::AGE[$id],
                'salary_int'     => $id = $faker->numberBetween(1, 8),
                'salary_text'    => self::SALARY[$id],
                'company'        => null,
                'school'         => null,
                'skill'          => json_encode($faker->randomElements(self::SKILL, $faker->numberBetween(1, 4))),
                'intro'          => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content'        => $faker->paragraph($nbSentences = 6, $variableNbSentences = true),
                'cv_path'        => $cv = $faker->randomElement([null, '2021_02_21______d375dbc27ae76a53840f5e3db1837105.pdf']),
                'cv_type'        => $cv ? 2 : 0,
                'status'         => 1,
                'source'         => $faker->numberBetween(1, 3),
                'meta_info'      => null,
                'meta_analyst'   => null,
                'added_at'       => $date = $faker->dateTimeThisYear($max = 'now'),
                'timestamp'      => $date->getTimestamp(),
            ]);
        }
    }

    private function getLocation(int $id)
    {
        return \DB::table('locations')->where('id', $id)->value('loc_name');
    }

    private function getCareer(int $id)
    {
        return \DB::table('careers')->where('id', $id)->value('ca_name');
    }

    private function getAttribute(int $id)
    {
        return \DB::table('job_attributes')->where('id', $id)->value('ja_name');
    }

    private function getGender(int $id)
    {
        $data = [
            0 => 'Không xác định',
            1 => 'Nam',
            2 => 'Nữ'
        ];

        return $data[$id];
    }
}
