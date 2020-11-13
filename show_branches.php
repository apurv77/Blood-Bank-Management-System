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
    <link rel="stylesheet" type="text/css" href="login.css">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    table
    {
        border:solid;
    }
    tr
    {
        border:solid;
    }
    th
    {
        border:solid;
    }
    td
    {
        border:solid;
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

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#"></a>
                    </li>
                    <li>
                        <a href="#"></a>
                    </li>
                    <li>
                        <a href="#"></a>
                    </li>
                    <li style="padding-left: 400px; font-size: 20px; color: white; padding-top: 12px;">
                        Login
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <br><BR><BR><BR>
                <div class="col-lg-12">
                    <table>
                        <tr>
                            <th>Branch-Id</th>
                            <th>Branch_Name</th>
                            <th>Address</th>
                            <th>Area</th>
                            <th>Phone</th>
                            <th>Email</th>
                        </tr>
                        <?php
                        include_once 'connection.php';
                        $sql="select * from branch";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc())
                        {
                            $bid=$row['b_id'];
                            $name = $row['b_name'];
                            $address = $row['address']; 
                            $area = $row['area']; 
                            $phone=$row['phone'];   
                            $email=$row['email'];
                            echo "<tr>";
                            echo "<td>" . $bid . "</td>";
                            echo "<td>" . $name . "</td>";
                            echo "<td>" . $address . "</td>";
                            echo "<td>" . $area . "</td>";
                            echo "<td>" . $phone . "</td>";
                            echo "<td>" . $email . "</td>";
                            echo "</tr>";
                        }
                        $conn->close();
                    ?>
                    </table>
                </div>
                
             
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
    <a href="addbranch.html" >Insert new Branch</a>
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
