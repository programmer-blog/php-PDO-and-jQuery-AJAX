<?php

require_once('dbconn.php');

$sth = $dbconn->prepare("SELECT `id`, `product_name`, `price`, `category` FROM tbl_products order by id desc");
$sth->execute();
/* Fetch all of rows in the result set */
$result = $sth->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
<style>
.container{
  margin: 20px auto;
}
h2 {
  text-align: center;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

body{
  font-family:Arial, Helvetica, sans-serif;
  font-size:13px;
}
.success, .error{
  border: 1px solid;
  margin: 10px 0px;
  padding:15px 10px 15px 50px;
  background-repeat: no-repeat;
  background-position: 10px center;
}

.success {
  color: #4F8A10;
  background-color: #DFF2BF;
  background-image:url('success.png');
  display: none;
}
.error {
  display: none;
  color: #D8000C;
  background-color: #FFBABA;
  background-image: url('error.png');
}
</style>
</head>
<body>
  <div class="container">
    <h2>Fetch and view records using php PDO methods</h2>
    <div class="success"></div>
    <div class="error"></div>
    <h2>Add / Edit Records</h2>
    <form>
       <table>
        <tr>
          <td colspan="4" style="text-align: center">
            <input type="hidden" id ='prod_id' value='' />
            <input type='text' id='product_name' placeholder='Product' required />&nbsp;&nbsp;
          <input type='text' id='price' placeholder='Price' required />&nbsp;&nbsp;
          <input type='text' id='category' placeholder='Category' required />&nbsp;&nbsp;
          <input type='button' id='saverecords'  value ='Add Records' /></td>
        </tr>
      </table>
    </form>
    <h2>View Records</h2>
    <table>
      <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Action</th>
      </tr>
  <?php
  /* FetchAll foreach with edit and delete using Ajax */
  if($sth->rowCount()):
   foreach($result as $row){ ?>
     <tr>
       <td><?php echo $row['id']; ?></td>
       <td><?php echo $row['product_name']; ?></td>
       <td><?php echo $row['price']; ?></td>
       <td><?php echo $row['category']; ?></td>
       <td><a data-pid = <?php echo $row['id']; ?> class='editbtn' href= 'javascript:void(0)'>Edit</a>&nbsp;|&nbsp;<a class='delbtn' data-pid=<?php echo $row['id']; ?> href='javascript:void(0)'>Delete</a></td>
     </tr>
   <?php }  ?>
  <?php endif;  ?>
  </table>
  </div>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script>
    $(function(){

      /* Delete button ajax call */
      $('.delbtn').on( 'click', function(){
        if(confirm('This action will delete this record. Are you sure?')){
          var pid = $(this).data('pid');
          $.post( "delete_ajax.php", { pid: pid })
          .done(function( data ) {
            if(data > 0){
              $('.success').show(3000).html("Record deleted successfully.").delay(3200).fadeOut(6000);
            }else{
              $('.error').show(3000).html("Record could not be deleted. Please try again.").delay(3200).fadeOut(6000);;
            }
            setTimeout(function(){
                window.location.reload(1);
            }, 5000);
          });
        }
      });

     /* Edit button ajax call */
      $('.editbtn').on( 'click', function(){
          var pid = $(this).data('pid');
          $.get( "getrecord_ajax.php", { id: pid })
            .done(function( product ) {
              data = $.parseJSON(product);

              if(data){
                $('#prod_id').val(data.id);
                $('#product_name').val(data.product_name);
                $('#price').val(data.price);
                $('#category').val(data.category);
                $("#saverecords").val('Save Records');
            }
          });
      });

      /* Edit button ajax call */
       $('#saverecords').on( 'click', function(){
           var prod_id  = $('#prod_id').val();
           var product = $('#product_name').val();
           var price   = $('#price').val();
           var category = $('#category').val();
           if(!product || !price || !category){
             $('.error').show(3000).html("All fields are required.").delay(3200).fadeOut(3000);
           }else{
                if(prod_id){
                var url = 'edit_record_ajax.php';
              }else{
                var url = 'add_records_ajax.php';
              }
                $.post( url, {prod_id:prod_id, product: product, category: category, price: price  })
               .done(function( data ) {
                 if(data > 0){
                   $('.success').show(3000).html("Record saved successfully.").delay(2000).fadeOut(1000);
                 }else{
                   $('.error').show(3000).html("Record could not be saved. Please try again.").delay(2000).fadeOut(1000);
                 }
                 $("#saverecords").val('Add Records');
                 setTimeout(function(){
                     window.location.reload(1);
                 }, 15000);
             });
          }
       });
    });
 </script>
</body>
</html>