$(function () {
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});

var $el = $("body");
(function($) {
    $(document).ready(function(){
        $("#sale-category").on("change",function(e){
            e.preventDefault();
            var url =  $("base").attr("url") + 'admin/transactions/checkcategory/' + this.value;
            $.get(url, function(data, status){
                if(status == 'success'){
                    var arr = $.parseJSON(data);
                    $("#sale-product").text("");
                    $("#sale-price").text("");
                    $.each(arr, function(key,value){
                        var default_value = '';
                        if(key == 0){
                            var default_value = '<option value="0">Please select a product</option>';
                        }
                        var opt_value = '<option value="'+value.id+'">'+value.product_name+'</option>';
                        $('#sale-product').append(default_value+opt_value);
                    });
                }
            });
        });
        $("#sale-product").on("change",function(e){
            e.preventDefault();
            var url =  $("base").attr("url") + 'admin/transactions/checkproduct/' + this.value;
            $.get(url, function(data, status) {
                if(status == 'success' && data != 'false') {
                    var value = $.parseJSON(data);
                    var val = value[0];
                    var sale_value = parseInt(val.price);
                    var discount = parseInt(val.current_discount);
                    var bursttime = parseInt(val.bursttime);
                    var final_price = count_discount(sale_value,discount);
                    $('#sale-price').val("Rp "+price(sale_value));
                    $('#discount').val(discount);
                    $("#total-price").val("Rp "+price(final_price));
                    $('#bursttime').val(bursttime);
                }
            });
        });
    });

    $(document).on('click','.add-menu',function(e){
        e.preventDefault();

        var product_id = $("#sale-product").val();
        var quantity = $("#quantity").val();
        var sale_price = $("#sale-price").val();
        var transaction_code = $("#transaction_code").val();
        var transaction_date = $("#transaction_date").val();
        var bursttime = $("#bursttime").val();
        if($('#total-price').length){
            sale_price = $('#total-price').unmask();
        }

        if(product_id !== null && sale_price !== null){
            $.ajax({
                url: $("base").attr("url") + 'admin/transactions/add_menu',
                method: "POST",
                data: {
                    'product_id' : product_id,
                    'quantity' : quantity,
                    'sale_price' : sale_price,
                    'transaction_code' : transaction_code,
                    'transaction_date' : transaction_date,
                    'bursttime' : bursttime,
                },
                success: function(){
                    RefreshPageTransaction();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",                               
                        "hideDuration": "300",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success("Added to cart !");
                },
                error: function(){
                    alert('Something Error');
                }
            });
        }else{
            alert("Please fill in all the boxes");
        }
    });
    $(document).on("click",".transaction-delete-item",function(){
        var id = $(this).data("id");
        var name = $(this).data("name");

        Swal.fire({
            title: 'Are you sure?',
            text: "You will remove " + name + " from the transaction cart!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, process!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $("base").attr("url") + 'admin/transactions/deletemenu',
                    method: "POST",
                    data: {
                    id: id,
                },
                success: function(data) {
                    var response = $.parseJSON(data);
                    if(response.status == "success"){
                        RefreshPageTransaction();
                    }
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success(name + " has been removed from Cart!");
                    }
                });
                } else if (
                result.dismiss === Swal.DismissReason.cancel
                ) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "100",
                    "hideDuration": "100",
                    "timeOut": "1500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeToggle",
                    "hideMethod": "slideUp"
                }
                toastr.success(name + " cancel deleted");
            }
        })
    });
    $(document).on('click','.add-cart',function(e){
        e.preventDefault();

        var product_id = $("#sale-product").val();
        var quantity = $("#quantity").val();
        var sale_price = $("#sale-price").val();
        var bursttime = $("#bursttime").val();
        if($('#total-price').length){
            sale_price = $('#total-price').unmask();
        }
        if(product_id !== null && sale_price !== null){
            $.ajax({
                url: $("base").attr("url") + 'admin/transactions/addtocart',
                method: "POST",
                data: {
                    'id' : product_id,
                    'qty' : quantity,
                    'price' : sale_price,
                    'bursttime' : bursttime,
                },
                success: function(data){
                    JSON.parse(data);
                    RefreshPageTransaction();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",                               
                        "hideDuration": "300",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success("Added to cart !");
                },
                error: function(){
                    alert('Something Error');
                }
            });
        }else{
            alert("Please fill in all the boxes");
        }
    });
    $(document).on("click",".delete-cart-item",function(e){
        var rowid = $(this).data("id");
        var name = $(this).data("name");

        $.get($("base").attr("url") + 'admin/transactions/deleteitem/'+rowid,
            function(data,status){
                if(status == 'success'  && data != 'false'){
                    $("#"+rowid).remove();
                    RefreshPageTransaction();
                }
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "100",
                    "hideDuration": "100",
                    "timeOut": "1500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeToggle",
                    "hideMethod": "slideUp"
                }
                toastr.success(name + " has been removed from Cart!");
            }
        );
    });
    $(document).on("click",".update-cart-item",function(e){
        var rowid = $(this).data("id");
        var name = $(this).data("name");
        var qty = $("#qty-cart" + rowid).val();

        $.ajax({
            url: $("base").attr("url") + 'admin/transactions/updateitem/'+rowid,
            method: "POST",
            data: {
                'rowid' : rowid,
                'qty' : qty,
            },
            success: function(data){
                var response = $.parseJSON(data);
                    if(response.status == "success"){
                        RefreshPageTransaction();
                    }
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "100",
                    "hideDuration": "100",
                    "timeOut": "1500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeToggle",
                    "hideMethod": "slideUp"
                }
                toastr.success(name + " has been updated!");
            },
            error: function(){
                alert('Something Error');
            }
        });
    });
    $("#submit-transaction").on('click',function(e){
        e.preventDefault();
        var status = false;
        var method = null;
        var arr = null;
        var cust = $("#customer-name").val();
        var table = $("#table-number").val();

        var transaction = sales_status();
        if(transaction[0] == true){
            status = transaction[0];
            method = transaction[1];
            arr = transaction[2];
        }

        if(status == true && cust != "" && table != "0") {
            $.ajax({
                url: $("#transaction-form").attr("action"),
                data: arr,
                type: 'POST',
                success: function (data) {
                    $("#struck-transaction").html(data);
                    $("#struckModal").modal("show");
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success("Transaction is successful!");
                }
            });
        }else{
            if (table  == "0") {
                Swal.fire(
                    'Table Number',
                    'Please choose a table number!',
                    'warning'
                )
            }else{
                Swal.fire(
                    'Customer Name',
                    'Please enter customer name!',
                    'warning'
                )
            }
        }
    });
    $('.datepicker-transaksi').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
    function sales_status(){
        var data = false;
        var transaction_code = $("#transaction-code").val();
        var grand_total = $("#grand-total").val();
        var cash = $("#cash-struck").val();
        var change = $("#change").val();
        var cashier = $("#cashier").val();
        var order_type = $("#order-type").val();
        var table_number = $("#table-number").val();
        var customer_name = $("#customer-name").val();
        var total_bursttime = $("#total-bursttime").val();
        if(typeof transaction_code !== "undefined" && transaction_code != ""){
            var status = true;
            var method = "transaction";
            var arr = {
                'transaction_code': transaction_code,
                'grand_total': grand_total,
                'cash' : cash,
                'change' : change,
                'cashier' : cashier,
                'order_type' : order_type,
                'table_number' : table_number,
                'customer_name' : customer_name,
                'total_bursttime' : total_bursttime,
            };
            data = [status,method,arr];
        }
        return data;
    }
    $(document).ready(function() {
        $('#struck-transaction').load($("base").attr("url") + 'admin/transactions/strucktransaction');
        $('.form-price-format').priceFormat({
            prefix: 'Rp ',
            centsSeparator: ',',
            thousandsSeparator: '.',
            centsLimit: 0
        });
        $('.discount-trx').bind("keyup change", function(){
            var sale_price = $("#sale-price").unmask();
            var discount = $("#discount").val();
            var final_price = count_discount(sale_price,discount);
            $("#total-price").val("Rp "+price(final_price));
        });
        $('.cash-transaction').bind("keyup change", function(){
            var grand_total = $("#grand-total").unmask();
            var cash = $("#cash").val();
            var cashstruck = parseInt(cash);
            var final_cash = count_cash(cash,grand_total);
            $("#change").val("Rp "+price(final_cash));
            $("#cash-struck").val("Rp "+price(cashstruck));
            if (final_cash >= 0) {
                $("#submit-transaction").removeAttr("disabled");
            } else {
                $("#submit-transaction").attr("disabled", "disabled");
            }
        });
    });
})(this.jQuery);

