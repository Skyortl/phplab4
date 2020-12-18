<?php
    $requestCar['brand'] = $_GET['brand'];
    $requestCar['model'] = $_GET['model'];
    $requestCar['price'] = $_GET['price'];
    define('DATA_DIR_PATH',$_SERVER["DOCUMENT_ROOT"].'/phplab4/data/');
    define('CARS_TXT_PATH',DATA_DIR_PATH.'cars.txt');
    define('FIELD_SEPARATOR', ':');
    function array_map_assoc($func, $arr){
        $rv = array();
        foreach($arr as $key => $val){
            $func($key, $val);
            $rv[$key] = $val;
        }
        return $rv;
    }
    function generateRecordLine($arr, $separator)
    {
        return implode($separator,array_map_assoc(function($k,$v) {return "$v";},$arr))."\n";
    }

?>