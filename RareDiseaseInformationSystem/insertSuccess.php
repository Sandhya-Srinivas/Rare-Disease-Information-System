<?php
$get_id = intval($_GET['id']);

// Login details
$server_name = 'localhost';
$user_name = 'RDinfo1';
$password = '123456';
$db = 'RDinfo4';
$conn = new mysqli($server_name, $user_name, $password, $db);


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
        <main>";

// If any database connectivity errors, end the session
if($conn->connect_error){
	die("Connection failed" . $conn->connect_error);
}

// If connected to the database

$sql = "SELECT *
	FROM RARE_DISEASE_LIST
	WHERE RD_id = $get_id ";

$result = $conn->query($sql);
if($result->num_rows > 0){
	if($row = $result->fetch_assoc()){
		echo "<h3>Disease name: ".$row['RD_name']."</h3>";
	}
	while($row = $result->fetch_assoc()){
		echo "<h5>Synonym: ".$row['RD_name']."</h5>";
	}
	echo "<p>RD id: ".$get_id."</p>";
}

$sqlname = "SELECT *
	FROM RARE_DISEASE
	WHERE RD_id = '$get_id' ";

$result = $conn->query($sqlname);
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		echo "<p>Age_of_onset: ".$row['Age_of_onset']."</p>";
		if($row['Type']==1){
			echo "<p>Disease type: Genetic</p>";			
			$sqlname2 = "SELECT *
				FROM GENETIC
				WHERE RD_id = '$get_id' ";

			$result2 = $conn->query($sqlname2);
			if($result2->num_rows > 0){
				echo "<table border='black solid'>
				<tr><th>Chromosome number</th><th>Gene name</th><th>Condition</th></tr>";
				while($row2 = $result2->fetch_assoc()){
					echo "<tr><td>".$row2['Chromosome_no']."</td>";
					echo "<td>".$row2['Gene_name']."</td>";
					echo "<td>".$row2['G_Condition']."</td></tr>";
				}
				echo "</table>";
			}
		}
		else{
			echo "<p>Disease type: Non-genetic/Unknown</p>";
		}	
		if($row['Counting_Technique']==3){
			echo "<p>Counting Technique: Prevalance</p>";
			echo "<p>Count: ".$row['Count']."</p>";
		}
		else if($row['Counting_Technique']==1){			
			echo "<p>Counting Technique: Case count</p>";
			echo "<p>Count: ".$row['Count']."</p>";
		}
		else if($row['Counting_Technique']==2){			
			echo "<p>Counting Technique: Family count</p>";
			echo "<p>Count: ".$row['Count']."</p>";
		}
		else if($row['Counting_Technique']==0){			
			echo "<p>Counting Technique: Unknown</p>";
		}
		else {
			echo "Something went wrong";
		}
		
	}
}

$sqlname = "SELECT *
	FROM SYMPTOM
	WHERE RD_id = '$get_id' ";

$result = $conn->query($sqlname);
if($result->num_rows > 0){
	if($row = $result->fetch_assoc()){
		echo "<p>Symptoms: ".$row['Symptom'];
	}
	while($row = $result->fetch_assoc()){
		echo ", ".$row['Symptom'];
	}
	echo " </p>";
}

$sqlname = "SELECT *
	FROM DIAGNOSIS
	WHERE RD_id = '$get_id' ";

$result = $conn->query($sqlname);
if($result->num_rows > 0){
	if($row = $result->fetch_assoc()){
		echo "<p>Diagnosis: ".$row['Diagnosis'];
	}
	while($row = $result->fetch_assoc()){
		echo ", ".$row['Diagnosis'];
	}
	echo " </p>";
}

$sqlname = "SELECT *
	FROM TREATMENT
	WHERE RD_id = '$get_id' ";

$result = $conn->query($sqlname);
if($result->num_rows > 0){
	if($row = $result->fetch_assoc()){
		echo "<p>Treatment: ".$row['Treatment'];
	}
	while($row = $result->fetch_assoc()){
		echo ", ".$row['Treatment'];
	}
	echo " </p>";
}

      
echo "        
        </main>
        <footer>
            <p><a href='mainPage.html'>Home</a>|<a href='listPHP.php'>List</a>|<a href='updatePage.html'>Update</a></p>
            <div><p>No copyrights &copy; </p></div>
        </footer>
    </body>

</html>
	";
	

$statement->close();
$conn->close();

?>
