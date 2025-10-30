<?php
include 'dbConfig.php';

// Insert record
$sql = "INSERT INTO eserGrocery (
        sku, 
        item_name, 
        category, 
        sub_category, 
        unit_of_measure, 
        price_retail, 
        price_cost, 
        quantity_in_stock, 
        min_stock_level, 
        supplier_id, 
        expiration_date, 
        is_perishable, 
        location_aisle, 
        notes
    )
    VALUES (
        'CAN7001',             -- sku
        'Tuna (Canned in Water)', -- item_name
        'Pantry',              -- category
        'Canned Goods',        -- sub_category
        'pc',                  -- unit_of_measure
        2.99,                  -- price_retail (DECIMAL)
        1.50,                  -- price_cost (DECIMAL)
        150,                   -- quantity_in_stock (INT)
        30,                    -- min_stock_level (INT)
        104,                   -- supplier_id (INT)
        '2028-12-31',          -- expiration_date (DATE)
        0,                     -- is_perishable (BOOLEAN: 0=No)
        'Aisle 7',             -- location_aisle
        'Low Mercury, Skipjack'-- notes
    )";
$conn->exec($sql);

echo "Record inserted successfully!";
?>