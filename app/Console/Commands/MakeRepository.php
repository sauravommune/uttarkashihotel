<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $name = $this->argument('repository');
        $namespace = 'App\\Repositories';
        $stub = File::get(app_path('Stub/Repository.stub'));
        $path =app_path("Repositories/{$name}Repository.php");
        if(File::exists($path)){
            $this->error('Repository already exists');
            return;
        }
        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $name],
            $stub
        );
        File::put(app_path("Repositories/{$name}Repository.php"), $content);
        $this->info("Repository {$name} created successfully.");
    }
}
