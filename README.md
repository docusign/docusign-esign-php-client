# DocuSign PHP Client

You can sign up for a free [developer sandbox](https://www.docusign.com/developer-center).

Requirements
============

PHP 5.3.3 or higher [http://www.php.net/].

Installation
============

### Composer

You can install the bindings via Composer. Run the following command:  

	composer require docusign/docusign-esign

To use the bindings, use Composer's autoload:

	require_once('vendor/autoload.php');

### Manual Install 

If you do not wish to use Composer, you can download the latest release. Then, to use the bindings, include the init.php file.

	require_once('/path/to/docusign-esign-client/autoload.php');

#### Dependencies

This client has the following external dependencies: 

* PHP Curl extension [http://www.php.net/manual/en/intro.curl.php]
* PHP JSON extension [http://php.net/manual/en/book.json.php]

Usage
=====

To login and send a signature request from a template:

```php
<?php

require_once('docusign-php-client/autoload.php');

class DocuSignSample
{
    public function signatureRequestFromTemplate()
    {
        $username = "[EMAIL]";
        $password = "[PASSWORD]";
        $integrator_key = "[INTEGRATOR_KEY]";     

        // change to production before going live
        $host = "https://demo.docusign.net/restapi";

        // create configuration object and configure custom auth header
        $config = new DocuSign\eSign\Configuration();
        $config->setHost($host);
        $config->addDefaultHeader("X-DocuSign-Authentication", "{\"Username\":\"" . $username . "\",\"Password\":\"" . $password . "\",\"IntegratorKey\":\"" . $integrator_key . "\"}");

        // instantiate a new docusign api client
        $apiClient = new DocuSign\eSign\ApiClient($config);
        $accountId = null;
        
        try 
        {
            //*** STEP 1 - Login API
            $authenticationApi = new DocuSign\eSign\Api\AuthenticationApi($apiClient);
            $options = new \DocuSign\eSign\Api\AuthenticationApi\LoginOptions();
            $loginInformation = $authenticationApi->login($options);
            if(isset($loginInformation) && count($loginInformation) > 0)
            {
                $loginAccount = $loginInformation->getLoginAccounts()[0];
                if(isset($loginInformation))
                {
                    $accountId = $loginAccount->getAccountId();
                    if(!empty($accountId))
                    {
                        //*** STEP 2 - Signature Request from a Template
                        // create envelope call is available in the EnvelopesApi
                        $envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($apiClient);
                        // assign recipient to template role by setting name, email, and role name.  Note that the
                        // template role name must match the placeholder role name saved in your account template.
                        $templateRole = new  DocuSign\eSign\Model\TemplateRole();
                        $templateRole->setEmail("[SIGNER_EMAIL]");
                        $templateRole->setName("[SIGNER_NAME]");
                        $templateRole->setRoleName("[ROLE_NAME]");             

                        // instantiate a new envelope object and configure settings
                        $envelop_definition = new DocuSign\eSign\Model\EnvelopeDefinition();
                        $envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Signature Request Sample");
                        $envelop_definition->setTemplateId("[TEMPLATE_ID]");
                        $envelop_definition->setTemplateRoles(array($templateRole));
                        
                        // set envelope status to "sent" to immediately send the signature request
                        $envelop_definition->setStatus("sent");

                        // optional envelope parameters
                        $options = new \DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions();
                        $options->setCdseMode(null);
                        $options->setMergeRolesOnDraft(null);

                        // create and send the envelope (aka signature request)
                        $envelop_summary = $envelopeApi->createEnvelope($accountId, $envelop_definition, $options);
                        if(!empty($envelop_summary))
                        {
                            echo "$envelop_summary";
                        }
                    }
                }
            }
        }
        catch (DocuSign\eSign\ApiException $ex)
        {
            echo "Exception: " . $ex->getMessage() . "\n";
        }
    }
}

?>
```

See [UnitTests.php](https://github.com/docusign/docusign-php-client/blob/master/test/UnitTests.php) for more examples.

Testing
=======

Unit tests are available in the [test](/test) folder. 

Follow the steps below to run the test cases

* Rename the "TestConfig.php-sample" to "TestConfig.php"
* Populate all the required values like the login credentials, integrator key, host, etc in TestConfig.php
* Run the following command from the [test](/test) folder 

        phpunit.phar UnitTests.php

Support
=======

Feel free to log issues against this client through GitHub.  We also have an active developer community on Stack Overflow, search the [DocuSignAPI](http://stackoverflow.com/questions/tagged/docusignapi) tag.

License
=======

The DocuSign PHP Client is licensed under the following [License](LICENSE).

Notes
=======

This version of the client library does not implement all of the DocuSign REST API methods. The current client omits methods in the Accounts, Billing, Cloud Storage, Connect, Groups (Branding), and Templates (Bulk Recipients) categories. The client's methods support the core set of use cases that most integrations will encounter. For a complete list of omitted endpoints, see [Omitted Endpoints](./omitted_endpoints.md). 
