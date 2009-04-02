function RegionChange()
{
	var regionsRidObj = document.getElementById('region');
	var regionsRid = regionsRidObj.value;
	var url = 'aj_change_region/'+regionsRid;
	var target = 'city_container';	
	var myAjax = new Ajax.Updater(target, url, {method: 'get'});	
}

function CountryChange()
{
	var countryRidObj = document.getElementById('country');
	var countryRid = countryRidObj.value;
	var url = 'aj_change_country/'+countryRid;
	var target = 'region_container';	
	var myAjax = new Ajax.Updater(target, url, {method: 'get'});	
	RegionChange();	
}