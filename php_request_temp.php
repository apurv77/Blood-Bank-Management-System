<?php

include_once ("connection.php");

/*function executeQuery($sql){
  global $conn;
  global $result,$row;
  $result = $conn->query($sql);
  $row=  $result->fetch_assoc();
  if ($result->num_rows>0)
    return $row;
  return 0;
}
*/

$hosp_name=$_POST["h_name"];
$blood_grp=$_POST["bd_grp"];
$rbc_amount=$_POST["rbc"];
$platelets_amount=$_POST["plate"];
$plasma_amount=$_POST["plasma"];
$whole_amount=$_POST["whole"];
$area=$_POST["area"];
$name=$_POST["name"];
$age=$_POST["age"];
$gender=$_POST["gender"];
$mobile=$_POST["mobileno"];
$zip=$_POST["pincode"];
$isdonor=$_POST["choice"];
$street=$_POST["street"];



$sql="select b_id from Branch where area='$area'";
/*$row=executeQuery($sql);*/
  $result = $conn->query($sql);
  $row=  $result->fetch_assoc();
$b_id=$row["b_id"];

$flag=0;
$sql="select rbc_amt,plasma_amt,platelets_amt from Stock where blood_grp='$blood_grp' and b_id='$b_id' and rbc_amt>$rbc_amount";
  $result = $conn->query($sql);
  $row=  $result->fetch_assoc();
  $rbc=$row["rbc_amt"];

if($row!=0){
	 if(($row["plasma_amt"]>$plasma_amount) and ($row["platelets_amt"]>$platelets_amount) and ($row["whole_amt"]>$whole_amount))
		$flag=1;
}



if($flag!=1){
  
  $sql="select * from Stock where blood_grp='$blood_grp' and rbc_amt>$rbc_amount";
  $result = $conn->query($sql);
  while(1){
     $row=  $result->fetch_assoc();
   // $row=executeQuery($sql);
     if(($row["plasma_amt"]>$plasma_amount) and ($row["platelets_amt"]>$platelets_amount) and ($row["whole_amt"]>$whole_amount))
      {
	     $b_id=$row["b_id"];
	     $flag=1;
      }
     if($flag==1)
	    break;
  }
}

$rbc=$plate=$plasma=0;
$total_price=0;
if($flag==1){
  
	$sql="select * from Stock_Price where  blood_grp='$blood_grp'";
	// $row=executeQuery($sql);
    $result = $conn->query($sql);
  $row=  $result->fetch_assoc();
  $rbc = $row["rbc_price"];
  $plate = $row["platelets_price"];
  $plasma = $row["plasma_price"];
  $whole = $row["whole_price"];
	$total_price=$row["rbc_price"]*$rbc_amount+$row["platelets_price"]*$platelets_amount+$row["plasma_price"]*$plasma_amount+$row["whole_price"]*$whole_amount;
}



$sql="INSERT INTO Patient_Hospital (hosp_name,street,area,zip) values ('$hosp_name','$street','$area','$zip')";
 if($conn->query($sql)==TRUE)
  
$sql="select s_no from patient_hospital where hosp_name='$hosp_name'";
/*$row=executeQuery($sql);*/
  $result = $conn->query($sql);
  $row=  $result->fetch_assoc();
$serial=$row["s_no"];


$result=$conn->query("select curdate()");
$row=$result->fetch_assoc();
$date=$row["curdate()"];


$sql="insert into patient_details (patient_name,age,hosp_id,isdonor,mobile,gender) values ('$name','$age','$serial','$isdonor','$mobile','$gender')";

if($conn->query($sql)==TRUE)
  

$last_id=$conn->insert_id;

if($conn->query("insert into Blood_Request  (platelets_amt,plasma_amt,rbc_amt,whole_amt,blood_grp,type,patient_id,total_price,issuing_date,issuing_branch_id) values ($platelets_amount,$plasma_amount,$rbc_amount,$whole_amount,'$blood_grp','Patient','$last_id',$total_price,'$date',$b_id)"))
  echo '<center style="margin-top:100px;"><h1>Request Successful</h1></center><br>';
  echo '<center><h3>Name of Patient : '.$name.'</h3></center>';
  echo '<center><h3>Blood Group     : '.$blood_grp.'</h3></center><br><br><br>';
    echo '<table>';
      echo "<tr>";
        echo "<th>Blood Component</th>";
        echo "<th>Price per Unit</th>";
        echo "<th>No. of Units Requested</th>";
      echo "</tr>";
      echo "<tr>";
        echo "<td>RBC</td>";
        echo "<td>".$rbc."</td>";
        echo "<td>".$rbc_amount."</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td>Platelets</td>";
        echo "<td>".$plate."</td>";
        echo "<td>".$platelets_amount."</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td>Plasma</td>";
        echo "<td>".$plasma."</td>";
        echo "<td>".$plasma_amount."</td>";
      echo "</tr>";
       echo "<td>Whole_Blood </td>";
        echo "<td>".$whole."</td>";
        echo "<td>".$whole_amount."</td>";
      echo "</tr>";
    echo '</table><br><br>';
    echo '<center><h3>Total Amount to Pay : '.$total_price.' Rs.</h3></center><br>';
        echo '<center><a href="index.html";><input type="button" value="Go to Home page" style="background-color: #f44336;box-shadow: 0 1px 4px black;border: none;height:35px;color:white;"></a></center>';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Request</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/tables.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css">
  <style>
    body {
        padding-top: 0px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    table
    {
      margin-left: 350px;
    width: 50%;
    }
    table, td, th {
    border: 1px solid black;
    text-align: center;

}
tr
{
    height: 35px;
}
    </style>
</head>
<body>

</body>
</html>