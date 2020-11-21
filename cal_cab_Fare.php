<?php 
/**
 * * PHP version 7.2.10
 * 
 * @category Components
 * @package  PackageName
 * @author   Sumit kumar Pandey <pandeysumit399@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://localhost/training/php%20task%202/html/products.php
 */
global $distance,$luggageprice;
$Location = $_REQUEST['Location'];
$Destination = $_REQUEST['Destination'];
$Cab = $_REQUEST['Cab'];
$luggage = $_REQUEST['Luggage'];
if ($luggage<=10) {
    $luggageprice = 50;
} elseif ($luggage>10 && $luggage<=20) {
    $luggageprice = 100;
} elseif ($luggage>20) {
    $luggageprice = 200;
} else {
    $luggageprice = 0; 
}
$cabdetail=array(
    array(
        "Charbagh"=>0,"Indira Nagar"=>10,"BBD"=>30,
        "Barabanki"=>60,
        "Faizabad"=>100,
        "Basti"=>150,
        "Gorakhpur"=>210
    )
);
if ($Cab=="1") {
    $fixedFare=50;
    foreach ($cabdetail as $key=>$value) {
        $price=13.50;
        $price1=(13.50*10);
        $price2=(12*50);
        $price3=(100*10.20);
        $price4=8.50;
        if ($key==$Location && $key==$Destination) {
            $distance = abs($value[$Location]-$value[$Destination]);
            if ($distance>0 && $distance<=10) {
                $totalFare=$fixedFare+($distance*$price);
            } elseif ($distance>10 && $distance<=50) {
                $totaldistance=12*($distance-10);
                $totalFare=$fixedFare+$totaldistance+$price1;
            } elseif ($distance>50 && $distance<=100) {
                $totaldistance=10.20*($distance-60);
                $totalFare=$fixedFare+$totaldistance+$price1+$price2;
            } elseif ($distance>100) {
                $totaldistance=$price4*($distance-160);
                $totalFare=$fixedFare+$totaldistance+$price1+$price2+$price3;
            }
            echo "<tr><td>".$Location."</td><td>".
            $Destination."</td><td>".$distance."</td><td>".$totalFare."</td></tr>";
        }
    }
}
if ($Cab=="2") {
    $fixedFare=150;
    foreach ($cabdetail as $key=>$value) {
        $price=14.50;
        $price1=(14.50*10);
        $price2=(13*50);
        $price3=(100*11.20);
        $price4=9.50;
        if ($key==$Location && $key==$Destination) {
            $distance = abs($value[$Location]-$value[$Destination]);
            if ($distance>0 && $distance<=10) {
                $totalFare=$fixedFare+($distance*$price)+$luggageprice;
            } elseif ($distance>10 && $distance<=50) {
                $totaldistance=13*($distance-10);
                $totalFare=$fixedFare+$totaldistance+$price1+$luggageprice;
            } elseif ($distance>50 && $distance<=100) {
                $totaldistance=11.20*($distance-60);
                $totalFare=$fixedFare+$totaldistance+$price1+$price2+$luggageprice;
            } elseif ($distance>100) {
                $totaldistance=$price4*($distance-160);
                $totalFare=$fixedFare+$totaldistance+$price1+$price2+$price3+$luggageprice;
            }
            echo "<tr><td>".$Location."</td><td>".
            $Destination."</td><td>".$distance."</td><td>".$totalFare."</td></tr>";
        }
    }
}
if ($Cab=="3") {
    $fixedFare=200;
    foreach ($cabdetail as $key=>$value) {
        $price=15.50;
        $price1=(15.50*10);
        $price2=(14*50);
        $price3=(100*12.20);
        $price4=10.50;
        if ($key==$Location && $key==$Destination) {
            $distance = abs($value[$Location]-$value[$Destination]);
            if ($distance>0 && $distance<=10) {
                $totalFare=$fixedFare+($distance*$price)+$luggageprice;
            } elseif ($distance>10 && $distance<=50) {
                $totaldistance=14*($distance-10);
                $totalFare=$fixedFare+$totaldistance+$price1+$luggageprice;
            } elseif ($distance>50 && $distance<=100) {
                $totaldistance=12.20*($distance-60);
                $totalFare=$fixedFare+$totaldistance+$price1+$price2+$luggageprice;
            } elseif ($distance>100) {
                $totaldistance=$price4*($distance-160);
                $totalFare=$fixedFare+$totaldistance+$price1+$price2+$price3+$luggageprice;
            }
            echo "<tr><td>".$Location."</td><td>".
            $Destination."</td><td>".$distance."</td><td>".$totalFare."</td></tr>";
        }
    }
}
if ($Cab=="4") {
    $fixedFare=250;
    foreach ($cabdetail as $key=>$value) {
        $price = 16.50;
        $price1=(16.50*10);
        $price2=(15*50);
        $price3=(100*13.20);
        $price4=11.50;
        if ($key==$Location && $key==$Destination) {
            $distance = abs($value[$Location]-$value[$Destination]);
            if ($distance>0 && $distance<=10) {
                $totalFare=$fixedFare+($distance*$price)+($luggageprice*2);
            } elseif ($distance>10 && $distance<=50) {
                $totaldistance=15*($distance-10);
                $totalFare=$fixedFare+$totaldistance+$price1+($luggageprice*2);
            } elseif ($distance>50 && $distance<=100) {
                $totaldistance=13.20*($distance-60);
                $totalFare=$fixedFare+$totaldistance+$price1+$price2+($luggageprice*2);
            } elseif ($distance>100) {
                $totaldistance=$price4*($distance-160);
                $totalFare=$fixedFare+$totaldistance+$price1+$price2+$price3+($luggageprice*2);
            }
            echo "<tr><td>".$Location."</td><td>".
            $Destination."</td><td>".$distance."</td><td>".$totalFare."</td></tr>";
        }
    }
}
?>