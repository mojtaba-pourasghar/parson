@extends('layouts.frontend')
@section('title',__('user.mobile_verify'))
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>__('user.mobile_verify'),'description'=>'','image'=>''])
@endsection
@section('content')

    <main style="padding-top: 0px;">
        <section>


            <div class="chat-main-container">
                <div class="chat-header-box">
                    <div class="support-header-box">
                        <div class="support-chat-heading">
                            <h1 class="chat-heading-title">
                                <a href="#">
                                    پشتیبانی پرسون
                                </a>
                            </h1>
                            <h2 class="chat-sub-title">انلاین</h2>
                        </div>
                        <div class="support-admin-box">
                            <div class="admin-avatar-box" style="right:0px;">
                                <a href="#" class="admin-img-box">
                                    <img src="images/chat-img/Parson-back-logo.png" alt="">
                                    <span class="admin-online"></span>
                                </a>

                            </div>
                            <div class="admin-avatar-box" style="right:30px">
                                <a href="#" class="admin-img-box">
                                    <img src="images/chat-img/Parson-back-logo.png" alt="">
                                </a>
                            </div>
                            <div class="admin-avatar-box" style="right:65px">
                                <a href="#" class="admin-img-box">
                                    <img src="images/chat-img/Parson-back-logo.png" alt="">
                                    <span class="admin-online"></span>
                                </a>
                            </div>



                        </div>
                        <a href="#" class="admin-arrow-box">
                            <i class="fal fa-angle-left"></i>
                        </a>
                    </div>

                </div>
                <div class="support-chat-main">
                    <div class="support-background-opacity">
                    </div>
                    <h3 class="date-title"><span class="date">دوشنبه &ensp; 99/10/12</span></h3>
                    <div id="messages">

                    </div>
                </div>
                <div class="chat-type-box">
                    <form action="#" class="chat-form">
                        <div class="submit-box">
                            <button type="submit" class="chat-btn">
                                <i class="icon icon-send"></i>
                            </button>
                        </div>
                        <input type="text" name="username" id="username" placeholder="enter user name">
                        <div class="text-area-box">

                            <input type="text" name="message" id="mesaage_input" class="chat-textarea" >
                        </div>
                    </form>
                </div>
            </div>



        </section>
    </main>


@endsection
