<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Donor Registration</title>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/form-elements.css">
    <link rel="stylesheet" href="css/wizard.css">

    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 0px;
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

    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 form-box">
                <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="f1" style="box-shadow: 0px 5px 20px #888888;">
                    <div class="f1-steps">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="25" data-number-of-steps="2" style="width: 25%;"></div>
                        </div>
                        <div class="f1-step active">
                            <div class="f1-step-icon"><i class="fa fa-file-text-o"></i></div>
                            <p>Blood Test</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-file-text-o"></i></div>
                            <p>Components</p>
                        </div>
                    </div>

                    <fieldset>
                        <div class="col-md-8 col-md-offset-2 col-xs-12">
                            <div class="form-group">
                                <label class="sr-only" for="f1-name">Blood_bag-no</label>
                                <input type="text" name="blood_bag" placeholder="Blood bag no" class="form-control" id="f1-name">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-name">Donor Id</label>
                                <input type="text" name="donor" placeholder="Donor Id" class="form-control" id="f1-name">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-name">Branch Id</label>
                                <input type="text" name="branch" placeholder="Branch Id" class="form-control" id="f1-name">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-dob">HIV</label>
                                <input type="text" name="hiv" placeholder="HIV" class="form-control" id="f1-dob">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-dob">HepB</label>
                                <input type="text" name="hepb" placeholder="hepatitis B" class="form-control" id="f1-dob">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-dob">HepC</label>
                                <input type="text" name="hepc" placeholder="Hepatitis C" class="form-control" id="f1-dob">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-dob">MP</label>
                                <input type="text" name="mp" placeholder="MP" class="form-control" id="f1-dob">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-dob">VDRL</label>
                                <input type="text" name="vdrl" placeholder="VRDL" class="form-control" id="f1-dob">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="f1-buttons">
                                <button type="button" class="btn btn-next">Next</button>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="col-md-8 col-md-offset-2 col-xs-12">
                            <div class="form-group">
                                <label class="sr-only" for="f1-name">Date</label>
                                <input type="date" name="date" placeholder="Date of donation" class="form-control" id="f1-name">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-username">Whole Blood</label>
                                <input type="text" name="whole" placeholder="Whole Blood" class="form-control" id="f1-whole">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-username">Red Blood Cells</label>
                                <input type="text" name="rbc" placeholder="RBC" class="form-control" id="f1-RBC">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-password">Platelets</label>
                                <input type="text" name="platelets" placeholder="Platelets" class="form-control" id="f1-platelets">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="f1-repeat-password">Plasma</label>
                                <input type="text" name="plasma" placeholder="Plasma" class="form-control" id="f1-plasma ">
                            </div>

                            <div class="f1-buttons ">
                                <button type="button " class="btn btn-previous ">Previous</button>
                                <input type="submit" name="submit1" class="btn btn-submit " value="Submit" style="min-width: 105px; height: 40px; background-color: #fe0000; margin: 0; padding: 0 20px; vertical-align: middle; border: 0; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 300; line-height: 40px; color: #fff; border-radius: 4px; text-shadow: none; -webkit-box-shadow: none; box-shadow: none; -webkit-transition: all .3s; transition: all .3s; ">
                            </div>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- jQuery Version 1.11.1 -->
        <script src="js/jquery.js "></script>
        <script src="js/wizard.js "></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js "></script>
        <?php
      include_once('connection.php');
      if(isset($_POST["submit1"]))
      {
        $blood_bag=$_POST["blood_bag"];
        $hiv=$_POST["hiv"];
        $hepb=$_POST["hepb"];
        $hepc=$_POST["hepc"];
        $mp=$_POST["mp"];
        $vdrl=$_POST["vdrl"];
        $rbc=$_POST["rbc"];
        $plasma=$_POST["plasma"];
        $platelets=$_POST["platelets"];
        $whole=$_POST["whole"];
        $branch=$_POST["branch"];
        $donor=$_POST["donor"];
        $date1=$_POST["date"];
        $date2=date("Y-m-d",strtotime($date1));
        $sql="select blood_group from donor where d_id='$donor'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $bg=$row["blood_group"];
        $sql="insert into blood_test values ('$blood_bag','$bg','$hiv','$hepb','$hepc','$mp','$vdrl',NULL)";
        $conn->query($sql);
        if($hiv=="neg" && $hepb=="neg" && $hepc=="neg" && $mp=="neg" && $vdrl=="neg")
        {
           $sql="insert into blood_donated (blood_grp,rbc_amt,platelets_amt,plasma_amt,whole_amt,d_id,dateofdonation,validity,b_id) values ('$bg','$rbc','$platelets','$plasma','$whole','$donor','$date2',1,'$branch')";
           $conn->query($sql);
             
           $id=$conn->insert_id;
           $sql="update blood_test set donate_id=$id where bag_no=$blood_bag ";
           $conn->query($sql); 
        }
        
      }
      ?>
