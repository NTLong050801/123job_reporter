<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-comman {name} {--function=default}';
//    protected $signature = 'test-comman
//                        {name : The ID of the user}
//                        {--function= : Whether the job should be queued}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
//        echo'3123123';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

      //  $password = $this->secret('What is the password?');
        //$name1= $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
        //$name1 = $this->choice('What is your name?', ['Taylor', 'Dayle'], 1);
//        $name1 = $this->choice(
//            'What is your name?',
//            ['Taylor', 'Dayle'],
//            1,
//            $maxAttempts = null,
//            $allowMultipleSelections = false
//        );
//        $this->info('Display this on the screen');
//        $this->line('Display this on the screen');
//        if ($this->confirm('Do you wish to continue?')) {
//            $name = $this->argument('name');
//            $fu = $this->option('function');
//            $age = $this->ask('how old are you?');
//            if ($age == 18) {
//                echo "Ban" . $age;
//                if($this->confirm('Do you wish to continue?')){
//                    echo  'ok';
//                }
//            }
        //}
        //table layout
        $headers = ['Name', 'Email'];
        $users = [['long','2131@gmail.com'],['long1','3123123@gmail.com']];
        $this->table($headers, $users);

        $bar = $this->output->createProgressBar(count($users));
        $bar->start();

//        foreach ($users as $user) {
//            $this->performTask($user);
//
//            $bar->advance();
//        }

        $bar->finish();

    }
}
