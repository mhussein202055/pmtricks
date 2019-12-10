<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PM-TRICKS-</title>

<!-- Mobile Specific Meta -->
<link rel="icon" href="<?php echo e(asset('img/pmplearning.jpg')); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/owl.carousel.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/fontawesome-all.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/flaticon.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('indexassets/css/meanmenu.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/video.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('indexassets/css/animate.min.css')); ?>">
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
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N9L8423');</script>
<!-- End Google Tag Manager -->
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N9L8423"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
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


<header>
  <div id="main-menu"  class="main-menu-container">
    <div  class="main-menu">
      <div class="container">
        <div class="navbar-default">
          <div class="navbar-header float-left"> <a class="navbar-brand text-uppercase" href="#">
          <img src="<?php echo e(asset('indexassets/img/logo/logo1.png')); ?>" alt="logo" style="width: 250 px;height: 50px"></a> </div>
          <div class="log-in float-right">
            <!-- The Modal -->
            
            
            
            <div class="modal fade" id="myModal1" tabindex="-2" role="dialog" aria-hidden="true">
            
              <div class="modal-dialog">
                <div class="modal-content"> 
                  
                  <!-- Modal Header -->
                  <div class="modal-header backgroud-style">
                    <div class="gradient-bg"></div>
                    <div class="popup-logo"> <img src="indexassets/img/logo/p-logo.png" alt="logo" style="width: 72 px;height: 68px"> </div>
                    <div class="popup-text text-center">
                      <h2> <span>Sign Up and Start Learning!</span></h2>
                    </div>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body">
                    <form class="contact_form" action="<?php echo e(route('register')); ?>" method="POST" enctype="multipart/form-data">
                     <?php echo csrf_field(); ?>
                     <?php if(\Session('process') == 'register'): ?>
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
                
                
                
                <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                
								
									<div class="modal-dialog">
										<div class="modal-content">

											<!-- Modal Header -->
											<div class="modal-header backgroud-style">
												<div class="gradient-bg"></div>
												<div class="popup-logo">
												 <img src="indexassets/img/logo/p-logo.png" alt="logo" style="width: 72 px;height: 68px"> 
												</div>
												<div class="popup-text text-center">
													<h2> <span>Login</span> Your Account.</h2>
													<p>Login to our website, or<a data-toggle="modal" data-target="#myModal1" href="#" data-dismiss="modal"><span>REGISTER</span></a></p>
												</div>
											</div>


											<div class="modal-body">

                                                
                                                
                        <form class="contact_form" action="<?php echo e(route('login')); ?>" method="post">
                          <?php echo e(csrf_field()); ?>

                          <?php if(\Session('process') == 'login'): ?>
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

<!-- Start of slider section
		============================================= -->
<section id="slide" class="slider-section">
  <div id="slider-item" class="slider-item-details">
    <div  class="slider-area slider-bg-5 relative-position">
      <div class="slider-text">
        <div class="section-title mb20 headline text-left ">
          <div class="layer-1-1"> </div>
          <div class="layer-1-3">
            <h2><span>LET ME </span> HELP YOU PASS  <br>
              <span>THE PMP EXAM!</span></h2>
          </div>
          
        </div>
        <div class="layer-1-4">
          <div class="genius-btn  text-center text-uppercase ul-li-block bold-font"> <a href="#popular-course">Enroll popular-courses <i class="fas fa-caret-right"></i></a> </div>

        </div>
      </div>
    </div>
   <div class="slider-area slider-bg-2 relative-position">
					<div class="slider-text">
						<div class="section-title mb20 headline text-center ">
							<div class="layer-1-1">
								<span class="subtitle text-uppercase">EDUCATION & TRAINING ORGANIZATION</span>
							</div>
							<div class="layer-1-2">
								<h2 class="secoud-title"> Browse The <span>Best Courses.</span></h2>
							</div>
						</div>
						<div class="layer-1-3">
							<div class="search-course mb30 relative-position">
								<form action="#" method="post">
									<input class="course" name="course" type="text" placeholder="Type what do you want to learn today?">
									<div class="nws-button text-center  gradient-bg text-capitalize">
										<button type="submit" value="Submit">Search Course</button> 
									</div>
								</form>
							</div>
						<div class="layer-1-4">
								<div class="slider-course-category ul-li text-center">
									<span class="float-left">BY CATEGORY:</span>
									<ul style="text-align: left">
										<li>PMI-PMP</li>
										<li>PMI-RMP</li>
										<li>PMI-SP</li>
										
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
    <div class="slider-area slider-bg-3 relative-position">
      <div class="slider-text">
        <div class="layer-1-2">
          <div class="coming-countdown ul-li">
            <ul>
              <li class="days"> <span class="number"></span> <span class>Days</span> </li>
              <li class="hours"> <span class="number"></span> <span class>Hours</span> </li>
              <li class="minutes"> <span class="number"></span> <span class>Minutes</span> </li>
              <li class="seconds"> <span class="number"></span> <span class>Seconds</span> </li>
            </ul>
          </div>
        </div>
        <div class="section-title mb20 headline text-center ">
          <div class="layer-1-3">
            <h2 class="third-slide"> Mobile Application Experiences : <br>
              <span>Mobile App Design.</span></h2>
          </div>
        </div>
        <div class="layer-1-4">
							<div class="about-btn text-center">
								<div class="genius-btn text-center text-uppercase ul-li-block bold-font " style="border: none; ">
									<a href="#"><img class="aligncenter" title="get_it_on_play_logo_large" src="assets1/img/banner/gplay.png" alt="Get it on google play"></a>
