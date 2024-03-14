<?php

namespace App\Services;

use App\Interfaces\TextFormatInterface;


class UpperCaseText implements TextFormatInterface
{
    public $format;
    public $text;

    public function __construct(string $text)
    {
        $this->format = 'uppercase';
        $this->text = $text;
    }

    public function output(): string
    {
        return strtoupper($this->text);
    }
}
