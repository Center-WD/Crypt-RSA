# Crypt-RSA
  
Author: Sergey Knyazew  
Author site: http://iksweb.ru/  
Author E-mail: info@iksweb.ru  
PHP: 7.1 >  (Tested php 8.0)

Pure-PHP PKCS#1 compliant implementation of RSA.

# Описание

Класс предназначен для шифровки и дешифрации информации с использование ключей в openssl. Данный метод отлично подойдёт для связки разных сайтов или серверов (для отправки данных) 

Вы можете отправлять зашифрованные данные (открытым ключём), а после получения уже производить дешифрование.


# Использование

1. Подключаем и иницализируем класс 

```php
<?php
require(__DIR__.'/include/CryptRSA.php');
$rsa = new Crypt_RSA;
?>
```

2. Генерируем открытый и закрытый ключ

```php
<?php
$rsa->ShowKey();
?>
```

Затем необходимо сохранить данные из полученного массива в файлы openssl_private.txt и openssl_publick.txt (можно указывать своё название)


3. Производим шифровку информации

```php
<?php
// Шифруем текст по ключу
$rsa->LoadKey(__DIR__.'/rsa/openssl_publick.txt'); // load public key
$contentsEncrypted = $rsa->Encrypt('Текст для кодировки');
?>
```
В $rsa->LoadKey(''); необходимо указать путь до файла с открытым ключом. 

# Дешифрация данных

```php
<?php
$contentsEncrypted = 'Код полученный на шаге 3';

// Производим дешифрацию
$rsa->LoadKey(__DIR__.'/rsa/openssl_private.txt'); // load public key
echo $rsa->Decrypt($contentsEncrypted);
?>
```
В $rsa->LoadKey(''); необходимо указать путь до файла с закрытым ключом. 


