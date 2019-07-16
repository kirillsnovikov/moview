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
    protected $signature = 'kp:person
            {--from= : From what folder start to parse(if none mean to parse all)}
            {--to= : To what folder finish to parse(if none mean to parse all)}';

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
        $from_folder = (int) $this->option('from');
        $to_folder = (int) $this->option('to');
//        dd($from_folder, $to_folder);

        $files = $this->getSortFiles($from_folder, $to_folder);


        $bar = $this->output->createProgressBar(count($files));
        foreach ($files as $file) {
            $this->parser->parseAndSave($file);
            $bar->advance();
        }
        $bar->finish();
        $this->info("\nDone!");
    }

    /**
     * 
     * @return array
     */
    protected function getSortFiles($from_folder, $to_folder): array
    {
        $this->info("\nGet All Urls in process!");

        $all_files = $this->getAllFiles($from_folder, $to_folder);
        $handled_files = $this->getHandledFiles();

        $this->info("\nSort All Urls in process!");
        $remain_files = array_diff($all_files, $handled_files);
        natsort($remain_files);
        $this->info("\nSort All Urls is Done!");
        $this->info("\nGet All Urls is Done!");
        return $remain_files;
    }

    /**
     * 
     * @param type $from_folder
     * @param type $to_folder
     * @return array
     */
    protected function getAllFiles($from_folder = null, $to_folder = null): array
    {
        if ($from_folder != null && $to_folder != null && $from_folder < $to_folder) {
            $directories = [];
            for ($from_folder; $from_folder <= $to_folder; $from_folder++) {
                $directories[] = $from_folder;
            }
        } else {
            $directories = Storage::disk('person')->directories();
        }
        $files = $this->getFilesFromDirectories($directories);
        return $files;
    }

    /**
     * 
     * @param array $directories
     * @return array
     */
    protected function getFilesFromDirectories(array $directories): array
    {
        $bar = $this->output->createProgressBar(count($directories));
        $files = [];
        foreach ($directories as $directory) {
            $next_files = Storage::disk('person')->files($directory);
            $files = array_merge($files, $next_files);
            $bar->advance();
        }
        $bar->finish();
        return $files;
    }

    /**
     * 
     * @return array
     */
    protected function getHandledFiles(): array
    {
        $persons = \App\Person::where('kp_id', '!=', null)->get();
        $bar = $this->output->createProgressBar(count($persons));
        $files = [];
        foreach ($persons as $person) {
            $filename = ceil($person->kp_id / 10000) . '/' . $person->kp_id . '.html';
            $files[] = $filename;
            $bar->advance();
        }
        $bar->finish();
        return $files;
    }

}
