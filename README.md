php-quotes-escape
=====================
To escape and unescape with php param, it fits on web-service stream transformation.

## Supports

PHP 4+

## How To Get Started
````PHP
<?php
	$Quotes   = new Quotes();
	#Escape with Array
	$_POST    = $Quotes->escapeHtmlString($_POST);
	$_GET     = $Quotes->escapeHtmlString($_GET);
	$_REQUEST = $Quotes->escapeHtmlString($_REQUEST);
	#Escape with String
	$escapedString   = $Quotes->escapeHtmlString($_string);
	#Unescape from Pure String
	$unescapedString = $Quotes->unescapeHtmlString($_string);
	#Unescape String from MySQL after you used mysql_real_escape_string() to escape the string.
	$unescapedString = $Quotes->unescapeHtmlStringFromMysql($_stringFromMysql);
?>
````
## Version

Now is V1.0.

## License

Quotes is available under the MIT license ( or Whatever you wanna do ). See the LICENSE file for more info.
