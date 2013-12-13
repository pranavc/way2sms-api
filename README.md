Way2SMS PHP API
=============

Send SMS Via Way2SMS from PHP.  

<del>Tested Working with Way2SMS UI Version 4. Supports upto 140 Characters</del>
UPDATE: Way2SMS has added a Captcha Verification. Will update when I can find a workaround.





How to
-------
```php
<?php
    include('way2sms-api-new.php');
    sendSMS ( 'username' , 'password' , '9999999999' , 'Hello World');   
    sendSMS ( 'username' , 'password' , '9999999999,9899999999' , 'Hello World');   
?>
```
