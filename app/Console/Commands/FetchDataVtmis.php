<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Extractors\VTMISExtractor;
use App\Repositories\SpotRepository;
use App\Measurement;

class FetchDataVtmis extends Command
{
    protected static $URL = 'http://91.238.255.81/meteo/m.php';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-data:vtmis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch meteo data from VTMIS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SpotRepository $spots)
    {
        $this->spots = $spots;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = file_get_contents(self::$URL);
        $data = mb_convert_encoding($data, 'UTF-8', 'Windows-1251');
        $e = new VTMISExtractor();
        $e->input($data);

        foreach ($e->output() as $name => $data) {
            $spot = $this->spots->getOrCreateByName($name);

            $measurement = new Measurement;
            $measurement->spot_id = $spot->id;
            foreach ($data as $key => $value) {
                $measurement->$key = $value;
            }

            $measurement->save();
        }
    }
}
