<?php

if ( ! defined('EXT')) exit('Invalid file request');

/**
 * Simple SAEF Enctype
 *
 * Add "multipart/form-data" to your SAEF forms. For ExpressionEngine 1 & 2.
 *
 * @author    John D Wells <john@johndwells.com>
 * @copyright Copyright (c) 2009 John D Wells
 * @license   http://creativecommons.org/licenses/by-sa/3.0/ Attribution-Share Alike 3.0 Unported
 */

class simple_saef_enctype
{
	var $settings		= array();
	var $name			= 'Simple SAEF Enctype';
	var $version		= '0.0.2';
	var $description	= 'Add "multipart/form-data" to your SAEF forms. For ExpressionEngine 1 & 2.';
	var $settings_exits	= 'n';
	var $docs_url		= 'https://github.com/johndwells/Simple-SAEF-Enctype';
	
	/**
     *	PHP4 Constructor
	 */
    function simple_saef_enctype($settings = '')
    {
		$this->__construct($settings);
	}
	
	/**
	 * PHP5 Constructor
	 */
	function __construct($settings = '')
	{
		$this->settings = $settings;
	}
	
	/**
     * Activate extension
	*/
	
    function activate_extension()
	{
		global $DB;
		
		// -- Add rewrite_header
		
		$DB->query(
			$DB->insert_string(
				'exp_extensions', array('extension_id' => '',
				'class'        => get_class($this),
				'method'       => 'form_declaration_modify_data',
				'hook'         => 'form_declaration_modify_data',
				'settings'     => '',
				'priority'     => 10,
				'version'      => $this->version,
				'enabled'      => 'y'
				)
			)
		);
	}

	/**
	* Disables the extension the extension and deletes settings from DB
	*/
	function disable_extension()
	{
		global $DB;
		$DB->query("DELETE FROM exp_extensions WHERE class = '" . get_class($this) . "'");
	}
	
	/**
     *	Update extension
	*/
    function update_extension ($current = '')
	{
		global $DB;
		
		if ($current == '' OR $current == $this->version) return FALSE;
		
		$DB->query("UPDATE exp_extensions SET version = '".$DB->escape_str($this->version)."' WHERE class = '".get_class($this)."'");
	}

	
	/**
     * Hook into form_declaration_modify_data
	 *
	 * Where the magic happens. Based *entirely* off of LG SAEF File Upload's Lg_saef_file_upload::form_declaration_modify_data().
	*/
	function form_declaration_modify_data ($data)
	{
		global $EXT, $TMPL;
		// -- Check if we're not the only one using this hook
		if($EXT->last_call !== FALSE) $data = $EXT->last_call;
		// check if the $TMPL is an object 
		// on the traditional member pages this hook is called but there are no templates.
		if(is_object($TMPL) === TRUE && ( $TMPL->fetch_param('enctype') == 'multi' || $TMPL->fetch_param('enctype') == 'multipart/form-data'))
		{
			$data['enctype']='multi';
		}
		return $data;
	}

}

?>