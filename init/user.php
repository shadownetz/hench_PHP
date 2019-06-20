<?php
require_once("database.php");

class User{
    public $id, $image, $fname, $email, $pass, $phone, $country, $created;
    
    

    public static function find_sql($query=""){
        global $db_init;
        $result_set = $db_init->query($query);
        return $result_set;
    }

    public static function get_email_address(){
        return "akubueaugustuskc@gmail.com";
    }
    public static function get_email_password(){
        return "starkidcoco";
    }
    public static function get_web_addess(){
        return "http://localhost/Hench/";
    }
    public static function get_company_name(){
        return "HENCH CAPITAL";
    }

    public static function create_question($name="",$email="",$subject="",$phone="",$message=""){
        return self::find_sql("INSERT INTO questions SET name='{$name}', email='{$email}', subject='{$subject}', phone='{$phone}', message='{$message}', created=NOW(), status=1");
    }

    public static function currency_converter($from, $to, $amount){
        $api="1624e51bd2836c627954b292c79eee92";
        $string = file_get_contents("http://data.fixer.io/api/latest?access_key=$api&format=1");
        $json = json_decode($string, true);
        
        $i=0;
        foreach ($json['rates'] as $key => $value) {
            $currency[$i]=$key;
            $rate[$i]=$value;
            $i=$i+1;
        }

        for($count=0; $count<count($currency); $count++){
            $from_value = $currency[$count];
            $rate_value = $rate[$count];
            if($from_value==$to){
                $convert_rate = $amount * $rate_value;
                return $rate_value;
            }
        }

        

    }

    public static function check_unassigned_funds_wallet_id(){
        return self::find_sql("SELECT * FROM funds WHERE status=0 AND wallet_id='' ");
    }

    public static function user_view_funds($user_id){
        return self::find_sql("SELECT * FROM funds WHERE user_id='{$user_id}' ");
    }

    public static function user_view_payments($user_id){
        return self::find_sql("SELECT * FROM payments WHERE user_id='{$user_id}' ");
    }
    
    public static function check_assigned_funds_wallet_id_not_active(){
        return self::find_sql("SELECT * FROM funds WHERE status=0 AND wallet_id!='' ");
    }

    public static function set_funds_wallet_id($fund_id, $wallet_id){
        return self::find_sql("UPDATE funds SET wallet_id='{$wallet_id}' WHERE id='{$fund_id}' ");
    }

    public static function activate_fund($fund_id){
        return self::find_sql("UPDATE funds SET status=1 WHERE id='{$fund_id}' ");
    }

    public static function check_equivalent_user_detail($user_id, $val){
        global $db_init;

        $result_set = self::find_sql("SELECT * FROM users WHERE id='{$user_id}'");
        if($db_init->num_rows($result_set)==1){
            while($row=$db_init->fetch_array($result_set)){
                if($val=='fname'){
                    return $row['fname'];

                    }elseif ($val=='lname') {
                        return $row['lname'];
                    }elseif ($val=='full_name') {
                        return $row['fname']." ".$row['lname'];
                    }elseif ($val=='ref_id') {
                        return $row['ref_id'];
                    }elseif ($val=='email') {
                        return $row['email'];
                    }elseif ($val=='phone') {
                        return $row['phone'];
                    }elseif ($val=='country') {
                        return $row['country'];
                    }elseif ($val=='zip') {
                        return $row['zip'];
                    }elseif ($val=='fplan') {
                        return $row['fplan'];
                    }elseif ($val=='image') {
                        return $row['image'];
                    }
                }
        }
    }

    public static function create_fund($user_id, $amount, $fund_type, $equivalent_value){
        return self::find_sql("INSERT INTO funds SET user_id='{$user_id}', amount='{$amount}', fund_type='{$fund_type}', equivalent_value='{$equivalent_value}', created=NOW() ");
    }
    
