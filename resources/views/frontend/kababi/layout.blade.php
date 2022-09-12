<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    @include(Views::frontend('meta'))
    @stack('css')
</head>

<body class="header-fixed">

    <div id="wrapper">
        <div id="page" class="clearfix">
            @include(Views::frontend('header'))

            @yield('content')

            @include(Views::frontend('footer'))

        </div>
    </div>

    @include(Views::frontend('js'))

</body>

</html>