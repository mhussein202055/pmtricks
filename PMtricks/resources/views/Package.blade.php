<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{$i->package->name}}</title>

<!-- Mobile Specific Meta -->
<link rel="icon" href="{{asset('img/pmplearning.jpg')}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('indexassets/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('indexassets/css/fontawesome-all.css')}}">
<link rel="stylesheet" href="{{asset('indexassets/css/flaticon.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('indexassets/css/meanmenu.css')}}">
<link rel="stylesheet" href="{{asset('indexassets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('indexassets/css/video.min.css')}}">
<link rel="stylesheet" href="{{asset('indexassets/css/lightbox.css')}}">
<link rel="stylesheet" href="{{asset('indexassets/css/progess.css')}}">
<link rel="stylesheet" href="{{asset('indexassets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('indexassets/css/responsive.css')}}">
<link rel="stylesheet"  href="{{asset('indexassets/css/colors/switch.css')}}">
<link href="{{asset('indexassets/css/colors/color-2.css')}}" rel="alternate stylesheet" type="text/css" title="color-2">
<link href="{{asset('indexassets/css/colors/color-3.css')}}" rel="alternate stylesheet" type="text/css" title="color-3">
<link href="{{asset('indexassets/css/colors/color-4.css')}}" rel="alternate stylesheet" type="text/css" title="color-4">
<link href="{{asset('indexassets/css/colors/color-5.css')}}" rel="alternate stylesheet" type="text/css" title="color-5">
<link href="{{asset('indexassets/css/colors/color-6.css')}}" rel="alternate stylesheet" type="text/css" title="color-6">
<link href="{{asset('indexassets/css/colors/color-7.css')}}" rel="alternate stylesheet" type="text/css" title="color-7">
<link href="{{asset('indexassets/css/colors/color-8.css')}}" rel="alternate stylesheet" type="text/css" title="color-8">
<link href="{{asset('indexassets/css/colors/color-9.css')}}" rel="alternate stylesheet" type="text/css" title="color-9">
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
          <img src="{{asset('indexassets/img/logo/logo1.png')}}" alt="logo" style="width: 250 px;height: 50px"></a> </div>
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
                    <form class="contact_form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                @if ($errors->has('name'))
                    <span class="alert alert-danger" style="display:block;">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                @if ($errors->has('email'))
                    <span class="alert alert-danger" style="display:block;">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                @if ($errors->has('password'))
                    <span class="alert alert-danger" style="display:block;">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                @if ($errors->has('country'))
                    <span class="alert alert-danger" style="display:block;">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
                @if ($errors->has('city'))
                    <span class="alert alert-danger" style="display:block;">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif
                @if ($errors->has('phone'))
                    <span class="alert alert-danger" style="display:block;">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
                <div class="contact-info">
                  <input class="name" name="name" value="{{ old('name') }}" type="text" placeholder="Full Name.">
                </div>
                <div class="contact-info">
                  <input class="email" name="email" type="email" value="{{ old('email') }}" placeholder="Email Address.">
                </div>
                     <select class="form-control placeholder-no-fix" placeholder="Country" name="country" value="{{ old('country') }}">
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
                       <input class="name" name="city" value="{{ old('city') }}" type="text" placeholder="City.">
                      </div>
                      <div class="contact-info">
                       <input class="name" name="phone" value="{{ old('phone') }}" type="text" placeholder="Phon Number.">
                      </div>
                      <div class="contact-info">
                       <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" />
                      </div>
                      <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation" />
                      <div class="nws-button text-uppercase text-center white text-capitalize">
                        <button type="submit" value="Submit">SUBMIT REQUEST </button>
                      </div>
						<div class="contact-info" style="font-size: 10px; padding-top: 10px;" >
                      By signing up, you agree to our <a href="{{route('terms.show.public')}}" style="color: blue; font-size: 10px; padding: 0px; ">Terms of Use</a> and <a href="" style="color: blue; font-size: 10px;padding: 0px;">Privacy Policy</a>
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
													<img src="{{asset('indexassets/img/logo/p-logo.jpg')}}" alt="">
												</div>
												<div class="popup-text text-center">
													<h2> <span>Login</span> Your Account.</h2>
													<p>Login to our website, or<a href="#about-us"><span>REGISTER</span></a></p>
												</div>
											</div>


											<div class="modal-body">

                                                
                                                
                        <form class="contact_form" action="{{ route('login') }}" method="post">
                          {{ csrf_field() }}
                          <input type="hidden" name="prev_url" value="{{url()->current()}}">
                          @if ($errors->has('email'))
                              <span class="alert alert-danger" style="display:block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                          @if ($errors->has('password'))
                              <span class="alert alert-danger" style="display:block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                          <div class="contact-info">
                            <input class="name {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                          </div>
                          <div class="contact-info">
                            <input class="pass {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" autocomplete="off" placeholder="Password" name="password" required/>
                          </div>
                          <div class="nws-button text-center white text-capitalize" style="margin-bottom: 20px;">
                            <button type="submit" value="Submit">LOg in Now</button> 
                          </div> 
                          <a href="{{ route('password.request') }}" id="forget-password" class="forget-password" style="color: black;">Forgot Password?</a>
                        </form>


                      

											</div>
										</div>
									</div>
								</div>
							</div>

          <nav class="navbar-menu float-right">
            <div class="nav-menu ul-li">
              <ul>
                <li class="menu-item-has-children ul-li-block"> <a href="{{route('index')}}">Home</a> 
             
                </li>
                <li><a href="#about-us">About Us</a></li>
                <li class="menu-item-has-children ul-li-block"><a href="#">All Courses</a>
                <ul class="sub-menu">
                  @foreach(\App\Course::where('private', 0)->get() as $c)
                    <li><a href="{{route('package.by.course').'?course_id='.$c->id}}">{{$c->title}}</a></li>
                  @endforeach
                </ul>

                </li>
            @guest
            @else
            <li><a href="{{route('my.package.view', ['all', 'all'])}}">My Courses</a></li>
            @endif
            
            
             @guest
             <li>
                  <a  data-toggle="modal" data-target="#myModal" href="#">log in</a>
                @else
                  @if(Auth::guard('web')->check())
                    <a  href="{{route('user.dashboard')}}">My Dashboard</a>
                  @elseif(Auth::guard('admin')->check())
                    <a  href="{{route('admin.dashboard')}}">DashBoard</a>
                  @endif
                  
                  <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  </li>
                @endguest

            @guest
            <li>
             <a  data-toggle="modal" data-target="#myModal1" href="#">Sign Up </a> 
             </li>
          @endguest
              </ul>
            </div>
          </nav>
          <div class="mobile-menu">
            <div class="logo"><a href="#"><img src="{{asset('indexassets/img/logo/logo1.png')}}" alt="Logo"></a></div>
            <nav>
              <ul>
                <li><a href="#">Home</a> </li>
                <li><a href="#about-us">About</a></li>
                <li class="menu-item-has-children ul-li-block"><a href="#">Courses</a>
                <ul>
                  @foreach(\App\Course::where('private', 0)->get() as $c)
                    <li><a href="{{route('package.by.course').'?course_id='.$c->id}}">{{$c->title}}</a></li>
                  @endforeach
                </ul>
                </li>
                <li><a href="#why-choose">Onilne Course</a></li>
                 @guest
             <li>
                  <a  data-toggle="modal" data-target="#myModal" href="#">log in</a>
                @else
                  @if(Auth::guard('web')->check())
                    <a  href="{{route('user.dashboard')}}">My Dashboard</a>
                  @elseif(Auth::guard('admin')->check())
                    <a  href="{{route('admin.dashboard')}}">DashBoard</a>
                  @endif
                  
                  <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  </li>
                @endguest

            @guest
            <li>
             <a  data-toggle="modal" data-target="#myModal1" href="#">Sign Up </a> 
             </li>
          @endguest
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
        <h2 class="breadcrumb-head black bold"> <span>{{$i->package->name}}</span></h2>
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
          @if($i->package->preview_video_url != null && $i->package->preview_video_url != '')
            <video oncontextmenu="return false;" width="100%" controls controlsList="nodownload">
              <source src="{{url('storage/videos/'.basename($i->package->preview_video_url) )}}" type="video/mp4">
            </video>
          @else
          
            <img src="{{ url('storage/package/imgs/'.basename($i->package->img_large))}}" alt=""> 
          @endif  
          </div>
        </div>
      </div>
      <div class="col-md-3" >
          <div class="side-bar">
            <div class="course-side-bar-widget">
              <h3>Price 
                  @if(Illuminate\Support\Facades\Input::get('coupon')== '')
  
                    @if($i->package->discount > 0)
                    <span>
                    <i style=" color: red; text-decoration: line-through;">{{round($i->package->original_price, 2) }}$</i> |
                    </span>
                    @endif
                    <span class="widget-thumb-body-stat">
                    @if($i->package->price > 0)
                        {{$i->package->price}} $
                    @else 
                        Free
                    @endif
                  @else
                    @php
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
                    @endphp
                    <span>
                    <i style=" color: red; text-decoration: line-through;">{{round($i->package->price, 2) }}$</i> |
                    </span>
                    {{$newPrice}}$
  
                  @endif
              </span></h3>
              @guest
                  <div class="genius-btn gradient-bg text-center text-uppercase float-left bold-font"> <a v-on:click="regenerate_price" data-toggle="modal" data-target="#PaymentModal" >Enroll Now <i class="fas fa-caret-right"></i></a> </div>
              @else
                  @if( !(\App\UserPackages::where('user_id','=', Auth::user()->id)->where('package_id','=',$i->package->id)->get()->first()) && !(\App\PaymentApprove::where('user_id','=', Auth::user()->id)->where('package_id','=',$i->package->id)->get()->first()) )
                  <div class="genius-btn gradient-bg text-center text-uppercase float-left bold-font"> <a v-on:click="regenerate_price" data-toggle="modal" data-target="#PaymentModal" >Enroll Now <i class="fas fa-caret-right"></i></a> </div>
                  @endif
              @endguest
  
              {{-- <div class="like-course"> <a href="#"><i class="fas fa-heart"></i></a> </div> --}}
            </div>
            <div class="enrolled-student">
              <div class="comment-ratting float-left ul-li">
                <ul>
                  <li style="@if($i->total_rate < 1)color:black !important;@endif"><i class="fa fa-star"></i></li>
                  <li style="@if($i->total_rate < 2)color:black !important;@endif"><i class="fas fa-star"></i></li>
                  <li style="@if($i->total_rate < 3)color:black !important;@endif"><i class="fas fa-star"></i></li>
                  <li style="@if($i->total_rate < 4)color:black !important;@endif"><i class="fas fa-star"></i></li>
                  <li style="@if($i->total_rate < 5)color:black !important;@endif"><i class="fas fa-star"></i></li>
                </ul>
              </div>
              <div class="student-number bold-font"> {{$i->users_no}} students Enrolled </div>
            </div>
            <div class="couse-feature ul-li-block">
              <ul>
                  @if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined')    
                  <li>Lectures <span>{{$total_videos_num}} Lectures</span></li>
                  @endif
                  @if($i->package->contant_type == 'question' || $i->package->contant_type == 'combined')    
                  <li>Practice tests <span>{{count($chapter_list) + count($process_list) + count($exam_list)}} </span></li>
                  @endif
                  <li>Language <span>{{$i->package->lang}}</span></li>
                  {{-- <li>Video <span>8 Hours</span></li> --}}
                  <li>Access <span>{{$i->package->expire_in_days}} Days</span></li>

                  @if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined')
                    <li>duration
                      <span>
                      {{$package_total_video_time[0]}} Hr {{$package_total_video_time[1]}} Min
                      </span>
                    </li>
                  @endif

                  @if($i->package->contant_type != 'question')
                  <li>  Certificate of Completion <span>
                      @if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined')    
                      yes
                      @else
                      no
                      @endif
                  </span></li>
                  @endif
              </ul>
            </div>
            <div class="clp-component-render">
              <div class="ud-component--clp--redeem-coupon" data-component-args="{}" ng-non-bindable="">
                <div class="mt10">
                    
                  @guest
                      <div data-purpose="coupon-form" class="m0 ">
                        <div class="form-group"><span class="input-group input-group-sm">
                          <label for="coupon-input" class="sr-only">Enter Coupon</label>
                          <input data-purpose="coupon-input" placeholder="Enter Coupon" value="{{Illuminate\Support\Facades\Input::get('coupon')}}" type="text" id="coupon-input" class="form-control" v-model="coupon">
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
                                Coupon Code: @{{coupon}} 
                                  <b v-if="discount > 0" style="color:green;">Valid</b>
                                  <b v-if="discount <= 0" style="color:green;">Expired</b><br>
                                </p>
                                
                                Price: @{{price}} $<br>
                                <p v-if="discount > 0">
                                  Discount: @{{discount}} $<br>
                                  <b style="text-decoration: underline; color: green;">New Price: @{{newPrice}} $</b>
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
                  @else
                      @if( !(\App\UserPackages::where('user_id','=', Auth::user()->id)->where('package_id','=',$i->package->id)->get()->first()) && !(\App\PaymentApprove::where('user_id','=', Auth::user()->id)->where('package_id','=',$i->package->id)->get()->first()) )
                      <div data-purpose="coupon-form" class="m0 ">
                        <div class="form-group"><span class="input-group input-group-sm">
                          <label for="coupon-input" class="sr-only">Enter Coupon</label>
                          <input data-purpose="coupon-input" placeholder="Enter Coupon" type="text" id="coupon-input" class="form-control" v-model="coupon" value="{{Illuminate\Support\Facades\Input::get('coupon')}}">
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
                                Coupon Code: @{{coupon}} 
                                  <b v-if="discount > 0" style="color:green;">Valid</b>
                                  <b v-if="discount <= 0" style="color:green;">Expired</b><br>
                                </p>
                                
                                Price: @{{price}} $<br>
                                <p v-if="discount > 0">
                                  Discount: @{{discount}} $<br>
                                  <b style="text-decoration: underline; color: green;">New Price: @{{newPrice}} $</b>
                                </p>
                                <br><br>
                                Choose Payment Method:<br><br>
                                <div class="row">
                                  <div class="col-md-6">
{{--                                    <button v-on:click="redirect_pay" data-purpose="coupon-submit" data-toggle="modal" data-target="#PaymentModal" type="submit" class="btn btn-primary"><span>PayPal Account</span></button>--}}

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
                      @endif
                  @endguest

                  
                  
                  
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
              <h3><a >{{$i->package->name}}</b></a> <br>
                @if($i->users_no >= 400)

                <span class="trend-badge text-uppercase bold-font"><i class="fas fa-bolt"></i> TRENDING</span>
                @endif
            </h3>
            </div>
            <div class="course-details-content">
              <h3>What you'll learn</h3>
               {!! $i->package->what_you_learn !!} 
              <hr>
              <h3>Requirements</h3>
              {!! $i->package->requirement !!}
            </div>
            <hr>
            <h3>Description</h3>
            <p>
                {!! $i->package->description !!}
            </p>

            <h3>Who this course is for</h3>
            <p>
                {!! $i->package->who_course_for !!}
            </p>
            @if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined')
            <hr>
            <div class="course-details-category ul-li"> <span>Course <b>content :</b></span>
              <ul style="text-align:right; padding-right:100px">
                <li style="text-transform: lowercase !important;">
                    @if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined')
                    {{$total_time}} |
                    {{$total_videos_num}} lectures 
                    @endif

                    

                </li>
                {{-- <li>24:17:40 </li> --}}
              </ul>
            </div>
            @endif
          </div>
        </div>
        <!-- /course-details -->
        @if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined')
        <div class="affiliate-market-guide mb65">
