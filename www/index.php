<?
session_start();

$ip=$_SERVER["REMOTE_ADDR"];


?> 
<!DOCTYPE HTML>
<html>
	<head>
		<title>facemix</title>
	        <meta charset="UTF-8"> 
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		 <script src="js/jquery.min.js"></script>
		 <!---- start-smoth-scrolling---->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
		<!---- start-smoth-scrolling---->
		 <!-- Custom Theme files -->
		<link href="css/theme-style.css" rel='stylesheet' type='text/css' />
   		 <!-- Custom Theme files -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
		<!----webfonts---->
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800,300,700' rel='stylesheet' type='text/css'>
		<!----//webfonts---->
		<!----start-top-nav-script---->

		<script>
			$(function() {
				var pull 		= $('#pull');
					menu 		= $('nav ul');
					menuHeight	= menu.height();
				$(pull).on('click', function(e) {
					e.preventDefault();
					menu.slideToggle();
				});
				$(window).resize(function(){
	        		var w = $(window).width();
	        		if(w > 320 && menu.is(':hidden')) {
	        			menu.removeAttr('style');
	        		}
	    		});
			});
		</script>
		<!----//End-top-nav-script---->


        <!-- Include the PubNub Library -->
        <script src="https://cdn.pubnub.com/pubnub.min.js"></script>
        <script src="js/webrtc-beta-pubnub.js"></script>

        <!-- Instantiate PubNub -->
        <script type="text/javascript">

        var pubnub = PUBNUB.init({
        publish_key: 'pub-c-c25d73f6-1b1e-4b49-813f-f5eda5ac120e',
        subscribe_key: 'sub-c-496b23ee-7d21-11e4-812f-02ee2ddab7fe',
        uuid: '<?=$ip?>'
        });
        
        pubnub.subscribe({
        channel: 'facemix',
        message: function(m){console.log(m);},
        connect: publish

        }); 


        function publish() {
		//http://creativejs.com/2012/03/getting-started-with-getusermedia/
		var is_webkit = false;
		var is_moz=false;

		function onSuccess(stream) {
			var output=document.getElementById('selfvideo');
			if (is_webkit) {
				output.src=window.webkitURL.createObjectURL(stream);
			}	
			else if(is_moz) {
				document.querySelector('#selfvideo').src = URL.createObjectURL(stream);
				//		output.src=URL.createObjectURL(stream);
				//alert(output.src);
			}
			else {
				output.src=stream;
			}
			//#self-call-video').src = URL.createObjectURL(stream);
			//myStream = stream; // Save the stream for later use

		            pubnub.publish({
			            channel: 'facemix',
				    message: function(m){console.log(m)},
			            stream: stream
		            });

		            pubnub.here_now({
		                channel: 'facemix',
		                callback: function(m){
					console.log(m);
					document.getElementById("people").innerHTML ="0 people in the ring";
				}
		            })


		}
		function onError() {
		}


		if (navigator.getUserMedia) {
		    // opera users (hopefully everyone else at some point)
		    navigator.getUserMedia({video: true, audio: false}, onSuccess, onError);
		}
		else if (navigator.webkitGetUserMedia) {
		    // webkit users
		    is_webkit = true;
		    navigator.webkitGetUserMedia('video', onSuccess, onError);
		}
		else if (navigator.mozGetUserMedia) {
			//mozilla
		    is_moz=true;
		    navigator.mozGetUserMedia({ audio: false, video: true}, onSuccess, onError ); 
		}
		else {
		    // moms, dads, grandmas, and grandpas
		}



	}
        </script>

<!--
			var res = JSON.parse(m);
			document.write(getContact.name + ", " + getContact.age);
			console.log(res.message);
			document.getElementById("people").innerHtml =res.occupancy+" people in the ring";
-->

	<script>
//navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
//navigator.getUserMedia({ audio: false, video: true}, gotStream, errorStream ); 
	</script>

	</head>
	<body>
		<!-----start-container---->
		<div class="bg">
			<div class="container">
				<div class="header">
					<div class="logo">
						<a href="#"><img src="images/logo.png" title="facemix" alt="Facemix - mixing people since 2014" /></a>
					</div>

		   		    <div class="buttons">
		  			<!-- coinbase tip button -->
                		    <div class="cb-tip-button" data-content-location="http://facemix.mm-studios.com" data-href="//www.coinbase.com/tip_buttons/show_tip" data-to-user-id="523c4e82a787b2fa4000002e"></div>
		                    <script>!function(d,s,id) {var js,cjs=d.getElementsByTagName(s)[0],e=d.getElementById(id);if(e){return;}js=d.createElement(s);js.id=id;js.src="https://www.coinbase.com/assets/tips.js";cjs.parentNode.insertBefore(js,cjs);}(document, 'script', 'coinbase-tips');</script>
                		    </div>

					<div class="clearfix"> </div>
<div id="peoplediv">
<p class="txt" id="people">empty ring :&lt;</p>
</div>

				</div>

