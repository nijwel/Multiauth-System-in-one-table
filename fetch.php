<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "test");
$output = '';

// $query = "SELECT * FROM item ORDER BY item_id DESC";

$query = "SELECT * FROM item
INNER JOIN order_table ON item.order_id = order_table.id ORDER BY id DESC";

$result = mysqli_query($connect, $query);
$output = '
<br />
<h3 align="center">Item Data</h3>
<table class="table table-bordered table-striped">
 <tr>
  <th width="10%">Date</th>
  <th width="10%">Order No.</th>
  <th width="30%">Customer Name</th>
  <th width="30%">Item Name</th>
  <th width="10%">Item Code</th>
  <th width="50%">Description</th>
  <th width="10%">Price</th>
  <th width="10%">Action</th>
 </tr>
';
while($row = mysqli_fetch_array($result))
{
 $output .= '
 <tr>
  <td>'.$row["order_date"].'</td>
  <td>'.$row["order_number"].'</td>
  <td>'.$row["customer_name"].'</td>
  <td>'.$row["item_name"].'</td>
  <td>'.$row["item_code"].'</td>
  <td>'.$row["item_description"].'</td>
  <td>'.$row["item_price"].'</td>
  <td><button type="button" name="delete" id="id" data-id="'.$row["item_id"].'" class="btn btn-sm btn-danger delete">Delete</button></td>
 </tr>
 ';
}
$output .= '</table>';
echo $output;
?>