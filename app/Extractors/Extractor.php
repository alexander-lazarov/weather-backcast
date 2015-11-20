<?php

namespace App\Extractors;

interface Extractor
{
    public function input($data);
    public function output();
}
