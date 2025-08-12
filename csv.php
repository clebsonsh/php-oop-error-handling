<?php

require_once 'classes/CSVParser.php';

class FileNotFoundException extends Exception {}
class FilePermissionException extends Exception {}

$csv = new CSVParser('customers.csv', ';');
try {
    $csv->parse();

    while ($row = $csv->fetch()) {
        echo $row['Name'].' - ';
        echo $row['City'].PHP_EOL;
    }
} catch (FileNotFoundException $e) {
    print_r($e->getTrace());
    exit('File does not exists');
} catch (FilePermissionException $e) {
    echo $e->getFile().' : '.$e->getLine().' # '.$e->getMessage();
}
