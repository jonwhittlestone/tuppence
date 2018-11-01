<?php
require_once 'vendor/autoload.php';

print "hello\n";

$identity = new Starling\Identity("sinu3aosbp97z1jdTGJBfmTpUEsceKT8p6ACy73frESXXYPMLTaJZSGaqZnYE11V");
$client = new Starling\Api\Client($identity, ['env' => 'prod']);
$request = new Starling\Api\Request\Accounts\Balance();

try {
    $result = $client->request($request);
    $body = json_decode((string) $result->getBody(), true);
    print "Your balance is " . $body['effectiveBalance'] . " as for right now.";

} catch (Exception $e) {
        print $e->getMessage();

}


?>
