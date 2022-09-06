<?php


namespace Workable\PackageGenerator\Command;


use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\Traits\ChangesComposerJson;
use Workable\PackageGenerator\Command\Traits\InteractsWithComposer;
use Workable\PackageGenerator\Command\Traits\InteractsWithUser;
use Workable\PackageGenerator\Command\Traits\ManipulatesPackageFolder;

use Illuminate\Support\Facades\File;

class PackageRemoveCommand extends AbstractCommand
{
    use ChangesComposerJson;
    use ManipulatesPackageFolder;
    use InteractsWithUser;
    use InteractsWithComposer;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'package:del';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the existing package.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $packages = $this->argument("name");
        foreach ($packages as $package)
        {
            $this->remove($package);
        }
    }

    public function remove($package)
    {
        $folder = $this->option('platform');
        $vendor = $this->option('namespace');
        $vendorFolderName = $this->getVendorFolderName($vendor);
        $packageFolderName = $this->getPackageFolderName($package);

        $relPackagePath = "platform/$folder/$packageFolderName";
        $packagePath = base_path($relPackagePath);

        if (!File::isDirectory($packagePath))
        {
            $this->warn('-- Folder not exists :'. $packagePath);
            return false;
        }

        try {
            $this->composerRemovePackage($vendorFolderName, $packageFolderName);
            $this->removePackageFolder($packagePath);
            $this->unregisterPackage($vendor, $package, $relPackagePath);
            $this->composerDumpAutoload();
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
