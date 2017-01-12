    <?php
        //$auth_result = CallAPI("POST", "https://www.testlitle.com/sandbox/communicator/online", $_POST['xml']);
		$auth_result = CallAPI("POST", $_POST['endpoint'], $_POST['xml'], "mercurypay");
        $xml = simplexml_load_string($auth_result);
		//$xml_array=object2array($xml); 
        $xml_array = unserialize(serialize(json_decode(json_encode((array) $xml), 1)));
        
        //echo '<pre>';
		//echo $_POST['endpoint'];
        //print_r($xml);
		//print_r($xml_array);
        //echo '</pre>';
        
    ?>
    
    <div class="page-content">

            <div class="contentText">
                        <img src="images/vantiv_one.png">
                        <form id="fAuthorize" name="fAuthorize" method="post" action="index.php?form=finalize" >

						<header>
						<h2>MercuryPay Authorization Result</h2>
						</header>
						
						<div id="auth_result_instructions" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>When you post a CreditTransaction to MercuryPay, the response is embedded in a CreditTransactionResponse message. The actual unfiltered XML is shown below.</p>
							<p>If there is an error, there was probably an error in the submitted CreditTransaction request.</p>
							</span>						
						</div>

						<div class="textarea">
									<textarea rows="20" class="user-input" style="width:100%;"><?php echo $auth_result; ?></textarea>
						</div>

						<div id="auth_result_instructions2" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>The merchant application will need to parse the received XML to extract the key values shown below.</p>
							<p>The <i>RecordNo</i> This is your OmniToken. Note that it is formatting preserving and resembles the original card number.
							<p>The <i>CmdStatus</i> This should be Approved if the payment is successful.<p>
							<p>The <i>AuthCode</i> is the Authorization code.</p>
							</span>						
						</div>
						

						<div>
							<label class="desc" id="RecordNo_label" for="RecordNo">RecordNo</label>
							<div>
								<input id="RecordNo" name="RecordNo" type="text" readonly="true" value="<?php echo $xml_array['authorizationResponse']['litleTxnId']; ?>" tabindex="1"> 
							</div>
						</div>
						
						<div>	
							<label class="desc" id="CmdStatus_label" for="CmdStatus">CmdStatus</label>
							<div>
								<input id="CmdStatus" name="CmdStatus" type="text" readonly="true" value="<?php echo $xml_array['authorizationResponse']['orderId']; ?>" tabindex="2"> 
							</div>
						</div>						

						<div>	
							<label class="desc" id="AuthCode_label" for="AuthCode">AuthCode</label>
							<div>
								<input id="AuthCode" name="AuthCode" type="text" readonly="true" value="<?php echo $xml_array['authorizationResponse']['response']; ?>" tabindex="3"> 
							</div>
						</div>						

									
	
                        <button class="regular-button" id="clearId" type="button" onclick="window.location.href = 'index.php';">Start over</button>						  
						  
                        </form>
            </div>    
    
    </div>