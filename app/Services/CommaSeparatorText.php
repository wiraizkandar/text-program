<?php

namespace App\Services;

use App\Interfaces\TextFormatInterface;


class CommaSeparatorText implements TextFormatInterface
{
    public $format;
    public $text;

    /**
     * Set the format and text
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->format = 'comma_separator';
        $this->text = $text;
    }

    /**
     * Output the text with a comma separator
     *
     * @return string
     */
    public function output(): string
    {
        return implode(',', str_split($this->text));
    }
}
