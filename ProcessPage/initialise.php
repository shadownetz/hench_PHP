<?php
$user_id = $session->user_id;
$result = User::get_user_details($user_id);
if ($db_init->num_rows($result)==1) {
    while ($row=$db_init->fetch_array($result)) {
        $ref_id = $row['ref_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $country = $row['country'];
        $zip = $row['zip'];
        $fplan = $row['fplan'];
        $pass = $row['pass'];
        $image = $row['image'];
        $picture = "../images/".$row['image'];
        $status = $row['status'];
        $created = $row['created'];
        $updated = $row['updated'];
        $last_logged = $row['last_logged'];
        $full_name = $fname." ".$lname;

        $date_array=string_to_time($last_logged);
        $ll_date_string = $date_array[0]." | ".$date_array[1];
        $date_array=string_to_time($created);
        $created_date_string = $date_array[0];

    }
}
$check_msgs_q = User::find_sql("SELECT * FROM contact_response WHERE user_id='{$session->user_id}' AND status=0");
$total_msg_counter=0;
if ($db_init->num_rows($check_msgs_q)>0) {
    $total_msg_counter=$db_init->num_rows($check_msgs_q); //HOLDS TOTAL NUMBER OF UNREAD MESSAGES
}
$check_msgs_q = User::find_sql("SELECT * FROM contact_response WHERE user_id='{$session->user_id}' AND status=0 ORDER BY id DESC LIMIT 3 ");
if ($db_init->num_rows($check_msgs_q)>0) {
    while ($row=$db_init->fetch_array($check_msgs_q)) {
        $admin_ids[]=$row['admin_id'];  //HOLDS ARRAY OF ADMIN IDS
        $msgs_ids[]=$row['id'];         //HOLDS ARRAY OF MESSAGES IDS
            $trunc_msg = wordwrap($row['message'], 20, "[{@}]");
            $exp = explode("[{@}]",$trunc_msg);
        $user_unred_msgs_array[]=$exp[0]."..."; //HOLDS ARRAY OF MESSAGES
        $user_unred_created_array[]=$row['created']; //HOLDS ARRAY OF MESSAGES DATES
        $message_validity_array[] = check_date_time_validity($row['created']);  //HOLDS ARRAY OF DATES VALIDITY
    }
}else{
    $admin_ids=array();
}
for($x=0;$x<count($admin_ids);$x++){
    $admin_id = $admin_ids[$x];
    $get_admin_picture_q=User::find_sql("SELECT image FROM admins WHERE id='{$admin_id}'");
    while($row=$db_init->fetch_array($get_admin_picture_q)){
        $admin_profile_pictures[] = "../images/".$row['image'];  //HOLDS ARRAY OF ADMINS PROFILE PICTURES
    }
}
$check_balance_q = User::find_sql("SELECT * FROM ecnalab WHERE user_id='{$session->user_id}' LIMIT 1");
$user_balance='0.00';
if ($db_init->num_rows($check_balance_q)>0) {
    while ($row=$db_init->fetch_array($check_balance_q)) {
        $user_balance=$row['ecnalab'];  //HOLDS USER BALANCE
    }
}
$total_inv_q = User::find_sql("SELECT * FROM investments WHERE user_id='{$session->user_id}'");
$user_total_investments=0;
if ($db_init->num_rows($total_inv_q)>0) {
    $user_total_investments=$db_init->num_rows($total_inv_q); //HOLDS TOTAL NUMBER OF INVESTMENTS
}


?>