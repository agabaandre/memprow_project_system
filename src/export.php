<script type="text/javascript" src="src/tableExport/tableExport.js"></script>
<script type="text/javascript" src="src/tableExport/jquery.base64.js"></script>
<script type="text/javascript" src="src/tableExport/html2canvas.js"></script>
<script type="text/javascript" src="src/tableExport/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="src/tableExport/jspdf/jspdf.js"></script>
<script type="text/javascript" src="src/tableExport/jspdf/libs/base64.js"></script>

<div class="btn-group">
							<button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
							<ul class="dropdown-menu " role="menu">
								<li class="divider"></li>
								<li><a href="#" onClick ="$('#mydata').tableExport({type:'excel',tableName:'Report_<?php $today_mysql?>',escape:'false'});"> <i></i> XLS</a></li>
								<li><a href="#" onClick ="$('#mydata').tableExport({type:'doc',tableName:'Report_<?php $today_mysql?>',escape:'false',pdfFontSize:'9',orientation: 'landscape'});"> <i></i>Word Document</a></li>
								
								
							</ul>
</div>	