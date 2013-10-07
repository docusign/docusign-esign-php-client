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

	//TODO:
	$returnUrl = "www.docusign.com/developer-center";
	$envelopeId = "{ENTER VALID ENVELOPE ID}";

	$response = $service->views->getSenderView(	$returnUrl, 
												$envelopeId );
	
	echo "\n-- Results --\n\n";
	print_r($response);
	
?>