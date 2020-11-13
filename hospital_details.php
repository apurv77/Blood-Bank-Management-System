<?php
    include_once ("connection.php");
    session_start();
    $type = $_SESSION['login_type'];
    $hp_id = $_SESSION['login_id'];

    if(!isset($_SESSION['login_id']))
    {
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header('Location: login.html');
    }

    

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="css/tables.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="css/form-elements.css">
    <link rel="stylesheet" href="css/wizard.css">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 0px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
   table, td, th {
    border: 1px solid black;
    text-align: center;
}
tr
{
    height: 35px;
}
p
    {
        font-size: 25px;
    }
    </style>

    <script type="text/javascript">
        function showForm2()
        {
            document.getElementById("table1").hidden = false;
            document.getElementById("form").hidden = true;
        }
        function showForm()
        {
            document.getElementById("table1").hidden = true;
            document.getElementById("form").hidden = false;
        }
    </script>
</head>

<body>

    <!-- Navigation -->
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                    <img src="images/logo_name.png" class="img-responsive" alt="LifeShare logo" />
                </div>
                <div class="col-lg-10 col-md-4 col-sm-12 col-xs-12">
                    <div class="navigation">
                        <div id="navigation">
                            <ul>
                                <li class=""><a href="#" onclick="showForm2();" title="Dashboard">Dashboard</a></li>
                                <li class=""><a href="#" onclick="showForm();" title="Request">Request Blood</a></li>
                                <li class=""><a href="logout.php" title="LogOut">Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
        <br>
            <div class="col-lg-12">
                <div class="col-lg-2">
                    
                </div>
                <div class="col-lg-8" id="table1" style="margin-top: 35px;">
                    <?php

                        $sql = "SELECT * FROM blood_request where hp_id='$hp_id' ORDER BY issuing_date desc";
                        $res = $conn->query($sql);
                        
                        echo "<table>";
                        echo "<tr><th> Sr. No.</th><th>Request ID</th><th>Platelets Amount</th><th>Plasma Amount</th><th>RBC Amount</th><th>Blood Group</th><th>Request Date</th><th>Total Price</th></tr>";

                        if($res->num_rows>0)
                        {
                            $sr = 0;
                            while($row = $res->fetch_assoc())
                            {
                                $sr++;
                                echo "<tr>";
                                echo "<td>".$sr."</td><td>".$row['req_no']."</td><td>".$row['platelets_amt']."</td><td>".$row['plasma_amt']."</td><td>".$row['rbc_amt']."</td><td>".$row['blood_grp']."</td><td>".$row['issuing_date']."</td><td>".$row['total_price']."</td>";
                                echo "</tr>";
                            }
                        }

                        echo "</table>";
                    ?>
                </div>
                <div class="col-lg-2">
                    
                </div>
            </div>
        
        <div class="col-lg-12">
        <div class="col-lg-3">
            
        </div>
        <div class="col-lg-6">
            <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" style="border:solid;" hidden>
            <br>
                <label>Blood Group</label><br>
                <input type="text" name="bdgrp"><br>
                <label>RBC Amount</label><br>
                <input type="number" name="rbc"><br>
                <label>Platelet Amount</label><br>
                <input type="number" name="platelet"><br>
                <label>Plasma Amount</label><br>
                <input type="number" name="plasma"><br><br>
                <label>Whole Blood Amount</label><br>
                <input type="number" name="whole"><br>
                <input type="submit" name="submit1" style="background-color: #f44336;box-shadow: 0 1px 4px black;border: none;height:35px;color: white;"><br><br>
            </form>
        </div>
        <div class="col-lg-3">
                    
        </div>
        </div>
            
        </div>
        <!-- row -->
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menumaker.js"></script>
    <!-- sticky header -->
    <script src="js/jquery.sticky.js"></script>
    <script src="js/sticky-header.js"></script>
    <script src="js/wizard.js"></script>

</body>

</html>

<?php
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

if(isset($_POST['submit1']))
{
$blood_grp=$_POST["bdgrp"];
$rbc_amount=$_POST["rbc"];
$platelets_amount=$_POST["platelet"];
$plasma_amount=$_POST["plasma"];
$whole_amount=$_POST["whole"];

$sql="select * from Hospital where hp_id=$hp_id";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$area=$row["area"];
$hosp_name=$row["h_name"];

$sql="select b_id from Branch where area='$area'";
/*$row=executeQuery($sql);*/
$result = $conn->query($sql);
$row=  $result->fetch_assoc();
$b_id=$row["b_id"];


$flag=0;
if($b_id!="")
{
  $sql="select rbc_amt,plasma_amt,platelets_amt,whole_amt from Stock where blood_grp='$blood_grp' and b_id='$b_id' and rbc_amt>$rbc_amount";
  $result = $conn->query($sql);
  $row=  $result->fetch_assoc();
  $rbc=$row["rbc_amt"];
  if($row!=0){
      if(($row["plasma_amt"]>$plasma_amount) and ($row["platelets_amt"]>$platelets_amount) and ($row["whole_amt"]>$whole_amount))
        $flag=1;
  }
}


if($flag!=1){
    
    $sql="select * from Stock where blood_grp='$blood_grp' and rbc_amt>$rbc_amount";
    $result = $conn->query($sql);
    while(1){
       if(!($row=  $result->fetch_assoc()))
         break;
       // $row=executeQuery($sql);
        if(($row["plasma_amt"]>$plasma_amount) and ($row["platelets_amt"]>$platelets_amount) and ($row["whole_amt"]>$whole_amount) )
            {
                 $b_id=$row["b_id"];
                 $flag=1;
            }
        if($flag==1)
             break;
  }
}


$total_price=0;
if($flag==1){
    
      $sql="select * from Stock_Price where  blood_grp='$blood_grp'";
       // $row=executeQuery($sql);
    $result = $conn->query($sql);
    $row=  $result->fetch_assoc();
      $total_price=$row["rbc_price"]*$rbc_amount+$row["platelets_price"]*$platelets_amount+$row["plasma_price"]*$plasma_amount+$row["whole_price"]*$whole_amount;

    

$result=$conn->query("select curdate()");
$row=$result->fetch_assoc();
$date=$row["curdate()"];


if($conn->query("insert into Blood_Request  (hp_id,platelets_amt,plasma_amt,rbc_amt,whole_amt,blood_grp,type,total_price,issuing_date,issuing_branch_id) values ($hp_id,$platelets_amount,$plasma_amount,$rbc_amount,$whole_amount,'$blood_grp','Hospital',$total_price,'$date',$b_id)"));
  
}
}

?>
