<?php 


namespace App\Encryption;

/**
*	Secure data encryption using 3des method
*/
class Hash
{
	
	public function encrypt($data, $secret)
    {    


    	$output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = $secret;
	    $secret_iv = hash("sha256", "noradanish");
	   	
	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    $output = openssl_encrypt($data, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);

        return $output;

    }

    public function decrypt($data, $secret)
    {
        $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = $secret;
	    $secret_iv = hash("sha256", "noradanish");
	    
	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);


        $output = openssl_decrypt(base64_decode($data), $encrypt_method, $key, 0, $iv);

        return $output;
    }
}