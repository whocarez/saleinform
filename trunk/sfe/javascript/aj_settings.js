var AjaxObject_Countries = {

	handleSuccess:function(o)
	{
		this.processResult(o);
	},

	handleFailure:function(o)
	{
	},

	processResult:function(o)
	{
		document.getElementById('settings_box_container').innerHTML = o.responseText;
	},

	startRequest:function() 
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
	   	YAHOO.util.Connect.asyncRequest('POST', 'settings/aj_change_country/'+countryRid, callback_countries);
	}

};

var callback_countries =
{
	success:AjaxObject_Countries.handleSuccess,
	failure:AjaxObject_Countries.handleFailure,
	scope: AjaxObject_Countries
};

var AjaxObject_Regions = {

	handleSuccess:function(o)
	{
		this.processResult(o);
	},

	handleFailure:function(o)
	{
	},

	processResult:function(o)
	{
		document.getElementById('settings_citieslist').innerHTML = o.responseText;
	},

	startRequest:function() 
	{
		var regionsRidObj = document.getElementById('settings_regions');
		var regionsRid = regionsRidObj.value;
		YAHOO.util.Connect.asyncRequest('POST', 'settings/aj_change_cities/'+regionsRid, callback_regions);
	}

};

var callback_regions =
{
	success:AjaxObject_Regions.handleSuccess,
	failure:AjaxObject_Regions.handleFailure,
	scope: AjaxObject_Regions
};

