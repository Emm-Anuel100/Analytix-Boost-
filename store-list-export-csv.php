
<?php
require('./layouts/session.php'); 
require('conn.php'); 
// Set the timezone to Africa/Lagos
date_default_timezone_set('Africa/Lagos');

// Establish the connection to the user's database
$conn = connectMainDB();

// Fetch data from the database
$user_email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT store_name, user_name, phone, email, status FROM store WHERE user_email = ?");
$stmt->bind_param('s', $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Prepare CSV filename with timestamp
$timestamp = date('Y-m-d_H-i-s'); // Create timestamp for the filename
$csv_filename = "store-list-{$timestamp}.csv"; // Concatenate filename

// Set headers to force download of the CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $csv_filename . '"');

// Open output stream for CSV
$output = fopen('php://output', 'w');

// Add column headers to CSV
fputcsv($output, ['Store Name', 'User Name', 'Phone', 'Email', 'Status']);

// Add data to CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        htmlspecialchars($row['store_name']),
        htmlspecialchars($row['user_name']),
        htmlspecialchars($row['phone']),
        htmlspecialchars($row['email']),
        htmlspecialchars($row['status']),
    ]);
}

// Close output stream
fclose($output);
exit();
?>
