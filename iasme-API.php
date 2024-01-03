<?php
//set rand
if(!empty($argv[2])){
	$rand = $argv[2];
}
else{
	//$rand = (string)rand(1000,9999);
}
	//echo print_r($_POST,true);
    //SET URL
    //$server = "ref-portal.iasme.co.uk";
	$server = $_POST['PortalChoice'];
	$job = $_POST['API_Job'];
	//echo "<br/><br/><br/><br/><br/>";
	//echo print_r($server, true);
	//exit();
	if(empty($_POST["Report_in"])) {
		$reportLocation = "-";
	}
	else{
		$reportLocation = $_POST["Report_in"];
	}
    //set org and list
	if(empty($_POST["Org_in"])){
		$orgid = "-";
	}
	if(empty($_POST["Org_in"])) {
		$orgid = $_POST["defaultOrgs"];
	}
	else{
		$orgid = $_POST["Org_in"];
	}
    //$listid = $_POST["Standard_list"];
	if(empty($_POST["Standard_list"])){
		$listid = "-";
	}else{
		$listid = $_POST["Standard_list"];
	}
    $polid = $listid;
	
	//montpellier cfbfadb38e84a32d8171a1d65899b71de332af321b3ef74b24a71de924372e34
	//evendine 8c49c55ddada645f9c3720dc6ac4da32f0751f3af3f406327d635b9838428943
	//montpellier combined 538ae6e7ecb6bf32b489282299ef3a51acc1dc4d82f8aa288acb8b425a6116fd
	//evendine combined bb2de0d3b341c2d2a67eddcac694c431160038e3c43dbd63ec77c487a6303e49

    //contributor_create details
	
    //$newcontname = $_POST["Name_in"];
	if(empty($_POST["Name_in"])){
		$newcontname = "-";
	}else{
		$newcontname = $_POST["Name_in"];
	}
    //$newcontusername = $_POST["NewEmail_in"];
	if(empty($_POST["NewEmail_in"])){
		$newcontusername = "-";
	}else{
		$newcontusername = $_POST["NewEmail_in"];
	}
    //$contsize = $_POST["OrgSize_in"];
	if(empty($_POST["OrgSize_in"])){
		$contsize = "-";
	}else{
		$contsize = $_POST["OrgSize_in"];
	}

    //existing contributor details
	if(empty($_POST["ExistingEmail_in"])){
		$contusername = "-";
	}else{
		$contusername = $_POST["ExistingEmail_in"];
	}
    //$contusername = $_POST["ExistingEmail_in"];

    // verified submit fields
	//name verify
	if(empty($_POST["NameValid_in"])){
		$verifyname = "-";
	}else{
		$verifyname = $_POST["NameValid_in"];
	}
    //$verifyname = $_POST["NameValid_in"];
	//role verify
	if(empty($_POST["titleValid_in"])){
		$verifyrole = "-";
	}else{
		$verifyrole = $_POST["titleValid_in"];
	}
    //$verifyrole = $_POST["titleValid_in"];
	if(empty($_POST["EmailValid_in"])){
		$verifyemail = "-";
	}else{
		$verifyemail = $_POST["EmailValid_in"];
	}
    //$verifyemail = $_POST["EmailValid_in"];
    
    // import answer data file
	//echo print_r($_POST, true);
	//exit();
	if(empty($_POST["outcome_in"])){
		$outcome = "-";
	}else{
		$outcome = $_POST["outcome_in"];
	}

	$answerSheet = 'answer_data_';
	//echo $listid;
	switch ($listid)
	{
		case "cfbfadb38e84a32d8171a1d65899b71de332af321b3ef74b24a71de924372e34":
			$answerSheet .= "mont_";
		break;
		//case "538ae6e7ecb6bf32b489282299ef3a51acc1dc4d82f8aa288acb8b425a6116fd";
		//	$answerSheet .= "montPlus_";
		default:
			$answerSheet = "null";
		break;
	}

	if(empty($answerSheet)){
		// Handle error
		return;
	}

	if(str_contains(strtolower($outcome), "pass")){
		$answerSheet .= "pass";
	}else if(str_contains(strtolower($outcome), "fail")){
		$answerSheet .= "fail";
	}else{
		$answerSheet .= "more_info";
	}
	$answerSheet .= ".php";
	//exit();
	//print($answerSheet);
	//require($answerSheet);//add txt file here for each 




