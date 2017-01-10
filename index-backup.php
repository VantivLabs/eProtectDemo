<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <html lang="en" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#"> -->

<?php
  require(dirname(__FILE__).'/includes/form_funcs.php');
?>
<html>
  <head profile="http://www.w3.org/1999/xhtml/vocab">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>Sample eProtect check out page</title>
    <style>
      <?php
        require(dirname(__FILE__).'/css/eprotect.css');
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
            </pre>  -->
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
            <?php //print_r($_POST);?>
            </pre> -->
            <?php
                require(dirname(__FILE__).'/authorize.php');
            ?>
        </body>
        <?php
        exit();
    }
  ?>
  <body class="html not-front not-logged-in one-sidebar sidebar-first page-node page-node- page-node-1324 node-type-book logo_standard vantiv respond" >
    <div class="page-content">
                      
                      <script type="text/javascript" src="https://request-prelive.np-securepaypage-litle.com/LitlePayPage/litle-api2.js"></script>
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
                                    
                                }
                                
                                function submitAfterLitle (response) {
                                    setLitleResponseFields(response);
                                    /* For this demonstration don't call submit because we are invoking it manually for clarity
                                    document.forms['fCheckout'].submit();
                                    */
                                }
                            
                                function onErrorAfterLitle (response) {
                                    setLitleResponseFields(response);
                                    return false;
                                }
                                
                                var elapsedTime;
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
									$("#api_response").fadeToggle();
								});
								
								$("#show_eprotect_variables").click(function(){
									$("#variables_passed").fadeToggle();
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
                                        return false;
                                        
                                    }
                                );
                            }
                        );
                      </script>
                    
              
                      <div class="contentText">
                        <img src="images/vantiv_one.png">
                        <form id="fCheckout" name="fCheckout" method="post" action="index.php?form=authorize" >
                          <table cellpadding="0" cellspacing="0" class="table1">
                            <tbody>
                              <tr>
                                <td colspan="2" align="right" class="title">
                                  <h3 style="margin-top: 12px;margin-bottom: 12px;">eProtect&trade; Demonstration</h3>
                                    <button class="action-button"  id="populateId" type="button" onclick="populate_fields();">Step 1: Populate Fields</button>
                                    <button class="regular-button" id="clearId" type="button" onclick="clear_fields();">Clear Fields</button>
                                    <div style="font-size:12px; padding:8px;">This form is used to capture payment data. You can populate fields automatically by clicking <i>Populate Fields</i>, or enter your own values to explore how eProtect works.</div>
                                </td>
                                
                              </tr>

                              <tr>
                                <td class="tableHead">Cardholder Name</td>
                                <td class="tableHead"><input class="user-input" name="name" id="name" size="20" type="text" /></td>
                              </tr>
                              
                              <tr>
                                <td class="tableHead">Street Address</td>
                                <td class="tableHead"><input class="user-input" name="address" id="address" size="40" type="text" /></td>
                              </tr>

                              <tr>
                                <td class="tableHead">City</td>
                                <td class="tableHead"><input class="user-input" name="city" id="city" size="20" type="text" /></td>
                              </tr>
                              
                              <tr>
                                <td class="tableHead">State / Province</td>
                                <td class="tableHead">
                                  <select class="user-input" name="state" id="state" name="state">
                                    <?php state_options(); ?>
                                  </select>
                                  
                                </td>
                              </tr>

                              <tr>
                                <td class="tableHead">Zip / Postal code</td>
                                <td class="tableHead"><input class="user-input" name="zip" id="zip" size="10" type="text" /></td>
                              </tr>
                              
                              <tr>
                                <td class="tableHead">Country</td>
                                <td class="tableHead">
                                  <select class="user-input" id="country" name="country">
                                    <?php country_options(); ?>
                                  </select>
                                  
                                </td>
                              </tr>

                              <tr>
                                <td class="tableHead">E-Mail</td>
                                <td class="tableHead"><input class="user-input" name="email" id="email" size="40" type="text" /></td>
                              </tr>

                              <tr>
                                <td class="tableHead">Phone</td>
                                <td class="tableHead"><input class="user-input" name="phone" id="phone" size="20" type="text" /></td>
                              </tr>
                              

                              <tr>
                                <td class="tableHead">Payment Amount ($)</td>
                                <td class="tableHead"><input class="user-input" name="amount" id="amount" size="10" type="text" /></td>
                              </tr>

                              <tr>
                                <td class="tableHead">Card Type</td>
                                <td class="tableHead">
                                  <select class="user-input" name="cardtype" id="cardtype">
                                    <option value="visa">VISA</option>
                                    <option value="mastercard">MasterCard</option>
                                    <option value="amex">American Express</option>
                                    <option value="discover">Discover</option>
                                  </select>
                                  
                                    <img style="float:right;" src="images/major_card_logos_25px.png">
                                  
                                </td>
                              </tr>

                              <tr>
                                <td class="tableHead">Card Number</td>
                                <td class="tableHead"><input class="user-input" name="ccNum" id="ccNum" size="20" type="text" /></td>
                              </tr>
                              <tr>
                                <td class="tableHead">CVV</td>
                                <td class="tableHead"><input class="user-input" name="cvv2Num" id="cvv2Num" size="20" type="text" /></td>
                              </tr>
                              <tr>
                                <td class="tableHead">Exp Date (MMYY)</td>
                                <td class="tableHead"><input class="user-input" name="expDate" id="expDate" size="5" type="text" /></td>
                              </tr>
                              <tr>
                                <!-- <td class="title">&nbsp;</td> -->
                                <td colspan="2" align="right" class="title"><button class="action-button" id="submitLitleId" type="button">Step 2a: Checkout</button>
                                  <div style="font-size:12px; padding:8px;">When you click <i>Checkout button</i> eProtect is called before form data is posted to the eCommerce server. Client-side JavaScript invokes the eProtect <b></b>sendToLitle()</b> method, passing the eProtect credentials and the payment related fields to the eProtect service. eProtect responds with a low-value token (payPageRegistrationId) and other information after vaulting payment card data. On success, eProtect calls a supplied submitAfterLitle() JavaScript callback. This callback scrubs sensitive data from the browser fields before passing the low-value token to the server as a method of payment.</div>                                
                                </td>                                
                              </tr>
                              
                              <tr>
                                <td class="release" colspan="2">
                                    <div style="font-size:12px; padding:8px;">The values below are returned by the Vantiv eProtect service. The PayPage registration ID is a token that can be used by the merchant to reference the payment credentials stored in the eProtect vault.</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="title">Paypage Registration ID</td>
                                <td class="title"><input class="protected" id="paypageRegistrationId" name="paypageRegistrationId" readonly="true" type="text" /><b> &lt;--Hidden (aka eProtect Low-value Token)</b></td>
                              </tr>
                              <tr>
                                <td class="title">BIN</td>
                                <td class="title"><input class="protected" id="bin" name="bin" readonly="true" type="text" /><b> &lt;--Hidden (Bank Identification Number)</b></td>
                              </tr>

                              <tr>
                                <td class="title">Txn ID</td>
                                <td class="title"><input class="protected" id="id" name="id" readonly="true" type="text" /><b> &lt;--Hidden (Merchant Transaction ID)</b></td>
                              </tr>

                              <tr>
                                <td class="title">reportGroup</td>
                                <td class="title"><input class="protected" id="reportGroup" name="reportGroup" readonly="true" type="text" /><b> &lt;--Hidden (Reporting Group)</b></td>
                              </tr>

                              <tr>
                                <td class="title">orderId</td>
                                <td class="title"><input class="protected" id="orderId" name="orderId" readonly="true" type="text" /><b> &lt;--Hidden (Order ID)</b></td>
                              </tr>

                              <tr>
                                <td class="title">customerId</td>
                                <td class="title"><input class="user-input" id="customerId" name="customerId" value="12345" type="text" /><b> &lt;--Hidden (Customer ID)</b></td>
                              </tr>
                              
                              
                              <tr>
                                <td class="title">user</td>
                                <td class="title"><input  class="user-input" id="user" name="user" type="text" value="JoesStore" /><b> &lt;--Hidden (Litle merchant login)</b></td>
                              </tr>

                              <tr>
                                <td class="title">password</td>
                                <td class="title"><input  class="user-input" id="password" name="password" type="text" value="JoesPassword" /><b> &lt;--Hidden (Litle merchant password)</b></td>
                              </tr>
   
                              <tr>
                                <td colspan="2" align="right" class="title"><input class="action-button" id="submitFormId" type="submit" value="Step 2b - Authorize" name="submitFormId">
                                  <div style="font-size:12px; padding:8px;">Normally, steps 2a and 2b would be combined into a single step, but they are separated here for clarity. After the low value-token (payPageRegistrationId) has been received from eProtect, it along with other variables are passed to to the merchant eCommerce server for processing. When you select <i>Authorize</i> in this example, customer data along with data returned from eProtect are passed to the the server for payment authorization.</div>                                
                                </td>                                
                              </tr>

                            </tbody>
                          </table>
                        </form>
                      
					  <button class="regular-button" id="show_eprotect_variables">Show/Hide Variables passed to eProtect API</button>
					  <button class="regular-button" id="show_eprotect_response">Show/Hide eProtect API Response Fields</button>
					  
					  <div id="variables_passed">
                      <table class="table1" width="90%">
                        <tbody>
                          <tr>
                            <td colspan="4">
                              <h3 style="margin-top: 12px;">Variables passed to eProtect API</h3>
                            </td>
                          </tr>
                          <tr>
                            <td>Paypage ID</td>
                            <td><input class="user-input" id="request$paypageId" name="request$paypageId" type="text" value="MDTt5iuXQ2ma99Lb" /></td>
                            <td>Merchant Txn ID</td>
                            <td><input class="user-input" id="request$merchantTxnId" name="request$merchantTxnId" type="text" value="12345" /></td>
                          </tr>
                          <tr>
                            <td>Order ID</td>
                            <td><input class="user-input" id="request$orderId" name="request$orderId" type="text" value="cust_order" /></td>
                            <td>Report Group</td>
                            <td><input class="user-input" id="request$reportGroup" name="request$reportGroup" type="text" value="67890" /></td>
                          </tr>
                          <tr>
                            <td>JS Timeout</td>
                            <td><input class="user-input" id="request$timeout" name="request$timeout" type="text" value="5000" /></td>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                        </tbody>
                      </table>
					  </div>
                      
					  
					  <div id="api_response">
                      <table class="table1" width="90%">
                        <tbody>
                          <tr>
                            <td colspan="4">
                              <h3 style="margin-top: 12px;">eProtect API Response Fields</h3>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>Response Code</td>
                            <td style="width: 276px;"><input class="protected" id="response$code" name="response$code" readonly="true" type="text" /></td>
                            <td style="width: 0px;">ResponseTime</td>
                            <td><input class="protected" id="response$responseTime" name="response$responseTime" readonly="true" type="text" /></td>
                          </tr>
                          <tr>
                            <td>Response Message</td>
                            <td colspan="3"><input class="protected" id="response$message" name="response$message" readonly="true" style="margin-left: 0px; margin-right: 0px; width: 100%;" type="text" /></td>
                          </tr>
                          <tr>
                            <td class="release" colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td>Litle Txn ID</td>
                            <td style="width: 276px;"><input class="protected"  id="response$litleTxnId" name="response$litleTxnId" readonly="true" type="text" /></td>
                            <td style="width: 0px;">Merchant Txn ID</td>
                            <td><input class="protected" id="response$merchantTxnId" name="response$merchantTxnId" readonly="true" type="text" /></td>
                          </tr>
                          <tr>
                            <td>Order ID</td>
                            <td style="width: 276px;"><input class="protected"  id="response$orderId" name="response$orderId" readonly="true" type="text" /></td>
                            <td style="width: 0px;">Report Group</td>
                            <td><input class="protected"  id="response$reportGroup" name="response$reportGroup" readonly="true" type="text" /></td>
                          </tr>
                          <tr>
                            <td>Type</td>
                            <td style="width: 276px;"><input class="protected" id="response$type" name="response$type" readonly="true" type="text" /></td>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="release" colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td>Timeout Message</td>
                            <td colspan="3"><input class="protected" id="timeoutMessage" name="timeoutMessage" readonly="true" style="margin-left: 0px; margin-right: 0px; width: 100%;" type="text" /></td>
                          </tr>
                          
                        </tbody>
                      </table>
					  </div>
                      </div> <!-- ContentText --> 
    </div>
 
  </body>
</html>

