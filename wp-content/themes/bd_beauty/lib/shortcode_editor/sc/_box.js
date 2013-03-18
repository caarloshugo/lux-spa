scnShortcodeMeta = {
  attributes: [{
    label: "Title",
    id: "title"
  }, {
    label: "Centered Title",
    id: "centered_title",
		controlType: "select-control", 
		options:     ['false', 'true']
  }, {
    label: "Inner Padding Size",
    id: "inner_padding",
		controlType: "select-control", 
		options:     ['', 'small'],
		defValue:    '', 
		defText:     'default'
  }, {
    label: "With Background",
    id: "with_bg",
		controlType: "select-control", 
		options:     ['false', 'true'],
		defValue:    '', 
		defText:     ''
  }],
  defaultContent: "Don't box me in.",
  shortcode: "box"
};