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

      if($result = mysqli_query($conn,"select r.recommend_id, c.title, r.competition_id, r.team_reader_id, r.team_member1_id, r.team_member2_id, r.team_member3_id, r.team_member4_id from recommend r, competition c where r.team_reader_id = ".$mem_id." and r.competition_id = c.competition_id")){
        $row_num = mysqli_num_rows($result);

        echo "{\"sendteam\":[";
        $n = 1;
        while ($row = mysqli_fetch_array($result)) {
          echo "{\"recommend_id\":\"".$row["recommend_id"]."\",";
          echo "\"title\":\"".$row["title"]."\",";
          $member1 = mysqli_query($conn,"select name, state from request r, members m where r.receive_member_id = ".$row["team_member1_id"]." and r.recommend_id = ".$row["recommend_id"]." and r.competition_id = ".$row["competition_id"]." and r.send_member_id = ".$row["team_reader_id"]." and m.member_id = ".$row["team_member1_id"]);
          while($row1 = mysqli_fetch_array($member1)){
            echo "\"member1_name\":\"".$row1["name"]."\",";
            if($row1["state"] == "Y") echo "\"member1_state\":\"수락\",";
            else if($row1["state"] == "N") echo "\"member1_state\":\"거절\",";
            else if($row1["state"] == "S") echo "\"member1_state\":\"대기\",";
        }
          if($row["team_member2_id"]){
            $member2 = mysqli_query($conn,"select name, state from request r, members m where r.receive_member_id = ".$row["team_member2_id"]." and r.recommend_id = ".$row["recommend_id"]." and r.competition_id = ".$row["competition_id"]." and r.send_member_id = ".$row["team_reader_id"]." and m.member_id = ".$row["team_member2_id"]);
            while($row2 = mysqli_fetch_array($member2)){
              echo "\"member2_name\":\"".$row2["name"]."\",";
              if($row2["state"] == "Y") echo "\"member2_state\":\"수락\",";
              else if($row2["state"] == "N") echo "\"member2_state\":\"거절\",";
              else if($row2["state"] == "S") echo "\"member2_state\":\"대기\",";
          }
        }else{
          echo "\"member2_name\":\" \",";
          echo "\"member2_state\":\" \",";
        }
          if($row["team_member3_id"]){
            $member3 = mysqli_query($conn,"select name, state from request r, members m where r.receive_member_id = ".$row["team_member3_id"]." and r.recommend_id = ".$row["recommend_id"]." and r.competition_id = ".$row["competition_id"]." and r.send_member_id = ".$row["team_reader_id"]." and m.member_id = ".$row["team_member3_id"]);
            while($row3 = mysqli_fetch_array($member3)){
              echo "\"member3_name\":\"".$row3["name"]."\",";
              if($row3["state"] == "Y") echo "\"member3_state\":\"수락\",";
              else if($row3["state"] == "N") echo "\"member3_state\":\"거절\",";
              else if($row3["state"] == "S") echo "\"member3_state\":\"대기\",";
          }
        }else{
          echo "\"member3_name\":\" \",";
          echo "\"member3_state\":\" \",";
        }
          if($row["team_member4_id"]){
            $member4 = mysqli_query($conn,"select name, state from request r, members m where r.receive_member_id = ".$row["team_member4_id"]." and r.recommend_id = ".$row["recommend_id"]." and r.competition_id = ".$row["competition_id"]." and r.send_member_id = ".$row["team_reader_id"]." and m.member_id = ".$row["team_member4_id"]);
            while($row4 = mysqli_fetch_array($member4)){
              echo "\"member4_name\":\"".$row4["name"]."\",";
              if($row4["state"] == "Y") echo "\"member4_state\":\"수락\",";
              else if($row4["state"] == "N") echo "\"member4_state\":\"거절\",";
              else if($row4["state"] == "S") echo "\"member4_state\":\"대기\",";
          }
        }else{
          echo "\"member4_name\":\" \",";
          echo "\"member4_state\":\" \"";
        }
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
