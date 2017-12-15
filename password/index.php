<?php

// menyisipkan file config.php
   include("koneksi.php");
   include("PHPMailer/PHPMailerAutoload.php");
   error_reporting(0);
	if(isset($_POST['chpass'])){
	if($_POST['username'] != NULL && $_POST['old_password'] && $_POST['new_password']){
    if($_POST['new_password']==$_POST['new_password2'] && $_POST['new_password']==$_POST['new_password2']) {

	$username = $_POST['username'];
    $email = $username;
    $email .= "@unikadelasalle.ac.id";
	$cmmnd ="=password=";
	$cmmnd .=$_POST['new_password'];
	$old_password = $_POST['old_password'];
	
	$API->write('/ip/hotspot/user/getall',false);
	$API->write('?name='.$username);
	$READ = $API->read(false);
	$ARRAY = $API->parseResponse($READ);
	$NILAI = $ARRAY[0]['password'];

	if($NILAI = $ARRAY[0][password]==$old_password){
// mengeksekusi perintah Mikrotik CLI
	$API->write('/ip/hotspot/user/set',false);
	$API->write('=.id='.$username ,false);
	$API->write('=name='.$username ,false);
	$API->write($cmmnd);
  
   // membaca hasil eksekusi perintah tersebut
   $API->read();
		$msg = "Password berhasil diubah!";
                    $mail = new PHPMailer();
                    $body = 
                    "<body style='margin: 10px;'>
                    <div style='width: 640px; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
                    <br>
                    <strong>Password akun Hotspot Anda telah diubah!</strong>
                    <br>
                    Berikut ini data baru Akun Hotspot Anda untuk AP @DLSU Kampus UNIKA De La Salle Manado
                    <br>
                    <b>Username : </b>".$username."<br>
                    <b>Password : </b>".$_POST['new_password']."<br>
                    <br>
                    <p><i>Email ini dikirim otomatis, mohon jangan membalas email ini. Jika ada pertanyaan tanyakan langsung di PTI.</i></p>
                    </body>";
                    $mail->IsSMTP(); // menggunakan SMTP
                    $mail->SMTPDebug    = 0;// mengaktifkan debug SMTP

                    $mail->Debugoutput  = 'html';
                    $mail->Host         = 'smtp.gmail.com';
                    $mail->Port         = 587;
                    $mail->SMTPSecure   = 'tls';
                    $mail->SMTPAuth     = true;
                    $mail->Username     = $config_emailserver; // username email akun
                    $mail->Password     = base64_decode($config_emailpassword); // password akun

                    $mail->SetFrom('refsisangkay@gmail.com', 'Refsi Sangkay');

                    $mail->Subject      = "Penggantian Password Hotspot";
                    $mail->MsgHTML($body);

                    $address            = $email; //email tujuan
                    $mail->AddAddress($address, "Dear (Reciever name)");

                    if(!$mail->Send()) {
                        //echo "Oops, Mailer Error: " . $mail->ErrorInfo;
                    } else {

                    }
   }else {
		$msg = "Password lama salah!";
   }

    }else {
        $msg = "Konfirmasi password tidak sama!";
            }
 	
 	}else {
 		$msg = "Harap mengisi semua data yang diminta!";
 	}
   }
   // memutuskan koneksi dari router mikrotik
   $API->disconnect();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <!-- Created by Refsi Sangkay -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="expires" content="-1" />
        <title>Ganti Password - UNIKA De La Salle Hotspot</title>

        <!-- CSS -->       
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/typicons/typicons.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/media-queries.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    </head>

 <body> 
        <!-- Loader -->
    	<div class="loader">
    		<div class="loader-img"></div>
    	</div>
				
        <!-- Top content -->
        <div class="top-content">
        	
        	<!-- Top menu -->
			<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.html">DLSU-AP</a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="top-navbar-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="http://<?php echo $config_nameserver; ?>/login">Login</a></li>
							<li><a href="http://<?php echo $config_nameserver; ?>/status">Status</a></li>
							<li><a href="http://<?php echo $config_nameserver; ?>/logout?erase-cookie=true">Logout</a></li>
						</ul>
					</div>
				</div>
			</nav>
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-7 text">
                            <h1 class="wow fadeInLeftBig">UNIKA De La Salle <strong>Hotspot</strong></h1>
                            <div class="description wow fadeInLeftBig">
                            	<p><marquee>
									Internet Hotspot Universitas Katolik De La Salle Manado.
                            	</marquee></p>
                            </div>
                            <div class="top-big-link wow fadeInUp">
                            </div>
                        </div>
                        <div class="col-sm-5 form-box wow fadeInUp">
                        	<div class="form-top">
                        			<h3>Ganti Password</h3>
                            		<?php
                        	if(isset($msg)){
								echo "<div class='alert alert-info' role='alert'>$msg</div>";
                        	}
                        	?>
                        	</div>
                            <div class="form-bottom">
			                     <form name="login" action="" method="post">
            					    <input type="hidden" name="chpass"/>
			                    	<div class="form-group">
			                    		<label class="sr-only" for="username">Username</label>
			                        	<input type="text" name="username" placeholder="Username" class="form-first-name form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="password">Old Password</label>
			                        	<input type="password" name="old_password" placeholder="Old Password" class="form-last-name form-control" id="form-password">
			                        </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="password">Re-type Old Password</label>
                                        <input type="password" name="old_password2" placeholder="Re-type Old Password" class="form-last-name form-control" id="form-password">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="password">New Password</label>
                                        <input type="password" name="new_password" placeholder="New Password" class="form-last-name form-control" id="form-password">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="password">Re-type New Password</label>
                                        <input type="password" name="new_password2" placeholder="Re-type New Password" class="form-last-name form-control" id="form-password">
                                    </div>
			                        <button type="submit" class="btn">Ganti!</button>
			                    </form>

		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
        <script type="text/javascript">
		<!--
 		 document.login.username.focus();
		//-->
		</script>
        </body>
       </html>