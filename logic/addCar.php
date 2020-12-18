<?php
    include_once('index.php');
    include_once('carFunctions.php');
    include_once($_SERVER["DOCUMENT_ROOT"].'/phplab4/views/addCar.html');

    function writeRecord($arr)
    {
        $newCarRecord = generateRecordLine($arr, FIELD_SEPARATOR);
        define('DATA_DIR_PATH',$_SERVER["DOCUMENT_ROOT"].'/phplab4/data/');
        define('CARS_TXT_PATH',DATA_DIR_PATH.'cars.txt');
        try {
            if(!is_dir(DATA_DIR_PATH))
            mkdir(DATA_DIR_PATH, 0777,true);
            $carsDataFile = fopen(CARS_TXT_PATH, 'a+');
            $carsFileSize = filesize(CARS_TXT_PATH);
            $isWriteRecord = true;
            if($carsFileSize) {
                $carsDataContent = fread($carsDataFile, $carsFileSize);
                $carRecords = explode("\n", $carsDataContent);
                foreach ($carRecords as $key => $carRecord) {
                    $car = explode(':', $carRecord);
                    if($car[0] == $arr['brand'] && $car[1] == $arr['model']) {
                        $isWriteRecord = false;
                        break;
                    }
                }
            }
            if($isWriteRecord)
                fwrite($carsDataFile, $newCarRecord);
            else
                echo '<h5 style="margin-top:-1%;">I have already seen this car!</h5>';
            fclose($carsDataFile);
        } catch (\Throwable $th) {
            echo '<script type="text/javascript">alert("Can\'t save your car..")</script>';
        }
    }
    if($requestCar['brand']) {
        writeRecord($requestCar);
    }
?>