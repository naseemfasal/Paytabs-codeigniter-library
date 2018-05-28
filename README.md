# Paytabs-codeigniter-library
Paytabs codeigniter library

This is the PHP Library for Paytabs to integrate the paytabs payment gateway into your website easily. This library is developed with Paytab's latest API. This library supports Codeigniter  3.1.8 (Latest) and other old version.

 ```   
   $merchant_email='YOUR_REGISTERED_EMAIL';
   $secret_key='YOUR_SECRET_KEY_COPIED_FROM_PAYTABS_DASHBOARD';
   $merchant_id='MERCHANT_ID';
```     
###### Load library 
```  
   $params=array('merchant_email'=>$merchant_email,
                 'merchant_id'=>$merchant_id,
                 'secret_key'=>$secret_key);
                 
   $this->load->library('paytabs',$params);
```  
###### Create Paypage : --  
###### Create array of customer data and item to create paypage
```  
  $values=  array(
    //PayTabs Merchant Account Details
	//Customer's Personal Information
	'title' => "John Doe", 			// Customer's Name on the invoice
	'cc_first_name' => "John", 		//This will be prefilled as Credit Card First Name
    'cc_last_name' => "Doe", 		//This will be prefilled as Credit Card Last Name
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
	
	'address_shipping' => "Juffair, Manama, Bahrain",
    'city_shipping' => "Manama",
    'state_shipping' => "Capital",
    'postal_code_shipping' => "97300",
    'country_shipping' => "BHR",
   
    //Product Information
    "products_per_title"=>"Mobile Phone", //Product title of the product. If multiple products then add “||” separator
    'currency' => "BHD",				//Currency of the amount stated. 3 character ISO currency code 
	"unit_price"=>"10",					//Unit price of the product. If multiple products then add “||” separator.
    'quantity' => "1",					//Quantity of products. If multiple products then add “||” separator
	'other_charges' => "0",				//Additional charges. e.g.: shipping charges, taxes, VAT, etc.
	'amount' => "10.00",  				//Amount of the products and other charges, it should be equal to: amount = (sum of all products’ (unit_price * quantity)) + other_charges
										//This field will be displayed in the invoice as the sub total field

	'discount'=>"0",					//Discount of the transaction. The Total amount of the invoice will be= amount - discount

	
	"msg_lang" => "english",			//Language of the PayPage to be created. Invalid or blank entries will default to English.(Englsh/Arabic)
    
    
    "reference_no" => "1231231",		//Invoice reference number in your system
    "site_url" => "https://www.clickfew.com", //The requesting website be exactly the same as the website/URL associated with your PayTabs Merchant Account
    'return_url' => "https://www.clickfew.com/account/invoice/test_payment",
    "cms_with_version" => "API USING PHP"
);
```  
###### here you will get response from their server as Object.
```  
 $response= $this->paytabs->create_pay_page($values);   
 ```  
###### Redirect url for autherizing credit card and after that user will return to the return url provided above.   
```  
 echo $response->payment_url;   
 ```
   
