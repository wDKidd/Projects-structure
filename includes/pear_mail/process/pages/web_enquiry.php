<?php
ob_start();
include_once('process/skeleton.html');
$mail= ob_get_contents();
ob_clean();

$message = '
<table width="95%" border="0" cellspacing="10" cellpadding="0" style="margin:auto;" align="center">
	<tr valign="top">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#316398;" width="120" valign="top">From:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333333;" valign="top">'.ucwords($_POST['name']).'</td>
	</tr>
	<tr valign="top">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#316398;" width="120" valign="top">Company:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333333;" valign="top">'.ucwords($_POST['cname']).'</td>
	</tr>
	<tr valign="top">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#316398;" width="120" valign="top">Contact Number:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333333;" valign="top">'.$_POST['number'].'</td>
	</tr>
	<tr valign="top">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#316398;" width="120" valign="top">Email Address:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333333;" valign="top">'.$_POST['email'].'</td>
	</tr>
	<tr valign="top">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#316398;" width="120" valign="top">Message:</td>
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333333;" valign="top">'.nl2br($_POST['message']).'</td>
	</tr>
</table>
';

$search=array("[Header]", "[Message]");
$replace=array('<span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333; font-weight:bold;">You have received an enquiry generated from <span style="color:#316398; font-size:18px;">your website:</span></span>', $message);
$sending=str_replace($search,$replace,$mail);
?>