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

  // 
  // Get the full user list
  //
  $response = $service->user->getUserList();
  echo "\n-- User List --\n\n";
  print_r($response);

  //
  // Add a new user
  //
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

  //
  // Extract the userId from the create response
  //
  $userId = $response->newUsers[0]->userId;

  //
  // Get the settings for that new user
  //
  $response = $service->user->getUserInfo($userId, "true");
  echo "\n-- User Info --\n\n";
  print_r($response);

  //
  // Get the settings for that new user
  //
  $response = $service->user->getUserSettingList($userId);
  echo "\n-- User Setting List --\n\n";
  print_r($response);

  //
  // Close the new user membership
  //
  $response = $service->user->closeUser($userId);
  echo "\n-- Close User --\n\n";
  print_r($response);

?>
