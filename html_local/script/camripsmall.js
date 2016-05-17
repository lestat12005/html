var Camera;
var Control;
var CamList = null;
var windCnt = 1;
var iWinNun = 0;

var Name = "";
var szURL = "";
var m_szUserPwdValue =  "";

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
			GetCurInfoAjax();
			DrawCOntrol();				
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
		windCnt=1;	
		m_PreviewOCX.HWP_ArrangeWindow(windCnt);	
    }
	
	function Play() 
		{	Stop();
			if(!infoLoaded){ return; };
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
		
	function Stop() 
		{		
			m_PreviewOCX.HWP_Stop(iWinNun);				
		}
		
	function DrawCOntrol()
	{
		document.getElementById('play').onclick = Play;
		document.getElementById('stop').onclick = Stop;	
		document.getElementById('camdesc').innerHTML = Name;
	}