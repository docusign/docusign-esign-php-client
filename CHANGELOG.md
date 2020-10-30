# DocuSign PHP Client Change Log
All notable changes to this project will be documented in this file.

See [DocuSign Support Center](https://support.docusign.com/en/releasenotes/) for Product Release Notes.

## [5.7.0] - eSignature API v2-20.3.01 - 2020-10-30
### Changed

*   Added support for version v2-20.3.01 of the DocuSign eSignature API.
*   Updated the SDK release version.

### Fixed

* Added Refresh Token
    * [#121](https://github.com/docusign/docusign-php-client/issues/121) - DCM-4819    
* Resolved Update Brand Resource issue
    * [#52](https://github.com/docusign/docusign-python-client/issues/52) - DCM-3869    

## [5.5.0] - eSignature API v2-20.3.00 - 2020-09-24
### Changed

*   Added support for version v2-20.3.00 of the DocuSign eSignature API.
*   Updated the SDK release version.

### Fixed

* Fixed APIException Serialization issue
    * [#83](https://github.com/docusign/docusign-php-client/issues/83) - DCM-3466
    * [#103](https://github.com/docusign/docusign-php-client/issues/103) - DCM-4286
    
## [5.4.0] - eSignature API v2.1-20.2.02 - 2020-08-25
### Changed

*   Added support for version v2.1-20.2.02 of the DocuSign eSignature API.
*   Updated the SDK release version.

## [5.3.0] - eSignature API v2.1-20.2.00 - 2020-07-09
### Changed

*   Added support for version v2.1-20.2.00 of the DocuSign eSignature API.
*   Updated the SDK release version.

### Fixed

* Fixed read member function issue in object serializer [#102](https://github.com/docusign/docusign-php-client/issues/102)

## [5.2.0] - eSignature API v2.1-20.1.02 - 2020-05-15
### Changed

*   Added support for version v2.1-20.1.02 of the DocuSign eSignature API.
*   Updated the SDK release version.

### Fixed

* Date serialization issues [#97](https://github.com/docusign/docusign-php-client/issues/97)

## [5.1.0] - eSignature API v2.1-20.1.00 - 2020-03-30
### Changed

*   Added support for version v2.1-20.1.00 of the DocuSign eSignature API.
*   Updated the SDK release version.

### Added

*   Added the new property `copy_recipient_data` to envelopes. When set to **true**, the information that recipients enter is retained when you clone an envelope. For example, if you resend an envelope that was declined or voided after one or more recipients entered data, that data is retained. Note that the new account UI setting `enable_envelope_copy_with_data` must be enabled for the account.
*   Added `input_options` and `RecipientIdentityInputOption` to `RecipientIdentityVerification` to support Identity Verification: Reserved for DocuSign.

## [5.0.0] - eSignature API v2-19.2.02 - 2019-09-28
### Changed
* The SDK now supports version 19.2.02 of the DocuSign eSignature API.
* SDK Release Version updated.git chec
### Fixed
* Number and Date serialization issues DCM-3210
* Updated phpdocs to point to new location of ApiException DCM-3372

## [4.0.0] - eSignature API v19.1.02 - 2019-06-07
### BREAKING
* Moved ApiClient and ApiException under Client folder
### Removed
* empty test placeholder files
### Changed
* updated existing test cases to use JWT instead of the legacy auth (still not fully working yet)
### Added
* OAuth models under Client/Auth folder
* new dependency for OAuth support (firebase/php-jwt)
* OAuthTests.php for OAuth support test
### Fixed
* A bug with that could cause the *moveEnvelopes* method call to return a response without a *Content-Type* header. (DCM-2871)

## [3.0.1] - Fixed the composer version - 2017-10-25

## [3.0.0] - Published all the DocuSign API endpoints - 2017-03-15

## [2.0.0] - New shiny PHP client - 2017-12-05

## [1.0.0] - Old legacy version - 2016-02-18