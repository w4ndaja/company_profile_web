<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    @include('partials.dashboard.navigation')
    @if(session('success'))
    <section id="success_alert" class="pt-3">
        <div class="container">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    </section>
    <script>
        setTimeout(function(){
            document.getElementById('success_alert').remove()
        }, 2000);
    </script>
    @endif
    <section>
        @yield('content')
    </section>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function previewLogo(input, destination, width = false, height = false) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = document.createElement('img')
                    $(img)
                        .attr('src', e.target.result)
                        .width(width || 150)
                        .height(width || 200);
                    $(destination).html(img)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        function openFile(destination){
            document.querySelector(destination).click()
        }
    </script>
    @stack('scripts')
</body>

</html>