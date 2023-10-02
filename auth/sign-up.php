<?php
session_start();

include '../config/db.php';
include '../config/config.php';
include '../config/functions.php';


$err = $msg = "";
$fname = $lname = $phone = $email = $password = $gender = $country = "";


if (isset($_POST['reg'])) {
    if (empty(text_input($_POST["fname"])) && text_input($_POST['fname'] == "")) {
        $err = "Please enter first name.";
    } else {
        $fname = text_input($_POST["fname"]);
    }

    if (empty(text_input($_POST["lname"])) && text_input($_POST['lname'] == "")) {
        $err = "Please enter last name.";
    } else {
        $lname = text_input($_POST["lname"]);
    }

    if (empty(text_input($_POST["email"])) && text_input($_POST['email'] == "")) {
        $err = "Please enter an email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $err = "This email is already taken.";
                } else {
                    $email = text_input($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    if (empty(text_input($_POST["gender"])) && text_input($_POST['gender'] == "")) {
        $err = "Please select gender.";
    } else {
        $gender = text_input($_POST["gender"]);
    }

    if (empty(text_input($_POST["phone"])) && text_input($_POST['phone'] == "")) {
        $err = "Please enter phone number.";
    } else {
        $phone = text_input($_POST["phone"]);
    }

    if (empty(text_input($_POST["country"])) && text_input($_POST['country'] == "")) {
        $err = "Please select a country.";
    } else {
        $country = text_input($_POST["country"]);
    }

    if (empty(text_input($_POST["password"])) && text_input($_POST['password'] == "")) {
        $err = "Please enter a password.";
    } elseif (strlen(text_input($_POST["password"])) < 6) {
        $err = "Password must have atleast 6 characters.";
    } elseif (text_input($_POST['cpassword']) != text_input($_POST['password'])) {
        $err = "Passwords do not match";
    } else {
        $password = text_input($_POST["password"]);
    }

    if (empty($err)) {
        $date =  date('d-m-Y');
        $code = "0123456789";
        $fa2_code = str_shuffle($code);
        $fa2_code = substr($fa2_code, 0, 6);
        $insert = mysqli_query($link, "INSERT INTO users (`fname`, `lname`, `email`, `password`, `phone`, `gender`, `country`, `2fa_code`) VALUES ('$fname', '$lname', '$email', '$password', '$phone', '$gender', '$country', '$fa2_code') ");
        if ($insert) {

            $_SESSION['2fa_login'] = $email;
            //send welcome mail
            $name = $fname . " " . $lname;
            $subject = "Auth OTP";
            $body = "<h5>Login OTP</h5> <p>Hi " . $fname . "</p> <p>A login attempt was made on your account. use the code below to complete sign in.</p> <h5> <strong>" . $fa2_code . "</strong> </h5> <p>Contact us as soon as possible if you didnt make this attempt.</p> <p>Thanks,</p> <p>" . $sitename . "</p> ";
            $send = sendMail($email, $name, $subject, $body);
            if ($send) {
                // echo "<script>window.location.href = '2fa.php' </script>";
            }
            echo "<script>window.location.href = '2fa.php' </script>";
        }
    }
}
?>
<!doctype html>
<html lang="en">


<!-- Mirrored from www.indonez.com/html-demo/Cirro/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2022 18:41:08 GMT -->
<!-- Added by HTTrack -->

<!-- Mirrored from astromineoptions.com/register by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Dec 2022 00:21:05 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="blockit, uikit3, indonez, handlebars, scss, javascript">
    <meta name="author" content="Peter Parker">
    <meta name="theme-color" content="#2E89EA" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <!-- Touch icon -->
    <link rel="apple-touch-icon-precomposed" href="../images/favicon.ico">
    <title>Sign Up - Trade Nation</title>

    <script src="../dash/js/jquery-3.2.1.min.js"></script>
    <script src="../dash/notiflix-Notiflix-dfaf93f/dist/notiflix-aio-3.2.5.min.js"></script>
    <link rel="stylesheet" href="user/dash/css/style.css">
    <link rel="stylesheet" href="user/dash/css/user-custom.css">
    <script src="user/dash/notiflix-aio-3.2.5.min.js"></script>
    <script src="user/js/jquery-3.2.1.min.js"></script>
</head>

<body>
    <!-- page loader begin -->
    <div class="page-loader w-100 h-100 bg-white d-flex justify-content-center align-items-center position-fixed overflow-hidden">
        <div class="spinner-grow spinner-grow-sm text-success"></div>
        <div class="spinner-grow spinner-grow-sm text-success"></div>
        <div class="spinner-grow spinner-grow-sm text-success"></div>
    </div>
    <!-- page loader end -->
    <main>
        <!-- section content begin -->
        <section style="background-color: #00150F;">
            <div class="container-fluid overflow-hidden">
                <div class="row vh-100">

                    <div class="col-md-12 col-lg-6 d-flex align-items-center">

                        <div class="row justify-content-center">

                            <div class="col-md-8 col-lg-6">
                                <div class="text-center">
                                    <a class="navbar-brand" href="../index.html">
                                        <img src="../assets/images/logo/logo.svg" alt="logo">
                                    </a>
                                    <p class="lead mt-1 mb-3">Happy to see you. Sign Up!</p>
                                    <?php
                                    if ($msg != "") {
                                        echo userAlert("success", $msg);
                                    }

                                    if ($err != "") {
                                        echo userAlert("error", $err);
                                    }
                                    ?>
                                    <!-- login form begin -->
                                    <form class="mb-2" method="POST" action="sign-up.php">
                                        <div class="row g-1">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="text" required="" value="<?php echo $fname ?>" name="fname" class="form-control" placeholder="Firstname" aria-label="Firstname">
                                                    <span class="input-group-text"><i class="fas fa-user fa-xs text-muted"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="text" required="" value="<?php echo $lname ?>" name="lname" class="form-control" placeholder="Lastname" aria-label="Lastname">
                                                    <span class="input-group-text"><i class="fas fa-user fa-xs text-muted"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="email" name="email" required="" value="<?php echo $email ?>" class="form-control" placeholder="Email" aria-label="Email">
                                                    <span class="input-group-text"><i class="fas fa-envelope fa-xs text-muted"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="text" name="phone" class="form-control" placeholder="Phone" required="" value="<?php echo $phone ?>" aria-label="Phone">
                                                    <span class="input-group-text"><i class="fas fa-phone fa-xs text-muted"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <select name="gender" class="form-control" aria-label="Gender">
                                                        <option value="">Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                    <span class="input-group-text">
                                                        <i class="fas fa-male fa-xs text-muted"></i>
                                                        <i class="fas fa-female fa-xs text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <select name="country" class="form-control" aria-label="Country">
                                                        <option value="">Country</option>
                                                        <option value="Afganistan">Afghanistan</option>
                                                        <option value="Albania">Albania</option>
                                                        <option value="Algeria">Algeria</option>
                                                        <option value="American Samoa">American Samoa</option>
                                                        <option value="Andorra">Andorra</option>
                                                        <option value="Angola">Angola</option>
                                                        <option value="Anguilla">Anguilla</option>
                                                        <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                                        <option value="Argentina">Argentina</option>
                                                        <option value="Armenia">Armenia</option>
                                                        <option value="Aruba">Aruba</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Austria">Austria</option>
                                                        <option value="Azerbaijan">Azerbaijan</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                        <option value="Bahrain">Bahrain</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Barbados">Barbados</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Belgium">Belgium</option>
                                                        <option value="Belize">Belize</option>
                                                        <option value="Benin">Benin</option>
                                                        <option value="Bermuda">Bermuda</option>
                                                        <option value="Bhutan">Bhutan</option>
                                                        <option value="Bolivia">Bolivia</option>
                                                        <option value="Bonaire">Bonaire</option>
                                                        <option value="Bosnia & Herzegovina">Bosnia & Herzegovina
                                                        </option>
                                                        <option value="Botswana">Botswana</option>
                                                        <option value="Brazil">Brazil</option>
                                                        <option value="British Indian Ocean Ter">British Indian Ocean
                                                            Ter</option>
                                                        <option value="Brunei">Brunei</option>
                                                        <option value="Bulgaria">Bulgaria</option>
                                                        <option value="Burkina Faso">Burkina Faso</option>
                                                        <option value="Burundi">Burundi</option>
                                                        <option value="Cambodia">Cambodia</option>
                                                        <option value="Cameroon">Cameroon</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="Canary Islands">Canary Islands</option>
                                                        <option value="Cape Verde">Cape Verde</option>
                                                        <option value="Cayman Islands">Cayman Islands</option>
                                                        <option value="Central African Republic">Central African
                                                            Republic</option>
                                                        <option value="Chad">Chad</option>
                                                        <option value="Channel Islands">Channel Islands</option>
                                                        <option value="Chile">Chile</option>
                                                        <option value="China">China</option>
                                                        <option value="Christmas Island">Christmas Island</option>
                                                        <option value="Cocos Island">Cocos Island</option>
                                                        <option value="Colombia">Colombia</option>
                                                        <option value="Comoros">Comoros</option>
                                                        <option value="Congo">Congo</option>
                                                        <option value="Cook Islands">Cook Islands</option>
                                                        <option value="Costa Rica">Costa Rica</option>
                                                        <option value="Cote DIvoire">Cote DIvoire</option>
                                                        <option value="Croatia">Croatia</option>
                                                        <option value="Cuba">Cuba</option>
                                                        <option value="Curaco">Curacao</option>
                                                        <option value="Cyprus">Cyprus</option>
                                                        <option value="Czech Republic">Czech Republic</option>
                                                        <option value="Denmark">Denmark</option>
                                                        <option value="Djibouti">Djibouti</option>
                                                        <option value="Dominica">Dominica</option>
                                                        <option value="Dominican Republic">Dominican Republic</option>
                                                        <option value="East Timor">East Timor</option>
                                                        <option value="Ecuador">Ecuador</option>
                                                        <option value="Egypt">Egypt</option>
                                                        <option value="El Salvador">El Salvador</option>
                                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                        <option value="Eritrea">Eritrea</option>
                                                        <option value="Estonia">Estonia</option>
                                                        <option value="Ethiopia">Ethiopia</option>
                                                        <option value="Falkland Islands">Falkland Islands</option>
                                                        <option value="Faroe Islands">Faroe Islands</option>
                                                        <option value="Fiji">Fiji</option>
                                                        <option value="Finland">Finland</option>
                                                        <option value="France">France</option>
                                                        <option value="French Guiana">French Guiana</option>
                                                        <option value="French Polynesia">French Polynesia</option>
                                                        <option value="French Southern Ter">French Southern Ter
                                                        </option>
                                                        <option value="Gabon">Gabon</option>
                                                        <option value="Gambia">Gambia</option>
                                                        <option value="Georgia">Georgia</option>
                                                        <option value="Germany">Germany</option>
                                                        <option value="Ghana">Ghana</option>
                                                        <option value="Gibraltar">Gibraltar</option>
                                                        <option value="Great Britain">Great Britain</option>
                                                        <option value="Greece">Greece</option>
                                                        <option value="Greenland">Greenland</option>
                                                        <option value="Grenada">Grenada</option>
                                                        <option value="Guadeloupe">Guadeloupe</option>
                                                        <option value="Guam">Guam</option>
                                                        <option value="Guatemala">Guatemala</option>
                                                        <option value="Guinea">Guinea</option>
                                                        <option value="Guyana">Guyana</option>
                                                        <option value="Haiti">Haiti</option>
                                                        <option value="Hawaii">Hawaii</option>
                                                        <option value="Honduras">Honduras</option>
                                                        <option value="Hong Kong">Hong Kong</option>
                                                        <option value="Hungary">Hungary</option>
                                                        <option value="Iceland">Iceland</option>
                                                        <option value="Indonesia">Indonesia</option>
                                                        <option value="India">India</option>
                                                        <option value="Iran">Iran</option>
                                                        <option value="Iraq">Iraq</option>
                                                        <option value="Ireland">Ireland</option>
                                                        <option value="Isle of Man">Isle of Man</option>
                                                        <option value="Israel">Israel</option>
                                                        <option value="Italy">Italy</option>
                                                        <option value="Jamaica">Jamaica</option>
                                                        <option value="Japan">Japan</option>
                                                        <option value="Jordan">Jordan</option>
                                                        <option value="Kazakhstan">Kazakhstan</option>
                                                        <option value="Kenya">Kenya</option>
                                                        <option value="Kiribati">Kiribati</option>
                                                        <option value="Korea North">Korea North</option>
                                                        <option value="Korea Sout">Korea South</option>
                                                        <option value="Kuwait">Kuwait</option>
                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                        <option value="Laos">Laos</option>
                                                        <option value="Latvia">Latvia</option>
                                                        <option value="Lebanon">Lebanon</option>
                                                        <option value="Lesotho">Lesotho</option>
                                                        <option value="Liberia">Liberia</option>
                                                        <option value="Libya">Libya</option>
                                                        <option value="Liechtenstein">Liechtenstein</option>
                                                        <option value="Lithuania">Lithuania</option>
                                                        <option value="Luxembourg">Luxembourg</option>
                                                        <option value="Macau">Macau</option>
                                                        <option value="Macedonia">Macedonia</option>
                                                        <option value="Madagascar">Madagascar</option>
                                                        <option value="Malaysia">Malaysia</option>
                                                        <option value="Malawi">Malawi</option>
                                                        <option value="Maldives">Maldives</option>
                                                        <option value="Mali">Mali</option>
                                                        <option value="Malta">Malta</option>
                                                        <option value="Marshall Islands">Marshall Islands</option>
                                                        <option value="Martinique">Martinique</option>
                                                        <option value="Mauritania">Mauritania</option>
                                                        <option value="Mauritius">Mauritius</option>
                                                        <option value="Mayotte">Mayotte</option>
                                                        <option value="Mexico">Mexico</option>
                                                        <option value="Midway Islands">Midway Islands</option>
                                                        <option value="Moldova">Moldova</option>
                                                        <option value="Monaco">Monaco</option>
                                                        <option value="Mongolia">Mongolia</option>
                                                        <option value="Montserrat">Montserrat</option>
                                                        <option value="Morocco">Morocco</option>
                                                        <option value="Mozambique">Mozambique</option>
                                                        <option value="Myanmar">Myanmar</option>
                                                        <option value="Nambia">Nambia</option>
                                                        <option value="Nauru">Nauru</option>
                                                        <option value="Nepal">Nepal</option>
                                                        <option value="Netherland Antilles">Netherland Antilles
                                                        </option>
                                                        <option value="Netherlands">Netherlands (Holland, Europe)
                                                        </option>
                                                        <option value="Nevis">Nevis</option>
                                                        <option value="New Caledonia">New Caledonia</option>
                                                        <option value="New Zealand">New Zealand</option>
                                                        <option value="Nicaragua">Nicaragua</option>
                                                        <option value="Niger">Niger</option>
                                                        <option value="Nigeria">Nigeria</option>
                                                        <option value="Niue">Niue</option>
                                                        <option value="Norfolk Island">Norfolk Island</option>
                                                        <option value="Norway">Norway</option>
                                                        <option value="Oman">Oman</option>
                                                        <option value="Pakistan">Pakistan</option>
                                                        <option value="Palau Island">Palau Island</option>
                                                        <option value="Palestine">Palestine</option>
                                                        <option value="Panama">Panama</option>
                                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                                        <option value="Paraguay">Paraguay</option>
                                                        <option value="Peru">Peru</option>
                                                        <option value="Phillipines">Philippines</option>
                                                        <option value="Pitcairn Island">Pitcairn Island</option>
                                                        <option value="Poland">Poland</option>
                                                        <option value="Portugal">Portugal</option>
                                                        <option value="Puerto Rico">Puerto Rico</option>
                                                        <option value="Qatar">Qatar</option>
                                                        <option value="Republic of Montenegro">Republic of Montenegro
                                                        </option>
                                                        <option value="Republic of Serbia">Republic of Serbia</option>
                                                        <option value="Reunion">Reunion</option>
                                                        <option value="Romania">Romania</option>
                                                        <option value="Russia">Russia</option>
                                                        <option value="Rwanda">Rwanda</option>
                                                        <option value="St Barthelemy">St Barthelemy</option>
                                                        <option value="St Eustatius">St Eustatius</option>
                                                        <option value="St Helena">St Helena</option>
                                                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                                        <option value="St Lucia">St Lucia</option>
                                                        <option value="St Maarten">St Maarten</option>
                                                        <option value="St Pierre & Miquelon">St Pierre & Miquelon
                                                        </option>
                                                        <option value="St Vincent & Grenadines">St Vincent & Grenadines
                                                        </option>
                                                        <option value="Saipan">Saipan</option>
                                                        <option value="Samoa">Samoa</option>
                                                        <option value="Samoa American">Samoa American</option>
                                                        <option value="San Marino">San Marino</option>
                                                        <option value="Sao Tome & Principe">Sao Tome & Principe
                                                        </option>
                                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                                        <option value="Senegal">Senegal</option>
                                                        <option value="Seychelles">Seychelles</option>
                                                        <option value="Sierra Leone">Sierra Leone</option>
                                                        <option value="Singapore">Singapore</option>
                                                        <option value="Slovakia">Slovakia</option>
                                                        <option value="Slovenia">Slovenia</option>
                                                        <option value="Solomon Islands">Solomon Islands</option>
                                                        <option value="Somalia">Somalia</option>
                                                        <option value="South Africa">South Africa</option>
                                                        <option value="Spain">Spain</option>
                                                        <option value="Sri Lanka">Sri Lanka</option>
                                                        <option value="Sudan">Sudan</option>
                                                        <option value="Suriname">Suriname</option>
                                                        <option value="Swaziland">Swaziland</option>
                                                        <option value="Sweden">Sweden</option>
                                                        <option value="Switzerland">Switzerland</option>
                                                        <option value="Syria">Syria</option>
                                                        <option value="Tahiti">Tahiti</option>
                                                        <option value="Taiwan">Taiwan</option>
                                                        <option value="Tajikistan">Tajikistan</option>
                                                        <option value="Tanzania">Tanzania</option>
                                                        <option value="Thailand">Thailand</option>
                                                        <option value="Togo">Togo</option>
                                                        <option value="Tokelau">Tokelau</option>
                                                        <option value="Tonga">Tonga</option>
                                                        <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                                        <option value="Tunisia">Tunisia</option>
                                                        <option value="Turkey">Turkey</option>
                                                        <option value="Turkmenistan">Turkmenistan</option>
                                                        <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                                        <option value="Tuvalu">Tuvalu</option>
                                                        <option value="Uganda">Uganda</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="Ukraine">Ukraine</option>
                                                        <option value="United Arab Erimates">United Arab Emirates
                                                        </option>
                                                        <option value="United States of America">United States of
                                                            America
                                                        </option>
                                                        <option value="Uraguay">Uruguay</option>
                                                        <option value="Uzbekistan">Uzbekistan</option>
                                                        <option value="Vanuatu">Vanuatu</option>
                                                        <option value="Vatican City State">Vatican City State</option>
                                                        <option value="Venezuela">Venezuela</option>
                                                        <option value="Vietnam">Vietnam</option>
                                                        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)
                                                        </option>
                                                        <option value="Virgin Islands (USA)">Virgin Islands (USA)
                                                        </option>
                                                        <option value="Wake Island">Wake Island</option>
                                                        <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                                        <option value="Yemen">Yemen</option>
                                                        <option value="Zaire">Zaire</option>
                                                        <option value="Zambia">Zambia</option>
                                                        <option value="Zimbabwe">Zimbabwe</option>
                                                    </select>
                                                    <span class="input-group-text">
                                                        <i class="fas fa-globe fa-xs text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                                                    <span class="input-group-text"><i class="fas fa-lock fa-xs text-muted"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="password" name="cpassword" class="form-control" placeholder="Re-type Password" aria-label="Password" required>
                                                    <span class="input-group-text"><i class="fas fa-lock fa-xs text-muted"></i></span>
                                                </div>
                                            </div>

                                            <br><br>


                                            <div class="col-12 text-start">
                                                <input type="checkbox" required="" name="terms" class="form-check-input" required>
                                                <label class="form-check-label"><small>Accept Terms &
                                                        Conditions</small></label>
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-success" name="reg">Sign
                                                    in</button>
                                            </div>
                                        </div>
                                    </form>

                                    <small class="text-muted">Already have an account? <a href="login.php" class="link-success text-decoration-none">Login</a></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 bg-light shadow-lg d-none d-lg-block" style="background-image: url(../img/back.jfif); background-size: cover;"></div>
                </div>
            </div>
        </section>
        <!-- section content end -->
    </main>



    <!-- javascript -->
    <script src="../js/vendors/bootstrap.min.js"></script>
    <script src="../js/utilities.min.js"></script>
    <script src="../js/config-theme.js"></script>
    
  <!-- GetButton.io widget -->
  <script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+1 (623) 352-5942", // WhatsApp number
            call_to_action: "Message Us", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
</body>


<!-- Mirrored from www.indonez.com/html-demo/Cirro/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2022 18:41:08 GMT -->


<!-- Mirrored from astromineoptions.com/register by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Dec 2022 00:21:06 GMT -->

</html>