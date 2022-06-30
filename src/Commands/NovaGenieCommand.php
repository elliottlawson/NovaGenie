<?php

namespace ElliottLawson\NovaGenie\Commands;

use Illuminate\Console\Command;

class NovaGenieCommand extends Command
{
    public $signature = 'novagenie';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