    public static function generate_hash($unique=0){

        $current_year = date('Y'); $current_month = date('m'); $current_day = date('d'); $current_hour = date('H'); $current_min = date('i'); $current_sec = date('s');
        $spliter = str_split($unique);
        $alpha = $spliter[0].$spliter[1].$spliter[2];
        $delta = $spliter[3].$spliter[4].$spliter[5];
        $zigma = $spliter[6].$spliter[7];
        $identify = 'HENCH-'.$current_day.'-'.$current_month.'-'.$current_year.'-'.$current_hour.'-'.$alpha.'-'.$current_min.'-'.$delta.'-'.$current_sec.'-'.$zigma;
        return $identify;
    }

    public function forgotten_password_message($ref_id="", $email=""){
        $identify = self::generate_hash($ref_id);
		$message = '
        <img src="cid:logoimg" width="182" height="182"><br>
        <h1><b>HENCH CAPITAL</b></h1>
        '.'

        <p>Please click this link to set new password:</p>
        '
        .self::get_web_addess().'repass.php?recorver='.$identify.''.'<br>
        '.'

        <p>Please click this link to visit our site for help:</p>
        '.
        self::get_web_addess().'
		'; // Our message above including the link

		return $message;
    }

    public function completed_forgotten_password_message($ref_id="", $pass="", $email=""){

		$message = '
        <img src="cid:logoimg" width="182" height="182"><br>
        <h1><b>HENCH CAPITAL</b></h1>
        '.'

        <p>Your account has been updated, your login credentials  are below.</p>
        '.'

        ------------------------'.'<br><b>
        Email Address: '.$email.''.'<br>
        Ref Id: '.$ref_id.''.'<br>
        New Password: '.$pass.''.'</b><br>
        ------------------------
        '.'

        <p>Please click this link to visit our site for help:</p>
        '.
        self::get_web_addess().'
        '; // Our message above including the link

        return $message;
    }

    public function verification_mail_message($ref_id, $pass, $email){

        $identify = self::generate_hash($ref_id);
        $message = '
        <img src="cid:logoimg" width="182" height="182"><br>
        <h1><b>HENCH CAPITAL</b></h1>
        '.'

        <p>Your account has been created, your login credentials  are below.</p>
        '.'

        ------------------------<br>'.'<p>
        <b>Email Address: '.$email.''.'<br>
        Ref Id: '.$ref_id.''.'<br>
        Password: '.$pass.''.'</b></p>
        ------------------------<br>
        '.'

        <p>Please click this link to confirm your registration:<br>
        '
        .self::get_web_addess().'?confirm='.$identify.''.'
        '.'</p>
        <p>
        Do not comfirm if you are not aware of this account.'.'
        Visit us anytime and notify us about your problem with this link:<br>
        '.
        self::get_web_addess().''.
        '</p>Kindly bear with us.
        '; // Our message above including the link

        return $message;
    }

    public function send_wallet_id($dollar_amount="", $bitcoin_amount="", $wallet_id=""){
        $message = "
        <img src='cid:logoimg' width='182' height='182'><br>
        <h1><b>HENCH CAPITAL</b></h1> <br>
        "."

        <p>Use this wallet id to make your payment, it expires after 24hours.</p><br>
        "."

        <p>------------------------</p>"."
        <p><b>Wallet Id: ".$wallet_id ."<br>
        Bitcoin Amount: ".$bitcoin_amount ."<br>
        Dollar Amount: ".$dollar_amount ."</b></p>
        <p>------------------------</p> 
        "."

        "; // Our message above including the link

        return $message;
    }

    public function send_payment_info($dollar_amount="", $user_balance=""){
        $message = '
        <img src="cid:logoimg" width="182" height="182"><br>
        <h1>HENCH CAPITAL</h1>
        '.'

        <p>Your withdrawal request has been completed successfully!</p>
        <p>The details of the transaction are below:</p>
        '.'

        ------------------------'.'<br><b>
        Amount Credited: '.$dollar_amount.''.'<br>
        Hench Balance: '.$user_balance.''.'</b><br>
        ------------------------
        '.'

        '; // Our message above including the link

        return $message;
    }

