<?php
	
	require_once '../../../src/DocuSign_Client.php';
	require_once '../../../src/service/DocuSign_StatusService.php';

	$client = new DocuSign_Client();
	if( $client->hasError() )
	{
		echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
		return;
	}
	$service = new DocuSign_StatusService($client);

	//TODO:
	$fromDate = mktime(0,0,0,10,1,2013);
	$status = "sent";  // created, sent, delivered, signed, declined, completed, faxpending, autoresponded

	$response = $service->status->getStatus($fromDate, $status);
	
	echo "\n-- Results --\n\n";
	print_r($response);
	
?>