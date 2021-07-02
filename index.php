<?php
session_start();
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

	</head>
	<body>
 			<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="group.png" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="group_info">
									<span>Group Chat</span>
									<p>Messages</p> 
								</div>
								<div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div>
							</div>
							<a class="logout" onclick="return confirm('Are you sure want to exit?')" href="logout.php"><i class="fas fa-sign-out-alt float-right" style="position:absolute;top:10px;right:40px;font-size: 24px; color: white;"></i></a>
						
							
						</div>
						<div class="card-body msg_card_body">

						
							
							
					</div>
				
						<div class="card-footer">
							
							<div class="input-group">
								<div class="input-group-append" >
									<span class="input-group-text attach_btn"><label id="insPic" class="fas fa-camera" for="pic"></label>
								
									</span>
								</div>
								<textarea name="pesan" data-userid="<?= $_SESSION['uid'] ?>" data-nama="<?= $_SESSION['nama'] ?>" placeholder="Type your message..."class="form-control"></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
					


	</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyCwwrDs-9-qebsqFZh1qgtmiJN6cb66M4M",
    authDomain: "group-chats-3c630.firebaseapp.com",
    databaseURL: "https://group-chats-3c630-default-rtdb.firebaseio.com",
    projectId: "group-chats-3c630",
    storageBucket: "group-chats-3c630.appspot.com",
    messagingSenderId: "959629970047",
    appId: "1:959629970047:web:57489acd6a21c219c50d4a"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

  var rootchatref = firebase.database().ref('/');
  var chatref = firebase.database().ref('/Chat');
  chatref.on('child_added',function(snapshot) {
  	var data = snapshot.val();
  	var uid = $('textarea[name=pesan]').data('userid');
  	var row='';
  	if(data.uid === uid) {
  	  row += ` <span class="name_send">${data.nama}</span>
                           <div class="d-flex justify-content-end mb-4">	
							<div class="msg_cotainer_send">${data.pesan}
							<span class="msg_time_send">${data.tanggal}</span>`
  	}else {
  		row += `<span class="name_rec">${data.nama}</span>
                          <div class="d-flex justify-content-start mb-4">
                           <div class="msg_cotainer_">
                          ${data.pesan}
                            <span class="msg_time_"></span>
                           </div>
                          </div>`;
  	}  

  	$('.msg_card_body').append(row);

  })


  $('.send_btn').click(function(){
  	var pesan = $('textarea[name=pesan]').val()
  	var uid = $('textarea[name=pesan]').data('userid');
  	var nama = $('textarea[name=pesan]').data('nama');
  	var tanggal = getTanggal()
  	if(pesan !== "") {
  		writeNewPost(uid,pesan,nama,tanggal)
  		$('textarea[name=pesan]').val('')
  		autoscroll();
  	}
  })

  function autoscroll(){
  	var cc = $('.msg_card_body');
  	var dd = cc[0].scrollHeight;
  	cc.animate({
  		scrollTop :dd
  	},500)
  }

  function getTanggal() {
  	var myDays = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum&#39at','Sabtu'];
  	var time = new Date(),
  		day = time.getDay(),
  		day = myDays[day],
  		date = day + ','+ time.toLocaleString('en-US', {hour:'numeric', minute:'numeric', hour12: true});
  		return date
  }

  function writeNewPost(uid,pesan,nama,tanggal) {
  // A post entry.
  var postData = {
    nama: nama,
    uid: uid,
   	tanggal:tanggal,
   	pesan:pesan
  };

  // Get a key for a new Post.
  var newPostKey = firebase.database().ref().child('Chat').push().key;

  // Write the new post's data simultaneously in the posts list and the user's post list.
  var updates = {};
  updates['/Chat/' + newPostKey] = postData;
  return firebase.database().ref().update(updates);
}



</script>