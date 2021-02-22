<h1 class="text-center"><?php echo $title = "Calculate Carbon Footprint"; ?></h1>

<?php echo form_open('calculates/calculate');?>
<?php echo validation_errors();?>

<div class="row">
	<div class="col-sm-4" id="water">
		<h2 class="text-center">Water</h2>
		<div class="form-group">
			<h4>Activity Data for Water:</h4>
			<label>Water usage (litres/Month)</label>
			<input type="text" class="form-control" name="water_use" placeholder="eg. 100, 200">
		</div>
	<input type="button" class="btn btn-primary btn-block" onclick="showElectricity()" value="Next" id="btn_water">
	</div>

	<div class="col-sm-4" id="elect" style="display: none;">
		<h2 class="text-center">Electricity</h2>
		<div class="form-group">
			<h4>Activity Data for Electricity:</h4>
			<label>Electricity usage (kWh/Month)</label>
			<input type="text" class="form-control" name="elect_use" placeholder="eg. 100, 200">
		</div>
	<input type="button" class="btn btn-primary btn-block" onclick="showGas()" value="Next" id="btn_elect">
	</div>

	<div class="col-sm-4" id="gas" style="display: none">
		<h2 class="text-center">Gas</h2>
		<div class="form-group">
			<h4>Activity Data for Gas:</h4>
			<label>Cylinder weight (kg)</label>
			<input type="text" class="form-control" name="gas_weight" placeholder="eg. 12, 14">
			<br>
			<label>How long does a gas cylinder last? (Months)</label>
			<input type="text" class="form-control" name="gas_use" placeholder="eg. 2, 3">
		</div>
	<button type="reset" class="btn btn-primary col-sm-5 pull-left" style="background-color: green; border-color: green;">Reset</button>
	<button type="submit" class="btn btn-primary col-sm-5 pull-right">Submit</button>
	</div>

<?php echo form_close();?>