<!--									<a href="#">About Us <i class="fas fa-caret-right"></i></a>-->
								</div>
								<div class="genius-btn text-center text-uppercase ul-li-block bold-font" style="border: none">
									<a href="#"><img class="aligncenter" title="get_it_on_play_logo_large" src="assets1/img/banner/appstor.png" alt="Get it on google play"></a>
<!--									<a href="#">contact us <i class="fas fa-caret-right"></i></a>-->
								</div>
							</div>
						</div>
      </div>
    </div>
    <!--<div class="slider-area slider-bg-4 relative-position">-->
    <!--  <div class="slider-text">-->
    <!--    <div class="section-title mb20 headline text-center "> <span class="subtitle text-uppercase"></span>-->
    <!--      <h2 class=""  ><span>Inventive</span> Solution <br>-->
    <!--        for <span>Education</span></h2>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
  </div>
</section>
<!-- End of slider section
		============================================= --> 

<!-- Start of Search Courses
		============================================= -->
<section id="search-course" class="search-course-section search-course-third">
  <div class="container">
    <div class="search-counter-up">
      <div class="version-four">
        <div class="row">
          <div class="col-md-3">
            <div class="counter-icon-number">
              <div class="counter-icon"> <i class="text-gradiant flaticon-graduation-hat"></i> </div>
              <div class="counter-number"> <span class="counter-count bold-font"><?php echo e(count(\App\User::all())); ?> </span><span>+</span>
                <p>Students Enrolled</p>
              </div>
            </div>
          </div>
          <!-- /counter -->
          
          <div class="col-md-3">
            <div class="counter-icon-number">
              <div class="counter-icon"> <i class="text-gradiant flaticon-book"></i> </div>
              <div class="counter-number"> <span class="counter-count bold-font"><?php echo e(count(\App\Packages::where('active',1)->get())); ?></span><span>+</span>
                <p>Online Available Courses</p>
              </div>
            </div>
          </div>
          <!-- /counter -->
          
          <div class="col-md-3">
            <div class="counter-icon-number">
              <div class="counter-icon"> <i class="text-gradiant flaticon-favorites-button"></i> </div>
              <div class="counter-number"> <span class="counter-count bold-font">24</span><span>/7</span>
                <p>Support and Assistance</p>
              </div>
            </div>
          </div>
          <!-- /counter -->
          
          <div class="col-md-3">
            <div class="counter-icon-number">
              <div class="counter-icon"> <i class="text-gradiant flaticon-group"></i> </div>
              <div class="counter-number"> <span class="counter-count bold-font">500</span><span>+</span>
                <p>Passed Students</p>
              </div>
            </div>
          </div>
          <!-- /counter --> 
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End of Search Courses
    ============================================= --> 
    


<!-- Start MY course
    ============================================= -->

<!-- End popular course
    ============================================= --> 

