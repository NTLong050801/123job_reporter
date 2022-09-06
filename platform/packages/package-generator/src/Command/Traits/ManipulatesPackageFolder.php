<?php

namespace Workable\PackageGenerator\Command\Traits;

use Illuminate\Support\Facades\File;
use Workable\PackageGenerator\Exceptions\RuntimeException;

trait ManipulatesPackageFolder
{
    /**
     * Create package folder.
     *
     * @param string $packagePath
     *
     * @throws RuntimeException
     */
    protected function createPackageFolder($packagePath)
    {
        $this->info('#1. Create package folder.');

        if (File::exists($packagePath)) {
            $this->info('#2. Package folder already exists. Skipping.');

            return false;
        }

        if (! File::makeDirectory($packagePath, 0755, true)) {
            throw new RuntimeException('Cannot create package folder');
        }

        $this->info('#2. Package folder was successfully created.');
        return true;
    }

    /**
     * Remove package folder.
     *
     * @param $packagePath
     *
     * @throws RuntimeException
     */
    protected function removePackageFolder($packagePath)
    {
        $this->info('-- Remove package folder.');

        if (File::exists($packagePath)) {
            if (! File::deleteDirectory($packagePath)) {
                throw new RuntimeException('-- Cannot remove package folder');
            }

            $this->info('-- Package folder was successfully removed.');
        } else {
            $this->info('-- Package folder does not exists. Skipping.');
        }
    }
}
