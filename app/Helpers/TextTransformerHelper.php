<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class TextTransformerHelper
{
    protected $formats;
    protected $output;
    protected $exportFileName = 'file.csv';

    public function __construct($formats = [])
    {
        $this->formats = $formats;
    }

    /**
     * Transform the text
     *
     * @return self
     */
    public function transform(): self
    {
        $formats = is_array($this->formats) ? $this->formats : [$this->formats];

        foreach ($formats as $format) {
            $text[$format->format] = $format->output();
        }
        $this->output = $text;

        return $this;
    }

    /**
     * Get the transformed text
     *
     * @return array
     */
    public function getOutput(): array|string
    {
        return count($this->output) > 1
            ? $this->output
            : array_values($this->output)[0];
    }

    /**
     * Export the transformed text to a CSV file
     * returns the file path
     *
     * @return string
     */
    public function export(): string
    {
        Storage::put($this->setExportPath($this->exportFileName), $this->getOutput());

        return Storage::url($this->setExportPath($this->exportFileName));
    }

    /**
     * Set the export path
     *
     * @param string $fileName
     * @return string
     */
    private function setExportPath(string $fileName): string
    {
        return sprintf("csv/%s", $fileName);
    }
}
