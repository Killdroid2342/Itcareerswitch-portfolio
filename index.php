<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

$toEmail = 'haroonkhanemail1@gmail.com';


$name = htmlspecialchars($_POST['name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$message = htmlspecialchars($_POST['message'] ?? '');


if (!$name || !$email || !$message) {
    die('Invalid input.');
}

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';             
    $mail->SMTPAuth = true;
    $mail->Username = 'haroonkhanemail1@gmail.com';   
    $mail->Password = 'kavf ygxr azqm lupn';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($email, $name);
    $mail->addAddress($toEmail);
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Message from $name";
    $mail->Body = "
    <div style='font-family: Arial, sans-serif; color: #333; padding: 20px; border: 1px solid #e0e0e0; border-radius: 8px;'>
        <h2 style='color: #007bff;'>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> <a href='mailto:{$email}'>{$email}</a></p>
        <p><strong>Message:</strong></p>
        <div style='background-color: #f9f9f9; padding: 15px; border-left: 4px solid #007bff; margin-top: 5px; white-space: pre-wrap;'>
            " . nl2br($message) . "
        </div>
    </div>
";


    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
