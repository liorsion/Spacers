<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past




error_reporting(1);


$firstName = addslashes($_POST['first']);
$lastName = addslashes($_POST['last']);
$home = addslashes($_POST['home']);
$sex = $_POST['sex'];
$speed = $_POST['speed'];
$knowledge = $_POST['knowledge'];
$status = $_POST['status0'];
$experience = addslashes($_POST['experience']);
if (strlen($experience)==0) { $experience=""; }   //db field does not allow null
$experience = str_replace( "\n", " ", $experience );
$experience = str_replace( "\r", " ", $experience );

$email = $_POST['email'];
$deleteRecord = $_POST['deleteRecord'];

$answer = $_POST['answer'];
// if (floor($answer)!=100) {exit;}		//spam bot protection

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

// database debug
if (0) {
	$query = "describe pacer;";
	$result = mysql_query($query);
	if (mysql_errno()) { echo sprintf("error: %s (%d)\n", mysql_error(), mysql_errno() ); }
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		print_r($row);
	}
}

if (0) {
	$query = "select * from pacer;";
	$result = mysql_query($query);
	if (mysql_errno()) { echo sprintf("error: %s (%d)\n", mysql_error(), mysql_errno() ); }
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		print_r($row);
	}
}


// first to check if the input email, name already in the database

if ((strlen($firstName)>0) and (strlen($lastName)>0) and (strlen($email)>0)) {
	// firs to check if the input email, name already in the database
	//echo "input is valid\n";

	$query = "select * from $dbTableName where firstName='$firstName' and lastName='$lastName' and email='$email' and deleteRecord<>1;";
	//echo "$query\n";
	$result = mysql_query($query);
	
	if (mysql_errno()) { echo sprintf("error: %s (%d)\n", mysql_error(), mysql_errno() ); }
	$personInDatabase = 0;
	if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { $personInDatabase = 1; }
	//echo "personInDatabase = $personInDatabase\n";
	
	if ($personInDatabase==1) {
	    if ($deleteRecord==1) {
	            // remove this person from the list
	            // don't delete the row, just set deleteRecord=1 in that row
	            $query = "update $dbTableName set deleteRecord=1 where firstName='$firstName' and lastName='$lastName' and email='$email';";
	            //echo "$query\n";
	            $result = mysql_query($query);
	            
	            if (mysql_errno()) { echo sprintf("error: %s (%d)\n", mysql_error(), mysql_errno() ); }
	     }
	} else {
		//add to the database
	  if (floor($answer)!=100) {echo "answer is $answer\n"; exit;}          //spam bot protection                                            

		$query = "insert into $dbTableName set firstName='$firstName', lastName='$lastName', email='$email', home='$home', sex='$sex', speed='$speed',knowledge='$knowledge', status='$status', experience='$experience', deleteRecord=0;";
		//echo "$query\n";
		$result = mysql_query($query);
		
		if (mysql_errno()) { echo sprintf("error: %s (%d)\n", mysql_error(), mysql_errno() ); }
	
	}

	

	
	echo "<script>";
	echo "document.location = '".$_SERVER['HTTP_REFERER']."';\n";
	echo "</script>";
	exit(0);

}

// now database update is done, we want to get all the pacers/runners so we can list them in a table

$query = "select * from $dbTableName where deleteRecord<>1 and status='runner';";
$result = mysql_query($query);
//if (mysql_errno()) { echo sprintf("document.write('error: %s (%d)');\n", mysql_error()  ); }
$runner = array();
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { $runner[] = $row; }


$query = "select * from $dbTableName where deleteRecord<>1 and status='pacer';";
$result = mysql_query($query);
//if (mysql_errno()) { echo sprintf("document.write('error: %s (%d)');\n", mysql_error() ); }
$pacer = array();
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { $pacer[] = $row; }

$query = "select * from $dbTableName where deleteRecord=1 and status='user';";
$result = mysql_query($query);
//if (mysql_errno()) { echo sprintf("document.write('error: %s (%d)');\n", mysql_error() ); }
$user = array();
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { $user[] = $row; }

$query = "select * from $dbTableName where deleteRecord=1 and status<>'user';";
$result = mysql_query($query);
//if (mysql_errno()) { echo sprintf("document.write('error: %s (%d)');\n", mysql_error() ); }
$deleted = array();
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { $deleted[] = $row; }


mysql_close($conn);


?>

function getCheckboxValue(input) {
	if (input.checked) { return 1; }
	return 0;
}

function request2Contact( firstName, lastName, status ) {

		message0  = ' ';
		
        if (status=='runner') {
                message0 =  'You are requesting to pace '+ firstName+' '+lastName+'. ';
        }
        if (status=='pacer') {
                message0 = 'You are requesting '+ firstName+' '+lastName+' to pace you. ';
        }

        document.getElementById('firstName2Contact').value=firstName;
        document.getElementById('lastName2Contact').value=lastName;
        document.getElementById('contactMessage0').innerHTML=message0;
        document.getElementById('request2ContactForm').style.display='block';
		document.getElementById('request2ContactForm').focus();
		document.getElementById('request2ContactForm').select();
}


function getRadioValue( inputs) {
	for (var i=0; i < inputs.length; i++) {
		if (inputs[i].checked) {
      		return inputs[i].value;    
      	}
   	}
}

function getSelectValue( select ) {
   return select.value;
}



