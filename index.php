<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <html lang="en" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#"> -->

<?php
  require(dirname(__FILE__).'/includes/form_funcs.php');
  require(dirname(__FILE__).'/includes/credentials.php');
?>
<html>
  <head profile="http://www.w3.org/1999/xhtml/vocab">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>Sample eProtect check out page</title>
    <style>
      <?php
        /* require(dirname(__FILE__).'/css/eprotect.css'); */
		require(dirname(__FILE__).'/css/responsive.css');
      ?>
    </style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
  </head>
  
  <?php
    // Handle case where capture transaction is submitted to be finalized
    if ((isset($_GET['form'])) && ($_GET['form']=='finalize')) {
        ?>
        <body>
            <!-- <pre>
            <?php //print_r($_POST);?>
            </pre> -->
            <?php
                require(dirname(__FILE__).'/finalize.php');
            ?>
        </body>
        <?php
        exit();
    }

  
    // Handle case where transaction is submitted for authorization
    if ((isset($_GET['form'])) && ($_GET['form']=='auth_result')) {
        ?>
        <body>
             <!-- <pre>
            <?php //print_r($_POST);?>
            </pre>  -->
            <?php
                require(dirname(__FILE__).'/auth_result.php');
            ?>
        </body>
        <?php
        exit();
    }
  
    // Handle case where transaction is submitted for authorization
    if ((isset($_GET['form'])) && ($_GET['form']=='authorize')) {
        ?>
        <body>
            <!-- <pre>
            <?php // print_r($_POST);?>
            </pre> -->
            <?php
				if ($_POST['platform']=='litle') {
					require(dirname(__FILE__).'/authorize.php');
				}
				if ($_POST['platform']=='mercurypay') {
					require(dirname(__FILE__).'/authorize_mercurypay.php');
				}
				if ($_POST['platform']=='core') {
					require(dirname(__FILE__).'/authorize_core.php');
				}

            ?>
        </body>
        <?php
        exit();
    }
  ?>
  <body>
    <div>
                      
                      <!-- <script type="text/javascript" src="https://request-prelive.np-securepaypage-litle.com/LitlePayPage/litle-api2.js"></script> -->
					  <script type="text/javascript" src="<?php echo $eprotect_url;?>"></script>
                      <script>
                        function populate_fields() {
                            $('#name').val("John H. Smith");
                            $('#address').val("123 Main Street");
                            $('#ccNum').val("5454545454545454");
                            $('#cvv2Num').val("111");
                            $('#expDate').val("0117");
                            $('#country').val('US');
                            $('#state').val('NY');
                            $('#cardtype').val('mastercard');
                            $('#zip').val("12345");
                            $('#amount').val("100.00");
                            $('#city').val("Albany");
                            $('#email').val("john.doe@gmail.com");
                            $('#phone').val("(212) 555-1212");
                            
                            
                        }
                        function clear_fields() {
                            $('#name').val("");
                            $('#address').val("");
                            $('#ccNum').val("");
                            $('#cvv2Num').val("");
                            $('#expDate').val("");
                            $('#country').val('AF');
                            $('#state').val('AL');
                            $('#cardtype').val('visa');
                            $('#zip').val("");
                            $('#amount').val("");
                            $('#city').val("");
                            $('#email').val("");
                            $('#phone').val("");        
                        }
                        
                      </script>
                      <script>
                        $(document).ready(						
                            function(){
                                function setLitleResponseFields(response) {
                                    document.getElementById('response$code').value = response.response;
                                    document.getElementById('response$message').value = response.message;
                                    document.getElementById('response$responseTime').value = response.responseTime;
                                    document.getElementById('response$reportGroup').value = response.reportGroup;
                                    document.getElementById('response$merchantTxnId').value = response.id;
                                    document.getElementById('response$orderId').value = response.orderId;
                                    document.getElementById('response$litleTxnId').value = response.litleTxnId;
                                    document.getElementById('response$type').value = response.type;
                                    // include these forms used in Litle authorize transaction
                                    document.getElementById('id').value = response.id;
                                    document.getElementById('reportGroup').value = response.reportGroup;
                                    document.getElementById('orderId').value = response.orderId;
									document.getElementById('user').value = document.getElementById("inputUser").value;
									document.getElementById('password').value = document.getElementById("inputPassword").value;
									document.getElementById('customerId').value = document.getElementById("inputCustomerId").value;
									document.getElementById('merchantId').value = document.getElementById("inputmerchantId").value;
                                }
                                
                                function submitAfterLitle (response) {
                                    setLitleResponseFields(response);
                                    /* For this demonstration don't call submit because we are invoking it manually for clarity
                                    document.forms['fCheckout'].submit();
                                    */
                                }
                            
                                function onErrorAfterLitle (response) {
                                    setLitleResponseFields(response);
									
									if(response.response == '871') {
										alert("Invalid card number. Check and retry. (Not Mod10)");
									}
									else if(response.response == '872') {
										alert("Invalid card number. Check and retry. (Too short)");
									}
									else if(response.response == '873') {
										alert("Invalid card number. Check and retry. (Too long)");
									}
									else if(response.response == '874') {
										alert("Invalid card number. Check and retry. (Not a number)");
									}
									else if(response.response == '875') {
										alert("We are experiencing technical difficulties. Please try again later or call 555-555-1212");
									}
									else if(response.response == '876') {
										alert("Invalid card number. Check and retry. (Failure from Server)");
									}
									else if(response.response == '881') {
										alert("Invalid card validation code. Check and retry. (Not a number)");
									}
									else if(response.response == '882') {
										alert("Invalid card validation code. Check and retry. (Too short)");
									}
									else if(response.response == '883') {
										alert("Invalid card validation code. Check and retry. (Too long)");
									}
									else if(response.response == '889') {
										alert("We are experiencing technical difficulties. Please try again later or call 555-555-1212");
									}
									
                                    return false;
                                }
                                
                                var elapsedTime;
								
								/* $("#populateId").animate({background-color:"#ffe"},'slow'); */
								
                                function onTimeoutAfterLitle() {
                                    //alert('Timed out');
                                    elapsedTime = new Date().getTime() - elapsedTime;
                                    document.getElementById('timeoutMessage').value = 'Timed out after ' + elapsedTime + 'ms';
                                }
                                
                                var formFields = {
                                    "accountNum"   :document.getElementById('ccNum'), 
                                    "cvv2" :document.getElementById('cvv2Num'),
                                    "expDate" :document.getElementById('expDate'),
                                    "paypageRegistrationId":document.getElementById('paypageRegistrationId'),
                                    "bin"  :document.getElementById('bin') 
                                };
								
								$("#show_eprotect_response").click(function(){
									$("#eprotect_response").fadeToggle();
								});
								
								$("#show_eprotect_variables").click(function(){
									$("#variables_passed").fadeToggle();
								});
								
								$("#instruction_title").click(function(){
									$("#instructions").fadeToggle();
								});
								
								$("#close").click(function(){
									this.parentNode.parentNode.removeChild(this.parentNode);
									return false;
								});
								

                                $("#submitLitleId").click(
                                    function(){
                                        // clear test fields
                                        setLitleResponseFields({"response":"", "message":""});
                                        document.getElementById('timeoutMessage').value="";
                                        
                                        elapsedTime=new Date().getTime();
                                        
                                        var litleRequest = {
                                            "paypageId" : document.getElementById("request$paypageId").value,
                                            "reportGroup" : document.getElementById("request$reportGroup").value,
                                            "orderId" : document.getElementById("request$orderId").value,
                                            "id" : document.getElementById("request$merchantTxnId").value,
                                            "url" : 'https://request-prelive.np-securepaypage-litle.com'
                                        };
                        
                                        var timeout = document.getElementById("request$timeout").value;
                                        new LitlePayPage().sendToLitle(litleRequest, formFields, submitAfterLitle, onErrorAfterLitle, onTimeoutAfterLitle, timeout);
										$('#hidden_eprotect_fields').show()
                                        return false;
                                        
                                    }
                                );
                            }
                        );
                      </script>
                    
              
                      <div>
                        <img src="images/vantiv_one.png">
                        <form id="fCheckout" name="fCheckout" method="post" action="index.php?form=authorize" >
						<header>
						<h2>eProtect&trade; Demonstration</h2>
						</header>

						<!-- <div id="instruction_title" class="instruction_title">
							<span style="vertical-align: middle;">SHOW/HIDE INSTRUCTIONS</span>
						</div> -->
						<div id="instructions" class="instructions" >
							<span id='close'>x</span>
							<span style="font-size:12px; padding:8px 0px;">
							<p>This demo illustrates the inner workings of Vantiv eProtect.</p>
							<p>It shows a technical audience how sensitive card data is replaced by a low-value token used to securely authorize payments across multiple Vantiv payment platforms.</p>
							<p>To get started, press <b>Step 1: Populate Fields</b> or manually key payment details yourself.</p>
							<p>To manually adjust input variables (provide different credentials for example) expose the eProtect Input Variables at the bottom of the screen before proceeding to Step 2.</p>
							</span>						
						</div>
						

						
                        <button class="action-button"  id="populateId" type="button" onclick="populate_fields();">Step 1: Populate Fields</button>
						
						<hr>
                        
						<!-- <button class="regular-button" id="clearId" type="button" onclick="clear_fields();">Clear Fields</button> -->
                        
						<!-- Responsive form style borrowed from https://codepen.io/chriscoyier/pen/DmnlJ -->


						
						
							<div>
								<label class="desc" id="name_label" for="name">Full Name</label>
								<div>
									<input id="name" name="name" type="text" class="field text fn" value="" size="8" tabindex="1">
								</div>
							</div>
    
							<div>
								<label class="desc" id="address_label" for="address">Address</label>
								<div>
									<input id="address" name="address" type="text" spellcheck="false" value="" maxlength="50" tabindex="2"> 
								</div>
							</div>

							<div>
								<label class="desc" id="city_label" for="city">City</label>
								<div>
									<input id="city" name="city" type="text" spellcheck="false" value="" maxlength="50" tabindex="3"> 
								</div>
							</div>
							
							<div>
								<label class="desc" id="state_label" for="state">State/Province</label>
								<div>								
									<select id="state" name="state" class="field select medium" tabindex="4">
									<?php state_options(); ?>
									</select>
								</div>
							</div>							
	
							<div>
								<label class="desc" id="zip_label" for="zip">Zip/PostalCode</label>
								<div>
									<input id="zip" name="zip" type="text" spellcheck="false" value="" size="10" tabindex="5"> 
								</div>
							</div>

							<div>
								<label class="desc" id="country_label" for="country">Country</label>
								<div>								
									<select id="country" name="country" class="field select medium" tabindex="6">
									<?php country_options(); ?>
									</select>
								</div>
							</div>		
							
							<div>
								<label class="desc" id="email_label" for="email">eMail</label>
								<div>
									<input id="email" name="email" type="email" spellcheck="false" value="" tabindex="7"> 
								</div>
							</div>
							
							<div>
								<label class="desc" id="phone_label" for="phone">Phone</label>
								<div>
									<input id="phone" name="phone" type="text" spellcheck="false" value="" tabindex="8"> 
								</div>
							</div>

							<div>
								<label class="desc" id="amount_label" for="amount">Amount $</label>
								<div>
									<input id="amount" name="amount" type="text" spellcheck="false" value="" tabindex="9"> 
								</div>
							</div>

							<div>
								<label class="desc" id="cardtype_label" for="cardtype">Card Type</label>
								<div>								
									<select id="cardtype" name="cardtype" class="field select medium" tabindex="10">
										<option value="visa">VISA</option>
										<option value="mastercard">MasterCard</option>
										<option value="amex">American Express</option>
										<option value="discover">Discover</option>
									</select>
									
								</div>
							</div>		

							<div>
								<label class="desc" id="ccNum_label" for="ccNum">Card Number</label>
								<div>
									<input id="ccNum" name="ccNum" type="text" spellcheck="false" value="" tabindex="11"> 
								</div>
							</div>
							
							<div>
								<label class="desc" id="cvv2Num_label" for="cvv2Num">CVV</label>
								<div>
									<input id="cvv2Num" name="cvv2Num" type="text" spellcheck="false" value="" tabindex="12"> 
								</div>
							</div>

							<div>
								<label class="desc" id="expDate_label" for="expDate">Expiry Date (MMYY)</label>
								<div>
									<input id="expDate" name="expDate" type="text" spellcheck="false" value="" tabindex="13"> 
								</div>
							</div>
							
							<div>
								<fieldset>    
								<legend id="platform_label" class="desc">Payment Platform</legend>
								<div>
									<input id="platformDefault" name="platform" type="hidden" value="">
									<div>
										<input id="platform_0" name="platform" type="radio" value="litle" tabindex="5" checked="checked">
										<label class="choice" for="platform_0">Vantiv eCommerce (Litle)</label>
									</div>
									<div>
										<input id="platform_1" name="platform" type="radio" value="mercurypay" tabindex="6">
										<label class="choice" for="platform_1">Vantiv IP (MercuryPay)</label>
									</div>
									<div>
										<input id="platform_2" name="platform" type="radio" value="core" tabindex="7">
										<label class="choice" for="platform_2">Vantiv Core (ISO 8583)</label>
									</div>
								</div>
								</fieldset>
							</div>

						<div id="checkout_instructions" class="instructions" >
							<span style="font-size:12px; padding:8px 0px;">
							<p>Press <b>Step 2: Checkout</b> to show how eProtect safeguards sensitive cardholder data.</p>							
							</span>						
						</div>
							
							
							<button class="action-button" id="submitLitleId" type="button">Step 2: Checkout</button>
							<hr>
							
							<span id="hidden_eprotect_fields" style="display:none;">
							
							<div id="checkout_instructions" class="instructions" >
								<span style="font-size:12px; padding:8px 0px;">
								<p>When you checkout using eProtect, PCI sensitive fields such as the Card Number (PAN) are passed along with eProtect input variables (see below) to the eProtect service.</p>
								<p>A <i>payPageRegistrationId</i> is returned by eProtect that allows the payment application to reference the payment credentials stored in Vantiv's vault. Notice that the card number is masked to avoid sensitive data being transmitted.</p>
								<p>When the checkout form is POSTed to the eCommerce server, the hidden variables below are included as part of the payment transaction.</p>
								<p>Normally the eProtect call and the POSTing of the variables to the server for authorization would be part of the same step, but they are separate in this demo for clarity.</p>
								</span>						
							</div>
														
							<div>
								<header>
								<h2>Hidden eProtect fields</h2>
								</header>
							</div>

							<div>
								<label class="desc" id="paypageRegistrationId_label" for="paypageRegistrationId">paypageRegistrationId</label>
								<div>
									<input id="paypageRegistrationId" name="paypageRegistrationId" type="text" readonly="true" value="" tabindex="14"> 
								</div>
							</div>

							<div>
								<label class="desc" id="bin_label" for="bin">BIN</label>
								<div>
									<input id="bin" name="bin" type="text" readonly="true" value="" tabindex="15"> 
								</div>
							</div>

							<div>
								<label class="desc" id="id_label" for="id">id</label>
								<div>
									<input id="id" name="id" type="text" readonly="true" value="" tabindex="16"> 
								</div>
							</div>

							<div>
								<label class="desc" id="reportGroup_label" for="reportGroup">reportGroup</label>
								<div>
									<input id="reportGroup" name="reportGroup" type="text" readonly="true" value="" tabindex="17"> 
								</div>
							</div>

							<div>
								<label class="desc" id="orderId_label" for="orderId">orderId</label>
								<div>
									<input id="orderId" name="orderId" type="text" readonly="true" value="" tabindex="18"> 
								</div>
							</div>

							<div>
								<label class="desc" id="customerId_label" for="customerId">customerId</label>
								<div>
									<input id="customerId" name="customerId" type="text" readonly="true" value="" tabindex="19"> 
								</div>
							</div>

							<div>
								<label class="desc" id="merchantId_label" for="merchantId">merchantId</label>
								<div>
									<input id="merchantId" name="merchantId" type="text" readonly="true" value="" tabindex="20"> 
								</div>
							</div>

							
							<div>
								<label class="desc" id="user_label" for="user">User</label>
								<div>
									<input id="user" name="user" type="text" readonly="true" value="" tabindex="21"> 
								</div>
							</div>
							
							<div>
								<label class="desc" id="password_label" for="password">Password</label>
								<div>
									<input id="password" name="password" type="text" readonly="true" value="" tabindex="22"> 
								</div>
							</div>
							
							
							<div>
								<input class="action-button" id="submitFormId" type="submit" value="Step 3 - Authorize" name="submitFormId">
							</div>
							<hr>
							
							</span>
							
						</form>

						<div id="show_eprotect_variables" class="instruction_title">
							<span style="vertical-align: middle;">SHOW/HIDE EPROTECT INPUT VARIABLES</span>
						</div>

						
					  
					  <div id="variables_passed" style="display:none;">
							<div id="eprotect_input_instructions" class="instructions" >
								<span style="font-size:12px; padding:8px 0px;">
								<p>The fields below are hidden from the user and are normally coded as parameters into the payment application or retrieved from a database. Parameters include credentials to connect to the eProtect service, credentials to connect to a Vantiv processing interface and details like merchant and customer identifiers.</p>
								
								<p>eProtect Fields included in LitleRequest()</p>
								<ul>
								<li>paypageId - A unique number for the merchant assigned to allow access to the eProtect servuce</li>
								<li>id - The LitleXML required attribute assigned by the presenter and mirrored back in the response</li>
								<li>orderId - The merchant-assigned unique value representing the order in your system.</li>
								<li>reportGroup - The LitleXML required attribute that defines under which merchant sub-group this transaction will be displayed in iQ Reporting and Analytics</li>
								<li>timeout - The number of milliseconds before a transaction times out and the timeout callback in invoked.</li>								
								</ul>
								<p>Additional parameters to facilitate payment transaction</p>
								<ul>
								<li>merchantId - Unique id used in LitleXML transaction to identify the merchant</li>
								<li>User - Used for authentication as part of LitleXML transaction</li>
								<li>Password - Used for authentication as part of LitleXML transaction</li>
								<li>customerId - A string provided as part of a LitleXML payment transaction to identify a customer</li>
								</ul>
								</span>						
							</div>

					  <form>
							
							<div>
								<label class="desc" id="request$paypageId_label" for="request$paypageId">paypageId</label>
								<div>
									<!-- <input id="request$paypageId" name="request$paypageId" type="text" class="field text fn" tabindex="30" value="MDTt5iuXQ2ma99Lb"> -->
									<input id="request$paypageId" name="request$paypageId" type="text" class="field text fn" tabindex="30" value="<?php echo $eprotect_paypageid;?>">
								</div>
							</div>

							<div>
								<label class="desc" id="request$merchantTxnId_label" for="request$merchantTxnId">id</label>
								<div>
									<input id="request$merchantTxnId" name="request$merchantTxnId" type="text" class="field text fn" tabindex="31" value="12345">
								</div>
							</div>

							<div>
								<label class="desc" id="request$orderId_label" for="request$orderId">orderId</label>
								<div>
									<input id="request$orderId" name="request$orderId" type="text" class="field text fn" tabindex="32" value="cust_order">
								</div>
							</div>

							<div>
								<label class="desc" id="request$reportGroup_label" for="request$reportGroup">reportGroup</label>
								<div>
									<input id="request$reportGroup" name="request$reportGroup" type="text" class="field text fn" tabindex="33" value="67890">
								</div>
							</div>

							<div>
								<label class="desc" id="request$timeout_label" for="request$timeout">timeout (ms)</label>
								<div>
									<input id="request$timeout" name="request$timeout" type="text" class="field text fn" tabindex="34" value="5000">
								</div>
							</div>

							<div>
								<label class="desc" id="inputmerchantId_label" for="inputmerchantId">MerchantId</label>
								<div>
									<!-- <input id="inputUser" name="inputUser" type="text" class="field text fn" tabindex="35" value="JoesStore"> -->
									<input id="inputmerchantId" name="inputmerchantId" type="text" class="field text fn" tabindex="35" value="<?php echo $ecomm_merchant_id;?>">
								</div>
							</div>

						
							<div>
								<label class="desc" id="inputUser_label" for="inputUser">User</label>
								<div>
									<!-- <input id="inputUser" name="inputUser" type="text" class="field text fn" tabindex="35" value="JoesStore"> -->
									<input id="inputUser" name="inputUser" type="text" class="field text fn" tabindex="36" value="<?php echo $ecomm_login;?>">
								</div>
							</div>

							<div>
								<label class="desc" id="inputPassword_label" for="inputPassword">Password</label>
								<div>
									<!-- <input id="inputPassword" name="inputPassword" type="text" class="field text fn" tabindex="36" value="JoesPassword"> -->
									<input id="inputPassword" name="inputPassword" type="text" class="field text fn" tabindex="37" value="<?php echo $ecomm_password;?>">
								</div>
							</div>

							<div>
								<label class="desc" id="inputCustomerId_label" for="inputCustomerId">customerId</label>
								<div>
									<input id="inputCustomerId" name="inputCustomerId" type="text" readonly="true" value="6548346" tabindex="38"> 
								</div>
							</div>
							

					  </form>
					  </div>

					  



					  	<div id="show_eprotect_response" class="instruction_title">
							<span style="vertical-align: middle;">SHOW/HIDE EPROTECT RESPONSE VARIABLES</span>
						</div>

					  
					  <div id="eprotect_response" style="display:none;">
					  
					  	<div id="response_instructions" class="instructions">
							<span style="font-size:12px; padding:8px 0px;">The fields below are returned from the eProtect sendtoLitle() JavaScript method.</span>						
						</div>
					  
					  <form>

							<div>
								<label class="desc" id="response$code_label" for="response$code">Response Code</label>
								<div>
									<input id="response$code" name="response$code" type="text" class="field text fn" tabindex="40" readonly="true" class="protected">
								</div>
							</div>

							<div>
								<label class="desc" id="response$responseTime_label" for="response$responseTime">Response Time (ms)</label>
								<div>
									<input id="response$responseTime" name="response$responseTime" type="text" class="field text fn" tabindex="41" readonly="true" class="protected">
								</div>
							</div>

							<div>
								<label class="desc" id="response$message_label" for="response$message">Response Message</label>
								<div>
									<input id="response$message" name="response$message" type="text" class="field text fn" tabindex="42" readonly="true" class="protected">
								</div>
							</div>

							<div>
								<label class="desc" id="response$litleTxnId_label" for="response$litleTxnId">Litle Txn Id</label>
								<div>
									<input id="response$litleTxnId" name="response$litleTxnId" type="text" class="field text fn" tabindex="43" readonly="true" class="protected">
								</div>
							</div>

							<div>
								<label class="desc" id="response$merchantTxnId_label" for="response$merchantTxnId">Merchant Txn Id</label>
								<div>
									<input id="response$merchantTxnId" name="response$merchantTxnId" type="text" class="field text fn" tabindex="44" readonly="true" class="protected">
								</div>
							</div>

							<div>
								<label class="desc" id="response$orderId_label" for="response$orderId">Order Id</label>
								<div>
									<input id="response$orderId" name="response$orderId" type="text" class="field text fn" tabindex="45" readonly="true" class="protected">
								</div>
							</div>

							<div>
								<label class="desc" id="response$reportGroup_label" for="response$reportGroup">Report Group</label>
								<div>
									<input id="response$reportGroup" name="response$reportGroup" type="text" class="field text fn" tabindex="46" readonly="true" class="protected">
								</div>
							</div>

							<div>
								<label class="desc" id="response$type_label" for="response$type">Response Type</label>
								<div>
									<input id="response$type" name="response$type" type="text" class="field text fn" tabindex="47" readonly="true" class="protected">
								</div>
							</div>

							<div>
								<label class="desc" id="timeoutMessage_label" for="timeoutMessage">Timeout Message</label>
								<div>
									<input id="timeoutMessage" name="timeoutMessage" type="text" class="field text fn" tabindex="48" readonly="true" class="protected">
								</div>
							</div>
							
							
					  </form>
					  </div>					  
           
					  				  
				
                      </div> <!-- ContentText --> 
    </div>
 
  </body>
</html>

