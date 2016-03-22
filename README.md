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

To initialize the client and make the Login API Call:

```php
	<?php
	class DocuSignSample
	{
		public function login()
		{
			$username = "[EMAIL]";
			$password = "[PASSWORD]";
			$integrator_key = "[INTEGRATOR_KEY]";
			$host = "https://demo.docusign.net/restapi";

		 	$config = new DocuSign\eSign\Configuration();
		 	$config->setHost($host);
		 	$config->addDefaultHeader("X-DocuSign-Authentication", "{\"Username\":\"" . $username . "\",\"Password\":\"" . $password . "\",\"IntegratorKey\":\"" . $integrator_key . "\"}");

		 	$apiClient = new DocuSign\eSign\ApiClient($config);

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
		 				echo $accountId;
		 			}
		 		}
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