<!--
          <div class="section-title-2 mb20 headline text-left">
            <h2><span>Affiliate Marketing</span> A Begginer's Guide</h2>
          </div>
-->
          <div class="affiliate-market-accordion">
            <div id="accordion" class="panel-group">
                
                @foreach($chapter_list as $chapter)
                    @if(count(\App\Video::where('chapter', $chapter->id)->get()) > 0 )    
                    <div class="panel">
                        <div class="panel-title" id="headingOne">
                            <div class="ac-head">
                                <button  class="btn btn-link @if($chapter->num != 1) collapsed @endif" data-toggle="collapse" data-target="#collapseChapter{{$chapter->id}}" aria-expanded="true" aria-controls="collapseOne"> 
                                {{-- <span>
                                    {{$chapter->num}}  
                                </span> --}}
                                 {{$chapter->name}} </button>

                                <div class="leanth-course"> 
                                  <span> {{count(\App\Video::where('chapter', $chapter->id)->get())}} Lecture</span> 
                                  <span style="text-transform: lowercase !important;">{{$chapter->total_hours}} Hr {{ $chapter->total_min}} Min</span>
                                </div>

                                
                            </div>
                        </div>
                        <div id="collapseChapter{{$chapter->id}}" class="  collapse @if($chapter->num == 1) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                            <table class="table table-condensed table-hover">
                                <tbody>
                                                                          
                                    @if($i->package->contant_type == 'video' || $i->package->contant_type == 'combined')
                                        @foreach(\App\Video::where('chapter', $chapter->id)->get() as $video)
                                            <tr>
                                                <td><i class="fa fa-play-circle"></i> &nbsp;&nbsp;&nbsp; {{$video->title}}</td>
                                                @if($video->demo == 1)
                                                <td align="center"> 
                                                  <a data-toggle="modal" data-target="#myModal{{$video->id}}" style="cursor: pointer;" onclick="runVideo('Video{{$video->id}}')">Preview</a>
                                                </td>

                                                <!-- Preview Model -->
                                                <div id="myModal{{$video->id}}" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                                  <div class="modal-dialog modal-lg" role="document">

                                                    <div class="modal-content">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pauseVid('Video{{$video->vimeo_id}}')" style="background: black;border-radius: 50%;position: absolute;right: 0;z-index: 5;color: white;">X</button>
                                                      <div class="modal-body" style="padding: 0 !important;">
                                                        @if($video->vimeo_id)
                                                          <iframe id="Video{{$video->vimeo_id}}" src="https://player.vimeo.com/video/{{$video->vimeo_id}}?api=1&player_id=Video{{$video->vimeo_id}}" width="100%" height="400px" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                                        @else
                                                          <video oncontextmenu="return false;" width="100%" controls controlsList="nodownload" id="Video{{$video->id}}">
                                                              <source src="{{url('storage/videos/'.basename($video->video_url) )}}" type="video/mp4">
                                                          </video>
                                                        @endif


                                                      </div>
                                                      <div class="fluid-container">
                                                        <ul style="list-style: none;background-color: #1f1e1c;margin: 0;padding:  0 10px;">
                                                          @foreach($chapter_list as $c)
                                                            @foreach(\App\Video::where('chapter', $c->id)->where('demo', 1)->get() as $demo)      
                                                              <li style="background: #1f1e1c;color:  white;padding:  10px 0;border-bottom: 1px solid white;">
                                                                <a data-toggle="modal" data-dismiss="modal" data-target="#myModal{{$demo->id}}" style="cursor: pointer;" onclick="runVideo('Video{{$demo->vimeo_id}}', 'Video{{$video->vimeo_id}}')">
                                                                  {{$demo->title}}
                                                                </a>
                                                              </li>
                                                            @endforeach
                                                          @endforeach
                                                        </ul>                                                        
                                                      </div>
                                                    </div>

                                                  </div>
                                                </div>

                                                @else 
                                                <td></td> 
                                                @endif

                                                <td align="center"> {{\Carbon\Carbon::parse($video->duration)->format('i')}} Min</td>
                                            </tr>
                                            
                                            
                                        @endforeach
                                    @endif


                                  

                                  

                                    {{-- @if(($i->package->contant_type == 'question' || $i->package->contant_type == 'combined') &&  count(\App\Question::where('chapter', $chapter->id)->get()) > 0 )

                                        <tr>
                                            <td>Quiz</td>
                                            <td></td>
                                            <td align="center"> {{ round( (count(\App\Question::where('chapter', '=', $chapter->id)->get()))) }} Questions</td>
                                        </tr>
                                    @endif --}}
                                
                                    
                                </tbody>
                            </table>
                        </div>
                                                    
                    </div>
                    @endif
                @endforeach
              </div>
            </div>
          </div>
          @endif

          @if($i->package->contant_type == 'question' || $i->package->contant_type == 'combined')
          <hr>
            <div class="course-details-category ul-li"> <span>Course <b>content :</b></span>
              <ul style="text-align:right; padding-right:90px">
{{--                <li>{{$total_quiz_num}} Quiz</li>--}}
                <li>
                    
                    
                    {{$total_question_num}} Questions

                </li>
                {{-- <li>24:17:40 </li> --}}
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

                @if(count($chapter_list) > 0)
                <div class="panel">
                    <div class="panel-title" id="headingOne">
                        <div class="ac-head">
                            <button class="btn btn-link collapsed" style="" data-toggle="collapse" data-target="#collapseProcess" aria-expanded="true" aria-controls="collapseProcess"> <span></span> @if($i->package->id == 18) Exams @else  Knowledge Area @endif</button>
                            <div class="leanth-course"> 
{{--                                <span>{{$chapter_data->quiz_num}} Quiz</span>  --}}
                                <span>{{$chapter_data->question_num}} Questions</span>
                                
                            </div>
                        </div>
                    </div>
                    <div id="collapseProcess" class=" collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <table class="table table-condensed table-hover">
                            <tbody>
                                @foreach($chapter_list as $chapter)
                                  @if(count(\App\Question::where('chapter', '=', $chapter->id)->get()) > 0)
                                    <tr>
                                        <td>{{ $chapter->name }}</td>
                                        <td></td>
                                        <td align="center"> {{ round( (count(\App\Question::where('chapter', '=', $chapter->id)->get()) )) }} Questions</td>
                                    </tr>
                                  @endif
                                @endforeach
                                
                            
                                
                            </tbody>
                        </table>
                    </div>
                                                
                </div>
                @endif

                @if(count($process_list) > 0)
                <div class="panel">
                    <div class="panel-title" id="heading2">
                        <div class="ac-head">
                            <button class="btn btn-link collapsed" style="" data-toggle="collapse" data-target="#collapseProcess_group" aria-expanded="true" aria-controls="collapseProcess_group"> <span></span> Process Group </button>
                            <div class="leanth-course">
                              
