<?php

$get_id = $_GET['id'];
$get_table=$_POST['Table'];

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
	    		var x=document.forms[\"myForm\"][\"Value\"].value;
		    	if((x==='') || (x===' ') || (x==='\t')|| (x.match(/^ *$/)!==null) || (x===null)){
		    		alert('Please fill the field ');
		    		return false;
		    	}
		    	if(x != x.trim()){ 
		    		alert('Please remove extra spaces ');
		    		return false;
		    	}
		    	if(x.search(/[^A-Za-z -]/)!=-1){
		    		alert('Enter only characters ');
		    		return false;
		    	}
	    	}	    	
        </script>
    </head>
    <body>
        <header><div ><img src='./Images/RDinfoHeading.PNG' alt='Rare Disease Information System' class = 'logoHead'></div></header>
        <main>
            <div >";
       

	echo "
            <form name='myForm' method='POST' action='update4.php?id=$get_id&table=$get_table' onsubmit='return validateForm()'>
                        <fieldset>
                            <legend>Update RDinfo system</legend>";
	
	echo "<label>Enter the value : </label><input type='text' name='Value' required><br/><br/> ";
	echo "
		<button type='submit'>Submit</button>
                </fieldset>
                </form>
	";
	

                            
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



?>
