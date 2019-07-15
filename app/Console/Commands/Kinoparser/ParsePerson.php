<?php

namespace App\Console\Commands\kinoparser;

use App\Services\Kinoparser\Parser\Person\ParsePersonAndSave;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ParsePerson extends Command
{

    /**
     * @var XpathParser
     */
    private $parser;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kp:person';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Persons from html files to DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ParsePersonAndSave $parser)
    {
        parent::__construct();
        $this->parser = $parser;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = $this->getAllFiles();

        $bar = $this->output->createProgressBar(count($files));
        foreach ($files as $file) {
            $this->parser->parseAndSave($file);
            $bar->advance();
        }
        $bar->finish();
        $this->info("\nDone!");
    }

    protected function getAllFiles()
    {
        $this->info("\nGet All Urls in process!");
//        $files = Storage::disk('person')->files('563');
//        dd($files);
//        return $files;
        $directories = Storage::disk('person')->directories();
        $bar = $this->output->createProgressBar(count($directories));
        $files = [];
        foreach ($directories as $directory) {
            $next_files = Storage::disk('person')->files($directory);
            $files = array_merge($files, $next_files);
            $bar->advance();
//            dd($files);
        }
        $bar->finish();
        natsort($files);
        $this->info("\nGet All Urls is Done!");
        return $files;
    }

}
