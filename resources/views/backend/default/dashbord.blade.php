@extends('layouts.default')
@section('title',__('message.dashbord'))

@section('content')
    <div class="row border-bottom white-bg dashboard-header">
        <div class="col-sm-3">
            <h2>خوش آمدید ایمان</h2>
            <small>شما 42 پیغام 6 نوتیفیکیشن دارید.</small>
            <ul class="list-group clear-list m-t">
                <li class="list-group-item fist-item">
                                        <span class="pull-left">
                                            09:00 ب.ظ
                                        </span>
                    <span class="label label-success">1</span> لطفا با من تماس بگیرید
                </li>
                <li class="list-group-item">
                                        <span class="pull-left">
                                            10:16 ق.ظ
                                        </span>
                    <span class="label label-info">2</span> امضای قرارداد
                </li>
                <li class="list-group-item">
                                        <span class="pull-left">
                                            08:22 ب.ظ
                                        </span>
                    <span class="label label-primary">3</span> افتتاح شعبه جدید
                </li>
                <li class="list-group-item">
                                        <span class="pull-left">
                                            11:06 ب.ظ
                                        </span>
                    <span class="label label-default">4</span> تماس با ایمن
                </li>
                <li class="list-group-item">
                                        <span class="pull-left">
                                            12:00 ق.ظ
                                        </span>
                    <span class="label label-primary">5</span> نوشتن نامه به ایمن
                </li>
            </ul>
        </div>
        <div class="col-sm-6">
            <div class="flot-chart dashboard-chart">
                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
            </div>
            <div class="row text-left">
                <div class="col-xs-4">
                    <div class=" m-l-md">
                        <span class="h4 font-bold m-t block">406,100 تومان</span>
                        <small class="text-muted m-b block">گزارش بازاریابی فروش</small>
                    </div>
                </div>
                <div class="col-xs-4">
                    <span class="h4 font-bold m-t block">150,401 تومان</span>
                    <small class="text-muted m-b block">درآمد فروش سالانه</small>
                </div>
                <div class="col-xs-4">
                    <span class="h4 font-bold m-t block">16,822 تومان</span>
                    <small class="text-muted m-b block">درآمد حاشیه ای نیم سال</small>
                </div>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="statistic-box">
                <h4>
                    پیشرفت پروژه بتا
                </h4>
                <p>
                    شما دو پروژه با وظایف تکمیل نشده دارید.
                </p>
                <div class="row text-center">
                    <div class="col-lg-6">
                        <canvas id="polarChart" width="80" height="80"></canvas>
                        <h5 >کولتر</h5>
                    </div>
                    <div class="col-lg-6">
                        <canvas id="doughnutChart" width="78" height="78"></canvas>
                        <h5 >مکستور</h5>
                    </div>
                </div>
                <div class="m-t">
                    <small>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</small>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>اطلاعات جدید جهت گزارش گیری</h5> <span class="label label-primary">برچسب</span>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">گزینه 1</a>
                                        </li>
                                        <li><a href="#">گزینه 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div>

                                    <div class="pull-left text-left">

                                        <span class="bar_dashboard">5,3,9,6,5,9,7,3,5,2,4,7,3,2,7,9,6,4,5,7,3,2,1,0,9,5,6,8,3,2,1</span>
                                        <br/>
                                        <small class="font-bold">20054.43 اتومان</small>
                                    </div>
                                    <h4>اطلاعات جدید !
                                        <br/>
                                        <small class="m-l"><a href="graph_flot.html"> قیمت سهام را بررسی نمایید! </a> </small>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>نظرات زیر را بخوانید</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">گزینه 1</a>
                                        </li>
                                        <li><a href="#">گزینه 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content no-padding">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p><a class="text-info" href="#">@لورم</a> ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                                        <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 دقیقه پیش</small>
                                    </li>
                                    <li class="list-group-item">
                                        <p><a class="text-info" href="#">@لورم</a> ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                        <div class="text-center m">
                                            <span id="sparkline8"></span>
                                        </div>
                                        <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 ساعت پیش</small>
                                    </li>
                                    <li class="list-group-item">
                                        <p><a class="text-info" href="#">@لورم</a> ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                        <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 دقیقه پیش</small>
                                    </li>
                                    <li class="list-group-item ">
                                        <p><a class="text-info" href="#">@لورم</a> ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                                        <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 ساعت پیش</small>
                                    </li>
                                    <li class="list-group-item">
                                        <p><a class="text-info" href="#">@لورم</a> ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                        <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 دقیقه پیش</small>
                                    </li>
                                    <li class="list-group-item ">
                                        <p><a class="text-info" href="#">@لورم</a> ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                                        <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 ساعت پیش</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>خبرهای روزانه</h5>
                                <div class="ibox-tools">
                                    <span class="label label-warning-light">10 پیغام</span>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <div>
                                    <div class="feed-activity-list">

                                        <div class="feed-element">
                                            <a href="profile.html" class="pull-right m-l-xs">
                                                <img alt="image" class="img-circle" src="img/profile.jpg">
                                            </a>
                                            <div class="media-body">
                                                <small class="pull-left">5 دقیقه پیش</small>
                                                <strong>ایمن</strong> پستی در بلاگ اضافه کرد <br>
                                                <small class="text-muted">امروز 5:60 ب.ظ - 1394.06.11</small>

                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="profile.html" class="pull-right m-l-xs">
                                                <img alt="image" class="img-circle" src="img/a2.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-left">2 ساعت پیش</small>
                                                <strong>ایمن</strong> پیغامی به <strong>ایمن</strong> فرستاد. <br>
                                                <small class="text-muted">امروز 2:10 ب.ظ - 1394.06.12</small>
                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="profile.html" class="pull-right m-l-xs">
                                                <img alt="image" class="img-circle" src="img/profile.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-left">5 دقیقه پیش</small>
                                                <strong>ایمن</strong> پستی در بلاگ اضافه کرد <br>
                                                <small class="text-muted">امروز 5:60 ب.ظ - 1394.06.11</small>

                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="profile.html" class="pull-right m-l-xs">
                                                <img alt="image" class="img-circle" src="img/a2.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-left">2 ساعت پیش</small>
                                                <strong>ایمن</strong> پیغامی به <strong>ایمن</strong> فرستاد. <br>
                                                <small class="text-muted">امروز 2:10 ب.ظ - 1394.06.12</small>
                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="profile.html" class="pull-right m-l-xs">
                                                <img alt="image" class="img-circle" src="img/profile.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-left">5 دقیقه پیش</small>
                                                <strong>ایمن</strong> پستی در بلاگ اضافه کرد <br>
                                                <small class="text-muted">امروز 5:60 ب.ظ - 1394.06.11</small>

                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="profile.html" class="pull-right m-l-xs">
                                                <img alt="image" class="img-circle" src="img/a2.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-left">2 ساعت پیش</small>
                                                <strong>ایمن</strong> پیغامی به <strong>ایمن</strong> فرستاد. <br>
                                                <small class="text-muted">امروز 2:10 ب.ظ - 1394.06.12</small>
                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="profile.html" class="pull-right m-l-xs">
                                                <img alt="image" class="img-circle" src="img/profile.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-left">5 دقیقه پیش</small>
                                                <strong>ایمن</strong> پستی در بلاگ اضافه کرد <br>
                                                <small class="text-muted">امروز 5:60 ب.ظ - 1394.06.11</small>

                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> نمایش بیشتر</button>

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>پروژه آلفا</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">گزینه 1</a>
                                        </li>
                                        <li><a href="#">گزینه 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content ibox-heading">
                                <h3>شما امروز قرار ملاقات دارید!</h3>
                                <small><i class="fa fa-map-marker"></i> قرار شما برای ساعت 6 ب.ظ برنامه ریزی شده است.</small>
                            </div>
                            <div class="ibox-content inspinia-timeline">

                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-xs-3 date">
                                            <i class="fa fa-briefcase"></i>
                                            6:00 ق.ظ
                                            <br/>
                                            <small class="text-navy">2 ساعت پیش</small>
                                        </div>
                                        <div class="col-xs-7 content no-top-border">
                                            <p class="m-b-xs"><strong>جلسه</strong></p>

                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>

                                            <p><span data-diameter="40" class="updating-chart">5,3,9,6,5,9,7,3,5,2,5,3,9,6,5,9,4,7,3,2,9,8,7,4,5,1,2,9,5,4,7,2,7,7,3,5,2</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-xs-3 date">
                                            <i class="fa fa-file-text"></i>
                                            7:00 ق.ظ
                                            <br/>
                                            <small class="text-navy">3 ساعت پیش</small>
                                        </div>
                                        <div class="col-xs-7 content">
                                            <p class="m-b-xs"><strong>ارسال مدارک به ایمن</strong></p>
                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-xs-3 date">
                                            <i class="fa fa-coffee"></i>
                                            8:00 ق.ظ
                                            <br/>
                                        </div>
                                        <div class="col-xs-7 content">
                                            <p class="m-b-xs"><strong>وقت استراحت</strong></p>
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-xs-3 date">
                                            <i class="fa fa-phone"></i>
                                            11:00 ق.ظ
                                            <br/>
                                            <small class="text-navy">21 ساعت پیش</small>
                                        </div>
                                        <div class="col-xs-7 content">
                                            <p class="m-b-xs"><strong>تماس با ایمن</strong></p>
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-xs-3 date">
                                            <i class="fa fa-user-md"></i>
                                            09:00 ب.ظ
                                            <br/>
                                            <small>21 ساعت پیش</small>
                                        </div>
                                        <div class="col-xs-7 content">
                                            <p class="m-b-xs"><strong>تماس با ایمن</strong></p>
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-xs-3 date">
                                            <i class="fa fa-comments"></i>
                                            12:50 ب.ظ
                                            <br/>
                                            <small class="text-navy">48 ساعت پیش</small>
                                        </div>
                                        <div class="col-xs-7 content">
                                            <p class="m-b-xs"><strong>گفتگو با ایمن</strong></p>
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="footer">
                <div class="pull-left">
                    10گیگا بایت از<strong>250 گیگابایت</strong> خالی است.
                </div>
                <div>
                    <strong>
                        کلیه حقوق محفوظ است</strong> 1393-1395 &copy; <a href="http://www.webbyme.ir" target="_blank">استودیو طراحی وب من</a>
                </div>
            </div>
        </div>
    </div>
@endsection
