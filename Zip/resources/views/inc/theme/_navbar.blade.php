<!--********************************** Nav header start ***********************************-->
<style>
    .nav-header .brand-title {
        margin-left: 15px;
        max-width: 175px;
    }

</style>


<div class="nav-header hidden-print">
    <a href="{{url('/home')}}" class="brand-logo">
        <img class="logo-abbr" src="{{asset('theme/images/fav.png')}}" alt="" style="display: none">
{{--        <img class="logo-compact" src="{{asset('theme/images/fav.png')}}" alt="">--}}
        <img class="brand-title" src="{{asset('theme/images/jadeedworkshop-04.svg')}}" alt="">
{{--        Softagics--}}
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->
<!--**********************************
          Header start
      ***********************************-->
<div class="header hidden-print">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
{{--                    <div class="search_bar dropdown">--}}
{{--                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">--}}
{{--                                    <i class="mdi mdi-magnify"></i>--}}
{{--                                </span>--}}
{{--                        <div class="dropdown-menu p-0 m-0">--}}
{{--                            <form>--}}
{{--                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>

                <ul class="navbar-nav header-right">
{{--                    <li class="nav-item dropdown notification_dropdown">--}}
{{--                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">--}}
{{--                            <i class="mdi mdi-bell"></i>--}}
{{--                            <div class="pulse-css"></div>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                            <ul class="list-unstyled">--}}
{{--                                <li class="media dropdown-item">--}}
{{--                                    <span class="success"><i class="ti-user"></i></span>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#">--}}
{{--                                            <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully--}}
{{--                                            </p>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <span class="notify-time">3:20 am</span>--}}
{{--                                </li>--}}
{{--                                <li class="media dropdown-item">--}}
{{--                                    <span class="primary"><i class="ti-shopping-cart"></i></span>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#">--}}
{{--                                            <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <span class="notify-time">3:20 am</span>--}}
{{--                                </li>--}}
{{--                                <li class="media dropdown-item">--}}
{{--                                    <span class="danger"><i class="ti-bookmark"></i></span>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#">--}}
{{--                                            <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.--}}
{{--                                            </p>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <span class="notify-time">3:20 am</span>--}}
{{--                                </li>--}}
{{--                                <li class="media dropdown-item">--}}
{{--                                    <span class="primary"><i class="ti-heart"></i></span>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#">--}}
{{--                                            <p><strong>David</strong> purchased Light Dashboard 1.0.</p>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <span class="notify-time">3:20 am</span>--}}
{{--                                </li>--}}
{{--                                <li class="media dropdown-item">--}}
{{--                                    <span class="success"><i class="ti-image"></i></span>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#">--}}
{{--                                            <p><strong> James.</strong> has added a<strong>customer</strong> Successfully--}}
{{--                                            </p>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <span class="notify-time">3:20 am</span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <a class="all-notification" href="#">See all notifications <i--}}
{{--                                    class="ti-arrow-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </li>--}}


                    <li class="nav-item dropdown header-profile">{{auth()->user()->name}}</li>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <i class="mdi mdi-account"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
{{--                            <a href="./app-profile.html" class="dropdown-item">--}}
{{--                                <i class="icon-user"></i>--}}
{{--                                <span class="ml-2">Profile </span>--}}
{{--                            </a>--}}
                            <a href="{{ route('settings.create') }}" class="dropdown-item">
                                <i class="icon-envelope-open"></i>
                                <span class="ml-2">Change Password </span>
                            </a>
{{--                            <a href="./page-login.html" class="dropdown-item">--}}
{{--                                <i class="icon-key"></i>--}}
{{--                                <span class="ml-2">Logout </span>--}}
{{--                            </a>--}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="icon-key"></i>
                                <span class="ml-2">Logout </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.hamburger');
        const logoAbbr = document.querySelector('.logo-abbr');

        if (menuToggle && logoAbbr) {
            console.log('Elements found:', menuToggle, logoAbbr);

            menuToggle.addEventListener('click', function() {
                console.log('Hamburger clicked');
                if (logoAbbr.style.display === 'none' || logoAbbr.style.display === '') {
                    logoAbbr.style.display = 'block';
                } else {
                    logoAbbr.style.display = 'none';
                }
                console.log('logoAbbr display:', logoAbbr.style.display);
            });
        } else {
            console.error('Elements not found');
        }
    });
</script>

