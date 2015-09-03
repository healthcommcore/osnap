<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title></title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <style type="text/css">
        #container, #container iframe {
            position: relative;
            width: 800px;
            height: 620px;
			border: 1px solid red;
			}
        #loading {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: none;
            background-color: white;
			}
		#loading-inner {
            width: 160px;
            height: 100px;
			margin: 250px auto;
            background-color: white;
            color: gray;
            font-weight: bold;
			}
    </style>

    <script type="text/javascript">
        $(function() {

            $("#loading").show();
			$("#frame1").load("/clients/osnap/survey/index.php?sid=36956&lang=en", function () {
				$("#loading").hide();
			});

        });
    </script>

</head>
<body>

    <div id="container">
        <div id="frame1"></div>
        <div id="loading">
			<div id="loading-inner">
				<img src="images/horizontal_loading.gif" /><br/>
				<h3>Loading Assessment Tool</h3>
			</div>
        </div>
    </div>

</body>
</html>