<?php

namespace Workable\PackageGenerator\Command\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Workable\PackageGenerator\Exceptions\RuntimeException;
use Workable\PackageGenerator\Support\StubSupport;

trait CopiesSkeleton
{
    protected $packageBaseDir = __DIR__.'/../../..';

    /**
     * Copy skeleton to package folder.
     *
     * @param string $packagePath
     * @param string $vendor
     * @param string $package
     * @param string $vendorFolderName
     * @param string $packageFolderName
     *
     * @throws RuntimeException
     */
    protected function copySkeleton(
        $platformFolder,
        $packagePath,
        $vendor,
        $package,
        $vendorFolderName,
        $packageFolderName
    ) {
        $this->info('#5. Copy skeleton.');

        $skeletonDirPath = $this->getPathFromConfig(
            'generator.skeleton_dir_path', $this->packageBaseDir.'/skeleton'
        );
        foreach (File::allFiles($skeletonDirPath, true) as $filePath)
        {
            $filePath = realpath($filePath);
            $destFilePath = Str::replaceFirst(
                $skeletonDirPath, $packagePath, $filePath
            );
            $this->copyFileWithDirsCreating($filePath, $destFilePath);
        }

        $this->copyStubs($packagePath, $package, $packageFolderName);
        $variables = $this->getVariables($platformFolder,
            $vendor, $package, $vendorFolderName, $packageFolderName
        );

        $this->replaceTemplates($packagePath, $variables, $package);

        $this->info('#6. Skeleton was successfully copied.');
    }

    /**
     * Copy stubs.
     *
     * @param $packagePath
     * @param $package
     * @param $packageFolderName
     */
    protected function copyStubs($packagePath, $package, $packageFolderName)
    {
        $facadeFilePath = $this->packageBaseDir.'/stubs/Facade.stub';
        $mainClassFilePath = $this->packageBaseDir.'/stubs/MainClass.stub';
        $mainClassTestFilePath = $this->packageBaseDir.'/stubs/MainClassTest.stub';
        $configFilePath = $this->packageBaseDir.'/stubs/config.stub';

        $filePaths = [
            $facadeFilePath => "$packagePath/src/Facades/$package.php.stub",
            $mainClassFilePath => "$packagePath/src/$package.php.stub",
            $mainClassTestFilePath => "$packagePath/tests/{$package}Test.php.stub",
            $configFilePath => "$packagePath/config/$packageFolderName.php.stub",
        ];

        foreach ($filePaths as $filePath => $destFilePath) {
            $this->copyFileWithDirsCreating($filePath, $destFilePath);
        }
    }


    /**
     * Substitute all variables in *.tpl files and remove tpl extension.
     *
     * @param string $packagePath
     * @param array $variables
     */
    protected function replaceTemplates($packagePath, $variables, $package)
    {
        $fileAddPackage = config("packages.package-generator.generator.files_add_package");

        foreach (File::allFiles($packagePath, true) as $filePath)
        {
            $filePath = realpath($filePath);
            if (! Str::endsWith($filePath, '.stub'))
            {
                continue;
            }

            $newFileContent = $this->getTemplateContents($filePath, $variables);

            $filePathNew = $filePath;
            if (Str::contains($filePath, $fileAddPackage))
            {
                $tmpName = basename($filePath);
                $tmpNameFile = ucfirst($package).$tmpName;
                $filePathNew  = str_replace($tmpName, $tmpNameFile, $filePathNew);
            }

            $filePathWithoutTplExt = Str::replaceLast(
                '.stub', '', $filePathNew
            );

            File::put($filePathWithoutTplExt, $newFileContent);
            File::delete($filePath);
        }
    }

    /**
     * Copy source file to destination with needed directories creating.
     *
     * @param string $src
     * @param string $dest
     */
    protected function copyFileWithDirsCreating($src, $dest)
    {
        $dirPathOfDestFile = dirname($dest);

        if (! File::exists($dirPathOfDestFile)) {
            File::makeDirectory($dirPathOfDestFile, 0755, true);
        }

        if (! File::exists($dest)) {
            File::copy($src, $dest);
        }
    }

    /**
     * Thục hiện replace content
     * @param $file
     * @param $replace
     * @return string
     */
    protected function getTemplateContents($file, $replace)
    {
        return (new StubSupport($file, $replace))
                ->render();
    }

    /**
     * Get variables for substitution in templates.
     *
     * @param string $vendor
     * @param string $package
     * @param string $vendorFolderName
     * @param string $packageFolderName
     *
     * @return array
     */
    protected function getVariables(
        $platformFolder,
        $vendor,
        $package,
        $vendorFolderName,
        $packageFolderName
    ) {
        $packageWords = str_replace('-', ' ', Str::snake($packageFolderName));

        $composerDescription = $this->askUser(
            'The composer description?', "A $packageWords"
        );
        $composerKeywords = $this->getComposerKeywords($packageWords);

        $packageHumanName = $this->askUser(
            'The package human name?', Str::title($packageWords)
        );

        $namespaceController = $vendor."\\". ucfirst($package) . "\\" . "Http\Controllers";
        $namespaceControllerApi = $vendor."\\". ucfirst($package) . "\\" . "Http\Controllers\Api";

        return [
            'platformFolder' => $platformFolder,
            'vendor' => $vendor,
            'package' => $package,
            'namespaceController' => $namespaceController,
            'namespaceControllerApi' => $namespaceControllerApi,
            'vendorFolderName' => $vendorFolderName,
            'packageFolderName' => $packageFolderName,
            'packageHumanName' => $packageHumanName,
            'composerName' => "$vendorFolderName/$packageFolderName",
            'composerDesc' => $composerDescription,
            'composerKeywords' => $composerKeywords,
            'license' => $this->askUser('The package licence?', 'MIT'),
            'phpVersion' => $this->askUser('Php version constraint?', '>=7.1'),
            'aliasName' => $packageFolderName,
            'configFileName' => $packageFolderName,
            'year' => date('Y'),
            'name' => $this->askUser('Your name?'),
            'email' => $this->askUser('Your email?'),
            'githubPackageUrl' => "https://github.com/$vendorFolderName/$packageFolderName",
        ];
    }

    /**
     * Get path from config.
     *
     * @param string $configName
     * @param string $default
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected function getPathFromConfig($configName, $default)
    {
        $path = config("packages.package-generator.$configName");

        if (empty($path)) {
            $path = $default;
        } else {
            $path = base_path($path);
        }

        $realPath = realpath($path);

        if ($realPath === false) {
            throw RuntimeException::noAccessTo($path);
        }

        return $realPath;
    }

    /**
     * Get composer keywords.
     *
     * @param $packageWords
     *
     * @return string
     */
    protected function getComposerKeywords($packageWords)
    {
        $keywords = $this->askUser(
            'The composer keywords? (comma delimited)', str_replace(' ', ',', $packageWords)
        );
        $keywords = explode(',', $keywords);
        $keywords = array_map(function ($keyword) {
            return "\"$keyword\"";
        }, $keywords);

        return implode(",\n".str_repeat(' ', 4), $keywords);
    }
}
