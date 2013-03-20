scnShortcodeMeta = {
  attributes: [{
    label: "Content",
    id: "content",
    isRequired: true
  }, {
    label: "Type",
    id: "style",
		controlType: "select-control", 
		options:     ['note', 'success', 'help', 'notice', 'warning', 'error']
  }, {
    label: "Icon",
    id: "icon",
    help: "Values: none (for no icon), or full URL to a custom icon."
  }],
  defaultContent: "Don't box me in.",
  shortcode: "info_box"
};