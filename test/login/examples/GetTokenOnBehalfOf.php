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

	//TODO:
	//$userName = '{ENTER USER NAME}';
	//$bearer = '{ENTER ACCESS TOKEN}';

	$response = $service->login->getTokenOnBehalfOf($userName, $bearer);
	
	echo "\n-- Results --\n\n";
	print_r($response);
	
?>