<?php
/**
 * Pure-PHP PKCS#1 compliant implementation of RSA.
 *
 * @author  Sergey Knyazew <info@iksweb.ru>
 * @version 0.1.0
 * @access  public
 * @package Crypt_RSA
 */
class Crypt_RSA{

    // Public or private key
    var $publicKey = '';
    var $privateKey = '';

    /**
     * Create public / private key pair
     *
     * @access public
     * @param optional Integer $bits
     * @param optional Integer $digest
     * @return array keys
     */
    function createKey($bits = 1024, $digest = 'sha512'){

        $arResult = array();

        // Confir generator key
        $config = array(
            "digest_alg" => $digest,
            "private_key_bits" => $bits,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        $keyPair = openssl_pkey_new($config);

        openssl_pkey_export($keyPair, $privateKey);

        $arResult['PRIVATE_KEY']	= $privateKey;

        $arResult['PUBLIC_KEY']		= openssl_pkey_get_details($keyPair)['key'];

        return $arResult;
    }

    /**
     * Loads a public or private key files
     *
     * @access public
     * @param String $key
     * @return N/A
     */
    function loadKey($key){

        if($key==false)
            return false;

        $this->publicKey = openssl_get_publickey(file_get_contents($key)); // Load publick key
        $this->privateKey = openssl_get_privatekey(file_get_contents($key)); // Load private key

        return false;

    }

    /**
     * Encryption
     *
     * @see decrypt()
     * @access public
     * @param String $plaintext
     * @return String
     */
    function encrypt($plaintext=false){

        if($plaintext==false)
            return false;

        openssl_public_encrypt($plaintext, $encrypted, $this->publicKey);

        return chunk_split(base64_encode($encrypted));
    }

    /**
     * Decryption
     *
     * @see encrypt()
     * @access public
     * @param String $ciphertext
     * @return String
     */
    function decrypt($ciphertext=false){

        if($ciphertext==false)
            return false;

        openssl_private_decrypt(base64_decode($ciphertext), $resul, $this->privateKey);

        return $resul;
    }

}
?>