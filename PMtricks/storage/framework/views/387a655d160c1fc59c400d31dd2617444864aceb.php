<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo e($i->package->name); ?></title>

<!-- Mobile Specific Meta -->
<link rel="icon" href="<?php echo e(asset('img/pmplearning.jpg')); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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

<body >
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
  <button class="switcher-light">WIDE </button>
  <button class="switcher-dark">BOX </button>
  <a class="rtl-v" href="RTL_Pm-tricks/index.html">RTL </a> </div>

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

                          <input type="hidden" name="prev_url" value="<?php echo e(url()->current()); ?>">
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
                  <a  data-toggle="modal" data-target="#myModal" href="#">log in</a>
                <?php else: ?>
                  <?php if(Auth::guard('web')->check()): ?>
                    <a  href="<?php echo e(route('user.dashboard')); ?>">My Dashboard</a>
                  <?php elseif(Auth::guard('admin')->check()): ?>
                    <a  href="<?php echo e(route('admin.dashboard')); ?>">DashBoard</a>
                  <?php endif; ?>
                  
                  <a href="<?php echo e(route('logout')); ?>"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      <?php echo e(__('Logout')); ?>

                  </a>

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
                  <a  data-toggle="modal" data-target="#myModal" href="#">log in</a>
                <?php else: ?>
                  <?php if(Auth::guard('web')->check()): ?>
                    <a  href="<?php echo e(route('user.dashboard')); ?>">My Dashboard</a>
                  <?php elseif(Auth::guard('admin')->check()): ?>
                    <a  href="<?php echo e(route('admin.dashboard')); ?>">DashBoard</a>
                  <?php endif; ?>
                  
                  <a href="<?php echo e(route('logout')); ?>"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      <?php echo e(__('Logout')); ?>

                  </a>

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
        <h2 class="breadcrumb-head black bold"> <span><?php echo e($i->package->name); ?></span></h2>
      </div>
      <div class="page-breadcrumb-item ul-li">
        <ul class="breadcrumb text-uppercase black">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Details</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- End of breadcrumb section
		============================================= --> 

<!-- Start of course details section
		============================================= -->
