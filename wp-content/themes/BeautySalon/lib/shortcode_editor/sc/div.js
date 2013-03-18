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
    label: "Text Align",
    id: "text_align",
		controlType: "select-control", 
		options:     ['', 'center', 'right'],
		defValue:    '', 
		defText:     'left'
  }, {
    label: "Style",
    id: "style"
  }, {
    label: "Class",
    id: "class"
  }],
  defaultContent: "<br/>...Content goes here...<br/>",
  shortcode: "div"
};