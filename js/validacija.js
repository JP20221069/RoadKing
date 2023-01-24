function isNullOrEmpty(str)
{
	return (!str || /^\s*$/.test(str));
}

function isValidMail(str)
{
	return str.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
}
function frm_logon_Validate()
{

    var bFormValid=true;
    var sUsername=document.getElementById("FIELD_USERNAME").value;
    var sPassword=document.getElementById("FIELD_PASSWORD").value;
    if(isNullOrEmpty(sUsername))
    {
        document.getElementById("LABEL_USERNAME_ERROR").setAttribute("style","");
        bFormValid=false;
    }
    if(isNullOrEmpty(sPassword))
    {
        document.getElementById("LABEL_PASSWORD_ERROR").setAttribute("style","");
        bFormValid=false;
    }

    if(bFormValid==false)
    {
        return;
    }
    else
    {
        document.getElementById("FORM_LOGON").submit();

    }
}