
    <?php
        //$auth_result = CallAPI("POST", "https://www.testlitle.com/sandbox/communicator/online", $_POST['xml']);
		$auth_result = CallAPI("POST", $_POST['endpoint'], $_POST['xml']);
        $xml = simplexml_load_string($auth_result);
        $xml_array = unserialize(serialize(json_decode(json_encode((array) $xml), 1)));
        
        //echo '<pre>';
		//echo $_POST['endpoint'];
        //print_r($xml_array);
        //echo '</pre>';
        
        

    ?>
    
    <div class="page-content">

            <div class="contentText">
                        <img src="images/vantiv_one.png">
                        <form id="fAuthorize" name="fAuthorize" method="post" action="index.php?form=finalize" >

						<header>
						<h2>Authorization Result</h2>
						</header>
						
						<div id="auth_result_instructions" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>When you post an Authorization Request to Vantiv, the response is an AuthorizationResponse message. The actual unfiltered XML is shown below.</p>
							<p>If there is an error, there was probably an error in the submitted authorization request.</p>
							</span>						
						</div>

						<div class="textarea">
									<textarea rows="20" class="user-input" style="width:100%;"><?php echo $auth_result; ?></textarea>
						</div>

						<div id="auth_result_instructions2" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>The merchant application will parse the received XML to extract the key values shown below.</p>
							<p>The <i>litleTxnId</i> is important to retain since this is how future operations like captures, voids or refunds will refer to the transaction.
							<p>The <i>litleToken</i> is also usually retained by the merchant. This is a value that the merchant can safely store in their database and use in future payment transactions to access the customer payment card information.<p>
							<p>Note that the <i>tokenResponse</i> message may include inaccurate data about the card. This is a limitation of the Sandbox environment.</p>
							</span>						
						</div>
						

						<div>
							<label class="desc" id="litleTxnId_label" for="litleTxnId">litleTxnId</label>
							<div>
								<input id="litleTxnId" name="litleTxnId" type="text" readonly="true" value="<?php echo $xml_array['authorizationResponse']['litleTxnId']; ?>" tabindex="1"> 
							</div>
						</div>
						
						<div>	
							<label class="desc" id="orderId_label" for="orderId">orderId</label>
							<div>
								<input id="orderId" name="orderId" type="text" readonly="true" value="<?php echo $xml_array['authorizationResponse']['orderId']; ?>" tabindex="2"> 
							</div>
						</div>						

						<div>	
							<label class="desc" id="response_label" for="response">response</label>
							<div>
								<input id="response" name="response" type="text" readonly="true" value="<?php echo $xml_array['authorizationResponse']['response']; ?>" tabindex="3"> 
							</div>
						</div>						

						<div>	
							<label class="desc" id="responseTime_label" for="responseTime">responseTime</label>
							<div>
								<input id="responseTime" name="responseTime" type="text" readonly="true" value="<?php echo $xml_array['authorizationResponse']['responseTime']; ?>" tabindex="3"> 
							</div>
						</div>						

						<div>	
							<label class="desc" id="message_label" for="message">message</label>
							<div>
								<input id="message" name="message" type="text" readonly="true" value="<?php echo $xml_array['authorizationResponse']['message']; ?>" tabindex="3"> 
							</div>
						</div>						

						<div>	
							<label class="desc" id="authCode_label" for="authCode">authCode</label>
							<div>
								<input id="authCode" name="authCode" type="text" readonly="true" value="<?php echo $xml_array['authorizationResponse']['authCode']; ?>" tabindex="3"> 
							</div>
						</div>						
						
						<header>
						<h2>Capture the payment</h2>
						</header>
						
						<div id="capture_instructions" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>Next, the payment applications constructs a payment capture transaction shown below to move to authorized funds to the merchant account.</p>
							</span>						
						</div>
						
                            <?php
                            $_POST['litleTxnId']= $xml_array['authorizationResponse']['litleTxnId'];

                            $xml_capture = getCapture($_POST);
                            ?>
						

						<div>
							<textarea name="xml" id="xml" rows="12" class="user-input" style="width:100%;"><?php echo $xml_capture; ?></textarea>
							        <input id="user" name="user" type="hidden" value="<?php echo $_POST['user']; ?>">
                                    <input id="password" name="password" type="hidden" value="<?php echo $_POST['password']; ?>">
                                    <input id="reportGroup" name="reportGroup" type="hidden" value="<?php echo $_POST['reportGroup']; ?>">
                                    <input id="orderId" name="orderId" type="hidden" value="<?php echo $_POST['orderId']; ?>">
                                    <input id="id" name="id" type="hidden" value="<?php echo $_POST['id']; ?>">
                                    <input id="customerId" name="customerId" type="hidden" value="<?php echo $_POST['customerId']; ?>">
									<input id="merchantId" name="merchantId" type="hidden" value="<?php echo $_POST['merchantId']; ?>">
									<input id="endpoint" name="endpoint" type="hidden" value="<?php echo $_POST['endpoint']; ?>">
						</div>
						
						<input class="action-button" id="authResult" type="submit" name="submitAuth" value="Step 5 - Capture Payment" >
                        <button class="regular-button" id="clearId" type="button" onclick="window.location.href = 'index.php';">Start over</button>

						<div id="capture_instructions2" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>The Capture transaction references the transaction ID of the received Authorization.</p>
							<p>The Capture results in the authorized funds being transferred from the cardholder issuing bank to the merchant bank account.</p>
							</span>						
						</div>

						
						
						
						<!--
                          <table cellpadding="0" cellspacing="0" class="table1">
                            <tbody>
							
  
                              
                              <tr>
                                <td align="right" class="title">litleTxnId</td>
                                <td align="right" class="title"><input id="litleTxnId" name="litleTxnId" readonly="true" type="text" value="<?php echo $xml_array['authorizationResponse']['litleTxnId']; ?>"/></td>
                              </tr>

                              <tr>
                                <td align="right" class="title">orderId</td>
                                <td align="right" class="title"><input id="orderId" name="orderId" readonly="true" type="text" value="<?php echo $xml_array['authorizationResponse']['orderId']; ?>"/></td>
                              </tr>
                              
                              <tr>
                                <td align="right" class="title">response</td>
                                <td align="right" class="title"><input id="response" name="response" readonly="true" type="text" value="<?php echo $xml_array['authorizationResponse']['response']; ?>"/></td>
                              </tr>

                              <tr>
                                <td align="right" class="title">responseTime</td>
                                <td align="right" class="title"><input id="responseTime" name="responseTime" readonly="true" type="text" value="<?php echo $xml_array['authorizationResponse']['responseTime']; ?>"/></td>
                              </tr>

                              <tr>
                                <td align="right" class="title">message</td>
                                <td align="right" class="title"><input id="message" name="message" readonly="true" type="text" value="<?php echo $xml_array['authorizationResponse']['message']; ?>"/></td>
                              </tr>

                              <tr>
                                <td align="right" class="title">authCode</td>
                                <td align="right" class="title"><input id="authCode" name="authCode" readonly="true" type="text" value="<?php echo $xml_array['authorizationResponse']['authCode']; ?>"/></td>
                              </tr>

                              <tr>
                                <td colspan="2" align="right" class="title">
                                    <h3 style="margin-top: 12px;">Capture the payment</h3>
                                    <div style="font-size:12px; padding:8px;">Next, the payment applications constructs a payment capture transaction shown below to move to authorized funds to the merchant account.</div>
                                </td>
                              </tr>
                            
                            <?php
                            $_POST['litleTxnId']= $xml_array['authorizationResponse']['litleTxnId'];

                            $xml_capture = getCapture($_POST);
                            ?>
                              
                            <tr>
                                <td colspan="2" align="right" class="title">
                                    <textarea name="xml" id="xml" rows="12" class="user-input" style="width:100%;"><?php echo $xml_capture; ?></textarea>
                                </td>                      
                            </tr>

                            <tr>
                                <td colspan="2" align="right" class="title">
                                    <input class="action-button" id="authResult" type="submit" name="submitAuth" value="Step 4 - Capture Payment" >
                                    <button class="regular-button" id="clearId" type="button" onclick="window.location.href = 'index.php';">Start over</button>
                                    <div style="font-size:12px; padding:8px;">The Capture transaction references the transaction ID of the received Authorization. The Capture results in the authorized funds being transferred from the cardholder issuing bank to the merchant bank account.</div>
                                </td>
                            </tr>
                              
                              

                              
                            </tbody>
                          </table>
						  
						  -->
						  
						  
                        </form>
            </div>    
    
    </div>