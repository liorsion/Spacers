<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past




error_reporting(1);

$fromFirstName = addslashes($_POST['first']);
$fromLastName = addslashes($_POST['last']);
$experience = addslashes($_POST['experience']);
if (strlen($experience)==0) { $experience=""; }   //db field does not allow null
$experience = str_replace( "\n", " ", $experience );
$experience = str_replace( "\r", " ", $experience );
$note2attach = $experience;

$fromEmail = $_POST['email'];
$sendEmail = 'wordpress@wser.org';
$toFirstName = addslashes($_POST['firstName']);
$toLastName = addslashes($_POST['lastName']);
$toName = "$toFirstName $toLastName";


$serverName = $_SERVER['SERVER_NAME'];
$scriptName = $_SERVER['SCRIPT_NAME'];

//-----------------------------------------------------------
// Example to write the data into database

$dbhost = '[ENTER YOUR HOST HERE]';
$dbuser = '[ENTER YOUR USERNAME HERE]';
$dbpass = '[ENTER YOUR PASSWORD HERE]';
$dbname = '[ENTER YOUR DATABASE HERE]';
$dbTableName = '[ENTER YOUR TABLE HERE]';


$conn = mysql_connect($dbhost, $dbuser, $dbpass) 
		or die ('Error connecting to mysql');
mysql_select_db($dbname);


// you may want to store some of this person's info into database as a record that this request happened.... or may be not...

// get email address for the target person
$id=-1;

$query = "select * from $dbTableName where firstName='$toFirstName' and lastName='$toLastName' and deleteRecord<>1;";
$result = mysql_query($query);
if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { 

	$id = $row['id'];
	$toEmail = $row['email'];
	$status = $row['status'];
	
} else {
  exit; // spam bot got here without selecting recipient
	// error! should neven happend ...
}

//log this request into db

$query = "insert into $dbTableName set firstName='$fromFirstName', lastName='$fromLastName', email='$fromEmail', home='?', sex='?', speed='?',knowledge='$toName ($status)', status='user', experience='$note2attach', deleteRecord=1;";
//echo "$query\n";
$result = mysql_query($query);


mysql_close($conn);

/*
$to = $toEmail;


$fromFirstName = 'first';
$fromLastName = 'last';
$message = 'yo!';
$fromEmail = 'from email';
$toFirstName = 'to firstname';
$toLastName = 'to lastname';
*/


//$toEmail = 'firepotter@gmail.com';
$subject = "[WS100]  Request For Pacer";
if ($status=='pacer') { $subject = "[WS100]  Requesting To Pace"; }

$headers = "From: Western States Endurance Run <$sendEmail>\n" .
		"Reply-To: $fromEmail\n" .
		"Content-Type: text/plain; charset=iso-8859-1\n";
//$time_string = __('Y-m-d G:i:s');
//$time = date_i18n( __($time_string), current_time('timestamp') );
$ip = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );


if ($status=='runner') {
	$message = "\r\nHello $toFirstName $toLastName,";
	$message .="\r\n";
	$message .="\r\n$fromFirstName $fromLastName ($fromEmail) would like to pace you in the Western States 100. Please contact him/her directly to make arrangements. Once arrangements have been made please go back to the Pacer Request page http://www.wser.org/pacer-request and remove your name from the list";

} else {
	$message = "\r\nHello $toFirstName $toLastName,";
	$message .="\r\n";
	$message .="\r\n$fromFirstName $fromLastName ($fromEmail) would like you to pace them in the Western States 100. Please contact him/her directly to make arrangements. Once arrangements have been made please go back to the Pacer Request page http://www.wser.org/pacer-request and remove your name from the list.";

}
$message .="\r\n\r\n";
$message .="\r\nRequest Message: $note2attach.";
$message .="\r\n\r\n";

$status = mail($toEmail, $subject, $message, $headers);


echo "<script>";
echo "document.location = '".$_SERVER['HTTP_REFERER']."';\n";
echo "</script>";
exit(0);

?>

  	