<!-- Start popular course best_sell
    ============================================= -->
    

    <?php if(Auth::guard('web')->check()): ?>
    <section id="popular-course" class="popular-course-section popular-three">


  
      
    <div class="container">
      <div class="section-title mb20 headline text-left">
  <!--     <span class="subtitle text-uppercase">LEARN NEW SKILLS</span>-->
      <h2 ><span class="subtitle text-uppercase" >My Coursess</span></h2>
      </div>
      <div id="course-slide-item" class="course-slide">
        <?php $__currentLoopData = $my_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="course-item-pic-text">
          <div class="course-pic relative-position mb25"> <img src="<?php echo e(url('storage/package/imgs/'.basename($i->package->img))); ?>" alt="">
          
            
            <div class="course-details-btn"> <a href="<?php if($i->package->contant_type == 'question'): ?><?php echo e(route('attach.package', $i->package->id)); ?><?php elseif($i->package->contant_type == 'video'||$i->package->contant_type =='combined'): ?><?php echo e(route('st4_vid', [$i->package->id, 'chapter', explode(',',\App\Packages::find($i->package->id)->chapter_included)[0] , \App\Video::where('chapter',explode(',',\App\Packages::find($i->package->id)->chapter_included)[0])->get()->first()->id])); ?><?php endif; ?>">COURSE DETAIL  <i class="fas fa-arrow-right"></i></a> </div>
          </div>
          <div class="course-item-text">
            <div class="course-meta"> <span class="course-category bold-font"><a href="#"><?php echo e(\App\Course::find($i->package->course_id)->title); ?></a></span> <span class="course-author bold-font"><a href="#">Sayed Mohsen</a></span>
              <div class="course-rate ul-li">
                <ul>
                  <li style="<?php if($i->total_rate < 1): ?>color:black !important;<?php endif; ?>"><i class="fa fa-star"></i></li>
                  <li style="<?php if($i->total_rate < 2): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                  <li style="<?php if($i->total_rate < 3): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                  <li style="<?php if($i->total_rate < 4): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                  <li style="<?php if($i->total_rate < 5): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                </ul>
              </div>
            </div>
            <div class="course-title mt10 headline pb45 relative-position">
              <h3><a href="<?php if($i->package->contant_type == 'question'): ?><?php echo e(route('attach.package', $i->package->id)); ?><?php elseif($i->package->contant_type == 'video' ||$i->package->contant_type =='combined'): ?><?php echo e(route('st4_vid', [$i->package->id, 'chapter', explode(',',\App\Packages::find($i->package->id)->chapter_included)[0] , \App\Video::where('chapter',explode(',',\App\Packages::find($i->package->id)->chapter_included)[0])->get()->first()->id])); ?><?php endif; ?>"><?php echo e($i->package->name); ?>.</a> 
                <?php if($i->users_no >= 400): ?>
                <span class="trend-badge text-uppercase bold-font">
                
                <i class="fas fa-bolt"></i> TRENDING </span><?php endif; ?>
              </h3>
            </div>
            <div class="course-viewer ul-li">
              <ul>
                <li><a href=""><i class="fas fa-user"></i> <?php echo e($i->users_no); ?></a></li>
                <li><a href=""><i class="fas fa-comment-dots"></i> <?php echo e(count(\App\Rating::where('package_id', $i->package->id)->get())); ?></a></li>
                
              </ul>
            </div>
          </div>
        </div>
        <!-- /item -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        
      </div>
    </div>
    
      
    </section>
    <?php endif; ?>

    <section id="my-course" class="popular-course-section popular-three">
    
        <div class="container">
            <div class="section-title mb20 headline text-left">
        <!--     <span class="subtitle text-uppercase">LEARN NEW SKILLS</span>-->
            <h2 ><span class="subtitle text-uppercase" >Popular Courses</span></h2>
            </div>
            <div id="course-slide-item1" class="course-slide">
              <?php $__currentLoopData = $best_sell; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="course-item-pic-text">
                <div class="course-pic relative-position mb25"> <img src="<?php echo e(url('storage/package/imgs/'.basename($i->package->img))); ?>" alt="">
                  <?php if($i->users_no >= 400): ?>
                    <div class="trend-badge-2 text-center text-uppercase">
                      <i class="fas fa-bolt"></i>
                      <span>Trending</span>
                  </div>
                  <?php endif; ?>
                  <div class="course-price text-center gradient-bg" style=" position:static;padding: 15px !important;"> <span>
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
                  </span> </div>
                  
                  <div class="course-details-btn"> <a href="<?php echo e(route('public.package.view', $i->package->id)); ?>">COURSE DETAIL  <i class="fas fa-arrow-right"></i></a> </div>
                </div>
                <div class="course-item-text">
                  <div class="course-meta"> <span class="course-category bold-font"><a href="#"><?php echo e(\App\Course::find($i->package->course_id)->title); ?></a></span> <span class="course-author bold-font"><a href="#">Sayed Mohsen</a></span>
                    <div class="course-rate ul-li">
                      <ul>
                        <li style="<?php if($i->total_rate < 1): ?>color:black !important;<?php endif; ?>"><i class="fa fa-star"></i></li>
                        <li style="<?php if($i->total_rate < 2): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                        <li style="<?php if($i->total_rate < 3): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                        <li style="<?php if($i->total_rate < 4): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                        <li style="<?php if($i->total_rate < 5): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="course-title mt10 headline pb45 relative-position">
                    <h3><a href="<?php echo e(route('public.package.view', $i->package->id)); ?>"><?php echo e($i->package->name); ?>.</a> 
                      
                    </h3>
                  </div>
                  <div class="course-viewer ul-li">
                    <ul>
                      <li><a href=""><i class="fas fa-user"></i> <?php echo e($i->users_no); ?></a></li>
                      <li><a href=""><i class="fas fa-comment-dots"></i> <?php echo e(count(\App\Rating::where('package_id', $i->package->id)->get())); ?></a></li>
                      
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /item -->
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
              
            </div>
          </div>
        </section>
    