    public function account_update($email){
        $message = '
        <img src="cid:logoimg" width="182" height="182"><br>
        <h1>HENCH CAPITAL</h1>
        '.'

        <p>Your account has been updated successfully, your login credentials  are below.</p>
        '.'

        ------------------------'.'<br><b>
        Email Address: '.$email.''.'</b><br>
        ------------------------
        '.'

        '; // Our message above including the link

        return $message;
    }
    
    public static function randomise(){
        $array_in = array();
        $count = 1;
        while($count <= 9){
            $unique = uniqid('', true);
            $exp = explode('.', $unique);
            $end = end($exp);
            $split = str_split($end);
            $x=0;
            while($x<count($split)){
                $array_out = array();
                if(!in_array($split[$x], $array_in) && $split[$x]!=0){
                    $array_in[] = $split[$x];
                }
            $x++;
            }
            $count = count($array_in);
            if($count==9){
                $y=0;
                $array_in[] = 20;
                while($y<9){
                    $array_in[] = "1".$array_in[$y];
                $y++;
                }
                $array_in[] = 10;
            }
        }
        $z=0;
        while($z <= 9){
            $array_out[] = $array_in[$z];
        $z += 2;
        }
        $z=11;
        while($z <= 19){
            $array_out[] = $array_in[$z];
        $z += 2;
        }
        return $array_out;
    }

    public static function get_user_details($user_id){
        return self::find_sql("SELECT * FROM users WHERE id='{$user_id}'");
    }
    public static function get_admin_details($user_id){
        return self::find_sql("SELECT * FROM admins WHERE id='{$user_id}'");
    }

    // public static function user_details($user_id){
    //     global $db_init;
    //     $result = $db_init->query("SELECT * FROM users WHERE id='{$user_id}' LIMIT 1");
    //     return $result;
    // }

    public static function confirm_email_users($email=""){
        global $db_init;
        $query = "SELECT * FROM users WHERE email='{$email}'";
        $result = $db_init->query($query);
        return $result;
    }
    public static function confirm_email_admins($email=""){
        global $db_init;
        $query = "SELECT * FROM admins WHERE email='{$email}'";
        $result = $db_init->query($query);
        return $result;
    }

    // public static function confirm_ref_id($ref_id=""){
    //     global $db_init;
    //     $query = "SELECT * FROM users WHERE ref_id='{$ref_id}'";
    //     $result = $db_init->query($query);
    //     return $result;
    // }

    public static function register_user($ref_id="", $fname="", $lname="", $email="", $phone="", $country="", $pass="", $zip=""){
        global $db_init;
        $epass = md5($pass);
        
        $query = "INSERT INTO users SET status='0', created=NOW(), updated=NOW(), last_logged=NOW(), ref_id='{$ref_id}', fname='{$fname}', lname='{$lname}', email='{$email}', phone='{$phone}', country='{$country}', pass='{$epass}', zip='{$zip}', image='default.jpg'";
        return $result_set = self::find_sql($query);
    }

    public static function update_user($fname="", $lname="", $email="", $phone="", $country="", $zip="", $user_id=0){
        
        $query = "UPDATE users SET updated=NOW(), fname='{$fname}', lname='{$lname}', email='{$email}', phone='{$phone}', country='{$country}', zip='{$zip}' WHERE id='{$user_id}'";
        return $result_set = self::find_sql($query);
    }

    public static function update_admin($fname="", $lname="", $email="", $phone="", $country="", $zip="", $user_id=0){
        
        $query = "UPDATE users SET updated=NOW(), fname='{$fname}', lname='{$lname}', email='{$email}', phone='{$phone}', country='{$country}', zip='{$zip}' WHERE id='{$user_id}'";
        return $result_set = self::find_sql($query);
    }

    public static function login_user($email="", $pass=""){
        global $db_init;
        $query = "SELECT * FROM users WHERE email='{$email}' AND pass='{$pass}' LIMIT 1";
        return $result_set = self::find_sql($query);
    }

    public static function login_admin($email="", $pass=""){
        global $db_init;
        $query = "SELECT * FROM admins WHERE email='{$email}' AND pass='{$pass}' LIMIT 1";
        return $result_set = self::find_sql($query);
    }

    public static function redirect_to($page=""){
        return header("Location: $page");
    }

}

?>