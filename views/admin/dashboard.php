<div class="containerz" id="Dashboard">
	<div class="cards">
		<div class="card">
			<div class="card-content">
				<div class="number"><?php echo $usersCount ?></div>
				<div class="card-name">Users</div>
			</div>
			<div class="icon-box">
				<i class="fas fa-users"></i>
			</div>
		</div>
		<div class="card">
			<div class="card-content">
				<div class="number"><?php echo $orphanagesCount ?></div>
				<div class="card-name">Orphanages</div>
			</div>
			<div class="icon-box">
				<i class="fas fa-home"></i>
			</div>
		</div>
		<div class="card">
			<div class="card-content">
				<div class="number">0</div>
				<div class="card-name">Reports</div>
			</div>
			<div class="icon-box">
				<i class="fas fa-book"></i>
			</div>
		</div>
	</div>
	<div class="charts">
		<div class="chart shadow-lg">
			<canvas id="graphCanvas"></canvas>
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
        var name = ['week 1', 'week 2', 'week 3', 'week 4',];

        
        var marks = [60, 67, 89, 90, ];

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
                    label: 'number',
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
