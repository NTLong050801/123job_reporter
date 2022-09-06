<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 6/29/18
 * Time: 5:10 PM
 */

namespace Modules\Company\Services;


/**
 * OPcache GUI
 *
 * A simple but effective single-file GUI for the OPcache PHP extension.
 *
 * @author Andrew Collington, andy@amnuts.com
 * @version 2.4.0
 * @link https://github.com/amnuts/opcache-gui
 * @license MIT, http://acollington.mit-license.org/
 */

/*
 * Shouldn't need to alter anything else below here
 */

if (!extension_loaded('Zend OPcache')) {
    die('The Zend OPcache extension does not appear to be installed');
}

$ocEnabled = ini_get('opcache.enable');
if (empty($ocEnabled)) {
    die('The Zend OPcache extension is installed but not turned on');
}

class OpCacheService
{
    protected $data;
    protected $options;
    protected $defaults = [
        'allow_filelist' => true,
        'allow_invalidate' => true,
        'allow_reset' => true,
        'allow_realtime' => true,
        'refresh_time' => 5,
        'size_precision' => 2,
        'size_space' => false,
        'charts' => true,
        'debounce_rate' => 250,
        'cookie_name' => 'opcachegui',
        'cookie_ttl' => 365
    ];

    private function __construct($options = [])
    {
        $this->options = array_merge($this->defaults, $options);
        $this->data = $this->compileState();
    }

    protected function compileState()
    {
        $status = opcache_get_status();
        $config = opcache_get_configuration();

        $files = [];
        if (!empty($status['scripts']) && $this->getOption('allow_filelist')) {
            uasort($status['scripts'], function ($a, $b) {
                return $a['hits'] < $b['hits'];
            });
            foreach ($status['scripts'] as &$file) {
                $file['full_path'] = str_replace('\\', '/', $file['full_path']);
                $file['readable'] = [
                    'hits' => number_format($file['hits']),
                    'memory_consumption' => $this->size($file['memory_consumption'])
                ];
            }
            $files = array_values($status['scripts']);
        }

        $overview = array_merge(
            $status['memory_usage'], $status['opcache_statistics'], [
                'used_memory_percentage' => round(100 * (
                        ($status['memory_usage']['used_memory'] + $status['memory_usage']['wasted_memory'])
                        / $config['directives']['opcache.memory_consumption'])),
                'hit_rate_percentage' => round($status['opcache_statistics']['opcache_hit_rate']),
                'wasted_percentage' => round($status['memory_usage']['current_wasted_percentage'], 2),
                'readable' => [
                    'total_memory' => $this->size($config['directives']['opcache.memory_consumption']),
                    'used_memory' => $this->size($status['memory_usage']['used_memory']),
                    'free_memory' => $this->size($status['memory_usage']['free_memory']),
                    'wasted_memory' => $this->size($status['memory_usage']['wasted_memory']),
                    'num_cached_scripts' => number_format($status['opcache_statistics']['num_cached_scripts']),
                    'hits' => number_format($status['opcache_statistics']['hits']),
                    'misses' => number_format($status['opcache_statistics']['misses']),
                    'blacklist_miss' => number_format($status['opcache_statistics']['blacklist_misses']),
                    'num_cached_keys' => number_format($status['opcache_statistics']['num_cached_keys']),
                    'max_cached_keys' => number_format($status['opcache_statistics']['max_cached_keys']),
                    'interned' => null,
                    'start_time' => date('Y-m-d H:i:s', $status['opcache_statistics']['start_time']),
                    'last_restart_time' => ($status['opcache_statistics']['last_restart_time'] == 0
                        ? 'never'
                        : date('Y-m-d H:i:s', $status['opcache_statistics']['last_restart_time'])
                    )
                ]
            ]
        );

        if (!empty($status['interned_strings_usage'])) {
            $overview['readable']['interned'] = [
                'buffer_size' => $this->size($status['interned_strings_usage']['buffer_size']),
                'strings_used_memory' => $this->size($status['interned_strings_usage']['used_memory']),
                'strings_free_memory' => $this->size($status['interned_strings_usage']['free_memory']),
                'number_of_strings' => number_format($status['interned_strings_usage']['number_of_strings'])
            ];
        }

        $directives = [];
        ksort($config['directives']);
        foreach ($config['directives'] as $k => $v) {
            $directives[] = ['k' => $k, 'v' => $v];
        }

        $version = array_merge(
            $config['version'],
            [
                'php' => phpversion(),
                'server' => empty($_SERVER['SERVER_SOFTWARE']) ? '' : $_SERVER['SERVER_SOFTWARE'],
                'host' => (function_exists('gethostname')
                    ? gethostname()
                    : (php_uname('n')
                        ?: (empty($_SERVER['SERVER_NAME'])
                            ? $_SERVER['HOST_NAME']
                            : $_SERVER['SERVER_NAME']
                        )
                    )
                )
            ]
        );

        return [
            'version' => $version,
            'overview' => $overview,
            'files' => $files,
            'directives' => $directives,
            'blacklist' => $config['blacklist'],
            'functions' => get_extension_funcs('Zend OPcache')
        ];
    }

