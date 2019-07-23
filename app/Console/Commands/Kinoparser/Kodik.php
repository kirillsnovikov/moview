<?php

namespace App\Console\Commands\Kinoparser;

use App\Services\Kinoparser\Kodik\MoviesDataSaver;
use Illuminate\Console\Command;

class Kodik extends Command
{

    /**
     * @var MoviesDataSaver
     */
    private $data;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kp:kodik
            {--up= : Update \'--update=all\' or \'--update=title\' same values}
            {--t= : Translation ID}
            {--cr : CamRip true or false \'false\' is only qualities videos}
            {types? : Input one or several types comma separated \'foreign-movie, russian-movie\'}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data (movies/serials) from BD.Kodik.biz';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MoviesDataSaver $data)
    {
        parent::__construct();
        $this->data = $data;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $types = $this->argument('types');
        $update = $this->option('up');
        $translation = $this->option('t');
        $camrip = $this->option('cr');
//        dd($types, $update, $translation, $camrip);
//        dd(empty($camrip));
//        $name = $this->argument('name');
//        $method = $this->getMethodName($name);

        $this->data->saveAllMoves($types, $update, $translation, $camrip);
    }

//    protected function getMethodName(string $name): string
//    {
//        $name = title_case($name);
//        $method = 'get' . $name . 'MoviesList';
//        return $method;
//    }
}
