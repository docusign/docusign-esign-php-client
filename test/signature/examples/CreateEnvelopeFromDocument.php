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
	$documents = array( new DocuSign_Document("sample.pdf", "1", file_get_contents("../sample.pdf") ));
	$recipients = array( new DocuSign_Recipient( "1", "1", '{RECIPIENT NAME}', '{RECIPIENT EMAIL}'));
	$status = 'created'; // can be "created" or "sent"
	// optional
	$eventNotifications = array();

	$response = $service->signature->createEnvelopeFromDocument( $emailSubject,
																 $emailBlurb,
																 $status,
																 $documents,																 
																 $recipients,
																 $eventNotifications );
	
	echo "\n-- Results --\n\n";
	print_r($response);	
	
?>
