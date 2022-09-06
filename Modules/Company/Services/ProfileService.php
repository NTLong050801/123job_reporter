<?php

namespace Modules\Company\Services;

use Illuminate\Support\Facades\Hash;
use Modules\Company\Repository\Profile\ProfileRepositoryInterface;
use Workable\Base\Supports\CliEcho;
use Workable\FileUploader\Core\Exceptions\UploadFileException;
use function bcrypt;

class ProfileService
{
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function updatePassword($id, $data = [])
    {
        $data['password'] = bcrypt($data['password']);
        return $this->profileRepository->update($id, $data);
    }

    public function updateInfo($id, $data = [])
    {
        return $this->profileRepository->update($id, $data);
    }

    public function uploadAvatar($id)
    {
        try {
            $config  = config('packages.file-uploader.upload_image.avatar');
            $results = app("image-uploader")->setConfig($config)->upload('avatar');
            return $this->profileRepository->update($id, [
                'avatar' => $results->toArray()['file_name']
            ]);
        }
        catch (UploadFileException $e)
        {
            CliEcho::errornl($e->info());
            $results = null;
        }
        return $results;
    }
}
