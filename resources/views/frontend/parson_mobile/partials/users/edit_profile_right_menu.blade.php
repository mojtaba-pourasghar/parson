<div class="profile-sidebar column-5">

    <div class="profile-sidebar-box">
        <div class="profile-user-info">

            <a href="#" class="profile-image-box">
                <img src="{{ $loginUser->image }}" alt="">
            </a>
            <h2 class="user-title">{{ $loginUser->name }}</h2>
            <h3 class="user-phone">{{ $loginUser->mobile }}</h3>
        </div>
        <div class="profile-button-row">
            <a href="profile-wallet.html" class="profile-button wallet-btn">کیف پول</a>
            <a href="{{ route('wallet.add') }}" class="profile-button edit-pf-btn">افزایش اعتبار</a>
        </div>
        <div class="user-profile-menu">
            <div class="profile-menu-item {{ ($active == 'edit') ? 'active' : '' }}">
                <a href="{{ route('user.edit') }}">
                    <span class="item-icon">
                        <i class="icon icon-profile-edit"></i>
                    </span>
                    @lang('user.edit_profile')
                </a>
            </div>
            <div class="profile-menu-item {{ ($active == 'orders') ? 'active' : '' }}">
                <a href="{{ route('order.list') }}">
                     <span class="item-icon">
                         <i class="icon icon-order"></i>
                     </span>
                    @lang('order.list')
                </a>
            </div>
            <div class="profile-menu-item {{ ($active == 'change_password') ? 'active' : '' }}">
                <a href="{{ route('user.change_password') }}">
                    <span class="item-icon">
                        <i class="icon icon-key"></i>
                    </span>
                    @lang('user.change_password')
                </a>
            </div>
            <div class="profile-menu-item {{ ($active == 'bookmarks') ? 'active' : '' }}">
                <a href="{{ route('bookmark.list') }}">
                    <span class="item-icon">
                        <i class="icon icon-save"></i>
                    </span>
                    ذخیره شده ها
                </a>
            </div>
            <div class="profile-menu-item {{ ($active == 'addresses') ? 'active' : '' }}">
                <a href="{{ route('userdetail.addresses') }}">
                    <span class="item-icon">
                        <i class="icon icon-location"></i>
                    </span>
                    لیست آدرس ها
                </a>
            </div>
            <div class="profile-menu-item {{ ($active == 'change_image') ? 'active' : '' }}">
                <a href="{{ route('user.change_image') }}">
                    <span class="item-icon">
                        <i class="icon icon-edit-alt"></i>
                    </span>
                    @lang('user.change_image')
                </a>
            </div>
        </div>
    </div>
</div>



