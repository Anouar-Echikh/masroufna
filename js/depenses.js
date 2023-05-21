$(document).ready(function () {

    //-------------
    //add category
    //--------------

    $('#submit-addExpense').click(function (event) {


        // Get the form data
        var dateValue = $('#dateExp').val();
        var description = $('#description').val();
        var montant = $('#montant').val();
        var category_id = $('#category_idExp').val();
        var user_id = $('#user_idExp').val();

        console.log("date:", date)
        var date = new Date(dateValue);

        // Format the date in dd/mm/yyyy format
        var formattedDate = ("0" + date.getDate()).slice(-2) + "/"
            + ("0" + (date.getMonth() + 1)).slice(-2) + "/"
            + date.getFullYear();

        // Send the form data to the PHP script
        $.ajax({
            url: 'addDepense.php',
            type: 'POST',
            data: { user_id: user_id, category_id: category_id, date: formattedDate, description: description, montant: montant },
            success: function (response) {
                // Show a success message or do something else with the response
                alert(response);
                // $("#createModal").hide();
            }
        });

    });

    //-------------------
    // update depense
    //---------------------

    $("#depensesTable").on("click", ".editBtn-exp", function () {
        console.log("btn clicked!")
        var id = $(this).data("id");

        var dateValue = $(this).closest("tr").find("td:eq(2)").text();
        var description = $(this).closest("tr").find("td:eq(3)").text();
        var montant = $(this).closest("tr").find("td:eq(4)").text();
        var user_id = $(this).closest("tr").find("td:eq(5)").text();
        var category_id = $(this).closest("tr").find("td:eq(6)").text();
        console.log("date:", dateValue.trim())
        console.log("user_id:", user_id)
        console.log("category_id:", category_id)
        console.log("expense-id:", id)



        //$('#update-dateExp').attr('value', dateValue);
        $('#update-dateExp').val(dateValue.trim());
        $('#update-description').val(description);
        $('#update-montant').val(montant);

        $('#update-category_idExp').val(Number(category_id.trim()));
        $('#update-expense_idExp').val(id);
        $('#update-user_idExp').val(user_id);

        $("#updateExpenseModal").modal('show');
    });

    $('#submit-updateExpense').click(function (event) {


        // Get the form data
        var dateValue = $('#update-dateExp').val();
        var description = $('#update-description').val();
        var montant = $('#update-montant').val();
        var category_id = $('#update-category_idExp').val();
        var user_id = $('#update-user_idExp').val();
        var expense_id = $('#update-expense_idExp').val();

        console.log("date:", dateValue)
        var date = new Date(dateValue);
        console.log("expense-id-2:", expense_id)
        // Format the date in dd/mm/yyyy format
        var formattedDate = ("0" + date.getDate()).slice(-2) + "/"
            + ("0" + (date.getMonth() + 1)).slice(-2) + "/"
            + date.getFullYear();


        console.log("date2:", formattedDate)
        // Send the form data to the PHP script
        $.ajax({
            url: 'updateDepense.php',
            type: 'POST',
            data: { expense_id: expense_id, user_id: user_id, category_id: category_id, date: dateValue, description: description, montant: montant },
            success: function (response) {
                // Show a success message or do something else with the response

                alert(response);
                // $("#createModal").hide();
            }
        });

    });

    //-------------------
    // delete depense
    //---------------------

    $("#depensesTable").on("click", ".deleteBtn-exp", function () {
        console.log("deleteBtn clicked!")
        var id = $(this).data("id");
        var description = $(this).closest("tr").find("td:eq(3)").text();


        $("#spanDepense_id").text(id);
        $("#spanDepenseDescription").text(description);
        $("#deleteDepenseModal").modal('show');
    });

    $('#submit-deleteExpense').click(function (event) {



        var id = $('#spanDepense_id').text();

        console.log("idExp:", id)



        // Send the form data to the PHP script
        $.ajax({
            url: 'deleteDepense.php',
            type: 'POST',
            data: { expense_id: id },
            success: function (response) {
                // Show a success message or do something else with the response
                $("#deleteDepenseModal").modal('hide');
                // location.reload();

                $.toast({
                    text: "Catégorie supprimé avec succée!", // Text that is to be shown in the toast
                    heading: 'Note', // Optional heading to be shown on the toast
                    icon: 'success', // Type of toast icon
                    showHideTransition: 'fade', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    textAlign: 'left',  // Text alignment i.e. left, right or center
                    loader: true,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                    afterHidden: function () {
                        location.reload();
                    }
                });


            }
        });

    });



});