<?php

namespace src\core\Helpers;
//used for user password encryption
class General
{
    private $encryption_iv = '9fa1fe272a4147786583fc5a18894831';
    private $encryption_method = 'AES-256-CBC';
    private $encryption_key = 'e143001b009c0f133c9f1be678b850f4';

    public function encryptData($data)
    {
        //make hax iv to bin
        $bin_iv = pack('H*', $this->encryption_iv);

        //echo $hax_decode_input;
        $encode = openssl_encrypt($data, $this->encryption_method, $this->encryption_key, TRUE, $bin_iv);
        if ($encode) {
            return bin2hex($encode);
        }
        return NULL;
    }

	public function decryptData($data)
    {
        //make hax iv to bin
        $bin_iv = pack('H*', $this->encryption_iv);

        //decode the input
        $hax_decode_input = pack('H*', $data);

        $decode = openssl_decrypt($hax_decode_input, $this->encryption_method, $this->encryption_key, TRUE, $bin_iv);
    
        return $decode;
    }
}