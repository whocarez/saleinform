function RegionChange()
{
	var regionsRidObj = document.getElementById('settings_regions');
	var regionsRid = regionsRidObj.value;
	var url = 'settings/aj_change_cities/'+regionsRid;
	var target = 'settings_citieslist';	
	var myAjax = new Ajax.Updater(target, url, {method: 'get'});	
}

function CountryChange()
{
	var countryRidObj = document.settings_form.settings_country_rid;
	var countryRid = "";
	for (var i = 0; i < countryRidObj.length; i++)
	{
		if(countryRidObj[i].checked==true)
		{
			countryRid = countryRidObj[i].value;
			break;
		}
	}
	
	var url = 'settings/aj_change_country/'+countryRid;
	var target = 'settings_box_container';	
	var myAjax = new Ajax.Updater(target, url, {method: 'get'});	
}