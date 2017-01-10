
    <?php
        //$capture_result = CallAPI("POST", "https://www.testlitle.com/sandbox/communicator/online", $_POST['xml']);
		$capture_result = CallAPI("POST", $_POST['endpoint'], $_POST['xml']);
        $xml = simplexml_load_string($capture_result);
        $xml_array = unserialize(serialize(json_decode(json_encode((array) $xml), 1)));
        
        //echo '<pre>';
        //print_r($xml_array);
        //echo '</pre>';
    
    ?>
    
    <div class="page-content">

            <div class="contentText">
                        <img src="images/vantiv_one.png">
                        <form id="fAuthorize" name="fAuthorize" method="post" action="index.php?form=finalize" >
						
						<header>
							<h2>Complete the payment</h2>
						</header>

						<div id="finalize_instructions" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>After sending the Capture transaction, Vantiv responds with a Capture Response message. The raw XML is shown below.</p>
							<p>If there is an error in the response message, it is likely because there was an error in the Capture message.</p>
							</span>						
						</div>

						<div class="textarea">
									<textarea rows="12" class="user-input" style="width:100%;" tabindex="1"><?php echo $capture_result; ?></textarea>
						</div>

						<div id="finalize_instructions2" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>The next step is for your application to parse the Capture Response XML and extract the key vaules as shown below.</p>
							</span>						
						</div>

						<div>	
							<label class="desc" id="litleTxnId_label" for="litleTxnId">litleTxnId</label>
							<div>
								<input id="litleTxnId" name="litleTxnId" type="text" readonly="true" value="<?php echo $xml_array['captureResponse']['litleTxnId']; ?>" tabindex="2"> 
							</div>
						</div>						

						<div>	
							<label class="desc" id="response_label" for="response">response</label>
							<div>
								<input id="response" name="response" type="text" readonly="true" value="<?php echo $xml_array['captureResponse']['response']; ?>" tabindex="3"> 
							</div>
						</div>						

						<div>	
							<label class="desc" id="responseTime_label" for="responseTime">responseTime</label>
							<div>
								<input id="responseTime" name="responseTime" type="text" readonly="true" value="<?php echo $xml_array['captureResponse']['responseTime']; ?>" tabindex="4"> 
							</div>
						</div>								

						<div>	
							<label class="desc" id="message_label" for="message">message</label>
							<div>
								<input id="message" name="message" type="text" readonly="true" value="<?php echo $xml_array['captureResponse']['message']; ?>" tabindex="5"> 
							</div>
						</div>	
						
						<button class="regular-button" id="clearId" type="button" onclick="window.location.href = 'index.php';">Start over</button>     
						
						<div id="finalize_instructions3" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>Assuming the Capture was successful, at this point your application can confirm payment in a local database and proceed with the transaction. This concludes our demonstration of eProtect.</p>
							</span>						
						</div>						
						
						<!--
                          <table cellpadding="0" cellspacing="0" class="table1">
                            <tbody>
                              
                    
                              
                              <tr>
                                <td align="right" class="title">litleTxnId</td>
                                <td align="right" class="title"><input id="litleTxnId" name="litleTxnId" readonly="true" type="text" value="<?php echo $xml_array['captureResponse']['litleTxnId']; ?>"/></td>
                              </tr>

                              <tr>
                                <td align="right" class="title">response</td>
                                <td align="right" class="title"><input id="response" name="response" readonly="true" type="text" value="<?php echo $xml_array['captureResponse']['response']; ?>"/></td>
                              </tr>

                              <tr>
                                <td align="right" class="title">responseTime</td>
                                <td align="right" class="title"><input id="responseTime" name="responseTime" readonly="true" type="text" value="<?php echo $xml_array['captureResponse']['responseTime']; ?>"/></td>
                              </tr>

                              <tr>
                                <td align="right" class="title">message</td>
                                <td align="right" class="title"><input id="message" name="message" readonly="true" type="text" value="<?php echo $xml_array['captureResponse']['message']; ?>"/></td>
                              </tr>

                            <tr>
                                <td colspan="2" align="right" class="title">
                                    <button class="regular-button" id="clearId" type="button" onclick="window.location.href = 'index.php';">Start over</button>     
                                    <div style="font-size:12px; padding:8px;">Assuming the Capture was successful, at this point your application can confirm payment in a local database and proceed with the transaction. This concludes our demonstration of eProtect.</div>
                                </td>
                            </tr>
                              
                              
                              
                            </tbody>
                          </table>
						  
						  -->
						  
                        </form>
            </div>    
    
    </div>