<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:DatabaseBackup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DatabaseBackup';

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
     */
    public function handle()
    {
        //
        $filename = "backup-" . Carbon::now()->format('Y-m-d_H_i_s') . ".sql.gz";
        $folder = storage_path() . "/app/backup/";

        //create folder if doesnt exist
        is_dir($folder) or mkdir($folder, 0755, true);

        $dbuser =  env('DB_USERNAME');
        $dbpwd = env('DB_PASSWORD');
        $dbname = env('DB_DATABASE');
        $dbhost = env('DB_HOST');

        $command = "mysqldump -h $dbhost -u $dbuser --password=$dbpwd $dbname | gzip > $folder$filename";

        // exec($command, $output, $returnVar);
        $result = passthru($command);
        
        $files = glob($folder . "*");
        $now = time();
        foreach ($files as $file) {
            if ($now - filemtime($file) >= 60 * 60 * 24 * 7) { // 7 days
                unlink($file);
            }
        }
    }
}