    public function getOption($name = null)
    {
        if ($name === null) {
            return $this->options;
        }
        return (isset($this->options[$name])
            ? $this->options[$name]
            : null
        );
    }

    protected function size($size)
    {
        $i = 0;
        $val = array('b', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        while (($size / 1024) > 1) {
            $size /= 1024;
            ++$i;
        }
        return sprintf('%.' . $this->getOption('size_precision') . 'f%s%s',
            $size, ($this->getOption('size_space') ? ' ' : ''), $val[$i]
        );
    }

    public static function getInit()
    {
        /*
         * User configuration
         */
        $options = [
            'allow_filelist' => true,          // show/hide the files tab
            'allow_invalidate' => true,          // give a link to invalidate files
            'allow_reset' => true,          // give option to reset the whole cache
            'allow_realtime' => true,          // give option to enable/disable real-time updates
            'refresh_time' => 5,             // how often the data will refresh, in seconds
            'size_precision' => 2,             // Digits after decimal point
            'size_space' => false,         // have '1MB' or '1 MB' when showing sizes
            'charts' => true,          // show gauge chart or just big numbers
            'debounce_rate' => 250,           // milliseconds after key press to send keyup event when filtering
            'cookie_name' => 'opcachegui',  // name of cookie
            'cookie_ttl' => 365            // days to store cookie
        ];
        return self::init($options);
    }

    public static function init($options = [])
    {
        $self = new self($options);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            if (isset($_GET['reset']) && $self->getOption('allow_reset')) {
                echo '{ "success": "' . ($self->resetCache() ? 'yes' : 'no') . '" }';
            } else if (isset($_GET['invalidate']) && $self->getOption('allow_invalidate')) {
                echo '{ "success": "' . ($self->resetCache($_GET['invalidate']) ? 'yes' : 'no') . '" }';
            } else {
                echo json_encode($self->getData((empty($_GET['section']) ? null : $_GET['section'])));
            }
            exit;
        } else if (isset($_GET['reset']) && $self->getOption('allow_reset')) {
            $self->resetCache();
            header('Location: ?');
            exit;
        } else if (isset($_GET['invalidate']) && $self->getOption('allow_invalidate')) {
            $self->resetCache($_GET['invalidate']);
            header('Location: ?');
            exit;
        }
        return $self;
    }

    public function resetCache($file = null)
    {
        $success = false;
        if ($file === null) {
            $success = opcache_reset();
        } else if (function_exists('opcache_invalidate')) {
            $success = opcache_invalidate(urldecode($file), true);
        }
        if ($success) {
            $this->compileState();
        }
        return $success;
    }

    public function getData($section = null, $property = null)
    {
        if ($section === null) {
            return $this->data;
        }
        $section = strtolower($section);
        if (isset($this->data[$section])) {
            if ($property === null || !isset($this->data[$section][$property])) {
                return $this->data[$section];
            }
            return $this->data[$section][$property];
        }
        return null;
    }

    public function canInvalidate()
    {
        return ($this->getOption('allow_invalidate') && function_exists('opcache_invalidate'));
    }
}
