<?php

class CSVParser
{
    private array $data;

    private array $header;

    private int $counter;

    public function __construct(
        private string $filename,
        private string $separator = ',',
    ) {
        $this->counter = 1;
    }

    public function parse()
    {
        if (! file_exists($this->filename)) {
            return false;
        }

        if (! is_readable($this->filename)) {
            return false;
        }

        $this->data = file($this->filename);
        $this->header = str_getcsv($this->data[0], $this->separator);

        return true;
    }

    public function fetch()
    {
        if (isset($this->data[$this->counter])) {
            $row = str_getcsv($this->data[$this->counter++], $this->separator);

            foreach ($row as $key => $value) {
                $row[$this->header[$key]] = $value;
            }

            return $row;
        }
    }
}
