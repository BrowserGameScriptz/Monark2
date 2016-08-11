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
// Attacked land
$donutDataMostAttackedLand = "";
$rank_nb = 5;
$n = 0;
foreach($MostAttackedLand as $land => $attacked_times){
	if($n < $rank_nb)
		$donutDataMostAttackedLand .= "{label: '".$Land[$land]->getLandName()."', data: ".$attacked_times.", color: getRandomColor()},";
	$n++;
}

// Win rate
$donutDataPlayerWinRate = "";
$sumWinRate = 0;
if(isset($PlayerWinRate[0])) unset($PlayerWinRate[0]); // del neutral
foreach($PlayerWinRate as $user => $winRate)
	$sumWinRate += $winRate;
foreach($PlayerWinRate as $user => $winRate)
	$donutDataPlayerWinRate .= "{label: '".$this->context->getGamePlayerName($user, $Users, $Bots)."', data: ".$winRate.", color: '#".$Color[$GamePlayer[$user]->getGamePlayerColorId()]->getColorCSS()."'},";

// Own lands
$donutDataLandOwned = "";
$sumLandOwned = 0;
if(isset($LandOwned[0])) unset($LandOwned[0]); // del neutral
foreach($LandOwned as $user => $count)
	$sumLandOwned += $count;
foreach($LandOwned as $user => $count)
	$donutDataLandOwned .= "{label: '".$this->context->getGamePlayerName($user, $Users, $Bots)."', data: ".$count.", color: '#".$Color[$GamePlayer[$user]->getGamePlayerColorId()]->getColorCSS()."'},";
	
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
    var donutDataMostAttackedLand = ['.$donutDataMostAttackedLand.'];
	var donutDataPlayerWinRate = ['.$donutDataPlayerWinRate.'];
	var donutDataLandOwned = ['.$donutDataLandOwned.'];
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
            threshold: 0.1,
			formatter: function(label, series){
	          var percent = Math.round(series.percent);
	          var number = series.data[0][1];
	          return ("<b>" + number + "</b>");
	        }
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
		
	$.plot("#donut-chart-best-player-win-ratio", donutDataPlayerWinRate, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
            threshold: 0.1,
			formatter: function(label, series){
	          var percent = Math.round(series.percent);
	          var number = series.data[0][1];
			  return ("<b>" + (number.toFixed(2))*100 + " % </b>");	        
			}
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
  
	$.plot("#donut-chart-land-owned", donutDataLandOwned, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
			threshold: 0.1,
            formatter: function(label, series){
	          var percent = Math.round(series.percent);
	          var number = series.data[0][1];
	          return ("<b>" + number + "</b>");
	        }
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
		
	$.plot("#donut-chart-player-long-turn", donutDataPlayerLongTurn, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.5,
          label: {
            show: true,
            radius: 2 / 3,
			threshold: 0.1,
			formatter: function(label, series){
	          var percent = Math.round(series.percent);
	          var number = series.data[0][1];
			  var date = new Date(number*1000); 
			  return ("<b>" + date.getHours() + "h " + date.getMinutes() + "m " + date.getSeconds() + "s</b>");
	        }
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
	//return ("<b>" + percent + "%</b><br/><b>" + number + "</b>");
	});' );
?>

<div class="game-stats">
	<h2><?= Html::encode($this->title) ?></h2>

	<table style="width: 100%">
		<tbody>
			<tr>
				<td>
					<div class="box box-primary">
						<div class="box-header with-border">
							<i class="fa fa-bar-chart-o"></i>
							<h3 class="box-title">Pays les plus attaqu&eacute;s</h3>
							<h4>TOP <?= $rank_nb ?></h4>
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
							<br>
						</div>
					</div>
				</td>
				<td>
					<div class="box box-primary">
						<div class="box-header with-border">
							<i class="fa fa-bar-chart-o"></i>
							<h3 class="box-title">Meilleur ratio de victoire</h3>
							<h4>Taux de victoire moyen :
							<?= round($sumWinRate/count($PlayerWinRate), 2)*100 ?> %</h4>
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
							<br>
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
							<h4>Nombre de pays moyen :
							<?= round($sumLandOwned/count($LandOwned)) ?></h4>
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
							<br>
						</div>
					</div>
				</td>
				<td>
					<div class="box box-primary">
						<div class="box-header with-border">
							<i class="fa fa-bar-chart-o"></i>
							<h3 class="box-title">Joueur avec les tours les plus longs</h3>
							<h4>Temps moyen :
							<?= date("h", $sumPlayerLongTurn/count($PlayerLongTurn)) ?> h
							<?= date("i", $sumPlayerLongTurn/count($PlayerLongTurn)) ?> min
							<?= date("s", $sumPlayerLongTurn/count($PlayerLongTurn)) ?> sec *</h4>
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
							* Attention donn&eacute;es inexactes si partie reprise
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>

</div>
