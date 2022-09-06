<?php

namespace Workable\PackageGenerator\Command;

use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\Traits\ChangesComposerJson;
use Workable\PackageGenerator\Command\Traits\CopiesSkeleton;
use Workable\PackageGenerator\Command\Traits\InteractsWithComposer;
use Workable\PackageGenerator\Command\Traits\InteractsWithGit;
use Workable\PackageGenerator\Command\Traits\InteractsWithUser;
use Workable\PackageGenerator\Command\Traits\ManipulatesPackageFolder;

class PackageNewCommand extends AbstractCommand
{
    use ChangesComposerJson;
    use InteractsWithUser;
    use ManipulatesPackageFolder;
    use CopiesSkeleton;
    use InteractsWithComposer;
    use InteractsWithGit;

    protected $name = 'package:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new package.';

    public function handle()
    {
        $names = $this->argument("name");
        foreach ($names as $name)
        {
            $this->fire($name);
        }
    }

    /**
     * @param $package
     * @return int
     */
    public function fire($package)
    {
        $platform = $this->option('platform');
        $vendor = $this->option('namespace');
        $vendorFolderName = $this->getVendorFolderName($vendor);
        $packageFolderName = $this->getPackageFolderName($package);

        $relPackagePath = "platform/$platform/$packageFolderName";
        $packagePath = base_path($relPackagePath);

        try {
            $create = $this->createPackageFolder($packagePath);
            if ($create) {
                $this->copySkeleton($platform, $packagePath, $vendor, $package, $vendorFolderName, $packageFolderName);
//                $this->initRepo($packagePath);
                $this->composerDumpAutoload();
            }

            $this->info('Finished. Are you ready to write awesome package?');
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return -1;
        }
    }

    /**
     * Update with composer
     * @param $package
     * @return int
     */
    public function fireWithUpdateComposer($package)
    {
        $platform = $this->option('platform');
        $vendor = $this->option('namespace');
        $vendorFolderName = $this->getVendorFolderName($vendor);
        $packageFolderName = $this->getPackageFolderName($package);


        $relPackagePath = "platform/$platform/$packageFolderName";
        $packagePath = base_path($relPackagePath);

        try {
            $create = $this->createPackageFolder($packagePath);
            if ($create) {
                $this->registerPackage($vendorFolderName, $packageFolderName, $relPackagePath);
                $this->copySkeleton($platform, $packagePath, $vendor, $package, $vendorFolderName, $packageFolderName);
                $this->initRepo($packagePath);
                $this->composerUpdatePackage($vendorFolderName, $packageFolderName);
                $this->composerDumpAutoload();
            }

            $this->info('Finished. Are you ready to write awesome package?');
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return -1;
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::IS_ARRAY, 'The names of packages will be execute.'],
        ];
    }
}
