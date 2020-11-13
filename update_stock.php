<?php
require_once ("connection.php");
$branch = $_POST["branch_name"];

$applate = $_POST["ap_plate"];
$anplate = $_POST["an_plate"];
$bpplate = $_POST["bp_plate"];
$bnplate = $_POST["bn_plate"];
$opplate = $_POST["op_plate"];
$onplate = $_POST["on_plate"];
$abpplate = $_POST["abp_plate"];
$abnplate = $_POST["abn_plate"];

$aprbc = $_POST["ap_rbc"];	
$anrbc = $_POST["an_rbc"];
$bprbc = $_POST["bp_rbc"];
$bnrbc = $_POST["bn_rbc"];
$oprbc = $_POST["op_rbc"];
$onrbc = $_POST["on_rbc"];
$abprbc = $_POST["abp_rbc"];
$abnrbc = $_POST["abn_rbc"];

$applasma = $_POST["ap_plasma"];
$anplasma = $_POST["an_plasma"];
$bpplasma = $_POST["bp_plasma"];
$bnplasma = $_POST["bn_plasma"];
$opplasma = $_POST["op_plasma"];
$onplasma = $_POST["on_plasma"];
$abpplasma = $_POST["abp_plasma"];
$abnplasma = $_POST["abn_plasma"];

$apwhole = $_POST["ap_plasma"];
$anwhole = $_POST["an_plasma"];
$bpwhole = $_POST["bp_plasma"];
$bnwhole = $_POST["bn_plasma"];
$opwhole = $_POST["op_plasma"];
$onwhole = $_POST["on_plasma"];
$abpwhole = $_POST["abp_plasma"];
$abnwhole = $_POST["abn_plasma"];

$sql = "UPDATE stock inner join branch on stock.b_id=branch.b_id
SET platelets_amt = platelets_amt + '$applate' , rbc_amt = rbc_amt + '$aprbc' , plasma_amt = plasma_amt + '$applasma' ,whole_amt=whole_amt+'$apwhole' 
WHERE blood_grp = 'A+' and b_name='$branch'";
echo $apwhole;

$sql1 = "UPDATE stock inner join branch on stock.b_id=branch.b_id
SET platelets_amt = platelets_amt + '$anplate' , rbc_amt = rbc_amt + '$anrbc' , plasma_amt = plasma_amt + '$anplasma' ,whole_amt=whole_amt+'$anwhole'
WHERE blood_grp = 'A-' and b_name='$branch'";

$sql2 = "UPDATE stock inner join branch on stock.b_id=branch.b_id
SET platelets_amt = platelets_amt + '$bpplate' , rbc_amt = rbc_amt + '$bprbc' , plasma_amt = plasma_amt + '$bpplasma' ,whole_amt=whole_amt+'$bpwhole'
WHERE blood_grp = 'B+' and b_name='$branch'";

$sql3 = "UPDATE stock inner join branch on stock.b_id=branch.b_id
SET platelets_amt = platelets_amt + '$bnplate' , rbc_amt = rbc_amt + '$bnrbc' , plasma_amt = plasma_amt + '$bnplasma' ,whole_amt=whole_amt+'$bnwhole'
WHERE blood_grp = 'B-' and b_name='$branch'";

$sql4 = "UPDATE stock inner join branch on stock.b_id=branch.b_id
SET platelets_amt = platelets_amt + '$opplate' , rbc_amt = rbc_amt + '$oprbc' , plasma_amt = plasma_amt + '$opplasma' ,whole_amt=whole_amt+'$opwhole'
WHERE blood_grp = 'O+' and b_name='$branch'";

$sql5 = "UPDATE stock inner join branch on stock.b_id=branch.b_id
SET platelets_amt = platelets_amt + '$opplate' , rbc_amt = rbc_amt + '$oprbc' , plasma_amt = plasma_amt + '$onplasma' ,whole_amt=whole_amt+'$onwhole'
WHERE blood_grp = 'O-' and b_name='$branch'";

$sql6 = "UPDATE stock inner join branch on stock.b_id=branch.b_id
SET platelets_amt = platelets_amt + '$abpplate' , rbc_amt = rbc_amt + '$abprbc' , plasma_amt = plasma_amt + '$abpplasma' ,whole_amt=whole_amt+'$abpwhole'
WHERE blood_grp = 'AB+' and b_name='$branch'";

$sql7 = "UPDATE stock inner join branch on stock.b_id=branch.b_id
SET platelets_amt = platelets_amt + '$abnplate' , rbc_amt = rbc_amt + '$abnrbc' , plasma_amt = plasma_amt + '$abnplasma' ,whole_amt=whole_amt+'$abnwhole'
WHERE blood_grp = 'AB-' and  b_name='$branch'";

mysqli_query($conn,$sql);
mysqli_query($conn,$sql1);	
mysqli_query($conn,$sql2);
mysqli_query($conn,$sql3);
mysqli_query($conn,$sql4);
mysqli_query($conn,$sql5);
mysqli_query($conn,$sql6);
mysqli_query($conn,$sql7);
echo '<center style="margin-top:200px;"><h1>Stock updated successfully</h1></center>';
				echo '<center><a href="index_admin.html";><input type="button" value="Go to Home" style="background-color: #f44336;box-shadow: 0 1px 4px black;border: none;height:35px;"></a></center>';
?>