<div class="vll"></div>
<div class="vleft"></div>
<div class="vself" id="self-call-video">
<!--<video autoplay id="selfvideo"></video> -->
<!--<canvas style="width: 644px; height: 483px; margin-left: 0px;" height="600" width="800" id="selfvideo"></canvas>-->
<div>
<video id="selfvideo" src="http://download.wavetlan.com/SVV/Media/HTTP/H264/Talkinghead_Media/H264_test1_Talkinghead_mp4_480x360.mp4" autoplay="autoplay" muted="true"></video>
</div>

</div>
<div class="vright"></div>
<div class="vrr"></div>

				<!----start-top-nav---->
				<!--
				 <nav class="top-nav">
					<ul class="top-nav">
						<li class="active"><a href="#home" class="scroll">Home</a></li>
						<li class="page-scroll"><a href="#about" class="scroll">About us</a></li>
						<li class="page-scroll"><a href="#gal" class="scroll">Gallery</a></li>
						<li class="page-scroll"><a href="#con" class="scroll">Consulation</a></li>
						<li class="page-scroll"><a href="#test" class="scroll">Testimonials</a></li>
						<li class="page-scroll"><a href="#contact" class="scroll">Contact</a></li>
					</ul>
					<a href="#" id="pull"><img src="images/nav-icon.png" title="menu" /></a>
				</nav>
				-->
			</div>
		</div>
		<!-----start-about---->
<!--
		<div id="about" class="about">
			<div class="container">
				<div class="col-md-5 about-left">
					<p>Miami <label>best</label> Realry  <span>-this</span></p>
				</div>
				<div class="col-md-7 about-right">
					<h3>Over 50 years experience in love.</h3>
					<p>Mazel and VA Tsukkerman in his "Analysis of musical works." Pointillism, which originated in the music of the early twentieth century, microforms, found a distant historical.</p>
					<ul class="list-unstyled list-inline">
						<li>1.  The market leader in real estate since 2003</li>
						<li>2.  Awards Real Estate Company, 2010, 2011, 2013</li>
						<li>3.  More than 200 satisfied customers premium segment</li>
						<li>4.  We focus only on new buildings and high-level doskanalno know this area better than other specialists.</li>
						<li>5.  Working directly with developers - so have more useful information about the profitable deals</li>
					</ul>
					<span>We will never late!<br /> Guaranteed secure transaction - 100%</span>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
-->
		<!-----//End-about---->
		<!----start-gallery---->
<!--
		<div id="gal" class="gallery">
			<div class="container">
				<div class="head">
					<h3>Gallery <span> </span></h3>
				</div>
				<div class="gallery-grids">
					<div class="gallery-grids-row1">
						<div class="col-md-8 gallery-grid1">
							<a href="#" class="b-link-stripe b-animate-go  thickbox">
								<img class="port-pic" src="images/g1.jpg" />
								<div class="b-wrapper">
									<h2 class="b-animate b-from-left    b-delay03 ">
										<span> Miami places</span>
										<button>View photo</button>
										<label> <i class="fa fa-heart"> </i> 21</label>
									</h2>
								</div>
							</a>
						</div>
						<div class="col-md-4 gallery-grid1">
							<a href="#" class="b-link-stripe b-animate-go  thickbox">
								<img class="port-pic" src="images/g2.jpg" />
								<div class="b-wrapper">
									<h2 class="b-animate b-from-left    b-delay03 ">
										<span> Miami places</span>
										<button>View photo</button>
										<label> <i class="fa fa-heart"> </i> 21</label>
									</h2>
								</div>
							</a>
						</div>
						<div class="clearfix"> </div>
						<p class="place">Marina Palms / <a href="#">North Miami Beach, FL 33162</a></p>
					</div>
					<div class="gallery-grids-row1">
						<div class="col-md-6 gallery-grid1">
							<a href="#" class="b-link-stripe b-animate-go  thickbox">
								<img class="port-pic" src="images/g3.jpg" />
								<div class="b-wrapper">
									<h2 class="b-animate b-from-left    b-delay03 ">
										<span> Miami places</span>
										<button>View photo</button>
										<label> <i class="fa fa-heart"> </i> 21</label>
									</h2>
								</div>
							</a>
						</div>
						<div class="col-md-6 gallery-grid1">
							<a href="#" class="b-link-stripe b-animate-go  thickbox">
								<img class="port-pic" src="images/g4.jpg" />
								<div class="b-wrapper">
									<h2 class="b-animate b-from-left    b-delay03 ">
										<span> Miami places</span>
										<button>View photo</button>
										<label> <i class="fa fa-heart"> </i> 21</label>
									</h2>
								</div>
							</a>
						</div>
						<div class="clearfix"> </div>
						<p class="place">Edition Residens /<a href="#">Miami Beach, FL 33139</a></p>
					</div>
					
					<div class="gallery-grids-row1">
						<div class="col-md-4 gallery-grid1">
							<a href="#" class="b-link-stripe b-animate-go  thickbox">
								<img class="port-pic" src="images/g2.jpg" />
								<div class="b-wrapper">
									<h2 class="b-animate b-from-left    b-delay03 ">
										<span> Miami places</span>
										<button>View photo</button>
										<label> <i class="fa fa-heart"> </i> 21</label>
									</h2>
								</div>
							</a>
						</div>
						<div class="col-md-8 gallery-grid1">
							<a href="#" class="b-link-stripe b-animate-go  thickbox">
								<img class="port-pic" src="images/g1.jpg" />
								<div class="b-wrapper">
									<h2 class="b-animate b-from-left    b-delay03 ">
										<span> Miami places</span>
										<button>View photo</button>
										<label> <i class="fa fa-heart"> </i> 21</label>
									</h2>
								</div>
							</a>
						</div>
						<div class="clearfix"> </div>
						<p class="place">Faena House / <a href="#">Miami Beach, FL 33140</a></p>
					</div>
				</div>
				<a class="view-gallery-btn" href="#">View all</a>
			</div>
		</div>
