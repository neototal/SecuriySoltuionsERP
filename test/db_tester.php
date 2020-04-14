<?php

echo 'start';

include_once '../Imports/DB/Database_conn.php';
$database_connction=  database();
for($i=0;$i<150;$i++){
   $sql="select * from main_category";
   $database_connction->query($sql);
    echo $i."<br>";
}

echo $database_connction->error;
echo 'end';