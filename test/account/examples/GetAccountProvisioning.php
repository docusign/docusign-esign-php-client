<?php

  require_once '../../../src/DocuSign_Client.php';
  require_once '../../../src/service/DocuSign_AccountService.php';

  $client = new DocuSign_Client();
  if( $client->hasError() )
  {
    echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
    return;
  }
  $service = new DocuSign_AccountService($client);

   //TODO: The app_token must be obtained either through your Account Manager or DocuSign support.
   //      The app_token is typically used to obtain the distributorCode and distributorPassword
   //      required by other API calls such as creating accounts.
  $envelopeId = '{ENTER APP TOKEN}';

  $response = $service->account->getAccountProvisioning($apiConfig["app_token"]);
  echo "\n-- Results --\n\n";
  print_r($response);

?>
