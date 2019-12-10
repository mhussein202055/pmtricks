<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Course Page</title>

  <!-- Mobile Specific Meta -->
  <link rel="icon" href="<?php echo e(asset('img/pmplearning.jpg')); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/owl.carousel.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/fontawesome-all.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/flaticon.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('indexassets/css/meanmenu.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/bootstrap.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/video.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/lightbox.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/progess.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/responsive.css')); ?>">


	<link rel="stylesheet"  href="<?php echo e(asset('indexassets/css/colors/switch.css')); ?>">
	<link href="<?php echo e(asset('indexassets/css/colors/color-2.css')); ?>" rel="alternate stylesheet" type="text/css" title="color-2">
	<link href="<?php echo e(asset('indexassets/css/colors/color-3.css')); ?>" rel="alternate stylesheet" type="text/css" title="color-3">
	<link href="<?php echo e(asset('indexassets/css/colors/color-4.css')); ?>" rel="alternate stylesheet" type="text/css" title="color-4">
	<link href="<?php echo e(asset('indexassets/css/colors/color-5.css')); ?>" rel="alternate stylesheet" type="text/css" title="color-5">
	<link href="<?php echo e(asset('indexassets/css/colors/color-6.css')); ?>" rel="alternate stylesheet" type="text/css" title="color-6">
	<link href="<?php echo e(asset('indexassets/css/colors/color-7.css')); ?>" rel="alternate stylesheet" type="text/css" title="color-7">
	<link href="<?php echo e(asset('indexassets/css/colors/color-8.css')); ?>" rel="alternate stylesheet" type="text/css" title="color-8">
	<link href="<?php echo e(asset('indexassets/css/colors/color-9.css')); ?>" rel="alternate stylesheet" type="text/css" title="color-9">

</head>

<body>

	<div id="preloader"></div>

			<div id="switch-color" class="color-switcher">
		<div class="open"><i class="fas fa-cog fa-spin"></i></div>
		<h4>COLOR OPTION</h4>
		<ul>
			<li><a class="color-2" onclick="setActiveStyleSheet('color-2'); return true;" href="#!"><i class="fas fa-circle"></i></a> </li>
			<li><a class="color-3" onclick="setActiveStyleSheet('color-3'); return true;" href="#!"><i class="fas fa-circle"></i></a> </li>
			<li><a class="color-4" onclick="setActiveStyleSheet('color-4'); return true;" href="#!"><i class="fas fa-circle"></i></a> </li>
			<li><a class="color-5" onclick="setActiveStyleSheet('color-5'); return true;" href="#!"><i class="fas fa-circle"></i></a> </li>
			<li><a class="color-6" onclick="setActiveStyleSheet('color-6'); return true;" href="#!"><i class="fas fa-circle"></i></a> </li>
			<li><a class="color-7" onclick="setActiveStyleSheet('color-7'); return true;" href="#!"><i class="fas fa-circle"></i></a> </li>
			<li><a class="color-8" onclick="setActiveStyleSheet('color-8'); return true;" href="#!"><i class="fas fa-circle"></i></a> </li>
			<li><a class="color-9" onclick="setActiveStyleSheet('color-9'); return true;" href="#!"><i class="fas fa-circle"></i></a> </li>
		</ul>
<!--
		<button class="switcher-light">WIDE </button>
		<button class="switcher-dark">BOX </button>
		<a class="rtl-v" href="RTL_Genius/index.html">RTL </a>
