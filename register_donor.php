<?php
	$type = 'donor';
	$username=$pswd=$name=$bl_grp="";
	$d_id=$aadhar_no=0;
	function test_input($data)
	{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include_once 'connection.php';
    
    if (isset($_POST['submit1']))
	{
		$street = test_input($_POST['street']);
		$name = test_input($_POST['name']);
		$aadhar_no = test_input($_POST['aadhar_no']);
		$gender = test_input($_POST['gender']);
		$email = test_input($_POST['email']);
		$dob = date_create(test_input($_POST['dob']));

		$mobile = test_input($_POST['mobile']);
		$area = test_input($_POST['area']);
		$zip = test_input($_POST['zip']);

		$bl_grp = test_input($_POST['bl_grp']);

		$username = test_input($_POST['username']);
		$pswd = test_input($_POST['pswd']);
		$dob = date_format($dob,"Y-m-d");

		$stmt = $conn->prepare("INSERT INTO donor_details VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("isssisssi",$aadhar_no,$name,$dob,$gender,$mobile,$email,$area,$street,$zip);

		$stmt1 = $conn->prepare("INSERT INTO donor (blood_group,aadhar_no) VALUES (?,?)");
        $stmt1->bind_param("si",$bl_grp,$aadhar_no);

		if($stmt->execute() && $stmt1->execute())
		{
			$sql = "SELECT d_id FROM donor where aadhar_no ='$aadhar_no'";
			$res = $conn->query($sql);
			$row = $res->fetch_assoc();
			$d_id = $row['d_id'];
			$stmt2 = $conn->prepare("INSERT INTO user VALUES (?,?,?,?)");
			$stmt2->bind_param("sssi",$username,$pswd,$type,$d_id);

			if($stmt2->execute())
			{
				echo '<center style="margin-top:200px;"><h1>Registration Successful</h1></center>';
				echo '<center><a href="login.html"><input type="button" value="Go to login page" style="background-color: #f44336;box-shadow: 0 1px 4px black;border: none;height:35px;"></a></center>';
			}
            else
            {
                $stmt3 = $conn->prepare("DELETE FROM donor where d_id=?");
				$stmt3->bind_param("i",$d_id);
				$stmt3->execute();
                
                $stmt4 = $conn->prepare("DELETE FROM donor_details where aadhar_no=?");
				$stmt4->bind_param("i",$aadhar_no);
				$stmt4->execute();

				echo "<center><h1>Username already in use!</h1></center>";
            }
		}
		else
		{
			echo "<script>alert('Registration Failed')</script>";
		}
	}
?>
