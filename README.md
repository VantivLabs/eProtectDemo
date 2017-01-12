# eProtectDemo
This demo showcases the use of Vantiv's eProtect with various Vantiv front-ends including Litle and Mercury Pay. Presently the Litle path is the only one that works end-to-end.

If you want to try the demonstration, you can access an up to date hosted version  [HERE](https://e42fb64d.servage-customer.net/eprotect/). 

The diagram below shows the components of the demo:

![Graphic Illustrating Demo Environment](https://raw.githubusercontent.com/VantivLabs/eProtectDemo/master/images/demo_environment.PNG "Demo Environment")

* The PHP code in this repository lives on your web-server, typically hosted by the merchant. The interface for the demo is responsive and will format itself for desktops or mobile devices.
* You can pre-populate the form fields using the Step1: Populate Fields button
* When you submit card credentials (don't use real credit cards please) and click on "Step 2" the demo will make a call to Vantiv eProtect, vaulting the sensitive PAN data and returning a low-value token. You can select the Vantiv payment front-that you want to process your transaction against (at present only Vantiv eCommerce/Litle and MercuryPay are implemented)
* Throught the web interface you will see that hidden variables returns by the call to eProtect. The key variable is the low-value token used to retrieve your payment credentials from the vault.
* Depending on the front-end you select for processing, you will be guided through how the web-abased application interacts with Vantiv's REST / HTTP POST APIs to send and receive payment transactions.

Besides being a demo environment, this tool can be used for other purposes as well

* validating credentials
* submitting / modifying / testing your own payment transactions (the XML presented is user-modifiable)
* learning Vantiv's APIs
* creating "load" for other tools like Vantiv IQ