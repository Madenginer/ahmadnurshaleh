<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Pastikan PHPMailer sudah diinstal via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi server SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'miyoucube.iq@gmail.com'; // Ganti dengan email Anda
        $mail->Password = 'vpip ersa mnom httt'; // Ganti dengan Password Aplikasi Gmail Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengaturan penerima email
        $mail->setFrom('miyoucube.iq@gmail.com', 'Admin'); // Ganti sesuai kebutuhan
        $mail->addAddress('miyoucube.iq@gmail.com'); // Pesan akan dikirim ke email Anda

        // Isi email
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission from $name";
        $mail->Body = "
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        // Kirim email
        $mail->send();

        // Redirect ke halaman Thank You
        header('Location: https://madenginer.github.io/thankyoupage/');
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>