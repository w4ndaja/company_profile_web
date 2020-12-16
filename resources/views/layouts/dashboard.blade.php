<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
    @stack('heads')
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
        $('a[href="'+document.location.href+'"]').addClass('active').parent().parent('li.nav-item').addClass('active')
        $('a[href="'+document.location.pathname+'"]').addClass('active').parent().parent('li.nav-item').addClass('active')
        function showConfirmDelete(e, data){
            var modal = document.querySelector(e.dataset.target)
            var form = modal.querySelector('form')
            var action = form.getAttribute('action')
            var newAction = action+'/'+data.id
            modal.querySelector('.delete-warning-message').innerHTML = data.name
            form.setAttribute('action', newAction)
            $(modal).on('hidden.bs.modal', function(e){
                form.setAttribute('action', action)
            })
        }
    </script>
    @stack('scripts')
</body>

</html>
