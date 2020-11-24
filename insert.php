<?php
$firstname=$_POST['firstname'];
$lastname=$_POST['Lastname'];
$gender=$_POST['gender'];
$Username=$_POST['Username'];
$Password=$_POST['Password'];
$Phn_no=$_POST['Phn_no'];
$Email=$_POST['Email'];
if(!empty($firstname)|| !empty($lastname)|| !empty($gender)|| !empty($Username)|| !empty($Password)|| !empty($Phn_no)|| !empty($Email)){
      $host="localhost";
      $dbUsername="root";
      $dbPassword="";
      $dbname="authen";
      $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
      if(mysqli_connect_error())
      {
      	die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
      }else{
      	$SELECT ="SELECT email from regis Where Email=? Limit 1";
      	$INSERT="INSERT Into regis (firstname,Lastname,gender,Username,Password,Phn_no,Email) values(?,?,?,?,?,?,?)"
      	$stmt=$conn->prepare($SELECT);
      	$stmt->blind_param("s",$Email);
      	$stmt->store_result();
      	$rnum=$stmt->num_rows;
      	if($rnum==0)
      	{
      		$stmt->close();
      		$stmt->blind_param("sssssis",$firstname,$Lastname,$gender,$Username,$Password,$Phn_no,$Email);
      		$stmt->execute();
      		echo "New record inserted Sucessfully";
      	}else{
             echo "Someone Already register with this Email";
      	}
      }
}else{
	echo "All field are required";
	die();
}
/*
$conn=new mysqli('localhost','root','','authen');
if($conn->connect_error){
	die('Connection Failed  :  '.$conn->connect_error);
}else{
	$stmt=$conn->prepare("insert into regis(firstname,Lastname,gender,Username,Password,Phn_no,Email) values(?,?,?,?,?,?,?)");
	$stmt->blind_param("sssssis",$firstname,$Lastname,$gender,$Username,$Password,$Phn_no,$Email);
	$stmt->execute();
	echo "Successful";
	$stmt->close();
	$conn->close();
}*/
?>