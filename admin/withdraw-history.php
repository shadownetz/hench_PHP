<?php require_once('joins/header.php'); ?>
<?php require_once('joins/nav.php'); ?>
<?php
if(isset($_POST['confirm_pay'])){
  $withdrawal_id=$db_init->escape(htmlentities($_POST['withdrawal_id']));
  $user_id= $db_init->escape(htmlentities($_POST['user_id']));
  $user_email= $db_init->escape(htmlentities($_POST['user_email']));
  $dollar_amount= $db_init->escape(htmlentities($_POST['dollar_amount']));
  if(!empty($withdrawal_id) && !empty($user_id) && !empty($dollar_amount)){
    $confirm_payment_q=User::find_sql("UPDATE payments SET status=1, confirmed=NOW() WHERE id='{$withdrawal_id}'");
    if($confirm_payment_q){
      $get_user_info_q=User::find_sql("SELECT * FROM ecnalab WHERE user_id='{$user_id}'");
      if($db_init->num_rows($get_user_info_q)==1){
        while($column=$db_init->fetch_array($get_user_info_q)){
            $user_balance=$column['ecnalab']-$dollar_amount;
            $update_bal_q=User::find_sql("UPDATE ecnalab SET ecnalab='{$user_balance}' WHERE user_id='{$user_id}'");
        }
      }
      //mail
      require '../phpmailer/PHPMailerAutoload.php';

          $mail = new PHPMailer();

          $mail->isSMTP();
          $mail->Host = "smtp.gmail.com";
          $mail->SMTPSecure = "ssl";
          $mail->Port = 465;
          $mail->SMTPAuth = true;
          $username= User::get_email_address(); 
          $pass2=User::get_email_password();
          $mail->Username = $username; 
          $mail->Password = $pass2;
      
          $mail->setFrom(User::get_email_address(), User::get_company_name());
          $mail->addAddress($user_email);
          
          $mail->Subject = 'HENCH PAYMENT NOTIFICATION';
          $mail ->AddEmbeddedImage('../images/hench_logo.jpeg', 'logoimg');
          $mail->MsgHTML(User::send_payment_info($dollar_amount, $user_balance));
          if ($mail->send())
              echo "<script> alert('Transaction successful!'); window.location='withdraw-history.php'; </script>";
    }
  }else{
    echo "<script> alert('Fill in correctly!'); window.location=''; </script>";
  }
}

?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Withdrawal Requests
        </h1>
        <ol class="breadcrumb">
          <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Withdrawal Requests</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="box">
<?php
$query=User::find_sql("SELECT * FROM payments WHERE status=0 ORDER BY id DESC");
if($db_init->num_rows($query)>0){
?>
              <div class="box-header">
                <h3 class="box-title">Logs</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <!-- History headings-->
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Details</th>
                      <th>Type</th>
                      <th>Amount (<i class="fa fa-usd"></i>)</th>
                      <th>TimeStamp</th>
                      <th>Confirm Pay</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Loop the row-->
    <?php
    $counter=1;
      while($row=$db_init->fetch_array($query)){
        $user_id= $row['user_id'];
        $get_user_email_q=User::find_sql("SELECT email, fname, lname FROM users WHERE id='{$user_id}' LIMIT 1");
        if($db_init->num_rows($get_user_email_q)==1){
          while($column=$db_init->fetch_array($get_user_email_q)){
            $user_email=$column['email'];
            $user_full_name=$column['fname']." ".$column['lname'];
          }
        }
        $withdrawal_id = $row['id'];
        $dollar_amount = $row['amount'];
        $bank=$row['bank'];
        $acc_name=$row['acc_name'];
        $acc_number=$row['acc_number'];
        $wallet_id=$row['wallet_id'];
        if($row['payment_type']=='Local Account'){
          $details="
          Bank: $bank<br>
          Acc. Name: $acc_name<br>
          Acc. Number: $acc_number
          ";
        }elseif($row['payment_type']=='Bitcoin'){
          $details="
          Wallet Id: $wallet_id
          ";
        }else{
          $details="";
        }
        $amount = $row['amount'];
        $requested = $row['requested'];
    ?>
                    <!-- First row-->

                    <tr>
                      <form role="form" method="POST" action="">
                        <td><?php echo $counter; ?></td>
                        <td>
                          <?php echo $user_full_name; ?>
                        </td>
                        <td>
                            <p><?php echo $details; ?></p>
                        </td>
                        <td><?php echo $row['payment_type']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['requested']; ?></td>
                        <td style="text-align:center">
                        <input type="hidden" name="withdrawal_id" value="<?php echo $withdrawal_id; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="user_email" value="<?php echo $user_email; ?>">
                        <input type="hidden" name="dollar_amount" value="<?php echo $row['amount']; ?>">
                                <button type="submit" name="confirm_pay" class="btn btn-warning btn-flat btn-block">Confirm</button>
                        </td>
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
      echo "No Withdrawal logs!";
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