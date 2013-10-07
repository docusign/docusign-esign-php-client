<?php
	
	require_once '../../../src/DocuSign_Client.php';
	require_once '../../../src/service/DocuSign_ViewsService.php';

	$client = new DocuSign_Client();
	if( $client->hasError() )
	{
		echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
		return;
	}
	$service = new DocuSign_ViewsService($client);
	
	$response = $service->views->getConsoleView();
	
	echo "\n-- Results --\n\n";
	print_r($response);
	
?>