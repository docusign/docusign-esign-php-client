<?php
	
	require_once '../../../src/DocuSign_Client.php';
	require_once '../../../src/service/DocuSign_EnvelopeService.php';

	$client = new DocuSign_Client();
	if( $client->hasError() )
	{
		echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
		return;
	}
	$service = new DocuSign_EnvelopeService($client);

	//TODO:
	$envelopeId = '{ENTER VALID ENVELOPE ID}';
	
	$response = $service->envelope->getEnvelope($envelopeId);
	
	echo "\n-- Results --\n\n";
	print_r($response);
	
?>