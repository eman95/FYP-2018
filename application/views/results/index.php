<h2><?= $title ?></h2>
    <div class="col-md-12 pull-left" style="margin-bottom: 10" id="toggle">
        <button id="btnAll" class="btn btn-success col-md-1" style="margin-right: 10; outline:none;">Overall</button>      
        <button id="btnWater" class="btn btn-default col-md-1" style="margin-right: 10; outline:none;">Water</button>
        <button id="btnElect" class="btn btn-default col-md-1" style="margin-right: 10; outline:none;">Electricity</button>
        <button id="btnGas" class="btn btn-default col-md-1" style="outline: none;">Gas</button>
    </div>
    <div id="chart">
	    <div id="chartAll" class="col-md-10"></div>
	    <div id="chartWater" class="col-md-10" style="display: none;"></div>
	    <div id="chartElect" class="col-md-10" style="display: none;"></div>
	    <div id="chartGas" class="col-md-10" style="display: none;"></div>
    </div>
    <br></br>
    <div class="col-md-12" style="margin-top: 10" id="buttons">
        <button id="prev" class="btn btn-primary col-md-1 col-md-offset-1">Previous</button>      
        <button id="front" class="btn btn-primary col-md-1 col-md-offset-2">First</button>
        <button id="end" class="btn btn-primary col-md-1 col-md-offset-2">Last</button>
        <button id="next" class="btn btn-primary col-md-1 col-md-offset-2">Next</button>
    </div>
<div id = "demo"></div>