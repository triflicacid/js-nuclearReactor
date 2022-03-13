<?php
  require "php/master.php";
  $REACTOR = $_GET['r'];
  if($REACTOR==""){header("Location: index.php?error=NoReactor");}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>RNMC - Controls: Unit <?php echo$REACTOR;?></title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/master2.css">
    <link rel="stylesheet" href="css/interface.css">
  </head>
  <body>
    <!-- PREP STUFF ********************************************************************** -->
    <span class="audio_area"></span>
    <div id="popup" class="popup-wrapper" hidden>
      <div class="popup-container">
        <h2 id="popup-title"></h2>
        <p><span id="popup-text"></span> &nbsp;&nbsp; <button id="cancelBtn" onclick="displayLoad('__CANCEL__')">Cancel</button></p>
        <progress id="popup-bar" value="0" max="100"></progress>
      </div>
    </div>
    <div id="userMessage" class="userMessage-wrapper" hidden>
      <div class="userMessage-container">
        <h2 id="userMessage-title"></h2>
        <b id="userMessage-text"></b><br><br>
        <button onclick="this.parentNode.parentNode.style.display='none'">Close</button>
      </div>
    </div>
  	<div class="meltdown-wrapper" STAGE="one" style="display: none">
  		<div class="meltdown-container">
  			<h1 i="meltdown">MELTDOWN IMMINENT</h1>
  		</div>
  	</div>
    <!-- MAIN ******************************************************************************* -->
    <div class="interface sub">
      <center>
		 <!-- PRIMRY CONTROLS *********************************************************************** -->
     <div class="scroll-pane pane" id="primary-controls-pane">
       <h1>Primary Controls: Unit <?php echo$_GET['r'];?></h1>
        <table RAW class="wrapper-table">
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th>Core Temperature</th>
                </tr>
                <tr>
                  <td i="temp-text" id="temp-text-level"></td>
                </tr>
                <tr i="temp-bar" id="temp-bar-1">
                  <td>
					<div center i="temp-bar-bg">
						<div i="temp-bar-fg"></div>
					</div>
                  </td>
                </tr>
				<tr>
          		  <td><b i="temp-text" class="big-text" id="temp-text-int"></b></td>
				</tr>
              </table>
            </td>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Reactor Status</th>
                </tr>
                <tr>
                  <td class="status-text" i="status-text"></td>
                  <td i="status-light" class="status-light" size="tiny"></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="3">Coolant Pumps</th>
                </tr>
                <tr>
                  <td><button onclick="coolantPumps('DEC')">-</button></td>
                  <td><meter id="coolant-pumps-meter" min="0" max="100"></meter></td>
                  <td><button onclick="coolantPumps('INC')">+</button></td>
                </tr>
                <tr>
                  <td/>
                  <td><b class="big-text" id="coolant-pumps-percent"></b></td>
                </tr>
                <tr>
                  <td><button onclick="coolantPumps('TO:0')">Min</button></td>
                  <td><button onclick="coolantPumps('TO:50')">Half</button></td>
                  <td><button onclick="coolantPumps('TO:100')">Max</button></td>
                </tr>
              </table>
            </td>
            <td>
              <table class="section">
                <tr>
                  <th colspan="3">Containment Dome</th>
                </tr>
                <tr>
                  <td>Status:</td>
                  <td i="status-text" id="containment-status"></td>
                  <td i="status-light" size="tiny" id="containment-light"></td>
                </tr>
                <tr>
                  <td>Structure:</td>
                  <td><meter id="containment-meter" min="0" max="100" low="25" high="75" optimum="100"></meter></td>
                  <td class="big-text" id="containment-percent"></td>
                </tr>
                <tr>
                  <td>Dmg Rate:</td>
                  <td class="big-text" id="containment-dmg-r8"></td>
                  <td>/sec</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="3">Control Rods</th>
                </tr>
                <tr>
                  <td><button onclick="controlRods('lower')">&minus;</button></td>
                  <td><meter id="control-rods-meter" min="0" max="100"></meter></td>
                  <td><button onclick="controlRods('raise')">&plus;</button></td>
                </tr>
                <tr>
                  <td/>
                  <td><b class="big-text" id="control-rods-percent"></b></td>
                </tr>
                <tr>
                  <td><button onclick="controlRods('TO:0')">Min</button></td>
                  <td><button onclick="controlRods('TO:50')">Half</button></td>
                  <td><button onclick="controlRods('TO:100')">Max</button></td>
                </tr>
              </table>
            </td>
            <td>
              <table class="section">
                <tr>
                  <th colspan="3">Fuel Rods</th>
                </tr>
                <tr>
                  <td colspan="3" id="fuel-life-meter"></td>
                </tr>
                <tr>
                  <td colspan="3" class="big-text" id="fuel-life-text"></td>
                </tr>
                <tr>
                  <td>Dmg Rate:</td>
                  <td class="big-text" id="fuel-dec-rate"></td>
                  <td>/10sec</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th>Steam Pressure</th>
                </tr>
                <tr>
                  <td class="big-text" id="steam-pressure-psi-text"></td>
                </tr>
              </table>
            </td>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Turbines</th>
                </tr>
                <tr>
                  <td>RPM For One Turbine</td>
                  <td class="big-text" id="turbine-rpm-text-1"></td>
                </tr>
                <tr>
                  <td>RPM For All Turbines</td>
                  <td class="big-text" id="turbine-rpm-text-all"></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="3">Demand</th>
                </tr>
                  <td>Baseload: </td>
                  <td class="big-text" id="reactor-baseload"></td>
                  <td>mW</td>
                <tr>
                  <td>Demand: </td>
                  <td class="big-text" id="demand-bound"></td>
                  <td>mW</td>
                </tr>
                <tr>
                  <td></td>
                  <td colspan="2" id="demand-inc-dec"></td>
                </tr>
                <tr>
                  <td>Meeting Demand: </td>
                  <td class="big-text" i="YesNo-text" id="meeting-demand"></td>
                  <td i="YesNo-light" id="meeting-demand-light"></td>
                </tr>
                <tr>
                  <td>Demand Bonus: </td>
                  <td colspan="2" class="big-text" id="demand-bonus"></td>
                </tr>
              </table>
            </td>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Generator</th>
                </tr>
                <tr>
                  <td>For One Generator:</td>
                  <td class="big-text" id="generator-output-1"></td>
                </tr>
                <tr>
                  <td>For All Generators:</td>
                  <td class="big-text" id="generator-output-all"></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
      <!-- Secondary CONTROLS *********************************************************************** -->
      <div class="scroll-pane pane" id="secondary-controls-pane" hidden>
        <h1>Secondary Controls: Unit <?php echo $_GET['r'];?></h1>
        <table RAW>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Grid</th>
                </tr>
                <tr>
                  <td i="OnOff-text" id="grid-connected"></td>
                  <td i="OnOff-light" id="grid-connected-light" size="tiny"></td>
                </tr>
                <tr>
                  <td colspan="2"><button onclick="changeGrid('yes')">Connect</buton>  <button onclick="changeGrid('no')">Disconnect</buton></td>
                </tr>
              </table>
            </td>
			<td>
			  <table class="section">
			    <tr>
                  <th colspan="2">Alarms</th>
                </tr>
				<tr>
                  <td colspan="2"><button onclick="stopAlarms()">Alarms Off</button> <button onclick="startAlarms()">Alarms On</button></td>
                </tr>
                <tr>
                  <td i="OnOff-text" id="alarm-status-text" size="tiny"></td>
                  <td i="OnOff-light" id="alarm-status-light" size="tiny"></td>
                </tr>
			  </table>
			</td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="3">Income</th>
                </tr>
                <tr>
                  <td>Online:</td>
                  <td class="big-text" id="income-text"></td>
                  <td>/sec</td>
                </tr>
                <tr>
                  <td>Rate:</td>
                  <td class="big-text" id="income-per-MWH"></td>
                  <td>/ mWh</td>
                </tr>
                <tr>
                  <td>Offline:</td>
                  <td class="big-text" id="offline-income-text"></td>
                  <td>/sec</td>
                </tr>
              </table>
            </td>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Money</th>
                </tr>
                <tr>
                  <td>Money ready to collect:</td>
                  <td class="big-text" money id="collect-money"></td>
                </tr>
                <tr>
                  <td colspan="2"><button onclick="collectMoney()">Collect Money</button></td>
                </tr>
              </table>
            </td>
          </tr>
		  <tr>
		    <td>
			  <table class="section">
				<tr>
				  <th colspan="3">Maintenance</th>
				</tr>
				<tr>
				  <td>Replace Fuel Rods</td>
				  <td><span money id="replace-fuel-cost"></span></td>
				  <td><button onclick="repair('fuel', num(REACTOR.replaceFuelCost))">&check;</button></td>
				</tr>
				<tr>
				  <td>Repair Containment Dome</td>
				  <td><span money id="repair-dome-cost"></span></td>
				  <td><button onclick="repair('containmentDome', num(REACTOR.REPAIR_containmentDomeCost))">&check;</button></td>
				</tr>
			  </table>
			</td>
		  </tr>
        </table>
      </div>
      <!-- UPGRADES *********************************************************************** -->
      <div class="scroll-pane pane" id="upgrades-pane" style="display: none">
        <h1>Upgrades: Unit <?php echo$_GET['r'];?></h1>
        <table RAW>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Containment Dome</th>
                </tr>
                <tr>
                  <td colspan="2" desc>Upgrading this will increase the temperatures it can withstand by 120C</td>
                </tr>
                <tr>
                  <td>Current Level:</td>
                  <td class="big-text current-level" id="containment-current-level"></td>
                </tr>
                <tr>
                  <td>Next Level:</td>
                  <td class="big-text next-level" id="containment-next-level"></td>
                </tr>
                <tr>
                  <td colspan="2"><button onclick="upgrade('containment_dome', num(REACTOR.containmentDomeUpgradeCost))">Upgrade for £<span money id="containment-upgrade-cost"></span></button></td>
                </tr>
              </table>
            </td>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Reactor</th>
                </tr>
                <tr>
                  <td colspan="2" desc>Upgrading this will enable you to build <span id="reactor-size-inc-how-many1"></span> more turbines and <span id="reactor-size-inc-how-many2"></span> more generators</td>
                </tr>
                <tr>
                  <td>Current Level:</td>
                  <td class="big-text current-level" id="reactor-size-current-level"></td>
                </tr>
                <tr>
                  <td>Next Level:</td>
                  <td class="big-text next-level" id="reactor-size-next-level"></td>
                </tr>
                <tr>
                  <td colspan="2"><button onclick="upgrade('reactor_size', num(REACTOR.reactorSizeUpgradeCost))">Upgrade for £<span money id="reactor-size-upgrade-cost"></span></button></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Steam Vessel</th>
                </tr>
                <tr>
                  <td colspan="2" desc>Upgrading this will increase the steam pressure by <span id="steam-mult"></span></td>
                </tr>
                <tr>
                  <td>Current Level:</td>
                  <td class="big-text current-level" id="steam-current-level"></td>
                </tr>
                <tr>
                  <td>Next Level:</td>
                  <td class="big-text next-level" id="steam-next-level"></td>
                </tr>
                <tr>
                  <td colspan="2"><button onclick="upgrade('steam', num(REACTOR.steamUpgradeCost))">Upgrade for £<span money id="steam-upgrade-cost"></span></button></td>
                </tr>
              </table>
            </td>
            <td>
              <table class="section">
                <tr>
                  <th colspan="3">Fuel Rods</th>
                </tr>
                <tr>
                  <td colspan="3" desc>Upgrading these will increase the life of the fuel rods</td>
                </tr>
                <tr>
                  <td>Now:</td>
                  <td class="big-text current-level" id="fuel-rod-current-life"></td>
                  <td>/10sec</td>
                </tr>
                <tr>
                  <td>After Upgrade:</td>
                  <td class="big-text next-level" id="fuel-rod-next-life"></td>
                  <td>/10sec</td>
                </tr>
                <tr>
                  <td colspan="3"><button onclick="upgrade('fuel_rods', num(REACTOR.fuelRodLifeUpgradeCost))">Upgrade for £<span money id="fuel-life-upgrade-cost"></span></button></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Generator</th>
                </tr>
                <tr>
                  <td colspan="2" desc>Upgrading this will multiply the electricity generated by <span id="generator-mult"></span></td>
                </tr>
                <tr>
                  <td>Current Level:</td>
                  <td class="big-text current-level" id="generator-current-level"></td>
                </tr>
                <tr>
                  <td>Next Level:</td>
                  <td class="big-text next-level" id="generator-next-level"></td>
                </tr>
                <tr>
                  <td colspan="2"><button onclick="upgrade('generator', num(REACTOR.generatorUpgradeCost))">Upgrade for £<span money id="generator-upgrade-cost"></span></button></td>
                </tr>
              </table>
            </td>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">Turbines</th>
                </tr>
                <tr>
                  <td colspan="2" desc>Upgrading this will multiply the RPM of a turbine by <span id="turbine-mult"></span></td>
                </tr>
                <tr>
                  <td>Current Level:</td>
                  <td class="big-text current-level" id="turbine-current-level"></td>
                </tr>
                <tr>
                  <td>Next Level:</td>
                  <td class="big-text next-level" id="turbine-next-level"></td>
                </tr>
                <tr>
                  <td colspan="2"><button onclick="upgrade('turbine', num(REACTOR.turbineUpgradeCost))">Upgrade for £<span money id="turbine-upgrade-cost"></span></button></td>
                </tr>
              </table>
            </td>
        </table>
      </div>
      <!-- Extend (build) *********************************************************************** -->
      <div class="scroll-pane pane" id="build-pane" style="display: none">
        <h1>Extend: Unit <?php echo $_GET['r'];?></h1>
        <table RAW>
          <tr>
            <td>
              <table class="section info_box">
                <tr>
                  <th colspan="3">Information</th>
                </tr>
                <tr>
                  <td>Reactor Size is</td>
                  <td class="big-text" id="info-reactor-size"></td>
                </tr>
                <tr>
                  <td rowspan="2">Which can support...</td>
                  <td class="big-text" id="info-turbine-support"></td>
                  <td>turbines</td>
                </tr>
                <tr>
                  <td class="big-text" id="info-generator-support"></td>
                  <td>generators</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="3">Build More Turbines</th>
                </tr>
                <tr>
                  <td>You currently have</td>
                  <td class="big-text current-level" id="current-no-turbines"></td>
                  <td>turbines</td>
                </tr>
                <tr>
                  <td>Building another turbine will cost</td>
                  <td class="big-text" money id="turbine-cost"></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3"><button onclick="build('turbine', num(REACTOR.buildTurbineCost))">Build Another Turbine</button></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="3">Build More Generators</th>
                </tr>
                <tr>
                  <td>You currently have</td>
                  <td class="big-text current-level" id="current-no-generators"></td>
                  <td>generators</td>
                </tr>
                <tr>
                  <td>Building another generator will cost</td>
                  <td class="big-text" money id="generator-cost"></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3"><button onclick="build('generator', num(REACTOR.buildGeneratorCost))">Build Another Generator</button></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
      <!-- Stats *********************************************************************** -->
      <div class="scroll-pane pane" id="stats-pane" style="display: none">
        <h1>Stats: Unit <?php echo $_GET['r'];?></h1>
        <table RAW>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th colspan="2">General</th>
                </tr>
                <tr>
                  <td>Est </td>
                  <td class="big-text" id="reactor-est"></td>
                </tr>
                <tr>
                  <td>Time:</td>
                  <td id="stats-time-text"></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="section">
                <tr>
                  <th>Total Money Generated</th>
                </tr>
                <tr>
                  <td id="stats-money-generated" class="big-text" money></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table border="1" class="section">
                <tr>
                  <th colspan="4">Temperature Boundaries</th>
                </tr>
                <tr>
                  <td id="stats-status-ok"></td>
                  <td i="temp-text" temp="stable">Stable</td>
                  <td i="status-text" status="OK">OK</td>
                  <td i="status-light" size="tiny" status="OK"></td>
                </tr>
                <tr>
                  <td id="stats-status-warning"></td>
                  <td i="temp-text" temp="high">High</td>
                  <td i="status-text" status="warning">Warning</td>
                  <td i="status-light" size="tiny" status="warning"></td>
                </tr>
                <tr>
                  <td id="stats-status-alert"></td>
                  <td i="temp-text" temp="very high">Very High</td>
                  <td i="status-text" status="alert">Alert</td>
                  <td i="status-light" size="tiny" status="alert"></td>
                </tr>
                <tr>
                  <td id="stats-status-critical"></td>
                  <td i="temp-text" temp="critical">Critical</td>
                  <td i="status-text" status="critical">Critical</td>
                  <td i="status-light" size="tiny" status="critical"></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table>
                <tr>
                  <th colspan="2">Level Limits</th>
                </tr>
                <tr>
                  <td>Reactor Size</td>
                  <td class="big-text" id="reactor-size-lvl-limit"></td>
                </tr>
                <tr>
                  <td>Turbines</td>
                  <td class="big-text" id="turbines-lvl-limit"></td>
                </tr>
                <tr>
                  <td>Steam Vessel</td>
                  <td class="big-text" id="steam-lvl-limit"></td>
                </tr>
                <tr>
                  <td>Generators</td>
                  <td class="big-text" id="generators-lvl-limit"></td>
                </tr>
                <tr>
                  <td>Fuel Rods</td>
                  <td class="big-text" id="fuel-rods-lvl-limit"></td>
                </tr>
                <tr>
                  <td>Containment Dome</td>
                  <td class="big-text" id="containment-dome-lvl-limit"></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </center>
    </div>
    <footer>
      <a href="javascript:void(0)" onclick="saveProgress(true, 'index.php')">Back</a> |
      <b id="time-text"></b>
	     <div class="menu">
		      <a href="javascript:void(0)" style="background:blue;color:white;" class="a-pane" onclick="changePane('primary-controls-pane', this)">Primary Controls</a>
          <a href="javascript:void(0)" class="a-pane" onclick="changePane('secondary-controls-pane', this)">Secondary Controls</a>
			    <a href="javascript:void(0)" class="a-pane" onclick="changePane('upgrades-pane', this)">Upgrades</a>
          <a href="javascript:void(0)" class="a-pane" onclick="changePane('build-pane', this)">Extend Plant</a>
          <a href="javascript:void(0)" class="a-pane" onclick="changePane('stats-pane', this)">Unit Stats</a>
	      </div>
      <span class="login-msg">Logged In as <?php echo$username;?></span>
    </footer>
    <!-- SCRIPTS **************************************************************************** -->
    <script src="php/getDBInfo.php?r=<?php echo$REACTOR;?>" charset="utf-8"></script>
    <script type="text/javascript">try{console.log(`VIEWING UNIT ${REACTOR.name}`)}catch(a){window.location.href="index.php";}</script>
	<script src="js/vars.js" charset="utf-8"></script>
    <script src="js/master.js" charset="utf-8"></script>
    <script src="js/view.js" charset="utf-8"></script>
    <script src="js/stats.js" charset="utf-8"></script>
  </body>
</html>
