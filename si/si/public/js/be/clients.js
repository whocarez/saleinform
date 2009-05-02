function onCountryChange(){
	$.ajax({
		type: "POST",
		url: "/be/clients/get_regions",
		data: {'_countries_rid':$('#_countries_rid')},
		success: function(msg){
			alert( "Data Saved: " + msg );
		}
	});
}