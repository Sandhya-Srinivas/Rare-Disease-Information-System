<?php

$server_name = 'localhost';
$user_name = 'RDinfo1';
$password = '123456';
$db = 'RDinfo1';
$conn = new mysqli($server_name, $user_name, $password, $db);

if($conn->connect_error){
	die("Connection failed" . $conn->connect_error);
}

$sql = "select RD_name from RARE_DISEASE_LIST";
$result = $conn->query($sql);



echo "
<html>
<head>
	<title>List of Rare Diseases</title>
	<link rel='stylesheet' href='mainPage.css' />
</head>
<body>
	<header>
            <div ><img src='./Images/RDinfoHeading.PNG' alt='Rare Disease Information System' class = 'logoHead'></div>
        </header>
	<h1>List of Rare Diseases</h1>
	<div>";


if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		echo "<p>".$row["RD_name"]."</a></p>";
	}
}

echo "
	</div>
	<footer>
            <p><a href='mainPage.html'>Home</a>|<a href='listPHP.php'>List</a>|<a href='updatePage.html'>Update</a></p>
            <div><p>No copyrights &copy; </p></div>
        </footer>
</body>
</html>";

?>
