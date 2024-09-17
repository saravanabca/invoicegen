<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
    integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- data-tables --}}
<script src="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<script>
    AOS.init();
</script>


<script>
    // // Define the page_loader function
    // // $('#pre-loader').addClass('is-active');
    // function page_loader() {
    //     $('#pre-loader').fadeOut();

    //     // $('#pre-loader').removeClass('is-active');
    //     // $('#pre-loader').addClass('active-is');
    // }

    // // Call the page_loader function with a delay after the window is fully loaded
    // $(window).on("load", function() {
    //     setTimeout(page_loader, 200); // Call page_loader after a delay of 2000 milliseconds (2 seconds)
    // });
</script>

<script>
    var baseUrl = "{{ config('app.url') }}";
</script>

<script>
    var btn = $('#back_to_top');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '200');
    });



    function showToast(message) {
        const $toast = $("#alert_toast");
        const $closeBtn = $("#close");
        $(".toast-text").html(message);

        $toast.removeClass('inactive').addClass("activee");
        setTimeout(function() {
            $toast.removeClass("activee").addClass('inactive');
        }, 3000);

        $closeBtn.on("click", function() {
            $toast.removeClass("activee").addClass('inactive');
        });
    }


    function showToastAndReload(message) {
        const $toast = $("#alert_toast");
        const $closeBtn = $("#close");
        $(".toast-text").html(message);

        $toast.removeClass('inactive').addClass("activee");
        setTimeout(function() {
            $toast.removeClass("activee").addClass('inactive');
            window.location.reload(); // Reload the page after the toast disappears
        }, 1500);

        $closeBtn.on("click", function() {
            $toast.removeClass("activee").addClass('inactive');
            window.location.reload(); // Reload the page immediately if close button is clicked
        });
    }
    

</script>