function count_discount(val,discount){
    var count_disc = val * (discount / 100);
    count_disc = val - count_disc;

    return count_disc;
}
function count_cash(cash,grand_total){
    count_cas = cash - grand_total;

    return count_cas;
}
function price(input){
    return (input).formatMoney(0, ',', '.');
}

Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
$(document).on('click','#btnPrintStruck',function(){
    printStruck(document.getElementById("struck-transaction"));
});
function printStruck() {    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    window.print();
    window.onafterprint = function(e){
        closePrintView();
    };
}

function closePrintView() {
    window.location.href = $("base").attr("url") + 'admin/transactions/sales';   
}
function RefreshPageTransaction() {
    var transaction_code = $("#transaction_code").val();
    $("#cart-transactions").load($("base").attr("url") + 'admin/transactions/salestransactions/'+transaction_code+' #cart-transactions-content');
    $("#code-paid").load($("base").attr("url") + 'admin/transactions/salestransactions/'+transaction_code+' #code-paid-content');
    $("#total-transactions").load($("base").attr("url") + 'admin/transactions/salestransactions/'+transaction_code+' #total-transactions-content');
}

function RefreshPageOrderlist() {
    $("#order-list").load($("base").attr("url") + 'barista/orderlist #order-list-content');
}
function RefreshPageOrderqueue() {
    $("#order-list").load($("base").attr("url") + 'barista/orderqueues #order-queue-content');
}
function RefreshPageTablelist() {
    $("#customer-table").load($("base").attr("url") + 'admin/monitoring #customer-table-list');
}
$(document).on('click','.order_process',function(){
    var hour = $(this).data("hour");
    var minute = $(this).data("minute");
    var product = $(this).data("product");
    $.ajax({
        url: $("base").attr("url") + 'barista/orderqueues/setprocess',
        method: "POST",
        data: {
            hour: hour,
            minute: minute,
            product: product,
        },
        success: function(data) {
            JSON.parse(data);
            RefreshPageOrderqueue();
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "100",
                "hideDuration": "100",
                "timeOut": "1500",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeToggle",
                "hideMethod": "slideUp"
            }
            toastr.success("Order Processed!");
        }
    });
});
$(document).on('click','.order_complete',function(){
    var code = $(this).data("code");
    var hour = $(this).data("hour");
    var minute = $(this).data("minute");
    var product = $(this).data("product");
    if (code == null) {
        $.ajax({
            url: $("base").attr("url") + 'barista/orderqueues/setcomplete',
            method: "POST",
            data: {
                hour: hour,
                minute: minute,
                product: product,
            },
            success: function(data) {
                JSON.parse(data);
                RefreshPageOrderqueue();
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "100",
                    "hideDuration": "100",
                    "timeOut": "1500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeToggle",
                    "hideMethod": "slideUp"
                }
                toastr.success("Order is finished processing!");
            }
        });
    }else{
        Swal.fire({
            title: 'Are you sure?',
            text: "Orders with code " + code + " have been processed!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, complete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $("base").attr("url") + 'barista/orderlist/setcomplete',
                    method: "POST",
                    data: {
                        code: code,
                    },
                    success: function(data) {
                        JSON.parse(data);
                        RefreshPageOrderlist();
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "100",
                            "hideDuration": "100",
                            "timeOut": "1500",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeToggle",
                            "hideMethod": "slideUp"
                        }
                        toastr.success("orders with code " + code + " have been processed!");
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "100",
                    "hideDuration": "100",
                    "timeOut": "1500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeToggle",
                    "hideMethod": "slideUp"
                }
                toastr.success("Canceled");
            }
        })
    }
});

