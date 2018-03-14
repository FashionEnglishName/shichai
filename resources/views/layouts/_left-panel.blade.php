<div id="left-panel">
    @if(Auth::check())
        <!--            头像行            -->
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <a href="#">
                    <img class="center-block img-responsive" src="/profile/u=1611505379,380489200&fm=27&gp=0.jpg" alt="profile" id="profile">
                </a>
            </div>
        </div>

        <!--            用户名行            -->
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <a href="#">
                    <p class="text-center" id="username">{{ Auth::user()->name }}</p>
                </a>
            </div>
        </div>
    @else
        <!--            头像行            -->
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    <a href="#" style="color: #5B5B5B;text-decoration: none">
                        <img class="center-block img-responsive" src="/profile/login.jpg" alt="profile" id="profile">
                        <br>
                        <p class="text-center">请先登录</p>
                    </a>
                </div>
            </div>
    @endif

    <!--            功能列表            -->
    @yield("functions")
</div>