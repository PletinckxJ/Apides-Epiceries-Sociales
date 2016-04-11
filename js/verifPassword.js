/**
 * Created by Julien on 08-04-16.
 */


function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();
    if (password != confirmPassword) {
        document.getElementById("txtNewPassword").style.borderColor = "#E34234";
        document.getElementById("txtConfirmPassword").style.borderColor = "#E34234";
        $("#btnCompte").prop("disabled", true);
        $('label[for="error"]').show();
    } else if (password == confirmPassword && password != "") {
        document.getElementById("txtNewPassword").style.borderColor = "#00FF00";
        document.getElementById("txtConfirmPassword").style.borderColor = "#00FF00";
        $("#btnCompte").prop("disabled",false);
        $('label[for="error"]').hide();
    }  else {
        document.getElementById("txtNewPassword").style.borderColor = "#DFDFDF";
        document.getElementById("txtConfirmPassword").style.borderColor = "#DFDFDF";
        $("#btnCompte").prop("disabled",false);
        $('label[for="error"]').hide();
    }
}

