<?php
include 'connect.php';
// validate birthday
function validateAge($birthday, $age = 18)
{
    // $birthday can be UNIX_TIMESTAMP or just a string-date.
    if(is_string($birthday)) {
        $birthday = strtotime($birthday);
    }

    // check
    // 31536000 is the number of seconds in a 365 days year.
    if(time() - $birthday < $age * 31536000)  {
        return false;
    }

    return true;
}
$errors         = array();  	// array to hold validation errors
$data 			= array(); 		// array to pass back data
$phone = '000-0000-0000';
// validate the variables ======================================================
	if (empty($_POST['name']))
		$errors['name'] = 'name is required.';

	if (empty($_POST['email']))
		$errors['email'] = 'email is required.';

	if (empty($_POST['phone']))
		$errors['phone'] = 'phone is required.';

	if (empty($_POST['dob']))
		$errors['dob'] = 'Date of Birth is required.';
// return a response ===========================================================

	// response if there are errors
	if (!empty($errors)) {

		// if there are items in our errors array, return those errors
		$data['success'] = false;
		$data['errors']  = $errors;
	}
    else if(validateAge($_POST['dob']) == false)
    {
    	$data['success'] = false;
		$data['errors']  = "notvalidage";
    }
	else
	{
    $sql = "INSERT INTO usr_table (name, email, phone, date)
		VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['dob']."')";

	if($conn->query($sql) === TRUE) {
       	
       	$msg = $_POST['name'];
		$msg = wordwrap($msg,70);
		mail($_POST['email'],"Message From Test Window",$msg);

		$data['success'] = true;
		$data['message'] = 'Mail has been sent and data has been saved';
	}
	else {
		$data['success'] = false;
		$data['message'] = 'Something went wrong ! We could not saved your data';
	}
}

	// return all our data to an AJAX call
	echo json_encode($data);
