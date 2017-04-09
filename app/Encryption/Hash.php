<?php 


namespace App\Encryption;

/**
*	Secure data encryption using 3des method
*/
class Hash
{
	
	public function encrypt($data, $secret)
    {    
        //Generate a key from a hash
        $key = md5(utf8_encode($secret), true);
        
        //Take first 8 bytes of $key and append them to the end of $key.
        $key .= substr($key, 0, 8);
        
        //Pad for PKCS7
        $blockSize = mcrypt_get_block_size('tripledes', 'ecb');
        $len = strlen($data);
        $pad = $blockSize - ($len % $blockSize);
        $data .= str_repeat(chr($pad), $pad);
        
        //Encrypt data
        $encData = mcrypt_encrypt('tripledes', $key, $data, 'ecb');
        
        return base64_encode($encData);

    }

    public function decrypt($data, $secret)
    {
        $text = base64_decode($data);
    
        $data = mcrypt_decrypt('tripledes', $secret, $text, 'ecb');
    
        $block = mcrypt_get_block_size('tripledes', 'ecb');
        $pad   = ord($data[($len = strlen($data)) - 1]);
    
        return substr($data, 0, strlen($data) - $pad);
    }
}