<!-- End popular course
		============================================= --> 

<!-- Start why choose section
		============================================= -->
<section id="why-choose" class="why-choose-section version-four backgroud-style">
  <div class="container">
    <div class="section-title mb20 headline text-center"> <span class="subtitle text-uppercase">PMP <sup _ngcontent-ket-c1="">®</sup>Online Course</span>
      <h2>Enroll in PMP <sup _ngcontent-ket-c1="">®</sup>Online Course <span>Lead by <br>
        Elsayed Mohsen.</span></h2>
    </div>
    <div class="extra-features-content">
      <div class="row">
        <div class="col-md-4 col-sm-6">
          <div class="extra-left">
            <div class="extra-left-content">
              <div class="extra-icon-text text-left">
                <div class="features-icon gradient-bg text-center"> <i class="fa fa-graduation-cap"></i>
                  <div class="feat-tag"> <span>01</span> </div>
                </div>
                <div class="features-text">
                  <div class="features-text-title">
                    <h3>Step1</h3>
                  </div>
                  <div class="features-text-dec"> <span>Attend a live class <br>
                  <!--<sup _ngcontent-ket-c1="">®</sup>-->
                    <br>
                    </span> </div>
                </div>
              </div>
            </div>
            <!-- // extra-left-content -->
            
            <div class="extra-left-content">
              <div class="extra-icon-text">
                <div class="features-icon gradient-bg text-center"> <i class="fas fa-hourglass-half"></i>
                  <div class="feat-tag"> <span>02</span> </div>
                </div>
                <div class="features-text pt25">
                  <div class="features-text-title">
                    <h3>Step 2</h3>
                  </div>
                  <div class="features-text-dec"> <span>Attend recorded lectures by chapter<br>
                    <br>
                    </span> </div>
                </div>
              </div>
            </div>
            <!-- // extra-left-content -->
            
            <div class="extra-left-content">
              <div class="extra-icon-text">
                <div class="features-icon gradient-bg text-center"> <i class="far fa-star"></i>
                  <div class="feat-tag"> <span>03</span> </div>
                </div>
                <div class="features-text pt25">
                  <div class="features-text-title">
                    <h3>Step 3</h3>
                  </div>
                  <div class="features-text-dec"> <span>Study chapter by chapter, the PMBOK guide. V6
                    </span> 
                  </div>
                </div>
              </div>
            </div>
            <div class="extra-left-content">
              <div class="extra-icon-text">
                <div class="features-icon gradient-bg text-center"> <i class="fas fa-question-circle"></i>
                  <div class="feat-tag"> <span>04</span> </div>
                </div>
                <div class="features-text pt25">
                  <div class="features-text-title">
                    <h3>Step 4</h3>
                  </div>
                  <div class="features-text-dec"> <span> After you finish each chapter, practice questions on that chapter.
                    </span>
                    <br>
                    <br>
                    <br>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="about-btn text-center">
              <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font"> <a href="#">Check Availability <i class="fas fa-caret-right"></i></a> </div>
            </div>
           
            
            <!-- // extra-left-content --> 
          </div>
          <!-- /extra-left --> 
        </div>
        <!-- /col-sm-3 -->
        
        <div class="col-sm-4">
          <div class="extra-pic text-center"> <img src="<?php echo e(asset('indexassets/img/banner/wc-2.png')); ?>" alt="img"> </div>
        </div>
        <!-- /col-sm-6 -->
        
        <div class="col-md-4 col-sm-6">
          <div class="extra-right">
            <div class="extra-left-content">
              <div class="extra-icon-text text-right">
                <div class="features-icon gradient-bg text-center"> <i class="fa fa-level-down-alt"></i>
                  <div class="feat-tag"> <span>05</span> </div>
                </div>
                <div class="features-text pt25">
                  <div class="features-text-title text-right pb10">
                    <h3>Step 5</h3>
                  </div>
                  <div class="features-text-dec text-right"> <span>Review each process group, the PMBOK guide. V6</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- // extra-left-content -->
            
            <div class="extra-left-content">
              <div class="extra-icon-text text-right">
                <div class="features-icon gradient-bg text-center"> <i class="fa fa-clock"></i> 
                  <div class="feat-tag"> <span>06</span> </div>
                </div>
                <div class="features-text pt25">
                  <div class="features-text-title text-right pb10">
                    <h3>Step 6</h3>
                  </div>
                  <div class="features-text-dec text-right"> <span>After you finish each process group, practice questions on that process.</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- // extra-left-content -->
            
            <div class="extra-left-content">
              <div class="extra-icon-text text-right">
                <div class="features-icon gradient-bg text-center"> <i class="fas fa-list-ul"></i>
                  <div class="feat-tag"> <span>07</span> </div>
                </div>
                <div class="features-text pt25">
                  <div class="features-text-title text-right pb10">
                    <h3>Step 7</h3>
                  </div>
                  <div class="features-text-dec text-right"> <span>Complete 3+ Full-Length Mocks <br>
                    </span> 
                  </div>
                </div>
              </div>
            </div>
              <div class="extra-left-content">
              <div class="extra-icon-text text-right">
                <div class="features-icon gradient-bg text-center"><i class="fas fa-redo-alt"></i>
                  <div class="feat-tag"> <span>08</span> </div>
                </div>
                <div class="features-text pt25">
                  <div class="features-text-title text-right pb10">
                    <h3>Step 8</h3>
                  </div>
                  <div class="features-text-dec text-right"> <span>Repeat above Step till your score 85-90% in your full exams. 
                    
                    </span> 
                  </div>
                </div>
              </div>
            </div>
                 <div class="extra-left-content">
              <div class="extra-icon-text text-right">
                <div class="features-icon gradient-bg text-center"><i class="fas fa-trophy"></i>
                  <div class="feat-tag"> <span></span> </div>
                </div>
                <div class="features-text pt25">
                  <div class="features-text-title text-right pb10">
                    <h3>Finish</h3>
                  </div>
                  <div class="features-text-dec text-right"> <span>Pass and get the three letter word PMP® after your name. 
                    
                    </span> 
                  </div>
                </div>
              </div>
            </div>
         
            <!-- // extra-left-content --> 
          </div>
          <!-- /extra-left --> 
        </div>
        <!-- /col-sm-3 --> 
      </div>
      <!-- /row --> 
    </div>
  </div>
