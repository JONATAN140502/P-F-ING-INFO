$("#frmAcceso").on('submit', function(e)
{
	e.preventDefault();
	logina=$("#logina").val();
	clavea=$("#clavea").val();

	$.post("../ajax/usuario_1.php?op=verificar",
        {"logina":logina, "clavea":clavea},
        function(data)
        {
           if (data!="null")
            {
            	$(location).attr("href","escritorio_1.php");
            }else{
            	bootbox.alert("Usuario y/o Password incorrectos");
            }
        });
})