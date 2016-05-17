<div class="logo"></div>
		
		<ul id="nav" class="nav">
			<li class="active"><a class="ng-binding" ng-bind="oLan.preview" ng-click="jumpTo('preview')">Live View</a></li>
			<li><a class="ng-binding" ng-click="jumpTo('playback')">Playback</a></li>
			<li><a class="ng-binding" ng-click="jumpTo('download')">Picture</a></li>
			<li><a class="ng-binding" ng-click="jumpTo('config')">Configuration</a></li>
		</ul>
		
		<div class="header-r">
			<div class="user">
				<div class="icon"></div>
				<label class="ng-binding" ng-bind="username">User</label>
			</div>			
			<div class="exit" ng-click="exit()">
				<div class="icon"></div>
				<label class="pointer ng-binding" ng-bind="oLan.logout">Logout</label>
			</div>
		</div>