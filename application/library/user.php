<?php
class User
{
	private $uname;
	private $password;
	private $email;
	private $country;
	private $dob;
	
  function __construct()
  {
  	
  }
  
  public function get_user_mame()
  {
  	return $this->uname;
  }
  public function get_email()
  {
  	return $this->email;
  }
  public function get_password()
  {
  	return $this->password;
  }
  public function set_password($password)
  {
  	$this->password = password_hash($password,PASSWORD_DEFAULT);
  }
  
  
 
  
}