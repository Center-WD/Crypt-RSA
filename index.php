<?php
/**
 * Pure-PHP PKCS#1 compliant implementation of RSA.
 *
 * @author  Sergey Knyazew <info@iksweb.ru>
 * @version 0.1.0
 * @access  public
 * @package Crypt_RSA
 */

// Загружаем класс обработчик
include_require($_SERVER['DOCUMENT_ROOT'].'/include/CryptRSA.php');
$rsa = new Crypt_RSA;

print_r($rsa->createKey()); // Создаём ключи (необходимо скопировать в файлы openssl_private.txt и openssl_publick.txt)

// Шифруем текст по ключу
$rsa->loadKey('openssl_publick.txt'); // load public key
$contentsEncrypted = $rsa->encrypt('Текст для кодировки');

// Производим дешифрацию
$rsa->loadKey('openssl_private.txt'); // load public key
echo $rsa->decrypt($contentsEncrypted);
?>