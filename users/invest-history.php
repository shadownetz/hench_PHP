<?php require_once('joins/header.php'); ?>
<?php require_once('joins/nav.php'); ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Transaction History
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Investment History</li>
      </ol>
    </section>
<?php
$query = User::find_sql("SELECT * FROM investments WHERE user_id='{$session->user_id}' ORDER BY id DESC");
$count=1;
if($db_init->num_rows($query)>0){
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">User History</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                      <!-- History headings-->
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Amount (<i class="fa fa-usd"></i>)</th>
                      <th>Bitcoin Equivalent  (<i class="fa fa-btc"></i>)</th>
                      <th>TimeStamp</th>
                      <th>Approved</th>
                    </tr>
                    </thead>
                    <tbody>
                        <!-- Loop the row-->
                        <!-- First row-->                
<?php
  while($row=$db_init->fetch_array($query)){
    $amount = $row['amount'];
    $equivalent_value = $row['equivalent_value'];
    $status = $row['status'];
    $created = $row['created'];
?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $amount; ?></td>
                      <td><?php echo $equivalent_value; ?></td>
                      
                      <td><?php echo $created; ?></td>
                      <td> <i class="<?php if($row['status']==0){ echo 'fa fa-close text-danger'; }else{ echo 'fa fa-check text-success'; } ?>"></i></td>
                    </tr>
<?php
    $count++;
  }
?>
                    <!-- End of first row-->
                    </tbody>
                    
                  </table>
                </div>
                <!-- /.box-body -->
              </div>

        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php 
  }else{
    echo "No Investment made yet!";
  }
?>
    
  </div>
  <!-- /.content-wrapper -->
  <?php require_once('joins/footer.php'); ?>