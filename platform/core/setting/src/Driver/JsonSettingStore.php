<?php


namespace Workable\Setting\Driver;


use Illuminate\Filesystem\Filesystem;
use Workable\Setting\Supports\SettingStore;

class JsonSettingStore extends SettingStore
{
    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @var null
     */
    protected $path = null;


    public function __construct(Filesystem $files, $path = null)
    {
        $this->files = $files;
        $this->setPath($path ?: base_path() . '/settings.json');
    }

    public function setPath($path)
    {
        if (!$this->files->exists($path)) {
            $result = $this->files->put($path, '{}');

            if ($result === false) {
//                info('Could not write to ' . $path);
            }
        }

        if (!$this->files->isWritable($path)) {
//            info($path . ' is not writable. ');
        }

        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    protected function read()
    {
        $contens = $this->files->get($this->path);
        $data = json_decode($contens, true);

        if ($data === null) {
//            info('Invalid JSON in ' . $this->path);
            return [];
        }


        return $data;
    }

    protected function write(array $data)
    {
        if ($data) {
            $contents = json_encode($data);
        } else {
            $contents = '{}';
        }

        $this->files->put($this->path, $contents);
    }
}
