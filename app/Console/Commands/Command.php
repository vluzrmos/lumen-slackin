<?php

namespace App\Console\Commands;

use Illuminate\Console\Command as IlluminateCommand;

abstract class Command extends IlluminateCommand
{


    /**
     * Prints an horizontal table
     * @param array $rows
     */
    protected function horizontalTable(array $rows)
    {
        $rows = array_dot($rows);

        $lines = [];

        foreach ($rows as $key => $value) {
            $lines[] = $this->getTableLine($key, $value);
        }

        $linesMaxLength = $this->getStringsMaxLength($lines);

        $this->writeTableLine($linesMaxLength);

        foreach ($lines as $line) {
            $this->output->writeln($line);
        }

        $this->writeTableLine($linesMaxLength);
    }

    /**
     *
     * Get a string for a given row (header, content)
     *
     * @param string $header  Title of the header
     * @param string $content content of the header
     *
     * @return string
     */
    private function getTableLine($header, $content)
    {
        return sprintf("<info>%s:</info> %s", $header, $content);
    }

    /**
     * Get max length of strings on a given array of headers
     *
     * @param array $strings
     *
     * @return int
     */
    private function getStringsMaxLength(array $strings)
    {
        $size = 0;

        foreach ($strings as $string) {
            $size = max($size, strlen($string));
        }

        return $size;
    }

    /**
     * Writes a line with a given separator
     * @param int    $length    Length of the line
     * @param string $separator Chacactere used for the line
     */
    private function writeTableLine($length, $separator = '-')
    {
        $this->output->writeln(substr(str_repeat($separator, $length), 0, $length));
    }
}
