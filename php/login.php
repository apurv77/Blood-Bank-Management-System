<?php
	session_start();
	function test_input($data)
	{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include_once ("connection.php");

	if (isset($_POST['submit1']))
	{
		if (empty($_POST['username']) || empty($_POST['password']))
		{
				echo "<center><h1>Username or Password is required</h1></center>";
		}
		else
		{
			$username=$_POST['username'];
			$password=$_POST['password'];

			//Prevent SQL injection
			$username = test_input($username);
			$password = test_input($password);

			$stmt = $conn->prepare("SELECT type, s_no FROM user WHERE password=? AND username=?");
			$stmt->bind_param("ss",$password,$username);
			if($stmt->execute())
			{	
				$stmt->store_result();
				if($stmt->num_rows == 1)
				{
					$stmt->bind_result($type,$id);
					$stmt->fetch();
					$_SESSION['login_type'] = $type;
					$_SESSION['login_id'] = $id;
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					if($type == 'donor')
					{
						header('Location: ../donordetails.php');
						die;
					}
					else if($type == 'hospital')
					{
						header('Location: ../hospital_details.php');
						die;
					}
					else if($type == 'admin')
					{
						header('Location: ../index_donor.html');
						die;
					}
				}
				else
				{
					echo "<center><h1>Username or Password is invalid</h1></center>";
				}
			}
			else
			{
				echo "<center><h1>Username or Password is invalid</h1></center>";
			}
		}
	}
?>
