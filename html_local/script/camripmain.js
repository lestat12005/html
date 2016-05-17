var Camera;
var Control;
var CamList = null;
var windCnt = 4;
var iWinNun = 0;

window.onload = function()
{
	Camera = document.getElementById('Camera_one');
	Control = document.getElementById('Control_small');	
	
	if( CheckBrowserSuport() )
	{
		if(CheckPluginInstall() == -1) { PluginForInstall(Camera); }
		else
		{
			InitPreviewX();				
			InitWindow();
			GetInfoAjax();
			DrawCOntrol();	
			window.onunload = StopAll;
		}
	}	
}

var objElement = 
"<object classid='clsid:E7EF736D-B4E6-4A5A-BA94-732D71107808' codebase='' standby='Waiting...' id='PreviewActiveX' width='100%' height='100%' name='ocx' align='center' >"+
		"<param name='wndtype' value='1'>"+
		"<param name='playmode' value='0'>"+
		"</object>";
var EmbededElement = 
'<embed type="application/hwp-webvideo-plugin" id="PreviewActiveX" width="100%" height="100%" name="PreviewActiveX" align="center" wndtype="1" playmode="0" align="middle"></embed>';

	/// Split screen
	function InitWindow() 
	{      
		if(!m_PreviewOCX) return;
		iWindowType = 2;
		windCnt=iWindowType*iWindowType;		
		m_PreviewOCX.HWP_ArrangeWindow(iWindowType);	
    }
	
	function PlayAll() 
		{	
			if(!infoLoaded ){ return; };
			StopAll();
			
			for(var c = 0; c <=CamList.length; c++ )
			{ 	
				if(CamList[c] === undefined) { continue; } 
				else
				if(m_PreviewOCX.HWP_Play(CamList[c].url , CamList[c].uin, c, "", "") != 0) 
				{
					var iError = m_PreviewOCX.HWP_GetLastError();
					if(403 == iError) {
						alert('No Operation Right');
					} else {
						alert('Preview failed');
					}
					return ;
				}	
			}
		}	
		
	function StopAll() 
		{		
			for(var cn = 0; cn<windCnt; cn++)
			m_PreviewOCX.HWP_Stop(cn);						
		}
		
	function DrawCOntrol()
	{
		document.getElementById('play').onclick = PlayAll;
		document.getElementById('stop').onclick = StopAll;		
	}
	
