<div class="row">
    <div class="col-xs-12" id="navbar-row">
        <!--  navbar start  -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <ul class="nav navbar-nav" id="navbar-text">
                    <li class="@yield('home',' ')"><a href="#">首页</a></li>
                    <li class="@yield('category',' ')"><a href="#">分类</a></li>
                    <li class="@yield('search',' ')"><a href="#">搜索</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown" id="setting-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="/imgs/setting-icon.png" alt="setting" id="setting-icon"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>