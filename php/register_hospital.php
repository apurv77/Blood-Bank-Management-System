<?php

	$type = 'hospital';

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

		$h_name = test_input($_POST['h_name']);
		$phone_no = test_input($_POST['phone_no']);
		$email = test_input($_POST['email']);
		$street = test_input($_POST['street']);
		$area = test_input($_POST['area']);
		$zip = test_input($_POST['zip']);

		$username = test_input($_POST['username']);
		$pswd = test_input($_POST['pswd']);

		$stmt = $conn->prepare("INSERT INTO hospital (h_name,phone_no,email,street,area,zip) VALUES (?,?,?,?,?,?)");
		$stmt->bind_param("sisssi",$h_name,$phone_no,$email,$street,$area,$zip);

		if($stmt->execute())
		{
			$sql = "SELECT hp_id FROM hospital where phone_no='$phone_no'";
			$res = $conn->query($sql);
			$row = $res->fetch_assoc();
			$hp_id = $row["hp_id"];

			$stmt2 = $conn->prepare("INSERT INTO user VALUES (?,?,?,?)");
			$stmt2->bind_param("sssi",$username,$pswd,$type,$hp_id);

			if($stmt2->execute())
			{
				echo "<center><h1>Registration Successful!</h1></center>";
				echo '<a href="login.html";><input type="button" value="Go to login page"></a>';
			}
			else
			{
				$stmt3 = $conn->prepare("DELETE FROM hospital where hp_id=?");
				$stmt3->bind_param("i",$hp_id);
				$stmt3->execute();

				echo "<center><h1>Username already in use!</h1></center>";
			}
		}
		else
		{
			echo "<script>alert('Registration Failed')</script>";
		}
	}
?>
