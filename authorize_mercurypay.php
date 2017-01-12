
    <?php
        $xml = getAuth_mercury($_POST);
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
							<p>Payment details POSTed to the merchant server are used to construct an XML payment authorization message to Mercury below.</p>
							<p>Note that no confidential cardholder information is passed to the server helping reduce PCI scope.</p>
							<p>You can edit the XML message below if you choose before submitting the authorization to the Vantiv MercuryPay endpoint.</p>
							</span>						
						</div>

						<div class="textarea">
									<textarea name="xml" id="xml" rows="20" class="user-input" style="width:100%;"><?php echo $xml; ?></textarea>
                                    <input id="user" name="user" type="hidden" value="<?php echo $_POST['user']; ?>">
                                    <input id="password" name="password" type="hidden" value="<?php echo $_POST['password']; ?>">
									<input id="platform" name="platform" type="hidden" value="mercurypay">
                                    <input id="reportGroup" name="reportGroup" type="hidden" value="<?php echo $_POST['reportGroup']; ?>">
                                    <input id="orderId" name="orderId" type="hidden" value="<?php echo $_POST['orderId']; ?>">
                                    <input id="id" name="id" type="hidden" value="<?php echo $_POST['id']; ?>">
                                    <input id="customerId" name="customerId" type="hidden" value="<?php echo $_POST['customerId']; ?>">
									<input id="merchantId" name="merchantId" type="hidden" value="<?php echo $_POST['merchantId']; ?>">
						</div>
						
						<div>
								<label class="desc" id="endpoint_label" for="endpoint">MercuryPay endpoint</label>
								<div>
                                        <select name="endpoint" id="endpoint" tabindex="1" class="field select medium">
											<option value="https://w1.mercurycert.net/ws/ws.asmx">https://w1.mercurycert.net/ws/ws.asmx></option>																					
                                         
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
						 
                        </form>
            </div>    
    
    </div>