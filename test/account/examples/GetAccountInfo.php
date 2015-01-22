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

  $response = $service->account->getInfo();
  echo "\n-- Account Info --\n\n";
  print_r($response);

  $response = $service->account->getBillingPlan();
  echo "\n-- Account Billing Plan --\n\n";
  print_r($response);

  $response = $service->account->getBillingChargeList();
  echo "\n-- Account Billing Charge List --\n\n";
  print_r($response);

  $response = $service->account->getBillingInvoiceList();
  echo "\n-- Account Billing Invoice List --\n\n";
  print_r($response);

  $response = $service->account->getSettingList();
  echo "\n-- Account Settings --\n\n";
  print_r($response);

  $response = $service->account->getBrandList();
  echo "\n-- Account Brand List --\n\n";
  print_r($response);

  $response = $service->account->getCustomFieldList();
  echo "\n-- Account Custom Field List --\n\n";
  print_r($response);

?>
