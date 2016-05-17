<?php
if( !isset($_COOKIE['User'])   ||  !isset($_COOKIE['Dtlogin']) || !isset($_COOKIE['Ui']) ){ echo '[]'; }
if( !($_COOKIE['User']=='Login') || !($_COOKIE['Dtlogin'] == sha1(MD5(base64_decode($_COOKIE['Ui'])).SHA1("rfh34itiufhiu45jgfi54jngi"))) ) 	{ echo '[]'; }

header('Content-type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));

$c1 = new CurCam( 0, 'Street 1', "YWRtaW46cXdhc3BsMTk4Mg==", "rtsp://37.57.197.233:554/mpeg4/ch01/main/av_stream" ); 
$c2 = new CurCam( 1, 'Door 2', "YWRtaW46cXdhc3BsMTk4Mg==", "rtsp://37.57.197.233:17554/mpeg4/ch02/main/av_stream" ); 
$c3 = new CurCam( 2, 'Street 1', "YWRtaW46cXdhc3BsMTk4Mg==", "rtsp://37.57.197.233:554/mpeg4/ch01/sub/av_stream"  ); 
$c4 = new CurCam( 3, 'Door 2', "YWRtaW46cXdhc3BsMTk4Mg==", "rtsp://37.57.197.233:17554/mpeg4/ch02/sub/av_stream"  ); 

$outs = array($c1, $c2, $c3, $c4);

class CurCam
{
	public $id;
    public $name;
    public $uin;
    public $url;
    public function __construct($id = "", $n="", $uin="", $url="")
    {
		$this->id = $id;
        $this->name = $n;
        $this->uin = $uin;
        $this->url = $url;
    }
}
echo json_encode($outs);
?>