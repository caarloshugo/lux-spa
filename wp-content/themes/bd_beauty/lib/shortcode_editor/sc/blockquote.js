scnShortcodeMeta = {
  attributes: [{
    label: "Blockquote",
    id:    "content",
    isRequired: true
  }, {
    label: "Source",
    id:    "source"
  }, {
    label: "Align",
    id:    "align",
    help:  "",
		controlType: "select-control", 
		options:     ['', 'left', 'right'],
		defValue:    '', 
		defText:     'none (Default)'
  }],
  defaultContent: "Climbing is the only cure for gravity.",
  shortcode: "blockquote"
};