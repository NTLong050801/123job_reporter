# Make Console
Create a AuthenConsole for package: `file-uploader` in folder platform: `packages`
```
php artisan package-make:console AuthenConsole --package=file-uploader --platform=packages --namespace=Workable
```

Now, Notice I have used some flag like
- `--package` : The name package like: file-uploader, helper ...
- `--platform`: The name folder contain your package
- `--namespace`: The namespace load package like in schema composer.json of your package

This will give you:
```
    <?php
    namespace Workable\FileUploader\Console;
    
    use Illuminate\Console\Command;
    use Symfony\Component\Console\Input\InputOption;
    use Symfony\Component\Console\Input\InputArgument;
    
    class AuthenConsole extends Command
    {
        /**
         * The console command name.
         *
         * @var string
         */
        protected $name = 'command:name';
    
        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Command description.';
    
        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }
    
        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle()
        {
            //
        }
    
        /**
         * Get the console command arguments.
         *
         * @return array
         */
        protected function getArguments()
        {
            return [
                ['example', InputArgument::REQUIRED, 'An example argument.'],
            ];
        }
    
        /**
         * Get the console command options.
         *
         * @return array
         */
        protected function getOptions()
        {
            return [
                ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
            ];
        }
    }

```
