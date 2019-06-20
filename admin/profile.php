<?php require_once('joins/header.php'); ?>
<style>
  #user-upload-img{
    position: absolute;
    width:100%;
    height:100%;
    transition: all .3s linear;
    border-radius: 50%;
  }
  #user-upload-img > .img-txt{
      display:block;
      text-align:center;
      padding-top:40%;
  }
  #user-upload-img:hover{
    cursor: pointer;
    background:rgba(0,0,0,.5);
  }
  #img-upload{
    visibility: hidden;
    width:100%;
    height:100%;
  }
</style>
<?php require_once('joins/nav.php'); ?>
<?php
if(isset($_POST['update_profile'])){
  //SETTING ALL THE VALUES TO A VARIABLE
  $ref_id = $ref_id;
  $fname = $db_init->escape(htmlentities($_POST ['fname']));
  $lname = $db_init->escape(htmlentities($_POST ['lname']));
  $email = $db_init->escape(htmlentities($_POST ['email']));
  $phone = $db_init->escape(htmlentities($_POST ['phone']));
  $country = $db_init->escape(htmlentities($_POST ['country']));
  $zip = $db_init->escape(htmlentities($_POST ['zip']));
  $fileName = $_FILES['file']['name'];

  //CHECKING IF EMAIL ALREADY REGISTERED
//   $confirm_email = User::confirm_email_users($email);
//   if($db_init->num_rows($confirm_email)>0){
//       //MAKE PUP UP
//       echo "<script> alert('Emal already exists!'); window.location='profile.php'; </script>";
//       die();
//   }
//   $confirm_email = User::confirm_email_admins($email);
//   if($db_init->num_rows($confirm_email)>0){
//       //MAKE PUP UP
//       echo "<script> alert('Emal already exists!'); window.location='profile.php'; </script>";
//       die();
//   }

  //CHECKING IF ALL FIELDS ARE FILLED OUT
//   if(empty($fname) ||  empty($lname) || empty($phone) || empty($email) || empty($country) || empty($zip)){
//       //MAKE PUP UP
//       echo "<script> alert('All fields must be filled!'); window.location='profile.php'; </script>";
//       die();
//   }else{
      //REGISTERS USER IF EVERY THING IS CORRECT
      //image validation
    if(!empty($fileName)){
        $fileType = $_FILES['file']['type'];
                    $fileExt = explode('.',$fileName);
                        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpeg','jpg','png');
        if (!in_array($fileActualExt, $allowed)){
            echo "<script> alert('File Type Not Allowed!'); window.location='profile.php'; </script>";
            die();
        }else{
            $picture = $db_init->escape(htmlentities($_FILES['file']['name']));
            $epicture = explode(".", $picture);
            $img_type = end($epicture);
            
            $current_year = date('Y'); $current_month = date('m'); $current_day = date('d'); $current_hour = date('H'); $current_min = date('i'); $current_sec = date('s');
            if(strlen($current_month)==1){
                $current_new_month = '0'.$current_month;
            }else{
                $current_new_month = $current_month;
            }

            $generate = uniqid('', true);
            $explode = explode('.', $generate);
            $array1 = $explode[0];
            $array2 = $explode[1];
            $img_initial = "IMG-".$current_year.$current_new_month.$current_day.$current_hour.$current_min.$current_sec."-";
            $main_picture = $img_initial.$array2.".".$img_type;
            $update = User::find_sql("UPDATE admins SET image='$main_picture' WHERE id='$session->user_id'");
            if($update){
                move_uploaded_file($_FILES["file"]["tmp_name"],"../images/".$main_picture);
            }
        }
    }
      $update_user = User::update_admin($fname, $lname, $email, $phone, $country, $zip, $session->user_id);

      if($update_user){
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
          $mail->addAddress($email);
          
          $mail->Subject = 'ACCOUNT UPDATE';
          $mail->Body = User::account_update($email);
          if ($mail->send())
              echo "<script> alert('Account update successful!'); window.location='index.php'; </script>";
      //}
  }
}
?>
  <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header" style="text-align:center">
                <h1>
                    Hench | Profile
                </h1>
                <ol class="breadcrumb">
                    <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Profile</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8 col-md-offset-2">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Admin Profile</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST" action="">
                                <div class="box-body">
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-blue-active">
                                            <h3 class="widget-user-username"><?php echo $full_name; ?></h3>
                                        </div>
                                        <div class="widget-user-image">
                                          <label id="user-upload-img">
                                          <span class="img-txt">Change</span>
                                            <input type="file" id="img-upload">
                                          </label>
                                            <img class="img-circle" id="user-img"  src="<?php echo $picture ?>"
                                                alt="User Avatar" style="width:90px;height:90px">
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header"><?php echo $created_date_string; ?></h5>
                                                        <span class="description-text">Joined</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Active</h5>
                                                        <span class="description-text">Administrator</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Admin</h5>
                                                        <span class="description-text">Status</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname"><i class="fa fa-user-circle"></i> First Name </label>
                                        <input type="text" class="form-control" placeholder="First Name" name='fname' value="<?php echo $fname; ?>">
                                    </div>
                                    <div class="form-group">
                                            <label for="fname"><i class="fa fa-user-circle"></i> Last Name </label>
                                            <input type="text" class="form-control" placeholder="Last Name" name='lname' value="<?php echo $lname; ?>">
                                        </div>
                                        <div class="form-group">
                                                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                                <input type="email" class="form-control" placeholder="email" name='email' value="<?php echo $email; ?>">
                                            </div>
                                            <div class="form-group">
                                                    <label for="pnumber"><i class="fa fa-phone-square"></i> Phone Number</label>
                                                    <input type="text" class="form-control" placeholder="Phone" name='phone' value="<?php echo $phone; ?>">
                                                </div>
                                                <div class="form-group">
                                                        <label for="location"><i class="fa fa-globe"></i> Country</label>
                                                        <select name="country" class="form-control">
                                                                <option value="<?php echo $country; ?>"><?php if($country=='NG'){ echo 'Nigeria'; }else{ echo $country; } ?></option>
                                                                <option value="AF">Afghanistan</option>
                                                                <option value="AX">Åland Islands</option>
                                                                <option value="AL">Albania</option>
                                                                <option value="DZ">Algeria</option>
                                                                <option value="AS">American Samoa</option>
                                                                <option value="AD">Andorra</option>
                                                                <option value="AO">Angola</option>
                                                                <option value="AI">Anguilla</option>
                                                                <option value="AQ">Antarctica</option>
                                                                <option value="AG">Antigua and Barbuda</option>
                                                                <option value="AR">Argentina</option>
                                                                <option value="AM">Armenia</option>
                                                                <option value="AW">Aruba</option>
                                                                <option value="AU">Australia</option>
                                                                <option value="AT">Austria</option>
                                                                <option value="AZ">Azerbaijan</option>
                                                                <option value="BS">Bahamas</option>
                                                                <option value="BH">Bahrain</option>
                                                                <option value="BD">Bangladesh</option>
                                                                <option value="BB">Barbados</option>
                                                                <option value="BY">Belarus</option>
                                                                <option value="BE">Belgium</option>
                                                                <option value="BZ">Belize</option>
                                                                <option value="BJ">Benin</option>
                                                                <option value="BM">Bermuda</option>
                                                                <option value="BT">Bhutan</option>
                                                                <option value="BO">Bolivia, Plurinational State of</option>
                                                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                                <option value="BA">Bosnia and Herzegovina</option>
                                                                <option value="BW">Botswana</option>
                                                                <option value="BV">Bouvet Island</option>
                                                                <option value="BR">Brazil</option>
                                                                <option value="IO">British Indian Ocean Territory</option>
                                                                <option value="BN">Brunei Darussalam</option>
                                                                <option value="BG">Bulgaria</option>
                                                                <option value="BF">Burkina Faso</option>
                                                                <option value="BI">Burundi</option>
                                                                <option value="KH">Cambodia</option>
                                                                <option value="CM">Cameroon</option>
                                                                <option value="CA">Canada</option>
                                                                <option value="CV">Cape Verde</option>
                                                                <option value="KY">Cayman Islands</option>
                                                                <option value="CF">Central African Republic</option>
                                                                <option value="TD">Chad</option>
                                                                <option value="CL">Chile</option>
                                                                <option value="CN">China</option>
                                                                <option value="CX">Christmas Island</option>
                                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                                <option value="CO">Colombia</option>
                                                                <option value="KM">Comoros</option>
                                                                <option value="CG">Congo</option>
                                                                <option value="CD">Congo, the Democratic Republic of the</option>
                                                                <option value="CK">Cook Islands</option>
                                                                <option value="CR">Costa Rica</option>
                                                                <option value="CI">Côte d'Ivoire</option>
                                                                <option value="HR">Croatia</option>
                                                                <option value="CU">Cuba</option>
                                                                <option value="CW">Curaçao</option>
                                                                <option value="CY">Cyprus</option>
                                                                <option value="CZ">Czech Republic</option>
                                                                <option value="DK">Denmark</option>
                                                                <option value="DJ">Djibouti</option>
                                                                <option value="DM">Dominica</option>
                                                                <option value="DO">Dominican Republic</option>
                                                                <option value="EC">Ecuador</option>
                                                                <option value="EG">Egypt</option>
                                                                <option value="SV">El Salvador</option>
                                                                <option value="GQ">Equatorial Guinea</option>
                                                                <option value="ER">Eritrea</option>
                                                                <option value="EE">Estonia</option>
                                                                <option value="ET">Ethiopia</option>
                                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                                <option value="FO">Faroe Islands</option>
                                                                <option value="FJ">Fiji</option>
                                                                <option value="FI">Finland</option>
                                                                <option value="FR">France</option>
                                                                <option value="GF">French Guiana</option>
                                                                <option value="PF">French Polynesia</option>
                                                                <option value="TF">French Southern Territories</option>
                                                                <option value="GA">Gabon</option>
                                                                <option value="GM">Gambia</option>
                                                                <option value="GE">Georgia</option>
                                                                <option value="DE">Germany</option>
                                                                <option value="GH">Ghana</option>
                                                                <option value="GI">Gibraltar</option>
                                                                <option value="GR">Greece</option>
                                                                <option value="GL">Greenland</option>
                                                                <option value="GD">Grenada</option>
                                                                <option value="GP">Guadeloupe</option>
                                                                <option value="GU">Guam</option>
                                                                <option value="GT">Guatemala</option>
                                                                <option value="GG">Guernsey</option>
                                                                <option value="GN">Guinea</option>
                                                                <option value="GW">Guinea-Bissau</option>
                                                                <option value="GY">Guyana</option>
                                                                <option value="HT">Haiti</option>
                                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                                <option value="VA">Holy See (Vatican City State)</option>
                                                                <option value="HN">Honduras</option>
                                                                <option value="HK">Hong Kong</option>
                                                                <option value="HU">Hungary</option>
                                                                <option value="IS">Iceland</option>
                                                                <option value="IN">India</option>
                                                                <option value="ID">Indonesia</option>
                                                                <option value="IR">Iran, Islamic Republic of</option>
                                                                <option value="IQ">Iraq</option>
                                                                <option value="IE">Ireland</option>
                                                                <option value="IM">Isle of Man</option>
                                                                <option value="IL">Israel</option>
                                                                <option value="IT">Italy</option>
                                                                <option value="JM">Jamaica</option>
                                                                <option value="JP">Japan</option>
                                                                <option value="JE">Jersey</option>
                                                                <option value="JO">Jordan</option>
                                                                <option value="KZ">Kazakhstan</option>
                                                                <option value="KE">Kenya</option>
                                                                <option value="KI">Kiribati</option>
                                                                <option value="KP">Korea, Democratic People's Republic of</option>
                                                                <option value="KR">Korea, Republic of</option>
                                                                <option value="KW">Kuwait</option>
                                                                <option value="KG">Kyrgyzstan</option>
                                                                <option value="LA">Lao People's Democratic Republic</option>
                                                                <option value="LV">Latvia</option>
                                                                <option value="LB">Lebanon</option>
                                                                <option value="LS">Lesotho</option>
                                                                <option value="LR">Liberia</option>
                                                                <option value="LY">Libya</option>
                                                                <option value="LI">Liechtenstein</option>
                                                                <option value="LT">Lithuania</option>
                                                                <option value="LU">Luxembourg</option>
                                                                <option value="MO">Macao</option>
                                                                <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                                <option value="MG">Madagascar</option>
                                                                <option value="MW">Malawi</option>
                                                                <option value="MY">Malaysia</option>
                                                                <option value="MV">Maldives</option>
                                                                <option value="ML">Mali</option>
                                                                <option value="MT">Malta</option>
                                                                <option value="MH">Marshall Islands</option>
                                                                <option value="MQ">Martinique</option>
                                                                <option value="MR">Mauritania</option>
                                                                <option value="MU">Mauritius</option>
                                                                <option value="YT">Mayotte</option>
                                                                <option value="MX">Mexico</option>
                                                                <option value="FM">Micronesia, Federated States of</option>
                                                                <option value="MD">Moldova, Republic of</option>
                                                                <option value="MC">Monaco</option>
                                                                <option value="MN">Mongolia</option>
                                                                <option value="ME">Montenegro</option>
                                                                <option value="MS">Montserrat</option>
                                                                <option value="MA">Morocco</option>
                                                                <option value="MZ">Mozambique</option>
                                                                <option value="MM">Myanmar</option>
                                                                <option value="NA">Namibia</option>
                                                                <option value="NR">Nauru</option>
                                                                <option value="NP">Nepal</option>
                                                                <option value="NL">Netherlands</option>
                                                                <option value="NC">New Caledonia</option>
                                                                <option value="NZ">New Zealand</option>
                                                                <option value="NI">Nicaragua</option>
                                                                <option value="NE">Niger</option>
                                                                <option value="NG">Nigeria</option>
                                                                <option value="NU">Niue</option>
                                                                <option value="NF">Norfolk Island</option>
                                                                <option value="MP">Northern Mariana Islands</option>
                                                                <option value="NO">Norway</option>
                                                                <option value="OM">Oman</option>
                                                                <option value="PK">Pakistan</option>
                                                                <option value="PW">Palau</option>
                                                                <option value="PS">Palestinian Territory, Occupied</option>
                                                                <option value="PA">Panama</option>
                                                                <option value="PG">Papua New Guinea</option>
                                                                <option value="PY">Paraguay</option>
                                                                <option value="PE">Peru</option>
                                                                <option value="PH">Philippines</option>
                                                                <option value="PN">Pitcairn</option>
                                                                <option value="PL">Poland</option>
                                                                <option value="PT">Portugal</option>
                                                                <option value="PR">Puerto Rico</option>
                                                                <option value="QA">Qatar</option>
                                                                <option value="RE">Réunion</option>
                                                                <option value="RO">Romania</option>
                                                                <option value="RU">Russian Federation</option>
                                                                <option value="RW">Rwanda</option>
                                                                <option value="BL">Saint Barthélemy</option>
                                                                <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                                <option value="KN">Saint Kitts and Nevis</option>
                                                                <option value="LC">Saint Lucia</option>
                                                                <option value="MF">Saint Martin (French part)</option>
                                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                                <option value="WS">Samoa</option>
                                                                <option value="SM">San Marino</option>
                                                                <option value="ST">Sao Tome and Principe</option>
                                                                <option value="SA">Saudi Arabia</option>
                                                                <option value="SN">Senegal</option>
                                                                <option value="RS">Serbia</option>
                                                                <option value="SC">Seychelles</option>
                                                                <option value="SL">Sierra Leone</option>
                                                                <option value="SG">Singapore</option>
                                                                <option value="SX">Sint Maarten (Dutch part)</option>
                                                                <option value="SK">Slovakia</option>
                                                                <option value="SI">Slovenia</option>
                                                                <option value="SB">Solomon Islands</option>
                                                                <option value="SO">Somalia</option>
                                                                <option value="ZA">South Africa</option>
                                                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                                <option value="SS">South Sudan</option>
                                                                <option value="ES">Spain</option>
                                                                <option value="LK">Sri Lanka</option>
                                                                <option value="SD">Sudan</option>
                                                                <option value="SR">Suriname</option>
                                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                                <option value="SZ">Swaziland</option>
                                                                <option value="SE">Sweden</option>
                                                                <option value="CH">Switzerland</option>
                                                                <option value="SY">Syrian Arab Republic</option>
                                                                <option value="TW">Taiwan, Province of China</option>
                                                                <option value="TJ">Tajikistan</option>
                                                                <option value="TZ">Tanzania, United Republic of</option>
                                                                <option value="TH">Thailand</option>
                                                                <option value="TL">Timor-Leste</option>
                                                                <option value="TG">Togo</option>
                                                                <option value="TK">Tokelau</option>
                                                                <option value="TO">Tonga</option>
                                                                <option value="TT">Trinidad and Tobago</option>
                                                                <option value="TN">Tunisia</option>
                                                                <option value="TR">Turkey</option>
                                                                <option value="TM">Turkmenistan</option>
                                                                <option value="TC">Turks and Caicos Islands</option>
                                                                <option value="TV">Tuvalu</option>
                                                                <option value="UG">Uganda</option>
                                                                <option value="UA">Ukraine</option>
                                                                <option value="AE">United Arab Emirates</option>
                                                                <option value="GB">United Kingdom</option>
                                                                <option value="US">United States</option>
                                                                <option value="UM">United States Minor Outlying Islands</option>
                                                                <option value="UY">Uruguay</option>
                                                                <option value="UZ">Uzbekistan</option>
                                                                <option value="VU">Vanuatu</option>
                                                                <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                                <option value="VN">Viet Nam</option>
                                                                <option value="VG">Virgin Islands, British</option>
                                                                <option value="VI">Virgin Islands, U.S.</option>
                                                                <option value="WF">Wallis and Futuna</option>
                                                                <option value="EH">Western Sahara</option>
                                                                <option value="YE">Yemen</option>
                                                                <option value="ZM">Zambia</option>
                                                                <option value="ZW">Zimbabwe</option>
                                                            </select>
                                                    </div>
                                                    <div class="form-group">
                                                            <label for="zip"><i class="fa fa-barcode"></i> Zip Code</label>
                                                            <input type="text" class="form-control" placeholder="Zip" name='zip' value="<?php echo $zip; ?>">
                                                        </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer" style="text-align:center">
                                    <button name="update_profile" type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->

                    </div>
                    <!--/.col (left) -->

                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    
  <?php require_once('joins/footer.php'); ?>