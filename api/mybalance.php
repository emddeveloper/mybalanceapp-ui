<?php
	// Content Type JSON
    header("Content-type: application/json");
    header("Access-Control-Allow-Origin: *");    
	header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	// Database connection
	
    define (DB_USER, "u769955481_mybalance");
    define (DB_PASSWORD, "mybalance@123");
    define (DB_DATABASE, "u769955481_mybalance");
    define (DB_HOST, "sql328.main-hosting.eu");


    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $_POST = json_decode(file_get_contents('php://input'), true);
    $res = array('error' => false);
    $res['auth'] = false;


	// Read data from database
	$action = 'readlast';

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}
    if ($action == 'auth' && !empty($_POST) && $_POST['auth']==='5566') {
        $res['auth'] = true;
	}
	if ($action == 'readlast') {
        $result = $conn->query("SELECT * FROM `mybalance` ORDER BY myid DESC LIMIT 1");
        $balance  = array();

        while ($row = $result->fetch_assoc()) {
            array_push($balance, $row);
        }
        $res['balance'] = $balance;
	}

    //read all data
    if ($action == 'readall') {
        $result = $conn->query("SELECT * FROM `mybalance` ORDER BY myid DESC");
        $balance  = array();

        while ($row = $result->fetch_assoc()) {
            array_push($balance, $row);
        }
        $res['balance'] = $balance;
	}


    // Insert data into database and checking blank multiple updates
    date_default_timezone_set('Asia/Kolkata'); 
	if ($action == 'create' && !empty($_POST) ) {
		$scbal = $_POST['scbal'];
		$alabal = $_POST['alabal'];
        $sbibal = $_POST['sbibal'];
        $tstamp = date("Y-m-d h:i:sa");
		$result = $conn->query("INSERT INTO `mybalance` (`scbal`, `alabal`, `sbibal`, `tstamp`) VALUES('$scbal', '$alabal', '$sbibal', '$tstamp')");

		if ($result) {
            $res['message'] = "Balance added successfully";
            $result = $conn->query("SELECT * FROM `mybalance`");
            $balance  = array();

            while ($row = $result->fetch_assoc()) {
                array_push($balance, $row);
            }
            $res['balance'] = $balance;
		} else {
			$res['error']   = true;
			$res['message'] = "Balance update failed!";
		}
	}


	// Update data

	// if ($action == 'update') {
	// 	$id       = $_POST['id'];
	// 	$username = $_POST['username'];
	// 	$email    = $_POST['email'];
	// 	$mobile   = $_POST['mobile'];


	// 	$result = $conn->query("UPDATE `users` SET `username`='$username', `email`='$email', `mobile`='$mobile' WHERE `id`='$id'");

	// 	if ($result) {
	// 		$res['message'] = "User updated successfully";
	// 	} else {
	// 		$res['error']   = true;
	// 		$res['message'] = "User update failed!";
 	// 	}
	// }


	// Delete data

	// if ($action == 'delete') {
	// 	$id       = $_POST['id'];
	// 	$username = $_POST['username'];
	// 	$email    = $_POST['email'];
	// 	$mobile   = $_POST['mobile'];

	// 	$result = $conn->query("DELETE FROM `users` WHERE `id`='$id'");

	// 	if ($result) {
	// 		$res['message'] = "User delete success";
	// 	} else {
	// 		$res['error']   = true;
	// 		$res['message'] = "User delete failed!";
	// 	}
	// }


	// Close database connection
	$conn->close();

	// print json encoded data
	echo json_encode($res);
	die();

?>