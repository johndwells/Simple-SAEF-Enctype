<?php

if ( ! defined('EXT')) exit('Invalid file request');

/**
 * Simple SAEF Enctype
 *
 * This extension provides a simple way to add "multipart/form-data" to your SAEF forms.
 *
 * @author    John D Wells <john@johndwells.com>
 * @copyright Copyright (c) 2009 John D Wells
 * @license   http://creativecommons.org/licenses/by-sa/3.0/ Attribution-Share Alike 3.0 Unported
 *
 *
 * @Updated to version 0.0.2 by Carl W Crawley, Made by Hippo LTD (www.madebyhippo.com)
 */

class Simple_saef_enctype_ext
{
	var $settings		= array();
	var $name			= "Simple SAEF Enctype EE2 Port by madebyhippo.com";
	var $version		= "0.0.2";
	var $description	= "This extension provides a simple way to add 'multipart/form-data' to your SAEF forms.";
	var $settings_exist	= "n";
	var $docs_url		= "";
	
	
	/**
     *	PHP4 Constructor
	 */
    function simple_saef_enctype($settings = '')
    {
		$this->EE =& get_instance();
		
		$this->__construct($settings);
	}
	
	/**
	 * PHP5 Constructor
	 */
	function __construct($settings = '')
	{
		$this->EE =& get_instance();
		
		$this->settings = $settings;
	}
	
	/**
     * Activate extension
	*/
	
    function activate_extension()
	{
		
		
		// -- Add rewrite_header
		
		$data = array(
			'class'        => "Simple_saef_enctype_ext",
			'method'       => "form_declaration_modify_data",
			'hook'         => 'form_declaration_modify_data',
			'settings'     => "",
			'priority'     => 10,
			'version'      => $this->version,
			'enabled'      => "y"
		);

		$this->EE->db->insert('exp_extensions', $data);
	}

	/**
	* Disables the extension the extension and deletes settings from DB
	*/
	function disable_extension()
	{
		
		$this->EE->db->where('class', "Simple_saef_enctype_ext");
	    $this->EE->db->delete('exp_extensions');
	    
	}
	
	/**
     *	Update extension
	*/
    function update_extension ($current = '')
	{

	}

	
	/**
     * Hook into form_declaration_modify_data
	 *
	 * Where the magic happens. Based *entirely* off of LG SAEF File Upload's Lg_saef_file_upload::form_declaration_modify_data().
	*/
	function form_declaration_modify_data ($data)
	{
		// -- Check if we're not the only one using this hook
		//if($EXT->last_call !== FALSE) $data = $EXT->last_call;
		// check if the $TMPL is an object 
		// on the traditional member pages this hook is called but there are no templates.
		if (($this->EE->TMPL->fetch_param('enctype') == 'multi') || ($this->EE->TMPL->fetch_param('enctype') == 'multipart/form-data'))
		{
			$data['enctype']='multi';
		}
		return $data;
	}

}

?>