$jobs = array(
	"contributor"=>array(
		"create"=>array(
			"org_id"=>$orgid,
			"list_id"=>$listid,
			"contributor_name"=>$newcontname,
			"contributor_email"=>$newcontusername,
			"contributor_username"=>$newcontusername,
			"contributor_size"=>$contsize,
		),
		"update"=>array(
			"org_id"=>$orgid,
			"list_id"=>$listid,
            "contributor_username"=>$contusername,
			"contributor_size"=>$contsize,
            "contributor_name"=>"$contusername update",
		),
		"move"=>array(
			"org_id"=>$orgid,
			"pol_id"=>$polid,
			"list_id"=>$listid,
			"contributor_username"=>$contusername,
			"newlist_id"=>"538ae6e7ecb6bf32b489282299ef3a51acc1dc4d82f8aa288acb8b425a6116fd",
		),
	),
	"standard"=>array(
		"list"=>array(
			"org_id"=>$orgid,
		),
	),
	"question"=>array(
		"list"=>array(
			"list_id"=>$listid,
            "pol_id"=>$polid,
		),
	),
	"content"=>array(
		"list"=>array(
			"org_id"=>$orgid,
		),
	),
	"answer"=>array(
		"update"=>array(
			"contributor_username"=>$contusername,
			"org_id"=>$orgid,
			"pol_id"=>$polid,
			"list_id"=>$polid,
			"answer_data"=>json_encode($answerSheet),//add txt file here for each result
		),
		"get"=>array(
			"org_id"=>$orgid,
			"contributor_username"=>$contusername,
			"pol_id"=>$polid,
            "list_id"=>$listid,
			"question_names"=>json_encode(array("8571b1ef2cf07fdd9231793a5185a647fab106a426c6e4a6a56fc216666921c0")),
		),),
	"report"=>array(
		"get"=>array(
            "report_location"=> $reportLocation,
			"contributor_username"=>$contusername,
		),
		"getlocation"=>array(
			"contributor_username"=>$contusername,
            //"pol_name"=>$polname,
		),
		"certificate"=>array(
			"contributor_username"=>$contusername,
			"pol_id"=>$polid,
            // "sample"=>"false",
		),
	),
	"submit"=>array(
		"trigger"=>array(
			"org_id"=>$orgid,
			"pol_id"=>$polid,
			"list_id"=>$listid,
			"contributor_username"=>$contusername,
			
			// to not send the verification email, comment out the below 3 lines
            "name"=>$verifyname,
            "role"=>$verifyrole,
            "email"=>$verifyemail,
		),
	),
);


