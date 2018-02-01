@extends("layouts.default")
@section("title","home")

@section("contents")
    <nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-burger" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <a href="#" class="navbar-brand">拾柴</a>
            </div>
            <div class="collapse navbar-collapse" >
                <ul class="nav navbar-nav navbar-right navbar-uppercase">
                    <li>
                        <a href="">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="">
                            What We Do
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Famous Freebies
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Premium UI Tools
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Testimonials
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Team
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Numbers
                        </a>
                    </li>
                    <li>
                        <a href="" >
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>
@stop