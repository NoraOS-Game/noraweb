<?php

$to = "mrjosephgaming777@gmail.com";
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$subject = "NoraOS Support Request from $name";

$boundary = md5(time());

$headers = "From: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

$body = "--$boundary\r\n";
$body .= "Content-Type: text/plain; charset=UTF-8\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\n";
$body .= "Name: $name\nEmail: $email\n\nMessage:\n$message\n\n";

if (!empty($_FILES['attachment']['name'])) {
    $file = $_FILES['attachment']['tmp_name'];
    $filename = $_FILES['attachment']['name'];
    $filedata = file_get_contents($file);
    $filedata = chunk_split(base64_encode($filedata));

    $body .= "--$boundary\r\n";
    $body .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
    $body .= "Content-Disposition: attachment; filename=\"$filename\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\n";
    $body .= $filedata . "\r\n";
}

$body .= "--$boundary--";

mail($to, $subject, $body, $headers);

echo "Your support request has been sent successfully!";
?>