</section>
<!-- End why choose section
    ============================================= --> 

    <section id="course-category" class="course-category-section">
			<div class="container">
				<div class="section-title mb45 headline text-center "  >
					<!--<span class="subtitle text-uppercase">COURSES CATEGORIES</span>-->
					<h2><span class="subtitle text-uppercase" >Browse Courses<span> By Category.</span></span></h2>
				</div>
				<div class="category-item">
					<div class="row">
						<div class="col-md-4">
							<div class="category-icon-title text-center "  >
								<div class="category-icon">
                <a href="<?php echo e(route('package.by.course')); ?>?course_id=2">
                  <img src="<?php echo e(asset('indexassets/img/course/PMP.png')); ?>" alt="PMP" />
  <!--									<i class="text-gradiant flaticon-technology"></i>-->
                </a>
								</div>
								<div class="category-title">
									
								</div>
							</div>
						</div>
						<!-- /category -->

						<div class="col-md-4">
							<div class="category-icon-title text-center "  >
								<div class="category-icon">
                <a href="<?php echo e(route('package.by.course')); ?>?course_id=6">
								<img src="<?php echo e(asset('indexassets/img/course/Sceau_certification_v3-07.png')); ?>" alt="PMP" />
<!--									<i class="text-gradiant flaticon-technology"></i>-->
                </a>
								</div>
								<div class="category-title">
									
								</div>
							</div>
						</div>
						<!-- /category -->

						<div class="col-md-4">
							<div class="category-icon-title text-center "  >
								<a href="404.html"><div class="category-icon">
                  <a href="<?php echo e(route('package.by.course')); ?>?course_id=7">
                  <img src="<?php echo e(asset('indexassets/img/course/Sceau_certification_v3-08.png')); ?>" alt="SP" />
                  </a>
								</div>
								<div class="category-title">
									
								</div></a>
							</div>
						</div>
						<!-- /category -->
					</div>
				</div>
			</div>
		</section>
	<!-- End Course category
		============================================= -->

<!-- Start of about us section
		============================================= -->
