<?php

// Receive the data from the previous page
$get_RDname = $_POST['RDname'];
$get_gen = $_POST['gen'];
$get_ageOfOnset = $_POST['Age_of_onset'];
$get_countTech = $_POST['countTech'];
$get_symptom = $_POST['Symptom'];
$get_diagnosis = $_POST['Diagnosis'];
$get_treatment = $_POST['Treatment'];

// If 'genetic', update the 'type'
$get_type = 0;
if($get_gen=='genetic'){
	$get_type = 1;
}

// Update the values for counting technique
if($get_countTech == 'Prevalance'){
	$get_countTechValue = 3;
}else if($get_countTech == 'Family_count'){
	$get_countTechValue = 2;
}else if($get_countTech == 'Case_count'){
	$get_countTechValue = 1;
}else{
	$get_countTechValue = 0;
}

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

// If connected to the database, check if the disease already present the database
$sqlCheck = "SELECT r.RD_id
	FROM RARE_DISEASE_LIST r
	WHERE r.RD_name = '$get_RDname' ";

$RD_id = null;
// If it is present, return to home page
$result = $conn->query($sqlCheck);
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
	$RD_id = $row['RD_id'];
	}
	echo "RD id: ".$RD_id;
	echo "<p>Insertion is not possible.</p>"; 
	$conn->close();
	echo '
		<script>alert("Inserted already");
		window.location.href="insertSuccess.php?id='.$RD_id.'";</script>
	';
	die();
}

// Otherwise, insert into the database
// If count is determined, insert the count into RARE_DISEASE table
if($get_countTech!= 'unknown'){
	$get_count = $_POST['Count'];
	echo "count tech ".$get_countTech;
	echo "  count ".$get_count;
	$sqlRD = "INSERT INTO RARE_DISEASE(Age_of_onset, Type, Counting_Technique, Count)
	VALUES(?,?,?,?)";
	$statement = $conn->prepare($sqlRD);
	$statement->bind_param("sddd", $get_ageOfOnset, $get_type, $get_countTechValue, $get_count);
	$statement->execute();
}
else{
// otherwise, insert null as the count
	$sqlRD = "INSERT INTO RARE_DISEASE(Age_of_onset, Type, Counting_Technique)
	VALUES(?,?,?)";
	$statement = $conn->prepare($sqlRD);
	$statement->bind_param("sdd", $get_ageOfOnset, $get_type, $get_countTechValue);
	$statement->execute();
}
echo "<p>Successfully inserted into RARE_DISEASE</p>";

// Retrieve the disease id, for the above table
$sqlRD_id = "SELECT MAX(RD_id) FROM RARE_DISEASE";
$result = $conn->query($sqlRD_id);

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
	
		// Insert the name
		$sqlRDname = "INSERT INTO RARE_DISEASE_LIST  VALUES(?, ?)";
		$statement = $conn->prepare($sqlRDname);
		$statement->bind_param("is", $row['MAX(RD_id)'], $get_RDname);
		$statement->execute();		
		echo "<p>Successfully inserted into RARE_DISEASE_LIST</p>";
		
		// Insert the symptoms
		$sqlRDsym = "INSERT INTO SYMPTOM VALUES(?, ?)";
		foreach($get_symptom as $value){
			$statement = $conn->prepare($sqlRDsym);
			$statement->bind_param("is", $row['MAX(RD_id)'], $value);
			$statement->execute();	
		}	
		echo "<p>Successfully inserted into SYMPTOMS</p>";
		
		// Insert the diagnosis tests
		$sqlRDdia = "INSERT INTO DIAGNOSIS VALUES(?, ?)";
		$statement = $conn->prepare($sqlRDdia);
		foreach($get_diagnosis as $value){
			$statement = $conn->prepare($sqlRDdia);
			$statement->bind_param("is", $row['MAX(RD_id)'], $value);
			$statement->execute();	
		}	
		echo "<p>Successfully inserted into DIAGNOSIS</p>";
		
		// Insert the treatments
		$sqlRDtrt = "INSERT INTO TREATMENT VALUES(?, ?)";
		$statement = $conn->prepare($sqlRDtrt);
		foreach($get_treatment as $value){
			$statement = $conn->prepare($sqlRDtrt);
			$statement->bind_param("is", $row['MAX(RD_id)'], $value);
			$statement->execute();	
		}	
		echo "<p>Successfully inserted into TREATMENT</p>";
		
		// If it is a genetic disease, insert the chromosome details
		if($get_gen=='genetic'){
			$get_chrom = $_POST['Chromosomes'];
			$get_gene = $_POST['Genes'];
			$get_cond = $_POST['Condition'];
			$t=sizeof($get_chrom);
			$i=0;
			while($t-- > 0){
			echo $t;
			$sqlRDgen = "INSERT INTO GENETIC VALUES(?, ?, ?, ?)";
			$statement = $conn->prepare($sqlRDgen);
			$chrom = $get_chrom[$i]; echo $chrom;
			$gene = $get_gene[$i]; echo $gene;
			$cond = $get_cond[$i]; echo $cond;
			$statement->bind_param("idss", $row['MAX(RD_id)'], $chrom, $gene, $cond);
			$statement->execute();	
			$i++;
			}
			echo "<p>Successfully inserted into GENETIC</p>";
		}
		
		$RD_id = $row['MAX(RD_id)'];
	}
}


echo "Successfully inserted";
echo "RD id: ".$RD_id;
$conn->close();
echo '<script>window.location.href="insertSuccess.php?id='.$RD_id.'";</script>';


$statement->close();
$conn->close();
die();
      
echo "        
        </main>
        <footer>
            <p><a href='mainPage.html'>Home</a>|<a href='listPHP.php'>List</a>|<a href='updatePage.html'>Update</a></p>
            <div><p>No copyrights &copy; </p></div>
        </footer>
    </body>

</html>
	";
	

?>
