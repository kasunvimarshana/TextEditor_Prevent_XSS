<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:void(0);">{{ config('app.name') }}</a>
        </div>
        <ul class="nav navbar-nav">
            <li class=""><a href="{!! route('home') !!}">Home</a></li>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{!! route('post_a_create') !!}">
                    <span class="glyphicon glyphicon-user"></span> Post A
                </a>
            </li>
            <li>
                <a href="{!! route('post_b_create') !!}">
                    <span class="glyphicon glyphicon-user"></span> Post B
                </a>
            </li>
        </ul>
    </div>
</nav>