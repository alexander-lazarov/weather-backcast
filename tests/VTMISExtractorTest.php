<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Extractors\VTMISExtractor;

class VTMISExtractorTest extends TestCase
{
    public function testWhenDataEmpty()
    {
        $e = new VTMISExtractor();
        $e->input('');
        $this->assertEquals($e->output(), []);
    }

    public function testWithData1()
    {
        $data = file_get_contents('tests/support/vtmis-1.htm');
        $e = new VTMISExtractor();
        $e->input($data);
        $expectedOutput = [
            'Калиакра' => [
                'wind_speed' => '6.3',
                'wind_gust_speed' => '6.3',
                'wind_direction' => '271',
                'temperature' => '14.9',
                'pressure' => '982.6'
            ],
            'Балчик' => [
                'wind_speed' => '3.5',
                'wind_gust_speed' => '3.9',
                'wind_direction' => '221',
                'temperature' => '15',
                'pressure' => '1000.6'
            ]
        ];
        $this->assertArraySubset($expectedOutput, $e->output());
    }
}
