@php
    $filename = request()->segments();
    $file = request()->segment(count(request()->segments()));
@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .form-control {
        height: 44px;
    }

    .alert {
        border: 0;
        position: relative;
        padding: 0.95rem 1.25rem;
        border-radius: 1px;
        color: inherit;
        background-color: #fff;
        border-left: 5px solid red !important;
        -webkit-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        -moz-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        font-size: 18px;
        text-decoration: underline white;
        color: red;
    }

    .alert-success {
        border: 0;
        position: relative;
        padding: 0.95rem 1.25rem;
        border-radius: 1px;
        color: inherit;
        font-size: 16px;
        background-color: #fff;
        border-left: 5px solid green !important;
        color: green;
        -webkit-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        -moz-box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
        box-shadow: 1px 1px 14px 0 rgba(18, 38, 63, .26);
    }

    .btn-add {
        background: #012970 !important;
        border-color: #012970 !important;
    }
</style>
<style>
    .sidebar-nav .nav-link.collapse {
        background: #B72828 !important;
        color: #ffffff !important;
        text-transform: uppercase !important;
    }

    .sidebar-nav .nav-link.collapse i {
        color: #ffffff !important;
        text-transform: uppercase !important;
    }

    .sidebar-nav .nav-content a {
        color: #7e87a2 !important;
    }

    .sidebar-nav .nav-content a:hover {
        background: rgba(199, 199, 199, .2);
        color: #0f47aa !important;
        border-radius: 5px;
    }

    .sidebar-nav .nav-link.collapse {
        /* background: #012970 !important; */
        background: #605e5ec4 !important;
        color: #ffffff !important;
        text-transform: uppercase !important;
        box-shadow: 4px 4px 10px 0 rgba(0, 0, 0, .1), 4px 4px 15px -5px rgba(21, 114, 232, .4) !important;
        padding: 8px 10px !important;
        /* margin-left: 10px; */
    }

    .sidebar-nav .nav-link.collapsed {
        padding: 8px 10px !important;
        border-radius: 5px !important;
        /* margin-left: 10px; */
    }

    .sidebar-nav .nav-link.collapse span {
        margin-top: 5px !important;
        mari
    }

    .sidebar-nav .nav-link.collapse i {
        color: #ffffff !important;
        text-transform: uppercase !important;
    }

    .sidebar-nav .nav-link {
        height: 51px;
        padding: 0 15px !important;
    }

    .sidebar-nav .nav-link span {
        margin-top: 5px !important;
    }

    .sidebar-nav .nav-content a.active {
        background: rgba(199, 199, 199, .2);
        color: #B72828 !important;
        border-radius: 5px;
    }

    .sidebar-nav .nav-content a.active i {
        background-color: #B72828 !important;
    }


    .sidebar-nav .nav-link.collapse {
        text-transform: none !important;
    }
</style>

<aside id="sidebar" class="sidebar">


    <ul class="sidebar-nav" id="sidebar-nav">
      


        <li class="nav-heading">Home</li>

        <li class="nav-item">
            <a class="nav-link @php echo ($file == 'adminlogin') ? 'collapse':'collapsed' @endphp"
                href="{{ url('adminlogin') }}" class="">
                <i class="fa-solid fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>


        <li class="nav-item ">
            <a class="nav-link @php echo ($file == 'user_list') ? 'collapse':'collapsed' @endphp"
                href="{{ url('user_list') }}" class="@php echo ($file == 'user_list') ? 'active':'' @endphp">
                <i class="fa-solid fa-user"></i>
                <span>Users</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link @php echo ($file == 'admin_invoice_list') ? 'collapse':'collapsed' @endphp"
                href="{{ url('admin_invoice_list') }}" class="">
                <i class="fa-solid fa-list"></i>
                <span>Invoice List</span>
            </a>
        </li>

        
        <li class="nav-item">
            <a class="nav-link @php echo ($file == 'admin_invoiceDrafts_list') ? 'collapse':'collapsed' @endphp"
                href="{{ url('admin_invoiceDrafts_list') }}" class="">
                <i class="fa-solid fa-chart-simple"></i>
                <span>Drafts Invoice List</span>
            </a>
        </li>

        

        <li class="nav-item">
            <a class="nav-link @php echo ($file == 'admin_clients_list') ? 'collapse':'collapsed' @endphp"
                href="{{ url('admin_clients_list') }}" class="">
                <i class="fa-solid fa-file"></i>
                <span>Client List</span>
            </a>
        </li>


        @php
        $templateActive = in_array($file, ['admin_template', 'admin_temp_addpage']);
    @endphp

        <li class="nav-item">
            <a class="nav-link {{ !$templateActive ? 'collapsed' : 'collapse' }}"
                href="{{ url('admin_template') }}" class="">
                <i class="fa-solid fa-layer-group"></i>
                <span>Templates</span>
            </a>
        </li>
       
    </ul>

</aside><!-- End Sidebar-->

<div id="pre-loader" class="pre-loader">
        <div class="loader">
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chatBox = document.querySelector(".sidebar-nav");

        if (chatBox.classList.contains("active")) {
            scrollToBottom();
        } else {
            scrollToActiveLi();
        }

        function scrollToBottom() {
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function scrollToActiveLi() {
            const activeLi = document.querySelector(".nav-content.show li a.active");
            if (activeLi) {
                const parentContainer = activeLi.closest(".nav-item");
                parentContainer.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                    inline: "center"
                });
            }
        }

        function filterList() {
            const input = document.getElementById("mySearch");
            const filter = input.value.toUpperCase();
            const ul = document.getElementById("sidebar-nav");
            const li = ul.getElementsByTagName("li");

            for (let i = 0; i < li.length; i++) {
                const a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }

        // Assuming there is an input element with the ID "mySearch"
        const searchInput = document.getElementById("mySearch");
        if (searchInput) {
            searchInput.addEventListener("input", filterList);
        }
    });
</script>

