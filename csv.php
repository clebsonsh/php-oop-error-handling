<?php

require_once 'classes/CSVParser.php';

$csv = new CSVParser('customers.csv', ';');
$csv->parse();

while ($row = $csv->fetch()) {
    echo $row['Name'].' - ';
    echo $row['City'].PHP_EOL;
}
