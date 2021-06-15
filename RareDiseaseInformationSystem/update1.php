<?php

$get_RDname = $_POST['RDname'];

$server_name = 'localhost';
$user_name = 'RDinfo1';
$password = '123456';
$db = 'RDinfo4';
$conn = new mysqli($server_name, $user_name, $password, $db);

if($conn->connect_error){
	die("Connection failed" . $conn->connect_error);
}

echo " 
	<!DOCTYPE html>
<html>
    <head>
        <title>Insert into RDInfo</title>
        <meta charset='utf-8'>
        <link rel = 'stylesheet' href='insertIntoRD.css'/>
        <script>
	    	function validateForm(){
	    		var a=document.getElementsByName('Table'); 
	    		var isValid1 = false;
	    		var i=0;
	    		while(!isValid1 && i<a.length){
	    			if(a[i].checked) isValid1=true;
	    			i++;
	    		}
	    		if(!isValid1){	    					    	
	    			alert('Choose type of updation');
	    			return false;
	    		}
	    	}
        </script>
    </head>
    <body>
        <header><div ><img src='./Images/RDinfoHeading.PNG' alt='Rare Disease Information System' class = 'logoHead'></div></header>
        <main>
            <div >";
       

$sql = "SELECT *
	FROM RARE_DISEASE_LIST 
	WHERE RD_name = '$get_RDname'
";

$result = $conn->query($sql);
if($result->num_rows >0){
	$get_id = null;
	while($row = $result->fetch_assoc()){
		$get_id = $row['RD_id'];
	}
	echo "
            <form name='myForm' method='POST' action='update3.php?id=$get_id' onsubmit='return validateForm()'>
                        <fieldset>
                            <legend>Update RDinfo system</legend>";
	echo "<p>Select the feature for updation: <p>";
	echo "
		<label><input type='radio' name='Table' value='SYMPTOM'/> Symptom </label></br>
		<label><input type='radio' name='Table' value='DIAGNOSIS'/> Diagnosis </label></br>
		<label><input type='radio' name='Table' value='TREATMENT'/> Treatment </label></br>
		<label><input type='radio' name='Table' value='RARE_DISEASE_LIST'/> Synonym </label></br>";
	
	echo "
		<button type='submit'>Submit</button>
                </fieldset>
                </form>
	";
	
}
else{
	echo "<p>Please insert the disease into database<p>";	
	echo '
		<script>alert("Disease does not exist");
		window.location.href="mainPage.html";</script>
	';
	die();
}                    
echo "		
            </div>
        </main>
        <footer>
            <p><a href='mainPage.html'>Home</a>|<a href='listPHP.php'>List</a>|<a href='updatePage.html'>Update</a></p>
            <div><p>No copyrights &copy; </p></div>
        </footer>
    </body>

</html>
	";


$conn->close();
die();
        

?>
