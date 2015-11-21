<?php

namespace App\Extractors;

use App\Extractors\Extractor;
use PHPHtmlParser\Dom;

class VTMISExtractor implements Extractor
{
    protected $results = [];
    protected $dom;

    public function input($data)
    {
        $this->dom = new Dom;
        $this->dom->load($data);

        $this->parseDOM();
    }

    protected function parseDOM()
    {
        foreach ($this->dom->find('tr') as $row) {
            $name = '';
            $res = [];
            $i = 0;
            foreach ($row->find('td') as $data) {
                switch ($i) {
                    case 0:
                        $name = trim($data->text);
                        break;
                    case 1:
                        $res['wind_speed'] = floatval($data->text);
                        break;
                    case 2:
                        $res['wind_gust_speed'] = floatval($data->text);
                        break;
                    case 3:
                        $res['wind_direction'] = intval($data->text);
                        break;
                    case 4:
                        $res['temperature'] = floatval($data->text);
                        break;
                    case 5:
                        $res['pressure'] = floatval($data->text);
                        break;
                    case 6:
                        $res['created_at'] = \DateTime::createFromFormat(
                            'j/n/Y H:i:s',
                            $data->text
                        );
                        break;
                }

                $i++;
            }

            if ($name) {
                $this->results[$name] = $res;
            }
        }
    }

    public function output()
    {
        return $this->results;
    }
}
