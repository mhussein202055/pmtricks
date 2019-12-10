






<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    
    

    <head>
        <meta charset="utf-8" />
        <title>PM-Tricks | Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <style>
            a#prev, a#next, a.aElement {
                color: #333 !important;
            }
            a#prev:hover, a#next:hover, a.aElement:hover{
                text-decoration: none !important;
                
                color: dimgray !important;

            }
            
            
        </style>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link rel="icon" href="<?php echo e(asset('img/pmplearning.jpg')); ?>">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo e(asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/morris/morris.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/fullcalendar/fullcalendar.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/pages/css/faq.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo e(asset('assets/global/css/components.min.css')); ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo e(asset('assets/global/css/plugins.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo e(asset('assets/layouts/layout/css/layout.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/layouts/layout/css/themes/light.min.css')); ?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo e(asset('assets/layouts/layout/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/pages/css/blog.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
        
        <style>
        
        @media  print { body { display:none } }
        
        body, html{     
            /* Prevent selection */
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;  
        }
        .contral-question {
            display:flex;
            flex-direction: row;
            flex-wrap: wrap;
            /* justify-content: space-between; */

        }
        .contral-question {
                display:flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: space-between; 
    
        }
        .contral-question > div {
            margin: 0 11px 3px 0;
        }
        .options > div > label{
            font-weight:bold;
        }
        </style>


        <?php echo $__env->yieldContent('head'); ?>
        <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N9L8423');</script>
<!-- End Google Tag Manager -->
    </head>
    <!-- END HEAD -->

    


    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white all-body">
        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N9L8423"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        
        <div class="container prsc-msg" style=" display:none; background: #fff; color: red; padding: 20px; min-width:100px; min-height: 40px; margin: 30px auto;">
            <div class="row" style="padding: 20px;">
                This action is not allowed , Content is Protected !<br/><br/>
                please Click (Go Back)

            </div>
            <div class="row" style="padding: 20px;">
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 Go Back </a>
            </div>
        </div>

        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top" style="background-color: #000000;">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="index.html">
                        <img src="<?php echo e(asset('assets/layouts/layout/img/logo-light.png')); ?>" alt="logo" class="logo-default" style="margin:10px 0;" /> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                    
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <div class="btn-group" style="padding-top:10px">
                        <button type="button" class="btn red btn-sm" ><a href="<?php echo e(route('index')); ?>" style="color:#ffffff">Home</a> </button>
					</div>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu" style="float:right !important;">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
                                

                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    
                                    <h3 class="pending_notification">
                                        <span class="bold">
                                            
                                             pending</span> notifications
                                        
                                    </h3>
                                    <a class="makeAsRead btn btn-link">Make Read</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        
                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <?php if(Auth::check()): ?>
                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-envelope-open"></i>
                                    <?php if( count(\App\Message::where('to_user_type','=','user')
                                        ->where('sight','=',0)
                                        ->where('to_user_id', '=', Auth::user()->id)
                                        ->get() )
                                        ): ?>
                                    <span class="badge badge-default pending_msg_remove"> <?php echo e(count(\App\Message::where('to_user_type','=','user')->where('sight','=',0)->where('to_user_id', '=', Auth::user()->id)->get())); ?> </span>
                                    <?php endif; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3 class="pending_msg_edit">You have
                                            <span class="bold"><?php echo e(count(\App\Message::where('to_user_type','=','user')->where('sight','=',0)->where('to_user_id', '=', Auth::user()->id)->get())); ?> New</span> Messages
                                        </h3>
                                        <a class="massage_make_as_read">Make read</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <?php $__currentLoopData = \App\Message::where('to_user_type','=','user')->where('to_user_id', '=',Auth::user()->id)->orderBy('created_at','desc')->get()->take(30); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(route('user.inboxv2')); ?>?user_id=<?php echo e($msg->from_user_id); ?>">
                                                    <span class="photo">
                                                        <img src="<?php echo e(asset('assets/layouts/layout3/img/avatar2.jpg')); ?>" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> <?php echo e(\App\Admin::find($msg->from_user_id)->name); ?> </span>
                                                        <span class="time"> <?php echo e($msg->created_at->format('j M Y')); ?> </span>
                                                    </span>
                                                    <span class="message"> <?php echo $msg->message; ?> </span>
                                                </a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <!-- END INBOX DROPDOWN -->
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" 
                                <?php if(Auth::check()): ?>
                                    <?php if(\App\UserDetail::where('user_id', '=', Auth::user()->id)->get()->first() ): ?>
                                        <?php if(\App\UserDetail::where('user_id', '=', Auth::user()->id)->get()->first()->profile_pic): ?>
                                            src="<?php echo e(url('storage/profile_picture/'.basename(\App\UserDetail::where('user_id','=',Auth::user()->id)->get()->first()->profile_pic))); ?>"
                                        <?php else: ?>
                                            src="<?php echo e(asset('assets/layouts/layout/img/avatar3_small.jpg')); ?>" 
                                        <?php endif; ?>
                                    <?php else: ?>    
                                        src="<?php echo e(asset('assets/layouts/layout/img/avatar3_small.jpg')); ?>" 
                                    <?php endif; ?>
                                <?php endif; ?>
                                />
                                <span class="username username-hide-on-mobile"> 
                                    <?php if(Auth::check()): ?>
                                        <?php echo e(Auth::user()->name); ?>

                                    <?php endif; ?>
                                </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?php echo e(route('user.inboxv2')); ?>">
                                        <i class="icon-envelope-open"></i>Inbox
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="icon-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                            
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>
                        <li class="nav-item start active">
                            <a href="<?php echo e(route('user.dashboard')); ?>" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                
                            </a>
                        </li>
                        <li class="nav-item start">
                            <a href="<?php echo e(route('show.profile')); ?>" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">Profile</span>
                                
                            </a>
                        </li>
                        

                        
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-basket"></i>
                                <span class="title">All Courses</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php $__currentLoopData = \App\Course::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('showAllPackages', $c->id)); ?>" class="nav-link ">
                                        <span class="title"><?php echo e($c->title); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                         <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-book-open"></i>
                                <span class="title">Free Resources</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('FreeQuiz')); ?>" class="nav-link ">
                                        <span class="title">Simulated Exam</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('video.index.free')); ?>" class="nav-link ">
                                        <span class="title">Free Videos</span>
                                    </a>
                                </li>
                                
                                <!--<li class="nav-item  ">-->
                                <!--    <a href="<?php echo e(route('scoreHistory')); ?>" class="nav-link ">-->
                                <!--        <span class="title">Score History</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <!--<li class="nav-item  ">-->
                                <!--    <a href="<?php echo e(route('QuizHistoryShow')); ?>" class="nav-link ">-->
                                <!--        <span class="title">Exam History  </span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">My Courses</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('PremiumQuiz-st1')); ?>" class="nav-link ">
                                        <span class="title">Mock Exams & Videos</span>
                                    </a>
                                </li>
                                 
                                <!--<li class="nav-item  ">-->
                                <!--    <a href="<?php echo e(route('scoreHistory')); ?>" class="nav-link ">-->
                                <!--        <span class="title">Score History</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <!--<li class="nav-item  ">-->
                                <!--    <a href="<?php echo e(route('QuizHistoryShow')); ?>" class="nav-link ">-->
                                <!--        <span class="title">Exam History  </span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                
                            </ul>
                        </li>
                        
                         <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-flash"></i>
                                <span class="title">Flash Card</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('flashCard.index')); ?>" class="nav-link ">
                                        <span class="title">PMP Notes</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-paper-plane-o"></i>
                                <span class="title">Study Plan</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php $__currentLoopData = \App\Course::where('private', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('studyPlan.show', $c->id)); ?>" class="nav-link ">
                                        <span class="title"><?php echo e($c->title); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-docs"></i>
                                <span class="title">Study Material</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php $__currentLoopData = \App\Course::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('material.show', $c->id)); ?>" class="nav-link ">
                                        <span class="title"><?php echo e($c->title); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                       
                         <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Exam Analytics</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <!--<li class="nav-item  ">-->
                                <!--    <a href="<?php echo e(route('scoreHistory')); ?>" class="nav-link ">-->
                                <!--        <span class="title">Score History</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('QuizHistoryShow')); ?>" class="nav-link ">
                                        <span class="title">Simulated Exam  </span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                       <li class="nav-item start">
                            <a href="<?php echo e(route('faq.index')); ?>" class="nav-link nav-toggle">
                                <i class="icon-feed"></i>
                                <span class="title">FAQs</span>
                                
                            </a>
                        </li>
                        <li class="nav-item start">
                            <a href="<?php echo e(route('user.feedback.index')); ?>" class="nav-link nav-toggle">
                                <i class="icon-feed"></i>
                                <span class="title">FeedBack</span>
                                
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">My Account </span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="" class="nav-link ">
										<span class="title">My Profile </span>
                                    </a>
                                </li>
                                
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('user.index')); ?>" class="nav-link ">
                                        <span class="title">My Inbox</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item  ">
                            
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link nav-toggle">
                                <i class="icon-key"></i>
                                <span class="title">Logout</span>
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->

            
            
            
            
            
                <?php echo $__env->make('include.msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            
            
            
            
            <?php echo $__env->yieldContent('content'); ?>







            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>
            
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2019 &copy; PM-Tricks.
                <a href="http://adtit.com" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Powerd by Adtit</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <?php echo $__env->yieldContent('jscode'); ?>

        
    
        
        
        <script>


            var checkMe = setInterval(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax ({
                    type: 'POST',
                    url: '<?php echo e(route('security.check')); ?>', 
                    success: function(res){
                        if(res != 200){
                            document.location.href = "<?php echo e(route('login')); ?>";
                        }
                    },
                    error: function(res){
                        console.log('Error:', res);    
                    }
                });
            }, 10000); // 30 sec

        
            document.addEventListener('contextmenu', event => event.preventDefault());
            
            $(window).keyup(function(e){
                if(e.keyCode == 44){
                    $(".page-header").hide();
                    $(".page-container").hide();
                    $(".page-footer").hide();
                    $(".prsc-msg").show();


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax ({
                        type: 'GET',
                        url: '<?php echo e(route('ScreenShot')); ?>', 
                        success: function(res){
                            
                        },
                        error: function(res){
                            console.log('Error:', res);    
                        }
                    });

                }
            });

            // if( navigator.userAgent.match(/Android/i)
            // || navigator.userAgent.match(/webOS/i)
            // || navigator.userAgent.match(/iPhone/i)
            // || navigator.userAgent.match(/iPad/i)
            // || navigator.userAgent.match(/iPod/i)
            // || navigator.userAgent.match(/BlackBerry/i)
            // || navigator.userAgent.match(/Windows Phone/i)
            // ){
            //     <?php if(\Illuminate\Support\Facades\Input::get('ignore') != 1): ?>
            //         window.location = '<?php echo e(route('mobile.redirect')); ?>';
            //     <?php endif; ?>

                
                




            // }

            <?php if(Auth::user()): ?>
                target = '<?php echo e(route('show.profile')); ?>';

                <?php if(!\App\UserDetail::where('user_id', '=', Auth::user()->id)->get()->first()): ?>
                // if(window.location.href != target){
                //     window.location = target;
                // }
                <?php endif; ?>
            <?php endif; ?>

            $('.makeAsRead').click(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax ({
                    type: 'POST',
                    url: '<?php echo e(route('MakeRead')); ?>', 
                    success: function(res){
                        $('.pending_notification').html('<span class="bold">0 pending</span> notifications');
                        $('.pendingg_notification_count').remove();
                    },
                    error: function(res){
                        console.log('Error:', res);    
                    }
                });
            });

            $('.massage_make_as_read').click(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax ({
                    type: 'POST',
                    url: '<?php echo e(route('MakeReadMsg')); ?>', 
                    success: function(res){
                        $('.pending_msg_edit').html('<span class="bold">0 New</span> messages');
                        $('.pending_msg_remove').remove();
                    },
                    error: function(res){
                        console.log('Error:', res);    
                    }
                });
            });
            
            
        </script>
        
        
    </body>

</html>