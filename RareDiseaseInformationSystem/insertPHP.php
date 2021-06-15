<?php

$get_RDname = $_POST['RDname'];
$get_gen = $_POST['type'];

$server_name = 'localhost';
$user_name = 'RDinfo1';
$password = '123456';
$db = 'RDinfo4';
$conn = new mysqli($server_name, $user_name, $password, $db);

if($conn->connect_error){
	die("Connection failed" . $conn->connect_error);
}

if($get_gen){
	$value='genetic';
}
else{
	$value='non-genetic';
}

$sql = "SELECT *
	FROM RARE_DISEASE_LIST r
	WHERE r.RD_name = '$get_RDname'
";

$result = $conn->query($sql);
if($result->num_rows >0){
	echo "Insertion is not possible. The disease already exists. You can update, select update option";	
	$conn->close();
	echo "
		<script>alert('Disease already exists');
		window.location.href='mainPage.html'</script>
	";
	die(); 
}
else{
	echo " 
	<!DOCTYPE html>
<html>
    <head>
        <title>Insert into RDInfo</title>
        <meta charset='utf-8'>
        <link rel = 'stylesheet' href='insertIntoRD.css'/>
        <script>
        	function validateForm(x) {
        		var x=document.forms[\"myForm\"][\"Age_of_onset\"].value;
	    		if((x==='') || (x===' ') || (x==='\t')|| (x.match(/^ *$/)!==null) || (x===null)){
	    			alert('Please fill this field');
	    			return false;
	    		}
	    		if(x != x.trim()){ 
	    			alert('Please remove extra spaces');
	    			return false;
	    		}
	    		if(x.search(/[^A-Za-z ]/)!=-1){
	    			alert('Invalid age of onset(Please remove spaces)');
	    			return false;
	    		}
	    	}
        </script>
    </head>
    <body>
        <header><div ><img src='./Images/RDinfoHeading.PNG' alt='Rare Disease Information System' class = 'logoHead'></div></header>
        <main>
            <div >
                <p>Insert</p>
                <form name=\"myForm\" method=\"POST\" action='insert2PHP.php' onsubmit=\"return validateForm()\">
                    <fieldset>
                        <legend>Insertion</legend>
                        <div>
                            <label>Rare disease name: </label><input type='text' name='RDname' value='$get_RDname' readonly><br/><br/>";
                            echo "<label>Type: </label><input type='text' name='gen' value='$value' readonly><br/><br/>";


if($get_gen){
	echo "<label>Enter the number of affected chromosomes </label>
		<input type='number' min='1' max='10' name='ChromCount' required>
		<br/><br/> ";
}

                            
echo "
                            <label>Age of onset: </label><input type='text' name=\"Age_of_onset\" required><br/><br/>
                            <label>Counting technique:</label>
                            <select name=\"type\">
                                <option value=0>unknown</option>
                                <option value=3>Prevalence</option>
                                <option value=1>Case count</option>
                                <option value=2>Family count</option>
                            </select><br/><br/>
                            <label>Enter the number of \"Symptoms\"</label><input type='number' min='1' max='10' name='SympCount' required><br/><br/>
                            <label>Enter the number of entries for \"Diagnosis\" </label><input type='number' min='1' max='10' name='DiagCount' required><br/><br/>
                            <label>Enter the number of entries for \"Treatment\"</label><input type='number' min='1' max='10' name='TreatCount' required><br/><br/>
                            <button type=\"submit\">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </main>
        <footer>
            <p><a href='mainPage.html'>Home</a>|<a href='listPHP.php'>List</a>|<a href='updatePage.html'>Update</a></p>
            <div><p>No copyrights &copy; </p></div>
        </footer>
    </body>

</html>
	";
}


?>
