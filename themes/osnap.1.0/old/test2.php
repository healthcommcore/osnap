<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title></title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <style type="text/css">
        #tool-container, #tool-container iframe {
            position: relative;
            width: 800px;
            height: 620px;
			}
        #tool-loading {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: none;
            background-color: white;
			}
		#tool-loading-inner {
            width: 160px;
            height: 100px;
			margin: 250px auto;
            background-color: white;
            color: gray;
            font-weight: bold;
			}
    </style>


</head>
<body>

    <div id="tool-container">

		<iframe id="ifr" src="/clients/osnap/survey/index.php?sid=36956&lang=en" scrolling="no" frameborder="0"></iframe>
		
        <div id="tool-loading">
			<div id="tool-loading-inner">
				<img src="images/horizontal_loading.gif" /><br/>
				<h3>Loading Assessment Tool</h3>
			</div>
        </div>
    </div>

	
	
    <script type="text/javascript">
        $(function() {
			showLoadingImage('ifr');
        });
		
		// function to show loading image for slow loading elements
		function showLoadingImage(imSlow){
			var slowElement = document.getElementById(imSlow);
			var loadingDisplay = document.getElementById('tool-loading').style;
			loadingDisplay.display = 'block';
			if (slowElement.onload == null) {
				slowElement.onload = function() {
					loadingDisplay.display = 'none';
					resizeIframeToFit();
				};
				if (window.attachEvent) {
					slowElement.attachEvent('onload', slowElement.onload);
				}
			}
			return true;
		}		
				
		// function to resize iframe
		function resizeIframeToFit(){
	
			var iframe = document.getElementById('ifr').contentWindow;
			var iHeight = $("#ifr").contents().find('.outerframe').height();
			var newHeight = parseInt(iHeight)+50;
			
			//**set height  $("#ifr").height($("#ifr").contents().find("html").height());
			document.getElementById('ifr').height = newHeight;
			
			// make clicking radio buttons trigger a resize
			$("#ifr").contents().find(".radio").click(function() {resizeIframeToFit();});		
		}	
    </script>
	
</body>
</html>