# The Official DocuSign eSignature PHP Client SDK

[![Build status][travis-image]][travis-url]

## Requirements
*   PHP 7.4+
*   Free [developer account](https://go.docusign.com/sandbox/productshot/?elqCampaignId=16531)

## Compatibility
*   PHP 7.4+

## Installation
This SDK is provided as open source, which enables you to customize its functionality to suit your particular use case. To do so, download or clone the repository. If the SDK’s given functionality meets your integration needs, or if you’re working through our [code examples](https://developers.docusign.com/docs/esign-rest-api/how-to/) from the [DocuSign Developer Center](https://developers.docusign.com/), you merely need to install it by following the instructions below.

### Composer:
1. In your PHP console, type: **Composer require docusign/esign-client;**
2. To use the package automatically, add to Composer's Autoload file: 
`require_once('vendor/autoload.php');`

### Manual install:

<ol>
   <li>Download or clone this repository.</li>
   <li>Bind the PHP SDK to your server or place it in a static location.
       <ol style="list-style-type: lower-alpha simple">
           <li>To bind to your server, edit the <em>init.php</em> file. Add:<br>
               <code>require_once('/path/to/docusign-esign-client/autoload.php');</code></li>
           <li>To bind to single pages: In your PHP file that will utilize the PHP SDK, add:<br>
                <code>require_once('/path/to/docusign-esign-client/autoload.php');</code></li>
       </ol>
   </li>
   <li>If you are using Composer V2 and get the error 'namespace cannot be found', add the following class mapping in the composer.json file.</li>
      <code>"autoload": { "classmap": [ "/path/to/docusign-esign-client/src" ] }</code></li>
</ol>

## Dependencies
This client has the following external dependencies:
*   [PHP cURL extension](https://www.php.net/manual/en/intro.curl.php)
*   [PHP JSON extension](https://php.net/manual/en/book.json.php)

## Code examples
You can find on our GitHub a self-executing package of code examples for the eSignature PHP SDK, called a [Launcher](https://github.com/docusign/code-examples-php/blob/master/README.md), that demonstrates common use cases. You can also download a version preconfigured for your DocuSign developer account from [Quickstart](https://developers.docusign.com/docs/esign-rest-api/quickstart/). These examples can use either the [Authorization Code Grant](https://developers.docusign.com/esign-rest-api/guides/authentication/oauth2-code-grant) or [JSON Web Token (JWT)](https://developers.docusign.com/esign-rest-api/guides/authentication/oauth2-jsonwebtoken) authentication workflows.

## OAuth implementations
For details regarding which type of OAuth grant will work best for your DocuSign integration, see [Choose OAuth Type](https://developers.docusign.com/platform/auth/choose/) in the [DocuSign Developer Center](https://developers.docusign.com/).

For security purposes, DocuSign recommends using the [Authorization Code Grant](https://developers.docusign.com/esign-rest-api/guides/authentication/oauth2-code-grant) flow.

## Support
Log issues against this client through GitHub. We also have an [active developer community on Stack Overflow](https://stackoverflow.com/questions/tagged/docusignapi).

## License
The DocuSign eSignature PHP Client SDK is licensed under the [MIT License](https://github.com/docusign/docusign-php-client/blob/master/LICENSE).

### Additional resources
*   [DocuSign Developer Center](https://developers.docusign.com/)
*   [DocuSign API on Twitter](https://twitter.com/docusignapi)
*   [DocuSign For Developers on LinkedIn](https://www.linkedin.com/showcase/docusign-for-developers/)
*   [DocuSign For Developers on YouTube](https://www.youtube.com/channel/UCJSJ2kMs_qeQotmw4-lX2NQ)

[travis-image]: https://img.shields.io/travis/docusign/docusign-php-client.svg?style=flat
[travis-url]: https://travis-ci.org/docusign/docusign-php-client