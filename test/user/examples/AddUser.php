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

  $user = new DocuSign_AddUser();
  $user->setEmail("bob.testname@example.com");
  $user->setUserName("Bob Testname");
  // NOTE: Uncomment the following two lines if you are using an account with silent user activation,
  //       such as would be setup if you were using the Single Sign-On (SSO) functionality.
  //$user->setPassword("PasswordNotKnown");
  //$user->setForgottenPasswordInfo("Q1", "A1", "Q2", "A2", "Q3", "A3", "Q4", "A4");
  $user->setCanSendEnvelope(true);

  $response = $service->user->addUser($user);
  echo "\n-- Add User --\n\n";
  print_r($response);

?>
