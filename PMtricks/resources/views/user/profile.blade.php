@extends('layouts.app-2')

@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        
        <!-- BEGIN PAGE TITLE-->
        
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        @if($user_details)
                            @if($user_details->profile_pic)
                                <div class="profile-userpic col-md-2" >
                                    <img src="{{ url('storage/profile_picture/'.basename($user_details->profile_pic))}}" class="img-responsive" alt=""> 
                                </div>
                            @endif
                        @endif
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> {{Auth::user()->name}} </div>
                            <div class="profile-usertitle-job"> {{($user_details)? $user_details->occupation: ''}}   </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons">
                           
                        </div>
                        <!-- END SIDEBAR BUTTONS -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                {{-- <li class="active">
                                    <a href="page_user_profile_1_account.html">
                                        <i class="icon-settings"></i> Account Settings </a>
                                </li> --}}
                            </ul>
                        </div>
                        <!-- END MENU -->
                    </div>
                    <!-- END PORTLET MAIN -->
                    <!-- PORTLET MAIN -->
                    <div class="portlet light ">
                        <!-- STAT -->
                        <div class="row list-separated profile-stat">
                            
                            <div class="col-xs-6">
                                <div class="uppercase profile-stat-title"> {{ count( \App\UserScore::where('user_id', '=', Auth::user()->id)->where('score','>=', '50')->get() )}} </div>
                                <div class="uppercase profile-stat-text"> success </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="uppercase profile-stat-title"> {{ count( \App\UserScore::where('user_id', '=', Auth::user()->id)->where('score','<', '50')->get() )}} </div>
                                <div class="uppercase profile-stat-text"> fail </div>
                            </div>
                        </div>
                        <!-- END STAT -->
                        <div>
                            <h4 class="profile-desc-title">About {{Auth::user()->name}}</h4>
                            <span class="profile-desc-text">{{($user_details)? $user_details->about: ''}} </span>
                            @if($user_details)
                                @if($user_details->website_url)
                                    <div class="margin-top-20 profile-desc-link">
                                        <i class="fa fa-globe"></i>
                                        <a target="_blank" href="{{$user_details->website_url}}">{{$user_details->website_url}}</a>
                                    </div>
                                @endif

                                @if($user_details->tw_url)
                                    <div class="margin-top-20 profile-desc-link">
                                        <i class="fa fa-twitter"></i>
                                        <a target="_blank" href="{{$user_details->tw_url}}">Twitter</a>
                                    </div>
                                @endif

                                @if($user_details->fb_url)
                                    <div class="margin-top-20 profile-desc-link">
                                        <i class="fa fa-facebook"></i>
                                        <a target="_blank" href="{{$user_details->fb_url}}">Facebook</a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    @if(!\App\UserDetail::where('user_id', '=', Auth::user()->id)->get()->first() )
                                        <p style="color:brown;">Please, complete your registration by filling this form so that we can verify your identity !</p>
                                    @endif
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">
                                            <form role="form" action="{{ route('user.update.profile') }}" method="post" >
                                                @csrf
                                                <div class="form-group">
                                                    <label class="control-label">Full Name </label>
                                                    <span class="required"> * </span>
                                                    <input type="text" value="{{ Auth::user()->name }}" class="form-control" name="name" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Email </label>
                                                    <span class="required"> * </span>
                                                    <input type="text" value="{{ Auth::user()->email }} " name="email" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Mobaile Numbrer </label>
                                                    <span class="required"> * </span>
                                                    <input type="text" value="{{ Auth::user()->phone }}" name="phone" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">City/Town</label>
                                                    <span class="required"> * </span>
                                                    <input type="text" class="form-control" value="{{ Auth::user()->city }}" name="city" /></div>
                                                <div class="form-group">
                                                    <label class="control-label">Country: {{ Auth::user()->country }}</label>

                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Country</label>
                                                    <span class="required"> * </span>
                                                    <select name="country" id="country_list" class="form-control"> 
                                                        
                                                        <option value="" seleted></option>
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
                                                    </div>
                                                <div class="form-group">
                                                    <label class="control-label">Interests</label>
                                                    <input type="text" placeholder="Interests" class="form-control" value="{{ ($user_details)? $user_details->interests: '' }}" name="interests" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Occupation</label><span class="required"> * </span>
                                                    <input type="text" placeholder="occupation" class="form-control" value="{{ ($user_details)? $user_details->occupation: '' }}" name="occupation" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">About</label>
                                                    <textarea class="form-control" rows="3" placeholder="" name="about">{{ ($user_details)? $user_details->about: '' }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Website Url</label>
                                                    <input type="text" placeholder="http://www.mywebsite.com" class="form-control" value="{{ ($user_details)? $user_details->website_url : '' }}" name="website_url" /> </div>
                                                    <div class="form-group">
                                                    <label class="control-label">Facebook Url</label>
                                                    <input type="text" placeholder="facebook" class="form-control" value="{{ ($user_details)? $user_details->fb_url : '' }}" name="fb_url" /> </div>
                                                    <div class="form-group">
                                                    <label class="control-label">Twitter Url</label>
                                                    <input type="text" placeholder="Twitter" class="form-control" value="{{ ($user_details)? $user_details->tw_url : '' }}" name="tw_url" /> </div>
                                                <div class="margiv-top-10">
                                                    <input type="submit" value="Save Changes" class="btn green">
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PERSONAL INFO TAB -->
                                        <!-- CHANGE AVATAR TAB -->
                                        <div class="tab-pane" id="tab_1_2">
                                            
                                            <form action="{{ route('user.update.profile.pic') }}" method="post" role="form" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="profile_pic"> </span>
                                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="margin-top-10">
                                                    <input type="submit" value="Upload" class="btn green">
                                                    
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE AVATAR TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_1_3">
                                            <form action="{{route('user.update.password') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="control-label">Current Password</label>
                                                    <input name="old_password" type="password" class="form-control" /> 
                                                    @if ($errors->has('old_password'))
                                                        <span class="help-block" style="color:brown;">
                                                            <strong>{{ $errors->first('old_password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">New Password</label>
                                                    <input name="password" type="password" class="form-control" /> 
                                                    @if ($errors->has('password'))
                                                        <span class="help-block" style="color:brown;">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Re-type New Password</label>
                                                    <input name="password_confirmation" type="password" class="form-control" /> </div>
                                                <div class="margin-top-10">
                                                    <input type="submit" value="Change Password" class="btn green">
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
                                        <!-- PRIVACY SETTINGS TAB -->
                                        
                                        <!-- END PRIVACY SETTINGS TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
@endsection

@section('jscode')
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{ asset('assets/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->

    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/profile.min.js')}}" type="text/javascript"></script>
    <script>
    load = 0;
    </script>

@endsection