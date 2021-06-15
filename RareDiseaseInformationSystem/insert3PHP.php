<?php

$get_RDname = $_POST['RDname'];
$get_gen = $_POST['gen'];
$get_ageOfOnset = $_POST['Age_of_onset'];
$get_countTech = $_POST['countTech'];
$get_symptom = $_POST['Symptom'];
$get_diagnosis = $_POST['Diagnosis'];
$get_treatment = $_POST['Treatment'];

echo " 
<!DOCTYPE html>
<html>
    <head>
        <title>Insert into RDInfo</title>
        <meta charset='utf-8'>
        <link rel = 'stylesheet' href='insertIntoRD.css'/>
        <script>function validate(Y, Z){
        		var k, y, z;
        		for(k=0; k<Y.length; k++){
        		y = Y[k];
        		z = Z[k];
        		for(var i=0; i<y.length; i++){
	    			var x= y[i].value;
		    		if((x==='') || (x===' ') || (x==='\t')|| (x.match(/^ *$/)!==null) || (x===null)){
		    			alert('Please fill the field '+z+' - '+(i+1));
		    			return false;
		    		}
		    		if(x != x.trim()){ 
		    			alert('Please remove extra spaces '+z+' - '+(i+1));
		    			return false;
		    		}
		    		if(x.search(/[^A-Za-z1-9 ]/)!=-1){
		    			alert('Enter only characters '+z+' - '+(i+1));
		    			return false;
		    		}
	    		}
	    		}	    		
	    	}
	    	function validateForm(){
	    		var a=document.getElementsByName('Genes[]'); 
	    		var b=document.getElementsByName('Condition[]');
	    		return validate([a,b] , ['gene', 'condition']);
	    	}
        </script>
    </head>
    <body>
        <header><div ><img src='./Images/RDinfoHeading.PNG' alt='Rare Disease Information System' class = 'logoHead'></div></header>
        <main>
            <div >
                <p>Insert</p>
                <form name=\"myForm\" method=\"POST\" action='insert4PHP.php' onsubmit='return validateForm()'>
                    <fieldset>
                        <legend>Insertion</legend>
                        <div>
                            <label>Rare disease name: </label><input type='text' name='RDname' value='$get_RDname' readonly><br/><br/>
                            <label>Age of onset: </label><input type='text' name=\"Age_of_onset\" value='$get_ageOfOnset' readonly><br/><br/>
                            ";
function printHTMLArray($var, $name){
	for($x=0; $x<sizeof($var); $x++){
		$y = $x+1;
		echo "<label>$name - $y: </label><input type='text' name=$name value='$var[$x]' readonly><br/><br/>";
	}
}
if($get_gen=='genetic'){
	echo "<label>Type: </label><input type='text' name='gen' value='genetic' readonly><br/><br/>";
}
else{
	echo "<label>Type: </label><input type='text' name='gen' value='non-genetic' readonly><br/><br/>";
}

echo "<label>Counting technique: </label><input type='text' name='countTech' value=$get_countTech readonly><br/><br/>";
if($get_countTech!='unknown'){
	$get_count = $_POST['Count'];
	echo "<label>Count: </label><input type='text' name='Count' value=$get_count readonly><br/><br/>";

}
echo "<label>Symptoms: </label><br/><br/>";
printHTMLArray($get_symptom, "Symptom[]");
echo "<label>Diagnosis: </label><br/><br/>";
printHTMLArray($get_diagnosis, "Diagnosis[]");
echo "<label>Treatment: </label><br/><br/>";
printHTMLArray($get_treatment, "Treatment[]");

if($get_gen!='genetic'){
	echo "<label>*** Note: If the above information is correct, it will be inserted into database</label><br/><br/>";
}
else{
	echo "<label>----------Enter gene information---------------</label><br/><br/>";
	$get_chromoCount = $_POST['ChromCount'];
	$get_geneCount = $_POST['GeneCount'];
	echo "<label>Chromosomes: (For missing or duplicated chromosomes, enter 'all' for gene name)
	</label><br/><br/>";
	printHTMLArray($get_chromCount, "ChromCount[]");
	for($x=0; $x<sizeof($get_chromoCount); $x++){
	$t=$get_geneCount[$x];
	$i=1;
	while($t-- > 0){
		echo "<label>Chromosome </label><input type='number' name='Chromosomes[]'   value=$get_chromoCount[$x] readonly><label> | Gene -$i: </label><input type='text' name='Genes[]' required><label> Condition </label><input type='text' name='Condition[]' required><br/><br/> ";
		$i++;
	}
	}
	echo "<label>*** Note: If the above information is correct, it will be inserted into database ***</label><br/><br/>";
}
                      
echo "                          
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
	

?>
