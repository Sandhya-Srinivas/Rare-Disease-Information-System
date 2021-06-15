<?php

$gen = $_GET['gen'];
$server_name = 'localhost';
$user_name = 'RDinfo1';
$password = '123456';
$db = 'RDinfo4';
$conn = new mysqli($server_name, $user_name, $password, $db);

if($conn->connect_error){
	die("Connection failed" . $conn->connect_error);
}

echo "
<html>
<head> ";

if($gen){
	echo "<title>Rare Diseases</title>";
	$sql = "SELECT RD_name, rd.RD_id as RD_id
		FROM RARE_DISEASE_LIST NATURAL JOIN RARE_DISEASE rd
		WHERE rd.type = $gen
	";
}
else{
	echo "<title>Rare Genetic Diseases</title>";
	$sql = "SELECT RD_name, RD_id 
	FROM RARE_DISEASE_LIST
	";
}

$result = $conn->query($sql);

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

if($gen){
	echo "<h1>Rare Genetic Diseases</h1>";
}else{
	echo "<h1>Rare Diseases</h1>";
}


if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$get_id = $row['RD_id'];
		echo "<p class='list'><a href=\"insertSuccess.php?id=$get_id\">".$row["RD_name"]."</a></p>";
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
