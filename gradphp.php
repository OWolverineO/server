<?php
$conn = mysqli_connect("localhost", "root", "op330", "compdb");

$result = mysqli_query($conn,"select * from competition");
echo "{\"compresult\":[";
$n = 1;
$total_rows = mysqli_num_rows($result);
while ($row = mysqli_fetch_array($result)) {
echo "{\"competition_id\":\"".$row["competition_id"]."\",";
echo "\"title\":\"".$row["title"]."\",";
echo "\"host\":\"".$row["host"]."\",";
echo "\"support\":\"".$row["support"]."\",";
echo "\"period_start\":\"".$row["period_start"]."\",";
echo "\"period_end\":\"".$row["period_end"]."\",";
echo "\"total_money\":\"".$row["total_money"]."\",";
echo "\"first_place_money\":\"".$row["first_place_money"]."\",";
echo "\"homepage\":\"".$row["homepage"]."\",";
echo "\"poster_id\":\"".$row["poster_id"]."\",";
$cfquery = mysqli_query($conn,"select c.competition_id,f.field_classification from competition c, field f, competition_field cf where c.competition_id=".$row["competition_id"]." and c.competition_id=cf.competition_id and cf.field_id=f.field_id");
$field = "";
$field_rows = mysqli_num_rows($cfquery);
$n2 = 1;
while($row2 = mysqli_fetch_array($cfquery)){
  $field = $field.$row2["field_classification"];
  if($n2 < $field_rows){
    $field = $field.",";
  }
  $n2++;
}
echo "\"field\":\"".$field."\",";
$caquery = mysqli_query($conn,"select c.competition_id,a.application_classification from competition c, application a, competition_application ca where c.competition_id=".$row["competition_id"]." and c.competition_id=ca.competition_id and ca.application_id=a.application_id");

$application = "";
$application_rows = mysqli_num_rows($caquery);
$n3 = 1;
while($row3 = mysqli_fetch_array($caquery)){
  $application = $application.$row3["application_classification"];
  if($n3 < $application_rows){
    $application = $application.",";
  }
  $n3++;
}
echo "\"application\":\"".$application."\",";


$chquery = mysqli_query($conn,"select title,host_classification from competition c, competition_host ch, organizer o where c.competition_id=".$row["competition_id"]." and c.competition_id=ch.competition_id and ch.host_code_id=o.host_code_id");
$host = "";
$host_rows = mysqli_num_rows($chquery);
$n4=1;
while($row4 = mysqli_fetch_array($chquery)){
  $host = $host.$row4["host_classification"];
  if($n4 < $host_rows){
    $host = $host.",";
  }
  $n4++;
}
echo "\"competition_host\":\"".$host."\",";

$cffquery = mysqli_query($conn,"select c.competition_id,f.member_id from competition c, Favorites f where c.competition_id=".$row["competition_id"]." and c.competition_id=f.competition_id ");
$favorite = "";
$favorite_rows = mysqli_num_rows($cffquery);
$n5=1;
while($row5 = mysqli_fetch_array($cffquery)){
  $favorite = $favorite.$row5["member_id"];
  if($n5 < $favorite_rows){
    $favorite = $favorite.",";
  }
  $n5++;
}
echo "\"member_favorite\":\"".$favorite."\"";




echo "}";
if($n < $total_rows){
echo ",";
}
$n++;
}
echo "]";

$result2 = mysqli_query($conn,"select * from poster");
$cnt = 0;
$arr = array();
while($row = mysqli_fetch_array($result2)){
 $count = $cnt;
 $arr[$count]["poster_id"] = $row[0];
 $arr[$count]["poster_jpg"]=base64_encode($row[1]);
 $cnt++;
}
echo ",\"poster\":".json_encode($arr);
echo "}";
mysqli_close($conn);
?>
