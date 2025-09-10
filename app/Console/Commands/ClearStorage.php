<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class ClearStorage extends Command
{
    protected $signature = 'storage:clear';
    protected $description = 'Clear the framework generated files in storage';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->clearCache();
        $this->clearLogs();
        $this->clearSessions();
        $this->clearViews();
        $this->clearCompiledFiles();

        $this->info('Storage cleared successfully.');
    }

    protected function clearCache()
    {
        $this->call('cache:clear');
        $this->call('route:clear');
        $this->call('config:clear');
        $this->call('view:clear');
    }

    protected function clearLogs()
    {
        File::cleanDirectory(storage_path('logs'));
    }

    protected function clearSessions()
    {
        File::cleanDirectory(storage_path('framework/sessions'));
    }

    protected function clearViews()
    {
        File::cleanDirectory(storage_path('framework/views'));
    }

    protected function clearCompiledFiles()
    {
        File::cleanDirectory(storage_path('framework/cache'));
    }
}
