<div class="container">
  <h2>Products</h2>          
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($products_list as $products) {
           
            ?>
      <tr>
        <td><?php echo $products['id']; ?></td>
        <td><?php echo $products['title']; ?></td>
        <td><?php echo $products['description']; ?></td>
        <td><img  src="<?php echo base_url('user_guide/_images/mobile.jpg');  ?>" style="height:50px;" /></td>
        <td><?php if($products['status'] == 1) { echo "Active"; } else{ echo "Inactive";} ?></td>
      </tr>
      <?php }  ?>
    </tbody>
  </table>
</div>
