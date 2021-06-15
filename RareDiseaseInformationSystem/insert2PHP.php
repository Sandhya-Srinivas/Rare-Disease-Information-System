<?php

$get_RDname = $_POST['RDname'];
$get_gen = $_POST['gen'];
$get_ageOfOnset = $_POST['Age_of_onset'];
$get_countTech = $_POST['type'];
$get_sympCount = $_POST['SympCount'];
$get_diagCount = $_POST['DiagCount'];
$get_treatCount = $_POST['TreatCount'];


echo " 
<!DOCTYPE html>
<html>
    <head>
        <title>Insert into RDInfo</title>
        <meta charset='utf-8'>
        <link rel = 'stylesheet' href='insertIntoRD.css'/>
        <script>
        	function validate(Y, Z){
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
		    		if(x.search(/[^A-Za-z ]/)!=-1){
		    			alert('Enter only characters '+z+' - '+(i+1));
		    			return false;
		    		}
	    		}
	    		}
	    		
	    		
        	}
        	function validChrom(){
	    		var y=document.getElementsByName('ChromCount[]');
	    		for(var i=0; i<y.length; i++){
	    			for(var j=0; j<y.length; j++){
	    				if((i!=j) && (y[i].value==y[j].value)){
	    					alert('Repeated chromosomes at: '+(i+1)+' and '+(j+1));
		    				return false;
	    				}
	    			}
	    		}
	    		
        	}
	    	function validateForm(){
	    		var a=document.getElementsByName('Symptom[]'); 
	    		var b=document.getElementsByName('Diagnosis[]');
	    		var c=document.getElementsByName('Treatment[]'); 
	    		if(validChrom()==false){
	    			return false;
	    		}
	    		return validate([a,b,c] , ['symptom', 'diagnosis', 'treatment']);
	    	}
        </script>
    </head>
    <body>
        <header><div ><img src='./Images/RDinfoHeading.PNG' alt='Rare Disease Information System' class = 'logoHead'></div></header>
        <main>
            <div >
                <p>Insert</p>
                <form name=\"myForm\" method=\"POST\" action=insert3PHP.php onsubmit=\"return validateForm()\">
                    <fieldset>
                        <legend>Insertion</legend>
                        <div>
                            <label>Rare disease name: </label><input type='text' name='RDname' value='$get_RDname' readonly><br/><br/>
                            <label>Age of onset: </label><input type='text' name=\"Age_of_onset\" value='$get_ageOfOnset' readonly><br/><br/>
                            ";

if($get_gen=='genetic'){
	$get_chromCount = $_POST['ChromCount'];
	echo "<label>Type: </label><input type='text' name='gen' value='genetic' readonly><br/><br/>
                 <label>Enter chromosome numbers and number of genes affected for each chromosome.</label><br/>
		<label>(For duplicate or missing chromosomes, enter the number of affected genes as '1')</label><br/>
		<label>(For chromosomes X or Y, enter the chromosome number as 23 and 24 respectively)</label><br/><br/>";
	for($x=0; $x<$get_chromCount; $x++){
		echo "<label>Enter chromosome number: </label><input id='chrom' type='number' name='ChromCount[]' min=1 max=24 required>
			<label>Enter the number of genes affected: </label><input id='gene' type='number' name='GeneCount[]' min=1 max=10 required><br/><br/>";
	}
}
else{
	echo "<label>Type: </label><input type='text' name='gen' value='non-genetic' readonly><br/><br/>";
}

echo "<label>Counting technique: </label>";
switch($get_countTech){
	case 0: echo "<input type='text' name='countTech' value='unknown' readonly><br/><br/>"; break;
	case 3: echo "<input type='text' name='countTech' value='Prevalance' readonly><br/><br/>"; break;
	case 1: echo "<input type='text' name='countTech' value='Case_count' readonly><br/><br/>"; break;
	case 2: echo "<input type='text' name='countTech' value='Family_count' readonly><br/><br/>"; break;
}
if($get_countTech == 3 ){
	echo "<label>Enter the count: </label><input type='number' name='Count' step=any required><br/><br/>";
}else if($get_countTech !=0 ){
	echo "<label>Enter the count: </label><input type='number' name='Count' step=1 required><br/><br/>";
}

echo "<label>For symptoms, diagnosis and treatment, enter _ instead of space as separator</label><br/><br/>";
echo "<label>Enter the \"Symptoms\"</label><br/><br/>";
for($x=0; $x<$get_sympCount; $x++){
	echo "<label>Enter symptom-$x : </label><input type='text' name='Symptom[]' required><br/><br/> ";
}
echo "<label>Enter the \"Diagnosis\"</label><br/><br/>";      
for($x=0; $x<$get_diagCount; $x++){
	echo "<label>Enter diagnosis-$x : </label><input type='text' name='Diagnosis[]' required><br/><br/> ";
}
echo "<label>Enter the \"Treatment\"</label><br/><br/>";      
for($x=0; $x<$get_treatCount; $x++){
	echo "<label>Enter treatment-$x : </label><input type='text' name='Treatment[]' required><br/><br/> ";
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
