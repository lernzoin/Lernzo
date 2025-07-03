<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $otp = rand(100000, 999999); // Generate 6-digit OTP

    $_SESSION['email'] = $email;
    $_SESSION['otp'] = $otp;

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lernzoin@gmail.com';          // 🔁 Replace with your Gmail
        $mail->Password = 'cqahuxrtbavwffkq';             // 🔁 Replace with your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('lernzoin@gmail.com', 'Lernzo');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Lernzo OTP Verification';
        $mail->Body = "Your OTP is: <strong>$otp</strong>";

        $mail->send();
        echo "OTP sent to your email successfully!";
        // Optionally redirect to OTP verification page
        // header('Location: verify_otp.html');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid Request";
}
?>