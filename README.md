# The Official DocuSign PHP Client 

[![Build status][travis-image]][travis-url]

## Requirements

- PHP 5.4+
- Free [Developer Sandbox](https://go.docusign.com/sandbox/productshot/?elqCampaignId=16531)

## Compatibility

- PHP 5.4+

## Note

This open-source SDK is provided for cases where you would like to make additional changes that the SDK does not provide out-of-the-box. If you simply want to use the SDK with any of the examples shown in the [Developer Center](https://developers.docusign.com/esign-rest-api/code-examples), follow the installation instructions below.

## Installation

### Composer:

1. In your **PHP console** , type:  
   **Composer require docusign/esign-client;**
2. To use the package automatically, add to Composer's **Autoload** file:  
   **require_once('vendor/autoload.php');**

### Manual install:

<ol>
   <li>Download or clone this repository.</li>
   <li>Bind the PHP SDK to your server or place it in a static location.
       <ol style="list-style-type: lower-alpha simple">
           <li>To bind to your server, edit the <em>init.php</em> file. Add:<br>
               <code>require_once('/path/to/docusign-esign-client/autoload.php');</code></li>
           <li>To bind to single pages: In your PHP file that will utilize the PHP SDK, add:<br>
                <code>`require_once('/path/to/docusign-esign-client/autoload.php');</code></li>
       </ol>
   </li>
</ol>

## Dependencies

This client has the following external dependencies:

- [PHP cURL extension](https://www.php.net/manual/en/intro.curl.php)
- [PHP JSON extension](https://php.net/manual/en/book.json.php)

## Code Examples

### Launchers

DocuSign provides a sample application referred to as a [Launcher](https://github.com/docusign/eg-03-php-auth-code-grant). The Launcher contains a set of 18 common use cases and associated source files. These examples use DocuSign's [Authorization Code Grant](https://developers.docusign.com/esign-rest-api/guides/authentication/oauth2-code-grant) flow.

## Proof-of-concept applications

If your goal is to create a proof-of-concept application, DocuSign provides a set of [Quick Start](https://github.com/docusign/qs-php) examples. The Quick Startexamples are meant to be used with DocuSign's [OAuth Token Generator](https://developers.docusign.com/oauth-token-generator), which will allow you to generate tokens for the Demo/Sandbox environment only. These tokens last for eight hours and will enable you to build your proof-of-concept application without the need to fully implement an OAuth solution.

## OAuth Implementations

For details regarding which type of OAuth grant will work best for your DocuSign integration, see the [REST API Authentication Overview](https://developers.docusign.com/esign-rest-api/guides/authentication) guide located on the [DocuSign Developer Center](https://developers.docusign.com/esign-rest-api/guides/authentication).

For security purposes, DocuSign recommends using the [Authorization Code Grant](https://developers.docusign.com/esign-rest-api/guides/authentication/oauth2-code-grant) flow.

There are other use-case scenarios, such as **single-page applications** (SPA) that use **Cross-Origin Resource Sharing** (CORS), or where there may not be a user to interact with your Service Account. For these use cases, DocuSign also supports [JWT](https://developers.docusign.com/esign-rest-api/guides/authentication/oauth2-jsonwebtoken) and [Implicit](https://developers.docusign.com/esign-rest-api/guides/authentication/oauth2-implicit) grants. For code examples, see the links below:

- [JWT (JSON Web Token)](https://github.com/docusign/eg-03-php-auth-code-grant)
- Implicit Grant (coming soon)

## Support

Log issues against this client through GitHub. We also have an [active developer community on Stack Overflow](https://stackoverflow.com/questions/tagged/docusignapi).

## License

The DocuSign PHP Client is licensed under the [MIT License](https://github.com/docusign/docusign-php-client/blob/master/LICENSE).

[travis-image]: https://img.shields.io/travis/docusign/docusign-php-client.svg?style=flat
[travis-url]: https://travis-ci.org/docusign/docusign-php-client
