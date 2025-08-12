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
            throw new FileNotFoundException("File {$this->filename} does not exists");
        }

        if (! is_readable($this->filename)) {
            throw new FilePermissionException("File {$this->filename} is not readable");
        }

        $this->data = file($this->filename);
        $this->header = str_getcsv($this->data[0], $this->separator);
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
