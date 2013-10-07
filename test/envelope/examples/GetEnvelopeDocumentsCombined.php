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
 	$docName = 'sample.pdf';

	// The response to the getEnvelopeDocumentsCombined() call differs from other api calls
	// in that it returns raw PDF data instead of a JSON formatted response body
 	$response = $service->envelope->getEnvelopeDocumentsCombined($envelopeId, true);
	
	echo "\n-- Results --\n\n";
	if(is_string($response) && strpos($response, 'Bad Request') === false) {
		file_put_contents($docName, $response);
		print_r("<Envelope documents have been downloaded>\n\n");
	} else {
		print_r($response);
	}
	
?>