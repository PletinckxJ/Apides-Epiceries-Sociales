/**
 * Created by Julien on 08-04-16.
 */


function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();
    if (password != confirmPassword) {
        document.getElementById("txtNewPassword").style.borderColor = "#E34234";
        document.getElementById("txtConfirmPassword").style.borderColor = "#E34234";
        $("#btnCompte").prop("disabled",true);
    } else {
        document.getElementById("txtNewPassword").style.borderColor = "#DFDFDF";
        document.getElementById("txtConfirmPassword").style.borderColor = "#DFDFDF";
        $("#btnCompte").prop("disabled",false);
    }
}

