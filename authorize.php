
    <?php
        $xml = getAuth($_POST);
    ?>
    
    <div class="page-content">

            <div class="contentText">
                        <img src="images/vantiv_one.png">
                        <form id="fAuthorize" name="fAuthorize" method="post" action="index.php?form=auth_result" >
						<header>
						<h2>eProtect&trade; Demonstration</h2>
						</header>

						<div id="auth_instructions" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>Payment details POSTed to the merchant server are used to construct an XML payment authorization message below.</p>
							<p>Note that no confidential cardholder information is passed to the server helping reduce PCI scope.</p>
							<p>You can edit the XML message below if you choose before submitting the payment transaction to Vantiv eCommerce servers.</p>
							</span>						
						</div>

						<div class="textarea">
									<textarea name="xml" id="xml" rows="20" class="user-input" style="width:100%;"><?php echo $xml; ?></textarea>
                                    <input id="user" name="user" type="hidden" value="<?php echo $_POST['user']; ?>">
                                    <input id="password" name="password" type="hidden" value="<?php echo $_POST['password']; ?>">
                                    <input id="reportGroup" name="reportGroup" type="hidden" value="<?php echo $_POST['reportGroup']; ?>">
                                    <input id="orderId" name="orderId" type="hidden" value="<?php echo $_POST['orderId']; ?>">
                                    <input id="id" name="id" type="hidden" value="<?php echo $_POST['id']; ?>">
                                    <input id="customerId" name="customerId" type="hidden" value="<?php echo $_POST['customerId']; ?>">
									<input id="merchantId" name="merchantId" type="hidden" value="<?php echo $_POST['merchantId']; ?>">
						</div>
						
						<div>
								<label class="desc" id="endpoint_label" for="endpoint">eComm endpoint</label>
								<div>
                                        <select name="endpoint" id="endpoint" tabindex="1" class="field select medium">
											<option value="https://transact-prelive.litle.com/vap/communicator/online">https://transact-prelive.litle.com/vap/communicator/online></option>																					
                                            <option value="https://www.testlitle.com/sandbox/communicator/online">https://www.testlitle.com/sandbox/communicator/online></option>
	
                                        </select>
								</div>
						</div>
						
						 <input class="action-button" id="submitAuth" type="submit" name="submitAuth" value="Step 4 - Authorize Payment" >
                         <button class="regular-button" id="clearId" type="button" onclick="window.location.href = 'index.php';">Start over</button>

						<div id="auth_postinstructions" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>When you click <i>Authorize Payment</i> the XML message above is sent via an SSL protected HTTP Post to a selected Vantiv end-point - either the Sandbox or Pre-live environment.</p>
							<p>Note that the payment credentials are represented by the payPageRegistrationId used to access the vaulted payment card data.</p>
							<p>On the next screen you will see the actual response from Vantiv.</p>
							</span>						
						</div>
						 
						 
											
<!--
						<table cellpadding="0" cellspacing="0" class="table1">
                            <tbody>
                              <tr>
                                <td colspan="2" align="right" class="title">
                                    <h3 style="margin-top: 12px;">eProtect&trade; Demonstration</h3>
                                    <div style="font-size:12px; padding:8px;">Payment details POSTed to the merchant server are used to construct an XML payment authorization message below. Note that no confidential cardholder information is passed to the server helping reduce PCI scope. You can edit the XML message below if you choose before submitting the payment transaction to Vantiv eCommerce servers.</div>
                                </td>                      
                              </tr>
                              <tr>
                                <td colspan="2" align="right" class="title">
                                    <textarea name="xml" id="xml" rows="20" class="user-input" style="width:100%;"><?php echo $xml; ?></textarea>
                                    <input id="user" name="user" type="hidden" value="<?php echo $_POST['user']; ?>">
                                    <input id="password" name="password" type="hidden" value="<?php echo $_POST['password']; ?>">
                                    <input id="reportGroup" name="reportGroup" type="hidden" value="<?php echo $_POST['reportGroup']; ?>">
                                    <input id="orderId" name="orderId" type="hidden" value="<?php echo $_POST['orderId']; ?>">
                                    <input id="id" name="id" type="hidden" value="<?php echo $_POST['id']; ?>">
                                    <input id="customerId" name="customerId" type="hidden" value="<?php echo $_POST['customerId']; ?>">
                                </td>                      
                              </tr>

                              <tr>
                                <td align="right" class="title">eCommerce EndPoint</td>
                                <td>
                                        <select name="endpoint" id="endpoint">
                                            <option value="https://www.testlitle.com/sandbox/communicator/online">https://www.testlitle.com/sandbox/communicator/online></option>
											<option value="https://transact-prelive.litle.com/vap/communicator/online">https://transact-prelive.litle.com/vap/communicator/online></option>											
                                        </select>
                                </td>                      
                              </tr>

                              <tr>
                                <td colspan="2" align="right" class="title">
                                    <input class="action-button" id="submitAuth" type="submit" name="submitAuth" value="Step 3 - Authorize Payment" >
                                    <button class="regular-button" id="clearId" type="button" onclick="window.location.href = 'index.php';">Start over</button>
                                    <div style="font-size:12px; padding:8px;">When you click <i>Authorize Payment</i> the XML message above is sent via an SSL protected HTTP Post to a selected Vantiv end-point - either the Sandbox or Pre-live environment. Note that the payment credentials are represented by the payPageRegistrationId used to access the vaulted payment card data. On the next screen you will see the actual response from Vantiv.</div>
                                </td>                      
                              </tr>

                              
                            </tbody>
                          </table>
-->
                        </form>
            </div>    
    
    </div>