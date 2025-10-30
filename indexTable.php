<?php
include 'dbConfig.php';

$items = [];
try {
    // SQL Query to fetch all 15 columns
    $stmt = $conn->prepare("SELECT * FROM eserGrocery");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<h2>❌ Database Error:</h2>" . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Refined Grocery Inventory</title>
    <style>
        /* --- General Base Styles --- */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #ffffff;
            color: #202124;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            font-weight: 500;
            color: #1A73E8;
            margin-bottom: 30px;
            font-size: 24px;
        }

        /* --- Table Design (Retained Refinements) --- */
        .data-table {
            width: 95%;
            max-width: 1200px;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 1px solid #dadce0;
            border-radius: 8px;
            overflow: hidden;
        }

        .data-table th {
            background-color: #f1f3f4;
            color: #5f6368;
            padding: 14px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 12px 20px;
            border-bottom: 1px solid #f1f3f4;
            font-size: 14px;
            white-space: nowrap;
        }
        
        .data-table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .data-table tbody tr:hover:not(.details-row) {
            background-color: #e8f0fe;
        }

        .data-table td:nth-child(7),
        .data-table td:nth-child(8) 
        {
            text-align: right;
            font-weight: 500;
        }

        /* --- New/Modified Styles for Details Row and Button --- */
        
        /* Style for the button */
        .details-btn {
            background: none;
            color: #1A73E8; /* Google blue for the link look */
            border: none;
            padding: 0;
            margin-left: 8px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: underline; /* Makes it clearly clickable */
        }
        .details-btn:hover {
            color: #3367d6;
        }

        /* The hidden row that holds the description */
        .details-row {
            display: none; /* Crucial: hides the row by default */
            background-color: #f6f9fc; /* Slightly darker than stripe for visibility */
            transition: all 0.3s ease-in-out; /* Add animation property */
        }
        
        /* The cell within the details row spanning all columns */
        .details-row td {
            padding: 15px 20px 15px 40px; /* Indent the text slightly */
            font-size: 13px;
            font-style: italic;
            color: #5f6368;
            border-bottom: 1px dashed #dadce0; /* Use a dash line for separation */
            white-space: normal; /* Allow notes to wrap */
        }
    </style>
</head>
<body>
    <h2>🛒 Inventory Report: Eser Grocery</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Item Name / Notes</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>UOM</th>
                <th>Retail Price</th>
                <th>Cost Price</th>
                <th>In Stock</th>
                <th>Min Stock</th>
                <th>Supplier ID</th>
                <th>Expiry Date</th>
                <th>Perishable</th>
                <th>Aisle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $index => $item): ?>
                
                <tr id="row-<?= $index ?>">
                    <td><?= htmlspecialchars($item['id']) ?></td>
                    <td><?= htmlspecialchars($item['sku']) ?></td>
                    <td>
                        **<?= htmlspecialchars($item['item_name']) ?>**
                        <button class="details-btn" onclick="toggleDetails(<?= $index ?>)">[Show Notes]</button>
                    </td>
                    <td><?= htmlspecialchars($item['category']) ?></td>
                    <td><?= htmlspecialchars($item['sub_category']) ?></td>
                    <td><?= htmlspecialchars($item['unit_of_measure']) ?></td>
                    <td>$<?= htmlspecialchars(number_format($item['price_retail'], 2)) ?></td>
                    <td>$<?= htmlspecialchars(number_format($item['price_cost'], 2)) ?></td>
                    <td><?= htmlspecialchars($item['quantity_in_stock']) ?></td>
                    <td><?= htmlspecialchars($item['min_stock_level']) ?></td>
                    <td><?= htmlspecialchars($item['supplier_id']) ?></td>
                    <td><?= htmlspecialchars($item['expiration_date']) ?></td>
                    <td><?= htmlspecialchars($item['is_perishable'] ? 'Yes' : 'No') ?></td>
                    <td><?= htmlspecialchars($item['location_aisle']) ?></td>
                </tr>
                
                <tr class="details-row" id="details-<?= $index ?>">
                    <td colspan="14">
                        **Item Notes:** <?= htmlspecialchars($item['notes'] ? $item['notes'] : 'No special notes for this item.') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function toggleDetails(index) {
            const detailsRow = document.getElementById(`details-${index}`);
            const button = document.querySelector(`#row-${index} .details-btn`);
            
            // Simple display toggle logic
            if (detailsRow.style.display === 'table-row') {
                detailsRow.style.display = 'none';
                button.textContent = '[Show Notes]';
            } else {
                detailsRow.style.display = 'table-row';
                button.textContent = '[Hide Notes]';
            }
        }
    </script>
</body>
</html>