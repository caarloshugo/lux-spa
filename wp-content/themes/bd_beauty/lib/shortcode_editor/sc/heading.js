scnShortcodeMeta = {
  attributes: [{
    label: "Heading",
    id: "content",
    isRequired: true
  }, {
    label: "Type",
    id: "type",
		controlType: "select-control", 
		options:     ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
		defValue:    'h2', 
		defText:     'h2'
  }, {
    label: "Underlined",
    id: "underlined",
		controlType: "select-control", 
		options:     ['false', 'true']
  }, {
    label: "No Top Padding",
    id: "no_top_padding",
		controlType: "select-control", 
		options:     ['false', 'true']
  }, {
    label: "No Bottom Padding",
    id: "no_bottom_padding",
		controlType: "select-control", 
		options:     ['false', 'true']
  }],
  defaultContent: "Your Heading",
  shortcode: "heading"
};