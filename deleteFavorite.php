<?php
    header("Content-Type: text/html;charset=UTF-8");
    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include('dbcon.php');


    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {

        // 안드로이드 코드의 postParameters 변수에 적어준 이름을 가지고 값을 전달 받습니다.

        $member=$_POST['member_id'];
        $competition=$_POST['competition_id'];


        if(empty($member)){
            $errMSG = "멤버 번호을 입력하세요.";
        }
        else if(empty($competition)){
            $errMSG = "공모전 번호를 입력하세요.";
        }


        if(!isset($errMSG))// 이름과 나라 모두 입력이 되었다면
        {
            try{
                // SQL문을 실행하여 데이터를 MySQL 서버의 Members 테이블에 저장합니다.
                $stmt = $con->prepare('DELETE FROM Favorites WHERE member_id=:member AND competition_id=:competition ');
                $stmt->bindParam(':member', $member);
                $stmt->bindParam(':competition', $competition);

                if($stmt->execute())
                {
                    $successMSG = " 즐겨찾기를 삭제했습니다.";
                }
                else
                {
                    $errMSG = "즐겨찾기 삭제  에러";
                }

            } catch(PDOException $e) {
                die("PopDatabase error: " . $e->getMessage());
            }
        }
    }

    if (isset($errMSG)) echo $errMSG;
    if (isset($successMSG)) echo $successMSG;

	$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if( !$android )
    {

    }
?>
