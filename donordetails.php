<?php
    session_start();
    include_once 'connection.php';
    $username1 = $_SESSION['username'];
    $password = $_SESSION['password'];
    $d_id = $_SESSION['login_id'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Donor Details</title>

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

        <!-- Custom CSS -->
        <style>
            body {
                padding-top: 0px;
                /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
            }

            table,
            td,
            th {
                border: 1px solid black;
                text-align: center;
            }

            tr {
                height: 45px;
            }

            p {
                font-size: 25px;
            }

            .que {
                text-align: center;
            }

        </style>

        <!-- Custom CSS -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    </head>

    <body>

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
                                    <li id="1" class="active2"><a onclick="dashboard();" title="Dashboard">Dashboard</a></li>
                                    <li id="2" class=""><a onclick="settings();" title="Account Settings">Account Settings</a></li>
                                    <li><a href="logout.php" title="Log Out">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Page Content -->
        <div id="dash" class="col-xs-10 col-xs-offset-1">
            <div class="row">
                <div class="col-md-5">
                    <h1>Profile</h1><br><br><br>
                    <table>
                        <?php
                            $sql = "select * from donor,donor_details,user where user.username = '$username1' and user.s_no = donor.d_id and donor.aadhar_no = donor_details.aadhar_no;";
                            $result = $conn->query($sql);

                            while($row = $result->fetch_assoc())
                            {
                                $name = $row['name'];
                                $aadhar = $row['aadhar_no'];
                                $dob = $row['dob'];
                                $gender = $row['gender'];
                                $mobile_no = $row['mobile_no'];
                                $email = $row['email'];
                                $area = $row['area'];
                                $street = $row['street'];
                                $pincode = $row['zip'];
                                $bd_grp = $row['blood_group'];
                                $last_donated = $row['last_donated'];

                                echo "<tr><td class='que'>Name</td><td>".$name."</td></tr>";
                                echo "<tr><td class='que'>Blood Group</td><td>".$bd_grp."</td></tr>";
                                echo "<tr><td class='que'>Aadhar no</td><td>".$aadhar."</td></tr>";
                                echo "<tr><td class='que'>Date of Birth</td><td>".$dob."</td></tr>";
                                echo "<tr><td class='que'>Gender</td><td>".$gender."</td></tr>";
                                echo "<tr><td class='que'>Mobile Number</td><td>".$mobile_no."</td></tr>";
                                echo "<tr><td class='que'>Email Address</td><td>".$email."</td></tr>";
                                echo "<tr><td class='que'>Area</td><td>".$area."</td></tr>";
                                echo "<tr><td class='que'>Street</td><td>".$street."</td></tr>";
                                echo "<tr><td class='que'>Pincode</td><td>".$pincode."</td></tr>";
                                echo "<tr><td class='que'>Last Donation Date</td><td>".$last_donated."</td></tr>";
                            }
                        ?>
                    </table>
                </div>
                <div class="col-md-7">
                    <h1>Donation History</h1><br><br><br>
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>RBC Amount</th>
                            <th>Platelets Amount</th>
                            <th>Plasma Amount</th>
                            <th>Whole-Blood Amount</th>
                        </tr>
                        <?php
                            $sql = "select * from blood_donated,donor,donor_details,user where user.s_no = donor.d_id and blood_donated.d_id = donor.d_id and donor.aadhar_no = donor_details.aadhar_no and username = '$username1'
                            order by dateofdonation desc;";
                            $result = $conn->query($sql);

                            while($row = $result->fetch_assoc())
                            {
                                $last_donated = $row['last_donated'];
                                $date = $row['dateofdonation'];
                                $rbc = $row['rbc_amt'];
                                $plate = $row['platelets_amt'];
                                $plasma = $row['plasma_amt'];
                                $plasma = $row['plasma_amt'];
                                $whole = $row['whole_amt'];
                                echo "<tr>";
                                echo "<td>".$date."</td>";
                                echo "<td>".$rbc."</td>";
                                echo "<td>".$plate."</td>";
                                echo "<td>".$plasma."</td>";
                                echo "<td>".$whole."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>

        <div id="setting" class="col-xs-10 col-xs-offset-1" style="display:none;">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <center>
                        <form method="post" action="">
                            <a href="delete_donor.php"><input type="button" name="delete1" value="Delete Account" style="background-color: #f44336;box-shadow: 0 1px 4px black;border: none;height:35px;color:white;"></a>
                        </form>
                    </center>
                </div>
            </div>
        </div>

        <!-- jQuery Version 1.11.1 -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <script>
            function settings() {
                $(document).ready(function() {
                    $('#1').removeClass("active2");
                    $('#2').addClass("active2");

                    $('#dash').hide();
                    $('#setting').fadeIn(100);
                });
            }

            function dashboard() {
                $(document).ready(function() {
                    $('#2').removeClass("active2");
                    $('#1').addClass("active2");

                    $('#dash').fadeIn(100);
                    $('#setting').hide();
                });
            }

        </script>

    </body>

    </html>

    <?php
        if(isset($_POST['delete1']))
        {
            $sql = "SELECT aadhar_no FROM donor where d_id='$d_id'";
			$res = $conn->query($sql);
			$row = $res->fetch_assoc();
			$aadhar_no = $row['aadhar_no'];
            
            $stmt1 = $conn->prepare("DELETE FROM donor where d_id=?");
            $stmt1->bind_param("i",$d_id);
            $stmt1->execute();
                
            $stmt2 = $conn->prepare("DELETE FROM donor_details where aadhar_no=?");
            $stmt2->bind_param("i",$aadhar_no);
            $stmt2->execute();
            
            $stmt3 = $conn->prepare("DELETE FROM user where username=?");
            $stmt3->bind_param("s",$username1);
            
            if($stmt3->execute())
                echo "Delete Successfull";
                header('Location: logout.php');
        }
?>
