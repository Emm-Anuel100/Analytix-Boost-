<?php
include './layouts/session.php';
require 'fpdf/fpdf.php';

// Create instance of FPDF
$pdf = new FPDF('P', 'mm', array(58, 100)); // POS paper size (width 58mm, length 100mm)

// Add a new page
$pdf->AddPage();

// Store Information (for simplicity)
$pdf->SetFont('Arial', '', 6);
$pdf->Image('assets/img/store/store-04.png', 2, 2, 10, 10);

// Set Y position to allow space for the image and store details
$pdf->SetY(12);

// Store information
$pdf->SetX(3);
$pdf->Cell(40, 4, 'Grace stores', 0, 1, 'L'); // Store name
$pdf->SetX(3);
$pdf->Cell(40, 4, 'St, Cityville, 101 Ibadan, Nigeria.', 0, 1, 'L'); // Address
$pdf->SetX(3);
$pdf->Cell(40, 4, '+234 456 7890 6765', 0, 1, 'L'); // Phone number

$pdf->Ln(2);

// Title
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(38, 6, 'Product Details', 0, 1, 'C');
$pdf->Ln(1);

// Add table headers
$pdf->SetFont('Arial', 'B', 6);
$pdf->SetX(1.5);
$pdf->Cell(17, 6, 'Product Name', 'TB');
$pdf->Cell(7, 6, 'Qty', 'TB');
$pdf->Cell(12, 6, 'Price', 'TB');
$pdf->Cell(10, 6, 'Tax', 'TB');
$pdf->Cell(9, 6, 'Total', 'TB');
$pdf->Ln();

// Retrieve the products and other data from POST
$productsString = $_POST['products'] ?? '';
$reference = $_POST['reference'] ?? '';
$grandTotal = $_POST['grandTotal'] ?? '';
$changeElement = $_POST['changeElement'] ?? '';
$customer = $_POST['customer'] ?? '';
$paymentBy = $_POST['paymentBy'] ?? '';
$amountPaid = $_POST['amountPaid'] ?? '';
$amountDue = $_POST['amountDue'] ?? '';
$id = $_POST['id'] ?? '';

// Split productsString into individual product entries
$productsArray = explode(";", $productsString);

// Add product data to the table
$pdf->SetFont('Arial', '', 6);
foreach ($productsArray as $product) {
    preg_match('/(.*?)\s\(quantity:\s(\d+),\sprice:\s([\d.]+),\simage:\s.*,\sdiscount\stype:\s.*,\sdiscount\svalue:\s.*,\stax:\s([\d.]+),\sunit:\s.*,\stotal\scost:\s([\d.]+)\)/', $product, $matches);
    if ($matches) {
        $productName = $matches[1];
        $quantity = $matches[2];
        $price = $matches[3];
        $tax = $matches[4];
        $totalCost = $matches[5];

        // Check if adding this row exceeds the page height
        if ($pdf->GetY() + 6 > 100) { // Adjust the height value (100) according to the page height
            $pdf->AddPage(); // Start a new page
            $pdf->SetFont('Arial', 'B', 6);
            // Re-add headers
            $pdf->SetX(1.5);
            $pdf->Cell(17, 6, 'Product Name', 'TB');
            $pdf->Cell(7, 6, 'Qty', 'TB');
            $pdf->Cell(12, 6, 'Price', 'TB');
            $pdf->Cell(10, 6, 'Tax', 'TB');
            $pdf->Cell(9, 6, 'Total', 'TB');
            $pdf->Ln();
        }

        $pdf->SetX(1.7);
        $pdf->Cell(17, 6, $productName, 0);
        $pdf->Cell(7, 6, $quantity, 0);
        $pdf->Cell(12, 6, number_format($price, 2), 0); // Format price
        $pdf->Cell(10, 6, number_format($tax, 2), 0); // Format tax
        $pdf->Cell(9, 6, number_format($totalCost, 2), 0); // Format total cost
        $pdf->Ln();

        // Draw a bottom border for the row
        $pdf->SetX(0);
        $pdf->Cell(58, 0, '', 'T'); // Draw a horizontal line
        $pdf->Ln(); // Add a line break after the border
    }
}

// Add a line break
$pdf->Ln(7);

// Add additional sales details at the bottom
$pdf->SetX(4);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(40, 4, 'Sales Summary', 0, 1, 'L');
$pdf->SetFont('Arial', '', 6);

// Add additional sales details at the bottom
$pdf->SetX(4);
$pdf->Cell(15, 4, 'Reference:', 0, 0);
$pdf->Cell(30, 4, $reference, 0, 1);
$pdf->SetX(4);
$pdf->Cell(15, 4, 'Customer:', 0, 0);
$pdf->Cell(30, 4, $customer, 0, 1);
$pdf->SetX(4);
$pdf->Cell(15, 4, 'Payment By:', 0, 0);
$pdf->Cell(30, 4, $paymentBy, 0, 1);
$pdf->SetX(4);
$pdf->Cell(15, 4, 'Amount Paid:', 0, 0);
$pdf->Cell(30, 4, $amountPaid, 0, 1);
$pdf->SetX(4);
$pdf->Cell(15, 4, 'Amount Due:', 0, 0);
$pdf->Cell(30, 4, $amountDue, 0, 1);
$pdf->SetX(4);
$pdf->Cell(18, 4, 'Change Element:', 0, 0);
$pdf->Cell(30, 4, $changeElement, 0, 1);
$pdf->SetX(4);
$pdf->Cell(15, 4, 'Grand Total:', 0, 0);
$pdf->Cell(30, 4, $grandTotal, 0, 1); // Format grand total

// Add a thank you message
$pdf->Ln(5);
$pdf->SetX(4);
$pdf->Cell(0, 4, 'Thank you for your purchase!', 0, 1, 'L');

// Additional information with line break
$pdf->SetX(4);
$pdf->MultiCell(0, 4, 'Grand Total and Amount are inclusive of Tax and Discount.', 0, 'L');

// Add no refund
$pdf->Ln(2);
$pdf->SetX(4.5);
$pdf->SetFont('Arial', 'B');
$pdf->Cell(0, 4, 'No Refunds, No Returns.', 0, 1, 'L');

// Output the PDF inline (for preview)
$pdf->Output('I', 'product-details.pdf');



