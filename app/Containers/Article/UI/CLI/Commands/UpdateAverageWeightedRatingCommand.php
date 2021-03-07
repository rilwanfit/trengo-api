<?php

namespace App\Containers\Article\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;
use App\Ship\Transporters\DataTransporter;

class UpdateAverageWeightedRatingCommand extends ConsoleCommand
{
    protected $signature = 'trengo:update:weighted-average-rating';

    protected $description = 'Update weighted average rating';

    /**
     * @void
     */
    public function handle()
    {
        Apiato::call('Article@UpdateWeightedAverageRatingAction', [new DataTransporter()]);

        $this->info('Article weighted average rating was successfully updated');
    }
}
