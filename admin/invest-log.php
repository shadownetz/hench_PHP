<?php require_once('joins/header.php'); ?>
<?php require_once('joins/nav.php'); ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Investment History
        </h1>
        <ol class="breadcrumb">
          <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Investment history</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="box">
<?php
$query=User::find_sql("SELECT * FROM investments ORDER BY id DESC");
if($db_init->num_rows($query)>0){
?>
              <div class="box-header">
                <h3 class="box-title">Logs</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <!-- History headings-->
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Amount (<i class="fa fa-usd"></i>)</th>
                      <th>Wallet ID</th>
                      <th>Paid Status</th>
                      <th>TimeStamp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Loop the row-->
    <?php
    $counter=1;
      while($row=$db_init->fetch_array($query)){
        $inv_id = $row['id'];
        $user_id = $row['user_id'];
        $get_user_name_q=User::find_sql("SELECT fname, lname FROM users WHERE id='{$user_id}' LIMIT 1");
          while($col=$db_init->fetch_array($get_user_name_q)){
            $user_full_name=$col['fname']." ".$col['lname'];
          }
        $amount = $row['amount'];
        $wallet_id = $row['wallet_id'];
        $created = $row['created'];
    ?>
                    <!-- First row-->

                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td>
                          <?php echo $user_full_name; ?>
                        </td>
                        <td><?php echo $amount; ?></td>
                        <?php if($row['wallet_id']==""){ ?>
                          <td><span class="label label-warning">not assigned</span></td>
                        <?php }else{ ?>
                          <td><?php echo $wallet_id; ?></td>
                        <?php } ?>
                        <?php if($row['status']==0){ ?>
                          <td><span class="label label-warning">not paid</span></td>
                        <?php }else{ ?>
                          <td><span class="label label-success fa fa-check"> paid</span></td>
                        <?php } ?>
                        <td><?php echo $created; ?></td>
                    </tr>

                    <!-- End of first row-->
    <?php 
    $counter++;
    } 
    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
  <?php 
    }else{
      echo "No investment logs!";
    } 
  ?>


          </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
  <?php require_once('joins/footer.php'); ?>