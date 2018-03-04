<?php
session_start();
require_once 'assets/php/include/DB_Functions.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mood</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Header-Dark.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
	
	 <link rel="stylesheet" href="https://cdn.webrtc-experiment.com/style.css">
	  <script src="https://cdn.WebRTC-Experiment.com/MediaStreamRecorder.js"></script>
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
	<style>
        input {
            border: 1px solid rgb(46, 189, 235);
            border-radius: 3px;
            font-size: 1em;
            outline: none;
            padding: .2em .4em;
            width: 60px;
            text-align: center;
        }
        select {
            vertical-align: middle;
            line-height: 1;
            padding: 2px 5px;
            height: auto;
            font-size: inherit;
            margin: 0;
        }
    </style>
	
</head>

<body>
    <div class="header-dark">
         <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
            <div class="container"><a class="navbar-brand" href="index.php">Mood</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="notifications.html">Notifications</a></li>
                    </ul><a class="btn btn-light btn-block ml-auto action-button" role="button" href="postt.php" style="margin:4px;margin-left:0px;">Post</a>
					
					<?php
if(isset($_SESSION['id'])){
?>

<a class="btn btn-light ml-auto action-button" role="button" href="assets/php/logout.php" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Log Out</a>
<?php } else {?>
					
					<a class="btn btn-light ml-auto action-button" role="button" href="login..php" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Log In</a>
                    <a
                        class="btn btn-light ml-auto action-button" role="button" href="signup.php" style="margin:2px;margin-left:0px;background-color:rgb(75,91,91);">Sign Up</a>
						
						<?php } ?>
                </div>
            </div>
        </nav>
        <div class="container hero">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="text-center"></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="register-photo">
        <div class="form-container">
            <form method="post" action="assets/php/posta.php">
                <h2 class="text-center"><strong>Post Audio</strong></h2>
                <div class="form-group">  <section class="experiment" style="padding: 5px;">
            <input type="text" id="time-interval" value="5000">ms

            <br>
            <br> recorderType:

            <select id="audio-recorderType" style="font-size:22px;vertical-align: middle;margin-right: 5px;">
                <option>[Best Available Recorder]</option>
                <option>MediaRecorder API</option>
                <option>WebAudio API (WAV)</option>
                <option>WebAudio API (PCM)</option>
            </select>
            <br>
			

            <input id="left-channel" type="checkbox" checked style="width:auto;">
            <label for="left-channel">Record Mono Audio if WebAudio API is selected (above)</label>

            <br>
            <br>

            <button id="start-recording">Start</button>
            <button id="stop-recording" disabled>Stop</button>

            <button id="pause-recording" disabled>Pause</button>
            <button id="resume-recording" disabled>Resume</button>
          
		    
            <button id="save-recording" disabled>Save</button>
			
			
			
        </section>
		
		
            
		    <input  type="text" id="content" name="content" style="width:auto;">
			
        
		
		
		<section class="experiment">
            <div id="audios-container"></div>
        </section>
		
		
	
			
			
  <script>
  


function uploadAudio( blob ) {
  var reader = new FileReader();
  document.getElementById("content").value = "../sounds/temp/test.wav";
  reader.onload = function(event){
    var fd = {};
    fd["fname"] = "../sounds/temp/test.wav";
    fd["data"] = event.target.result;
    $.ajax({
      type: 'POST',
      url: 'assets/php/upload.php',
      data: fd,
      dataType: 'text'
    }).done(function(data) {
        console.log(data);
    });
  };
  reader.readAsDataURL(blob);
}
  
  
            function captureUserMedia(mediaConstraints, successCallback, errorCallback) {
                navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
            }
            var mediaConstraints = {
                audio: true
            };
            document.querySelector('#start-recording').onclick = function() {
                this.disabled = true;
                captureUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
				
				
            };
            document.querySelector('#stop-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.stop();
                mediaRecorder.stream.stop();
				
				
                document.querySelector('#pause-recording').disabled = true;
                document.querySelector('#start-recording').disabled = false;
            };
            document.querySelector('#pause-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.pause();
				  
                document.querySelector('#resume-recording').disabled = false;
            };
            document.querySelector('#resume-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.resume();
                document.querySelector('#pause-recording').disabled = false;
            };
            document.querySelector('#save-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.save();
								
									var url = document.getElementById("content").value;

                // alert('Drop WebM file on Chrome or Firefox. Both can play entire file. VLC player or other players may not work.');
            };
			//var phpblob;
            var mediaRecorder;
            function onMediaSuccess(stream) {
                var audio = document.createElement('audio');
                audio = mergeProps(audio, {
                    controls: true,
                    muted: true
                });
                audio.srcObject = stream;
                audio.play();
                audiosContainer.appendChild(audio);
                audiosContainer.appendChild(document.createElement('hr'));
                mediaRecorder = new MediaStreamRecorder(stream);
                mediaRecorder.stream = stream;
                var recorderType = document.getElementById('audio-recorderType').value;
                if (recorderType === 'MediaRecorder API') {
                    mediaRecorder.recorderType = MediaRecorderWrapper;
                }
                if (recorderType === 'WebAudio API (WAV)') {
                    mediaRecorder.recorderType = StereoAudioRecorder;
                    mediaRecorder.mimeType = 'audio/wav';
                }
                if (recorderType === 'WebAudio API (PCM)') {
                    mediaRecorder.recorderType = StereoAudioRecorder;
                    mediaRecorder.mimeType = 'audio/pcm';
                }
                // don't force any mimeType; use above "recorderType" instead.
                // mediaRecorder.mimeType = 'audio/webm'; // audio/ogg or audio/wav or audio/webm
                
				
				
				mediaRecorder.audioChannels = !!document.getElementById('left-channel').checked ? 1 : 2;
                mediaRecorder.ondataavailable = function(blob) {

				
                    var a = document.createElement('a');
                    a.target = '_blank';
                    a.innerHTML = 'Open Recorded Audio No. ' + (index++) + ' (Size: ' + bytesToSize(blob.size) + ') Time Length: ' + getTimeLength(timeInterval);
                    a.href = URL.createObjectURL(blob);
					uploadAudio( blob );
					//phpblob = blob;
					
					//document.getElementById("content").value = a.href;
					
                    audiosContainer.appendChild(a);
                    audiosContainer.appendChild(document.createElement('hr'));
                };
				
				
				
				
				
                var timeInterval = document.querySelector('#time-interval').value;
                if (timeInterval) timeInterval = parseInt(timeInterval);
                else timeInterval = 5 * 1000;
                // get blob after specific time interval
                mediaRecorder.start(timeInterval);
                document.querySelector('#stop-recording').disabled = false;
                document.querySelector('#pause-recording').disabled = false;
                document.querySelector('#save-recording').disabled = false;
            }
            function onMediaError(e) {
                console.error('media error', e);
            }
            var audiosContainer = document.getElementById('audios-container');
            var index = 1;
            // below function via: http://goo.gl/B3ae8c
            function bytesToSize(bytes) {
                var k = 1000;
                var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes === 0) return '0 Bytes';
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(k)), 10);
                return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
            }
            // below function via: http://goo.gl/6QNDcI
            function getTimeLength(milliseconds) {
                var data = new Date(milliseconds);
                return data.getUTCHours() + " hours, " + data.getUTCMinutes() + " minutes and " + data.getUTCSeconds() + " second(s)";
            }
            window.onbeforeunload = function() {
                document.querySelector('#start-recording').disabled = false;
            };
        </script>
		
		</div>
		
		
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Post</button></div>
            </form>
        </div>
    </div>
    <div class="projects-horizontal"></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>