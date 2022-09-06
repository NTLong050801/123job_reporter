<?php

namespace Workable\Organization\Services;

use Workable\Base\Supports\CliEcho;
use Workable\FileUploader\Core\Exceptions\UploadFileException;
use Workable\Media\Repository\Media\MediaRepositoryInterface;
use Workable\Organization\Repository\Announcement\AnnouncementRepositoryInterface;

class AnnouncementService
{
    protected $announcementRepository;
    protected $mediaRepository;

    public function __construct(AnnouncementRepositoryInterface $announcementRepository,
                                MediaRepositoryInterface $mediaRepository)
    {
        $this->announcementRepository = $announcementRepository;
        $this->mediaRepository = $mediaRepository;
    }

    public function list($filter = [])
    {
        return $this->announcementRepository->list($filter);
    }

    public function newList()
    {
        return $this->announcementRepository->newList();
    }

    public function findById($id)
    {
        return $this->announcementRepository->findById($id);
    }

    public function update($id, $data = [])
    {
        if (isset($data['files'])) {
            $data['files'] = $this->uploadFiles($data['files']);
        }
        $data['updated_at'] = now();
        return $this->announcementRepository->update($id, $data);
    }

    public function insert($data = [])
    {
        if (isset($data['files'])) {
            $data['files'] = $this->uploadFiles($data['files']);
        }
        $data['created_at'] = now();
        $data['updated_at'] = now();
        return $this->announcementRepository->insert($data);
    }

    public function uploadFiles($dataFileUpload)
    {
        try {
            $config  = config('packages.file-uploader.upload_file.pdf_and_doc');
            $results = app("uploader")->setConfig($config)->uploadMulti('files');
            $dataMediaId = [];
            foreach ($results as $key => $media) {
                $data['md_name'] = $media->getFiles();
                $data['md_origin_name'] = $dataFileUpload[$key]->getClientOriginalName();
                $data['md_extension'] = $dataFileUpload[$key]->getClientOriginalExtension();
                $data['md_size'] = $media->getSizeUpload();
                $data['md_object_name'] = 'Announcement';
                $data['md_source'] = 1; //Upload từ 1 object khác
                $data['admin_id'] = get_data_user('admins', 'id');
                $data['created_at'] = now();
                $data['updated_at'] = now();
                $dataMediaId[] = $this->mediaRepository->insertGetId($data);
            }
            return json_encode($dataMediaId);
        }
        catch (UploadFileException $e)
        {
            CliEcho::errornl($e->info());
            $results = null;
        }
    }
}
