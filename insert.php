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
        $name=$_POST['name'];
        $identify=$_POST['identify'];
        $password=$_POST['password'];
        $contact=$_POST['contact'];
        $address=$_POST['address'];
        $participation_count=$_POST['participation_count'];
        $mind=$_POST['mind'];
        $energy=$_POST['energy'];
        $nature=$_POST['nature'];
        $tactics=$_POST['tactics'];
        $ego=$_POST['ego'];
        $gender=$_POST['gender'];
        $age=$_POST['age'];
        $email=$_POST['email'];
        $hope_role=$_POST['hope_role'];
        $usertype=$_POST['usertype'];
        $latitude=$_POST['latitude'];
        $longitude=$_POST['longitude'];
        $field=$_POST['field'];
        $respon_field=$_POST['respon_field'];


        if(empty($member)){
            $errMSG = "멤버을 입력하세요.";
        }
        else if(empty($name)){
            $errMSG = "이름를 입력하세요.";
        }
        else if(empty($identify)){
            $errMSG = "아이디를 입력하세요.";
        }
        else if(empty($password)){
            $errMSG = "비밀번호를 입력하세요.";
        }

        if(!isset($errMSG))// 이름과 나라 모두 입력이 되었다면
        {
            try{
                // SQL문을 실행하여 데이터를 MySQL 서버의 Members 테이블에 저장합니다.
                $stmt = $con->prepare('INSERT INTO Members(member_id,name,identity,password,contact,address,participation_count,mind,energy,
                  nature,tactics,ego,gender,age,email,hope_role,usertype,latitude,longitude)
                 VALUES(:member, :name,:identity,:password,:contact,:address,:participation_count,:mind,:energy,
                  :nature,:tactics,:ego,:gender,:age,:email,:hope_role,:usertype,:latitude,:longitude)');
                $stmt->bindParam(':member', $member);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':identity', $identify);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':contact', $contact);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':participation_count', $participation_count);
                $stmt->bindParam(':mind', $mind);
                $stmt->bindParam(':energy', $energy);
                $stmt->bindParam(':nature', $nature);
                $stmt->bindParam(':tactics', $tactics);
                $stmt->bindParam(':ego', $ego);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':age', $age);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':hope_role', $hope_role);
                $stmt->bindParam(':usertype', $usertype);
                $stmt->bindParam(':latitude', $latitude);
                $stmt->bindParam(':longitude', $longitude);
            #    for($i=0;$i<count($field);$i++){
            #    $stmt2 = $con->prepare('INSERT INTO Member_interests(member_id,field_id) VALUES(:member,:field)');
            #    $stmt2->bindParam(':member', $member);
            #    $stmt2->bindParam(':field', $field[$i]);
            #    }
            #    for($j=0;$i<count($respon_field);$j++){
            #    $stmt2 = $con->prepare('INSERT INTO responsible(member_id,re_field_id) VALUES(:member,:re_field)');
            #    $stmt2->bindParam(':member', $member);
            #    $stmt2->bindParam(':re_field', $respon_field[$j]);
          #      }
                if($stmt->execute())
                {
                    $successMSG = "새로운 사용자를 추가했습니다.";
                }
                else
                {
                    $errMSG = "사용자 추가 에러";
                }

            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage());
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
