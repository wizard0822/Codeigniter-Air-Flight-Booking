<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Path to intl-tel-input plugin
|--------------------------------------------------------------------------
|
| Path to Intl Tel Input medias includes css, img and js folders.
| This option is already set to right folder when you install
| this library with composer.
|
*/
$config['ciphonenumber_intltelinput_path'] = 'vendor/jackocnr/intl-tel-input/build/';

/*
|--------------------------------------------------------------------------
| National Mode - Type: Boolean
|--------------------------------------------------------------------------
|
| Allow users to enter national numbers (and not have to think about
| international dial codes).
| This option now defaults to true, and it is recommended that you
| leave it that way as it provides a better experience for the user.
|
*/
$config['ciphonenumber_nationalMode'] = TRUE;

