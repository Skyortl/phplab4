<?php
    include_once('index.php');
    define('DATA_DIR_PATH',$_SERVER["DOCUMENT_ROOT"].'/phplab4/data/');
    echo '<link rel="stylesheet" href="../styles/showCars.css">';
        define('CARS_TXT_PATH',DATA_DIR_PATH.'cars.txt');
        try {
            if(!is_dir(DATA_DIR_PATH))
                mkdir(DATA_DIR_PATH, 0777,true);
            $carsDataFile = fopen(CARS_TXT_PATH, 'r');
            echo (String)$carsFileSize;
            $carsFileSize = filesize(CARS_TXT_PATH);
            if($carsFileSize) {
                $carsDataContent = fread($carsDataFile, $carsFileSize);
                $carRecords = explode("\n", $carsDataContent);
                echo '<table class="table border-bottom"
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Model</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($carRecords as $key => $carRecord) {
                    $car = explode(':', $carRecord);
                    if($car[0])
                    echo '<tr>
                            <form action="deleteCar.php" method="GET">
                                <th scope="row">'.(++$key).'</th> 
                                <td><input class="table-input" type="text" name="brand" value="'.$car[0].'" readonly/></td>
                                <td><input class="table-input" type="text" name="model" value="'.$car[1].'" readonly/></td>
                                <td><input class="table-input" type="number" name="price" value="'.$car[2].'" readonly/></td>
                                <td><input class="btn btn-warning float-right" type="submit" value="Delete"/></td>
                            </form>
                         </tr>';
                }
                echo '</tbody>
                    </table>';
            }
            else
                echo '<h2>Add at least one car to see it!</h2>';
            fclose($carsDataFile);
        } catch (\Throwable $th) {
            echo '<script type="text/javascript">alert("Can\'t save your car..")</script>';
        }
?>