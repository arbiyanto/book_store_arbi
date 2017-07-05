<div id="distributorList" class="ui horizontal bulleted list tes2" >
	<a class="item"  ng-repeat="d in distributor" ng-click="updateDistributor(d.id)">
	{{d.distributor_name}}
	</a>
</div>