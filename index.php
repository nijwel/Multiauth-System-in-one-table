<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Multiple Inline Insert into Mysql using Ajax JQuery in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
 </head>
 <body>
  <br /><br />
  <div class="container">
   <br />
   <h2 align="center">Multiple Inline Insert into Mysql using Ajax JQuery in PHP</h2>
   <br />
   <div class="table-responsive">
    <h3 align="center">Order Details</h3>
    <table class="table table-bordered" id="crud_table">
        <tr>
           <th colspan="2">Customer Name</th>     
           <th>Order Number</th>     
           <th colspan="2">Order Date</th>         
        </tr>
        <tr>
         <td colspan="2" contenteditable="true" class="customer_name"></td>
         <td contenteditable="true" class="order_number"></td>
         <td colspan="2" contenteditable="true" class="order_date"></td>
        </tr>
    </table>
    <br>
    <h3 align="center">Order Item Details</h3>
    <table class="table table-bordered" id="crud_table_details">
     <tr>
      <th width="30%">Item Name</th>
      <th width="10%">Item Code</th>
      <th width="45%">Description</th>
      <th width="10%">Price</th>
      <th width="5%"></th>
     </tr>
     <tr>
      <td contenteditable="true" class="item_name"></td>
      <td contenteditable="true" class="item_code"></td>
      <td contenteditable="true" class="item_desc"></td>
      <td contenteditable="true" class="item_price"></td>
      <td><button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button></td>
     </tr>
    </table>
    <div align="center">
     <button type="button" name="save" id="save" class="btn btn-info">Save</button>
    </div>
    <br />
    <div id="inserted_item_data"></div>
   </div>
   
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 var count = 1;
 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"'>";
   html_code += "<td contenteditable='true' class='item_name'></td>";
   html_code += "<td contenteditable='true' class='item_code'></td>";
   html_code += "<td contenteditable='true' class='item_desc'></td>";
   html_code += "<td contenteditable='true' class='item_price' ></td>";
   html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
   html_code += "</tr>";  
   $('#crud_table_details').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
 
 $('#save').click(function(){
  var item_name = [];
  var item_code = [];
  var item_desc = [];
  var item_price = [];
  var customer_name = $('.customer_name').text();
  var order_number = $('.order_number').text();
  var order_date = $('.order_date').text();
  $('.item_name').each(function(){
   item_name.push($(this).text());
  });
  $('.item_code').each(function(){
   item_code.push($(this).text());
  });
  $('.item_desc').each(function(){
   item_desc.push($(this).text());
  });
  $('.item_price').each(function(){
   item_price.push($(this).text());
  });
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:{item_name:item_name, item_code:item_code, item_desc:item_desc, item_price:item_price , customer_name:customer_name, order_number:order_number , order_date:order_date },
   success:function(data){
    alert(data);
    var rowCount = $("#crud_table_details tr").length;
    $("td[contentEditable='true']").text("");
    for(var i=2; i<= rowCount; i++)
    {
     $('#row'+i+'').remove();
    }
    fetch_item_data();
   }
  });
 });
 


 $(document).on("click", ".delete", function() { 
        var id = $(this).data('id');
        $.ajax({
            url: "delete.php",
            type: "POST",
            cache: false,
            data:{
                id: id,
            },
            success: function(dataResult){
                alert(dataResult);
                fetch_item_data();
            }
        });
    });

    function fetch_item_data()
    {
     $.ajax({
      url:"fetch.php",
      method:"POST",
      success:function(data)
      {
       $('#inserted_item_data').html(data);
      }
     })
    }
    fetch_item_data();
 
});
</script>