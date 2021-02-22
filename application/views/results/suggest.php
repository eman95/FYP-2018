<h2><?= $title ?></h2>
    <div class="col-md-12" style="margin-bottom: 20; padding-left: 0; margin-top: 10" id="toggleSuggest">
        <button id="btnSuggestAll" onclick="suggestWaysOverall(this.id)" class="btn btn-success col-md-1" style="margin-right: 10; outline:none;">Overall</button>      
        <button id="btnSuggestWater" onclick="suggestWaysWater(this.id)" class="btn btn-default col-md-1" style="margin-right: 10; outline:none;">Water</button>
        <button id="btnSuggestElect" onclick="suggestWaysElect(this.id)" class="btn btn-default col-md-1" style="margin-right: 10; outline:none;">Electricity</button>
        <button id="btnSuggestGas" onclick="suggestWaysGas(this.id)" class="btn btn-default col-md-1" style="outline:none;">Gas</button>
    </div>
    <div>
		<p id="suggest2"></p>
		<p id="suggest3"></p>
		<p id="suggest4"></p>
	</div>