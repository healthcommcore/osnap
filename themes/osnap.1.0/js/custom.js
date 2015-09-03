
;(function printContent(divId) {
	var DocumentContainer = document.getElementById(div_id);
	var html = '<html><head>'+
			   '<link rel="stylesheet" href="'.get_template_directory_uri().'/style.css">'+
               '</head><body style="background:#ffffff;">'+
               DocumentContainer.innerHTML+
               '</body></html>';
 
    var WindowObject = window.open("", "PrintWindow", "width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
    WindowObject.document.writeln(html);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
    document.getElementById('print_link').style.display='block';
});