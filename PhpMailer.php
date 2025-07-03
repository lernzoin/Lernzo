<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader OR include PHPMailer manually
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Generate 6-digit OTP
    $otp = rand(100000, 999999);

    // Store OTP in session or DB (optional)
    session_start();
    $_SESSION['otp'] = $otp;

    $mail = new PHPMailer(true);

    try {
        // SMTP setup
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'lernzoin@gmail.com';  // 
        $mail->Password = 'cqahuxrtbavwffkq';    // 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email content
        $mail->setFrom('yourgmail@gmail.com', 'Lernzo');
        $mail->addAddress($email);
        $mail->Subject = 'Your OTP for Lernzo Registration';
        $mail->Body    = "Dear user,\n\nYour OTP is: $otp\n\nThank you,\nLernzo Team";

        $mail->send();
        echo "OTP sent successfully to $email";
    } catch (Exception $e) {
        echo "Failed to send OTP. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>