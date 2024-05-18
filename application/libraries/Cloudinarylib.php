<?php
/**
 * This is a "dummy" library that just loads the actual library in the construct.
 * This technique prevents issues from CodeIgniter 3 when loading libraries that use PHP namespaces.
 * This file can be used with any PHP library that uses namespaces.  Just copy it, change the name of the class to match your library
 * and configs and go to town.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

// Setup the dummy class for Cloudinary
class Cloudinarylib {

    public function __construct()
    {

        // include the cloudinary library within the dummy class
        require('cloudinary/src/Cloudinary.php');
        require 'cloudinary/src/Uploader.php';
        require 'cloudinary/src/Api.php';

        // configure Cloudinary API connection
        // \Cloudinary::config(array(
		// 	"cloud_name" => "jabpayment",
        //     "api_key" => "521559165845656",
        //     "api_secret" => "oOcus3t3uCY-OWEukc2HfBWWUXg"
		// 	));

        \Cloudinary::config(array(
			"cloud_name" => "dnryh8kot",
            "api_key" => "767958513125443",
            "api_secret" => "GlaVes2zPYj-XCFS4gZtYHrGCZs"
			));

    }
}