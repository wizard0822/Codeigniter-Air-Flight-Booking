<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter Phone Number Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Joël Gaujard
 * @link		https://github.com/defro/codeigniter-phonenumber
 */
// ------------------------------------------------------------------------
if ( ! function_exists('ciphonenumber_script_init'))
{
	function ciphonenumber_script_init($inputId = 'phone', array $options = array())
	{
		// Load file configuration
		$CI = &get_instance();
		$CI->load->config('ciphonenumber');
		// Options to configure intl-tel-input library
		$myOptions = array();
		// Build path to Utils JS file
		$path = $CI->config->item('ciphonenumber_intltelinput_path');
		$path .= 'js/utils.js';
		$js = base_url($path);
		$myOptions['utilsScript'] = $js;
		// Merge options with default ones
		$options = array_merge($myOptions, $options);
		// jQuery need to double escape special characters
		$inputId = quotemeta(quotemeta($inputId));
		// Initialise it
		$html = '<script type="text/javascript">';
		$html .= '$("#' . $inputId . '").intlTelInput(';
		$html .= json_encode($options, JSON_UNESCAPED_SLASHES);
		$html .= ');';
		$html .= '</script>';
		return ( $html );
	}
}
// ------------------------------------------------------------------------
if ( ! function_exists('ciphonenumber_input'))
{
	function ciphonenumber_input($phoneNumber = NULL, $inputName = 'phone', array $attributes = array())
	{
		// echo 1;die;
		$attributes = array_merge(
			array(
					'type' => 'tel',
					'id' => $inputName,
					'placeholder' => ("Phone number")
			),
			$attributes
		);
		// t($attributes,1);
		$input = form_input($inputName, $phoneNumber, $attributes);
		// t($input,1);
		return ( $input );
	}
}
// ------------------------------------------------------------------------
if ( ! function_exists('ciphonenumber_script'))
{
	function ciphonenumber_script($return = 'getHtml')
	{
		// Only few type of return is allowed
		if (!in_array($return, array('getHtml', 'getUrl', 'getPath'))) {
			trigger_error("Unknown asked return in ciphonenumber_script helper : $return.", E_USER_WARNING);
			return FALSE;
		}
		// Load file configuration
		$CI = &get_instance();
		$CI->load->config('ciphonenumber');
		// Build path to JS file
		$path = $CI->config->item('ciphonenumber_intltelinput_path');
		$path .= 'js/intlTelInput.min.js';
		// Return only path
		if ($return === 'getPath')
			return ( $path );
		// Generate URL
		$url = base_url($path);
		// Return complete URL
		if ($return === 'getUrl')
			return ( $url );
		// HTML tag for include script
		$html = '<script src="' . $url . '"></script>';
		return ( $html );
	}
}
// ------------------------------------------------------------------------
if ( ! function_exists('ciphonenumber_script_jquery'))
{
	function ciphonenumber_script_jquery($version = '1.11.1')
	{
		// Include jQuery
		$html = '<script src="//ajax.googleapis.com/ajax/libs/jquery/' . $version . '/jquery.min.js"></script>';
		return ( $html );
	}
}
// ------------------------------------------------------------------------
if ( ! function_exists('ciphonenumber_stylesheet_overwrite'))
{
	function ciphonenumber_stylesheet_overwrite()
	{
		// Load file configuration
		$CI = &get_instance();
		$CI->load->config('ciphonenumber');
		// Get path
		$intTelInput_path = $CI->config->item('ciphonenumber_intltelinput_path');
		// Override the path to flags.png
		$flags = base_url($intTelInput_path . 'img/flags.png');
		$html = '<style type="text/css">';
		$html .= '.iti-flag { background-image: url("' . $flags . '"); }';
		$html .= '</style>';
		return ( $html );
	}
}
// ------------------------------------------------------------------------
if ( ! function_exists('ciphonenumber_stylesheet'))
{
	function ciphonenumber_stylesheet($return = 'getHtml')
	{
		// Only few type of return is allowed
		if (!in_array($return, array('getHtml', 'getUrl', 'getPath'))) {
			trigger_error("Unknown asked return in ciphonenumber_stylesheet helper : $return.", E_USER_WARNING);
			return FALSE;
		}
		// Load file configuration
		$CI = &get_instance();
		$CI->load->config('ciphonenumber');
		// Build path to CSS file
		$path = $CI->config->item('ciphonenumber_intltelinput_path');
		$path .= 'css/intlTelInput.css';
		// Return only path
		if ($return === 'getPath')
			return ( $path );
		// Generate URL
		$url = base_url($path);
		// Return complete URL
		if ($return === 'getUrl')
			return ( $url );
		// HTML tag for include stylesheet
		$html = '<link rel="stylesheet" href="' . $url . '" />';
		return ( $html );
	}
}