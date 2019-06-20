<?php require_once('joins/header.php'); ?>
<?php
if(isset($_POST['invest'])){
  if(!empty($_POST['amount']) && !is_double($_POST['amount'])){
    $api="1624e51bd2836c627954b292c79eee92";
    $string = file_get_contents("http://data.fixer.io/api/latest?access_key=$api&format=1");
    $json = json_decode($string, true);

    $i=0;
    foreach ($json['rates'] as $key => $value) {
        $currency[$i]=$key;
        $rate[$i]=$value;
        $i=$i+1;
    }
    for($i=0;$i<count($rate);$i++){
        if($currency[$i]=='USD'){
          $from_key=$i;
        }
    }
    for($i=0;$i<count($rate);$i++){
        if($currency[$i]=='BTC'){
          $to_key=$i;
        }
    }
    $amount = $db_init->escape(htmlentities($_POST['amount']));
    $from=$from_key;
    $to= $to_key;
    $combine=array_combine($currency, $rate);
    $from_currency=$rate[$from];
    $to_currency=$rate[$to];
    $result=$to_currency/$from_currency;
    $resultrev=$from_currency/$to_currency;

    $output = $result*$amount;
    $reverse= $resultrev*$amount;

    $equivalent_value = $output;
    $invest_q = User::find_sql("INSERT INTO investments SET user_id='{$session->user_id}', invest_type='Bitcoin', amount='{$amount}', equivalent_value='{$equivalent_value}', created=NOW()");
    if($invest_q){
      echo "<script> window.location='confirm-invest.php'; </script>";
    }
  }else{
    echo "<script> alert('Fill in correctly!'); window.location='index.php'; </script>";
  }
}
?>
<?php require_once('joins/nav.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Make New Investment
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New investment</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enter desired amount</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Amount &nbsp;(    <i class="fa fa-usd"></i>)</label>
                  <input name="amount" type="number" class="form-control" placeholder="Enter amount">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="invest" class="btn btn-primary">Proceed</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Bitcoin Converter</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <coingecko-coin-converter-widget  coin-id="bitcoin" currency="usd" background-color="#ffffff" font-color="#4c4c4c" locale="en"></coingecko-coin-converter-widget>
              </div>
              <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once('joins/footer.php'); ?>