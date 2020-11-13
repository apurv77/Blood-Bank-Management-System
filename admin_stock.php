<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registration</title>
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
            height: 35px;
        }

    </style>

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
                                <li class="has-sub"><a href="" title="Register ">Dashboard</a>
                                    <ul>
                                        <li><a href="admin_donor.php" title="Donor">Donor</a></li>
                                        <li><a href="admin_hospital.php" title="Hospital">Hospital</a></li>
                                        <li><a href="admin_branch.php" title="Stock">Branch</a></li>
                                        <li><a href="transfusion.php" title="Blood Transfusion">Blood Transfusion</a></li>
                                    </ul>
                                </li>
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
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <form class="formfield">
                    <br>
                    <BR>
                    <BR>
                    <BR>
                    <div class="col-lg-12">
                        <table>
                            <tr>
                                <th>Blood Group</th>
                                <th>Branch Id</th>
                                <th>RBC Amount</th>
                                <th>Platelets Amount</th>
                                <th>Plasma Amount</th>
                                <th>Whole-Blood Amount</th>
                            </tr>
                            <?php
                        include_once 'connection.php';
                       
                        $sql = "select * from stock order by blood_grp";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc())
                        {
                            $b_id = $row['b_id'];
                            $blood_grp = $row['blood_grp'];
                            $rbc_amt = $row['rbc_amt'];    
                            $plasma_amt =$row['plasma_amt'];
                            $platelets_amt = $row['platelets_amt'];
                            $whole_amt = $row['whole_amt'];
                            echo "<tr>";
                            echo "<td>" . $blood_grp . "</td>";
                            echo "<td>" . $b_id . "</td>";
                            echo "<td>" . $rbc_amt . "</td>";
                            echo "<td>" . $platelets_amt . "</td>";
                            echo "<td>" . $plasma_amt . "</td>";
                            echo "<td>" . $whole_amt . "</td>";
                            echo "</tr>";
                        }
                        $conn->close();
                    ?>
                        </table>
                    </div>
                    <div class="col-lg-12" style="text-align: left;font-size: 25px;margin-top: 40px;">
                        <a href="update_stock.html">Update Stock</a>
                    </div>
                </form>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
