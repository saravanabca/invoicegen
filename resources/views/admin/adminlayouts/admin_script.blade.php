<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
{{-- <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script> --}}
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.min.js')}}"></script>
{{-- <script src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script> --}}
<script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
{{-- <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script> --}}
<script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous"
referrerpolicy="no-referrer"></script>

<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>

<script>
$('#pre-loader').addClass('is-active');
var preloader = document.getElementById('pre-loader');
const fadeOutEffect = setTimeout(() => {
if (!preloader.style.opacity) {
    preloader.style.opacity = 0.7;
}
if (preloader.style.opacity > 0.7) {
    preloader.style.opacity -= 0.5;
} else {
    $('#pre-loader').removeClass('is-active');
    $('#pre-loader').addClass('active-is');
}
}, 300);

$(document).ready(function() {
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

});
</script>
<script>
        var base_Url = "{{ config('app.url') }}";
</script>
