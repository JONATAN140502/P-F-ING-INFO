/* global bootbox */

$("#frmAcceso").on('submit', function(e)
{
	e.preventDefault();
	logina=$("#logina").val();
	clavea=$("#clavea").val();

	$.post("../ajax/usuario.php?op=verificar",
        {"logina":logina, "clavea":clavea},
        function(data)
        {
           if (data==="null")
            {
            	bootbox.confirm("Usuario y/o Password incorrectos");
            }else{
                $(location).attr("href","escritorio.php");
            	
            }
        });
})

$("#frmAcceso1").on('submit', function(e)
{
	e.preventDefault();
	logina=$("#logina").val();
	clavea=$("#clavea").val();

	$.post("../ajax/tutor.php?op=verificar",
        {"logina":logina, "clavea":clavea},
        function(data)
        {
           if (data==="null")
            {
            	bootbox.confirm("Usuario y/o Password incorrectos");
            }else{
                $(location).attr("href","escritorio1.php");
            	
            }
        });
})