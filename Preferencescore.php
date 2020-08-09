<?php
    header("Content-Type: text/html;charset=UTF-8");
    error_reporting(E_ALL);
    ini_set('display_errors',1);

    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {

      // 안드로이드 코드의 postParameters 변수에 적어준 이름을 가지고 값을 전달 받습니다.

      $member_id = $_POST['member_id'];
      // 변수 내용 확인 내용이 없으면 no id를 저장
      if ($member_id == "") $member_id = "no id";
      // test.py에 id 값을 전달하여 실행
      $result = exec("C:\Users\user\Anaconda3\python test.py $member_id");

      if($result == null) $result = "no result";
      // 변수 내용 출력
      echo $result;
    }

    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

      if( !$android )
      {

      }
?>
