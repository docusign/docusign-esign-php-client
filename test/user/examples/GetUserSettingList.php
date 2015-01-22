<?php

  require_once '../../../src/DocuSign_Client.php';
  require_once '../../../src/service/DocuSign_UserService.php';

  if ( sizeof($argv) != 2 ) 
  {
    echo "\nError: incorrect number of parameters encountered\n";
    echo "\nusage: " . $argv[0] . " <userId>\n\n";
    return;
  }

  $client = new DocuSign_Client();
  if( $client->hasError() )
  {
    echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
    return;
  }
  $service = new DocuSign_UserService($client);

  $response = $service->user->getUserSettingList($argv[1]);
  echo "\n-- User Setting List --\n\n";
  print_r($response);

?>
