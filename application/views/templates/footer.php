	</div>

    <script src="<?php echo base_url('css/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('css/bootstrap.min.js');?>"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script>
        var compare = '';
        var water = 0;
        var gas = 0;
        var electricity = 0;
        var suggestWater = '<li>Take shorter showers (recommended 8 minutes or less)</li><li>Have plants that require less water</li><li>Use a shut-off nozzle on your hose</li><li>Use a low-flow shower head</li><li>Turn off the tap while brushing teeth, and soaping and scrubbing dishes</li><li>Use rainwater to water the plants and to wash your vehicles</li><li>Regularly check for any leaking in the toilet and faucets</li>';
        var suggestElect = '<li>Shutdown your computer</li><li>Use LED bulbs</li><li>Unplug idle electronics</li><li>Turn off the lights</li><li>Use solar panels to reduce electricity consumption in the long run</li><li>Reduce air conditioner usage</li><li>Use a power strip to reduce your plug load</li>';
        var suggestGas = '<li>Check for leakage regularly</li><li>Use the oven efficiently</li><li>Use electric stovetop</li><li>Keep the stovetop clean</li><li>Cook in large batches</li><li>Avoid open vessel cooking</li><li>Cook on small flame</li>';
        var waterAverage_high = 200;
        var electAverage_high = 150;
        var gasAverage_high = 15;
        var waterAverage_low = 100;
        var electAverage_low = 85;
        var gasAverage_low = 6;

        var a = document.getElementById('btnSuggestAll');
        var b = document.getElementById('btnSuggestWater');
        var c = document.getElementById('btnSuggestElect');
        var d = document.getElementById('btnSuggestGas');

        var allButton = document.getElementById('btnAll');
        var waterButton = document.getElementById('btnWater');
        var electButton = document.getElementById('btnElect');
        var gasButton = document.getElementById('btnGas');

        var suggestDiv2 = document.getElementById('suggest2');
        var suggestDiv3 = document.getElementById('suggest3');
        var suggestDiv4 = document.getElementById('suggest4');

        var home1 = document.getElementById('home1');
        var home2 = document.getElementById('home2');
        var home3 = document.getElementById('home3');

        var homeDiv1 = document.getElementById('homeDiv1');
        var homeDiv2 = document.getElementById('homeDiv2');
        var homeDiv3 = document.getElementById('homeDiv3');

        var vidhome1 = document.getElementById('vidhome1');
        var vidhome2 = document.getElementById('vidhome2');

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>results/get_data",
                success: function (data1) {
                    var chartAll = new google.visualization.ComboChart(document.getElementById('chartAll'));
                    var chartWater = new google.visualization.ComboChart(document.getElementById('chartWater'));
                    var chartElect = new google.visualization.ComboChart(document.getElementById('chartElect'));
                    var chartGas = new google.visualization.ComboChart(document.getElementById('chartGas'));

                    var dataTotal = new google.visualization.DataTable();
                    dataTotal.addColumn('string', 'Date');
                    dataTotal.addColumn('number', 'Water');
                    dataTotal.addColumn('number', 'Electricity');
                    dataTotal.addColumn('number', 'Gas');
                    dataTotal.addColumn('number', 'Monthly Total');

                    var dataWater = new google.visualization.DataTable();
                    dataWater.addColumn('string', 'Date');
                    dataWater.addColumn('number', 'Water');
                    dataWater.addColumn('number', 'Malaysia Monthly Average');

                    var dataElect = new google.visualization.DataTable();
                    dataElect.addColumn('string', 'Date');
                    dataElect.addColumn('number', 'Electricity');
                    dataElect.addColumn('number', 'Malaysia Monthly Average');

                    var dataGas = new google.visualization.DataTable();
                    dataGas.addColumn('string', 'Date');
                    dataGas.addColumn('number', 'Gas');
                    dataGas.addColumn('number', 'Malaysia Monthly Average');


                    //Parse data into Json
                    var jsonData = $.parseJSON(data1);
                    if (jsonData.length > 0) {
                        for (var i = 0; i < jsonData.length; i++) {
                            dataTotal.addRow([jsonData[i].date, parseFloat(jsonData[i].water), parseFloat(jsonData[i].electricity), parseFloat(jsonData[i].gas), (parseFloat(jsonData[i].water) + parseFloat(jsonData[i].electricity) + parseFloat(jsonData[i].gas))]);
                            dataWater.addRow([jsonData[i].date, parseFloat(jsonData[i].water), waterAverage_high]);
                            dataElect.addRow([jsonData[i].date, parseFloat(jsonData[i].electricity), electAverage_high]);
                            dataGas.addRow([jsonData[i].date, parseFloat(jsonData[i].gas), gasAverage_high]);
                        }

                        //chart options
                        var optionsTotal = {
                            title: 'Carbon Footprint Results',
                            width: 1150,
                            height: 500,
                            animation:{duration: 500, easing: 'out', startup: 'true'},
                            colors: ['#0000A0', '#FFA500', '#A52A2A', '#008000'],
                            explorer: {axis: 'horizontal', keepInBounds: true},                     
                            hAxis: {viewWindow: {min:0, max:6}, title: 'Month'},
                            vAxis: {format: '', title: 'CO2 Emission (kg)', viewWindow:{min:0, max:500}, gridlines: { count: 6 }},
                            seriesType: 'bars',
                            series: {3: {type: 'line'}},
                            chartArea: {left: 150}
                        };

                        var optionsWater = {
                            title: 'Water Carbon Footprint',
                            width: 1150,
                            height: 500,
                            animation:{duration: 500, easing: 'out'},
                            colors: ['#0000A0', '#008000'],
                            explorer: {axis: 'horizontal', keepInBounds: true},                     
                            hAxis: {viewWindow: {min:0, max:6}, title: 'Month'},
                            vAxis: {format: '', title: 'CO2 Emission (kg)', viewWindow:{min:0, max:300}, gridlines: { count: 4 }},
                            seriesType: 'bars',
                            series: {1: {type: 'line', enableInteractivity: false, lineWidth: 3, lineDashStyle: [12, 12]}},
                            chartArea: {left: 150, width: 750}
                        };

                        var optionsElect = {
                            title: 'Electricity Carbon Footprint',
                            width: 1150,
                            height: 500,
                            animation:{duration: 500, easing: 'out'},
                            colors: ['#FFA500', '#008000'],
                            explorer: {axis: 'horizontal', keepInBounds: true},                     
                            hAxis: {viewWindow: {min:0, max:6}, title: 'Month'},
                            vAxis: {format: '', title: 'CO2 Emission (kg)', viewWindow:{min:0, max:300}, gridlines: { count: 4 }},
                            seriesType: 'bars',
                            series: {1: {type: 'line', enableInteractivity: false, lineWidth: 3, lineDashStyle: [12, 12]}},
                            chartArea: {left: 150, width: 750}
                        };

                        var optionsGas = {
                            title: 'Gas Carbon Footprint',
                            width: 1150,
                            height: 500,
                            animation:{duration: 500, easing: 'out'},
                            colors: ['#A52A2A', '#008000'],
                            explorer: {axis: 'horizontal', keepInBounds: true},                     
                            hAxis: {viewWindow: {min:0, max:6}, title: 'Month'},
                            vAxis: {format: '', title: 'CO2 Emission (kg)', viewWindow:{min:0, max:150}, gridlines: { count: 4 }},
                            seriesType: 'bars',
                            series: {1: {type: 'line', enableInteractivity: false, lineWidth: 3, lineDashStyle: [12, 12]}},
                            chartArea: {left: 150, width: 750}
                        };

                        draw();

                        function draw(){
                            chartAll.draw(dataTotal, optionsTotal);
                            chartWater.draw(dataWater, optionsWater);
                            chartElect.draw(dataElect, optionsElect);
                            chartGas.draw(dataGas, optionsGas);
                        }

                        //button function
                        var prevButton = document.getElementById('prev');
                        var frontButton = document.getElementById('front');
                        var endButton = document.getElementById('end');
                        var nextButton = document.getElementById('next');

                        prevButton.onclick = function() {
                            optionsTotal.hAxis.viewWindow.min -= 1;
                            optionsTotal.hAxis.viewWindow.max -= 1;
                            prevButton.disabled = optionsTotal.hAxis.viewWindow.min < 0;

                            optionsWater.hAxis.viewWindow.min -= 1;
                            optionsWater.hAxis.viewWindow.max -= 1;
                            prevButton.disabled = optionsWater.hAxis.viewWindow.min < 0;

                            optionsElect.hAxis.viewWindow.min -= 1;
                            optionsElect.hAxis.viewWindow.max -= 1;
                            prevButton.disabled = optionsElect.hAxis.viewWindow.min < 0;

                            optionsGas.hAxis.viewWindow.min -= 1;
                            optionsGas.hAxis.viewWindow.max -= 1;
                            prevButton.disabled = optionsGas.hAxis.viewWindow.min < 0;

                            nextButton.disabled = false;
                            draw();
                        }

                        frontButton.onclick = function() {
                            optionsTotal.hAxis.viewWindow.min = 0;
                            optionsTotal.hAxis.viewWindow.max = 6;

                            optionsWater.hAxis.viewWindow.min = 0;
                            optionsWater.hAxis.viewWindow.max = 6;

                            optionsElect.hAxis.viewWindow.min = 0;
                            optionsElect.hAxis.viewWindow.max = 6;

                            optionsGas.hAxis.viewWindow.min = 0;
                            optionsGas.hAxis.viewWindow.max = 6;

                            prevButton.disabled = false;
                            nextButton.disabled = false;
                            draw();
                        }

                        endButton.onclick = function() {
                            optionsTotal.hAxis.viewWindow.min = (jsonData.length-6);
                            optionsTotal.hAxis.viewWindow.max = jsonData.length;

                            optionsWater.hAxis.viewWindow.min = (jsonData.length-6);
                            optionsWater.hAxis.viewWindow.max = jsonData.length;

                            optionsElect.hAxis.viewWindow.min = (jsonData.length-6);
                            optionsElect.hAxis.viewWindow.max = jsonData.length;

                            optionsGas.hAxis.viewWindow.min = (jsonData.length-6);
                            optionsGas.hAxis.viewWindow.max = jsonData.length;

                            prevButton.disabled = false;
                            nextButton.disabled = false;
                            draw();
                        }

                        nextButton.onclick = function() {
                            optionsTotal.hAxis.viewWindow.min += 1;
                            optionsTotal.hAxis.viewWindow.max += 1;
                            nextButton.disabled = optionsTotal.hAxis.viewWindow.max >= jsonData.length + 1;

                            optionsWater.hAxis.viewWindow.min += 1;
                            optionsWater.hAxis.viewWindow.max += 1;
                            nextButton.disabled = optionsWater.hAxis.viewWindow.max >= jsonData.length + 1;

                            optionsElect.hAxis.viewWindow.min += 1;
                            optionsElect.hAxis.viewWindow.max += 1;
                            nextButton.disabled = optionsElect.hAxis.viewWindow.max >= jsonData.length + 1;

                            optionsGas.hAxis.viewWindow.min += 1;
                            optionsGas.hAxis.viewWindow.max += 1;
                            nextButton.disabled = optionsGas.hAxis.viewWindow.max >= jsonData.length + 1;

                            prevButton.disabled = false;
                            draw();
                        }

                        allButton.onclick = function() {
                            var q = document.getElementById("chartAll");
                            var w = document.getElementById("chartWater");
                            var e = document.getElementById("chartElect");
                            var r = document.getElementById("chartGas");
                            
                            q.style.display = "block";
                            w.style.display = "none";
                            e.style.display = "none";
                            r.style.display = "none";

                            toggle('allButton');
                        }

                        waterButton.onclick = function() {
                            var q = document.getElementById("chartAll");
                            var w = document.getElementById("chartWater");
                            var e = document.getElementById("chartElect");
                            var r = document.getElementById("chartGas");
                            
                            q.style.display = "none";
                            w.style.display = "block";
                            e.style.display = "none";
                            r.style.display = "none";

                            toggle('waterButton');
                        }

                        electButton.onclick = function() {
                            var q = document.getElementById("chartAll");
                            var w = document.getElementById("chartWater");
                            var e = document.getElementById("chartElect");
                            var r = document.getElementById("chartGas");
                            
                            q.style.display = "none";
                            w.style.display = "none";
                            e.style.display = "block";
                            r.style.display = "none";

                            toggle('electButton');
                        }

                        gasButton.onclick = function() {
                            var q = document.getElementById("chartAll");
                            var w = document.getElementById("chartWater");
                            var e = document.getElementById("chartElect");
                            var r = document.getElementById("chartGas");
                            
                            q.style.display = "none";
                            w.style.display = "none";
                            e.style.display = "none";
                            r.style.display = "block";

                            toggle('gasButton');
                        }
                    } 
                    else {
                        document.getElementById('chart').innerHTML = 'There is no data in the database. You have not yet calculated your carbon footprint. Please <a href="<?php echo base_url(); ?>calculate">click here</a> to calculate your carbon footprint';
                        document.getElementById('buttons').style.display = 'none';
                        document.getElementById('toggle').style.display = 'none'; 
                    }
                }
            });
        }

        function showElectricity() {
            var x = document.getElementById("elect");
            var y = document.getElementById("btn_water")
            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
            }
        }

        function showGas() {
            var x = document.getElementById("gas");
            var y = document.getElementById("btn_elect")
            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
            }
        }

        window.onload = function compareValue() {
            var answer = '';
            var ajax = $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>results/get_data_normal",
                success: function (data1) {
                    var jsonData = $.parseJSON(data1);
                    var i = jsonData.length - 1;
                    if (i >= 0) {
                        water = parseFloat(jsonData[i].water);
                        gas = parseFloat(jsonData[i].gas);
                        electricity = parseFloat(jsonData[i].electricity);
                        if (water > gas && water > electricity) {
                            answer = 'water';
                        }
                        else if (gas > water && gas > electricity) {
                            answer = 'gas';
                        }
                        else if (electricity > gas && electricity > water) {
                            answer = 'electricity';
                        }
                        else if (water == gas && water > electricity) {
                            answer = 'water and gas';
                        }
                        else if (water == electricity && water > gas) {
                            answer = 'water and electricity';
                        }
                        else if (gas == electricity  && gas > water) {
                            answer = 'gas and electricity';
                        }
                        else if (water == gas && water == electricity) {
                            answer = 'water, gas and electricity';
                        }
                        else {
                            answer = 'null';
                        }
                    }
                    else {
                        answer = 'null';
                        compare = answer;
                        suggestWaysOverall();
                        ajax.abort();
                    }
                    compare = answer;
                    suggestWaysOverall();
                }
            });            
        }

        function suggestWaysOverall(btn_id) {
            if (compare == 'null'){
                document.getElementById('toggleSuggest').style.display = "none";
                suggestDiv2.innerHTML = 'There is no data in the database. You have not yet calculated your carbon footprint. Please <a href="<?php echo base_url(); ?>calculate">click here</a> to calculate your carbon footprint';
                suggestDiv3.innerHTML = '';
                suggestDiv4.innerHTML = '';
            }
            if (compare == 'water'){
                suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>WATER</b> carbon footprint has the highest value of CO<sub>2</sub> Emission which is '.concat(water).concat(' kg.');
                if (water > waterAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household water CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'Here are a list of ways to reduce your water carbon footprint:</br><ul>'.concat(suggestWater).concat('</ul>');
                }
                else if (water >= waterAverage_low && water <= waterAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household water CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'If you still want to reduce your water carbon footprint, here are a list of ways to reduce your water carbon footprint:</br><ul>'.concat(suggestWater).concat('</ul>');
                }
                else if (water < waterAverage_low){
                    suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household water CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'No ways needed to reduce your water carbon footprint';
                }
            }
            if (compare == 'gas'){
                suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>GAS</b> carbon footprint has the highest value of CO<sub>2</sub> Emission which is '.concat(gas).concat(' kg.');
                if (gas > gasAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household gas CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'Here are a list of ways for you to reduce your gas carbon footprint:</br><ul>'.concat(suggestGas).concat('</ul>');
                }
                else if (gas >= gasAverage_low && gas <= gasAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household gas CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'If you still want to reduce your gas carbon footprint, here are a list of ways to reduce it:</br><ul>'.concat(suggestGas).concat('</ul>');
                }
                else if (gas < gasAverage_low){
                    suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household gas CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'No ways needed to reduce your gas carbon footprint';
                }
            }
            if (compare == 'electricity'){
                suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>ELECTRICITY</b> carbon footprint has the highest value of CO<sub>2</sub> Emission which is '.concat(electricity).concat(' kg.');
                if (electricity > electAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'Here are a list of ways for you to reduce your electricity carbon footprint:</br><ul>'.concat(suggestElect).concat('</ul>');
                }
                else if (electricity >= electAverage_low && electricity <= electAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'If you still want to reduce your electricity carbon footprint, here are a list of ways to reduce it:</br><ul>'.concat(suggestElect).concat('</ul>');
                }
                else if (electricity < electAverage_low){
                    suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'No ways needed to reduce your electricity carbon footprint';
                }
                
            }
            if (compare == 'water and gas'){
                suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>WATER</b> and <b>GAS</b> carbon footprint has the highest value of CO<sub>2</sub> Emission which is '.concat(water).concat(' kg.');
                if (water > waterAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household water and gas CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'Here are a list of ways to reduce your water and gas carbon footprint:</br><ul>'.concat(suggestWater).concat(suggestGas).concat('</ul>');
                }
                else if (water >= waterAverage_low && water <= waterAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household water and gas CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'If you still want to reduce your water and gas carbon footprint, here are a list of ways for you to reduce it:</br><ul>'.concat(suggestWater).concat(suggestGas).concat('</ul>');
                }
                else if (water < waterAverage_low){
                    suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household water and gas CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'No ways needed to reduce your water and gas carbon footprint';
                }
            }
            if (compare == 'water and electricity'){
                suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>WATER</b> and <b>ELECTRICITY</b> carbon footprint has the highest value of CO<sub>2</sub> Emission which is '.concat(water).concat(' kg.');
                if (water > waterAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household water and electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'Here are a list of ways to reduce your water and electricity carbon footprint:</br><ul>'.concat(suggestWater).concat(suggestElect).concat('</ul>');
                }
                else if (water >= waterAverage_low && water <= waterAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household water and electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'If you still want to reduce your water and electricity carbon footprint, here are a list of ways for you to reduce it:</br><ul>'.concat(suggestWater).concat(suggestElect).concat('</ul>');
                }
                else if (water < waterAverage_low){
                    suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household water and electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'No ways needed to reduce your water and electricity carbon footprint';
                }
            }
            if (compare == 'gas and electricity'){
                suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>GAS</b> and <b>ELECTRICITY</b> carbon footprint has the highest value of CO<sub>2</sub> Emission which is '.concat(gas).concat(' kg.');
                if (gas > gasAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household gas and electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'Here are a list of ways for you to reduce your gas and electricity carbon footprint:</br><ul>'.concat(suggestGas).concat(suggestElect).concat('</ul>');
                }
                else if (gas >= gasAverage_low && gas <= gasAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household gas and electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'If you still want to reduce your gas and electricity carbon footprint, here are a list of ways to reduce it:</br><ul>'.concat(suggestGas).concat(suggestElect).concat('</ul>');
                }
                else if (gas < gasAverage_low){
                    suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household gas and electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'No ways needed to reduce your gas and electricity carbon footprint';
                }
            }
            if (compare == 'water, gas and electricity'){
                suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>WATER, GAS</b> and <b>ELECTRICITY</b> carbon footprint has the highest value of CO<sub>2</sub> Emission which is '.concat(water).concat(' kg.');
                if (water > waterAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household water, gas and electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'Here are a list of ways to reduce your water, gas and electricity carbon footprint:</br><ul>'.concat(suggestWater).concat(suggestGas).concat(suggestElect).concat('</ul>');
                }
                else if (water >= waterAverage_low && water <= waterAverage_high){
                    suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household water, gas and electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'If you still want to reduce your water, gas and electricity carbon footprint, here are a list of ways for you to reduce it:</br><ul>'.concat(suggestWater).concat(suggestGas).concat(suggestElect).concat('</ul>');
                }
                else if (water < waterAverage_low){
                    suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household water, gas and electricity CO<sub>2</sub> emission in Malaysia';
                    suggestDiv4.innerHTML = 'No ways needed to reduce your water, gas and electricity carbon footprint';
                }
            }

            toggle(btn_id);
        }

        function suggestWaysWater(btn_id) {
            suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>WATER</b> carbon footprint CO<sub>2</sub> Emission value is '.concat(water).concat(' kg.');
            if (water > waterAverage_high){
                suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household water CO<sub>2</sub> emission in Malaysia';
                suggestDiv4.innerHTML = 'Here are a list of ways to reduce your water carbon footprint:</br><ul>'.concat(suggestWater).concat('</ul>');
            }
            else if (water >= waterAverage_low && water <= waterAverage_high){
                suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household water CO<sub>2</sub> emission in Malaysia';
                suggestDiv4.innerHTML = 'If you still want to reduce your water carbon footprint, here are a list of ways to reduce your water carbon footprint:</br><ul>'.concat(suggestWater).concat('</ul>');
            }
            else if (water < waterAverage_low){
                suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household water CO<sub>2</sub> emission in Malaysia';
                suggestDiv4.innerHTML = 'No ways needed to reduce your water carbon footprint';
            }

            toggle(btn_id);

        }
        
        function suggestWaysElect(btn_id) {
            suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>ELECTRICITY</b> carbon footprint CO<sub>2</sub> Emission value is '.concat(electricity).concat(' kg.');
            if (electricity > electAverage_high){
                suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household electricity CO<sub>2</sub> emission in Malaysia';
                suggestDiv4.innerHTML = 'Here are a list of ways for you to reduce your electricity carbon footprint:</br><ul>'.concat(suggestElect).concat('</ul>');
            }
            else if (electricity >= electAverage_low && electricity <= electAverage_high){
                suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household electricity CO<sub>2</sub> emission in Malaysia';
                suggestDiv4.innerHTML = 'If you still want to reduce your electricity carbon footprint, here are a list of ways to reduce it:</br><ul>'.concat(suggestElect).concat('</ul>');
            }
            else if (electricity < electAverage_low){
                suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household electricity CO<sub>2</sub> emission in Malaysia';
                suggestDiv4.innerHTML = 'No ways needed to reduce your electricity carbon footprint';
            }

            toggle(btn_id);
        }

        function suggestWaysGas(btn_id) {
            suggestDiv2.innerHTML = 'Based on your latest calculation, your <b>GAS</b> carbon footprint CO<sub>2</sub> Emission value is '.concat(gas).concat(' kg.');
            if (gas > gasAverage_high){
                suggestDiv3.innerHTML = 'This value is <b>OVER</b> the average range of household gas CO<sub>2</sub> emission in Malaysia';
                suggestDiv4.innerHTML = 'Here are a list of ways for you to reduce your gas carbon footprint:</br><ul>'.concat(suggestGas).concat('</ul>');
            }
            else if (gas >= gasAverage_low && gas <= gasAverage_high){
                suggestDiv3.innerHTML = 'This value is <b>WITHIN</b> the average range of household gas CO<sub>2</sub> emission in Malaysia';
                suggestDiv4.innerHTML = 'If you still want to reduce your gas carbon footprint, here are a list of ways to reduce it:</br><ul>'.concat(suggestGas).concat('</ul>');
            }
            else if (gas < gasAverage_low){
                suggestDiv3.innerHTML = 'This value is <b>BELOW</b> the average range of household gas CO<sub>2</sub> emission in Malaysia';
                suggestDiv4.innerHTML = 'No ways needed to reduce your gas carbon footprint';
            }

            toggle(btn_id);
        }

        function viewHome(btn_id)   {
            toggle(btn_id);
            if (btn_id == 'home1') {
                vidhome1.src = 'https://www.youtube.com/embed/8q7_aV8eLUE?rel=0&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;enablejsapi=1';
                vidhome2.src = '';
                homeDiv1.style.display = 'block';
                homeDiv2.style.display = 'none';
                homeDiv3.style.display = 'none';
                
            }
            else if (btn_id == 'home2') {
                vidhome1.src = '';
                vidhome2.src = '';
                homeDiv1.style.display = 'none';
                homeDiv2.style.display = 'block';
                homeDiv3.style.display = 'none';
            }

            else if (btn_id == 'home3') {
                vidhome1.src = '';
                vidhome2.src = 'https://www.youtube.com/embed/HK8LLWSIIm4?rel=0&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;enablejsapi=1';
                homeDiv1.style.display = 'none';
                homeDiv2.style.display = 'none';
                homeDiv3.style.display = 'block';   
            }
        }

        function toggle(btn_id) {
            if (btn_id == 'btnSuggestAll') {
                a.classList.remove('btn-default');
                a.classList.add('btn-success');

                b.classList.remove('btn-success');
                b.classList.add('btn-default');

                c.classList.remove('btn-success');
                c.classList.add('btn-default');

                d.classList.remove('btn-success');
                d.classList.add('btn-default');                
            }

            else if (btn_id == 'btnSuggestWater') {
                a.classList.remove('btn-success');
                a.classList.add('btn-default');

                b.classList.remove('btn-default');
                b.classList.add('btn-success');

                c.classList.remove('btn-success');
                c.classList.add('btn-default');

                d.classList.remove('btn-success');
                d.classList.add('btn-default');                
            }

            else if (btn_id == 'btnSuggestElect') {
                a.classList.remove('btn-success');
                a.classList.add('btn-default');

                b.classList.remove('btn-success');
                b.classList.add('btn-default');

                c.classList.remove('btn-default');
                c.classList.add('btn-success');

                d.classList.remove('btn-success');
                d.classList.add('btn-default');                
            }

            else if (btn_id == 'btnSuggestGas') {
                a.classList.remove('btn-success');
                a.classList.add('btn-default');

                b.classList.remove('btn-success');
                b.classList.add('btn-default');

                c.classList.remove('btn-success');
                c.classList.add('btn-default');

                d.classList.remove('btn-default');
                d.classList.add('btn-success');                
            }

            else if (btn_id == 'allButton') {
                allButton.classList.remove('btn-default');
                allButton.classList.add('btn-success');

                waterButton.classList.remove('btn-success');
                waterButton.classList.add('btn-default');

                electButton.classList.remove('btn-success');
                electButton.classList.add('btn-default');

                gasButton.classList.remove('btn-success');
                gasButton.classList.add('btn-default');
            }
            
            else if (btn_id == 'waterButton') {
                allButton.classList.remove('btn-success');
                allButton.classList.add('btn-default');

                waterButton.classList.remove('btn-default');
                waterButton.classList.add('btn-success');

                electButton.classList.remove('btn-success');
                electButton.classList.add('btn-default');

                gasButton.classList.remove('btn-success');
                gasButton.classList.add('btn-default');
            }
            
            else if (btn_id == 'electButton') {
                allButton.classList.remove('btn-success');
                allButton.classList.add('btn-default');

                waterButton.classList.remove('btn-success');
                waterButton.classList.add('btn-default');

                electButton.classList.remove('btn-default');
                electButton.classList.add('btn-success');

                gasButton.classList.remove('btn-success');
                gasButton.classList.add('btn-default');
            }

            else if (btn_id == 'gasButton') {
                allButton.classList.remove('btn-success');
                allButton.classList.add('btn-default');

                waterButton.classList.remove('btn-success');
                waterButton.classList.add('btn-default');

                electButton.classList.remove('btn-success');
                electButton.classList.add('btn-default');

                gasButton.classList.remove('btn-default');
                gasButton.classList.add('btn-success');
            }

            else if (btn_id == 'home1') {
                home1.classList.remove('btn-default');
                home1.classList.add('btn-success');

                home2.classList.remove('btn-success');
                home2.classList.add('btn-default');

                home3.classList.remove('btn-success');
                home3.classList.add('btn-default');
            }

            else if (btn_id == 'home2') {
                home1.classList.remove('btn-success');
                home1.classList.add('btn-default');

                home2.classList.remove('btn-default');
                home2.classList.add('btn-success');

                home3.classList.remove('btn-success');
                home3.classList.add('btn-default');
            }

            else if (btn_id == 'home3') {
                home1.classList.remove('btn-success');
                home1.classList.add('btn-default');

                home2.classList.remove('btn-success');
                home2.classList.add('btn-default');

                home3.classList.remove('btn-default');
                home3.classList.add('btn-success');
            }
        } 
    </script>
</body>
	<br><br>
</html>