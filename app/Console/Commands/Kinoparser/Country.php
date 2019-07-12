<?php

namespace App\Console\Commands\kinoparser;

use App\Services\Kinoparser\Parser\Country\ParseCountryAndSave;
use Illuminate\Console\Command;

class Country extends Command
{

    /**
     * @var ParseCountryAndSave
     */
    private $country;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kp:country';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse countries and save to db from \'Lebedev-Art\'';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ParseCountryAndSave $country)
    {
        parent::__construct();
        $this->country = $country;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->country->parseAndSave('https://www.artlebedev.ru/country-list/xml/');
    }
}
