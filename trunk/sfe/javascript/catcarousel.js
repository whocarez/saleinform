function buttonStateHandler(button, enabled) {
 if (button == "prev-arrow") 
   $('prev-arrow').src = enabled ? "images/left-enabled.gif" : "images/left-disabled.gif"
 else 
   $('next-arrow').src = enabled ? "images/right-enabled.gif" : "images/right-disabled.gif"
}

function animHandler(carouselID, status, direction) {
  var region = $(carouselID).down(".carousel-clip-region")
  if (status == "before") {
    Effect.Fade(region, {to: 0.3, queue: { position:'end', scope: "carousel" }, duration: 0.2})
  }
  if (status == "after") {
    Effect.Fade(region, {to: 1, queue: { position:'end', scope: "carousel" }, duration: 0.2})
  }
}
Event.observe(window, "load", initCarousel);
function initCarousel() {
    var carousel = new Carousel("catcarousel",  
    	{
    		numVisible:3,
    		buttonStateHandler: buttonStateHandler, 
    		animParameters: {duration: 0.5}
    	});
}
