<?php

namespace GetThingsDone\Affiliate\Commands;

use Illuminate\Console\Command;

class AffiliateCommand extends Command
{
    public $signature = 'affiliate';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
