<?php

namespace App\Services;

use App\Interfaces\TextFormatInterface;

class AlternateCaseText implements TextFormatInterface
{
    public string $format;
    public string $text;

    public function __construct(string $text)
    {
        $this->format = 'alternatecase';
        $this->text = $text;
    }

    /**
     * Output the text with alternate case
     */
    public function output(): string
    {
        $alternateText = '';

        for ($i = 0; $i < strlen($this->text); $i++) {
            $alternateText .= $i % 2 == 0
                ? strtolower($this->text[$i])
                : strtoupper($this->text[$i]);
        }

        return $alternateText;
    }
}
