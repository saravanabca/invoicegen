
function validateform(val) {
    alert(val);
    Swal.fire({
        title: 'Confirmation',
        text: 'Are you sure you want to delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#form_submit_' + val).submit();
        }
    });
}



$(function() {
    var dataTable = $('.user-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [
            [0, 'desc']
        ],
        ajax: '{{ url("get_report") }}',
        columns: [{
                data: 'user_id',
                name: 'user_id',
                searchable: true
            },
            {
                data: 'order_method',
                name: 'order_method',
                searchable: true
            },
            {
                data: 'payement_method',
                name: 'payement_method',
                searchable: true
            },
            {
                data: 'productname',
                name: 'productname',
                searchable: true
            },
            {
                data: 'quantity',
                name: 'quantity',
                searchable: true
            },
            {
                data: 'grand_total',
                name: 'grand_total',
                searchable: true
            },
            {
                data: 'created_at_formatted',
                name: 'created_at'
            },
        ],
        language: {
            'paginate': {
                'previous': '<<',
                'next': '>>'
            }
        },
    });

});


// $('#pre-loader').addClass('is-active');
// var preloader = document.getElementById('pre-loader');
// const fadeOutEffect = setInterval(() => {
//     if (!preloader.style.opacity) {
//         preloader.style.opacity = 0.7;
//     }
//     if (preloader.style.opacity > 0.7) {
//         preloader.style.opacity -= 0.5;
//     } else {
//         $('#pre-loader').removeClass('is-active');
//         $('#pre-loader').addClass('active-is');
//     }
// }, 400);






// {{-- User filter --}}

$(document).ready(function() {
    // Initialize DataTable
    var table = $('#dataTable').DataTable();

    $('#userIdFilter').change(function() {
        var userId = $(this).val(); // Get the selected user ID
        if (userId === '') {
            // If no user ID selected, clear the table filter
            table.column(0).search('').draw();
        } else {
            // Filter the table by the selected user ID
            table.column(0).search(userId).draw();
        }
    });
});


// {{-- date picker --}}

$(document).ready(function() {
    // Initialize DataTable
    var table = $('#dataTable').DataTable();

    // Event listener for date input change
    $('#dateFilter').on('change', function() {
        var selectedDate = $(this).val(); // Get selected date
        table.columns(6).search(selectedDate).draw(); // Search by column index (Created At column)
    });
});


// {{-- Total Sales Amount --}}

$(document).ready(function() {
    var table = $('#dataTable').DataTable();
    var totalGrandTotalInput = $('#totalGrandTotal');

    // Calculate and update total grand total when the DataTable is redrawn
    table.on('draw', function() {
        var totalGrandTotal = 0;
        table.column(5, {
            search: 'applied'
        }).data().each(function(value) {
            // Parse numeric value and add to total
            var numericValue = parseFloat(value);
            if (!isNaN(numericValue)) {
                totalGrandTotal += numericValue;
            }
        });
        totalGrandTotalInput.html(totalGrandTotal); // Display total grand total
    });

    // Initial calculation and display of total grand total
    table.draw();
});


// {{-- multiple date range filter filter --}}
//
//     $(document).ready(function() {
//         // Initialize DataTable
//         var table = $('#dataTable').DataTable();

//         // Initialize Datepicker
//         $('#datepicker').datepicker({
//             dateFormat: 'yy-mm-dd',
//             onSelect: function(dateText) {
//                 var selectedDates = $(this).val().split(','); // Split multiple dates by comma
//                 var searchString = selectedDates.join('|'); // Join dates with OR operator
//                 table.columns(6).search(searchString, true, false)
//             .draw(); // Search by column index (Created At column)
//             }
//         });
//     });
// 


// {{-- combine filter  --}}


// $(document).ready(function() {
//     // Initialize DataTable
//     var table = $('#dataTable').DataTable();

//     // Event listener for user ID filter dropdown change and date input change
//     $('#userIdFilter, #dateFilter').on('change', function() {
//         var userId = $('#userIdFilter').val(); // Get selected user ID
//         var selectedDate = $('#dateFilter').val(); // Get selected date

//         try {
//             // Filter by user ID
//             table.column(0).search(userId);

//             // Filter by date (assuming it's the 7th column, adjust index if needed)
//             table.column(6).search(selectedDate);

//             // Redraw the table
//             table.draw();
//         } catch (error) {
//             console.error('Error occurred while filtering table:', error);
//         }
//     });
// });




// {{-- lastmonth filter --}}

// $(document).ready(function() {
//     var table = $('#dataTable').DataTable();

//     // Filter dropdown change event
//     $('#filterDropdown').on('change', function() {
//         var filterValue = $(this).val();
//         if (filterValue === '') {
//             table.column(6).search('').draw(); // Clear existing search
//         } else {
//             var currentDate = getCurrentDate(filterValue);
//             table.column(6).search(currentDate).draw(); // Filter by selected option
//         }
//     });

//     // Function to get the date based on selected filter
//     function getCurrentDate(filter) {
//         var today = new Date();
//         var formattedDate;

//         if (filter === 'today') {
//             formattedDate = today.toISOString().split('T')[0]; // Today's date
//         } else if (filter === 'lastWeek') {
//             var today = new Date();
//             var lastWeekStart = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
//             var formattedDate = lastWeekStart.toISOString().split('T')[0];
//         } else if (filter === 'lastMonth') {
//             var lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
//             formattedDate = lastMonth.toISOString().split('T')[0]; // Last month's date
//         }
//         console.log(formattedDate);

//         return formattedDate;
//     }

// });





// {{-- chart --}}

// Sample data for demonstration
const data = [{
        grand_total: 100,
        created_at: '2024-02-01'
    },
    {
        grand_total: 150,
        created_at: '2024-02-02'
    },
    {
        grand_total: 200,
        created_at: '2024-02-03'
    },
    {
        grand_total: 180,
        created_at: '2024-02-04'
    },
    {
        grand_total: 250,
        created_at: '2024-02-05'
    }
    // Add more data as needed
];

// Extract grand total values and dates
const grandTotalValues = data.map(item => item.grand_total);
const dates = data.map(item => item.created_at);

// Create spline chart
const ctx = document.getElementById('splineChart').getContext('2d');
const splineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: dates,
        datasets: [{
            label: 'Grand Total',
            data: grandTotalValues,
            borderColor: 'blue',
            backgroundColor: 'transparent',
            tension: 0.4
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
