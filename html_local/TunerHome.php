<?php include 'header.php'; ?>
<!-- <div class="front_main"> -->
	<table width="1000" class="tbl_big_cam" >
	<tr><td width="50%">&nbsp;</td><td width="50%">&nbsp;</td></tr>
	<tr><th>Camera 3</th><th>705x578</th></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr>
			<td colspan="2">
			<OBJECT classid="clsid:9BE31822-FDAD-461B-AD51-BE1D1C159921" codebase="http://downloads.videolan.org/pub/videolan/vlc/latest/win32/axvlc.cab" width="960" height="720" id="vlc" events="True">
				   <param name="Src" value="http://tuner.itfamaly.info:8080/web/stream.m3u?ref=1%3A0%3A1%3A1%3AD%3A1%3ADE82A07%3A0%3A0%3A0%3A&name=KIEV%20STB" />
				   <param name="ShowDisplay" value="True" />
				   <param name="AutoLoop" value="False" />
				   <param name="AutoPlay" value="True" />
				   <embed id="vlcEmb"  type="application/x-google-vlc-plugin" version="VideoLAN.VLCPlugin.2" autoplay="yes" loop="no" width="960" height="720" target="rtsp://cameraipaddress" ></embed>
					</OBJECT>
					</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table class="tbl_small_prop1">
				<tr>
					<th class="style_w">
						TIP</th>
					<th >
						Resolution</th>
					<th >
						FPS</th>
					<th >
						Camers</th>
				</tr>
				<tr>
					<td class="style_w" style="text-align: left;">
						Main stream live</td>
					<td>1600x1200
						</td>
					<td>25
						</td>
					<td>8
						</td>
				</tr>
				<tr>
					<td class="style_w" style="text-align: left;">
						Sub stream live</td>
					<td>
						705x578</td>
					<td>
						25</td>
					<td>
						8</td>
				</tr>
				<tr>
					<td class="style_w" style="text-align: left;">
						Main stream playback</td>
					<td>
						1600x1200</td>
					<td>
						25</td>
					<td>
						8</td>
				</tr>
				<tr>
					<td class="style_w" style="text-align: left;">
						Bandwhidth LAN</td>
					<td colspan="3">
						192 Mb.</td>

				</tr>
			</table>
			</td>
			<td>
			<table class="tbl_small_prop1">
        <tr>
            <th>
                Size</th>
            <th>
                Time</th>
            <th>
                Resolution</th>
            <th>
                FPS</th>
        </tr>
        <tr>
            <td>
                27462</td>
            <td>1 month
                </td>
            <td>
                1600x1200</td>
            <td>
                25</td>
        </tr>
        <tr>
            <td>
                22282</td>
            <td>
                1 month</td>
            <td>
                1600x1200</td>
            <td>
                25</td>
        </tr>
        <tr>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
        </tr>
        <tr>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
            <td>
                &nbsp;</td>
        </tr>


    </table>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			</td>
		</tr>
	</table>
</div>
</div><?php
include 'footer.php';
