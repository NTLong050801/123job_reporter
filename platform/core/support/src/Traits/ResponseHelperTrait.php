<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 6/2/19
 * Time: 18:14
 */

namespace Workable\Support\Traits;


trait ResponseHelperTrait
{
    protected $metaResponse;

    public function setMeta($meta)
    {
        $this->metaResponse = $meta;

        return $this;
    }

    protected function mergeMeta($data)
    {
        if ($this->metaResponse)
        {
            $data['meta'] = $this->metaResponse;
        }
        return $data;
    }

    /**
     * Trả về kết quả fail
     * @param string $message
     * @param string $type
     * @return array
     */
    protected function respondError($message = 'error', $data = [], $type= 'error')
    {
        $dataArr = [
            'code'    => -1,
            'message' => $message,
            'type'    => $type,
            'data'    => $data
        ];
        $dataArr = $this->mergeMeta($dataArr);
        return response($dataArr);
    }

    /**
     * Trả về kết quả thành công: select, delete
     * @param string $message
     * @param array  $data
     * @param string $type
     * @return array
     */
    protected function respondSuccess($message = 'success', $data = [], $type='success')
    {
        $dataArr = [
            'code'    => 1,
            'message' => $message,
            'type'    => $type,
            'data'    => $data
        ];
        $dataArr = $this->mergeMeta($dataArr);
        return response($dataArr);
    }

    /**
     * Tạo thành công
     */
    protected function respondCreateSuccess($message = 'success', $data = [], $type='success')
    {
        $dataArr = [
            'code'    => 1,
            'message' => $message,
            'type'    => $type,
            'data'    => $data
        ];
        $dataArr = $this->mergeMeta($dataArr);
        return response($dataArr);
    }

    /**
     * Tạo thất bại
     */
    protected function respondCreateFail($message = 'error', $data = '', $type= 'error')
    {
        $dataArr = [
            'code'    => -1,
            'message' => $message,
            'type'    => $type,
            'data'    => $data
        ];
        $dataArr = $this->mergeMeta($dataArr);
        return response($dataArr);
    }

    /**
     * Update thành công
     */
    protected function respondUpdateSuccess($message = 'success', $type= 'success')
    {
        $dataArr = [
            'code'    => 1,
            'message' => $message,
            'type'    => $type
        ];
        $dataArr = $this->mergeMeta($dataArr);
        return response($dataArr);
    }

    /**
     * Update thất bại
     */
    protected function respondUpdateFail($message = 'error', $type= 'error')
    {
        $dataArr = [
            'code'    => -1,
            'message' => $message,
            'type'    => $type
        ];
        $dataArr = $this->mergeMeta($dataArr);
        return response($dataArr);
    }
}