<section id="about-us" class="faq-section faq-secound-home-version backgroud-style">
  <div class="container" style="color: white !important;">
    <div class="row">








      <!-- /form -->
      
      <div class="col-md-12">
        <div class="about-us-text">
          <div class="section-title relative-position mb20 headline text-left"><h2> <span class="subtitle ml42 text-uppercase"> ABOUT US</span></h2>
            
            <p style="color:white;">PM-TRICKS.com is one of the world’s leading certification training providers. We partner with companies and individuals to address their unique needs, providing training and coaching that helps working professionals achieve their career goals.</p>
          </div>
          <div class="about-content-text">
            <p style="color: white;">I am developing this Blog to help as my way of giving back to the Project Management Community and to the professionals who want to become a PMP, PMI-RMP, and PMI-SP. In this blog you can find all necessary study material relevant to the Project Management Professional (PMP), Risk Management Professional(PMI-RMP) and Scheduling Professional (PMI-SP) certification exam preparation.
              I hope that these study materials and notes are thorough enough for you to take and run with. With that said, please bear in mind that I am a human, and even though I am taking the utmost care to give you correct and accurate information, forgive me for any inaccuracy. I would appreciate if you notify me so I can correct any information, and tell me what I should do to improve this blog to help the project management community at large.</p>
            <div class="about-list mb65 ul-li-block"> I hope you enjoy visiting my site and find it useful for your studies and for further knowledge advancement.<br>
              Thank you.<br>
              Eng. Elsayed Mohsen, PMP, PMI-RMP, PMI-SP<br>
              Sayed@pm-tricks.com </div>
            <div class="about-btn"> 
              <!--              <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font"> <a href="#">About Us <i class="fas fa-caret-right"></i></a> </div>-->

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
    <section id="faq" class=" about-us-section home-secound home-third">
        <div class="container">
            <div class="section-title mb45 headline text-center">
                <!--<span class="subtitle text-uppercase">Pm-tricks COURSE FAQ</span>-->
                <!--<h2 >Frequently<span> Ask & Questions</span></h2>-->
                <h3> <span class="subtitle ml42 text-uppercase ">Easy To Use</span></h3>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <iframe id="player1" src="https://player.vimeo.com/video/362151649?api=1&player_id=player1" width="100%" height="400px" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                </div>
                <div class="col-md-6">
                    <iframe id="player1" src="https://player.vimeo.com/video/361677134?api=1&player_id=player1" width="100%" height="400px" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </section>
<!-- End of about us section
		============================================= --> 
<!-- Start of why choose us section
		============================================= -->
		<!--<section id="why-choose-us" class="why-choose-us-section">-->
		<!--	<div class="jarallax  backgroud-style">-->
		<!--		<div class="container">-->
		<!--			<div class="section-title mb20 headline text-center "  >-->
		<!--				<span class="subtitle text-uppercase">Pm-tricks ADVANTAGES</span>-->
		<!--				<h2>Reason <span>Why Choose Pm-tricks.</span></h2>-->
		<!--			</div>-->
		<!--			<div id="service-slide-item" class="service-slide">-->
		<!--				<div class="service-text-icon "  >-->
		<!--					<div class="service-icon float-left">-->
		<!--						<i class="text-gradiant flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i>-->
		<!--					</div>-->
		<!--					<div class="service-text">-->
		<!--						<h3 class="bold-font">The Power Of Education.</h3>-->
		<!--						<p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod tincidun laoreet.</p>-->
		<!--					</div>-->
		<!--				</div>-->
		<!--				<div class="service-text-icon "  >-->
		<!--					<div class="service-icon float-left">-->
		<!--						<i class="text-gradiant flaticon-clipboard-with-pencil"></i>-->
		<!--					</div>-->
		<!--					<div class="service-text">-->
		<!--						<h3 class="bold-font">Best Online Education.</h3>-->
		<!--						<p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod tincidun laoreet.</p>-->
		<!--					</div>-->
		<!--				</div>-->
		<!--				<div class="service-text-icon "  >-->
		<!--					<div class="service-icon float-left">-->
		<!--						<i class="text-gradiant flaticon-list"></i>-->
		<!--					</div>-->
		<!--					<div class="service-text">-->
		<!--						<h3 class="bold-font">Education For All Student.</h3>-->
		<!--						<p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod tincidun laoreet.</p>-->
		<!--					</div>-->
		<!--				</div>-->
						
		<!--			</div>-->
		<!--		    </div>-->
		<!--		</div>-->
		<!--</section>-->
		
<!-- Start of Search Courses
		============================================= -->
