var browserSuported = false;;
var userBrowser;
var curSelWndInfo = null;	
var szInfo = "Загрузить и установить плагин. Закройте браузер при установке плагина.";
	
	function ClearChild(divResult)
	{
		while (divResult.hasChildNodes()) divResult.removeChild(divResult.lastChild);	
	}
    function GetSelectWndInfo(SelectWndInfo) { 
	//<?xml version="1.0"?><RealPlayInfo><SelectWnd>0</SelectWnd><ChannelNumber>-1</ChannelNumber><RealPlaying>0</RealPlaying><Recording>0</Recording></RealPlayInfo>
		//alert(SelectWndInfo);   
		var xmlDoc = parseXmlFromStr(SelectWndInfo); 
		//alert(xmlDoc);
		//var xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		//xmlDoc.async="false"
		//xmlDoc.loadXML(SelectWndInfo)	
		curSelWndInfo = {};		
		curSelWndInfo.CurSelWnd = xmlDoc.documentElement.childNodes[0].childNodes[0].nodeValue;  
		curSelWndInfo.CurWndChannel = parseInt(xmlDoc.documentElement.childNodes[1].childNodes[0].nodeValue);  
  		curSelWndInfo.RealPlaying = xmlDoc.documentElement.childNodes[2].childNodes[0].nodeValue;
		curSelWndInfo.bRecord = parseInt(xmlDoc.documentElement.childNodes[3].childNodes[0].nodeValue);
		//curSelWndInfo.RealplayHandle = xmlDoc.documentElement.childNodes[4].childNodes[0].nodeValue;
		//curSelWndInfo.Bright = xmlDoc.documentElement.childNodes[5].childNodes[0].childNodes[0].nodeValue;
		//curSelWndInfo.Contrast = xmlDoc.documentElement.childNodes[5].childNodes[1].childNodes[0].nodeValue;
		//curSelWndInfo.Saturation = xmlDoc.documentElement.childNodes[5].childNodes[2].childNodes[0].nodeValue;
		//curSelWndInfo.Hue = xmlDoc.documentElement.childNodes[5].childNodes[3].childNodes[0].nodeValue;	
		var CurWndChannel;
	}
    function GetAllWndInfo(RealplayInfo) { 
		//alert(RealplayInfo);
		//var xmlDoc = parseXmlFromStr(RealplayInfo); 
		//alert(xmlDoc);		
	}
    function PluginEventHandler(iEventType, iParam1, iParam2) {  
	//alert(iEventType);
	/*	if(21 == iEventType) {
			if(m_bIsDiskFreeSpaceEnough) {
				m_bIsDiskFreeSpaceEnough = false;
				setTimeout(function() {alert(parent.translator.translateNode(g_lxdPreview, 'FreeSpaceTips'));}, 2000);
			}
			StopRecord();
		} else if(3 == iEventType) {
			m_PreviewOCX.HWP_StopVoiceTalk();
			m_bTalk = 0;
			$("#voiceTalk").removeClass().addClass("voiceoff").attr("title", parent.translator.translateNode(g_lxdPreview, 'voiceTalk'));
			setTimeout(function() {alert(parent.translator.translateNode(g_lxdPreview, 'VoiceTalkFailed'));}, 2000);
		} */
	}
    function SetZeroChanEnlarge(EnlargeInfo) { //alert(EnlargeInfo);    
	}
	function ZoomInfoCallback(szZoomInfo){	//alert(szZoomInfo);	
	}
	
	function CheckBrowserSuport()
	{
		userBrowser = get_browser_info();
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
			alert("Warning! Browser not suported."); browserSuported = false; return false;
		}
		return true;
	}
	function get_browser_info()
	{
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
		return Str1.toString().trim().toUpperCase()==Str2.toString().trim().toUpperCase(); //fUpperCase(Str1.toString())==fUpperCase(Str2.toString());
	}
	
	function InitPreviewX()
	{	
		if(!browserSuported ) return;		
		m_PreviewOCX=document.getElementById("PreviewActiveX");
		var szInfo = '<?xml version="1.0" encoding="utf-8"?><Information><WebVersion><Type>ipc</Type><Version>3.1.2.120416</Version><Build>20120416</Build></WebVersion><PluginVersion><Version>3.0.3.5</Version><Build>20120416</Build></PluginVersion><PlayWndType>0</PlayWndType></Information>';
		try {
			m_PreviewOCX.HWP_SetSpecialInfo(szInfo, 0);
		} catch(e) {	}
	}
	
	function parseXmlFromStr(szXml)
	{
		if(null == szXml || '' == szXml)
		{
			return null;
		}
		var xmlDoc=new createxmlDoc();
		if(!CompStr(userBrowser.name, "ie"))
		{
			var oParser = new DOMParser();
			xmlDoc = oParser.parseFromString(szXml,"text/xml");
		}
		else
		{
			xmlDoc.loadXML(szXml);
		}
		return xmlDoc;
	}

	function xmlToStr(Xml)
	{
		if(Xml == null)
		{
			return;	
		}
		var XmlDocInfo = '';
		try{
			var oSerializer = new XMLSerializer();
			XmlDocInfo = oSerializer.serializeToString(Xml);
		} catch(e) {
			try {
				XmlDocInfo = Xml.xml;
			} catch(e) {
				return "";
			}
		}
		if(XmlDocInfo.indexOf('<?xml') == -1)
		{
			XmlDocInfo = "<?xml version='1.0' encoding='utf-8'?>" + XmlDocInfo;
		}
		return XmlDocInfo;
	}
	
	function createxmlDoc()
	{
		var xmlDoc;
		var aVersions = [ "MSXML2.DOMDocument","MSXML2.DOMDocument.5.0",
		"MSXML2.DOMDocument.4.0","MSXML2.DOMDocument.3.0",
		"Microsoft.XmlDom"];
		
		for (var i = 0; i < aVersions.length; i++) 
		{
			try 
			{
				xmlDoc = new ActiveXObject(aVersions[i]);
				break;
			}
			catch (oError)
			{
				xmlDoc = document.implementation.createDocument("", "", null);
				break;
			}
		}
		xmlDoc.async="false";
		return xmlDoc;
	}

	function CheckPluginInstall() 
		{
			var bInstall = false;

			if (CompStr(userBrowser.name, "ie")) {
				try {
					var obj = new ActiveXObject("WebVideoActiveX.WebVideoActiveXCtrl.1");
					bInstall = true;
				} catch(e) {}
			} else {
				for (var i = 0, len = navigator.mimeTypes.length; i < len; i++) {
					if (navigator.mimeTypes[i].type.toLowerCase() == "application/hwp-webvideo-plugin") {
						bInstall = true;
						break;
					}
				}
			}
			//alert(bInstall);
			if (bInstall) {
				return 0; //already intalled
			} else {
				return -1;
			}
		}
		
	function PluginForInstall(elem)
		{				
			if (navigator.platform == "Win32")
			{				
				elem.innerHTML = "<label onclick='window.open(\"codebase/WebComponents.exe\",\"_self\")' class='pluginLink' >"+szInfo+"</label>";
			}			
			else
			{				
				elem.innerHTML = "<label onclick='' class='pluginLink' style='cursor:default; text-decoration:none;'>"+szInfo+"</label>";
			}
		  	return false;		
		}	

function getXmlHttpRequest()
{
	if (window.XMLHttpRequest) 
	{
		try 
		{
			return new XMLHttpRequest();
		} 
		catch (e){}
	} 
	else if (window.ActiveXObject) 
	{
		try 
		{
			return new ActiveXObject('Msxml2.XMLHTTP');
		} catch (e){}
		try 
		{
			return new ActiveXObject('Microsoft.XMLHTTP');
		} 
		catch (e){}
	}
	return null;
}		