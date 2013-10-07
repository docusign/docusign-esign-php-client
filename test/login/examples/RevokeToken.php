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
	//$token = '{ENTER ACCESS TOKEN}';

	$response = $service->login->revokeToken($token);
	
	echo "\n-- Results --\n\n";
	print_r($response);
	
?>