<!--<section id="search-course-2" class="search-course-section home-third-course-search backgroud-style">-->
<!--  <div class="container">-->
<!--    <div class="section-title mb20 headline text-center"> <span class="subtitle text-uppercase">Mobile Apps</span> -->
<!--    </div>-->
<!--    <div class="search-app">-->
<!--      <div class="row">-->
<!--        <div class="col-md-6">-->
<!--          <div class="app-mock-up"> <img src="<?php echo e(asset('indexassets/img/about/ab-2.png')); ?>" alt=""> </div>-->
<!--        </div>-->
<!--        <div class="col-md-6">-->
<!--          <div class="about-us-text search-app-content">-->
<!--            <div class="section-title relative-position mb20 headline text-left">-->
<!--              <h2><span>Download</span> PM-TRiCKS Application on <span>PlayStore.</span></h2>-->
<!--            </div>-->
<!--            <div class="app-details-content">-->
<!--              <p>Welcom to the world of PMP<sup _ngcontent-ket-c1="">®</sup> Certification .</p>-->
<!--              <div class="about-list mb30 ul-li-block">-->
<!--                <ul>-->
<!--                  <li>150+ videos</li>-->
<!--                  <li>4 full length tests ( 800 Questions )</li>-->
<!--                  <li>11 chapter tests </li>-->
<!--                </ul>-->
<!--              </div>-->
<!--              <div class="about-btn">-->
<!--                <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font"> <a href="#">GET THE APP NOW <i class="fas fa-caret-right"></i></a> </div>-->
<!--                <div class="app-stor ul-li">-->
<!--                  <ul>-->
<!--                    <li><a href="#"><i class="fab fa-android"></i></a></li>-->
<!--                    <li><a href="#"><i class="fab fa-apple"></i></a></li>-->
<!--                    <li><a href="#"><i class="fab fa-windows"></i></a></li>-->
<!--                  </ul>-->
<!--                </div>-->
<!--              </div>-->
<!--              <h7 style="color:red"> Coming Soon</h7>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</section>-->
<!-- End of Search Courses
		============================================= --> 
	<!-- End of why choose us section
		============================================= -->
	


		<!-- Start FAQ section
		============================================= -->
		<section id="faq" class="faq-section faq-secound-home-version backgroud-style">
			<div class="container">
				<div class="section-title mb45 headline text-center">
					<!--<span class="subtitle text-uppercase">Pm-tricks COURSE FAQ</span>-->
					<!--<h2 >Frequently<span> Ask & Questions</span></h2>-->
					<h3> <span class="subtitle ml42 text-uppercase ">Frequently Asked Questions </span></h3>
				</div>

				<div class="faq-tab mb45">
					<div class="faq-tab-ques  ul-li">
						<div class="tab-button text-center mb45">
							<ul class="product-tab">
								
								
							</ul>
						</div>
						<!-- /tab-head -->

						<!-- tab content -->
						<div class="tab-container">

							<!-- 1st tab -->
							<div id="tab1" class="tab-content-1 pt35">
								<div id="accordion" class="panel-group">
                  <?php $__currentLoopData = \App\FAQ::orderBy('created_at', 'desc')->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="panel">
										<div class="panel-title" id="headingTwo">
											<h3 class="mb-0">
												<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo e($f->id); ?>" aria-expanded="false" aria-controls="collapseTwo">
													<?php echo e($f->title); ?>

												</button>
											</h3>
										</div>
										<div id="collapse<?php echo e($f->id); ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
											<div class="panel-body">
												<?php echo $f->contant; ?>

											</div>
										</div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									
								</div>
								<!-- end of #accordion -->

							</div>
							<!-- #tab1 -->

							
							<!-- #tab2 -->

							
							<!-- #tab3 -->

							
							<!-- #tab3 -->

							
							<!-- #tab3 -->
						</div>
					</div>
				</div>

				<div class="about-btn text-center">
					<div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
						<a href="<?php echo e(route('public.faq')); ?>">More <i class="fas fa-caret-right"></i></a>
					</div>
				</div>
			</div>
		</section>
	<!-- End FAQ section
		============================================= -->
		<!-- Start of testimonial secound section
		============================================= -->
