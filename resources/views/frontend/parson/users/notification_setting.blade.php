<main>
    <section>

        <div class="kethab-category-container container">
            <script src="{{ frontendTheme('js/lib/profile-dropdown.js')}}" type="text/javascript"></script>
            <!-- filter panels -->
            @include(currentFrontView('partials.users.edit_profile_right_menu'))
        <!-- filter panels -->
            <div class="category-books-main profile-main col-md-9 col-12">
                <div class="profile-form-section">
                    <div class="library-row-title col-12">
                        <h2 class="library-title">تنظیمات اطلاع رسانی</h2>
                    </div>
                    <form action="" class="profile-form">
                        <div class="form-group col-12">
                            <label class="notification-form-label">خبرنامه</label>
                            <label class="filter-check-row col-lg-3 col-sm-6 col-12">
                                <input type="checkbox" class="filter-check-input">
                                <span class="checkmark"></span>
                                <span class="filter-check-text">از طریق پیامک</span>
                            </label>
                            <label class="filter-check-row col-lg-3 col-sm-6 col-12">
                                <input type="checkbox" class="filter-check-input">
                                <span class="checkmark"></span>
                                <span class="filter-check-text">از طریق ایمیل</span>
                            </label>
                        </div>
                        <div class="form-group col-12">
                            <label class="notification-form-label">نوتیفیکیشن</label>
                            <label class="filter-check-row col-lg-3 col-sm-6 col-12">
                                <input type="checkbox" class="filter-check-input">
                                <span class="checkmark"></span>
                                <span class="filter-check-text">پاسخ به نظر ها و نقد ها</span>
                            </label>
                            <label class="filter-check-row col-lg-3 col-sm-6 col-12">
                                <input type="checkbox" class="filter-check-input">
                                <span class="checkmark"></span>
                                <span class="filter-check-text">کتاب جدید از ناشر</span>
                            </label>
                            <label class="filter-check-row col-lg-3 col-sm-6 col-12">
                                <input type="checkbox" class="filter-check-input">
                                <span class="checkmark"></span>
                                <span class="filter-check-text">کتاب جدید از نویسنده</span>
                            </label>
                            <label class="filter-check-row col-lg-3 col-sm-6 col-12">
                                <input type="checkbox" class="filter-check-input">
                                <span class="checkmark"></span>
                                <span class="filter-check-text">فعالیت دوستان</span>
                            </label>
                        </div>

                        <div class="form-group file-button-box justify-content-center col-12">
                            <button class="btn btn-danger btn-file-save">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>

    </section>

</main>
