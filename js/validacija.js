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

function frm_rc_Validate()
{
    var bFormValid=true;
    var sDtFrom=document.getElementById("FIELD_FROM").value;
    var sDtTo=document.getElementById("FIELD_TO").value;
    var sf = Date(Date.parse(sDtFrom.replace(/-/g, " ")))
    var st = Date(Date.parse(sDtTo.replace(/-/g, " ")))
        
    if(isNullOrEmpty(sDtFrom))
    {
        document.getElementById("LABEL_FROM_ERROR").setAttribute("style","");
        bFormValid=false;
    }
    if(isNullOrEmpty(sDtTo))
    {
        document.getElementById("LABEL_TO_ERROR").setAttribute("style","");
        bFormValid=false;
    }
    if(sDtTo<=sDtFrom && bFormValid==true)
    {
        bFormValid=false;
        document.getElementById("LABEL_ERROR").innerText="Error: FROM date must be before TO date."
    }
    
    if(bFormValid==false)
    {
        return;
    }
    else
    {
        document.getElementById("FORM_RENTCONFIRM").submit();
    }
}

function frm_signup_Validate()
{
    var bFormValid=true;
    var sUsername=document.getElementById("FIELD_USERNAME").value;
    var sPassword=document.getElementById("FIELD_PASSWORD").value;
    var sRPassword=document.getElementById("FIELD_RPASSWORD").value;
    var sEmail=document.getElementById("FIELD_EMAIL").value;
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
    if(isNullOrEmpty(sRPassword))
    {
        document.getElementById("LABEL_RPASSWORD_ERROR").setAttribute("style","");
        bFormValid=false;
    }
    if(isNullOrEmpty(sEmail))
    {
        document.getElementById("LABEL_EMAIL_ERROR").setAttribute("style","");
        bFormValid=false;
    }
    if(sPassword!=sRPassword)
    {
        document.getElementById("LABEL_ERROR").innerText="Passwords must match!";
        bFormValid=false;
    }
    if(!isValidMail(sEmail))
    {
        document.getElementById("LABEL_ERROR").innerText="Invalid email format!";
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