<section id="testimonial_2" class="testimonial_2_section">
			<div class="container">
				<div class="testimonial-slide">
				<div class="section-title-2 mb65 headline text-left">
						<!--<span class="subtitle text-uppercase"> </span>-->
						<h2>Find Out What Our   <span>Happy Customers Are Saying.</span></h2>
					</div>
				<div id="testimonial-slide-item" class="testimonial-slide-area">
					    <?php $__currentLoopData = \App\Feedback::orderBy('created_at', 'desc')->where('disable', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="student-qoute">
						    <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img style="overflow:none; width:90px; height: 90px; border-radius:50%; display: block; margin-left: 50%;   " src="<?php if(\App\UserDetail::where('user_id', $f->user_id)->get()->first()): ?> <?php echo e(url('storage/profile_picture/'.basename(\App\UserDetail::where('user_id', $f->user_id)->get()->first()->profile_pic))); ?> <?php else: ?> <?php echo e(asset('indexassets/img/blog/default.png')); ?> <?php endif; ?>" alt="" class="img-fluid center mr-3">
						</div>
                            <p><?php echo e($f->title); ?></p>
							<p style="color: #00000" > “<b><?php echo e($f->feedback); ?></b>”</p>
							<div class="student-name-designation">
								<span class="st-name bold-font" style="font-size:16px"><?php echo e(\App\User::find($f->user_id)->name); ?> </span>
<?php if(\App\UserDetail::where('user_id', $f->user_id)->get()->first()): ?>
								<span class="st-designation"><?php echo e(\App\UserDetail::where('user_id', $f->user_id)->get()->first()->occupation); ?></span>
<?php else: ?>
<span class="st-designation"></span>
<?php endif; ?>
                                <div class="comment-ratting ul-li">
                                  <ul style="color:orange;">
                                    <li><i style="<?php if($f->rate < 1): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                                    <li><i style="<?php if($f->rate < 2): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                                    <li><i style="<?php if($f->rate < 3): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                                    <li><i style="<?php if($f->rate < 4): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                                    <li><i style="<?php if($f->rate < 5): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                                  </ul>
                                </div>
							</div>
						</div>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</div>
				</div>
			</div>
		</section>
<!-- End  of testimonial secound section

<section id="contact-form" > </section>
<!-- End of contact area form
		============================================= --> 

<!-- Start of footer section
		============================================= -->
<section id="contact_secound" class="contact_secound_section backgroud-style">
  <div class="container">
    <div class="contact_secound_content">
      <div class="row">
        <div class="col-md-6">
          <div class="contact-left-content">
            <div class="section-title  mb45 headline text-left"> <span class="subtitle ml42  text-uppercase">CONTACT US</span>
              <h2><span>Let's Connect Together</span></h2>
            </div>
            <div class="contact-address">
              <div class="contact-address-details">
                <div class="address-icon relative-position text-center float-left"> <i class="fas fa-envelope"></i> </div>
                <div class="address-details ul-li-block">
                  <ul>
                    <li><span>Primary: </span>sayed@pm-tricks.com</li>
                    <li><span>Technical support: </span>support@pm-tricks.com</li>
                  </ul>
                </div>
              </div>
              <div class="contact-address-details"> 
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6" id="contact_us_form">
          <div class="contact_secound_form" >
            <div class="section-title-2 mb65 headline text-left">
              <h2>Send Us a message</h2>
            </div>
            
            
            
            <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?>
            <form class="contact_form" action="<?php echo e(route('send.mail.customer')); ?>" method="POST" >
              <?php echo csrf_field(); ?>
              <div class="contact-info">
                <input class="name" name="name" type="text" placeholder="Your Name." style="color:white;">
              </div>
              <div class="contact-info">
                <input class="email" name="email" type="email" placeholder="Your Email" style="color:white;">
              </div>
              <textarea  placeholder="Message." name="msg" style="color:white;"></textarea>
              <div class="nws-button text-center  gradient-bg text-capitalize">
                <button type="submit" value="Submit">SEND MESSAGE NOW <i class="fas fa-caret-right"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer_2 backgroud-style">
    <div class="container">
      <div class="back-top text-center mb45"> <a class="scrollup" href="#"><img src="<?php echo e(asset('indexassets/img/banner/bt.png')); ?>" alt=""></a> </div>
      <div class="footer_2_logo text-center"> <img src="<?php echo e(asset('indexassets/img/logo/logo1.png')); ?>" alt=""> </div>
      <div class="footer_2_subs text-center">
        <p>We take our mission of increasing global access to quality education seriously. </p>
        <div class="subs-form relative-position">
          <!--<form action="#" method="post">-->
          <!--  <input class="course" name="course" type="email" placeholder="Email Address.">-->
          <!--  <div class="nws-button text-center  gradient-bg text-uppercase">-->
          <!--    <button type="submit" value="Submit">Subscribe now</button>-->
          <!--  </div>-->
          <!--</form>-->
        </div>
      </div>
      <div class="copy-right-menu">
        <div class="row">
          <div class="col-md-5">
            <div class="copy-right-text">
              <p>© 2019 - www.pm-tricks.com. All rights reserved powerd by <a href="https://adtit.com">adtit</a></p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="footer-social  text-center ul-li">
              <ul>
                <li><a href="https://www.facebook.com/groups/PMPTRICKS/"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href=""><i class="fab fa-whatsapp"></i></a></li>
                <li><a href="www.linkedin.com/in/sayed-mohsen-pmp-pmi-rmp-pmi-sp-866a9b116"><i class="fab fa-linkedin-in"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="copy-right-menu-item float-right ul-li">
              <ul>
                <li><a href="#">Privacy & Policy</a></li>
                <li><a href="#">Term Of Service</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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


<!--<script src="http://maps.google.com/maps/api/js?key=AIzaSyC61_QVqt9LAhwFdlQmsNwi5aUJy9B2SyA"></script> -->
<script src="<?php echo e(asset('indexassets/js/script.js')); ?>"></script>
<script>
  <?php if(count($errors) && \Session('process') == 'register'): ?>
  $("#myModal1").modal('show');
  <?php endif; ?>

  <?php if(count($errors) && \Session('process') == 'login'): ?>
  $("#myModal").modal('show');
  <?php endif; ?>
</script>
</body>
</html>