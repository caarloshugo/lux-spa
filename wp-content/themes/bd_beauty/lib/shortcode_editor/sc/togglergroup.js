scnShortcodeMeta = {
  attributes: [{
    label: "Accordion",
    id: "accordion",
		controlType: "select-control", 
		options:     ['false', 'true']
  }, {
    label: "Style",
    id: "style",
		controlType: "select-control", 
		options:     ['', 'simple', 'faqs'],
		defValue:    '', 
		defText:     'default'
  }],
  disablePreview: true,
  shortcode: "togglergroup",
  defaultContent: "<br/><br/>[toggler title='First Toggler']<br/>...Toggler content goes here...<br/>[/toggler]" + 
                  "<br/><br/>[toggler title='Second Toggler']<br/>...Toggler content goes here...<br/>[/toggler]" +
                  "<br/><br/>[toggler title='Third Toggler']<br/>...Toggler content goes here...<br/>[/toggler]" +
                  "<br/><br/>"
};