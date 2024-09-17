<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('user/js/plugins/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('user/js/company.js') }}"></script>
<script src="{{ asset('user/js/custom.js') }}"></script>

{{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script> --}}

<script src="{{ asset('user/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('user/js/plugins/dataTables.bootstrap5.min.js') }}"></script>

{{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}

{{-- <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>


<script src="{{ asset('user/js/plugins/html2pdf.js') }}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

<script>
    var baseUrl = "{{ config('app.url') }}";
</script>


<script>
    $(window).on("load", function() {
        setTimeout(function() {
            document.getElementById('top_loader').style.display = 'none';
        }, 500);
    });

    // $('[data-bs-toggle="sidebar"]').click(function(event) {
    //         // alert();
    //         event.preventDefault();
    //         $('.app').toggleClass('sidenav-toggled');
    //     });


        document.getElementById('sidebarToggle').addEventListener('click', function() {
    const sidebar = document.getElementById('appSidebar');
    const header = document.querySelector('.app-header');
    sidebar.classList.toggle('collapsed');
    header.classList.toggle('expanded');
});

</script>
<script>
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
