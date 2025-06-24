/*************************************************************************************/
// -->Template Name: Bootstrap Press Admin
// -->Author: Themedesigner
// -->Email: niravjoshi87@gmail.com
// -->File: datatable_basic_init
/*************************************************************************************/

/****************************************
 *       Basic Table                   *
 ****************************************/
//$('#zero_config').DataTable();
let table = $('#zero_config').DataTable();

table.on('draw', function () {
    if (typeof feather !== 'undefined') {
        feather.replace(); // Render ulang ikon feather setelah redraw
    }
});


/****************************************
 *       Default Order Table           *
 ****************************************/
// $('#default_order').DataTable({
//     "order": [
//         [3, "desc"]
//     ]
// });

let table2 = $('#default_order').DataTable({
    "order": [[3, "desc"]]
});

table2.on('draw', function () {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});

/****************************************
 *       Multi-column Order Table      *
 ****************************************/
// $('#multi_col_order').DataTable({
//     columnDefs: [{
//         targets: [0],
//         orderData: [0, 1]
//     }, {
//         targets: [1],
//         orderData: [1, 0]
//     }, {
//         targets: [4],
//         orderData: [4, 0]
//     }]
// });

let table3 = $('#multi_col_order').DataTable({
    columnDefs: [
        { targets: [0], orderData: [0, 1] },
        { targets: [1], orderData: [1, 0] },
        { targets: [4], orderData: [4, 0] }
    ]
});

table3.on('draw', function () {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
