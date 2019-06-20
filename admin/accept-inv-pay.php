<?php require_once('joins/header.php'); ?>
<?php require_once('joins/nav.php'); ?>
<?php
if(isset($_POST['activete_inv'])){
    $inv_id=$db_init->escape(htmlentities($_POST['inv_id']));
    $user_id=$db_init->escape(htmlentities($_POST['user_id']));
    $amount=$db_init->escape(htmlentities($_POST['amount']));
    if(!empty($inv_id) && !empty($user_id) && !empty($amount)){
        $update_q=User::find_sql("UPDATE investments SET status=1 WHERE id='{$inv_id}'");
        if($update_q){
            $get_user_info_q=User::find_sql("SELECT * FROM ecnalab WHERE user_id='{$user_id}'");
            if($db_init->num_rows($get_user_info_q)==1){
                while($column=$db_init->fetch_array($get_user_info_q)){
                    $user_balance=$column['ecnalab']+$amount;
                    $credit_q=User::find_sql("UPDATE ecnalab SET ecnalab='{$user_balance}' WHERE user_id='{$user_id}'");
                }
            }elseif($db_init->num_rows($get_user_info_q)==0){
                $credit_q=User::find_sql("INSERT INTO ecnalab SET user_id='{$user_id}', ecnalab='{$amount}', updated=NOW()");
            }
            if($credit_q){
                echo "<script> alert('Updated and Credited Successfully!'); window.location=''; </script>";
            }
        }
    }else{
        echo "<script> alert('Session timeout!'); window.location=''; </script>";
    }
}
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Accept Payment
        </h1>
        <ol class="breadcrumb">
          <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Accept payment</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="box">
<?php
$query=User::find_sql("SELECT * FROM investments WHERE status=0 AND wallet_id!='' ORDER BY id DESC");
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
                      <th>TimeStamp</th>
                      <th>Action</th>
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
                        <td><?php echo $created; ?></td>
                        <form role="form" method="POST" action="">
                        <input type="hidden" name="inv_id" value="<?php echo $inv_id; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                        <td style="text-align:center"><button type="submit" name="activete_inv" class="btn btn-warning btn-block"><i class="fa fa-check"></i> Accept</button></td>
                        </form>
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