-->
		<!----//End-gallery---->
		<!----start-consulation----->
<!--
		<div id="con" class="consulation">
			<div class="container">
				<div class="head c-head">
						<h3>Consulation <span> </span></h3>
				</div>
				<div class="consulation-grids">
					<div class="col-md-7 consulation-left">
						<h4>How long have you do yourself a gift?</h4>
						<p>The procedural change mezzo forte starts izoritmichesky pickup at these moments stop LA Mazel and VA Tsukkerman in his "Analysis of musical works." Pointillism, which originated in the music of the early twentieth century, microforms, found a distant historical</p>
					</div>
					<div class="col-md-5 consulation-right">
								<form>
									<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
									<input type="text" value="Phone " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone';}">
									<input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
									<input type="submit" value="Consultation" />
								</form>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
-->
		<!----//End-consulation----->
		<!----start-testmonials---->
<!--
		<div id="test" class="testmonials">
			<div class="container">
				<div class="head c-head">
						<h3>Testimonials <span> </span></h3>
				</div>
< !----start-testmonials-grids----- >
				<div class="testmonials-grids text-center">
					<div class="col-md-4 testmonial-grid">
						<a href="#"><img class="t-pic" src="images/t1.jpg" title="name" /></a>
						<h5><a href="#">Stev Joni</a></h5>
						<span>Founder Lucoil</span>
						<p>Nice work, Certificates National Association of Realtors (USA).</p>
					</div>
					<div class="col-md-4 testmonial-grid">
						<a href="#"><img class="t-pic" src="images/t2.jpg" title="name" /></a>
						<h5><a href="#">Alisher Usmanov</a></h5>
						<span>Ural Steel</span>
						<p>My soul is illuminated by an unearthly joy, as these beautiful spring morning, which I enjoy with all my heart. I'm all alone and blissfully happy in the local edge.</p>
					</div>
					<div class="col-md-4 testmonial-grid">
						<a href="#"><img class="t-pic" src="images/t3.jpg" title="name" /></a>
						<h5><a href="#">Stev Joni</a></h5>
						<span>Founder Lucoil</span>
						<p>When my lovely valley of steam rises and half-day sun is above an impermeable. thicket</p>
					</div>
					<div class="clearfix"> </div>
				</div>
<! ----//End-testmonials-grids----- >
			</div>
		</div>
-->
		<!----//End-testmonials---->
		<!----start-contact---->
<!--
		<div id="contact" class="contact">
			<div class="container">
				<div class="head">
						<h3>Contact <span> </span></h3>
				</div>
				<div class="contact-grids">
					<div class="col-md-6 contact-left">
						<a href="#">Hello@miami.com</a><br />
						<p>8 800 678 78 78</p>
						<p>8 800 678 78 78</p><br />
						<p><label>400 first ave. n.</label><label>suite 700</label><label>Minneapolis, MN 55401</label> </p>
					</div>
					<div class="col-md-6 contact-right">
								<form>
									<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
									<input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
									<textarea onfocus="if(this.value == 'Message ') this.value='';" onblur="if(this.value == '') this.value='Message *;">Message </textarea>
									<input type="submit" value="write to us" />
								</form>	
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
-->
		<!----//End-contact---->
		<!----start-footer---->
		<div class="footer text-center">
			<div class="container">
				<!--<p class="copy-right">Template by <a href="http://w3layouts.com/">W3layouts</a></p>-->
				
				<p class="txt"> by <a href="#"> hausanfan!!</a> for koding hackathon'2014</p>


				<script type="text/javascript">
				$(document).ready(function() {
					/*
					var defaults = {
			  			containerID: 'toTop', // fading element id
						containerHoverID: 'toTopHover', // fading element hover id
						scrollSpeed: 1200,
						easingType: 'linear' 
			 		};
					*/
					
					$().UItoTop({ easingType: 'easeOutQuart' });
					
				});
			</script>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>


			</div>

		</div>
		<!----//End-footer---->
		<!-----//End-container---->


        <!-- fork me. https://github.com/blog/273-github-ribbons -->
        <a href="http://github.com/mm-s/facemix" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;" src="http://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub" ></a>
	</body>
</html>

