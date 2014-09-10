<?php
require_once "Mail/Queue.php";
// options for storing the messages
// type is the container used, currently there are 'creole', 'db', 'mdb' and 'mdb2' available
$db_options['type']       = 'mdb2';
// the others are the options for the used container
// here are some for db
$db_options['dsn']        = 'mysql://designgu_demo:DesignGuru911@localhost/designgu_young_bafana';
$db_options['mail_table'] = 'mail_queue';
// here are the options for sending the messages themselves
// these are the options needed for the Mail-Class, especially used for Mail::factory()
$mail_options['driver']    = 'mail';
$mail_options['host']      = 'mail.mailguru.co.za';
$mail_options['port']      = 25;
$mail_options['localhost'] = 'localhost'; //optional Mail_smtp parameter
$mail_options['auth']      = true;
$mail_options['username']  = 'secure@mailguru.co.za';
$mail_options['password']  = 'secure';
?> 