<?php
// Include PHPMailer library (if you're not using Composer, point to the correct file location)
require_once 'path/to/PHPMailer/PHPMailerAutoload.php'; // Adjust the path as needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Basic form validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Create PHPMailer instance
    $mail = new $PHPMailer;

    // Set mailer to use SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Use Gmail SMTP or any SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; // Replace with your email address
    $mail->Password = 'your-email-password'; // Use an app-specific password if using Gmail
    $mail->SMTPSecure = $PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Sender's email and name
    $mail->setFrom($email, $name);

    // Recipient's email
    $mail->addAddress('your-email@example.com', 'Your Name'); // Replace with your email

    // Email content
    $mail->isHTML(false); // Set to false if you want plain text
    $mail->Subject = 'New Contact Form Submission: ' . $subject;
    $mail->Body    = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

    // Send the email
    if ($mail->send()) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message: " . $mail->ErrorInfo;
    }
} else {
    echo "Invalid request.";
}
?>
<!-- // In this script, we first include the PHPMailer library using require_once. If you're not using Composer, you'll need to adjust the path to the PHPMailerAutoload.php file. Next, we check if the request method is POST and proceed to retrieve the form data using $_POST. We perform basic form validation to ensure that all required fields are filled and that the email address is in a valid format. We then create an instance of PHPMailer and configure it to use SMTP with the necessary settings (host, username, password, encryption, and port). We set the sender's email and name, add the recipient's email, set the email content (subject and body), and finally send the email. If the email is sent successfully, we display a success message; otherwise, we display an error message along with the error information from PHPMailer. This script can be used to handle contact form submissions and send emails using PHPMailer with SMTP. Make sure to replace the placeholders with your actual email address and password.// Path: php/contact.php
// Compare this snippet from php/server.php: -->