<section  class="course-details-section" id="app-1">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="course-details-item">
          <div class="course-single-pic mb30"> 
          <?php if($i->package->preview_video_url != null && $i->package->preview_video_url != ''): ?>
            <video oncontextmenu="return false;" width="100%" controls controlsList="nodownload">
              <source src="<?php echo e(url('storage/videos/'.basename($i->package->preview_video_url) )); ?>" type="video/mp4">
            </video>
          <?php else: ?>
          
            <img src="<?php echo e(url('storage/package/imgs/'.basename($i->package->img_large))); ?>" alt=""> 
          <?php endif; ?>  
          </div>
        </div>
      </div>
      <div class="col-md-3" >
          <div class="side-bar">
            <div class="course-side-bar-widget">
              <h3>Price 
                  <?php if(Illuminate\Support\Facades\Input::get('coupon')== ''): ?>
  
                    <?php if($i->package->discount > 0): ?>
                    <span>
                    <i style=" color: red; text-decoration: line-through;"><?php echo e(round($i->package->original_price, 2)); ?>$</i> |
                    </span>
                    <?php endif; ?>
                    <span class="widget-thumb-body-stat">
                    <?php if($i->package->price > 0): ?>
                        <?php echo e($i->package->price); ?> $
                    <?php else: ?> 
                        Free
                    <?php endif; ?>
                  <?php else: ?>
                    <?php
                      $newPrice = $i->package->price;
                      $oldPrice = round($i->package->original_price, 2);
                      $coupon = \App\Coupon::where('code', Illuminate\Support\Facades\Input::get('coupon'))->get()->first();
                      if($coupon){
                        $oldPrice = $i->package->price;
                        if($coupon->price >= $oldPrice){
                          $newPrice = 'Free';
                        }else{
                          $newPrice = $oldPrice - $coupon->price;
                        }
                      }
                    ?>
                    <span>
                    <i style=" color: red; text-decoration: line-through;"><?php echo e(round($i->package->price, 2)); ?>$</i> |
                    </span>
                    <?php echo e($newPrice); ?>$
  
                  <?php endif; ?>
              </span></h3>
              <?php if(auth()->guard()->guest()): ?>
                  <div class="genius-btn gradient-bg text-center text-uppercase float-left bold-font"> <a v-on:click="regenerate_price" data-toggle="modal" data-target="#PaymentModal" >Enroll THis course <i class="fas fa-caret-right"></i></a> </div>
              <?php else: ?>
                  <?php if( !(\App\UserPackages::where('user_id','=', Auth::user()->id)->where('package_id','=',$i->package->id)->get()->first()) && !(\App\PaymentApprove::where('user_id','=', Auth::user()->id)->where('package_id','=',$i->package->id)->get()->first()) ): ?>
                  <div class="genius-btn gradient-bg text-center text-uppercase float-left bold-font"> <a v-on:click="regenerate_price" data-toggle="modal" data-target="#PaymentModal" >Enroll THis course <i class="fas fa-caret-right"></i></a> </div>
                  <?php endif; ?>
              <?php endif; ?>
  
              
            </div>
            <div class="enrolled-student">
              <div class="comment-ratting float-left ul-li">
                <ul>
                  <li style="<?php if($i->total_rate < 1): ?>color:black !important;<?php endif; ?>"><i class="fa fa-star"></i></li>
                  <li style="<?php if($i->total_rate < 2): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                  <li style="<?php if($i->total_rate < 3): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                  <li style="<?php if($i->total_rate < 4): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                  <li style="<?php if($i->total_rate < 5): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                </ul>
              </div>
              <div class="student-number bold-font"> <?php echo e($i->users_no); ?> students Enrolled </div>
            </div>
            <div class="couse-feature ul-li-block">
              <ul>
                  <?php if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined'): ?>    
                  <li>Lectures <span><?php echo e($total_videos_num); ?> Lectures</span></li>
                  <?php endif; ?>
                  <?php if($i->package->contant_type == 'question' || $i->package->contant_type == 'combined'): ?>    
                  <li>Practice tests <span><?php echo e(count($chapter_list) + count($process_list) + count($exam_list)); ?> Quiz</span></li>
                  <?php endif; ?>
                  <li>Language <span><?php echo e($i->package->lang); ?></span></li>
                  
                  <li>Access <span><?php echo e($i->package->expire_in_days); ?> Days</span></li>

                  <?php if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined'): ?>
                    <li>duration
                      <span>
                      <?php echo e($package_total_video_time[0]); ?> Hr <?php echo e($package_total_video_time[1]); ?> Min
                      </span>
                    </li>
                  <?php endif; ?>

                  <?php if($i->package->contant_type != 'question'): ?>
                  <li>  Certificate of Completion <span>
                      <?php if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined'): ?>    
                      yes
                      <?php else: ?>
                      no
                      <?php endif; ?>
                  </span></li>
                  <?php endif; ?>
              </ul>
            </div>
            <div class="clp-component-render">
              <div class="ud-component--clp--redeem-coupon" data-component-args="{}" ng-non-bindable="">
                <div class="mt10">
                    
                  <?php if(auth()->guard()->guest()): ?>
                      <div data-purpose="coupon-form" class="m0 ">
                        <div class="form-group"><span class="input-group input-group-sm">
                          <label for="coupon-input" class="sr-only">Enter Coupon</label>
                          <input data-purpose="coupon-input" placeholder="Enter Coupon" value="<?php echo e(Illuminate\Support\Facades\Input::get('coupon')); ?>" type="text" id="coupon-input" class="form-control" v-model="coupon">
                          <span class="input-group-btn">
                          
                          <button v-on:click="regenerate_price" data-purpose="coupon-submit" data-toggle="modal" data-target="#PaymentModal" type="submit" class="btn btn-primary"><span>Apply</span></button>
                          </span></span><span class="help-block"></span></div>
                      </div>

                      <div id="PaymentModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                      
                          <!-- Modal content-->
                          <div class="modal-content">
                            
                            <div class="modal-body">
                              <p>
                                <p v-if="discount > 0">
                                Coupon Code: {{coupon}} 
                                  <b v-if="discount > 0" style="color:green;">Valid</b>
                                  <b v-if="discount <= 0" style="color:green;">Expired</b><br>
                                </p>
                                
                                Price: {{price}} $<br>
                                <p v-if="discount > 0">
                                  Discount: {{discount}} $<br>
                                  <b style="text-decoration: underline; color: green;">New Price: {{newPrice}} $</b>
                                </p>
                                <br><br>
                                Choose Payment Method:<br><br>
                                <div class="row">
                                  <div class="col-md-6">
                                      <a v-if ="newPrice <= 0"class="btn btn-primary" v-on:click="redirect_pay">
                                            <span>
                                                 Enroll Free
                                            </span>
                                      </a>
                                  </div>
                                  <div class="col-md-6">
                                    <div id="paypal-button-container"></div>
                                  </div>
                                </div>
                                
    
    
                                <p v-if="auth == 0" style="color:red;">Please Login so you can pay with credit card ! </p>
    
    
                                
                              
                              </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                      
                        </div>
                      </div>
                  <?php else: ?>
                      <?php if( !(\App\UserPackages::where('user_id','=', Auth::user()->id)->where('package_id','=',$i->package->id)->get()->first()) && !(\App\PaymentApprove::where('user_id','=', Auth::user()->id)->where('package_id','=',$i->package->id)->get()->first()) ): ?>
                      <div data-purpose="coupon-form" class="m0 ">
                        <div class="form-group"><span class="input-group input-group-sm">
                          <label for="coupon-input" class="sr-only">Enter Coupon</label>
                          <input data-purpose="coupon-input" placeholder="Enter Coupon" type="text" id="coupon-input" class="form-control" v-model="coupon" value="<?php echo e(Illuminate\Support\Facades\Input::get('coupon')); ?>">
                          <span class="input-group-btn">
                          <button v-on:click="regenerate_price" data-purpose="coupon-submit" data-toggle="modal" data-target="#PaymentModal" type="submit" class="btn btn-primary"><span>Apply</span></button>
                          </span></span><span class="help-block"></span></div>
                      </div>


                      <div id="PaymentModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                      
                          <!-- Modal content-->
                          <div class="modal-content">
                            
                            <div class="modal-body">
                              <p>
                                <p v-if="discount > 0">
                                Coupon Code: {{coupon}} 
                                  <b v-if="discount > 0" style="color:green;">Valid</b>
                                  <b v-if="discount <= 0" style="color:green;">Expired</b><br>
                                </p>
                                
                                Price: {{price}} $<br>
                                <p v-if="discount > 0">
                                  Discount: {{discount}} $<br>
                                  <b style="text-decoration: underline; color: green;">New Price: {{newPrice}} $</b>
                                </p>
                                <br><br>
                                Choose Payment Method:<br><br>
                                <div class="row">
                                  <div class="col-md-6">


                                          <a v-if ="newPrice <= 0"class="btn btn-primary" v-on:click="redirect_pay">
                                            <span>
                                                 Enroll Free
                                            </span>
                                          </a>

                                  </div>
                                  <div class="col-md-6">
                                    <div id="paypal-button-container"></div>
                                  </div>
                                </div>
                                
    
    
                                <p v-if="auth == 0" style="color:red;">Please Login so you can pay with credit card ! </p>
    
    
                                
                              
                              </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                      
                        </div>
                      </div>
                      <?php endif; ?>
                  <?php endif; ?>

                  
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="course-details-item">
          
          <div class="course-single-text">
            <div class="course-title mt10 headline relative-position">
              <h3><a ><?php echo e($i->package->name); ?></b></a> <br>
                <?php if($i->users_no >= 400): ?>

                <span class="trend-badge text-uppercase bold-font"><i class="fas fa-bolt"></i> TRENDING</span>
                <?php endif; ?>
            </h3>
            </div>
            <div class="course-details-content">
              <h3>What you'll learn</h3>
               <?php echo $i->package->what_you_learn; ?> 
              <hr>
              <h3>Requirements</h3>
              <?php echo $i->package->requirement; ?>

            </div>
            <hr>
            <h3>Description</h3>
            <p>
                <?php echo $i->package->description; ?>

            </p>

            <h3>Who this course is for</h3>
            <p>
                <?php echo $i->package->who_course_for; ?>

            </p>
            <?php if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined'): ?>
            <hr>
            <div class="course-details-category ul-li"> <span>Course <b>content :</b></span>
              <ul>
                <li style="text-transform: lowercase !important;">
                    <?php if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined'): ?>
                    <?php echo e($total_time); ?> |
                    <?php echo e($total_videos_num); ?> lectures 
                    <?php endif; ?>

                    

                </li>
                
              </ul>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <!-- /course-details -->
        <?php if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined'): ?>
        <div class="affiliate-market-guide mb65">
