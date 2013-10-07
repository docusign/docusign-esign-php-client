<?php
	
	require_once '../../../src/DocuSign_Client.php';
	require_once '../../../src/service/DocuSign_RequestSignatureService.php';

	$client = new DocuSign_Client();
	if( $client->hasError() )
	{
		echo "\nError encountered in client, error is: " . $client->getErrorMessage() . "\n";
		return;
	}
	$service = new DocuSign_RequestSignatureService($client);

	//TODO:
	$emailSubject = '{ENTER EMAIL SUBJECT}';
	$emailBlurb = '{ENTER EMAIL BLURB}';
	$templateId = '{ENTER TEMPLATEID}';
	$status = 'created'; // can be "created" or "sent"
	$templateRoles = array(	"roleName" => "{ENTER ROLE NAME}",
							"name" => "{ENTER RECIPIENT NAME}", 
							"email" => "{ENTER RECIPIENT EMAIL}");
	// optional
	$eventNotifications = array();

	$response = $service->signature->createEnvelopeFromTemplate( $emailSubject,
																 $emailBlurb,
																 $templateId,
																 $status,
																 $templateRoles,
																 $eventNotifications );
	
	echo "\n-- Results --\n\n";
	print_r($response);
	
?>
