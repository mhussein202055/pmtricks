<!DOCTYPE html>
<html lang="en">
<head>
	<title>PM-Tricks</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('comingsoon/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="{{asset('comingsoon/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/vendor/countdowntime/flipclock.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="bg-img1 size1 overlay1 p-b-35 p-l-15 p-r-15" style="background-image: url('{{asset('comingsoon/images/bg01.jpg')}}');">
		<div class="flex-col-c p-t-160 p-b-215 respon1">
			<div class="wrappic1">
			<h2 style="color: #FFFFFF">PM-TRICKS</h2>
				<!--<a href="#">
				
					<img src="images/icons/logo.png" alt="IMG"> 
				</a>-->
			</div>

			<h3 class="l1-txt1 txt-center p-t-30 p-b-100">
				Coming Soon
			</h3>

			<div class="cd100"></div>
		
<h3 class="l1-txt1 txt-center p-t-30 p-b-100">
				Your journey to success starts here
			</h3>
		</div>

		<!--  -->
		<div class="flex-w flex-c-m p-b-35">
		
			<!--<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
				<i class="fa fa-facebook"></i>
			</a>

			<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
				<i class="fa fa-twitter"></i>
			</a>

			<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
				<i class="fa fa-youtube-play"></i>
			</a>-->
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="{{ asset('comingsoon/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{ asset('comingsoon/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/vendor/countdowntime/flipclock.min.js')}}"></script>
	<script src="{{ asset('comingsoon/vendor/countdowntime/moment.min.js')}}"></script>
	<script src="{{ asset('comingsoon/vendor/countdowntime/moment-timezone.min.js')}}"></script>
	<script src="{{ asset('comingsoon/vendor/countdowntime/moment-timezone-with-data.min.js')}}"></script>
	<script src="{{ asset('comingsoon/vendor/countdowntime/countdowntime.js')}}"></script>
	<script>
	$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear:0,
			endtimeMonth: 0,
			endtimeDate: 0,
			endtimeHours: 0,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: "" 
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
//		function _(ele){
//			return document.getElementById(ele);
//		}
//		
//		
//		var countDownDate = new Date("May 4, 2019 00:00:00").getTime();
//
//		// Update the count down every 1 second
//		var x = setInterval(function() {
//
//			// Get todays date and time
//			var now = new Date().getTime();
//
//			// Find the distance between now and the count down date
//			var distance = countDownDate - now;
//
//			// Time calculations for days, hours, minutes and seconds
//			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
//
//			// Output the result in an element with id="demo"
//			_('day').innerHTML = days;
//			_('hr').innerHTML = hours;
//			_('min').innerHTML = minutes;
//			_('sec').innerHTML = seconds;
//
//			// If the count down is over, write some text 
//			if (distance < 0) {
//				clearInterval(x);
////				document.getElementById("demo").innerHTML = "EXPIRED";
//			}
//		}, 1000);


		
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/js/main.js"></script>

</body>
</html>