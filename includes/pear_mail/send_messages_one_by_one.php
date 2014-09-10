<?php
// set the internal buffer size according your
// memory resources (the number indicates how
// many emails can stay in the buffer at any
// given time)

$mail_queue->setBufferSize(20);

//set the queue size (i.e. the number of mails to send)
$limit = 50;
$mail_queue->container->setOption($limit);

// loop through the stored emails and send them
while ($mail = $mail_queue->get()) {
    $result = $mail_queue->sendMail($mail);
}
?> 