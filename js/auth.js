$(document).ready(function() {

    $('#submit-signup').click(function(event) {

        console.log("button submit signup")
      // Get the form data
      var nom = $('#nom').val();
      var email = $('#email').val();
      var password = $('#password').val();
      var confirmPassword = $('#confirmPassword').val();

      if(password!==confirmPassword)
      {
        event.preventDefault();
       // alert('Password and Confirm Password must match!');
        //alert("Mot de passe non confirmé!")
        $('#alert-confirm-password').text('Mot de passe non conforme!');
        $('#alert-confirm-password').removeClass( "d-none" );
        
      }else{
                        
            // Send the form data to the PHP script
      $.ajax({
        url: 'pages/auth/signup.php',
        type: 'POST',
        data: { nom: nom, email: email,password:password },
        success: function(response) {
          // Show a success message or do something else with the response
          console.log("responses:",response)
       alert(response);
         // $("#createModal").hide();
        }
      });
    }
  });




  });
  