{{--                              <span>{{$process_data->quiz_num}} Quiz</span>--}}
                              <span>{{$process_data->question_num}} Questions</span>
                              
                            </div>
                        </div>
                    </div>
                    <div id="collapseProcess_group" class=" collapse" aria-labelledby="heading2" data-parent="#accordion">
                        <table class="table table-condensed table-hover">
                            <tbody>
                                
                                @foreach($process_list as $process)
                                  @if(count(\App\Question::where('process_group', '=', $process->id)->get()) > 0)
                                    <tr>
                                        <td>{{ $process->name }}</td>
                                        <td></td>
                                        <td align="center"> {{ round( (count(\App\Question::where('process_group', '=', $process->id)->get()) )) }} Questions</td>
                                    </tr>
                                  @endif
                                @endforeach
                                
                            
                                
                            </tbody>
                        </table>
                    </div>
                                                
                </div>
                @endif

                @if(count($exam_list) > 0)
                <div class="panel">
                    <div class="panel-title" id="headingtwo">
                        
                        <div class="ac-head">
                            <button class="btn btn-link collapsed" style="" data-toggle="collapse" data-target="#collapseExams" aria-expanded="false" aria-controls="collapseExams"> <span></span> Mock Exams </button>
                            <div class="leanth-course">
{{--                              <span>{{$exam_data->quiz_num}} Quiz</span>--}}
                              <span>{{$exam_data->question_num}} Questions</span>
                            </div>
                        </div>
                    </div>
                    <div id="collapseExams" class=" collapse" aria-labelledby="headingtwo" data-parent="#accordion">
                        <table class="table table-condensed table-hover">
                            <tbody>
                                @foreach($exam_list as $exam)
                                    <tr>
                                        <td>{{ $exam->name }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td align="center"> {{ round( (count(\App\Question::where('exam_num', 'LIKE', '%'.$exam->id.'%')->get()))) }} Questions</td>
                                    </tr>
                                @endforeach
                                
                            
                                
                            </tbody>
                        </table>
                    </div>
                                                
                </div>
                @endif
                 
              
            </div>
          </div>
        </div>
        @endif
        <!-- /market guide -->
        @php
            function countOrOne($countable){
                $count = count($countable);
                if($count > 0){
                    return $count;
                }else{
                    return 1;
                }
            }

        @endphp
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
                        {{round($i->total_rate,1)}}
                    </span>
                      <ul>
                        <li style="@if($i->total_rate < 1)color:black !important;@endif"><i class="fa fa-star"></i></li>
                        <li style="@if($i->total_rate < 2)color:black !important;@endif"><i class="fas fa-star"></i></li>
                        <li style="@if($i->total_rate < 3)color:black !important;@endif"><i class="fas fa-star"></i></li>
                        <li style="@if($i->total_rate < 4)color:black !important;@endif"><i class="fas fa-star"></i></li>
                        <li style="@if($i->total_rate < 5)color:black !important;@endif"><i class="fas fa-star"></i></li>
                      </ul>
                      <b>
                          {{count(\App\Rating::where('package_id', $i->package->id)->get())}} Rating
                      </b>
                       </div>
                  </div>
                  <div class="col-md-8">
                    <div class="avrg-rating ul-li"> <span>Details</span>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >5 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            @if( count(\App\Rating::where('package_id', $i->package->id)->get()) )
                                <div class="progress-bar" role="progressbar" style="width:{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 5)->get())/ count(\App\Rating::where('package_id', $i->package->id)->get())   *100)}}%" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>

                        <span class="start-count col-md-2">{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 5)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)}}%
                        </span> 
                      </div>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >4 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            @if( count(\App\Rating::where('package_id', $i->package->id)->get()) )
                                <div class="progress-bar" role="progressbar" style="width:{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 4)->get())/count(\App\Rating::where('package_id', $i->package->id)->get())*100)}}%" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>

                        <span class="start-count col-md-2">{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 4)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)}}%
                        </span> 
                      </div>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >3 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            @if( count(\App\Rating::where('package_id', $i->package->id)->get()) )
                                <div class="progress-bar" role="progressbar" style="width:{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 3)->get())/count(\App\Rating::where('package_id', $i->package->id)->get())*100)}}%" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>

                        <span class="start-count col-md-2">{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 3)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)}}%
                        </span> 
                      </div>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >2 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            @if( count(\App\Rating::where('package_id', $i->package->id)->get()) )
                                <div class="progress-bar" role="progressbar" style="width:{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 2)->get())/count(\App\Rating::where('package_id', $i->package->id)->get())*100)}}%" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>

                        <span class="start-count col-md-2">{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 2)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)}}%
                        </span> 
                      </div>
                      <div class="rating-overview row"> 
                        <span class="start-item col-md-3" >1 Starts</span> 
                        <div class="progress col-md-7" style="padding:0;">
                            @if( count(\App\Rating::where('package_id', $i->package->id)->get()) )
                                <div class="progress-bar" role="progressbar" style="width:{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 1)->get())/count(\App\Rating::where('package_id', $i->package->id)->get())*100)}}%" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>
                        @if( count(\App\Rating::where('package_id', $i->package->id)->get()) )
                        <span class="start-count col-md-2">{{round(count(\App\Rating::where('package_id', $i->package->id)->where('rate', 1)->get())/countOrOne(\App\Rating::where('package_id', $i->package->id)->get())*100)}}%
                        </span>
                        @else
                              <span class="start-count col-md-2">0%
                        </span>
                        @endif
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
                @foreach(\App\Rating::where("package_id", $i->package->id)->orderBy('created_at', 'desc')->paginate(8) as $rate)
                <li style="width:100%">
                    @php
                    $pic = asset('storage/icons/user/'.rand(1,3).'.png');
                    if(\App\UserDetail::where('user_id', $rate->user_id)->first()){
                        if(\App\UserDetail::where('user_id', $rate->user_id)->get()->first()->profile_pic != null ){
                            $pic = url('storage/profile_picture/'.basename(\App\UserDetail::where('user_id', $rate->user_id)->get()->first()->profile_pic));
                        }
                    }
                    @endphp
                  <div class=" comment-avater"> <img style="overflow:none; width:68; height: 68px;" src="{{$pic}}" alt=""> </div>
                  <div class="author-name-rate" >
                    <div class="author-name float-left" > BY: <span>{{\App\User::find($rate->user_id)->name}}</span> </div>
                    <div class="comment-ratting float-right ul-li" >
                      <ul>
                        <li><i style="@if($rate->rate < 1)color:black !important;@endif" class="fas fa-star"></i></li>
                        <li><i style="@if($rate->rate < 2)color:black !important;@endif" class="fas fa-star"></i></li>
                        <li><i style="@if($rate->rate < 3)color:black !important;@endif" class="fas fa-star"></i></li>
                        <li><i style="@if($rate->rate < 4)color:black !important;@endif" class="fas fa-star"></i></li>
                        <li><i style="@if($rate->rate < 5)color:black !important;@endif" class="fas fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="time-comment float-right">{{$rate->created_at->diffForHumans()}}</div>
                  </div>
                  @if($rate->review != '' && $rate->review != null)
                  <div class="author-designation-comment">
                    
                    <p>{{$rate->review}}</p>
                  </div>
                  @endif
                    @if(Auth::guard('admin')->check())
                    <a v-on:click="showReplyForm('reply_form_{{$rate->id}}')">Reply</a>
                    @endif

                    <form action="{{route('rate.store.nested')}}" method="post" style="display:none;" id="reply_form_{{$rate->id}}">
                        @csrf
                        <input type="hidden" name="rate_id" value="{{$rate->id}}">
                        <div class="form-group">
                            <textarea rows="8" name="contant" placeholder="Write comment here ..." class="form-control c-square"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn blue uppercase btn-md sbold btn-block">Submit</button>
                        </div>
                    </form>

                    @php
                        $comments_id = \App\PageComment::where('page', '=', 'rate')->where('item_id', '=', $rate->id)->pluck('comment_id')->toArray();
                        $comments = \App\Comment::whereIn('id', $comments_id)->orderBy('created_at', 'desc')->get();
                    @endphp


                    @foreach($comments as $comment)

                        <li style="margin-left: 17%; width:83%;">
                            <div class=" comment-avater"> <img style="overflow:none; width:68; height: 68px;" src="{{asset('storage/icons/user/'.rand(1,3).'.png')}} " alt=""> </div>
                            <div class="author-name-rate" >
                                <div class="author-name float-left" > BY: <span>@if(\App\Admin::find( $comment->user_id ) ) {{\App\Admin::find( $comment->user_id )->name}} @else {{$comment->user_id}} @endif</span> </div>

                                <div class="time-comment float-right">{{$comment->created_at->diffForHumans()}}</div>
                            </div>

                            <div class="author-designation-comment">
                                <p>{{$comment->contant}}</p>
                            </div>
                            <a href="{{route('delete.comment.on.review', $comment->id)}}">Delete</a>  


                        </li>




                        <br>
                    @endforeach


                  
                </li>



                <br>
                @endforeach
                <center>
                {{\App\Rating::where("package_id", $i->package->id)->orderBy('created_at', 'desc')->paginate(8)->links()}}
                </center>
            </ul>
            {{-- <div class="reply-comment-box">
              <div class="review-option">
                <div class="section-title-2  headline text-left float-left">
                  <h2>Add <span>Reviews.</span></h2>
                </div>
                <div class="review-stars-item float-right mt15"> <span>Your Rating: </span>
                  <form class="rating">
                    <label>
                      <input type="radio" name="stars" value="1" />
                      <span class="icon"><i class="fas fa-star"></i></span> </label>
                    <label>
                      <input type="radio" name="stars" value="2" />
                      <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> </label>
                    <label>
                      <input type="radio" name="stars" value="3" />
                      <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> </label>
                    <label>
                      <input type="radio" name="stars" value="4" />
                      <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> </label>
                    <label>
                      <input type="radio" name="stars" value="5" />
                      <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> <span class="icon"><i class="fas fa-star"></i></span> </label>
                  </form>
                </div>
              </div>
              <div class="teacher-faq-form">
                <form method="POST" action="/no-form" data-lead="Residential">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="name">Your Name</label>
                      <input type="text" name="name" id="name" required="required">
                    </div>
                    <div class="col-md-6">
                      <label for="phone">Email Address</label>
                      <input type="tel" name="phone" id="phone" required="required">
                    </div>
                  </div>
                  <label for="comments">Message</label>
                  <textarea name="comments" id="comments" rows="2" cols="20" required></textarea>
                  <div class="nws-button text-center  gradient-bg text-uppercase">
                    <button type="submit" value="Submit">Send Message now</button>
                  </div>
                </form>
              </div>
            </div> --}}
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
              <p>� 2019 - www.Pm-tricksCourse.com. All rights reserved</p>
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
<script src="{{asset('indexassets/js/jquery-2.1.4.min.js')}}"></script> 
<script src="{{asset('indexassets/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('indexassets/js/popper.min.js')}}"></script> 
<script src="{{asset('indexassets/js/owl.carousel.min.js')}}"></script> 
<script src="{{asset('indexassets/js/jarallax.js')}}"></script> 
<script src="{{asset('indexassets/js/jquery.magnific-popup.min.js')}}"></script> 
<script src="{{asset('indexassets/js/lightbox.js')}}"></script> 
<script src="{{asset('indexassets/js/jquery.meanmenu.js')}}"></script> 
<script src="{{asset('indexassets/js/scrollreveal.min.js')}}"></script> 
<script src="{{asset('indexassets/js/jquery.counterup.min.js')}}"></script> 
<script src="{{asset('indexassets/js/waypoints.min.js')}}"></script> 
<script src="{{asset('indexassets/js/jquery-ui.js')}}"></script> 
<script src="{{asset('indexassets/js/gmap3.min.js')}}"></script> 
<script src="{{asset('indexassets/js/switch.js')}}"></script> 
<script src="http://maps.google.com/maps/api/js?key=AIzaSyC61_QVqt9LAhwFdlQmsNwi5aUJy9B2SyA"></script> 
<script src="{{asset('indexassets/js/script.js')}}"></script>

