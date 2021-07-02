<?php
$conn = mysqli_connect('localhost','root','','group_chats');
if(!$conn) {
	throw new Exception("Error Processing Request", 1);
	
}

if(isset($_POST['daftar'])) {
	$nama = htmlentities(strip_tags($_POST['nama']));
	$user = htmlentities(strip_tags($_POST['user']));
	$pass = htmlentities(strip_tags($_POST['password']));
	$exec = mysqli_query($conn, "INSERT INTO user(nama,user,pass) VALUES('$nama','$user','$pass')");
	if($exec) {
		echo "<script>alert('data berhasil disimpan, silahakan login')
		document.location ='login.php'
		</script>";
	}else{
		echo "<script>alert('data gagal disimpan, silahkan coba lagi')
		document.location= 'registrasi.php'
		<script>";

	}
}
 

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
		 <link rel="stylesheet" type="text/css" href=" https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

<body>
	<div class="container-fluid h-100 mt-5">
		<div class="row justify-content-center h-100">
			<form action="registrasi.php" method="post">
				
			<table class="table">
				<tr>
					<td>Nama</td>
					<td><input type="text" name="nama" class="form-control"></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="user" class="form-control"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password" class="form-control"></td>
				</tr>
				<tr>
					<td>
						<button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
					</td>
				</tr>
				</form>
				<tr>
					<td>
						Sudah punya akun? silahkan <a href="login.php">Login</a>
					</td>
				</tr>
			</table>
		
		</div>
	</div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