<!--
          <div class="section-title-2 mb20 headline text-left">
            <h2><span>Affiliate Marketing</span> A Begginer's Guide</h2>
          </div>
-->
          <div class="affiliate-market-accordion">
            <div id="accordion" class="panel-group">
                
                <?php $__currentLoopData = $chapter_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count(\App\Video::where('chapter', $chapter->id)->get()) > 0 ): ?>    
                    <div class="panel">
                        <div class="panel-title" id="headingOne">
                            <div class="ac-head">
                                <button  class="btn btn-link <?php if($chapter->num != 1): ?> collapsed <?php endif; ?>" data-toggle="collapse" data-target="#collapseChapter<?php echo e($chapter->id); ?>" aria-expanded="true" aria-controls="collapseOne"> 
                                
                                 <?php echo e($chapter->name); ?> </button>

                                <div class="leanth-course"> 
                                  <span> <?php echo e(count(\App\Video::where('chapter', $chapter->id)->get())); ?> Lecture</span> 
                                  <span style="text-transform: lowercase !important;"><?php echo e($chapter->total_hours); ?> Hr <?php echo e($chapter->total_min); ?> Min</span>
                                </div>

                                
                            </div>
                        </div>
                        <div id="collapseChapter<?php echo e($chapter->id); ?>" class="  collapse <?php if($chapter->num == 1): ?> show <?php endif; ?>" aria-labelledby="headingOne" data-parent="#accordion">
                            <table class="table table-condensed table-hover">
                                <tbody>
                                                                          
                                    <?php if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined'): ?>
                                        <?php $__currentLoopData = \App\Video::where('chapter', $chapter->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><i class="fa fa-play-circle"></i> &nbsp;&nbsp;&nbsp; <?php echo e($video->title); ?></td>
                                                <?php if($video->demo == 1): ?>
                                                <td align="center"> 
                                                  <a data-toggle="modal" data-target="#myModal<?php echo e($video->id); ?>" style="cursor: pointer;" onclick="runVideo('Video<?php echo e($video->id); ?>')">Preview</a>
                                                </td>

                                                <!-- Preview Model -->
                                                <div id="myModal<?php echo e($video->id); ?>" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                                  <div class="modal-dialog modal-lg" role="document">

                                                    <div class="modal-content">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pauseVid('Video<?php echo e($video->vimeo_id); ?>')" style="background: black;border-radius: 50%;position: absolute;right: 0;z-index: 5;color: white;">X</button>
                                                      <div class="modal-body" style="padding: 0 !important;">
                                                        <?php if($video->vimeo_id): ?>
                                                          <iframe id="Video<?php echo e($video->vimeo_id); ?>" src="https://player.vimeo.com/video/<?php echo e($video->vimeo_id); ?>?api=1&player_id=Video<?php echo e($video->vimeo_id); ?>" width="100%" height="400px" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                                        <?php else: ?>
                                                          <video oncontextmenu="return false;" width="100%" controls controlsList="nodownload" id="Video<?php echo e($video->id); ?>">
                                                              <source src="<?php echo e(url('storage/videos/'.basename($video->video_url) )); ?>" type="video/mp4">
                                                          </video>
                                                        <?php endif; ?>


                                                      </div>
                                                      <div class="fluid-container">
                                                        <ul style="list-style: none;background-color: #1f1e1c;margin: 0;padding:  0 10px;">
                                                          <?php $__currentLoopData = $chapter_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = \App\Video::where('chapter', $c->id)->where('demo', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>      
                                                              <li style="background: #1f1e1c;color:  white;padding:  10px 0;border-bottom: 1px solid white;">
                                                                <a data-toggle="modal" data-dismiss="modal" data-target="#myModal<?php echo e($demo->id); ?>" style="cursor: pointer;" onclick="runVideo('Video<?php echo e($demo->vimeo_id); ?>', 'Video<?php echo e($video->vimeo_id); ?>')">
                                                                  <?php echo e($demo->title); ?>

                                                                </a>
                                                              </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>                                                        
                                                      </div>
                                                    </div>

                                                  </div>
                                                </div>

                                                <?php else: ?> 
                                                <td></td> 
                                                <?php endif; ?>

                                                <td align="center"> <?php echo e(\Carbon\Carbon::parse($video->duration)->format('i')); ?> Min</td>
                                            </tr>
                                            
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                  

                                  

                                    
                                
                                    
                                </tbody>
                            </table>
                        </div>
                                                    
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <?php if($i->package->contant_type == 'question' || $i->package->contant_type == 'combined'): ?>
          <hr>
            <div class="course-details-category ul-li"> <span>Course <b>content :</b></span>
              <ul>
                <li><?php echo e($total_quiz_num); ?> Quiz</li>
                <li>
                    
                    
                    <?php echo e($total_question_num); ?> Question

                </li>
                
              </ul>
            </div>
            <hr>
            <div class="affiliate-market-guide mb65">
      <!--
                <div class="section-title-2 mb20 headline text-left">
                  <h2><span>Affiliate Marketing</span> A Begginer's Guide</h2>
                </div>
      -->
                <div class="affiliate-market-accordion">
                  <div id="accordion" class="panel-group">

                <?php if(count($chapter_list) > 0): ?>
                <div class="panel">
                    <div class="panel-title" id="headingOne">
                        <div class="ac-head">
                            <button class="btn btn-link collapsed" style="" data-toggle="collapse" data-target="#collapseProcess" aria-expanded="true" aria-controls="collapseProcess"> <span></span> <?php if($i->package->id == 18): ?> Exams <?php else: ?>  Knowledge Area <?php endif; ?></button>
                            <div class="leanth-course"> 
                                <span><?php echo e($chapter_data->quiz_num); ?> Quiz</span>  
                                <span><?php echo e($chapter_data->question_num); ?> Question</span> 
                                
                            </div>
                        </div>
                    </div>
                    <div id="collapseProcess" class=" collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <table class="table table-condensed table-hover">
                            <tbody>
                                <?php $__currentLoopData = $chapter_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if(count(\App\Question::where('chapter', '=', $chapter->id)->get()) > 0): ?>
                                    <tr>
                                        <td><?php echo e($chapter->name); ?></td>
                                        <td></td>
                                        <td align="center"> <?php echo e(round( (count(\App\Question::where('chapter', '=', $chapter->id)->get()) ))); ?> Questions</td>
                                    </tr>
                                  <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            
                                
                            </tbody>
                        </table>
                    </div>
                                                
                </div>
                <?php endif; ?>

                <?php if(count($process_list) > 0): ?>
                <div class="panel">
                    <div class="panel-title" id="heading2">
                        <div class="ac-head">
                            <button class="btn btn-link collapsed" style="" data-toggle="collapse" data-target="#collapseProcess_group" aria-expanded="true" aria-controls="collapseProcess_group"> <span></span> Process Group </button>
                            <div class="leanth-course">
                              
                              <span><?php echo e($process_data->quiz_num); ?> Quiz</span>
                              <span><?php echo e($process_data->question_num); ?> Question</span> 
                              
                            </div>
                        </div>
                    </div>
                    <div id="collapseProcess_group" class=" collapse" aria-labelledby="heading2" data-parent="#accordion">
                        <table class="table table-condensed table-hover">
                            <tbody>
                                
                                <?php $__currentLoopData = $process_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if(count(\App\Question::where('process_group', '=', $process->id)->get()) > 0): ?>
                                    <tr>
                                        <td><?php echo e($process->name); ?></td>
                                        <td></td>
                                        <td align="center"> <?php echo e(round( (count(\App\Question::where('process_group', '=', $process->id)->get()) ))); ?> Questions</td>
                                    </tr>
                                  <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            
                                
                            </tbody>
                        </table>
                    </div>
                                                
                </div>
                <?php endif; ?>

                <?php if(count($exam_list) > 0): ?>
                <div class="panel">
                    <div class="panel-title" id="headingtwo">
                        
                        <div class="ac-head">
                            <button class="btn btn-link collapsed" style="" data-toggle="collapse" data-target="#collapseExams" aria-expanded="false" aria-controls="collapseExams"> <span></span> Mock Exams </button>
                            <div class="leanth-course">
                              <span><?php echo e($exam_data->quiz_num); ?> Quiz</span>
                              <span><?php echo e($exam_data->question_num); ?> Question</span> 
                            </div>
                        </div>
                    </div>
                    <div id="collapseExams" class=" collapse" aria-labelledby="headingtwo" data-parent="#accordion">
                        <table class="table table-condensed table-hover">
                            <tbody>
                                <?php $__currentLoopData = $exam_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($exam->name); ?></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td align="center"> <?php echo e(round( (count(\App\Question::where('exam_num', 'LIKE', '%'.$exam->id.'%')->get())))); ?> Questions</td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            
                                
                            </tbody>
                        </table>
                    </div>
                                                
                </div>
                <?php endif; ?>
                 
              
            </div>
          </div>
        </div>
        <?php endif; ?>
        <!-- /market guide -->
        <?php
            function countOrOne($countable){
                $count = count($countable);
                if($count > 0){
                    return $count;
                }else{
                    return 1;
                }
            }

        ?>
        <div class="course-review">
          <div class="section-title-2 mb20 headline text-left">
            <h2>Course <span>Reviews:</span></h2>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="ratting-preview">
                <div class="row">
                  <div class="col-md-4">
                    <div class="avrg-rating ul-li"> <b>Average Rating</b> <span class="avrg-rate">
                        <?php echo e(round($i->total_rate,1)); ?>

                    </span>
                      <ul>
                        <li style="<?php if($i->total_rate < 1): ?>color:black !important;<?php endif; ?>"><i class="fa fa-star"></i></li>
                        <li style="<?php if($i->total_rate < 2): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                        <li style="<?php if($i->total_rate < 3): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                        <li style="<?php if($i->total_rate < 4): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                        <li style="<?php if($i->total_rate < 5): ?>color:black !important;<?php endif; ?>"><i class="fas fa-star"></i></li>
                      </ul>
                      <b>
                          <?php echo e(count(\App\Rating::where('package_id', $i->package->id)->get())); ?> Rating
                      </b>
                       </div>
                  </div>
                  <div class="col-md-8">
                    <div class="avrg-rating ul-li"> <span>Details</span>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >5 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            <?php if( count(\App\Rating::where('package_id', $i->package->id)->get()) ): ?>
                                <div class="progress-bar" role="progressbar" style="width:<?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 5)->get())/ count(\App\Rating::where('package_id', $i->package->id)->get())   *100)); ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php else: ?>
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php endif; ?>
                        </div>

                        <span class="start-count col-md-2"><?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 5)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)); ?>%
                        </span> 
                      </div>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >4 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            <?php if( count(\App\Rating::where('package_id', $i->package->id)->get()) ): ?>
                                <div class="progress-bar" role="progressbar" style="width:<?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 4)->get())/count(\App\Rating::where('package_id', $i->package->id)->get())*100)); ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php else: ?>
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php endif; ?>
                        </div>

                        <span class="start-count col-md-2"><?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 4)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)); ?>%
                        </span> 
                      </div>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >3 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            <?php if( count(\App\Rating::where('package_id', $i->package->id)->get()) ): ?>
                                <div class="progress-bar" role="progressbar" style="width:<?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 3)->get())/count(\App\Rating::where('package_id', $i->package->id)->get())*100)); ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php else: ?>
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php endif; ?>
                        </div>

                        <span class="start-count col-md-2"><?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 3)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)); ?>%
                        </span> 
                      </div>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >2 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            <?php if( count(\App\Rating::where('package_id', $i->package->id)->get()) ): ?>
                                <div class="progress-bar" role="progressbar" style="width:<?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 2)->get())/count(\App\Rating::where('package_id', $i->package->id)->get())*100)); ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php else: ?>
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php endif; ?>
                        </div>

                        <span class="start-count col-md-2"><?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 2)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)); ?>%
                        </span> 
                      </div>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >1 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            <?php if( count(\App\Rating::where('package_id', $i->package->id)->get()) ): ?>
                                <div class="progress-bar" role="progressbar" style="width:<?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 1)->get())/count(\App\Rating::where('package_id', $i->package->id)->get())*100)); ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php else: ?>
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php endif; ?>
                        </div>
                        <?php if( count(\App\Rating::where('package_id', $i->package->id)->get()) ): ?>
                        <span class="start-count col-md-2"><?php echo e(round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 1)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)); ?>%
                        </span>
                        <?php else: ?>
                              <span class="start-count col-md-2">0%
                        </span>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /review overview -->
        
        <div class="couse-comment" id="app-2">
          <div class="blog-comment-area ul-li about-teacher-2">
            <ul class="comment-list">
                <?php $__currentLoopData = \App\Rating::where("package_id", $i->package->id)->orderBy('created_at', 'desc')->paginate(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="width:100%">
                  <div class=" comment-avater"> <img style="overflow:none; width:68; height: 68px;" src="<?php if(\App\UserDetail::where('user_id', $rate->user_id)->get()->first()->profile_pic != null ): ?> <?php echo e(url('storage/profile_picture/'.basename(\App\UserDetail::where('user_id', $rate->user_id)->get()->first()->profile_pic))); ?> <?php else: ?> <?php echo e(asset('storage/icons/user/'.rand(1,3).'.png')); ?> <?php endif; ?>" alt=""> </div>
                  <div class="author-name-rate" >
                    <div class="author-name float-left" > BY: <span><?php echo e(\App\User::find($rate->user_id)->name); ?></span> </div>
                    <div class="comment-ratting float-right ul-li" >
                      <ul>
                        <li><i style="<?php if($rate->rate < 1): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                        <li><i style="<?php if($rate->rate < 2): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                        <li><i style="<?php if($rate->rate < 3): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                        <li><i style="<?php if($rate->rate < 4): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                        <li><i style="<?php if($rate->rate < 5): ?>color:black !important;<?php endif; ?>" class="fas fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="time-comment float-right"><?php echo e($rate->created_at->diffForHumans()); ?></div>
                  </div>
                  <?php if($rate->review != '' && $rate->review != null): ?>
                  <div class="author-designation-comment">
                    
                    <p><?php echo e($rate->review); ?></p>
                  </div>
                  <?php endif; ?>
                    <?php if(Auth::guard('admin')->check()): ?>
                    <a v-on:click="showReplyForm('reply_form_<?php echo e($rate->id); ?>')">Reply</a>
                    <?php endif; ?>

                    <form action="<?php echo e(route('rate.store.nested')); ?>" method="post" style="display:none;" id="reply_form_<?php echo e($rate->id); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="rate_id" value="<?php echo e($rate->id); ?>">
                        <div class="form-group">
                            <textarea rows="8" name="contant" placeholder="Write comment here ..." class="form-control c-square"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn blue uppercase btn-md sbold btn-block">Submit</button>
                        </div>
                    </form>

                    <?php
                        $comments_id = \App\PageComment::where('page', '=', 'rate')->where('item_id', '=', $rate->id)->pluck('comment_id')->toArray();
                        $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();
                    ?>


                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li style="margin-left: 17%; width:83%;">
                            <div class=" comment-avater"> <img style="overflow:none; width:68; height: 68px;" src="<?php echo e(asset('storage/icons/user/'.rand(1,3).'.png')); ?> " alt=""> </div>
                            <div class="author-name-rate" >
                                <div class="author-name float-left" > BY: <span><?php if(\App\Admin::find( $comment->user_id ) ): ?> <?php echo e(\App\Admin::find( $comment->user_id )->name); ?> <?php else: ?> <?php echo e($comment->user_id); ?> <?php endif; ?></span> </div>

                                <div class="time-comment float-right"><?php echo e($comment->created_at->diffForHumans()); ?></div>
                            </div>

                            <div class="author-designation-comment">
                                <p><?php echo e($comment->contant); ?></p>
                            </div>
                            <a href="<?php echo e(route('delete.comment.on.review', $comment->id)); ?>">Delete</a>  


                        </li>




                        <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                  
                </li>



                <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <center>
                <?php echo e(\App\Rating::where("package_id", $i->package->id)->orderBy('created_at', 'desc')->paginate(8)->links()); ?>

                </center>
            </ul>
            
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>
<!-- End of course details section
		============================================= --> 

<!-- Start of footer section
		============================================= -->
<footer>
  <section id="footer-area" class="footer-area-section">
    <div class="container"> 
      <!-- /footer-widget-content -->
      <div class="footer-social-subscribe mb65">
        <!--<div class="row">-->
        <!--  <div class="col-md-3">-->
        <!--    <div class="footer-social ul-li">-->
        <!--      <h2 class="widget-title">Social Network</h2>-->
        <!--      <ul>-->
        <!--        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>-->
        <!--        <li><a href="#"><i class="fab fa-twitter"></i></a></li>-->
        <!--        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>-->
        <!--      </ul>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="col-md-9">-->
        <!--    <div class="subscribe-form">-->
        <!--      <h2 class="widget-title">Subscribe Newsletter</h2>-->
        <!--      <div class="subs-form relative-position">-->
        <!--        <form action="#" method="post">-->
        <!--          <input class="course" name="course" type="email" placeholder="Email Address.">-->
        <!--          <div class="nws-button text-center  gradient-bg text-uppercase">-->
        <!--            <button type="submit" value="Submit">Subscribe now</button>-->
        <!--          </div>-->
        <!--        </form>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
      </div>
      <div class="copy-right-menu">
        <div class="row">
          <div class="col-md-6">
            <div class="copy-right-text">
              <p>© 2019 - www.Pm-tricksCourse.com. All rights reserved</p>
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

<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

<script
  src="https://www.paypal.com/sdk/js?client-id=<?php echo e(\App\PaypalConfig::all()->first()->client_id); ?>">
</script>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script>


    <?php if(session('success')): ?>
    swal({
        title: '<?php echo e(session('success')); ?>',
        type: 'success',
        //   confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ok',
    });
    <?php endif; ?>


    function pauseVid(vid){
          var iframe = document.getElementById(vid);
          var player = new Vimeo.Player(iframe);
          player.pause();
          
        }

        function runVideo(run_vid, stop_vid){
          pauseVid(stop_vid);

          if(run_vid != stop_vid){
            var iframe = document.getElementById(run_vid);
            var player = new Vimeo.Player(iframe);
            player.play();
          }
                    
        }


        


        

        var app = new Vue({

            el: '#app-1',
            data: {
                
                package_id: <?php echo e($i->package->id); ?>,
                paymentMethod: 'null',
                coupon: '<?php echo e(Illuminate\Support\Facades\Input::get('coupon')); ?>',
                price: 0,
                discount: 0,
                newPrice: 0,
                visa_generated: 0,
                auth: <?php if(Auth::check()): ?> 1 <?php else: ?> 0 <?php endif; ?>
                
            },
            methods: {
                showReplyForm: function(form_id){
                    $('#'+form_id).toggle();

                },
                payModel: function(package_id){
                    
                    this.package_id = package_id;
                },
                regenerate_price: function(){


                
                  Data = {
                      package_id: app.package_id,
                      coupon_code: app.coupon,
                  };

                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  
                  $.ajax ({
                      type: 'POST',
                      url: '<?php echo e(route('price.details')); ?>', 
                      data: Data,
                      success: function(res){
                          
                          
                          app.price = Number(res.price);
                          app.discount = Number(res.discount);

                          if(app.price > app.discount){
                            app.newPrice = app.price - app.discount;
                          }else{
                            
                            app.newPrice = 0;
                          }


                          if(app.newPrice > 0 && app.visa_generated == 0 && app.auth == 1)
                          {
                            paypal.Buttons({
                              createOrder: function(data, actions)  {
                                  // Set up the transaction
                                  
                                  return actions.order.create({
                                      application_context: {
                                          locale: 'en-US',
                                      },
                                      
                                      purchase_units: [{
                                          amount: {
                                              currency_code: 'USD',
                                              value: app.newPrice
                                          }
                                      }],
                                  });
                              },
                              onApprove: function(data, actions) {
                                  
                                  console.log(data);
                                  return actions.order.capture().then(function(details) {
                                      
                                      
                                      
                                      

                                      Data = {
                                        orderID: data.orderID,
                                        payer_id: details.payer.payer_id,
                                        paypalEmail: details.payer.email_address,
                                        countryCode: details.payer.address.country_code,
                                        totalPaid: details.purchase_units[0].amount.value,
                                        paymentID: details.purchase_units[0].payments.captures[0].id,
                                        package_id: app.package_id,
                                        coupon: app.coupon
                                        
                                      };
                                      
                                      
                                      $.ajaxSetup({
                                          headers: {
                                              'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                                          }
                                      });
                                                          
                                      $.ajax ({
                                          type: 'POST',
                                          url: '<?php echo e(route('confirmPaymentMethod2')); ?>',
                                          data: Data,
                                          success: function(res){
                                            
                                            swal({
                                              title: 'Payment Complete Successfully !',
                                              type: 'success',
                                            //   confirmButtonColor: '#DD6B55',
                                              confirmButtonText: 'Ok',
                                            }).then(function(){
                                              window.location = '<?php echo e(route('my.package.view',['all','all'])); ?>';
                                            });
                                            
                                          },
                                          error: function(res){
                                              console.log('Error:', res);    
                                          }
                                      });


                                      
                                  });
                              }
                            }).render('#paypal-button-container');
                            app.visa_generated = 1;
                          }


                          if(app.newPrice <= 0){
                              $("#paypal-button-container").hide();
                          }else{
                              $("#paypal-button-container").show();
                          }

                          
                      },
                      error: function(res){
                          console.log('Error:', res);    
                      }
                  });

                
                  
                },
                redirect_pay:function(){
                    Data = {
                        package_id: app.package_id,
                        coupon_code: app.coupon,
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'POST',
                        url: '<?php echo e(route('generate.payment.link')); ?>', 
                        data: Data,
                        success: function(res){
                            window.location.href = res;        
                            
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });
                    
                    
                    
                },
                selectPaymentMethod: function(){
                    if(this.paymentMethod == 'paypal'){
                        $("#paypal_form").show();
                        $("#check_form").hide();
                    }else{
                        $("#paypal_form").hide();
                        $("#check_form").show();
                    }
                },
                copy: function(){
                    

                }
            }
        });
    </script>


    
    <script>

        
    </script>
</body>
</html>