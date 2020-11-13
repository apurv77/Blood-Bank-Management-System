<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registration</title>

    <!-- Bootstrap Core CSS -->
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
                                <li class="active"><a href="index.html" title="Home">Home</a></li>
                                <li class=""><a href="about_us.html" title="About">About</a></li>
                                <li><a href="contact_page.php" title="Contact Us">Contact us</a> </li>
                                <li class="has-sub"><a href="" title="Register ">Register</a>
                                    <ul>
                                        <li><a href="donor.html" title="Donor">As Donor</a></li>
                                        <li><a href="Hospital.html" title="Hospital">As Hospital</a></li>
                                    </ul>
                                </li>
                                <li><a href="patient_request.html" title="Log In">Blood Request</a>
                                </li>
                                <li><a href="donor_search.html" title="Log In">Search Donor</a>
                                </li>
                                <li><a href="login.html" title="Log In">Log in</a>
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
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Blood Group</th>
                                <th>Area</th>
                            </tr>
                            <?php
                        include_once 'connection.php';
                        $bd_grp =$_POST['bd_grp'];
                        $area = $_POST['area'];
                        $sql = "select * from donor,donor_details where donor.aadhar_no = donor_details.aadhar_no and donor.blood_group = '$bd_grp' and donor_details.area = '$area';";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc())
                        {
                            $name = $row['name'];
                            $mobile = $row['mobile_no'];    
                            echo "<tr>";
                            echo "<td>" . $name . "</td>";
                            echo "<td>" . $mobile . "</td>";
                            echo "<td>" . $bd_grp . "</td>";
                            echo "<td>" . $area . "</td>";
                            echo "</tr>";
                        }
                        $conn->close();
                    ?>
                        </table>
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
