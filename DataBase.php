<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function save_product_inventory($table, $product_id, $product_name, $product_stocks, $product_price, $product_discount, $product_reorder)
    {
        $product_id = $this->prepareData($product_id);
        $product_name = $this->prepareData($product_name);
        $product_stocks = $this->prepareData($product_stocks);
        $product_price = $this->prepareData($product_price);
        $product_discount = $this->prepareData($product_discount);
        $product_reorder = $this->prepareData($product_reorder);

        //$this->sql = "INSERT INTO " . $table . " (product_id, product_name, unit_in_stock, unit_price, discount_percentage, reorder_level) VALUES 
        //                ('" . $product_id . "','" . $product_name . "','" . $product_stocks . "','" . $product_price . "', '" . $product_discount . "', '" . $product_reorder . "')";

        // $this->sql = "BEGIN IF EXISTS(SELECT * FROM '" . $table . "' WHERE product_id = '" . $product_id . "') THEN UPDATE tblproduct SET product_id = '" . $product_id . "',
        //                 product_name = '" . $product_name . "', unit_in_stock = '" . $product_stocks . "',
        //                 unit_price = '" . $product_price . "', discount_percentage = '" . $product_discount . "',
        //                 reorder_level = '" . $product_reorder . "' WHERE product_id = '" . $product_id . "'; ELSE INSERT INTO '" . $table . "' (product_id,
        //                 product_name, unit_in_stock, unit_price, discount_percentage, reorder_level) VALUES ('" . $product_id . "', '" . $product_name . "',
        //                 '" . $product_stocks . "', '" . $product_price . "', '" . $product_discount . "', '" . $product_reorder . "'); END IF; END";

        $this->sql = "CALL spu_product_inventory('" . $product_id . "','" . $product_name . "','" . $product_stocks . "','" . $product_price . "', '" . $product_discount . "', '" . $product_reorder . "')";

        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

}

?>
