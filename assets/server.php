<?php
	session_start();
	$default_usericon = "default.png";
	$rows_per_page = 5;
	/*$mail_server = "support@territorymap.com";*/

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "territorymap";
 	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

	if(isset($_REQUEST["request"]))
	{
		$request = $_REQUEST["request"];

		if($request == "updatesalesperson")
		{
			$id = $_REQUEST["id"];
			$sp_name = $_REQUEST["sp_name"];
			$sp_phone = $_REQUEST["sp_phone"];
			$sp_address = $_REQUEST["sp_address"];
			$sp_fax = $_REQUEST["sp_fax"];
			$sp_email = $_REQUEST["sp_email"];
			$sp_note = $_REQUEST["sp_note"];
			$sp_manager = $_REQUEST["sp_manager"];
			$sp_level = $_REQUEST["sp_level"];
			$sp_color = $_REQUEST["sp_color"];
			$sp_area = $_REQUEST["sp_area"];

			$result = $conn->query("select count(*) as total from tp_salesperson where sp_email='$sp_email' AND id!='$id'");
			$data = $result->fetch_assoc();
			if($data["total"] != 0)
			{
				echo "double";
			}
			else
			{
				$query = "update tp_salesperson set sp_name='$sp_name', sp_phone='$sp_phone', sp_address='$sp_address', sp_fax='$sp_fax', sp_email='$sp_email', sp_note='$sp_note', sp_manager='$sp_manager', sp_level='$sp_level', sp_color='$sp_color', sp_area='$sp_area' where id='$id'";
				$result = $conn->query($query);
				if($result)
					echo "success";
				else
					echo "failed";
			}
		}

		else if($request == "getsalesperson")
		{
			$id = $_REQUEST["id"];

			$data = array();
			$query = "select id,sp_name from tp_salesperson where sp_level='Sales Manager'";
			$result = $conn->query($query);
			while($row = $result->fetch_array())
			{
				array_push($data, $row);
			}

			$query = "select * from tp_salesperson where id=$id";
			$result = $conn->query($query);
			$row = $result->fetch_array();
			echo json_encode( array("salesperson" => $row, "salesmanager" => $data) );
		}

		else if($request == "removesalesperson")
		{
			$id = $_REQUEST["id"];

			$query = "delete from tp_salesperson where id=$id";
			$result = $conn->query($query);
			if($result)
				echo "success";
			else
				echo "failed";
		}

		else if($request == "getdata")
		{
			$territory = $_REQUEST["territory"];

			if($territory == "")
				$query = "SELECT t1.*, IFNULL(t2.sp_name,'') as salesmanager FROM (SELECT * FROM tp_salesperson WHERE sp_level='Distributor') t1 LEFT JOIN (SELECT id,sp_name FROM tp_salesperson WHERE sp_level='Sales Manager') t2 ON t1.sp_manager = t2.id ORDER BY t1.sp_name";
			else if($territory == "all")
				$query = "SELECT t1.*, IFNULL(t2.sp_name,'') as salesmanager FROM (SELECT * FROM tp_salesperson) t1 LEFT JOIN (SELECT id,sp_name FROM tp_salesperson WHERE sp_level='Sales Manager') t2 ON t1.sp_manager = t2.id ORDER BY t1.sp_level, t1.sp_name";
			else	
				$query = "SELECT t1.*, IFNULL(t2.sp_name,'') as salesmanager FROM (SELECT * FROM tp_salesperson WHERE sp_level!='Sales Manager' AND sp_area like '%$territory%') t1 LEFT JOIN (SELECT id,sp_name FROM tp_salesperson WHERE sp_level='Sales Manager') t2 ON t1.sp_manager = t2.id ORDER BY t1.sp_level, t1.sp_name";
			$result = $conn->query($query);
			$data = array();
			while($row = $result->fetch_array())
			{
				array_push($data, $row);
			}
			echo json_encode($data);
		}

		else if($request == "addsalesperson")
		{
			$sp_name = $_REQUEST["sp_name"];
			$sp_phone = $_REQUEST["sp_phone"];
			$sp_address = $_REQUEST["sp_address"];
			$sp_fax = $_REQUEST["sp_fax"];
			$sp_email = $_REQUEST["sp_email"];
			$sp_note = $_REQUEST["sp_note"];
			$sp_level = $_REQUEST["sp_level"];
			$sp_color = $_REQUEST["sp_color"];
			$sp_area = $_REQUEST["sp_area"];

			$result = $conn->query("select count(*) as total from tp_salesperson where sp_email='$sp_email'");
			$data = $result->fetch_assoc();
			if($data["total"] != 0)
			{
				echo "double";
			}
			else
			{
				$result = $conn->query("insert into tp_salesperson(sp_name,sp_phone,sp_address,sp_fax,sp_email,sp_note,sp_level,sp_color,sp_area) values('$sp_name','$sp_phone','$sp_address','$sp_fax','$sp_email','$sp_note','$sp_level','$sp_color','$sp_area')");
				if($result)
					echo "success";
				else
					echo "failed";
			}
		}

		/*else if($request == "forgotpassword")
		{
			$mail = $_REQUEST["mail"];
			$query = "select * from tp_users where user_email = '$mail'";
	        $result = $conn->query($query);
	        if ($result->num_rows > 0) 
	        {
	        	$verifycode = random_int(10000000, 99999999);
	        	$query = "update tp_users set verifycode='$verifycode' where user_email = '$mail'";
	        	$conn->query($query);
	        	$row = $result->fetch_assoc(); 
	        	
				$from = $mail_server;
			    $to = $mail;
			    $subject = "Reset password for ".$row["user_firstname"]." ".$row["user_lastname"];
			    $message = "Please use this verify code to reset your password. Verify Code: ".$verifycode;
			    $headers = "From:" . $from;
			    mail($to,$subject,$message, $headers);
				echo 'success';
	        }
	        else
	        	echo "no";
		}

		else if($request == "changepassword")
		{
			$mail = $_REQUEST["mail"];
			$verifycode = $_REQUEST["verifycode"];
			$pass = md5($_REQUEST["pass"]);
			$query = "select * from tp_users where user_email = '$mail' AND verifycode='$verifycode'";
	        $result = $conn->query($query);
	        if ($result->num_rows > 0) 
	        {
	        	$query = "update tp_users set user_pass='$pass' where user_email = '$mail'";
	        	$conn->query($query);
	        	echo 'success';
	        }
	        else
	        {
	        	echo "wrongcode";
	        }
		}*/

		else if($request == "userlogin")
		{
			$userlogin = $_REQUEST["username"];
			$password = md5($_REQUEST["userpassword"]);
			$query = "select * from tp_users where user_login='$userlogin' AND user_pass='$password'";
			$result = $conn->query($query);
			if($row = $result->fetch_array())
			{
				if($row["user_status"] == "Approved")
				{
					$_SESSION["firstname"]= $row["user_firstname"];
					$_SESSION["lastname"]= $row["user_lastname"];
					$_SESSION["userrole"]= $row["user_role"];
					$_SESSION["username"]= $userlogin;
					$_SESSION["usericon"]= $row["user_icon"];
					$_SESSION["islogged"]= true;
				}
				echo $row["user_status"];
			}
			else
				echo "failed";
		}

		else if($request == "register")
		{
			$firstname = $_REQUEST["firstname"];
			$lastname = $_REQUEST["lastname"];
			$username = $_REQUEST["username"];
			$email = $_REQUEST["email"];
			$password = md5($_REQUEST["password"]);

			$result = $conn->query("select count(*) as total from tp_users where user_login='$username' OR user_email='$email'");
			$data = $result->fetch_assoc();
			if($data["total"] != 0)
			{
				echo "double";
			}
			else
			{
				$date = date("Y-m-d");
				$result = $conn->query("insert into tp_users(user_login,user_firstname,user_lastname,user_email,user_pass,user_registered) values('$username','$firstname','$lastname','$email','$password','$date')");
				if($result)
					echo "success";
				else
					echo "failed";
			}
		}

		else if($request == "userlogout")
		{
			session_unset();
		}

		else if($request == "userupdate")
		{
			$oldpassword = md5($_REQUEST["oldpassword"]);
			$newusername = $_REQUEST["newusername"];
			$newfirstname = $_REQUEST["newfirstname"];
			$newlastname = $_REQUEST["newlastname"];
			$newemail = $_REQUEST["newemail"];
			$newpassword = md5($_REQUEST["newpassword"]);
			$oldusername = $_SESSION["username"];

			$result = $conn->query("select count(*) as total from tp_users where (user_login='$newusername' OR user_email='$newemail') AND user_login!='$oldusername'");
			$data = $result->fetch_assoc();
			if($data["total"] != 0)
			{
				echo "double";
			}
			else
			{
				$setphrase = "";
				if($newusername != "")
					$setphrase = "user_login='$newusername'";
				else
					$setphrase = "user_login='$oldusername'";
				if($newemail != "")
					$setphrase = $setphrase . ",user_email='$newemail'";
				if($newfirstname != "")
					$setphrase = $setphrase . ",user_firstname='$newfirstname'";
				if($newlastname != "")
					$setphrase = $setphrase . ",user_lastname='$newlastname'";
				if($_REQUEST["newpassword"] != "")
					$setphrase = $setphrase . ",user_pass='$newpassword'";
				$query = "update tp_users set ".$setphrase." where user_login='$oldusername' AND user_pass='$oldpassword'";
				$result = $conn->query($query);
				if($result)
				{
					if($newusername != "")
						$_SESSION["username"] = $newusername;
					if($newfirstname != "")
						$_SESSION["firstname"] = $newfirstname;
					if($newlastname != "")
						$_SESSION["lastname"] = $newlastname;
					echo "success";
				}
				else
				{
					echo "failed";
				}
			}
		}

		else if($request == "changeusericon")
		{
			if ($_FILES["usericon"]["error"] == UPLOAD_ERR_OK)
			{
			    $file = $_FILES["usericon"]["tmp_name"];
			    $filename = $_FILES["usericon"]["name"];
			    $extension = explode(".", $filename)[1];
			    $filesize = $_FILES['usericon']['size'];
			    if(isset($_REQUEST["username"]))
			    	$username = $_REQUEST["username"];
			    else
			    	$username = $_SESSION["username"];
			    $filename = md5(time()) . "." . $extension;
			    $data = array();
			    if((strtolower($extension) != "png") && (strtolower($extension) != "jpg"))
			    {
			    	$data["result"] = "formaterror";
			    }
			    else if($filesize / 1024 / 1024 > 5)
			    {
			    	$data["result"] = "sizeerror";
			    }
			    else
			    {
			    	$query = "select * from tp_users where user_login='$username'";
			    	$result = $conn->query($query);
					if($row = $result->fetch_array())
					{
						$oldusericon = $row["user_icon"];
						$query = "update tp_users set user_icon='$filename' where user_login='$username'";
						$result = $conn->query($query);
						if($result)
						{
							if($oldusericon != $default_usericon)
								unlink("./images/users/" . $oldusericon);
							move_uploaded_file( $file, "./images/users/" . $filename);
							$_SESSION["usericon"] = $filename;
							$data["result"] = "success";
				    		$data["filename"] = $filename;
				    	}
						else
						{
							$data["result"] = "dberror";
						}
					}
					else
					{
						$data["result"] = "dberror";
					}
			    }
			    echo json_encode($data);
			}
		}
		
		else if($request == "removeuserarray")
		{
			$ids = $_REQUEST["ids"];
			$ids_string = "";
			for ($i=0; $i < count($ids); $i++) { 
				if($i == 0)
					$ids_string = $ids[$i];
				else
					$ids_string = $ids_string . "," . $ids[$i];
			}
			$query = "delete from tp_users where id IN ($ids_string)";
			$result = $conn->query($query);
			if($result)
				echo "success";
			else
				echo "failed";
		}		

		else if($request == "approveuserarray")
		{
			$ids = $_REQUEST["ids"];
			$today = date("Y-m-d");	
			$ids_string = "";
			for ($i=0; $i < count($ids); $i++) { 
				if($i == 0)
					$ids_string = $ids[$i];
				else
					$ids_string = $ids_string . "," . $ids[$i];
			}
			$query = "update tp_users set user_status='Approved' where id IN ($ids_string)";
			$result = $conn->query($query);
			if($result)
				echo "success";
			else
				echo "failed";
		}

		else if($request == "pendinguserarray")
		{
			$ids = $_REQUEST["ids"];
			$ids_string = "";
			for ($i=0; $i < count($ids); $i++) { 
				if($i == 0)
					$ids_string = $ids[$i];
				else
					$ids_string = $ids_string . "," . $ids[$i];
			}
			$query = "update tp_users set user_status='Pending' where id IN ($ids_string)";
			$result = $conn->query($query);
			if($result)
				echo "success";
			else
				echo "failed";
		}

		else if($request == "deleteuserarray")
		{
			$ids = $_REQUEST["ids"];
			$ids_string = "";
			for ($i=0; $i < count($ids); $i++) { 
				if($i == 0)
					$ids_string = $ids[$i];
				else
					$ids_string = $ids_string . "," . $ids[$i];
			}
			$query = "update tp_users set user_status='Deleted' where id IN ($ids_string)";
			$result = $conn->query($query);
			if($result)
				echo "success";
			else
				echo "failed";
		}

		else if($request == "updateuserarray")
		{
			$data = json_decode($_REQUEST["data"]);
			$success = "success";
			for ($i=0; $i < count($data); $i++) { 
				$row = $data[$i];

				$id = $row->id;
				$username = $row->username;
				$firstname = $row->firstname;
				$lastname = $row->lastname;
				$email = $row->email;
				$role = $row->role;
				
				$query = "update tp_users set user_login='$username', user_firstname='$firstname', user_lastname='$lastname', user_email='$email', user_role='$role' where id='$id'";
				$result = $conn->query($query);
				if(!$result)
				{
					$success = "failed";
					break;
				}
			}
			echo $success;
		}		

		else if($request == "addnewuser")
		{
			$firstname = $_REQUEST["firstname"];
			$lastname = $_REQUEST["lastname"];
			$username = $_REQUEST["username"];
			$email = $_REQUEST["email"];
			$password = md5($_REQUEST["password"]);
			$userrole = $_REQUEST["userrole"];

			$result = $conn->query("select count(*) as total from tp_users where user_login='$username' OR user_email='$email'");
			$data = $result->fetch_assoc();
			if($data["total"] != 0)
			{
				echo "double";
			}
			else
			{
				$date = date("Y-m-d");
				$result = $conn->query("insert into tp_users(user_login,user_firstname,user_lastname,user_email,user_pass,user_role,user_registered) values('$username','$firstname','$lastname','$email','$password','$userrole','$date')");
				if($result)
					echo "success";
				else
					echo "failed";
			}
		}

		else if($request == "getuserdata")
		{
			$type = $_REQUEST["type"];
			$page = $_REQUEST["page"];
			$filter = $_REQUEST["filter"];
			$sort = $_REQUEST["sort"];
			$rows_per_page = $_REQUEST["rowcount"];

			$result = $conn->query("select count(*) as total from tp_users where user_status like '%$type%'" . $filter);
			$data = $result->fetch_assoc();
			$total = intval($data["total"]);

			$page_count = $total % $rows_per_page == 0 ? $total / $rows_per_page : intval($total / $rows_per_page) + 1;
			$offset = $rows_per_page * (intval($page) - 1);
			$query = "select * from tp_users where user_status like '%$type%'".$filter.$sort." limit $rows_per_page offset $offset";
			$result = $conn->query($query);
			$data = array();
			while($row = $result->fetch_array())
			{
				array_push($data, $row);
			}
			echo json_encode(array("data"=>$data, "page_count"=>$page_count));
		}

		else if($request == "deleteuser")
		{
			$id = $_REQUEST["id"];

			$query = "update tp_users set user_status='Deleted' where id='$id'";
			$result = $conn->query($query);
			if($result)
				echo "success";
			else
				echo "failed";
		}

		else if($request == "removeuser")
		{
			$id = $_REQUEST["id"];

			$query = "delete from tp_users where id='$id'";
			$result = $conn->query($query);
			if($result)
				echo "success";
			else
				echo "failed";
		}

		else if($request == "approveuser")
		{
			$id = $_REQUEST["id"];	

			$query = "update tp_users set user_status='Approved' where id=$id";
			$result = $conn->query($query);
			if($result)
				echo "success";
			else
				echo "failed";
		}

		else if($request == "unapproveuser")
		{
			$id = $_REQUEST["id"];	

			$query = "update tp_users set user_status='Pending' where id=$id";
			$result = $conn->query($query);
			if($result)
				echo "success";
			else
				echo "failed";
		}

		else if($request == "updateuser")
		{
			$id = $_REQUEST["id"];
			$username = $_REQUEST["username"];
			$firstname = $_REQUEST["firstname"];
			$lastname = $_REQUEST["lastname"];
			$email = $_REQUEST["email"];
			$role = $_REQUEST["role"];

			$result = $conn->query("select count(*) as total from tp_users where (user_login='$username' OR user_email='$email') AND id!='$id'");
			$data = $result->fetch_assoc();
			if($data["total"] != 0)
			{
				echo "double";
			}
			else
			{
				$query = "update tp_users set user_login='$username', user_firstname='$firstname', user_lastname='$lastname', user_email='$email', user_role='$role' where id='$id'";
				$result = $conn->query($query);
				if($result)
					echo "success";
				else
					echo "failed";
			}
		}

		else if($request == "getuserlist")
		{
			$query = "select * from tp_users";
			$result = $conn->query($query);
			$data = array();
			while($row = $result->fetch_array())
			{
				array_push($data, $row);
			}
			echo json_encode($data);
		}

		else if($request == "getuser")
		{
			$id = $_REQUEST["id"];

			$query = "select * from tp_users where id=$id";
			$result = $conn->query($query);
			$row = $result->fetch_array();
			echo json_encode($row);
		}

		else if($request == "edituser")
		{
			$id = $_REQUEST["id"];
			$username = $_REQUEST["username"];
			$firstname = $_REQUEST["firstname"];
			$lastname = $_REQUEST["lastname"];
			$email = $_REQUEST["email"];
			$role = $_REQUEST["role"];
			$status = $_REQUEST["status"];
			$password = $_REQUEST["password"];
			$pwd = md5($password);

			$result = $conn->query("select count(*) as total from tp_users where (user_login='$username' OR user_email='$email') AND id!='$id'");
			$data = $result->fetch_assoc();
			if($data["total"] != 0){
				echo "double";
			}
			else
			{
				if($password == "")
					$query = "update tp_users set user_login='$username', user_firstname='$firstname', user_lastname='$lastname', user_email='$email', user_role='$role', user_status='$status' where id='$id'";
				else
					$query = "update tp_users set user_login='$username', user_firstname='$firstname', user_lastname='$lastname', user_email='$email', user_role='$role', user_pass='$pwd' where id='$id'";
				$result = $conn->query($query);
				if($result)
					echo "success";
				else
					echo "failed";
			}
		}

	}
	$conn -> close();
?>