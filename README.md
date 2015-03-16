DocuSign eSign PHP Client Library
================================

This is a client library to help you get started with DocuSign eSignature API.
To get started with using this library go to <a href="http://www.docusign.com/devcenter">http://www.docusign.com/devcenter</a> and get
a free development account.  After you get an account and generate an Integrator Key (App Key) 
you will be able to make test web service calls.  To generate your Integrator Key login to your developer 
account and go to Preferences -> API page.

The JSON parsing is done through PHP's native `json_encode()` and `json_decode()` functions, available with 
PHP 5.2.x and higher.  To see examples of how the library can be used for most frequently used scenarios 
look in the test directory.  The sub folders contain unit tests, as well as /examples folders which 
showcase the most frequent usage scenarios.

NOTE: it does not and will not have the full functionality of the DocuSign service.
Feel free to update the proxy classes yourself and contribute functions.
Alternatively you can get the raw HTTP connection and send over your own JSON.
For full functionality and documentation visit www.docusign.com/devcenter and iodocs.docusign.com


Library Configuration
-------------------------

To use this library you need to enter your account specific info in the `config.php` configuration file.
Test data can also be entered into the `testConfig.php` file for unit testing and examples.
Do a search for the string "TODO" to locate places that require specific info to be entered.


System Requirements
-------------------------

- PHP 5.2.x or higher [http://www.php.net/]
- PHP Curl extension [http://www.php.net/manual/en/intro.curl.php]
- PHP JSON extension [http://php.net/manual/en/book.json.php]

This client library was tested with PHP 5.3.15.


Important Terms
-------------------------

`Integrator Key`: Identifies a single integration. Every API 
request includes the Integrator Key and a 
username/password combination

`Envelope`: Just like a normal Postal Envelope.It contains 
things like Documents, Recipients, and Tabs

`Document`: The PDF, Doc, Image, or other item you want 
signed. If it is not a PDF, you must include the File 
Extension in the API call

`Tab`: Tied to a position on a Document and defines what 
happens there. For example, you have a SignHere Tab 
wherever you want a Recipient to sign

`Recipient`: The person you want to send the Envelope 
to. Requires a UserName and Email

`Captive Recipient`: Recipient signs in an iframe on your 
website instead of receving an email.  Captive recipients have the
clientUserId property set.

`PowerForm`: A pre-created Envelope that you can launch
instead of writing server-side code

Rate Limits
-------------------------

Please note: Applications are not allowed to poll for envelope status more
than once every 15 minutes and we discourage integrators from continuously
retrieving status on envelopes that are in a terminal state (Completed, 
Declined, and Voided).  Excessive polling will result in your API access 
being revoked.  
If you need immediate notification of envelope events we encourage you to 
review envelope events or use our Connect Publisher technology, DocuSign 
Connect as an alternative.

More Information
-------------------------

Professional Services is also available to help define and implement your
project fast. 

You can also find a lot of answered questions on StackOverflow, search for tag `DocuSignApi`:
http://stackoverflow.com/questions/tagged/docusignapi
