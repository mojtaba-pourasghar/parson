<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ backendTheme('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ backendTheme('css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ backendTheme('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{ backendTheme('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ backendTheme('css/plugins/iCheck/custom.css') }}" rel="stylesheet">

    <link href="{{backendTheme('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.rtl.css') }}"
          rel="stylesheet">
    <!-- Gritter -->
    <link href="{{ backendTheme('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ backendTheme('css/animate.css') }}" rel="stylesheet">
    <link href="{{ backendTheme('css/style.rtl.css') }}" rel="stylesheet">
    <script src="{{ backendTheme('js/jquery-2.1.1.js') }}"></script>

    <link href="{{ backendTheme('css/plugins/chosen/chosen.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ backendTheme('js/global.js') }}"></script>
    <script src="{{ backendTheme('js/plugins/chosen/chosen.jquery.js') }} "></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                 </span> <span class="text-muted text-xs block">{{ $admin->name }}<b class="caret"></b></span> </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInLeft m-t-xs">
                            <li><a href="{{ route('backend.users.edit',$admin->id) }}">@lang('user.profile')</a></li>
                            <li><a href="{{ route('backend.users.index') }}">@lang('user.users_managment')</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('backend.logout') }}">@lang('message.exit')</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        لوگو
                    </div>
                </li>

                <li class="{{ Request::segment(2)==='dashbord' ? 'active' : '' }}">
                    <a href="{{ route('backend.dashbord') }}"><i class="fa fa-th-large"></i>
                        <span class="nav-label">@lang('message.dashbord')</span></a>
                </li>
                <li class="{{ (Request::segment(2)==='pages') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-book"></i> <span
                            class="nav-label">@lang('page.pages_managment')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ Request::segment(2)==='pages' ? 'active' : '' }}"><a
                                href="{{ route('backend.pages.index') }}">@lang('page.pages_static_managment')</a></li>
                    </ul>
                </li>
                <li class="{{ (Request::segment(2)==='users'|| Request::segment(2)==='roles'|| Request::segment(2)==='userimages') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-users"></i> <span
                            class="nav-label">@lang('user.users_managment')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ Request::segment(2)==='roles' ? 'active' : '' }}"><a
                                href="{{ route('backend.roles.index') }}">@lang('user.roles_managment')</a></li>
                        <li class="{{ Request::segment(2)==='users' ? 'active' : '' }}"><a
                                href="{{ route('backend.users.index') }}">@lang('user.users_managment')</a></li>
                        <li class="{{ Request::segment(2)==='userimages' ? 'active' : '' }}"><a
                                href="{{ route('backend.userimages.index') }}">@lang('userimage.userimages_managment')</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ (Request::segment(2)==='categories' || Request::segment(2)==='pricepatterns'|| Request::segment(2)==='textiles'|| Request::segment(2)==='textiletypes'|| Request::segment(2)==='hashtags' || Request::segment(2)==='discounttypes') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-ioxhost"></i> <span
                            class="nav-label">@lang('textile.textiles_managment')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ Request::segment(2)==='categories' ? 'active' : '' }}">
                            <a href="{{ route('backend.categories.index') }}">@lang('category.categories_managment')</a>
                        </li>
                        <li class="{{ Request::segment(2)==='discounttypes' ? 'active' : '' }}">
                            <a href="{{ route('backend.discounttypes.index') }}">@lang('discount_type.discount_types_managment')</a>
                        </li>
                        <li class="{{ Request::segment(2)==='pricepatterns' ? 'active' : '' }}">
                            <a href="{{ route('backend.pricepatterns.index') }}">@lang('price_pattern.price_patterns_managment')</a>
                        </li>
                        <li class="{{ Request::segment(2)==='textiletypes' ? 'active' : '' }}">
                            <a href="{{ route('backend.textiletypes.index') }}">@lang('textile_type.textile_types_managment')</a>
                        </li>
                        <li class="{{ Request::segment(2)==='hashtags' ? 'active' : '' }}">
                            <a href="{{ route('backend.hashtags.index') }}">@lang('hashtag.hashtags_managment')</a>
                        </li>
                        <li class="{{ Request::segment(2)==='textiles' ? 'active' : '' }}">
                            <a href="{{ route('backend.textiles.index') }}">@lang('textile.textiles_managment')</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (Request::segment(2)==='orders' ) ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-list-ol"></i> <span
                            class="nav-label">@lang('order.orders_managment')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ Request::segment(2)==='orders' ? 'active' : '' }}"><a
                                href="{{ route('backend.orders.index') }}">@lang('order.orders_managment')</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (Request::segment(2)==='blogs' || Request::segment(2)==='blogtags'|| Request::segment(2)==='blogcomments') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-newspaper-o"></i> <span
                            class="nav-label">@lang('blog.blogs_managment')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ Request::segment(2)==='blogtags' ? 'active' : '' }}"><a
                                href="{{ route('backend.blogtags.index') }}">@lang('blogtag.blogtags_managment')</a>
                        </li>
                        <li class="{{ Request::segment(2)==='blogs' ? 'active' : '' }}"><a
                                href="{{ route('backend.blogs.index') }}">@lang('blog.blogs_managment')</a></li>
                    </ul>
                </li>


                <li class="{{ (Request::segment(2)==='trends' || Request::segment(2)==='trendtags'|| Request::segment(2)==='trendcategories'|| Request::segment(2)==='trendcomments') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa fa-tumblr"></i> <span
                            class="nav-label">@lang('trend.trends_managment')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ Request::segment(2)==='trendtags' ? 'active' : '' }}"><a
                                href="{{ route('backend.trendtags.index') }}">@lang('trend_tag.trend_tags_managment')</a>
                        </li>
                        <li class="{{ Request::segment(2)==='trendcategories' ? 'active' : '' }}"><a
                                href="{{ route('backend.trendcategories.index') }}">@lang('trend_category.trend_categories_managment')</a>
                        </li>
                        <li class="{{ Request::segment(2)==='trends' ? 'active' : '' }}"><a
                                href="{{ route('backend.trends.index') }}">@lang('trend.trends_managment')</a></li>
                    </ul>
                </li>
                <li class="{{ Request::segment(2)==='faqs' ? 'active' : '' }}">
                    <a href="{{ route('backend.faqs.index') }}"><i class="fa fa-question"></i>
                        <span class="nav-label">@lang('faq.faqs_managment')</span></a>
                </li>
                <li class="{{ Request::segment(2)==='sliders' ? 'active' : '' }}">
                    <a href="{{ route('backend.sliders.index') }}"><i class="fa fa-image"></i>
                        <span class="nav-label">@lang('slider.sliders_managment')</span></a>
                </li>
                <li class="{{ Request::segment(2)==='siteinformations' ? 'active' : '' }}">
                    <a href="{{ route('backend.siteinformations.edit') }}"><i class="fa fa-info"></i>
                        <span class="nav-label">@lang('siteinformation.siteinformations_managment')</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <!--<input type="text" placeholder="جستجو" class="form-control" name="top-search"
                                   id="top-search">-->
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-left">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">به بخش مدیریت خوش آمدید</span>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-right">
                                        <img alt="image" class="img-circle" src="img/a4.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-left text-navy">5 ساعت پیش</small>
                                        <strong>ایمن</strong> لورم ایپسوم <strong>ایمن</strong>. <br>
                                        <small class="text-muted">دیروز 1:21 ب.ظ - 1394/06/10</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-right">
                                        <img alt="image" class="img-circle" src="img/a7.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-left">46 ساعت پیش</small>
                                        <strong>ایمان عباسی</strong> لورم ایپسوم <strong>ایمن</strong>. <br>
                                        <small class="text-muted">3 روز پیش در 7:58 ب.ظ - 1394/06/10</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-right">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-left">23 ساعت پیش</small>
                                        <strong>ایمان عباسی</strong> لورم ایپسوم <strong>ایمن</strong>. <br>
                                        <small class="text-muted">2 وز پیش در 2:30 ق.ظ - 1394/06/10</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="mailbox.html">
                                        <i class="fa fa-envelope"></i> <strong>مشاهده همه پیغام ها</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> شما 16 پیغام دارید
                                        <span class="pull-left text-muted small">4 دقیقه پیش</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 فالوور جدید
                                        <span class="pull-left text-muted small">12 دقیقه پیش</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="grid_options.html">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> سرور ری استارت شد
                                        <span class="pull-left text-muted small">4 دقیقه پیش</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="notifications.html">
                                        <strong>مشاهده همه هشدار ها</strong>
                                        <i class="fa fa-angle-left fa-lg fa-fw"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ route('backend.logout') }}"><i class="fa fa-sign-out"></i>@lang('message.exit')</a>
                    </li>
                    <li>
                        <a class="left-sidebar-toggle">
                            <i class="fa fa-tasks"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                @foreach($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
        @endif
        @if ($status)
            <div class="alert alert-info alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ $status }}
            </div>
        @endif
        @if ($warning)
            <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ $warning }}
            </div>
        @endif
        @yield('content')
    </div>
    <div class="small-chat-box fadeInRight animated">

        <div class="heading" draggable="true">
            <small class="chat-date pull-left">
                1394.10.20
            </small>
            گفتگو زنده
        </div>

        <div class="content">

            <div class="left">
                <div class="author-name">
                    ایمن <small class="chat-date">
                        10:02 ق.ظ
                    </small>
                </div>
                <div class="chat-message active">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                </div>

            </div>
            <div class="right">
                <div class="author-name">
                    نیک
                    <small class="chat-date">
                        11:24 ق.ظ
                    </small>
                </div>
                <div class="chat-message">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم.
                </div>
            </div>
            <div class="left">
                <div class="author-name">
                    آلیس
                    <small class="chat-date">
                        08:45 ب.ظ
                    </small>
                </div>
                <div class="chat-message active">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                </div>
            </div>
            <div class="right">
                <div class="author-name">
                    آنا
                    <small class="chat-date">
                        11:24 ق.ظ
                    </small>
                </div>
                <div class="chat-message">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                </div>
            </div>
            <div class="left">
                <div class="author-name">
                    نیک
                    <small class="chat-date">
                        08:45 ب.ظ
                    </small>
                </div>
                <div class="chat-message active">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                </div>
            </div>


        </div>
        <div class="form-chat">
            <div class="input-group input-group-sm"><input type="text" class="form-control"> <span
                    class="input-group-btn"> <button
                        class="btn btn-primary" type="button">ارسال
                    </button> </span></div>
        </div>
    </div>
    <div id="small-chat">
        <span class="badge badge-warning pull-right">5</span>
        <a class="open-small-chat">
            <i class="fa fa-comments"></i>
        </a>
    </div>
    <div id="left-sidebar">
        <div class="sidebar-container">
            <ul class="nav nav-tabs navs-3">
                <li class="active"><a data-toggle="tab" href="#tab-1">
                        یادداشت ها
                    </a></li>
                <li><a data-toggle="tab" href="#tab-2">
                        پروژه ها
                    </a></li>
                <li class=""><a data-toggle="tab" href="#tab-3">
                        <i class="fa fa-gear"></i>
                    </a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="sidebar-title">
                        <h3><i class="fa fa-comments-o"></i> آخرین یادداشت ها</h3>
                        <small><i class="fa fa-tim"></i> شما 10 پیغام جدید دارید.</small>
                    </div>
                    <div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-right text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">

                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                                    <br>
                                    <small class="text-muted">امروز 4:21 ب.ظ</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-right text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a2.jpg">
                                </div>
                                <div class="media-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                                    <br>
                                    <small class="text-muted">دیروز 2:45 ب.ظ</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-right text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                                    <br>
                                    <small class="text-muted">دیروز 1:10 ب.ظ</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-right text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                </div>

                                <div class="media-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                                    <br>
                                    <small class="text-muted">دوشنبه 8:37 ب.ظ</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-right text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a8.jpg">
                                </div>
                                <div class="media-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                                    <br>
                                    <small class="text-muted">امروز 4:21 ب.ظ</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-right text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a7.jpg">
                                </div>
                                <div class="media-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                                    <br>
                                    <small class="text-muted">دیروز 2:45 ب.ظ</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-right text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                                    <br>
                                    <small class="text-muted">دیروز 1:10 ب.ظ</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-right text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                </div>
                                <div class="media-body">
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                                    <br>
                                    <small class="text-muted">دوشنبه 8:37 ب.ظ</small>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

                <div id="tab-2" class="tab-pane">

                    <div class="sidebar-title">
                        <h3><i class="fa fa-cube"></i> آخریم پروژه ها</h3>
                        <small><i class="fa fa-tim"></i> شما 14 پروژه دارید که 10 تای آن نا تمام است.</small>
                    </div>

                    <ul class="sidebar-list">
                        <li>
                            <a href="#">
                                <div class="small pull-left m-t-xs">9 ساعت پیش</div>
                                <h4>پروژه ی لورم</h4>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده.
                                <div class="small">درصد پیشرفت: 22%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                </div>
                                <div class="small text-muted m-t-xs">تاریخ پایان: 4:00 ب.ظ - 1394/06/10</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-left m-t-xs">9 ساعت پیش</div>
                                <h4>قرارداد با شرکت </h4>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.
                                <div class="small">درصد پیشرفت: 48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-left m-t-xs">9 ساعت پیش</div>
                                <h4>جلسه</h4>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.
                                <div class="small">درصد پیشرفت: 14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-primary pull-left">جدید</span>
                                <h4>تولید</h4>
                                <!--<div class="small pull-right m-t-xs">9 ساعت پیش</div>-->
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.
                                <div class="small">درصد پیشرفت: 22%</div>
                                <div class="small text-muted m-t-xs">تاریخ پایان: 4:00 ب.ظ - 1394/05/31</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-left m-t-xs">9 ساعت پیش</div>
                                <h4>پروژه</h4>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.
                                <div class="small">درصد پیشرفت: 22%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                </div>
                                <div class="small text-muted m-t-xs">تاریخ پایان: 4:00 ب.ظ - 1394/02/14</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-left m-t-xs">9 ساعت پیش</div>
                                <h4>قرارداد مجدد </h4>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.
                                <div class="small">درصد پیشرفت: 48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-left m-t-xs">9 ساعت پیش</div>
                                <h4>جلسه</h4>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.
                                <div class="small">درصد پیشرفت: 14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-primary pull-left">جدید</span>
                                <h4>تولید</h4>
                                <!--<div class="small pull-right m-t-xs">9 ساعت پیش</div>-->
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است.
                                <div class="small">درصد پیشرفت: 22%</div>
                                <div class="small text-muted m-t-xs">تاریخ پایان: 4:00 ب.ظ - 1394/06/14</div>
                            </a>
                        </li>

                    </ul>

                </div>

                <div id="tab-3" class="tab-pane">

                    <div class="sidebar-title">
                        <h3><i class="fa fa-gears"></i> تنظیمات</h3>
                        <small><i class="fa fa-tim"></i> شما 14 پروژه دارید که 10 تای آن نا تمام است.</small>
                    </div>

                    <div class="setings-item">
                        <span>
                            نمایش اطلاع رسانی
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                <label class="onoffswitch-label" for="example">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            غیرفعال کردن گفتگو
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox"
                                       id="example2">
                                <label class="onoffswitch-label" for="example2">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            فعال سازی تاریخچه
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                <label class="onoffswitch-label" for="example3">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            نمایش چارت ها
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                <label class="onoffswitch-label" for="example4">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            کاربران آفلاین
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox"
                                       id="example5">
                                <label class="onoffswitch-label" for="example5">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            جستجوی عمومی
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox"
                                       id="example6">
                                <label class="onoffswitch-label" for="example6">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            بروزرسانی روزانه
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                <label class="onoffswitch-label" for="example7">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-content">
                        <h4>تنظیمات</h4>
                        <div class="small">
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Mainly scripts -->

<script src="{{ backendTheme('js/bootstrap.min.js') }}"></script>
<script src="{{ backendTheme('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ backendTheme('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Flot -->
<script src="{{ backendTheme('js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ backendTheme('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ backendTheme('js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ backendTheme('js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ backendTheme('js/plugins/flot/jquery.flot.pie.js') }}"></script>

<!-- Peity -->
<script src="{{ backendTheme('js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ backendTheme('js/demo/peity-demo.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ backendTheme('js/rada.js') }}"></script>
<script src="{{ backendTheme('js/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ backendTheme('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- GITTER -->
<script src="{{ backendTheme('js/plugins/gritter/jquery.gritter.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ backendTheme('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->
<script src="{{ backendTheme('js/demo/sparkline-demo.js') }}"></script>

<!-- ChartJS-->
<script src="{{ backendTheme('js/plugins/chartJs/Chart.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ backendTheme('js/plugins/toastr/toastr.min.js') }}"></script>

<!-- Chosen -->

<!-- iCheck -->
<script src="{{ backendTheme('js/plugins/iCheck/icheck.min.js') }}"></script>

</body>
</html>
