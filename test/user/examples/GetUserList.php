<?php

  require_once '../../../src/DocuSign_Client.php';
  require_once '../../../src/service/DocuSign_UserService.php';

  $client = new DocuSign_Client();
  if( $client->hasError() )
  {
    echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
    return;
  }
  $service = new DocuSign_UserService($client);

  // specifying "true" as the parameter will cause additional info to be retrieved
  $response = $service->user->getUserList("false");
  echo "\n-- User List --\n\n";
  print_r($response);

?>
