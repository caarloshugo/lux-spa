scnShortcodeMeta = {
  attributes: [{
    label: "Button Title",
    id: "content",
    isRequired: true
  }, {
    label: "Link",
    id: "link"
  }, {
    label: "Size",
    id: "size",
		controlType: "select-control", 
		options:     ['', 'big', 'bigger'],
		defValue:    '', 
		defText:     'default'
  }, {
    label: "Class",
    id: "class"
  }, {
    label: "Open in new tab",
    id: "open_new_tab",
		controlType: "select-control", 
		options:     ['false', 'true']
  }],
  defaultContent: "Button Title",
  shortcode: "button"
};