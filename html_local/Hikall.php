
<?php include 'header.php'; ?>
<!-- <div class="front_main"> -->
	<table width="1000" class="tbl_big_cam" >
	<tr><td width="50%">&nbsp;</td><td width="50%">&nbsp;</td></tr>
	<tr><th>Camera 3</th><th>705x578</th></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Web Cam</title>
  
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 
    <!--script src="jquery-1.7.1.min.js"></script -->
    <!-- script src="script/mjpegPlugin.js"></script>
 
  
    <script src="script/dvr.js"></script>-->
    <script src="script/camrip.js"></script> 
	<style>
	* {margin:0;padding:0;}	
	html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    overflow: hidden;
	}
	 .center {	
    width: 1050px; 
	height:950px;
    padding: 0px; 
    margin: 0 auto; 
    background: #fc0;
	overflow: hidden
   }
#Camera
{
	 width: 1024px; 
	height:768px;
	 background: #000;
	 margin:10px;	 
}

#Control
{
 width: 1024px; 
	height:150px;
	 background: #ccc;
	 margin:10px;	
}

	</style>
</head>
<body>
<!-- div style="width: 1050px; height:850px; margin: 0 auto; background-color:#ccc; padding:12px;" -->
<div class="center">
     <div id="Camera">11</div>
	 <div id="Control">
	 <table bolder>
	 <tr>
		 <td>Split screen
		 </td>
		 <td><select id="wintype" ><!--class="sel2" onchange="InitWindow(this.value);" -->
						<option value="1">1x1</option>
						<option value="2" selected="">2x2</option>
						<option value="3">3x3</option>
						<option value="4">4x4</option>						
					</select>
		 </td>
		 <td><input type="button" value="init windiw" onclick="InitWindow()" />
		 </td>
		 <td>
		 </td>
		 <td>
		 </td>
	 </tr>
	 <tr>
		 <td>Device list
		 </td>
		 <td>Channel list
		 </td>
		 <td>
		 </td>
		 <td>
		 </td>
	 </tr>
	 <tr>		 
		 <td><select id="CamNum">
					<option>0</option>		 
                    <option>1</option>
                    <option>2</option>
                </select>
		 </td>
		 <td><select id="winNum">
                    <option>0</option>
                    <option>1</option>
                    <option>2</option>
					<option>3</option>
                </select>
		 </td>
		 <td><input type="button" value="play" onclick="StartRealPlay();" /> 
		 </td>
		 <td><input type="button" value="stop" onclick="StopRealPlay();" />
		 </td>
	 </tr>
	 </div>
	 <tr>
		 <td>Stop all
		 </td>
		 <td><input type="button" value="Stop all" onclick="StopAllPlay();" />
		 </td>
		 <td>
		 </td>
		 <td>
		 </td>
	 </tr>
</div>
	
</body onunload="StopAllPlay()">	
</html>

<script for="PreviewActiveX" event="GetSelectWndInfo(SelectWndInfo)">
    GetSelectWndInfo(SelectWndInfo);
</script>
<script for="PreviewActiveX" event="GetAllWndInfo(RealplayInfo)">
    GetAllWndInfo(RealplayInfo);
</script>
<script for="PreviewActiveX" event="PluginEventHandler(iEventType, iParam1, iParam2)">
    PluginEventHandler(iEventType, iParam1, iParam2);
</script>
<script for="PreviewActiveX" event="SetZeroChanEnlarge(EnlargeInfo)">
    SetZeroChanEnlarge(EnlargeInfo);
</script>

</table>
</div>
</div><?php
include 'footer.php';