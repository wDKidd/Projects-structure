<?php 
$message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Riaan Manser Invoice</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" align="center" valign="top">
    	<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="600" align="right" valign="top">
            	<a href="http://riaanmanser.co.za" title="Visit website" target="_blank">
              		<img src="http://riaanmanser.co.za/includes/pear_mail/process/pages/images/rm_logo_2x.png" alt="Riaan Manser logo" width="69" height="57" style="display:block;" border="none" />
              </a>
            </td>
          </tr>
          <tr>
            <td width="600" align="left" valign="top">
                <p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:24px;padding-top:0;padding-bottom:0; line-height:28px; text-align:left;">Dear '.$_POST['name'].',<br/>
                Thank you for supporting Riaan Manser. Your order will be processed shortly.</p>
                <p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:bold;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:28px; text-align:left;">Riaan Manser Shop Items</p>
            </td>
          </tr>
          <tr>
            <td width="600" align="left" valign="top">
            	<table width="600" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="360" align="left" valign="top">
                    	<p style="color:#ecba0e;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:28px; text-align:left;">Name</p>
                    </td>
                    <td width="78" align="center" valign="top">
                    	<p style="color:#ecba0e;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:28px; text-align:center;">Quantity</p>
                    </td>
                    <td width="78" align="center" valign="top">
                    	 <p style="color:#ecba0e;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:28px; text-align:center;">Price</p>
                     </td>
                    <td width="84" align="center" valign="top">
                    	 <p style="color:#ecba0e;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:28px; text-align:center;">Sub-total</p>
                  </td>
                  </tr>';
                  
                  	//fix so that items are not repetively added to the invoice by cycling through variants
                    $prod_ids = array_unique($_POST['prod_id']);
					//foreach($_POST['prod_id'] as $p){
					foreach($prod_ids as $p){
						if(isset($_POST['variant'][$p])){
							foreach($_POST['variant'][$p] as $v){
								$product = $dl->select('shop_product AS sp LEFT JOIN shop_variant_link AS svl ON sp.shop_product_id=svl.shop_product_id LEFT JOIN shop_variant AS sv ON svl.shop_variant_id=sv.shop_variant_id', 'sp.shop_product_id="'.$p.'" AND sv.shop_variant_name="'.$v.'"');
								echo $dl->getError();
								$product = $product[0];
								
								$cart_total+=($_POST['qty'][$p][$v]*$product['shop_variant_link_price']);
								
								$message .= '
								<tr>
				                    <td width="67%" align="left" valign="top">
				                    	 <p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:28px; text-align:left;">('.strtoupper($v).') '.$product['shop_product_name'].'</p>
				                    </td>
				                    <td width="11%" align="center" valign="top">
				                    	 <p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:28px; text-align:center;">'.$_POST['qty'][$p][$v].'</p>
				                    </td>
				                    <td width="11%" align="center" valign="top">
				                    	 <p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:28px; text-align:center;">R'.$product['shop_variant_link_price'].'</p>
				                         </td>
				                    <td width="11%" align="center" valign="top">
				                    	 <p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:28px; text-align:center;">R'.($_POST['qty'][$p][$v]*$product['shop_variant_link_price']).'</p>
				                    </td>
				                  </tr>
								';
							}
						}
					}
                                    
                  
                  $message .= '
                </table>
            </td>
          </tr>
          <tr>
            <td width="600" align="right" valign="top">
            	 <p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:30px;margin-bottom:20px;padding-top:0;padding-bottom:0; line-height:28px; text-align:right;"><span style="color:#ecba0e;">Total:</span> R'.$cart_total.'<br><span style="font-size:10px;">Order No. '.$invoice_number.'</span></p>
            </td>
          </tr>
          
        </table>
        <table width="650" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="650" align="center" valign="top" style="background-color:#e4e4e4; padding-top:10px; padding-bottom:18px;">
            	<table width="600" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><p style="color:#ecba0e;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:45px; text-align:left;">Details</p></td>
                  </tr>
                  <tr>
                    <td width="180" valign="top" align="left"><p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:bold;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:18px; text-align:left;">Name &amp; Surname:<br/>
                    Company:<br/>
                    Contact Number:<br/>
                    Email Address:</p></td>
                    <td width="440" valign="top" align="left"><p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:18px; text-align:left;">'.$_POST['name'].'<br/>
                    '.$_POST['company'].'<br/>
                    '.$_POST['contact'].'<br/>
                    '.$_POST['email'].'</p></td>
                  </tr>
                  <tr>
                    <td colspan="2"><p style="color:#ecba0e;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:45px; text-align:left;">Shipping Address</p></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" valign="top"><p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:16px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0; line-height:18px; text-align:left;">'.nl2br($_POST['message']).'</p></td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
        	<tr>
	            <td width="600" align="left" valign="top" style="padding-top:30px;">
	            	<table width="600" border="0" cellspacing="0" cellpadding="0">
	                  <tr>
	                    <td width="237" align="left" valign="top">&nbsp;</td>
	                    <td width="40" align="center" valign="top">
	                    	<a href="https://www.facebook.com/riaan.manser.1" title="Follow us on Facebook" target="_blank">
	                      	<img src="http://riaanmanser.co.za/includes/pear_mail/process/pages/images/btn_facebook_2x.png" alt="Facebook link" width="23" height="23" style="display:block;" border="none" />
	                      </a>
	                    </td>
	                    <td width="36" align="center" valign="top">
	                    	<a href="http://www.youtube.com/user/RiaanManser" title="Follow us on YouTube" target="_blank">
	                      	<img src="http://riaanmanser.co.za/includes/pear_mail/process/pages/images/btn_youtube_2x.png" alt="YouTube link" width="19" height="23" style="display:block;" border="none" />
	                      </a>
	                    </td>
	                    <td width="50" align="center" valign="top">
	                    	<a href="https://twitter.com/riaanmanser" title="Follow us on Twitter" target="_blank">
	                      	<img src="http://riaanmanser.co.za/includes/pear_mail/process/pages/images/btn_twitter_2x.png" alt="YouTube link" width="33" height="23" style="display:block;" border="none" />
	                      </a>
	                    </td>
	                    <td width="237" align="left" valign="top">&nbsp;</td>
	                  </tr>
	                </table>
	            </td>
          </tr>
          <tr>
            <td width="600" align="center" valign="top">
            <p style="color:#565656;font-family: Arial, Helvetica, sans-serif; font-size:11px;font-weight:normal;margin-left:0;margin-right:0;padding-left:0;padding-right:0;margin-top:30px;margin-bottom:30px;padding-top:0;padding-bottom:0; line-height:18px; text-align:center;"><a href="http://riaanmanser.co.za/pages/doinggood.php" target="_blank" title="View webpage" style="color:#565656; text-decoration:none; margin-left:10px; margin-right:10px; margin-top:0; margin-bottom:0;">Doing Good</a>|<a href="http://riaanmanser.co.za/pages/shop.php" target="_blank" title="View webpage"  style="color:#565656; text-decoration:none; margin-left:10px; margin-right:10px; margin-top:0; margin-bottom:0;">Shop</a>|<a href="http://riaanmanser.co.za/pages/contact.php" target="_blank" title="View webpage" style="color:#565656; text-decoration:none; margin-left:10px; margin-right:10px; margin-top:0; margin-bottom:0;">Get in Touch</a>|<a href="http://riaanmanser.co.za" target="_blank" title="Visit webpage" style="color:#565656; text-decoration:none; margin-left:10px; margin-right:10px; margin-top:0; margin-bottom:0;">www.riaanmanser.com</a><br/>
            Copyright &copy; 2013 Riaan Manser Adventure. Office: +27 (0) 21 820 7373. All rights reserved.</p>
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>
</body>
</html>';
?>
