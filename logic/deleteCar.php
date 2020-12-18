<?php
    include_once('carFunctions.php');
        
    $carRecords = file_get_contents(CARS_TXT_PATH);
    $deletingLine = generateRecordLine($requestCar, FIELD_SEPARATOR);
    $newFileContent = str_replace($deletingLine, '', $carRecords);
    file_put_contents(CARS_TXT_PATH, $newFileContent);

    include_once('showCars.php');
?>