function fixCase(str,formName){
	var reLC = /\b[a-z]/g;
	var reUP = /\B[A-Z]{2}/g;
	var reEnd = /[A-Z]$/g;
	if((str.search(reLC) > -1) || (str.search(reUP) > -1) || (str.search(reEnd) > -1)){
	var strLength = str.length;
	var lastWasSpace = "n";
	var newStr = "";
	for (var i = 0; i < strLength; i++)
		{var theChar = str.charAt(i);
		if(i == 0)
		{newStr = theChar.toUpperCase();
		} else
		if(lastWasSpace == "y"){
			newStr += theChar.toUpperCase();
			lastWasSpace = "n"} else {
			if (str.charAt(i) == " "){
			lastWasSpace = "y"}
			newStr += theChar.toLowerCase();
			}
			}
	
	formName.value = newStr;
	}
}


function formHandler(){

	pacerpform = document.getElementById( 'registerForm' ); 

	
	
	// check for special key...
	
	if ( (pacerpform.first.value == "Conduct The Juices") && (pacerpform.last.value == "") ) {
	
		document.getElementById('deleted-table').style.display='block';
		document.getElementById('user-table').style.display='block';

		return;
	}
	
	// first verify form

	var ok = "y";
	
	//alert( 'hello' );
	//alert( 'first='+pacerpform.first.value );
	//alert( 'status='+pacerpform.status0.value );
	if (pacerpform.status0.value=="") {
		alert("Please indicate whether you are a runner or pacer.");
		pacerpform.status0.focus();
        ok = "n";
	} else if (pacerpform.first.value == "") {
		alert("Please enter your first name.");
		pacerpform.first.focus();
        ok = "n";     
	}  else if(pacerpform.last.value == "") {
		alert("Please enter your last name.");
		pacerpform.last.focus();
        ok = "n";

    } else if(pacerpform.email.value == "") {
   
		alert("Please enter your e-mail address.\nYou must have one to use this service.");
		pacerpform.email.focus();
        ok = "n";
    } else if (pacerpform.deleteRecord.checked) {
		pacerpform.submit()
	} else if (pacerpform.sex=="") {
		alert("Please enter your sex.");
		pacerpform.sex.focus();
        ok = "n";
    } else if(pacerpform.home.value == "") {
		alert("Please enter your city and state.");
		pacerpform.home.focus();
        ok = "n";
    } else if (pacerpform.speed=="") {
		alert("Please indicate your speed -- back/middle/front of pack.");
		pacerpform.speed.focus();
        ok = "n";
        
    } else if (pacerpform.knowledge=="") {
		alert("Please indicate your course knowledge.");
		pacerpform.knowledge.focus();
        ok = "n";

    } else if ((pacerpform.answer.value!="100") && (pacerpform.answer.value!="100.2") ) {
		alert("The offical distance of Western States Endurance Run is 100.2 miles.\nPlease answer using the correct answer.");
		pacerpform.answer.focus();
		ok = "n";

    } else if(ok == "y") {
    	//alert( 'form is good');
		pacerpform.submit();
	}
	
}

function request2ContactHandler(){

	requestForm = document.getElementById( 'request2ContactForm' );


	var ok = "y";
	if (requestForm.first.value == "") {
			alert("Please enter your first name.");
			requestForm.first.focus();
			ok = "n";
	}  else if(requestForm.last.value == "") {
			alert("Please enter your last name.");
			requestForm.last.focus();
			ok = "n";
    } else if(requestForm.email.value == "") {
			alert("Please enter your e-mail address.\n You must have one to use this service.");
			requestForm.email.focus();
        	ok = "n";
        
    } else if (requestForm.sex=="") {
			alert("Please enter your sex.");
			requestForm.sex.focus();
			ok = "n";
    } else if(requestForm.home.value == "") {
			alert("Please enter your city and state.");
			requestForm.home.focus();
			ok = "n";
			
    } else if(ok == "y") {
        //alert( 'form is good');
        requestForm.submit();
        }
      
}

<?php


$groupList = array( 'runner', 'pacer' );
$groupList = array( 'runner', 'pacer', 'deleted', 'user' );


$s = '';
$s .= '<div class="page">';

foreach ( $groupList as $group ) {
	$title = ucwords($group);
	$display='block';
	if (($group=='deleted') or ($group=='user')) { $display='none'; }
	
	$s .= "<div id=\'$group-table\' style=\'display:$display;\' >";
	
	$s .= "<h2>$title Table</h2>";
	$s .= '<table class="runnerlist layout display responsive-table">';
	$s .= '<thead><tr><th>Name</th><th>Home</th><th>Gender</th><th>Speed</th><th colspan="3">Notes</th></tr></thead>';
	$s .= '<tbody>';
	
	$groupNameList = $$group;
	foreach ($groupNameList as $person) {
		$firstName = addslashes($person['firstName']);
		$lastName = addslashes($person['lastName']);
		$person['home'] = str_replace( " ", "&nbsp;", $person['home'] );
		$person['speed'] = str_replace( " ", "&nbsp;", $person['speed'] );
		$person['name'] = "$firstName $lastName";
		$person['name'] = str_replace( " ", "&nbsp;", $person['name'] );
		$status = $person['status'];
		
		
		$s .= '<tr>';
		foreach ( array( 'name', 'home', 'sex', 'speed', 'experience', 'knowledge' ) as $key ) {
			$s .= '<td>'.addslashes($person[$key]).'</td>';
		}
		$s .= '<td><a href="#mailForm"><input type="button" value="E-mail" onClick="request2Contact( \\\''.$firstName.'\\\', \\\''.$lastName.'\\\', \\\''.$status.'\\\' ); return false;" style=\\\'display:'.$display.';\\\'></a></td></tr>';
	}
	
	$s .= '</tbody></table>';
	$s .= "</div>";
	
}


$s .= '</div> ';

$s = str_replace( "\n", " ", $s );
$s = str_replace( "\r", " ", $s );



?>


document.write( "<div id='runner-pacer-table'>xxxx</div>");
document.getElementById('runner-pacer-table').innerHTML = '<?php echo $s; ?>';





