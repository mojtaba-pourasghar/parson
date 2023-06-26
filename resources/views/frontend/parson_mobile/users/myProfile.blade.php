@extends('layouts.frontend')
@section('title',$userProfile->name)
@section('keywords','')
@section('description','')
@section('open_graph')
    <meta property='og:site_name' content='{{ $userProfile->name }}'>
    <meta property='og:type' content='website'>
    <meta property='og:title' content='دکتر اينجاست'>
    <meta property='og:description' content='پزشک'>
    <meta property='og:image' content='http://localhost/drinjast/img/logo-menu-fix.png'>
    <meta property='og:image:alt' content='دکتر اينجاست'>
    <meta property='og:url' content='https://www.localhost/drinjast/'>
    <meta property='og:locale' content='fa_IR'>
    <meta name='twitter:title' content='دکتر اينجاست'>
    <meta name='twitter:description' content='پزشک'>
    <meta name='twitter:image' content='http://localhost/drinjast/img/logo-menu-fix.png'>
    <meta name='twitter:card' content='summary'>
    <meta name='twitter:site' content='@drinjast'>
    <meta property='twitter:creator' content='دکتر اينجاست'>
@endsection
@section('content')
    <main>
        <section>

            <div class="kethab-category-container container">
                <!-- filter panels -->
            @include(currentFrontView('partials.users.edit_profile_right_menu'))
            <!-- filter panels -->
                <div class="profile-books-main not-padding col-md-9 col-12">
                    <div class="category-main-box">
                        <div class="library-row-title col-12">
                            <h2 class="library-title">قفسه های من</h2>
                            <h2 class="library-more">
                                <a href="{{ route('user.shelves',[$user->id,$user->name]) }}">
                                    <span class="more-icon fas fa-plus"></span>
                                    بیشتر
                                </a>
                            </h2>
                        </div>
                        <div class="category-books-section justify-content-center">
                            <!-- category books col start -->
                            @foreach($shelves as $shelf)
                                <div class="category-books-col col-lg-6 col-sm-6 col-10">

                                    <div class="library-carousel-item">
                                        <div class="shelves-item-title-box">
                                            <h3 class="shelves-item-title-text col-lg-8">{{ $shelf->title }}</h3>
                                            <div class="shelves-item-comment-box col-4">
                                                <div class="shelves-rate">
                                                    <div class="shelves-rate-icon">
                                                        <img src="{{ frontendTheme('images/icon/star-full.png')}}"
                                                             alt="star-full">
                                                        <span class="shelves-rate-text">4.5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="shelves-item">
                                            <div class="shelves-item-book">
                                                <div class="shelves-book-big-column col-12">

                                                    @foreach($userProfile->bookShelves as $bookShelf)
                                                        @if($bookShelf->shelf->id == $shelf->id)
                                                            <div class="book-big-column-col col-3">
                                                                <img
                                                                    src="{{ getBookImagePath($bookShelf->book->thumbnail) }}"
                                                                    alt="{{ $bookShelf->book->title }}">
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                        @endforeach
                        <!-- category books end -->

                            <!-- category books col start -->
                            <div class="category-books-col col-lg-6 col-sm-6 col-10">
                                <div class="shelve-add-main">
                                    <div class="shelve-col-box">
                                        <i class="fal fa-plus"></i>
                                    </div>
                                    <h3 class="shelve-col-title">قفسه جدید</h3>
                                </div>
                            </div>
                        </div>
                        <!-- category books end -->
                    </div>

                    <div class="profile-books-main writer-profile-section">
                        <div class="library-row-title col-12">
                            <h2 class="library-title">نویسندگان مورد علاقه</h2>
                            <h2 class="library-more">
                                <a href="{{ route('user.follow_writers',[$user->id,$user->name]) }}">
                                    <span class="more-icon fas fa-plus"></span>
                                    بیشتر
                                </a>
                            </h2>
                        </div>
                        <div class="category-books-section">
                            <!-- category books col start -->
                            @foreach($followWriters as $followWriter)
                                <div class="category-books-col col-lg-2 col-4 ">
                                    <div class="books-col-image">
                                        <img src="{{ getPersonImagePath($followWriter->person->thumbnail) }}"
                                             alt="{{ $followWriter->person->title }}">
                                    </div>
                                    <div class="book-info-box">
                                        <h2 class="book-title"><a href="{{ route('writer.view',[$followWriter->person->id,$followWriter->person->slug]) }}">
                                                {{ $followWriter->person->title }}</a></h2>

                                    </div>
                                </div>
                            @endforeach
                        <!-- category books end -->
                            <!-- category books col start -->
                            <div class="book-history-col col-lg-2 col-4 ">
                                <div class="history-col-box">
                                    <i class="fal fa-plus"></i>
                                </div>
                                <div class="book-info-box">
                                    <h3 class="history-col-title">
                                        <a href="#">
                                            نویسنده
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <!-- category books col end -->
                        </div>
                    </div>
                    <div class="profile-books-main writer-profile-section">
                        <div class="library-row-title col-12">
                            <h2 class="library-title">ناشران مورد علاقه</h2>
                            <h2 class="library-more">
                                <a href="{{ route('user.follow_publishers',[$user->id,$user->name]) }}">
                                    <span class="more-icon fas fa-plus"></span>
                                    بیشتر
                                </a>
                            </h2>
                        </div>
                        <div class="category-books-section ">
                            <!-- category books col start -->
                            @foreach($followOrganizations as $followOrganization)
                                <div class="category-books-col col-lg-2 col-4">
                                <div class="books-col-image">
                                    <img
                                        src="{{ getOrganizationImagePath($followOrganization->organization->thumbnail) }}"
                                        alt="{{ $followOrganization->organization->title }}">
                                </div>
                                <div class="book-info-box">
                                    <h2 class="book-title"><a
                                            href="{{ route('organization.view',[$followOrganization->organization->id,$followOrganization->organization->slug]) }}">
                                            {{ $followOrganization->organization->title }}</a></h2>
                                </div>
                            </div>
                            @endforeach
                            <!-- category books end -->

                            <div class="book-history-col col-lg-2 col-4">
                                <div class="history-col-box">
                                    <i class="fal fa-plus"></i>
                                </div>
                                <div class="book-info-box">
                                    <h3 class="history-col-title">
                                        <a href="#">
                                            ناشر جدید
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-books-main naghd-edit col-12">
                        <!-- category books header -->
                        <div class="library-row-title col-12">
                            <h2 class="library-title">نقد و نظرات من</h2>
                            <h2 class="library-more">
                                <a href="{{ route('user.bookcomments',[$user->id,$user->name]) }}">
                                    <span class="more-icon fas fa-plus"></span>
                                    بیشتر
                                </a>
                            </h2>
                        </div>
                        <!-- category-books-header end -->
                        <!-- category-books-section -->
                        <div class="category-books-section">
                            @foreach($userProfile->bookComments as $bookcomment)
                                    @include(currentFrontView('partials.bookcomments.user_profile_comments'),['bookcomment'])
                            @endforeach
                        </div>
                        <div class="library-row-title col-12">
                            <h2 class="library-title">نقل قول های مورد علاقه </h2>
                            <h2 class="library-more">
                                <a href="#">
                                    <span class="more-icon fas fa-plus"></span>
                                    بیشتر
                                </a>
                            </h2>
                        </div>

                        @foreach($favoriteComments as $favoriteComments)
                            @php
                                $bookcomment = $favoriteComments->bookComment;
                            @endphp
                            @include(currentFrontView('partials.bookcomments.user_profile_comments'),['bookcomment'])
                        @endforeach

                    </div>
                    <div class="profile-books-main naghd-edit col-12">
                        <div class="library-row col-12">
                            <div class="library-row-title col-12">
                                <h2 class="library-title">کتاب های مشابه</h2>
                                <h2 class="library-more">
                                    <a href="#">
                                        <span class="more-icon fas fa-plus"></span>
                                        بیشتر

                                    </a>
                                </h2>
                            </div>
                        </div>
                        <div class="kethab-library-carousel not-padding owl-carousel col-12">
                            <div class="library-carousel-item">
                                <div class="book-image-box">
                                    <img src="images/book/book-1.png" alt="book">
                                </div>
                                <div class="book-info-box">
                                    <h2 class="book-title"><a href="#">جنایت و مکافات</a></h2>
                                    <h2 class="book-writer"><a href="#">نویسنده: فئودور دستایوفسکی</a></h2>
                                    <div class="similar-book-star">
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                    </div>
                                    <div class="study-box">
                                        <button class="btn btn-danger more-button" data-whatever="جنایت و مکافات"
                                                data-toggle="modal" data-target="#studyModal">
                                            <span class="more-button-text"> می خواهم بخوانم</span>
                                            <span class="more-button-icon">
                                    <i class="fa-chevron-down fas"></i>
                                  </span>
                                        </button>
                                    </div>


                                </div>
                            </div>
                            <div class="library-carousel-item">
                                <div class="book-image-box">
                                    <img src="images/book/book-2.png" alt="book">
                                </div>
                                <div class="book-info-box">
                                    <h2 class="book-title"><a href="#">صورتت را بشور دختر جان</a></h2>
                                    <h2 class="book-writer"><a href="#">نویسنده: ریچل هالیس</a></h2>
                                    <div class="similar-book-star">
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                    </div>
                                    <div class="study-box">
                                        <button class="btn btn-danger more-button"
                                                data-whatever="صورتت را بشور دختر جان" data-toggle="modal"
                                                data-target="#studyModal">
                                            <span class="more-button-text"> می خواهم بخوانم</span>
                                            <span class="more-button-icon">
                                    <i class="fa-chevron-down fas"></i>
                                  </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="library-carousel-item">
                                <div class="book-image-box">
                                    <img src="images/book/book-3.png" alt="book">
                                </div>
                                <div class="book-info-box">
                                    <h2 class="book-title"><a href="#">دختری در قطار</a></h2>
                                    <h2 class="book-writer"><a href="#">نویسنده: پائولا هاوکینز</a></h2>
                                    <div class="similar-book-star">
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                    </div>
                                    <div class="study-box">
                                        <button class="btn btn-danger more-button" data-whatever="دختری در قطار"
                                                data-toggle="modal" data-target="#studyModal">
                                            <span class="more-button-text"> می خواهم بخوانم</span>
                                            <span class="more-button-icon">
                                    <i class="fa-chevron-down fas"></i>
                                  </span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div class="library-carousel-item">
                                <div class="book-image-box">
                                    <img src="images/book/book-4.png" alt="book">
                                </div>
                                <div class="book-info-box">
                                    <h2 class="book-title"><a href="#">عشق در زمان وبا</a></h2>
                                    <h2 class="book-writer"><a href="#">نویسنده: گابریل گارسیا مارکز</a></h2>
                                    <div class="similar-book-star">
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                    </div>
                                    <div class="study-box">
                                        <button class="btn btn-danger more-button" data-whatever="عشق در زمان وبا"
                                                data-toggle="modal" data-target="#studyModal">
                                            <span class="more-button-text"> می خواهم بخوانم</span>
                                            <span class="more-button-icon">
                                    <i class="fa-chevron-down fas"></i>
                                  </span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div class="library-carousel-item">
                                <div class="book-image-box">
                                    <img src="images/book/book-5.png" alt="book">
                                </div>
                                <div class="book-info-box">
                                    <h2 class="book-title"><a href="#">عقاید یک دلقک</a></h2>
                                    <h2 class="book-writer"><a href="#">نویسنده: هانریش بل </a></h2>
                                    <div class="similar-book-star">
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                    </div>
                                    <div class="study-box">
                                        <button class="btn btn-danger more-button" data-whatever="عقاید یک دلقک"
                                                data-toggle="modal" data-target="#studyModal">
                                            <span class="more-button-text"> می خواهم بخوانم</span>
                                            <span class="more-button-icon">
                                    <i class="fa-chevron-down fas"></i>
                                  </span>
                                        </button>
                                    </div>


                                </div>
                            </div>
                            <div class="library-carousel-item">
                                <div class="book-image-box">
                                    <img src="images/book/book-6.png" alt="book">
                                </div>
                                <div class="book-info-box">
                                    <h2 class="book-title"><a href="#">سمفونی مردگان</a></h2>
                                    <h2 class="book-writer"><a href="#">نویسنده: عباس معروفی</a></h2>
                                    <div class="similar-book-star">
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                    </div>
                                    <div class="study-box">
                                        <button class="btn btn-danger more-button" data-whatever="سمفونی مردگان"
                                                data-toggle="modal" data-target="#studyModal">
                                            <span class="more-button-text"> می خواهم بخوانم</span>
                                            <span class="more-button-icon">
                                    <i class="fa-chevron-down fas"></i>
                                  </span>
                                        </button>
                                    </div>


                                </div>
                            </div>
                            <div class="library-carousel-item">
                                <div class="book-image-box">
                                    <img src="images/book/book-7.png" alt="book">
                                </div>
                                <div class="book-info-box">
                                    <h2 class="book-title"><a href="#">ملت عشق</a></h2>
                                    <h2 class="book-writer"><a href="#">نویسنده: الیف شاکاف</a></h2>
                                    <div class="similar-book-star">
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-orange"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                        <span class="book-star-icon-defualt"><i class="fas fa-star "></i></span>
                                    </div>
                                    <div class="study-box">
                                        <button class="btn btn-danger more-button" data-whatever="ملت عشق"
                                                data-toggle="modal" data-target="#studyModal">
                                            <span class="more-button-text"> می خواهم بخوانم</span>
                                            <span class="more-button-icon">
                                    <i class="fa-chevron-down fas"></i>
                                  </span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- study modal -->
        <div class="modal fade study-modal" id="studyModal" tabindex="-1" role="dialog"
             aria-labelledby="studyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="study-content-box">

                        <div class="study-top-toast">
                            <div class="toast-header-row">
                                         <span class="close-toast" data-dismiss="modal">
                                             <i class="fal fa-times"></i>
                                         </span>
                                <div class="book-title">

                                </div>
                            </div>
                            <div class="study-box-row">
                                <div class="study-box-title want-study"><a href="#">می خواهم بخوانم</a></div>
                                <div class="study-box-title study"><a href="#">خوانده ام</a></div>
                                <div class="study-box-title studing"><a href="#">در حال خواندن</a></div>
                                <div class="study-toast-line"></div>

                            </div>
                            <span class="shelf-button">قفسه های من</span>
                        </div>

                        <div class="study-bottom-toast scrollbar-inner">
                            <div class="toast-header-row">
                                         <span class="close-toast" data-dismiss="modal">
                                             <i class="fal fa-times"></i>
                                         </span>
                                <span class="back-toast">
                                            <i class="fal fa-arrow-right"></i>
                                         </span>
                            </div>

                            <div class="study-box-row">
                                <div class="study-box-title">
                                    <label class="filter-check-row">
                                        <input type="checkbox" class="filter-check-input">
                                        <span class="checkmark"></span>
                                        <span class="filter-check-text">کتاب های روسی</span>
                                    </label>

                                    <label class="filter-check-row">
                                        <input type="checkbox" class="filter-check-input">
                                        <span class="checkmark"></span>
                                        <span class="filter-check-text">کتاب های مورد علاقه من</span>
                                    </label>

                                </div>
                            </div>
                            <div class="study-box-row">
                                <input type="text" class="shelf-name-input" value="نام قفسه را وارد کنید">
                                <button class="btn btn-danger study-box-save">ثبت</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- study modal End -->

        <!-- Share modal  -->
        <div class="modal fade share-modal" id="shareModal" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close">&times;</button>
                    </div>
                    <div class="modal-share-row">
                                        <span class="content-icon-box">
                                          <i class="fal fa-share-alt"></i>
                                        </span>
                    </div>
                    <div class="share-icons-row">
                                  <span class="content-icon-box">
                                    <a href="#">
                                      <img src="images/icon/telegram-main.png" alt="telegram-main">
                                    </a>
                                  </span>
                        <span class="content-icon-box">
                                    <a href="#">
                                      <img src="images/icon/whatsapp.png" alt="whatsapp">
                                    </a>
                                  </span>
                        <span class="content-icon-box">
                                    <a href="#">
                                      <img src="images/icon/twitter-main.png" alt="twitter-main">
                                    </a>
                                  </span>
                        <span class="content-icon-box">
                                    <a href="#">
                                      <img src="images/icon/link.png" alt="link">
                                    </a>
                                  </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Share modal End -->

        <!-- edit Modal -->
        <div class="modal fade edit-modal" id="editModal" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="edit-content-box">
                        <div class="edit-main-box">
                            <div class="edit-header-row">
              <span class="close-edit" data-dismiss="modal">
                <i class="fal fa-times"></i>
              </span>

                            </div>
                            <div class="edit-box-row">

                <span class="delete-icon">
                  <i class="fal fa-trash-alt"></i>
                </span>
                                <textarea class="form-control col-md-9 col-10 edit-comment" rows="5"
                                          placeholder=""></textarea>

                                <button type="button" class="btn btn-danger edit-box-save">ثبت</button>

                                <button type="button" class="btn btn-default edit-box-reset">انصراف</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end edit Modal -->


    </main>
    <script src="{{ frontendTheme('js/lib/profile-carousel.js') }}"></script>
@endsection
