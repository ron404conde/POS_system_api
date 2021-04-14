<?php
    
require_once "db_connect.php";
$sql = "select * from tblproductcategory";
if(!$conn->query($sql))
{
    echo "Error in connecting to database";
}
else {
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $return_arr['tblproductcategory'] = array();
        while($row = $result->fetch_array()) {
            array_push($return_arr['tblproductcategory'], array(
                'category_id'=>$row['category_id'],
                'category_name'=>$row['category_name']
            ));
        }
        echo json_encode($return_arr);
    }
}

?>