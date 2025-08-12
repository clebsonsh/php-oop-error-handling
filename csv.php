<?php

require_once 'classes/CSVParser.php';

$csv = new CSVParser('customers.csv', ';');
if ($csv->parse()) {

    while ($row = $csv->fetch()) {
        echo $row['Name'].' - ';
        echo $row['City'].PHP_EOL;
    }
} else {
    echo 'ERROR reading file!'.PHP_EOL;
}
