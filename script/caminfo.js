var infoLoaded = false;

function GetInfo()
	{
		var xhttp = new XMLHttpRequest();
		infoLoaded = false;
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			myFunction(xhttp);
			}
		};
		xhttp.open("GET", "xml/list.xml", true);
		xhttp.send();
	}
	
function myFunction(xml) 
	{
		var curCam = {};
		var xmlDoc = xml.responseXML;		
		var ename = xmlDoc.getElementsByTagName("camera");		
		for(var i =0; i <ename.length; i++ )			
			{
				x = xmlDoc.getElementsByTagName("camera")[i].attributes;				 
				if(x.getNamedItem("id").nodeValue == elementNum)
				{
					curCam.name = xmlDoc.getElementsByTagName("name")[i].childNodes[0].nodeValue;
					curCam.uin = xmlDoc.getElementsByTagName("uin")[i].childNodes[0].nodeValue;
					curCam.url = xmlDoc.getElementsByTagName("url")[i].childNodes[0].nodeValue;
					Name = curCam.name;
					szURL = curCam.url;
					m_szUserPwdValue =  curCam.uin;	
					document.getElementById('camdesc').innerHTML = Name;
					infoLoaded = true;
				}
			}				
	}	

function GetInfoAjax()
	{
		var req = getXmlHttpRequest();
		req.onreadystatechange = function()
		{
			if (req.readyState != 4) return; if(req.status != 200) return; 
			if(req.responseText == "[]") { alert('Config error!'); return; }        
			CamList = JSON.parse(req.responseText);		
				for(var l=0; l<CamList.length; l++)
			document.getElementById('desc_0'+l).innerHTML = CamList[l].name;				
			infoLoaded = true;
		};  
		req.open("GET", "ajax/caminfo.php", true); 
		req.send(null);
	}
	
	
	function GetCurInfoAjax()
	{
		var req = getXmlHttpRequest();
		req.onreadystatechange = function()
		{
			if (req.readyState != 4) return; if(req.status != 200) return; 
			if(req.responseText == "[]") { alert('Config error!'); return; }        
			var CurList = JSON.parse(req.responseText);		
			for(var l=0; l<CurList.length; l++)
			{
				if(CurList[l].id == elementNum)
				{
					Name = CurList[l].name;
					szURL = CurList[l].url;
					m_szUserPwdValue =  CurList[l].uin;	
					document.getElementById('camdesc').innerHTML = CurList[l].name;				
					infoLoaded = true;
				}
			}
		};  
		req.open("GET", "ajax/camlist.php", true); 
		req.send(null);
	}