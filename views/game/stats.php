<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;

/* @var $this yii\web\View */
$this->title = Yii::t ( 'game', 'Title_Game_Stats' );

// Set JS var
$this->registerJs ( $this->context->getJSConfig (), View::POS_HEAD );
$this->registerJsFile ( "@web/js/game/game.js", [ 
		'depends' => [ 
				AppAsset::className () 
		] 
] );
$this->registerJsFile ( "@web/js/game/ajax.js", [ 
		'depends' => [ 
				AppAsset::className () 
		] 
] );


// Set data


// Player long turn
$donutDataPlayerLongTurn = "";
$sumPlayerLongTurn = 0;
foreach($PlayerLongTurn as $user => $time)
	$sumPlayerLongTurn += $time;

if($sumPlayerLongTurn > 0)
	foreach($PlayerLongTurn as $user => $time)
		$donutDataPlayerLongTurn .= "{label: '".$this->context->getGamePlayerName($user, $Users, $Bots)."', data: ".($time * 100)/$sumPlayerLongTurn.", color: '#".$Color[$GamePlayer[$user]->getGamePlayerColorId()]->getColorCSS()."'},";

$this->registerJs ( '
		  $(function () {
    var donutDataMostAttackedLand = [
      {label: "Series2", data: 30, color: "#3c8dbc"},
      {label: "Series3", data: 20, color: "#0073b7"},
      {label: "Series4", data: 50, color: "#00c0ef"}
    ];
	var donutDataBestPlayerWinRatio = [
      {label: "Series2", data: 20, color: "#bcac55"},
      {label: "Series3", data: 40, color: "#b7b711"},
      {label: "Series4", data: 40, color: "#efef00"}
    ];
	var donutDataLandOwned = [
      {label: "Series2", data: 30, color: "#3c8dbc"},
      {label: "Series3", data: 20, color: "#0073b7"},
      {label: "Series4", data: 50, color: "#00c0ef"}
    ];
	var donutDataPlayerLongTurn = ['.$donutDataPlayerLongTurn.'];
		
    $.plot("#donut-chart-most-attacked-land", donutDataMostAttackedLand, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: true
      }
    });
		
	$.plot("#donut-chart-best-player-win-ratio", donutDataBestPlayerWinRatio, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: true
      }
    });
  
	$.plot("#donut-chart-land-owned", donutDataLandOwned, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: true
      }
    });	
		
	$.plot("#donut-chart-player-long-turn", donutDataPlayerLongTurn, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
	  grid: {
        hoverable: true,
        clickable: true
      },
      legend: {
        show: true
      }
    });
	
	});

  function labelFormatter(label, series) {
	//label
    return Math.round(series.percent) + "%";
  }' );
?>

<div class="game-stats">
	<h1><?= Html::encode($this->title) ?></h1>

	<table style="width: 100%">
		<tbody>
			<tr>
				<td>
					<div class="box box-primary">
						<div class="box-header with-border">
							<i class="fa fa-bar-chart-o"></i>
							<h3 class="box-title">Pays les plus attaqu&eacute;s</h3>
						</div>
						<div class="box-body">
							<div id="donut-chart-most-attacked-land"
								style="height: 300px; padding: 0px; position: relative;">
								<canvas class="flot-base" width="743" height="375"
									style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 595px; height: 300px;"></canvas>
								<canvas class="flot-overlay" width="743" height="375"
									style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 595px; height: 300px;"></canvas>
								<span class="pieLabel" id="pieLabel0"
									style="position: absolute; top: 70.5px; left: 356px;">
									<div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series2<br>30%
									</div>
								</span> <span class="pieLabel" id="pieLabel1"
									style="position: absolute; top: 210.5px; left: 334px;">
									<div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series3<br>20%
									</div>
								</span><span class="pieLabel" id="pieLabel2"
									style="position: absolute; top: 129.5px; left: 175px;"><div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series4<br>50%
									</div></span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="box box-primary">
						<div class="box-header with-border">
							<i class="fa fa-bar-chart-o"></i>
							<h3 class="box-title">Meilleur ratio de victoire</h3>
						</div>
						<div class="box-body">
							<div id="donut-chart-best-player-win-ratio"
								style="height: 300px; padding: 0px; position: relative;">
								<canvas class="flot-base" width="743" height="375"
									style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 595px; height: 300px;"></canvas>
								<canvas class="flot-overlay" width="743" height="375"
									style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 595px; height: 300px;"></canvas>
								<span class="pieLabel" id="pieLabel0"
									style="position: absolute; top: 70.5px; left: 356px;">
									<div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series2<br>30%
									</div>
								</span> <span class="pieLabel" id="pieLabel1"
									style="position: absolute; top: 210.5px; left: 334px;">
									<div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series3<br>20%
									</div>
								</span><span class="pieLabel" id="pieLabel2"
									style="position: absolute; top: 129.5px; left: 175px;"><div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series4<br>50%
									</div></span>
							</div>
						</div>
					</div>
				</td>
			</tr>
						<tr>
				<td>
					<div class="box box-primary">
						<div class="box-header with-border">
							<i class="fa fa-bar-chart-o"></i>
							<h3 class="box-title">Pays occup&eacute;s par joueur</h3>
						</div>
						<div class="box-body">
							<div id="donut-chart-land-owned"
								style="height: 300px; padding: 0px; position: relative;">
								<canvas class="flot-base" width="743" height="375"
									style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 595px; height: 300px;"></canvas>
								<canvas class="flot-overlay" width="743" height="375"
									style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 595px; height: 300px;"></canvas>
								<span class="pieLabel" id="pieLabel0"
									style="position: absolute; top: 70.5px; left: 356px;">
									<div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series2<br>30%
									</div>
								</span> <span class="pieLabel" id="pieLabel1"
									style="position: absolute; top: 210.5px; left: 334px;">
									<div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series3<br>20%
									</div>
								</span><span class="pieLabel" id="pieLabel2"
									style="position: absolute; top: 129.5px; left: 175px;"><div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series4<br>50%
									</div></span>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="box box-primary">
						<div class="box-header with-border">
							<i class="fa fa-bar-chart-o"></i>
							<h3 class="box-title">Joueur avec les tours les plus longs</h3>
							<h4>Temps moyen :
							<?= date("H", $sumPlayerLongTurn/count($PlayerLongTurn)) ?> h 
							<?= date("i", $sumPlayerLongTurn/count($PlayerLongTurn)) ?> min
							<?= date("s", $sumPlayerLongTurn/count($PlayerLongTurn)) ?> sec</h4>
						</div>
						<div class="box-body">
							<div id="donut-chart-player-long-turn"
								style="height: 300px; padding: 0px; position: relative;">
								<canvas class="flot-base" width="743" height="375"
									style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 595px; height: 300px;"></canvas>
								<canvas class="flot-overlay" width="743" height="375"
									style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 595px; height: 300px;"></canvas>
								<span class="pieLabel" id="pieLabel0"
									style="position: absolute; top: 70.5px; left: 356px;">
									<div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series2<br>30%
									</div>
								</span> <span class="pieLabel" id="pieLabel1"
									style="position: absolute; top: 210.5px; left: 334px;">
									<div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series3<br>20%
									</div>
								</span><span class="pieLabel" id="pieLabel2"
									style="position: absolute; top: 129.5px; left: 175px;"><div
										style="font-size: 13px; text-align: center; padding: 2px; color: #fff; font-weight: 600;">
										Series4<br>50%
									</div></span>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>

</div>
