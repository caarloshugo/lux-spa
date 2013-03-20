scnShortcodeMeta = {
  attributes: [{
    label: "Content",
    id: "content",
    isRequired: true
  }, {
    label: "Text Size",
    id: "text_size",
		controlType: "select-control", 
		options:     ['', 'small', 'big', 'bigger', 'huge'],
		defValue:    '', 
		defText:     'default'
  }, {
    label: "Style",
    id: "style"
  }, {
    label: "Class",
    id: "class"
  }],
  defaultContent: "Content goes here",
  shortcode: "span"
};