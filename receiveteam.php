<?php
    header("Content-Type: text/html;charset=UTF-8");
    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include('dbcon.php');

    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {

      $conn = mysqli_connect("localhost", "root", "op330", "compdb");

      $mem_id = $_POST['member_id'];

      if($result = mysqli_query($conn,"select r.recommend_id, c.title, r.competition_id, r.send_member_id from request r, competition c where r.receive_member_id = ".$mem_id." and r.competition_id = c.competition_id")){
        $row_num = mysqli_num_rows($result);

        echo "{\"receiveteam\":[";
        $n = 1;
        while ($row = mysqli_fetch_array($result)) {
          echo "{\"recommend_id\":\"".$row["recommend_id"]."\",";
          $reader = mysqli_query($conn,"select name from members m where m.member_id = ".$row["send_member_id"]);
          while($row1 = mysqli_fetch_array($reader)){
            echo "\"team_reader_name\":\"".$row1["name"]."\",";
          }
          $recommend = mysqli_query($conn,"select * from recommend r where r.recommend_id = ".$row["recommend_id"]);
          while($rrow = mysqli_fetch_array($recommend)){
            $num = 1;
            if(isset($rrow["team_member1_id"])){
              if($rrow["team_member1_id"] != $mem_id){
                $member1 = mysqli_query($conn,"select name from members m where m.member_id = ".$rrow["team_member1_id"]);
                while($rowm1 = mysqli_fetch_array($member1)){
                  echo "\"team_member".$num."_name\":\"".$rowm1["name"]."\",";
                  $num++;
                }
              }
            }else{
              echo "\"team_member".$num."_name\":\" \",";
              $num++;
            }
            if(isset($rrow["team_member2_id"])){
              if($rrow["team_member2_id"] != $mem_id){
                $member2 = mysqli_query($conn,"select name from members m where m.member_id = ".$rrow["team_member2_id"]);
                while($rowm2 = mysqli_fetch_array($member2)){
                  echo "\"team_member".$num."_name\":\"".$rowm2["name"]."\",";
                  $num++;
                }
              }
            }else{
              echo "\"team_member".$num."_name\":\" \",";
              $num++;
            }
            if(isset($rrow["team_member3_id"])){
              if($rrow["team_member3_id"] != $mem_id){
                $member3 = mysqli_query($conn,"select name from members m where m.member_id = ".$rrow["team_member3_id"]);
                while($rowm3 = mysqli_fetch_array($member3)){
                  echo "\"team_member".$num."_name\":\"".$rowm3["name"]."\",";
                  $num++;
                }
              }
            }else{
              echo "\"team_member".$num."_name\":\" \",";
              $num++;
            }
            if(isset($rrow["team_member4_id"])){
              if($rrow["team_member4_id"] != $mem_id){
                $member4 = mysqli_query($conn,"select name from members m where m.member_id = ".$rrow["team_member4_id"]);
                while($rowm4 = mysqli_fetch_array($member4)){
                  echo "\"team_member".$num."_name\":\"".$rowm4["name"]."\",";
                  $num++;
                }
              }
            }else{
              echo "\"team_member".$num."_name\":\" \",";
              $num++;
            }
          }

          echo "\"title\":\"".$row["title"]."\"";

          echo "}";
          if($n < $row_num){
          echo ",";
          }
          $n++;
        }
      echo "]";
      echo "}";
    }
  }

  $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if( !$android )
    {

    }

?>
