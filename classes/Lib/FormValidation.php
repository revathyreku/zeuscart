<?php
 /**
* GNU General Public License.

* This file is part of ZeusCart V4.

* ZeusCart V4 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 4 of the License, or
* (at your option) any later version.
* 
* ZeusCart V4 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/
/**
 * Form validation  related  class
 *
 * @package   		Lib_FormValidation
 * @subpackage  	Lib_Validation_Handler
 * @category    	Library
 * @author    		AJ Square Inc Dev Team
 * @link   			http://www.zeuscart.com
 * @copyright 	    Copyright (c) 2008 - 2013, AJ Square, Inc.
 * @version   		Version 4.0
 */
class Lib_FormValidation extends Lib_Validation_Handler 
{

	/**
	 * Function checks and invokes the validation module  
	 * 
	 * @param string $form
	 *
	 * @return void 
	 */	 	
	function Lib_FormValidation($form)
	{
		
		if($form=='register')
			$this->validateRegister();
		else if($form=='validatelogin')
			$this->validatelogin();
		else if($form=='validatemyprofile')
			$this->validatemyprofile();
		else if($form=='validatemail')
			$this->validatemail();
		else if($form=='productReview')
			$this->validateproductReview();
		else if($form=='contactUs')
			$this->contactUs();
		else if($form=='frmship')
			$this->validateCheckout();
		else if($form=='frmAcc')
			$this->validateUserAccount();
		else if($form=='changepassword')
			$this->validateChangePassword();
		else if($form=='frmWishSend')
			$this->validateWishlist();
		else if($form=='frmAddAddress')
			$this->validateAddress();			
		else if($form=='checkQuickregister')
			$this->validateQuickReg();
		else if($form=='billingaddress')
			$this->validateBillingAddress();	
		else if($form=='shippingaddress')
			$this->validateShippingAddress();
		else if($form=='shippingmethod')
			$this->validateShippingMethod();		
		else if($form=='giftvoucher')
			$this->validateGiftVoucher();
	}
	/**
	 * Function checks the gift voucher process parameters and assign an error
	 * 
	 *
	 * @return void 
	 */
	function validateGiftVoucher()
	{

		$message = "Required Field Cannot be blank";
		$this->Assign("rname",trim($_POST['rname']),"noempty",$message);
		$this->Assign("name",trim($_POST['name']),"noempty",$message);
		
		$this->Assign("gctheme",trim($_POST['gctheme']),"noempty",$message);
		
		$this->Assign("chkterms",trim($_POST['chkterms']),"noempty",$message);	

		$message = "Required Field Cannot be blank/Invalid Email";		
		$this->Assign("email",trim($_POST['email']),"noempty/emailcheck",$message);
		$this->Assign("remail",trim($_POST['remail']),"noempty/emailcheck",$message);

		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=prodetail&action=showprod&prodid='.$_GET['prodid'].'&vid=1');

	}
	/**
	 * Function checks the check out process shipping method and assign an error
	 * 
	 *
	 * @return void 
	 */
	function validateShippingMethod()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("shipment_id",trim($_POST['shipment_id']),"noempty",$message);

