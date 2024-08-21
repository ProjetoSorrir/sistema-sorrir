<?php

namespace App\Console\Commands;

use App\Services\ActivateSitesService;
use Illuminate\Console\Command;

class UpdateSiteStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sites:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of each site';

    /**
     * Execute the console command.
     */
    public function handle(ActivateSitesService $service)
    {
        $service->updateSiteStatuses();
        $this->info('Site statuses updated successfully!');
    }
}
