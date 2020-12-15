<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('js/scripts.js')}}"></script>
<script>
    $('.dropdown-toggle').click(e => {
        var target = $(e.target);
        target.parent().parent().find('.dropdown-menu.show').not(target.next()).removeClass('show')
        target.next().toggleClass('show')
        console.log('toggling')
    });
    $('body').not('.dropdown .dropdown-menu .dropdown-toggle').click(e => {
        $('.dropdown-menu.show').removeClass('show')
        console.log('collapsing')
    })
</script>
