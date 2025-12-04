# The Official Docusign eSignature PHP Client SDK

The Docusign SDK makes integrating Docusign into your apps and websites a seamless experience.

## Table of Contents
- [Introduction](#introduction)
- [Installation](#installation)
	* [Version Information](#versionInformation)
	* [Requirements](#requirements)
	* [Compatibility](#compatibility)
	* [Composer](#composer)
	* [Manual Install](#manualInstall)
- [Dependencies](#dependencies)
- [API Reference](#apiReference)
- [Code Examples](#codeExamples)
- [OAuth Implementations](#oauthImplementations)
- [Changelog](#changeLog)
- [Support](#support)
- [License](#license)
- [Additional Resources](#additionalResources)

<a id="introduction"></a>
## Introduction
Integrate eSignatures into your application in minutes. The secure and award-winning Docusign eSignature API makes requesting signatures, automating forms, and tracking documents directly from your app easy.

<a id="installation"></a>
## Installation
This client SDK is provided as open source, which enables you to customize its functionality to suit your particular use case. To do so, download or clone the repository. If the SDK’s given functionality meets your integration needs, or if you’re working through our [code examples](https://developers.docusign.com/docs/esign-rest-api/how-to/) from the [Docusign Developer Center](https://developers.docusign.com/), you merely need to install it by following the instructions below.

<a id="versionInformation"></a>
### Version Information
- **API version**: v2.1
- **Latest SDK version**: 8.6.0

<a id="requirements"></a>
### Requirements
*   PHP 7.4+
*   Free [developer account](https://go.docusign.com/o/sandbox/?postActivateUrl=https://developers.docusign.com/)

<a id="compatibility"></a>
### Compatibility
*   PHP 7.4+

<a id="composer"></a>
### Composer:
1. In your PHP console, type: **Composer require docusign/esign-client;**
2. To use the package automatically, add to Composer's Autoload file: 
`require_once('vendor/autoload.php');`

<a id="manualInstall"></a>
### Manual Install:

<ol>
   <li>Download or clone this repository.</li>
   <li>Bind the PHP SDK to your server or place it in a static location.
       <ol style="list-style-type: lower-alpha simple">
           <li>To bind to your server, edit the <em>init.php</em> file. Add:<br>
               <code>require_once('/path/to/docusign-esign-php-client/autoload.php');</code></li>
           <li>To bind to single pages: In your PHP file that will utilize the PHP SDK, add:<br>
                <code>require_once('/path/to/docusign-esign-php-client/autoload.php');</code></li>
       </ol>
   </li>
   <li>If you are using Composer V2 and get the error 'namespace cannot be found', add the following class mapping in the composer.json file.</li>
      <code>"autoload": { "classmap": [ "/path/to/docusign-esign-php-client/src" ] }</code></li>
</ol>

<a id="dependencies"></a>
## SDK Dependencies
This client has the following external dependencies:
*   [PHP cURL extension](https://www.php.net/manual/en/intro.curl.php)
*   [PHP JSON extension](https://php.net/manual/en/book.json.php)
*   [PHP MBString extension](https://www.php.net/manual/en/intro.mbstring.php)
*   firebase/php-jwt v6.0

<a id="apiReference"></a>
## API Reference
You can refer to the API reference [here](https://developers.docusign.com/docs/esign-rest-api/reference/).

<a id="codeExamples"></a>
## Code examples
Explore our GitHub repository for the [Launcher](https://github.com/docusign/code-examples-php/), a self-executing package housing code examples for the eSignature PHP SDK. This package showcases several common use cases and their respective source files. Additionally, you can download a version preconfigured for your Docusign developer account from [Quickstart](https://developers.docusign.com/docs/esign-rest-api/quickstart/). These examples support both the [Authorization Code Grant](https://developers.docusign.com/platform/auth/authcode/) and [JSON Web Token (JWT)](https://developers.docusign.com/platform/auth/jwt/) authentication workflows.

<a id="oauthImplementations"></a>
## OAuth implementations
For details regarding which type of OAuth grant will work best for your Docusign integration, see [Choose OAuth Type](https://developers.docusign.com/platform/auth/choose/) in the [Docusign Developer Center](https://developers.docusign.com/).

For security purposes, Docusign recommends using the [Authorization Code Grant](https://developers.docusign.com/platform/auth/authcode/) flow.

<a id="changeLog"></a>
## Changelog
You can refer to the complete changelog [here](https://github.com/docusign/docusign-esign-php-client/blob/master/CHANGELOG.md).

<a id="support"></a>
## Support
Log issues against this client SDK through GitHub. You can also reach out to us through [Docusign Community](https://community.docusign.com/developer-59) and [Stack Overflow](https://stackoverflow.com/questions/tagged/docusignapi).

<a id="license"></a>
## License
The Docusign eSignature PHP Client SDK is licensed under the [MIT License](https://github.com/docusign/docusign-esign-php-client/blob/master/LICENSE).

<a id="additionalResources"></a>
### Additional resources
*   [Docusign Developer Center](https://developers.docusign.com/)
*   [Docusign API on Twitter](https://twitter.com/docusignapi)
*   [Docusign For Developers on LinkedIn](https://www.linkedin.com/showcase/docusign-for-developers/)
*   [Docusign For Developers on YouTube](https://www.youtube.com/channel/UCJSJ2kMs_qeQotmw4-lX2NQ)