$(document).on('click','.change_leave',function(){
    var id = $(this).data("id");
    var name = $(this).data("name");

    Swal.fire({
        title: 'Are you sure?',
        text: "You will vacate " + name + "!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes, cleared!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: $("base").attr("url") + 'admin/monitoring/setleave',
                method: "POST",
                data: {
                    id: id,
                    name: name,
                },
                success: function(data) {
                    JSON.parse(data);
                    RefreshPageTablelist();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success(name + " has been cleared successfully!");
                }
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "100",
                "hideDuration": "100",
                "timeOut": "1500",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeToggle",
                "hideMethod": "slideUp"
            }
            toastr.success(name + " canceled to be cleared");
        }
    })
});
$(document).on('click','.change_active',function(){
    var id = $(this).data("id");
    var name = $(this).data("name");

    Swal.fire({
        title: 'Are you sure?',
        text: "you will activate " + name + "!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes, activate!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: $("base").attr("url") + 'admin/monitoring/setactive',
                method: "POST",
                data: {
                    id: id,
                    name: name,
                },
                success: function(data) {
                    JSON.parse(data);
                    RefreshPageTablelist();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeToggle",
                        "hideMethod": "slideUp"
                    }
                    toastr.success(name + " activated successfully!");
                }
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "100",
                "hideDuration": "100",
                "timeOut": "1500",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeToggle",
                "hideMethod": "slideUp"
            }
            toastr.success(name + " canceled to be activated");
        }
    })
});