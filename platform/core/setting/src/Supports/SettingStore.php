<?php

namespace Workable\Setting\Supports;

abstract class SettingStore
{
    /**
     * Setting data
     * @var array
     */
    protected $data = [];

    /**
     * Whether the store has changed since it was last loaded
     * @var bool
     */
    protected $unsaved = false;

    /**
     * @var bool
     */
    protected $loaded = false;

    /**
     * Get a specific key from the setting data
     * @param $key
     * @param $default
     * @return array
     */
    public function get($key, $default)
    {
        $this->load();
        return ArrayUtil::get($this->data, $key, $default);
    }

    public function has($key)
    {
        $this->load();

        return ArrayUtil::has($this->data, $key);
    }

    /**
     * Setting
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->load();
        $this->unsaved = true;
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                ArrayUtil::set($this->data, $k, $v);
            }
        } else {
            ArrayUtil::set($this->data, $key, $value);
        }
        return $this;
    }

    /**
     * Unset a key in the settings data
     * @param $key
     */
    public function forget($key)
    {
        $this->unsaved = true;
        if ($this->has($key))
        {
            ArrayUtil::forget($this->data, $key);
        }
        return $this;
    }

    public function forgetAll()
    {
        $this->unsaved = true;
        $this->data = [];
        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        $this->load();
        return $this->data;
    }

    /**
     * Save
     */
    public function save()
    {
        if (!$this->unsaved) {
            return;
        }

        $this->write($this->data);
        $this->unsaved = false;
    }

    /**
     * @param bool $force
     */
    public function load($force = false)
    {
        if (!$this->loaded || $force) {
            $this->data = $this->read();
            $this->loaded = true;
        }
    }

    /**
     * Read the data from the store
     * @return mixed
     */
    abstract protected function read();

    /**
     * Write the data into the store
     * @param array $data
     * @return mixed
     */
    abstract protected function write(array $data);

}
