<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Paytabs Codeigniter PHP Library
 *
 * Paytabs payment gateway Php Codeigniter library
 *
 * @package			Paytabs Codeigniter PHP Library
 * @subpackage		PHP
 * @category		Paytabs Payment gateway
 * @author			Naseem fasal - naseem at infiyo.com  - +973 33495489
 * @license			None
 * @link			https://github.com/naseemfasal
 */

  
  define("AUTHENTICATION", "https://www.paytabs.com/apiv2/validate_secret_key");
  define("PAYPAGE_URL", "https://www.paytabs.com/apiv2/create_pay_page");
  define("VERIFY_URL", "https://www.paytabs.com/apiv2/verify_payment");


class Paytabs
{

    public $merchant_id;
    public $secret_key;
    public $api_key;
  
    public function __construct($params)
    {
      	//parent::__construct($base_url,$api_key,$timeout='');
        if(!function_exists('curl_init')) 
        {
            throw new RuntimeException('Paytabs requires cURL module');
        }
        $this->merchant_email = $params['merchant_email'];
        $this->merchant_id = $params['merchant_id'];
        $this->secret_key = $params['secret_key'];
        $this->api_key = "";
    }
  



    
    function authentication(){
        $obj = json_decode($this->post(AUTHENTICATION, array("merchant_email"=> $this->merchant_email, "secret_key"=>  $this->secret_key)));
        if($obj->access == "granted")
            $this->api_key = $obj->api_key;
        else 
            $this->api_key = "";
        return $this->api_key;
    }
    
    function create_pay_page($values) {
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['ip_customer'] = $_SERVER['REMOTE_ADDR'];
        $values['ip_merchant'] = $_SERVER['SERVER_ADDR'];
        return json_decode($this->post(PAYPAGE_URL, $values));
    }
    

    
     function verify_payment(){
         $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['payment_reference'] = $payment_reference;
        return json_decode($this->post(VERIFY_URL, $values));
    }
    
    function post($url, $fields) {
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        $ip = $_SERVER['REMOTE_ADDR'];

        $ipaddress = array(
            "REMOTE_ADDR" => $ip,
            "HTTP_X_FORWARDED_FOR" => $ip
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $ipaddress);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, 1);

        $result = curl_exec($ch);
        //print_r($result);
        curl_close($ch);
        
        return $result;
    }  
  
  
  
}
