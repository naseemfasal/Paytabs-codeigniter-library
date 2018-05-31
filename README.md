# Paytabs-codeigniter-library
Paytabs codeigniter library

This Paytabs codeigniter library is for  integrating  paytabs payment gateway into your website easily. This is developed with Paytab's latest API and supports Codeigniter  3.1.8 (Latest) and other old version. Also this library can be used with other Php application by loading the class directly instead of loading through CI's load library method, Because everything else is wroted in pure Php.

###### Upload Paytab.php into 'libraries' folder in your codeigniter directory.  

###### Load library 
```   
   $merchant_email='YOUR_REGISTERED_EMAIL';
   $secret_key='YOUR_SECRET_KEY';
   $merchant_id='MERCHANT_ID';

   $params=array('merchant_email'=>$merchant_email,
                 'merchant_id'=>$merchant_id,
                 'secret_key'=>$secret_key);
                 
   $this->load->library('paytabs',$params);
```  
###### Create Paypage request: --  
###### Create array of customer data and order details to create paypage link
```  
  $request_data=  array(
    //PayTabs Merchant Account Details
	//Customer's Personal Information
	'title' => "Naseem Fasal", 			// Customer's Name on the invoice
	'cc_first_name' => "Naseem", 		//This will be prefilled as Credit Card First Name
    'cc_last_name' => "Fasal", 		//This will be prefilled as Credit Card Last Name
	'email' => "customer@email.com",
    'cc_phone_number' => "973",
	'phone_number' => "33333333",
    
	//Customer's Billing Address (All fields are mandatory)
	//When the country is selected as USA or CANADA, the state field should contain a String of 2 characters containing the ISO state code otherwise the payments may be rejected. 
	//For other countries, the state can be a string of up to 32 characters.
	'billing_address' => "Juffair, Manama, Bahrain",
    'city' => "Manama",
    'state' => "Capital",
    'postal_code' => "97300",
    'country' => "BHR",
   
    //Customer's Shipping Address (All fields are mandatory)
	
	'address_shipping' => "Muharaq, Manama, Bahrain",
    'city_shipping' => "Manama",
    'state_shipping' => "Capital",
    'postal_code_shipping' => "97300",
    'country_shipping' => "BHR",
    //Product Information
    "products_per_title"=>"Test product", //Product title of the product. If multiple products then add “||” separator
    'currency' => "BHD", //Currency of the amount stated. 3 character ISO currency code
    "unit_price"=>"120", //Unit price of the product. If multiple products then add “||” separator.
    'quantity' => "1",  //Quantity of products. If multiple products then add “||” separator
    'other_charges' => "0",	//Additional charges. e.g.: shipping charges, taxes, VAT, etc.
    'amount' => "120.00",  
    'discount'=>"0", 
    "msg_lang" => "english", //Language of the PayPage to be created.  default - English
    "reference_no" => "1231231",//Invoice reference number in your system
    "site_url" => "https://www.yourwebsite.com", //The requesting website be exactly the same as the website/URL associated with your PayTabs Merchant Account
    'return_url' => "https://www.yourwebsite.com/payment_success_page",
    "cms_with_version" => "API USING PHP"
);

```  
###### here you will get response from their server as Object.
```  
 $response= $this->paytabs->create_pay_page($values);   
 ```  
###### you will get Redirect url for autherizing credit card from the response like below.   
```  
 echo $response->payment_url;   
 
 ```
   For detailed docuemntation about their api usage, Please reffer to : http://developers.paytabs.com/docs-apis/#rest-api
   
 Feel free to send me an email if you have any problems.

Thanks, - Naseem Fasal naseem at infiyo dot com  /  @naseemfasal 
