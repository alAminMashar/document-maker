<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class OptimizeBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize:batch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs multiple optimization and queue management commands in batch.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $commands = [
            'composer dumpautoload',
            'php artisan optimize:clear',
            'php artisan optimize',
            'php artisan queue:restart',
            'php artisan permissions:sync',
        ];

        foreach ($commands as $command) {
            $this->info("Running: $command");
            $process = Process::fromShellCommandline($command);
            $process->setTimeout(null); // No timeout limit
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });

            if (!$process->isSuccessful()) {
                $this->error("Error executing: $command");
                return 1; // Exit with error
            }
        }

        $this->info('All commands executed successfully.');
        return 0; // Success
    }
}
