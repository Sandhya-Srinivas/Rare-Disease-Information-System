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

$sql = "SELECT *
	FROM RARE_DISEASE_LIST r
	WHERE r.RD_name = '$get_RDname'
";

$result = $conn->query($sql);

if(!($result->num_rows >0)){
	echo "Disease doesn't exist.";	
	$conn->close();
	echo "
		<script>alert('Disease does not exist');
		window.location.href='mainPage.html'</script>
	";
	die(); 
}
echo "
<html>
<head> ";


echo "
	<link rel='stylesheet' href='listPHP.css' />
</head>
<body>
	<header>
            <div ><img src='./Images/RDinfoHeading.PNG' alt='Rare Disease Information System' class = 'logoHead'></div>
        </header>
        <main >
        	<div class='mainBody'>
		";

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$get_id = $row['RD_id'];
		echo "
			<script>
			window.location.href='insertSuccess.php?id=$get_id'</script>
		";
		echo $get_id;
		//echo "<p class='list'><a href=\"insertSuccess.php?id=$get_id\">".$row["RD_name"]."</a></p>";
	}
}

echo "
		</div>
	<main>
	<footer>
            <p><a href='mainPage.html'>Home</a>|<a href='listPHP.php'>List</a>|<a href='updatePage.html'>Update</a></p>
            <div><p>No copyrights &copy; </p></div>
        </footer>
</body>
</html>";

?>
