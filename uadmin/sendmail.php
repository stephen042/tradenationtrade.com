<?php include 'header.php'; ?>

<?php 
$msg = "";
$err = "";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

	if (isset($_POST['send'])) {
		$subject = text_input($_POST['subject']);
		$title = text_input($_POST['title']);
		$message = text_input($_POST['message']);
		if (!empty($subject) && !empty($title) && !empty($message)) {

			$body = "<h2>".$title."</h2><br><br>".$message."";	
			$query = mysqli_query($link, "SELECT * FROM users ");
			if (mysqli_num_rows($query) > 0) {
				while ($data = mysqli_fetch_assoc($query)) {
					$emails = $data['email'];
					$names = $data['fullname'];

					include_once "../PHPMailer/PHPMailer.php";
    require_once '../PHPMailer/Exception.php';

//PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = $emaila;
$mail->FromName = $name;
$mail->addAddress("$emails"); //Recipient name is optional

//Address to which recipient will reply

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = $subject;

$mail->Body = '<div style="background: #f5f7f8;width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 

<div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">



<div style="clear: both;"></div> 

<div class="be_bluebar" style="background: red; padding: 20px; color: #fff;margin-top: 10px;">

<h1>'.$subject.' </h1>

</div> </div> 

<div class="be_body" style="padding: 20px;"> <p style="line-height: 25px;">

'.$message.'
</p>  </div> </div>';
$mail->send();
            $msg = "Message successfully sent";

				}
			}
			$msg = "Message successfully sent";
		}
	}
?>

<div class="page-content">
    <div class="container-fluid">
<?php 
	if ($msg != "") {
		echo customAlert("success", $msg);
	}
	if ($err != "") {
		echo customAlert("error", $err);
	}

 ?>

    	<div class="row">
            <div class="col-lg-12">
                <div class="card">
                	<div class="card-body">
                		<div class="card-header">
			                <h4 class="card-title mb-0">Send Mail to all users</h4>
			            </div>
			            <form method="post" action="sendmail.php">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Subject</label>
                                        <input type="text" class="form-control" name="subject" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Title of the Message</label>
                                        <input type="text" class="form-control" name="title" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Message</label>
                                        <textarea class="form-control" rows="5" name="message" placeholder="Type Message..."></textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-12">
                                    <div>
                                        <button type="submit" name="send" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


	</div>
</div>
<?php include 'footer.php'; ?>