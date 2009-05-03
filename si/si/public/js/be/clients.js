function onCountryChange(){
	$.ajax({
		type: "POST",
		url: "/be/clients/get_regions",
		data: {'_countries_rid':$('#_countries_rid').val()},
		success: function(msg){
			$('#_cities_rid > option').remove();
			$('#_regions_rid > option').remove();
			$('#_regions_rid').html(msg);
		}
	});
}

function onRegionChange(){
	$.ajax({
		type: "POST",
		url: "/be/clients/get_cities",
		data: {'_regions_rid':$('#_regions_rid').val()},
		success: function(msg){
			$('#_cities_rid > option').remove();
			$('#_cities_rid').html(msg);
		}
	});
}

function gen_passwd(){
	$.ajax({
		type: "POST",
		url: "/be/clients/gen_passwd",
		data: {},
		success: function(msg){
			$('#passwd').val(msg);
		}
	});
}