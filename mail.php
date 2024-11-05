<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']); // Sanitize and escape user input
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate input (you may add more complex validation as needed)
    if (empty($name) || empty($email) || empty($message)) {
        // Handle empty fields
        echo "Please fill out all fields.";
        exit;
    }

    // Save the feedback to a  file or database (example using a file)
    $feedbackData = "Name: $name\nEmail: $email\nMessage: $message\n\n";
    $file = 'feedback.txt'; // Adjust the file path as needed
    file_put_contents($file, $feedbackData, FILE_APPEND | LOCK_EX);

    // Optionally, you can send an email notification to yourself
    // Example:
    $to = 'your-email@example.com'; // Replace with your email address
    $subject = 'New Feedback Submitted';
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = 'From: webmaster@example.com'; // Replace with your email or use a valid email address

    // Uncomment the following line to send the email (make sure your server is configured for sending emails)
    // mail($to, $subject, $body, $headers);

    // Redirect back to the form with a success message
    header('Location: feedback_form.html?success=true');
    exit;
} else {
    // Redirect back to the form if accessed directly without POST method
    header('Location: feedback_form.html');
    exit;
}
?>