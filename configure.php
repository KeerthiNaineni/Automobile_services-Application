<?php
require('stripe-php-master/init.php');
$Publishablekey="pk_test_51QIn3EG0eRElWoCTPMU9Y9QaLxSKwtvMIvmPdFkNCvnjU1zvCjAmVyhDMLYpObtAIWTKzO59cL7MfKEKTxmotG5100oVsXGbRR";$secretkey="sk_test_51QIn3EG0eRElWoCTv7e1d4SCXPG3e2fKqK4cWfNLa13ZjFSWQF4BEq273D1zABwNNtlm3rQexN1y8G28JWrioo6Q009ETfep6N";
\Stripe\Stripe::setApiKey($secretkey);
?>