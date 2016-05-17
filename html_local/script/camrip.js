window.onload = function()
{
	Camera = document.getElementById('Camera');
	Control = document.getElementById('Control');
	userBrowser = get_browser_info();
	//alert(userBrowser.name);
	console.log(userBrowser.name);
	console.log(userBrowser.version);
	InitPrviewX();
	
	var cam1 = 
	{
		name : "Street ch1",
		//ip : "37.57.197.233",
		uin : "YWRtaW46cXdhc3BsMTk4Mg==",
		//port : "554"
		szURL : "rtsp://37.57.197.233:554/PSIA/streaming/channels/102"		
	};
	var cam2 = 
	{
		name : "Street ch0",
		//ip : "37.57.197.233",
		uin : "YWRtaW46cXdhc3BsMTk4Mg==",
		//port : "554"	
		szURL : "rtsp://37.57.197.233:554/mpeg4/ch01/main/av_stream"
	};	
	CamList = new Array();
	CamList[0] = cam1;
	CamList[1] = cam2;
	InitWindow();
	FillCamList();
}

var browserSuported = false;;
var userBrowser;
var Camera;
var Control;
var m_szUserPwdValue = "YWRtaW46cXdhc3BsMTk4Mg==";
var m_PreviewOCX = null;
var ipAddress = "37.57.197.233";
var rstpPort = "554";
var CamList = null;
var windCnt = 4;

var objElement = 
"<object classid='clsid:E7EF736D-B4E6-4A5A-BA94-732D71107808' codebase='' standby='Waiting...' id='PreviewActiveX' width='1024px' height='768px' name='ocx' align='center' >"+
		"<param name='wndtype' value='1'>"+
		"<param name='playmode' value='0'>"+
		"</object>";
var EmbededElement = 
'<embed type="application/hwp-webvideo-plugin" id="PreviewActiveX" width="1024px" height="768px" name="PreviewActiveX" align="center" wndtype="1" playmode="0" align="middle"></embed>';
			 
		

function InitPrviewX()
{
	//alert(userBrowser.name);
	if(CompStr(userBrowser.name, "Firefox") )
	{
		Camera.innerHTML = EmbededElement;	
		browserSuported = true;		
	} 	else	
	if(CompStr(userBrowser.name, "ie") )
	{
		Camera.innerHTML = objElement;	
		browserSuported = true;
	}
	else
	{
		alert("Warning! Browser not suported.");
	}
	
	m_PreviewOCX=document.getElementById("PreviewActiveX");
	var szInfo = '<?xml version="1.0" encoding="utf-8"?><Information><WebVersion><Type>ipc</Type><Version>3.1.2.120416</Version><Build>20120416</Build></WebVersion><PluginVersion><Version>3.0.3.5</Version><Build>20120416</Build></PluginVersion><PlayWndType>0</PlayWndType></Information>';
	try {
		m_PreviewOCX.HWP_SetSpecialInfo(szInfo, 0);
	} catch(e) {	}
}


	function InitWindow() {
        //iWindowType   1 - 1， 2 - 4，3 - 9
		
		var iWindowType = document.getElementById('wintype').value;	
		if(!m_PreviewOCX) return; 
		iWindowType = parseInt(iWindowType);
		if(iWindowType > 0 && iWindowType <= 4)
		{	
			windCnt=iWindowType*iWindowType;	
			m_PreviewOCX.HWP_ArrangeWindow(iWindowType);
			FillWindNum();
		}
    }

	function StartRealPlay() 
		{
			var iCamNum = document.getElementById("CamNum").value;	
			iCamNum = parseInt(iCamNum);
			var iWinNun = document.getElementById("winNum").value;	
			iWinNun = parseInt(iWinNun);
			
			//var szURL = "rtsp://" + ipAddress + ":" + rstpPort + "/PSIA/streaming/channels/"+iChannelNum;
			//var szURL = "rtsp://37.57.197.233:554/mpeg4/ch01/main/av_stream"
			if( CamList[iCamNum] === undefined ) { return; }
			  
			szURL = CamList[iCamNum].szURL;
			m_szUserPwdValue = CamList[iCamNum].uin;
			
			if(m_PreviewOCX.HWP_Play(szURL, m_szUserPwdValue, iWinNun, "", "") != 0) 
			{
				var iError = m_PreviewOCX.HWP_GetLastError();
				if(403 == iError) {
					alert('NoOperationRight');
				} else {
					alert('previewfailed');
				}
				return ;
			}		
		}	
		
	function StopRealPlay() 
		{				
				var iWinNun = document.getElementById("winNum").value;	
				iWinNun = parseInt(iWinNun);
				m_PreviewOCX.HWP_Stop(iWinNun);
				//HWP.Stop(0);
		}
	function StopAllPlay() 
		{				
				var iWinNun = document.getElementById("winNum").value;	
				for(var cn = 0; cn<windCnt; cn++)
				m_PreviewOCX.HWP_Stop(cn);
				//HWP.Stop(0);
		}

	function FillCamList()
	{
		if(!CamList) return;
		if(CamList.length > 0)
		{
			var CamNum = document.getElementById("CamNum");
			ClearChild(CamNum);
		for (var i = 0; i < CamList.length; i++) showCamera(CamList[i], i);	
		}		
	}

	function showCamera(indexCam, ind)
	{
		var CamNum = document.getElementById("CamNum");
		var optCam = document.createElement("option");
		optCam.value = ind;
		optCam.innerHTML = indexCam.name;
		CamNum.appendChild(optCam);		
	}

	function FillWindNum()
	{
		var WinNum = document.getElementById("winNum");
		ClearChild(WinNum);
		for (var i = 0; i < windCnt; i++)
		{
			var optWind = document.createElement("option");
			optWind.value = i;
			optWind.innerHTML = i+1;
			WinNum.appendChild(optWind);	
		}		
	}


	function ClearChild(divResult)
	{
		while (divResult.hasChildNodes()) divResult.removeChild(divResult.lastChild);	
	}



    function GetSelectWndInfo(SelectWndInfo) {    }
    function GetAllWndInfo(RealplayInfo) {     }
    function PluginEventHandler(iEventType, iParam1, iParam2) {     }
    function SetZeroChanEnlarge(EnlargeInfo) {     }
	
	function get_browser_info(){
    var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
    if(/trident/i.test(M[1])){
        tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
        return {name:'IE ',version:(tem[1]||'')};
        }   
    if(M[1]==='Chrome'){
        tem=ua.match(/\bOPR\/(\d+)/)
        if(tem!=null)   {return {name:'Opera', version:tem[1]};}
        }   
    M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
    return {
      name: M[0],
      version: M[1]
    };
 }
 
 function CompStr(Str1, Str2)
{
//alert(Str1.toString().toUpperCase());
//alert(Str2.toString().toUpperCase());		
	return Str1.toString().trim().toUpperCase()==Str2.toString().trim().toUpperCase(); //fUpperCase(Str1.toString())==fUpperCase(Str2.toString());
}