<?php
require "DataBase.php";
$db = new DataBase();

if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_stocks']) && isset($_POST['product_price']) && isset($_POST['product_discount']) && isset($_POST['product_reorder']))
{
    if ($db->dbConnect())
    {
        if ($db->save_product_inventory("tblproduct", $_POST['product_id'], $_POST['product_name'], $_POST['product_stocks'], $_POST['product_price'], $_POST['product_discount'], $_POST['product_reorder']))
        {
            echo "Save success";
        } else echo "Save Failed";

    } else echo "Error: Database connection";

} else echo "All fields are required";

?>