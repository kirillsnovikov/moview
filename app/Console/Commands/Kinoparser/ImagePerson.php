<?php

namespace App\Console\Commands\Kinoparser;

use App\Person;
use App\Services\Kinoparser\Person\PersonImageGetter;
use Illuminate\Console\Command;

class ImagePerson extends Command
{

    /**
     * @var PersonImageGetter
     */
    private $image;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kp:image-person';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get images from KP and save img-path to DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PersonImageGetter $image)
    {
        parent::__construct();
        $this->image = $image;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $person = Person::where('kp_id', 1326946)->first();
//        $person = Person::where('kp_id', 147302)->first();
//        $this->image->putImageInFile($person);
//        dd($person);
//        $this->image->putImageInFile('1/6479.html', '1/test_test_100.jpg');
        $persons = Person::where('kp_id', '!=', null)->where('image', null)->get();
        $bar = $this->output->createProgressBar(count($persons));
        foreach ($persons as $person) {
            $this->image->putImageInFile($person);
            $bar->advance();
        }
        $bar->finish();
        $this->info("\nDone!");
    }

}
