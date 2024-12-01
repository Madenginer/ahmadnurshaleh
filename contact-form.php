<?php
// Memasukkan file PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Jika menggunakan Composer
// Atau gunakan require_once 'path_to_phpmailer/src/PHPMailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $mail = new PHPMailer(true); // Instansiasi PHPMailer

        try {
            // Pengaturan server SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP server Anda
            $mail->SMTPAuth = true;
            $mail->Username = 'miyoucube.iq@gmail.com'; // Ganti dengan email Anda
            $mail->Password = 'yourpassword'; // Ganti dengan password aplikasi
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Penerima dan pengirim
            $mail->setFrom($email, $name);
            $mail->addAddress('miyoucube.iq@gmail.com'); // Ganti dengan alamat tujuan email

            // Konten email
            $mail->isHTML(true);
            $mail->Subject = 'New Message from Contact Form';
            $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message";

            // Mengirim email
            $mail->send();
            header("Location: https://madenginer.github.io/bismillah.github.io/"); // Redirect ke halaman sukses
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Validasi data (optional)
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Pengaturan email
        $to = "miyoucube.iq@gmail.com"; // Ganti dengan alamat email tujuan
        $subject = "New Message from $name";
        $body = "You have received a new message from $name ($email):\n\n$message";
        $headers = "From: $email";

        // Kirim email
        if (mail($to, $subject, $body, $headers)) {
            // Redirect ke halaman "Thank You" setelah berhasil
            header("Location: https://madenginer.github.io/bismillah.github.io/");
            exit();
        } else {
            echo "Sorry, there was an error sending your message. Please try again later.";
        }
    } else {
        echo "All fields are required!";
    }
}
?>