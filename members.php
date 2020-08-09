<?php
    header("Content-Type: text/html;charset=UTF-8");
    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include('dbcon.php');


    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    $conn = mysqli_connect("localhost", "root", "op330", "compdb");

    if($result = mysqli_query($conn,"select * from Members")){
      $row_num = mysqli_num_rows($result);

      echo "{\"memresult\":[";
      $n = 1;
      while ($row = mysqli_fetch_array($result)) {
        echo "{\"member_id\":\"".$row["member_id"]."\",";
        echo "\"name\":\"".$row["name"]."\",";
        echo "\"identity\":\"".$row["identity"]."\",";
        echo "\"password\":\"".$row["password"]."\",";
        echo "\"contact\":\"".$row["contact"]."\",";
        echo "\"address\":\"".$row["address"]."\"";

        echo "}";
        if($n < $row_num){
        echo ",";
        }
        $n++;
      }
      echo "]";
      echo "}";
    }

?>
