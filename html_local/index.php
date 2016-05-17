<?php include 'header.php'; ?> <!-- <div class="front_main"> --><script>var elementNum = "1";</script>
    <table width="1000" class="tbl_all_cam" >
        <tr><td width="500">Камеры </td><td width="500">Описание</td></tr>
        <tr>
            <td colspan="2">
                <?php include 'bigplayer.php'; ?>
            </td>            
        </tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr><td >Камера: <span id="desc_00"></span></td><td>Камера: <span id="desc_01"></td></tr>
        <tr>
            <td>
                <table class="tbl_small_cam">
                    <tr><th>Resolution</th><th>FPs</th><th>Megapixels</th></tr>
                    <tr><td>1280x720P</td><td>25</td><td>1.3</td></tr>
                </table>
            </td>
            <td>
                <table class="tbl_small_cam">
                    <tr><th>Resolution</th><th>FPs</th><th>Megapixels</th></tr>
                    <tr><td>704x576</td><td>25</td><td>D1</td></tr>
                </table>
            </td>          
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr><td >Камера: <span id="desc_02"></td><td>Камера: <span id="desc_03"></td></tr>

        <tr>
            <td> 
            </td>
        </tr>

        <tr>
            <td>
                <table class="tbl_small_cam">
                    <tr><th>Resolution</th><th>FPs</th><th>Megapixels</th></tr>
                    <tr><td>704x576</td><td>25</td><td>D1</td></tr>
                </table>
            </td>
            <td>
                <table class="tbl_small_cam">
                    <tr><th>Resolution</th><th>FPs</th><th>Megapixels</th></tr>
                    <tr><td>352x288</td><td>25</td><td>CIF</td></tr>
                </table>
            </td>
           
        </tr>
    </table>
</div><?php
include 'footer.php';