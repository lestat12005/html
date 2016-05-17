<?php include 'header.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
     <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>hik ocx</title>
      <style type="text/css">
       body {
        background-color: gray;
       }
      </style>
      <script language="javascript" type="text/javascript">
       var Netocx;
       function Play() {
        var i;
        var szURL = "rtsp://192.168.88.7:554/mpeg4/ch01/main/av_stream";
        var UserID = Netocx.HWP_Play(szURL, "YWRtaW46cXdhc3BsMTk4Mg==", 0, "", "");
        //alert("UserID:"+UserID);
       }

       function Stop() {
        var Netocx = document.getElementById("PrevisewActiveX");
        Netocx.HWP_Stop(0);//0
       }

       function init() {
        Netocx = document.getElementById("PreviewActiveX");
        setTimeout(Play, 100);
        //Play();
       }

      </script>
	  
     </head>
     <body onload="init()" onunload="Stop()" >

      <div style="width:100;height:100;background-color:white;">
       <embed type='application/hwp-webvideo-plugin' id='PreviewActiveX' width='400px' height='300px' name='PreviewActiveX' align='center' wndtype='1' playmode='0'>
       </embed>
      </div>
     </body>
    </html>
</div><?php
include 'footer.php';
