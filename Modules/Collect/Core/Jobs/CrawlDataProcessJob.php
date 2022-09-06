<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 05/07/2022
 * Time: 11:13
 */

namespace Modules\Collect\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Collect\Core\Entity\ReferenceProcess;
use Modules\Collect\Core\Entity\RobotProcess;
use Modules\Collect\Core\Entity\SeoContentProcess;
use Modules\Collect\Core\Entity\UploadPublicProcess;
use Workable\Base\Supports\CliEcho;

class CrawlDataProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $items;
    private $process;
    private $country;

    public function __construct($items = [], $process = '', $country = '')
    {
        $this->items   = $items;
        $this->process = $process;
        $this->country = $country;
    }

    public function handle()
    {
        $processData = null;
        switch ($this->process)
        {
            case 'upload_public':
                $processData = new UploadPublicProcess();
                break;
            case 'reference':
                $processData = new ReferenceProcess();
                break;
            case 'robot':
                $processData = new RobotProcess();
                break;
            case 'seo_content':
                $processData = new SeoContentProcess();
                break;
            default:
                break;
        }

        if ($processData)
        {
            $processData
                ->setCountry($this->country)
                ->process($this->items);
        }
        else
        {
            CliEcho::errornl('Cannot get process');
        }
    }
}
