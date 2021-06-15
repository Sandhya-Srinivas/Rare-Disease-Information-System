<?php

$get_id = $_GET['id'];
$get_table = $_GET['table'];
$get_value = $_POST['Value'];

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
    </head>
    <body>
        <header><div ><img src='./Images/RDinfoHeading.PNG' alt='Rare Disease Information System' class = 'logoHead'></div></header>
        <main>
            <div >";
            
	$sql = "SELECT * FROM $get_table WHERE RD_id=$get_id";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){		
		if(in_array($get_value, $row)){
			echo '<script>
				alert("Value exists already");
				window.location.href="mainPage.html";
				</script>';
			$statement->close();
			$conn->close();	
			die();
		}
	}
	}
            
        
        $sql = "INSERT INTO $get_table VALUES(?, ?)";
	$statement = $conn->prepare($sql);
	$statement->bind_param("is", $get_id, $get_value);
	$statement->execute();
	$statement->close();
	$conn->close();
	echo "<p>Successfully inserted into ".$get_table."</p>";
	echo '<script>window.location.href="insertSuccess.php?id='.$get_id.'";</script>';
	
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

	
die();	

?>