-->
	</div>



	<!-- Start of Header section
		============================================= -->
		<header>
		 <div id="main-menu"  class="main-menu-container">
    <div  class="main-menu">
      <div class="container">
        <div class="navbar-default">
          <div class="navbar-header float-left"> <a class="navbar-brand text-uppercase" href="#">
          <img src="<?php echo e(asset('indexassets/img/logo/logo1.png')); ?>" alt="logo"></a> </div>
          <div class="log-in float-right">
            <!-- The Modal -->
            <div class="modal fade" id="myModal1" tabindex="-2" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content"> 
                  
                  <!-- Modal Header -->
                  <div class="modal-header backgroud-style">
                    <div class="gradient-bg"></div>
                    <div class="popup-logo"> <img src="indexassets/img/logo/p-logo.jpg" alt=""> </div>
                    <div class="popup-text text-center">
                      <h2> <span>Sign Up and Start Learning!</span></h2>
                    </div>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body">
                    <form class="contact_form" action="<?php echo e(route('register')); ?>" method="POST" enctype="multipart/form-data">
                     <?php echo csrf_field(); ?>
                <?php if($errors->has('name')): ?>
                    <span class="alert alert-danger" style="display:block;">
                        <strong><?php echo e($errors->first('name')); ?></strong>
                    </span>
                <?php endif; ?>
                <?php if($errors->has('email')): ?>
                    <span class="alert alert-danger" style="display:block;">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
                <?php if($errors->has('password')): ?>
                    <span class="alert alert-danger" style="display:block;">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                <?php endif; ?>
                <?php if($errors->has('country')): ?>
                    <span class="alert alert-danger" style="display:block;">
                        <strong><?php echo e($errors->first('country')); ?></strong>
                    </span>
                <?php endif; ?>
                <?php if($errors->has('city')): ?>
                    <span class="alert alert-danger" style="display:block;">
                        <strong><?php echo e($errors->first('city')); ?></strong>
                    </span>
                <?php endif; ?>
                <?php if($errors->has('phone')): ?>
                    <span class="alert alert-danger" style="display:block;">
                        <strong><?php echo e($errors->first('phone')); ?></strong>
                    </span>
                <?php endif; ?>
                <div class="contact-info">
                  <input class="name" name="name" value="<?php echo e(old('name')); ?>" type="text" placeholder="Full Name.">
                </div>
                <div class="contact-info">
                  <input class="email" name="email" type="email" value="<?php echo e(old('email')); ?>" placeholder="Email Address.">
                </div>
                     <select class="form-control placeholder-no-fix" placeholder="Country" name="country" value="<?php echo e(old('country')); ?>">
                        <option value="" selected>Select Country ..</option>
                        <option value="United States">United States</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
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
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                      </select>
						
                      <div class="contact-info" style="padding-top: 10px">
                       <input class="name" name="city" value="<?php echo e(old('city')); ?>" type="text" placeholder="City.">
                      </div>
                      <div class="contact-info">
                       <input class="name" name="phone" value="<?php echo e(old('phone')); ?>" type="text" placeholder="Phon Number.">
                      </div>
                      <div class="contact-info">
                       <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" />
                      </div>
                      <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation" />
                      <div class="nws-button text-uppercase text-center white text-capitalize">
                        <button type="submit" value="Submit">SUBMIT REQUEST </button>
                      </div>
						<div class="contact-info" style="font-size: 10px; padding-top: 10px;" >
                      By signing up, you agree to our <a href="<?php echo e(route('terms.show.public')); ?>" style="color: blue; font-size: 10px; padding: 0px; ">Terms of Use</a> and <a href="" style="color: blue; font-size: 10px;padding: 0px;">Privacy Policy</a>
                      </div>
                    </form>
					  <hr>
						<div class="log-in-footer text-center">
						Already have an account? <a data-toggle="modal" data-target="#myModal" href="#" style="color: blue ;padding: 3px;">Log In</a>
						</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="log-in float-right">

               
                

								<!-- The Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">

											<!-- Modal Header -->
											<div class="modal-header backgroud-style">
												<div class="gradient-bg"></div>
												<div class="popup-logo">
													<img src="<?php echo e(asset('indexassets/img/logo/p-logo.jpg')); ?>" alt="">
												</div>
												<div class="popup-text text-center">
													<h2> <span>Login</span> Your Account.</h2>
													<p>Login to our website, or<a href="#about-us"><span>REGISTER</span></a></p>
												</div>
											</div>


											<div class="modal-body">

                                                
                                                
                        <form class="contact_form" action="<?php echo e(route('login')); ?>" method="post">
                          <?php echo e(csrf_field()); ?>

                          <?php if($errors->has('email')): ?>
                              <span class="alert alert-danger" style="display:block">
                                  <strong><?php echo e($errors->first('email')); ?></strong>
                              </span>
                          <?php endif; ?>
                          <?php if($errors->has('password')): ?>
                              <span class="alert alert-danger" style="display:block">
                                  <strong><?php echo e($errors->first('password')); ?></strong>
                              </span>
                          <?php endif; ?>
                          <div class="contact-info">
                            <input class="name <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" type="text" autocomplete="off" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                          </div>
                          <div class="contact-info">
                            <input class="pass <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" type="password" autocomplete="off" placeholder="Password" name="password" required/>
                          </div>
                          <div class="nws-button text-center white text-capitalize" style="margin-bottom: 20px;">
                            <button type="submit" value="Submit">LOg in Now</button> 
                          </div> 
                          <a href="<?php echo e(route('password.request')); ?>" id="forget-password" class="forget-password" style="color: black;">Forgot Password?</a>
                        </form>


                      

											</div>
										</div>
									</div>
								</div>
							</div>

          <nav class="navbar-menu float-right">
            <div class="nav-menu ul-li">
              <ul>
                <li class="menu-item-has-children ul-li-block"> <a href="<?php echo e(route('index')); ?>">Home</a> 
             
                </li>
                <li><a href="#about-us">About Us</a></li>
                <li class="menu-item-has-children ul-li-block"><a href="#">All Courses</a>
                <ul class="sub-menu">
                  <?php $__currentLoopData = \App\Course::where('private', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('package.by.course').'?course_id='.$c->id); ?>"><?php echo e($c->title); ?></a></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                </li>
            <?php if(auth()->guard()->guest()): ?>
            <?php else: ?>
            <li><a href="<?php echo e(route('my.package.view', ['all', 'all'])); ?>">My Courses</a></li>
            <?php endif; ?>
            
            
             <?php if(auth()->guard()->guest()): ?>
             <li>
                  <a  data-toggle="modal" data-target="#myModal" href="#">log in</a><li></li>
                <?php else: ?>
                  <?php if(Auth::guard('web')->check()): ?>
                   <li> <a  href="<?php echo e(route('user.dashboard')); ?>">My Dashboard</a></li>
                  <?php elseif(Auth::guard('admin')->check()): ?>
                  <li>  <a  href="<?php echo e(route('admin.dashboard')); ?>">DashBoard</a></li>
                  <?php endif; ?>
                  
                 <li> <a href="<?php echo e(route('logout')); ?>"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      <?php echo e(__('Logout')); ?>

                  </a></li>
                  <li></li>
                  <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                      <?php echo csrf_field(); ?>
                  </form>
                  </li>
                <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
            <li>
             <a  data-toggle="modal" data-target="#myModal1" href="#">Sign Up </a> 
             </li>
          <?php endif; ?>
              </ul>
            </div>
          </nav>
              <!--start mobile-menu-->
          <div class="mobile-menu">
            <div class="logo"><a href="#"><img src="<?php echo e(asset('indexassets/img/logo/logo1.png')); ?>" alt="Logo"></a></div>
            <nav>
              <ul>
                <li><a href="#">Home</a> </li>
                <li><a href="#about-us">About</a></li>
                <li class="menu-item-has-children ul-li-block"><a href="#">Courses</a>
                <ul>
                  <?php $__currentLoopData = \App\Course::where('private', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('package.by.course').'?course_id='.$c->id); ?>"><?php echo e($c->title); ?></a></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                </li>
                <li><a href="#why-choose">Onilne Course</a></li>
                 <?php if(auth()->guard()->guest()): ?>
             <li>
                  <a  data-toggle="modal" data-target="#myModal" href="#">log in</a> </li>
                <?php else: ?>
                  <?php if(Auth::guard('web')->check()): ?>
                  <li>  <a  href="<?php echo e(route('user.dashboard')); ?>">My Dashboard</a></li>
                  <?php elseif(Auth::guard('admin')->check()): ?>
                  <li>  <a  href="<?php echo e(route('admin.dashboard')); ?>">DashBoard</a></li>
                  <?php endif; ?>
                  <li>
                  <a href="<?php echo e(route('logout')); ?>"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      <?php echo e(__('Logout')); ?>

                  </a>
                        </li>
                  <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                      <?php echo csrf_field(); ?>
                  </form>
                  
                <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
            <li>
             <a  data-toggle="modal" data-target="#myModal1" href="#">Sign Up </a> 
             </li>
          <?php endif; ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
		</header>
 	<!-- Start of Header section
 		============================================= --> 


	<!-- Start of breadcrumb section
		============================================= -->
		<section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
			<div class="blakish-overlay"></div>
			<div class="container">
				<div class="page-breadcrumb-content text-center">
					<div class="page-breadcrumb-title">
						<h2 class="breadcrumb-head black bold">PM <span>tricks</span></h2>
					</div>
					<div class="page-breadcrumb-item ul-li">
						<ul class="breadcrumb text-uppercase black">
							<li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>
							<li class="breadcrumb-item active">Courses</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
	<!-- End of breadcrumb section
		============================================= -->


	<!-- Start of course section
		============================================= -->
		<section id="course-page" class="course-page-section">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="short-filter-tab">
							
							<div class="tab-button blog-button ul-li text-center float-right">
								<ul class="product-tab">
									<li class="active" rel="tab1"><i class="fas fa-th"></i></li>
									<li rel="tab2"> <i class="fas fa-list"></i></li>
								</ul>
							</div>
							
						</div>

						<div class="genius-post-item">
							<div class="tab-container">
								<div id="tab1" class="tab-content-1 pt35">
									<div class="best-course-area best-course-v2">
										<div class="row">
                    <?php $__currentLoopData = $best_sell; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="col-md-4">
												<div class="best-course-pic-text relative-position">
													<div class="best-course-pic relative-position">
                                                        <img src="<?php echo e(url('storage/package/imgs/'.basename($i->package->img))); ?>" alt="">
                                                        <?php if($i->users_no >= 400): ?>
														<div class="trend-badge-2 text-center text-uppercase">
															<i class="fas fa-bolt"></i>
															<span>Trending</span>
                                                        </div>
                                                        <?php endif; ?>
														<div class="course-price text-center gradient-bg">
															<span><?php if($i->package->discount > 0): ?>
																	<i style=" color: red; text-decoration: line-through;"><?php echo e(round($i->package->original_price, 2)); ?>$</i>  |
																	<?php endif; ?>
																	</span>
																	<span class="widget-thumb-body-stat">
																	<?php if($i->package->price > 0): ?>
																		<?php echo e($i->package->price); ?> $
																	<?php else: ?> 
																		Free
																	<?php endif; ?>	</span>
														</div>
														<div class="course-rate ul-li">
															<ul>
																<li style="<?php if($i->total_rate < 1): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
																<li style="<?php if($i->total_rate < 2): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
																<li style="<?php if($i->total_rate < 3): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
																<li style="<?php if($i->total_rate < 4): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
																<li style="<?php if($i->total_rate < 5): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
															</ul>
														</div>
														<div class="course-details-btn">
															<a href="<?php echo e(route('public.package.view', $i->package->id)); ?>">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
														</div>
														<div class="blakish-overlay"></div>
													</div>
													<div class="best-course-text">
														<div class="course-title mb20 headline relative-position">
															<h3><a href="<?php echo e(route('public.package.view', $i->package->id)); ?>"><?php echo e($i->package->name); ?></a></h3>
														</div>
														<div class="course-meta">
															<span class="course-category"><a href="<?php echo e(route('public.package.view', $i->package->id)); ?>"><?php echo e(\App\Course::find(Illuminate\Support\Facades\Input::get('course_id'))->title); ?></a></span>
															<span class="course-author"><a href="#"><?php echo e($i->users_no); ?> Students</a></span>
														</div>
													</div>
												</div>
											</div>
											<!-- /course -->
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
										</div>
									</div>
								</div><!-- /tab-1 -->

								<div id="tab2" class="tab-content-1">
									<div class="course-list-view">
										<table>
											<tr class="list-head">
												<th>COURSE NAME</th>
												<th>COURSE TYPE</th>
												<th>Access</th>
											</tr>
											
											<?php $__currentLoopData = $best_sell; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td>
													<div class="course-list-img-text">
														<div class="course-list-img">
															<img src="<?php echo e(url('storage/package/imgs/'.basename($i->package->img_small))); ?>" alt="">
														</div>
														<div class="course-list-text">
															<h3><a href="<?php echo e(route('public.package.view', $i->package->id)); ?>"><?php echo e($i->package->name); ?></a></h3>
															<div class="course-meta">
																<span class="course-category bold-font"><a>
																	<?php if($i->package->discount > 0): ?>
																	instead of <i style=" color: red; text-decoration: line-through;"><?php echo e(round($i->package->original_price, 2)); ?></i> $
																	<?php endif; ?>
																	</span>
																	<span class="widget-thumb-body-stat">
																	<?php if($i->package->price > 0): ?>
																		<?php echo e($i->package->price); ?> $
																	<?php else: ?> 
																		Free
																	<?php endif; ?>	
																</a></span>
																<br>
																<div class="course-rate ul-li">
																	<ul style="color:#ffc926 !important;">
																		<li style="<?php if($i->total_rate < 1): ?>color:black !important; <?php else: ?> color:#ffc926 !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
																		<li style="<?php if($i->total_rate < 2): ?>color:black !important; <?php else: ?> color:#ffc926 !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
																		<li style="<?php if($i->total_rate < 3): ?>color:black !important; <?php else: ?> color:#ffc926 !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
																		<li style="<?php if($i->total_rate < 4): ?>color:black !important; <?php else: ?> color:#ffc926 !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
																		<li style="<?php if($i->total_rate < 5): ?>color:black !important; <?php else: ?> color:#ffc926 !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</td>
												<td>
													<div class="course-type-list">
														
														<span><?php echo e(\App\Course::find($i->package->course_id)->title); ?></span>
													
													</div>
												</td>
												<td><?php echo e($i->package->expire_in_days); ?> days</td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
										</table>
									</div>
								</div><!-- /tab-2 -->
							</div>
						</div>

						
					</div>

					<div class="col-md-3">
						<div class="side-bar">

							<div class="side-bar-widget  first-widget">
								<h2 class="widget-title text-capitalize"><span>Find </span>Your Course.</h2>
								<div class="listing-filter-form pb30">
									<form action="#" method="get">
										<div class="filter-select mb20">
											<label>COURSE TYPE</label>
											<select name="course_id">
												<?php $__currentLoopData = \App\Course::where('private', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(Illuminate\Support\Facades\Input::get('course_id') == $c->id): ?> selected <?php endif; ?> value="<?php echo e($c->id); ?>"><?php echo e($c->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>

										
											<input value="FIND COURSES" style="padding: 0 !important; color:white;" type="submit" class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font"/>
										
									</form>

								</div>
							</div>

							

							<div class="side-bar-widget">
								<h2 class="widget-title text-capitalize"><span>Featured</span> Course.</h2>
								<div class="featured-course">
									<div class="best-course-pic-text relative-position">
										<div class="best-course-pic relative-position">
											<img src="<?php echo e(url('storage/package/imgs/'.basename($best_sell[0]->package->img))); ?>" alt="">
											<?php if($best_sell[0]->users_no >= 400): ?>
											<div class="trend-badge-2 text-center text-uppercase">
												<i class="fas fa-bolt"></i>
												<span>Trending</span>
											</div>
											<?php endif; ?>
										</div>
										<div class="best-course-text">
											<div class="course-title mb20 headline relative-position">
												<h3><a href="<?php echo e(route('public.package.view', $best_sell[0]->package->id)); ?>"><?php echo e($best_sell[0]->package->name); ?></a></h3>
											</div>
											<div class="course-meta">
												<span class="course-category"><a href="<?php echo e(route('public.package.view', $best_sell[0]->package->id)); ?>"><?php echo e(\App\Course::find($best_sell[0]->package->course_id)->title); ?></a></span>
												<span class="course-author"><a href="#"><?php echo e($best_sell[0]->users_no); ?> Students</a></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- End of course section
		============================================= -->


		

	<!-- Start of footer section
		============================================= -->
		<footer>
			<section id="footer-area" class="footer-area-section">
				<div class="container">
					

					<div class="copy-right-menu">
						<div class="row">
							<div class="col-md-6">
								<div class="copy-right-text">
									<p>© 2018 - www.GeniusCourse.com. All rights reserved</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="copy-right-menu-item float-right ul-li">
									<ul>
										<li><a href="#">License</a></li>
										<li><a href="#">Privacy & Policy</a></li>
										<li><a href="#">Term Of Service</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</footer>
	<!-- End of footer section
		============================================= -->



		<!-- For Js Library -->
		<script src="<?php echo e(asset('indexassets/js/jquery-2.1.4.min.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/bootstrap.min.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/owl.carousel.min.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/jarallax.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/jquery.magnific-popup.min.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/lightbox.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/jquery.meanmenu.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/scrollreveal.min.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/jquery.counterup.min.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/waypoints.min.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/jquery-ui.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/gmap3.min.js')); ?>"></script>
		<script src="<?php echo e(asset('indexassets/js/switch.js')); ?>"></script>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyC61_QVqt9LAhwFdlQmsNwi5aUJy9B2SyA"></script>

    	<script src="<?php echo e(asset('indexassets/js/script.js')); ?>"></script>
	</body>
	</html>