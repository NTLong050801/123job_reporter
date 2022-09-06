<?php
/**
 * Created by PhpStorm.
 * User: dinhhuong
 * Date: 4/9/21
 * Time: 2:25 PM
 */

namespace Workable\Candidate\Services\Statistic;


use Workable\Candidate\Enum\CandidateEnum;

class PushCandidateService
{
    private $params;
    private $data;

    /**
     * Set tham số
     * @param array $params
     * @return $this
     */
    public function setParam(array $params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Check tạo mới hay cập nhật dữ liệu
     */
    public function store()
    {
        $this->setData();
        $candidateId = $this->getCandidateId();
        if (empty($candidateId))
        {
            $this->save();
        }
        else
        {
            if (!$this->data['source_int'] == CandidateEnum::SOURCE_CV_MYJOB || !$this->data['source_int'] == CandidateEnum::SOURCE_CV_SPIDER){
                $this->update($candidateId);
            }

        }
    }

    /**
     * Tạo dữ liệu mới
     */
    private function save()
    {
        $data = array_merge($this->data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('candidates')->insert($data);
    }

    /**
     * Cập nhật dữ liệu cũ
     * @param int $id
     */
    private function update(int $id)
    {
        $data = array_merge($this->data, [
            'updated_at' => now(),
        ]);

        \DB::table('candidates')->where('id', $id)->update($data);
    }

    /**
     * Lấy id candidate theo 1 trong 3 lựa chọn
     * @return null
     */
    private function getCandidateId()
    {
        $phone = param_get($this->params, 'phone');
        $email = param_get($this->params, 'email');
        $link  = param_get($this->params, 'link');
        if ($phone)
        {
            $id = \DB::table('candidates')->where('phone', $phone)->value('id');
            if (empty($id)) goto email;

            return $id;
        }
        elseif ($email)
        {
            email:
            $id = \DB::table('candidates')->where('email', $email)->value('id');
            if (empty($id)) goto link;

            return $id;

        }
        elseif ($link)
        {
            link:
            $id = \DB::table('candidates')->where('link', $link)->value('id');
            if (empty($id)) return null;

            return $id;
        }

        return null;
    }

    /**
     * Set dữ liệu lưu
     */
    private function setData()
    {
        $data = [
            'name'           => param_get($this->params, 'name'),
            'phone'          => trim(param_get($this->params, 'phone')),
            'email'          => trim(param_get($this->params, 'email')),
            'link'           => trim(param_get($this->params, 'link')),
            'avatar'         => param_get($this->params, 'avatar'),
            'position'       => param_get($this->params, 'position'),
            'sub_position'   => param_get($this->params, 'sub_position'),
            'care'           => param_get($this->params, 'care'),
            'location_id'    => param_get($this->params, 'location_id'),
            'location_text'  => param_get($this->params, 'location_text'),
            'address'        => param_get($this->params, 'address'),
            'address_work'   => param_get($this->params, 'address_work'),
            'career_int'     => param_get($this->params, 'career_int'),
            'career_text'    => param_get($this->params, 'career_text'),
            'rank_int'       => param_get($this->params, 'rank_int'),
            'rank_text'      => param_get($this->params, 'rank_text'),
            'gender_int'     => param_get($this->params, 'gender_int'),
            'gender_text'    => param_get($this->params, 'gender_text'),
            'work_type_int'  => param_get($this->params, 'work_type_int'),
            'work_type_text' => param_get($this->params, 'work_type_text'),
            'exp_int'        => param_get($this->params, 'exp_int'),
            'exp_text'       => param_get($this->params, 'exp_text'),
            'degree_int'     => param_get($this->params, 'degree_int'),
            'degree_text'    => param_get($this->params, 'degree_text'),
            'birth_date'     => param_get($this->params, 'birth_date'),
            'age_int'        => param_get($this->params, 'age_int'),
            'age_text'       => param_get($this->params, 'age_text'),
            'salary_int'     => param_get($this->params, 'salary_int'),
            'salary_text'    => param_get($this->params, 'salary_text'),
            'company'        => param_get($this->params, 'company'),
            'school'         => param_get($this->params, 'school'),
            'skill'          => param_get($this->params, 'skill'),
            'intro'          => param_get($this->params, 'intro'),
            'content'        => param_get($this->params, 'content'),
            'cv_path'        => param_get($this->params, 'cv_path'),
            'cv_type'        => param_get($this->params, 'cv_type'),
            'status'         => param_get($this->params, 'status'),
            'source_int'         => param_get($this->params, 'source_int'),
            'meta_info'      => param_get($this->params, 'meta_info'),
            'meta_analyst'   => param_get($this->params, 'meta_analyst'),
            'added_at'       => param_get($this->params, 'added_at'),
            'timestamp'      => param_get($this->params, 'timestamp'),
        ];

        $this->data = array_filter($data);
        \Log::info($this->data);
    }
}

