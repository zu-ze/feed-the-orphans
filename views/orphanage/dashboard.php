<div class="containerz" id="Dashboard"> 
	<div class="cards">
		<div class="card">
			<div class="card-content">
				<div class="number"><?php echo $donationsCount ?></div>
				<div class="card-name">Donations</div>
			</div>
			<div class="icon-box">
				<i class="fas fa-donate"></i>
			</div>
		</div>
		<div class="card">
			<div class="card-content">
				<div class="number"><?php echo $donarsCount ?></div>
				<div class="card-name">Donors</div>
			</div>
			<div class="icon-box">
				<i class="fas fa-users"></i>
			</div>
		</div>
		<div class="card">
			<div class="card-content">
				<div class="number">0</div>
				<div class="card-name">Reports</div>
			</div>
			<div class="icon-box">
				<i class="fas fa-chart-bar"></i>
			</div>
		</div>
	</div>

	<div class="charts">
		<div class="chart">
            <canvas id="graphCanvas"></canvas>
            <form action="">
                <input type="hidden" id="4week" value="<?php echo $chart['4 weeks ago'] ?>" >
                <input type="hidden" id="3week" value="<?php echo $chart['3 weeks ago'] ?>" >
                <input type="hidden" id="2week" value="<?php echo $chart['2 weeks ago'] ?>" >
                <input type="hidden" id="1week" value="<?php echo $chart['1 week ago'] ?>" >
            </form>
		</div>
	</div>
</div>
<script type="text/javascript" src="/vendor/Chart.min.js"></script>
<script type="text/javascript">
    $(document).on('click', '.sidebar li', function(event) {
        var id = $(this).attr('data');
        //alert(id);

        $('.sidebar li').removeClass('active');
        $(this).addClass('active');
        $('.containerz').hide();
        $('#'+id).show();
    })

    function showGraph(div){
        var name = ['4 weeks ago', '3 weeks ago', '2 weeks ago', '1 week ago'];

        
        var marks = [
            document.getElementById('4week').value, 
            document.getElementById('3week').value, 
            document.getElementById('2week').value, 
            document.getElementById('1week').value
        ];

        /*
        for (var i in data) {
            name.push(data[i].position_Name);
            marks.push(data[i].numberOfCandidate);
        }
        */
        var chartdata = {
            labels: name,
            datasets: [
                {
                    label: 'donations',
                    // fill: false,
                    backgroundColor: '#247cf7',
                    borderColor: '#46d5f1',
                    hoverBackgroundColor: '#CCCCCC',
                    hoverBorderColor: '#666666',
                    data: marks,
                }
            ]
        };

        var graphTarget = $("#"+div);

        var barGraph = new Chart(graphTarget, {
            type: 'line',
            data: chartdata,
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Donations Received'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Week of Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Number of Donations'
                        },
                        ticks: {
                            min: 0,
                            //======max:100========
                            // forces step size to be 5 units
                            //======stepSize: 1=========
                        }
                    }]
                }
            }
        });
    }

    showGraph('graphCanvas');
</script>
