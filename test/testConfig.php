<?php

global $testConfig;
global $testData;

$testConfig = array(

    // The DocuSign Integrator's Key
    'integrator_key' => '',

    // The Docusign Account Email
    'email' => '',

    // The Docusign Account password or API password
    'password' => '',
 
    // The version of DocuSign API (Ex: v1, v2)
    'version' => 'v2',

    // The DocuSign Environment (Ex: demo, test, www)
    'environment' => 'demo',
    
    // The DocuSign Account Id (Optional)
    // For multiple accounts user:
    //   - if it's empty, the default account will be used
    //   - otherwise, the DocuSign account with this account id will be used
    'account_id' => ''
);

$testData = array(
    
	// AccountName of above referenced account
    'account_name' => '',

    // A valid envelopeId from the account specified above
    'envelope_id' => '',

    // A valid templateId from the account specified above
    'template_id' => '',

    // A valid template role name from the template specified above
    'template_role' => '',
    
    // userId for account member
    'user_id' => '',

	// Member Email Address
    'user_email' => '',

    // Member User Name
    'user_name' => '',

    // Recipient Email Address
    'recipient_email' => '',

    // Recipient Name
    'recipient_name' => '',

    // Test RecipientId (user configured or a system-generated GUID)
    'recipient_id' => ''
);
