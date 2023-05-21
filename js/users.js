$(document).ready(function () {


    //update user
    $("#usersTable").on("click", ".editBtn", function () {
        console.log("btn clicked!")
        var id = $(this).data("id");
        var nom = $(this).closest("tr").find("td:eq(1)").text();
        var email = $(this).closest("tr").find("td:eq(2)").text();
        console.log("nom:", nom)
        console.log("userId:", id)

        $("#user_id").val(id);
        $("#nom").val(nom);
        $("#email").val(email);
        $("#updateUserModal").modal('show');
    });

    $('#submit-updateUser').click(function (event) {


        // Get the form data
        var nom = $('#nom').val();
        var email = $('#email').val();
        var id = $('#user_id').val();


        // Send the form data to the PHP script
        $.ajax({
            url: 'updateUser.php',
            type: 'POST',
            data: { user_id: id, nom: nom, email: email },
            success: function (response) {
                // Show a success message or do something else with the response

                alert(response);
                // $("#createModal").hide();
            }
        });

    });


    // supprimer un utilisateur
    //update user
    $("#usersTable").on("click", ".deleteBtn", function () {
        console.log("deleteBtn clicked!")
        var id = $(this).data("id");
        var nom = $(this).closest("tr").find("td:eq(1)").text();


        $("#user_id").text(id);
        $("#spanUserName").text(nom);
        $("#deleteUserModal").modal('show');
    });

    $('#submit-deleteUser').click(function (event) {

        // Get the form data


        var id = $('#user_id').text();

        console.log("idSup:", id)



        // Send the form data to the PHP script
        $.ajax({
            url: 'deleteUser.php',
            type: 'POST',
            data: { user_id: id },
            success: function (response) {
                // Show a success message or do something else with the response
                $("#deleteUserModal").modal('hide');
                // location.reload();

                $.toast({
                    text: "Utilisateur supprimé avec succée!", // Text that is to be shown in the toast
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
