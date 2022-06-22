function bascule(elem)
	{
		etat=document.getElementById(elem).style.visibility;
		if(etat=="hidden"){document.getElementById(elem).style.visibility="visible";}
		else{document.getElementById(elem).style.visibility="hidden";}
	}
	
	//hs.graphicsDir = '<{$smarty.const.XOOP_URL}>/Frameworks/zoom/graphics/';
	//hs.graphicsDir = 'http://localhost:8101/origami/Frameworks/zoom/graphics/';
	//hs.graphicsDir = './js/zoom/graphics/';
	//hs.graphicsDir = '../../../Frameworks/zoom/graphics/';
	
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'rounded-white';
	hs.wrapperClassName = 'controls-in-heading';
	hs.fadeInOut = true;
	hs.minWidth = 900;
	hs.maxWidth = 900;

	//hs.allowMultipleInstances = false;
	//hs.dimmingOpacity = 0.75;

	// Add the controlbar
	if (hs.addSlideshow) hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: false,
		overlayOptions: {
			opacity: 1,
			position: 'top center',
			hideOnMouseOut: false
		}
	});

