<?php
	
	require_once '../../../src/DocuSign_Client.php';
	require_once '../../../src/service/DocuSign_LoginService.php';

	$client = new DocuSign_Client();
	if( $client->hasError() )
	{
		echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
		return;
	}
	$service = new DocuSign_LoginService($client);

	$response = $service->login->getLoginInformation();
	
	echo "\n-- Results --\n\n";
	var_dump($response);
	
?>