		$this->PerformValidation("".$_SESSION['base_url']."/index.php?do=showcart&action=getshippingmethod");
	}
	/**
	 * Function checks the check out process shipping address and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function validateShippingAddress()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("txtname",trim($_POST['txtname']),"noempty",$message);
		$this->Assign("txtstreet",trim($_POST['txtstreet']),"noempty",$message);
		$this->Assign("txtcity",trim($_POST['txtcity']),"noempty",$message);
		$this->Assign("txtstate",trim($_POST['txtstate']),"noempty",$message);
		$this->Assign("selshipcountry",trim($_POST['selshipcountry']),"noempty",$message);	
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty",$message);
		if($_POST['txtzipcode']!='')
		{
			if(!is_numeric($_POST['txtzipcode'])) 

				$this->Assign("txtzipcode","","noempty","ZIP code must be a digit number");

			
		}
		$this->Assign("txtphone",trim($_POST['txtphone']),"noempty",$message);

		if($_POST['txtphone']!='')
		{
			if(!preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $_POST['txtphone'])) 
			{
				$this->Assign("txtphone","","noempty","Please enter a valid phone number");
			}
		}


		$this->PerformValidation("".$_SESSION['base_url']."/index.php?do=showcart&action=getshippingaddressdetails");


	}
	/**
	 * Function checks the check out process billing address and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function validateBillingAddress()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("txtname",trim($_POST['txtname']),"noempty",$message);
		$this->Assign("txtstreet",trim($_POST['txtstreet']),"noempty",$message);
		$this->Assign("txtcity",trim($_POST['txtcity']),"noempty",$message);
		$this->Assign("txtstate",trim($_POST['txtstate']),"noempty",$message);
		$this->Assign("selbillcountry",trim($_POST['selbillcountry']),"noempty",$message);	
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty",$message);
		if($_POST['txtzipcode']!='')
		{
			if(!is_numeric($_POST['txtzipcode'])) 

				$this->Assign("txtzipcode","","noempty","ZIP code must be a digit number");

			
		}
		$this->Assign("txtphone",trim($_POST['txtphone']),"noempty",$message);

		if($_POST['txtphone']!='')
		{
			if(!preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $_POST['txtphone'])) 
			{
				$this->Assign("txtphone","","noempty","Please enter a valid phone number");
			}
		}
		$this->PerformValidation("".$_SESSION['base_url']."/index.php?do=showcart&action=getaddressdetails");

	}
	/**
	 * Function checks the product review  parameter and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function validateproductReview()
	{
		$message = "Please select one of each of the ratings above";
		$this->Assign("ratings",trim($_POST['ratings']),"noempty",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("detail",trim($_POST['detail']),"noempty",$message);
		$this->Assign("reviewtxt",trim($_POST['reviewtxt']),"noempty",$message);
		
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=productreview&action=showproductreview&prodid='.$_REQUEST['prodid']);
	}
	/**
	 * Function checks the contact us  parameter and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function contactUs()
	{
		/*if(empty($_POST['email']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("email",'',"noempty",$message);
		}
		else if($this->validateEmailAddress($_POST['email']))
		{
				exit;
		}
		else
		{
			$message = "Invalid Emails";
 			$this->Assign("email",'',"noempty",$message);
		}
		*/
		$message = "Required Field Cannot be blank/Invalid Email";
		$this->Assign("email",trim($_POST['email']),"noempty/emailcheck",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtname",trim($_POST['txtname']),"noempty",$message);
		
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=contactus');
	}
	/**
	 * Function checks the profile page parameter  and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function validatemyprofile()
	{


		$message = "Required Field Cannot be blank/Alphanumeric not allowed/No special characters allowed";
		$this->Assign("firstname",trim($_POST['firstname']),"noempty/nonumber/nospecial''",$message);
		$message = "Required Field Cannot be blank/Alphanumeric not allowed/No special characters allowed";
		$this->Assign("lastname",trim($_POST['lastname']),"noempty/nonumber/nospecial''",$message);
		/*if(empty($_POST['email']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("email",'',"noempty",$message);
		}
		else if($this->validateEmailAddress($_POST['email']))
		{
				exit;
		}
		else
		{
			$message = "Invalid Emails";
 			$this->Assign("email",'',"noempty",$message);
		}*/
		$message = "Required Field Cannot be blank/Invalid Email";		
		$this->Assign("email",trim($_POST['email']),"noempty/emailcheck",$message);
		$message = "Required Field Cannot be blank";
		$this->Assign("passwd",trim($_POST['passwd']),"noempty",$message);
		$this->Assign("cpasswd",trim($_POST['cpasswd']),"noempty",$message);
		if(trim($_POST['passwd']) != '' and trim($_POST['cpasswd']) != '')
		{
			$pwdlength =strlen($_POST['passwd']);
			if($pwdlength<6)
			{
				$message = "Password minimum length is 6";
				$this->Assign("passwd","","noempty",$message);
			}
			elseif(trim($_POST['passwd']) != trim($_POST['cpasswd']))
			{
				$message = "Enter the Confirm Password";
				$this->Assign("cpasswd","","noempty",$message);
				
			}
		}
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=myprofile');
	}
	
	/**
	 * Function checks the login page parameter  and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function validatelogin()
	{

		/*if(empty($_POST['txtemail']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("txtemail",'',"noempty",$message);
		}
		else if($this->validateEmailAddress($_POST['txtemail']))
		{
				exit;
		}
		else
		{
			$message = "Invalid Emails";
 			$this->Assign("txtemail",'',"noempty",$message);
		}*/
		
		unset($_SESSION['mycart']);
		$message = "Required Field Cannot be blank/Invalid Email";
		$this->Assign("txtemail",trim($_POST['txtemail']),"noempty/emailcheck",$message);
		$message = "Required Field Cannot be blank";
		$this->Assign("txtpass",trim($_POST['txtpass']),"noempty",$message);
		//$this->Assign("txtcaptcha",trim($_POST['txtcaptcha']),"noempty",$message);
		//if(!empty($_POST['txtcaptcha']) && !(strtolower(trim($_POST['txtcaptcha']))==strtolower($code)))
			//$this->Assign("txtcaptcha","","noempty",$message);	
			
		
		$useremail = $_POST['txtemail'];
		$pswd = $_POST['txtpass'];
		$pswd  = md5($pswd);
		
		/*$message = "Characters should match the above image";
		$code = $_SESSION['security_code'];	*/	
		// 		if(!empty($_POST['txtcaptcha']) && !(strtolower(trim($_POST['txtcaptcha']))==strtolower($code)))
		// 		{
		// 			$this->Assign("txtcaptcha","","noempty",$message);	
		// 			$this->PerformValidation('?do=login');
		// 		}
		if(trim($useremail) != '' and trim($pswd) != '' )
		{
			
			$sqlselect = "select * from users_table where user_email='".$useremail."' and user_status=1";
			$obj1 = new Bin_Query();
			$obj2 = new Bin_Query();
			if($obj1->executeQuery($sqlselect))
			{
				$sql = "select count(*) as temp from users_table where user_email='".$useremail."' and user_pwd='".$pswd."' and user_status=1"; 
				$obj2->executeQuery($sql);
				if($obj2->records[0]['temp']==0)
				{
					
					$message = "Invalid Username or Password";
					$this->Assign("txtpass",'',"noempty",$message);
					
				}
				else
				{
					$_SESSION['user_id'] = $obj1->records[0]['user_id'];
					$_SESSION['user_name'] = $obj1->records[0]['user_display_name'];
					$_SESSION['user_email'] = $obj1->records[0]['user_email'];

					$sqlShop="SELECT a.*,b.* FROM shopping_cart_table AS a LEFT JOIN shopping_cart_products_table AS b ON a.cart_id=b.cart_id WHERE a.user_id='". $_SESSION['user_id']."'"; 
					$objShop=new Bin_Query();
					$objShop->executeQuery($sqlShop);
					$records=$objShop->records;
					if(count($records)>0)
					{
						$cartId=$objShop->records[0]['cart_id'];	
						 $updateCart="UPDATE  shopping_cart_table SET cart_id ='".$cartId."'      WHERE user_id='". $_SESSION['user_id']."'";
						$objCart=new Bin_Query($updateCart);
						$objCart->updateQuery();
						for($i=0;$i<count($records);$i++)
						{
				
							$shopProduct="UPDATE  shopping_cart_products_table  SET cart_id ='".$cartId."'WHERE id='".$objShop->records[$i]['id']."'";
							$objProduct=new Bin_Query($updateCart);
							$objProduct->updateQuery($shopProduct);
						}
					}
	
					if($_POST['remlogin'] == "on")
						setcookie("usremail", $_POST['txtemail']);						
					else
						unset($_COOKIE['usremail']);
						
				}
				
			}
			else
			{
				unset($_COOKIE['usremail']);
				$message = "Invalid User Email";
		    		$this->Assign("txtemail",'',"noempty",$message);
				
			}
		}
		
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=login');
	}
	/**
	 * Function checks the register page parameter  and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function validateRegister()
	{
		
		$message = "Required Field Cannot be blank/Alphanumeric not allowed/No special characters allowed";
		$this->Assign("txtfname",trim($_POST['txtfname']),"noempty/nonumber/nospecial''",$message);
		$message = "Required Field Cannot be blank/ Alphanumeric not allowed/No special characters allowed";
		$this->Assign("txtlname",trim($_POST['txtlname']),"noempty/nonumber/nospecial''",$message);
		$message = "Required Field Cannot be blank/No special characters allowed";
		$this->Assign("txtdisname",trim($_POST['txtdisname']),"noempty/nospecial''",$message);
		/*if(empty($_POST['txtemail']))
		{
		    $message = "Required Field Cannot be blank";
			$this->Assign("txtemail",'',"noempty",$message);
		}
		else if($this->validateEmailAddress($_POST['txtemail']))
		{
				exit;
				
		}
		else
		{
			
			$message = "Invalid Emails";
 			$this->Assign("txtemail",'',"noempty",$message);
		}*/
		$message = "Required Field Cannot be blank/Invalid Email";		
		$this->Assign("txtemail",trim($_POST['txtemail']),"noempty/emailcheck",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtaddr",trim($_POST['txtaddr']),"noempty",$message);
		
		$message = "Required Field Cannot be blank/ Alphanumeric not allowed/No special characters allowed";
		$this->Assign("txtcity",trim($_POST['txtcity']),"noempty/nonumber/nospecial''",$message);
		$this->Assign("txtState",trim($_POST['txtState']),"noempty/nonumber/nospecial''",$message);
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty",$message);

		$message = "Required Field Cannot be blank";
		$this->Assign("txtpwd",trim($_POST['txtpwd']),"noempty",$message);
		$this->Assign("txtrepwd",trim($_POST['txtrepwd']),"noempty",$message);
		if(trim($_POST['txtpwd']) != '' and trim($_POST['txtrepwd']) != '')
		{
			$pwdlength =strlen($_POST['txtpwd']);
			if($pwdlength<6 or $pwdlength>20)
			{
				$message = "Password minimum length is 6 & maximum length is 20";
				$this->Assign("txtpwd","","noempty",$message);
			}
			elseif(trim($_POST['txtpwd']) != trim($_POST['txtrepwd']))
			{
				$message = "Enter the Confirm Password correctly";
				$this->Assign("txtrepwd","","noempty",$message);
				
			}
		}
		
		if(trim($_POST['txtfname']) != '' and trim($_POST['txtlname']) != '' and trim($_POST['txtdisname'])!='')
		{
			$fnamelength =strlen($_POST['txtfname']);
			$lnamelength =strlen($_POST['txtlname']);
			$dislength =strlen($_POST['txtdisname']);
			if($fnamelength<3 or $fnamelength>20)
			{
				$message = "Minimum length is 3";
				$this->Assign("txtfname","","noempty",$message);
			}
			if($lnamelength<3 or $lnamelength>20)
			{
				$message = "Minimum length is 3";
				$this->Assign("txtfname","","noempty",$message);
			}
			if($dislength<3 or $dislength>20)
			{
				$message = "Minimum length is 3";
				$this->Assign("txtdisname","","noempty",$message);
			}
		}
		
		/*$this->Assign("txtcaptcha",trim($_POST['txtcaptcha']),"noempty",$message);
		$message = "Characters should match the above image";
		$code = $_SESSION['security_code'];
		if(!empty($_POST['txtcaptcha']) && !(strtolower(trim($_POST['txtcaptcha']))==strtolower($code)))
				$this->Assign("txtcaptcha","","noempty",$message);*/	
		
		
		
		/*if(trim($_POST['txtemail']) != '' and trim($_POST['txtremail']) != '')
		{
			if(trim($_POST['txtemail']) != trim($_POST['txtremail']))
			{
				$message = "Enter the Confirm Email id correctly";
				$this->Assign("txtremail","","noempty",$message);
				
			}
		}*/
		
		$message = "Please select terms";
		$this->Assign("chkterms",trim($_POST['chkterms']),"noempty",$message);
		
		if(trim($_POST['txtemail']) != '')
		{
			
			$sqlselect = "select * from users_table where user_email='".$_POST['txtemail']."'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				if($obj->totrows>0)
				{
					$message = "Email already Exist!.Try again.";		
					$this->Assign("txtemail",'',"noempty",$message);
				}
			}
		}
		if(trim($_POST['txtdisname']) != '')
		{
			
			$sqlselect = "select * from users_table where user_display_name='".$_POST['txtdisname']."'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				if($obj->totrows>0)
				{
					$message = "Username already Exist!.Try again.";		
					$this->Assign("txtdisname",'',"noempty",$message);
				}
			}
		}
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=userregistration');
	}
	/**
	 * Function checks the forgotpassword page parameter  and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function validatemail()
	{
		
		if($_POST['email']!='' and $_POST['email']=='')
		{
		    $message = "Required Field Cannot be blank/Invalid Email";
			$this->Assign("email",'',"noempty/emailcheck",$message);echo'l';exit;
		}
		
		/*else
		{
			$message = "Invalid Emails";
 			$this->Assign("email",'',"noempty",$message);
		}
		$message = "Required Field Cannot be blank/Invalid Email";
		$this->Assign("email",trim($_POST['email']),"noempty/emailcheck",$message);*/
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=forgetpwd');
	}
	
	/**
	 * Function to validate email
	 * @param string $email
	 * @param bool 	 $check_domain	 
	 *
	 * @return void 
	 */	
	function email($email, $check_domain = false)
    	{
			
		if($check_domain){
	
		}
	
		if (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.
			'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.
			'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $email))
		{
		if ($check_domain && function_exists('checkdnsrr')) {
			list (, $domain)  = explode('@', $email);
			if (checkdnsrr($domain, 'MX') || checkdnsrr($domain, 'A')) {
			return true;
			}
			return false;
		}
		return true;
		}
		return false;
    	}
	
	/*function validateEmailAddress($email) 
	 {
		
			// First, we check that there's one @ symbol, and that the lengths are right
		if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
			{
			// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
				echo 'it has more @values ';
				return false;
		}
		// Split it into sections to make life easier
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
			
		for ($i = 0; $i < sizeof($local_array); $i++) 
			{
				if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
				{
				return false;
				}
			}
			if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) 
			{
			return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($domain_array); $i++) 
			{
				if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
				{
					return false;
			}
		}
		}
		return true;
  	 }
	*/
	/**
	 * Function checks the check out prcocess address  and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function validateCheckout()
	{

		$message = "Required Field Cannot be blank";
		$this->Assign("txtname",trim($_POST['txtname']),"noempty",$message);
		//	$this->Assign("txtcompany",trim($_POST['txtcompany']),"noempty",$message);		
		$this->Assign("txtstreet",trim($_POST['txtstreet']),"noempty",$message);
		//	$this->Assign("txtsuburb",trim($_POST['txtsuburb']),"noempty",$message);
		$this->Assign("txtzipcode",trim($_POST['txtzipcode']),"noempty",$message);
		$this->Assign("selbillcountry",trim($_POST['selbillcountry']),"noempty",$message);
		$this->Assign("txtstate",trim($_POST['txtstate']),"noempty",$message);
		
		$this->Assign("txtsname",trim($_POST['txtsname']),"noempty",$message);
		//	$this->Assign("txtscompany",trim($_POST['txtscompany']),"noempty",$message);
		$this->Assign("txtsstreet",trim($_POST['txtsstreet']),"noempty",$message);
		//	$this->Assign("txtssuburb",trim($_POST['txtssuburb']),"noempty",$message);
		$this->Assign("txtszipcode",trim($_POST['txtszipcode']),"noempty",$message);
		$this->Assign("selshipcountry",trim($_POST['selshipcountry']),"noempty",$message);
		$this->Assign("txtsstate",trim($_POST['txtsstate']),"noempty",$message);
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=showcart&action=getaddressdetails');
	}
	/**
	 * Function checks the add to wishlist parameter address  and assign an error
	 * 
	 *
	 * @return void 
	 */	
	function validateWishlist()
	{
		$message = "Required Field Cannot be blank/Invalid Email Id";
		$this->Assign("txtEmail",trim($_POST['txtEmail']),"noempty/emailcheck",$message);

		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=wishlist');
	}
	/**
	 * Function checks the user account information page parameter  and assign an error
	 * 
	 *
	 * @return void 
	 */
	function validateUserAccount()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("txtFName",trim($_POST['txtFName']),"noempty",$message);

		$message = "Required Field Cannot be blank";
		$this->Assign("txtLName",trim($_POST['txtLName']),"noempty",$message);

		$message = "Required Field Cannot be blank/Invalid Email";
		$this->Assign("txtEmail",trim($_POST['txtEmail']),"noempty/emailcheck",$message);

		
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=accountinfo');

	}
	/**
	 * Function checks the user account information page parameter  and assign an error
	 * 
	 *
	 * @return void 
	 */
	function validateChangePassword()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("txtCPwd",trim($_POST['txtCPwd']),"noempty",$message);
		$this->Assign("txtNPwd",trim($_POST['txtNPwd']),"noempty",$message);
		$this->Assign("txtCNPwd",trim($_POST['txtCNPwd']),"noempty",$message);

		$sql="select user_pwd from users_table where user_status=1 and user_id=".$_SESSION['user_id'];	
		$obj = new Bin_Query();
		if($obj->executeQuery($sql))
		{
			$cpwd=$obj->records[0]['user_pwd'];
		}
		else
		$cpwd='';

				
		if($_POST['txtCPwd']!='')
		{
			if(md5(trim($_POST['txtCPwd']))!=$cpwd)
			{	
				$message = "Invalid Current Password";
				$this->Assign("txtCPwd","","noempty",$message);
			}
		}
			
		if($_POST['txtNPwd']!='')
		{
			$pwdlength =strlen($_POST['txtNPwd']);
			if($pwdlength<6)
			{
				$message = "Password minimum length is 6";
				$this->Assign("txtNPwd","","noempty",$message);
			}					
		}

		if($_POST['txtCNPwd']!='')
		{
			$pwdlength =strlen($_POST['txtCNPwd']);
			if($pwdlength<6)
			{
				$message = "Password minimum length is 6";
				$this->Assign("txtCNPwd","","noempty",$message);
			}					
		}


		if($_POST['txtNPwd']!=''&& $_POST['txtCNPwd']!='')
		{
			if(trim($_POST['txtNPwd'])!=trim($_POST['txtCNPwd']))	
			{
				$message = "Password mismatch";
				$this->Assign("txtCNPwd","","noempty",$message);
			}			
		}
		
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=changepassword');
	}
	/**
	 * Function checks the user address  and assign an error
	 * 
	 *
	 * @return void 
	 */
	function validateAddress()
	{
		$message = "Required Field Cannot be blank";
		$this->Assign("txtGName",trim($_POST['txtGName']),"noempty",$message);
		
		if(trim($_POST['txtGName'])!='' && $_POST['Submit2']=='Create')		
		{
			$sqlselect = "select * from addressbook_table where contact_name='".$_POST['txtGName']."' and user_id='".$_SESSION['user_id']."'";
			$obj = new Bin_Query();
			if($obj->executeQuery($sqlselect))
			{
				if($obj->totrows>0)
				{
					$message = "Name already Exist in datatbase";		
					$this->Assign("txtGName",'',"noempty",$message);
				}
			}
		}
	
		$message = "Required Field Cannot be blank";
		$this->Assign("txtFName",trim($_POST['txtFName']),"noempty",$message);

		$message = "Required Field Cannot be blank";
		$this->Assign("txtLName",trim($_POST['txtLName']),"noempty",$message);

		if(trim($_POST['txtEMail'])!='')
		{
			$message = "Invalid Email";
			$this->Assign("txtEMail",trim($_POST['txtEMail']),"emailcheck",$message);
		}
		
		$message = "Required Field Cannot be blank";
		$this->Assign("txtAddress",trim($_POST['txtAddress']),"noempty",$message);
		$this->Assign("txtCity",trim($_POST['txtCity']),"noempty",$message);
		$this->Assign("txtState",trim($_POST['txtState']),"noempty",$message);
		$this->Assign("txtZip",trim($_POST['txtZip']),"noempty",$message);
		
		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=addaddress');

	}
	/**
	 * Function checks the  user register page in checkout process  and assign an error
	 * 
	 *
	 * @return void 
	 */
	function validateQuickReg()
	{
	

		$message = "Required Field Cannot be blank";
		$this->Assign("txtregemail",trim($_POST['txtregemail']),"noempty",$message);
		$this->Assign("txtregpass",trim($_POST['txtregpass']),"noempty",$message);
		//$this->Assign("txtcaptcha",trim($_POST['txtcaptcha']),"noempty",$message);
		
		if($_POST['txtregpass']!='')
		{
			$pwdlength =strlen($_POST['txtregpass']);
			if($pwdlength<6)
			{
				$message = "Password minimum length is 6";
				$this->Assign("txtregpass","","noempty",$message);
			}			
		}	
		
		if(trim($_POST['txtregemail'])!='')
		{
			$message = "Invalid Email";
			$this->Assign("txtregemail",trim($_POST['txtregemail']),"emailcheck",$message);
		}
		
		// 		$message = "Characters should match the above image";
		// 		$code = $_SESSION['security_code'];
		// 		if(!empty($_POST['txtcaptcha']) && !(strtolower(trim($_POST['txtcaptcha']))==strtolower($code)))
		// 				$this->Assign("txtcaptcha","","noempty",$message);	
	

		$useremail = $_POST['txtregemail'];
		$pswd = $_POST['txtregpass'];
		$pswd  = md5($pswd);
		if(trim($useremail) != '' and trim($pswd) != '' )
		{
			
			$sqlselect = "select * from users_table where user_email='".$useremail."' and user_status=1";
			$obj1 = new Bin_Query();
			$obj2 = new Bin_Query();
			if($obj1->executeQuery($sqlselect))
			{
				$sql = "select count(*) as temp from users_table where user_email='".$useremail."' and user_pwd='".$pswd."' and user_status=1"; 
				$obj2->executeQuery($sql);
				if($obj2->records[0]['temp']==0)
				{
					
					$message = "Invalid  Password";
					$this->Assign("txtregpass",'',"noempty",$message);
					
				}
				else
				{
					$_SESSION['user_id'] = $obj1->records[0]['user_id'];
					$_SESSION['user_name'] = $obj1->records[0]['user_display_name'];
					$_SESSION['user_email'] = $obj1->records[0]['user_email'];
					if($_POST['remlogin'] == "on")
						setcookie("usremail", $_POST['txtregemail']);						
					else
						unset($_COOKIE['usremail']);
						
				}
				
			}
			else
			{
				unset($_COOKIE['usremail']);
				$message = "Invalid User Email";
		    		$this->Assign("txtregemail",'',"noempty",$message);
				
			}
		}

		$this->PerformValidation(''.$_SESSION['base_url'].'/index.php?do=showcart&action=showquickregistration');

	
	}
	
		
}
?>