function runJob($jobname,$orgid,$listid,$newcontname,$newcontusername,$contsize,$contusername,$polid,$answer_data,$reportLocation,$verifyemail,$verifyname,$verifyrole,$answerSheet,$echotype=1)
{
	//global $job;
	$outcome = $_POST["outcome_in"];
	$answerSheet = 'answer_data_';
	//echo $listid;
	switch ($listid)
	{
		case "cfbfadb38e84a32d8171a1d65899b71de332af321b3ef74b24a71de924372e34":
			$answerSheet .= "mont_";
		break;
		//case "538ae6e7ecb6bf32b489282299ef3a51acc1dc4d82f8aa288acb8b425a6116fd";
		//	$answerSheet .= "montPlus_";
		default:
			$answerSheet = "null";
		break;
	}

	if(empty($answerSheet)){
		// Handle error
		return;
	}

	/*if(str_contains(strtolower($outcome), "pass")){
		$answerSheet .= "pass";
	}else if(str_contains(strtolower($outcome), "fail")){
		$answerSheet .= "fail";
	}else{
		$answerSheet .= "more_info";
	}
	$answerSheet .= ".php";*/
	//exit();
	//print($answerSheet);
	$answerSheet .= strtolower($outcome);
	$answerSheet .= ".php";
	require_once($answerSheet);//add txt file here for each result
	
	//print_r($answerSheet);
	$jobs = array(
	"contributor"=>array(
		"create"=>array(
			"org_id"=>$orgid,
			"list_id"=>$listid,
			"contributor_name"=>$newcontname,
			"contributor_email"=>$newcontusername,
			"contributor_username"=>$newcontusername,
			"contributor_size"=>$contsize,
		),
		"update"=>array(
			"org_id"=>$orgid,
			"list_id"=>$listid,
            "contributor_username"=>$contusername,
			"contributor_size"=>$contsize,
            "contributor_name"=>"$contusername update",
		),
		"move"=>array(
			"org_id"=>$orgid,
			"pol_id"=>$polid,
			"list_id"=>$listid,
			"contributor_username"=>$contusername,
			"newlist_id"=>$_POST["NewStandard_list"],
		),
	),
	"standard"=>array(
		"list"=>array(
			"org_id"=>$orgid,
		),
	),
	"question"=>array(
		"list"=>array(
			"list_id"=>$listid,
            "pol_id"=>$polid,
		),
	),
	"content"=>array(
		"list"=>array(
			"org_id"=>$orgid,
		),
	),
	"answer"=>array(
		"update"=>array(
			"contributor_username"=>$contusername,
			"org_id"=>$orgid,
			"pol_id"=>$polid,
			"list_id"=>$polid,
			"answer_data"=>json_encode($answerSheet),//add txt file here for each result
		),
		"get"=>array(
			"org_id"=>$orgid,
			"contributor_username"=>$contusername,
			"pol_id"=>$polid,
            "list_id"=>$listid,
			"question_names"=>json_encode(array($_POST["Question_in"])),
		),),
	"report"=>array(
		"get"=>array(
            "report_location"=> $_POST["Report_in"],
			"contributor_username"=>$contusername,
		),
		"getlocation"=>array(
			"contributor_username"=>$contusername,
            //"pol_name"=>$polname,
		),
		"certificate"=>array(
			"contributor_username"=>$contusername,
			"pol_id"=>$polid,
            // "sample"=>"false",
		),
	),
	"submit"=>array(
		"trigger"=>array(
			"org_id"=>$orgid,
			"pol_id"=>$polid,
			"list_id"=>$listid,
			"contributor_username"=>$contusername,
			
			// to not send the verification email, comment out the below 3 lines
            "name"=>$_POST["NameValid_in"],
            "role"=>$_POST["titleValid_in"],
            "email"=>$_POST["EmailValid_in"],
		),
	),
);









	//global $jobs;
	$exp = explode("_",$jobname);
	
	//var_dump($jobs);
	//die(var_dump(isset($exp[1]) && isset($jobs[$exp[0]][$exp[1]])));
	if(isset($exp[1]) && isset($jobs[$exp[0]][$exp[1]])){		
        //set url
        $url = "https://".$_POST["PortalChoice"]."/OPAUDIT/API/index.php";
        
		//echo "\nPosting to $url\n\n";

		//set job parameters
		$fields = $jobs[$exp[0]][$exp[1]];
		// PUT API TOKEN HERE
		$fields['token'] = $_POST["API_in"];
        $fields['job'] = $jobname;
		
		$response = "";

		$response .= "<div class='options' id='response'>";
		//$response .= "<br/><br/>---------------<br/><br/>Posting to URL: " . $url . "<br/><br/>---------------<br/><br/>";

		//echo "--JOB NAME--\n$jobname\n\n";
		// echo "<br/><br/>---------------<br/><br/>Posting to URL: " . $url . "<br/><br/>---------------<br/><br/>";
		if($echotype == 1){
			//echo "--POST PARAMS--\n";
			//foreach($fields as $key => $val){
				//echo "$key: $val\n";
			//}
			//echo "\n--RESPONSE--\n";
		}
		
		// Create cURL request
		$ch = curl_init();
		
		// to send a declaration PDF, uncomment the below line. If a different PDF would like to be used, replace the first and third argument of the curl_file_request function. (set to testfile.pdf).
        //  $fields['declaration'] = curl_file_create("testfile.pdf","application/pdf","testfile.pdf");
		
		//echo "Fields: <br/> " . print_r($fields, true);
		
		//exit();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows); U; Windows NT 6.1; en-GB;");
		
		// Send request



		//exit();




		$json_result = curl_exec($ch);
		// Close connection
		//dump full response if single job
		if($echotype == 1){
			//dump response
			$results = json_decode($json_result,1);
			//print_r($results);
			if(!$results) {
				if($jobname == "report_get") {
					file_put_contents("reportgetresult.pdf",$json_result);
					$response .= "Downloaded PDF";
					// echo "Downloaded PDF\n";
				} elseif ($jobname == "question_list"){
                    file_put_contents("question_list.txt", $json_result);
                }
                else{
                    var_dump('Curl error: ' . curl_error($ch));
					var_dump($json_result);
				}
			}
			else {
				// Parse results
				if(!$results) {
					var_dump('Curl error: ' . curl_error($ch));
					var_dump($json_result);
				}
				else {
					// Parse results
					$results = json_decode($json_result,1);
					if($results['RESULT'] == true){
						$response .= "<div style='margin:auto;font-size:3vh;margin-bottom:1%;background:white;width:50%;justify-content:center'>Job Successful</div></br>";
					}
					//echo print_r($results, true);
                    // $results = json_encode($results, JSON_PRETTY_PRINT);
					echo "<br><div class='options' id='results'>
					Results From Pervade<br/></div>";
					
					//echo $results;
					if($_POST['API_Job'] == "question_list") {
						$questions = $results['questions'];
						foreach($questions as $question){
							$name = $question['name'];
							$id = $question['id'];
							$description = $question['description'];
							$options = empty($question['options']) ? 'No Options' : $question['options'];
							$markingOptions = $question['markingoptions'];
							$response .= "<br><div class='resultBox'><div class='Name'>" . $question['name'] . "</div><h3>------<div class='Q_ID'>" . $id . "</div>------</h3>";
							$response .= "<p><div class='Q_desc'>" . $description . "</div></p>";

							if(is_array($options)){
								$response .= "<div style='font-size:100%;font-weight:bold'>Answer Type: Drop Down</div>";
								$response .= "<div style='font-size:100%;font-weight:bold'>Options: </div>";
								foreach($options as $option){
									$response .= "<div style='font-size:100%'><p>" . $option . "</p></div>";
								}
							}else{
								$response .= "<div style='font-size:100%;font-weight:bold'>Answer Type: Text Box</div>";
							}
							$response .= "</br>";
							$response .= "<div style='font-size:100%;font-weight:bold'>Marking:</div>";
							foreach($markingOptions as $markingOption){
								$response .= "<div style='font-size:100%'><p>" . $markingOption . "</p></div>";
							}
							$response .= "</div>";
							//echo print_r($question['compliancefields']);
						}
					}
					if($_POST['API_Job'] == "standard_list") {
						$standards = $results["standards"];
						foreach($standards as $id => $standard){
							$response .= "<div class='resultBox'><div class='Name'>" . $standard['name'] . "</div>";
							$response .= "<div class='standard_ID'>Standard ID: $id</div></br>";
							$response .= "</div>";
						}		
					}
					if($_POST["API_Job"] == "contributor_create") {
						if($results['RESULT'] == false){
							//echo print_r($results);
							$error = '';
							$response .= "<div style='margin:auto;font-size:3.5vh;margin-bottom:1%;background:white;width:50%;justify-content:center'>Job Failed</div>";
							array_key_exists('error',$results) ? $error = $results['error']: $error = $results['errors']['0'];
							$response .= "<div style=font-size:110%>" . $error . "</div>";
						}else{	
							$username = $results["username"];
							$password = $results["password"];
							$response .= "<div class='resultBox'><div class='Name'>Login Details:</div>";
							$response .= "<div class='Q_desc' id='username'>Username: " . $username . "</br>";
							$response .=  "<div id='password'>Password: " . "<b>" . $password . "</b>" . "</div>";
							$response .=  "</div></div>";
						}
					}
					if($_POST["API_Job"] == "contributor_move") {
						//print_r($results);
						if(array_key_exists('error',$results)){
							$response .= "<div style='margin:auto;font-size:3.5vh;margin-bottom:1%;background:white;width:50%;justify-content:center'>Job Failed</div>";
							$response .= "<div style='font-size:110%'>" . $results['error'] . "</div>";
						}else{
					}
					}
					if($_POST["API_Job"] == "submit_trigger"){
						if(array_key_exists("errors",$results)){
							$response .= "<div style='margin:auto;font-size:3.5vh;margin-bottom:1%;background:white;width:50%;justify-content:center'>Job Failed</div>";
							$response .= "<div style='font-size:110%'>" . $results['errors']["0"] . "</div>";
						}
						else if(array_key_exists("error",$results)){
							$response .= "<div style='margin:auto;font-size:3.5vh;margin-bottom:1%;background:white;width:50%;justify-content:center'>Job Failed</div>";
							$response .= "<div style='font-size:110%'>" . $results['error'] . "</div>";
						}
						else{
							$response .= "<div style='font-size:110%'>Submission email sent</div>";
						}
					}
					if($_POST["API_Job"] == "contributor_move"){
						if($results["RESULT"] == true){
							$response .= "<div style='font-size:110%'>Applicant has moved standards</div>";
						}
					}
					if($_POST["API_Job"] == "answer_get"){
						if($results["RESULT"] == true){
							foreach($results["answers"] as $key => $QuestionID){
								$response .= "<div style='font-size:110%;padding:2%'>Result: " . $QuestionID . "</div></div>";
							}
						}
						else if(array_key_exists("errors",$results)){
							$response .= "<div style='font-size:110%'>" . $results["errors"]["0"] . "</div>";
						}
						else{
							$response .= "<div style='font-size:110%'>Permission denied</div>";
						}
					}
					if($_POST["API_Job"] == "report_get_location"){
						/*if($results["RESULT"] == true){
							echo "<br><div class='options' id='results'>Results From Pervade<br/></div>";
							$response .= "<div class='resultBox'><div class='Name'>Report Location: </div>";
							$response .= "<div style='padding:2%;overflow-wrap: break-word'>" . $results["report_location"] . "</div>";
							$response .= "<div style='font-size:110%;padding:2%'>Copy and paste this into 'download a report' to download</div></div>";
						}*/
						if (array_key_exists("error",$results)){
							$response .= "<div style='font-size:110%'>" . $results["error"] . "</div>";
						}
						else if(array_key_exists("errors",$results)){
							$response .= "<div style='font-size:110%'>" . $results["errors"]["0"] . "</div>";
						}
						else{
							$response .= "<div class='resultBox'><div class='Name'>Report Location: </div>";
							$response .= "<div style='padding:2%;overflow-wrap: break-word'>" . $results["report_location"] . "</div>";
						}
					}
					//print($reportLocation);
					//echo($_POST["API_Job"]);
					if($_POST["API_Job"] == "report_get"){
						//print_r($results);
						if($results["RESULT"] == true){
							$response .= "<div style='font-size:110%'>Downloaded</div>";
						}
						else if(array_key_exists("errors",$results)){
							$response .= $results["errors"]["0"];
						}
						else{
							$response .= $results["error"];
						}
					}
					if($_POST["API_Job"] == "answer_update"){
						if($results["RESULT"] == true){
							$response .= "<div style='font-size:110%'>Answers updated</div>";
						}
						else if(array_key_exists("errors",$results)){
							$response .= "<div style='font-size:110%'>" . $results["errors"]["0"] . "</div>";
						}
						else{
							$response .= "<div style='font-size:110%'>" . $results["error"] . "</div>";
						}
					}
				//echo print_r($results, true);
					//echo "<br/><h1>Test Out</h1>";
					//echo print_r($results, true);
                    file_put_contents("job_response.json",$json_result);
				}
			}
		}
		else if($echotype == 2){
			//echo reduced info so that it's readable as all jobs are done
			//echo "RESULT: ". (string)(isset($json_result['RESULT']) && $json_result['RESULT'])."\n";
		}
		
		//OUTPUT FULL RESULTS TO FILE
		
	}
	else{
		echo "\nJob doesn't exist: $jobname\n\n";
	}

	$response .= "</div>";
	echo $response;
}

/*if(!empty($argv[1])) {
	echo "\nTest value ID: $rand\n";
	if($argv[1] == "all"){
		//run all jobs
		foreach($jobs as $type => $names){
			foreach($names as $name => $params){
				runJob("{$type}_{$name}",2);
			}
		}
	}
	else{
		runJob($argv[1],1);
	}
}*/

?>