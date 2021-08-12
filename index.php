<?php
/**
 * Pure-PHP PKCS#1 compliant implementation of RSA.
 *
 * @author  Sergey Knyazew <info@iksweb.ru>
 * @version 0.1.1
 * @access  public
 * @package Crypt_RSA
 */

// Загружаем класс обработчик
require(__DIR__.'/include/CryptRSA.php');
$rsa = new Crypt_RSA;

$rsa->ShowKey();  // Создаём ключи (необходимо скопировать в файлы openssl_private.txt и openssl_publick.txt)


// Шифруем текст по ключу
$rsa->LoadKey(__DIR__.'/rsa/openssl_publick.txt'); // load public key
$contentsEncrypted = $rsa->Encrypt('Текст для кодировки');


// Производим дешифрацию
$rsa->LoadKey(__DIR__.'/rsa/openssl_private.txt'); // load public key
echo $rsa->Decrypt($contentsEncrypted);
?>
