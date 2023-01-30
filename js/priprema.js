function frm_confirm_Setup()
{
    d1=new Date();
    sD1=d1.toJSON().split('T')[0];
    document.getElementById("FIELD_FROM").setAttribute("min",sD1);
    document.getElementById("FIELD_TO").setAttribute("min",sD1);
}