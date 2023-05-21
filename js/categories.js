$(document).ready(function () {


    //add category


    $('#submit-addCategory').click(function (event) {


        // Get the form data
        var category_name = $('#category_name').val();



        // Send the form data to the PHP script
        $.ajax({
            url: 'addCategory.php',
            type: 'POST',
            data: { category_name: category_name },
            success: function (response) {
                // Show a success message or do something else with the response

                alert(response);
                // $("#createModal").hide();
            }
        });

    });


    //update category
    $("#categoriesTable").on("click", ".editBtn-cat", function () {
        console.log("btn clicked!")
        var id = $(this).data("id");
        var category_name = $(this).closest("tr").find("td:eq(1)").text();

        console.log("cat:", category_name)
        console.log("catId:", id)

        $("#category_idInput").val(id);
        $("#category_nameInput").val(category_name);

        $("#updateCategoryModal").modal('show');
    });

    $('#submit-updateCategory').click(function (event) {


        // Get the form data
        var category_name = $('#category_nameInput').val();
        var id = $('#category_idInput').val();


        // Send the form data to the PHP script
        $.ajax({
            url: 'updateCategory.php',
            type: 'POST',
            data: { category_id: id, category_name: category_name },
            success: function (response) {
                // Show a success message or do something else with the response

                alert(response);
                // $("#createModal").hide();
            }
        });

    });


    // supprimer un utilisateur
    //update category
    $("#categoriesTable").on("click", ".deleteBtn-cat", function () {
        console.log("deleteBtn clicked!")
        var id = $(this).data("id");
        var category_name = $(this).closest("tr").find("td:eq(1)").text();


        $("#spanCategory_id").text(id);
        $("#spanCategoryName").text(category_name);
        $("#deleteCategoryModal").modal('show');
    });




    $('#submit-deleteCategory').click(function (event) {

       

        var id = $('#spanCategory_id').text();

        console.log("idcat:", id)



        // Send the form data to the PHP script
        $.ajax({
            url: 'deleteCategory.php',
            type: 'POST',
            data: { category_id: id },
            success: function (response) {
                // Show a success message or do something else with the response
                $("#deleteCategoryModal").modal('hide');
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
