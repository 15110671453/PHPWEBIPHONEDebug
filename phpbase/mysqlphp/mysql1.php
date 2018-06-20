<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/4/20
 * Time: 下午3:48
 */

$host = '127.0.0.1';

$port='3306';

$socket='';

$user = 'root';

$password ='asd1453NMDmysql';

$dbname = 'employees';

$con = new mysqli($host,$user,$password,$dbname,$port,$socket) or die('Could not connect to the database server '.mysqli_connect_error());

echo 'connect to employees database successfully';

echo  '<br/>';

echo 'select '.'* from departments';
echo '<br/>';

$query = "select * from departments";



if ($stmt = $con->prepare($query)){

    $stmt->execute();

    $stmt->bind_result($field1,$field2);

    while ($stmt->fetch()){
        printf("%s,%s\n",$field1,$field2);
        echo '<br/>';
    }
    $stmt -> close();
}


$con->close();