<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

<script
  src="https://www.paypal.com/sdk/js?client-id={{\App\PaypalConfig::all()->first()->client_id}}">
</script>
{{-- <script
    src="https://www.paypal.com/sdk/js?client-id=AV3VIQ69lHAEnvK_Pc9FKuzKu5viT2RGJskuKLHp8_P8fiXWLBlWyjp1bTQC1dC9U-SCWwbosuzyg4HZ">
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script>


    @if(session('success'))
    swal({
        title: '{{session('success')}}',
        type: 'success',
        //   confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ok',
    });
    @endif


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
                
                package_id: {{$i->package->id}},
                paymentMethod: 'null',
                coupon: '{{Illuminate\Support\Facades\Input::get('coupon')}}',
                price: 0,
                discount: 0,
                newPrice: 0,
                visa_generated: 0,
                auth: @if(Auth::check()) 1 @else 0 @endif
                
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
                      url: '{{ route('price.details')}}', 
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
                                              'X-CSRF-TOKEN': '{{csrf_token()}}'
                                          }
                                      });
                                                          
                                      $.ajax ({
                                          type: 'POST',
                                          url: '{{ route('confirmPaymentMethod2')}}',
                                          data: Data,
                                          success: function(res){
                                            
                                            swal({
                                              title: 'Payment Complete Successfully !',
                                              type: 'success',
                                            //   confirmButtonColor: '#DD6B55',
                                              confirmButtonText: 'Ok',
                                            }).then(function(){
                                              window.location = '{{route('my.package.view',['all','all'])}}';
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
                        url: '{{ route('generate.payment.link')}}', 
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