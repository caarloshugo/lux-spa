/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

(function($){

	$(document).ready(function() {

		var config = $('body').data('config') || {};
		
		// Accordion menu
		$('.menu-sidebar').accordionMenu({ mode:'slide' });

		// Dropdown menu
		$('#menu').dropdownMenu({ mode: 'slide', dropdownSelector: 'div.dropdown'});

		// Smoothscroller
		$('a[href="#page"]').smoothScroller({ duration: 500 });

		// Social buttons
		$('article[data-permalink]').socialButtons(config);
		
		// tipsy 
		$('.tooltip, .social-bookmark li a').tipsy({gravity: 'n', fade: true});
		
		
		 // Tabs
		  // ------------------------------------------------------------
			jQuery('.tabgroup').tabs();
		  
  
  
		  // Toggler
		  // ------------------------------------------------------------
		  
		  jQuery(".togglergroup").toggler();
		  
  		// Contact Form
		  // ------------------------------------------------------------
		  
		  if($.isFunction($.fn.validate)) {
			$("#contactform").validate({
			  errorClass: "invalid",
			  errorPlacement: function(error, element) { error.hide(); }
			});
		  }
		  
		  if($.isFunction($.fn.ajaxForm)) {
			function init_ajax_form(form) {
			  $(form).ajaxForm({
				target: "form .message",
				beforeSubmit: before_submit,
				success: success
			  });
			  function before_submit() {
				$(form).find(".spinner").fadeIn();
				$(form).find(".message").animate({ opacity: 0 }).slideUp();
			  }
			  function success() {
				$(form).find(".spinner").fadeOut();
				$(form).find(".message").slideDown().animate({ opacity: 1 });
				return false;
			  }
			}
			
			init_ajax_form("#contactform");
		  }
		   
  		// Remove Empty Paragraph Tags
  		// ------------------------------------------------------------
		
		 $('p').filter(function() { return $.trim($(this).html()) === ''; }).remove();




	});

	$.onMediaQuery('(min-width: 960px)', {
		init: function() {
			if (!this.supported) this.matches = true;
		},
		valid: function() {
			$.matchWidth('grid-block', '.grid-block', '.grid-h').match();
			$.matchHeight('main', '#maininner, #sidebar-a, #sidebar-b').match();
			$.matchHeight('top-a', '#top-a .grid-h', '.deepest').match();
			$.matchHeight('top-b', '#top-b .grid-h', '.deepest').match();
			$.matchHeight('bottom-a', '#bottom-a .grid-h', '.deepest').match();
			$.matchHeight('bottom-b', '#bottom-b .grid-h', '.deepest').match();
			$.matchHeight('innertop', '#innertop .grid-h', '.deepest').match();
			$.matchHeight('innerbottom', '#innerbottom .grid-h', '.deepest').match();
		},
		invalid: function() {
			$.matchWidth('grid-block').remove();
			$.matchHeight('main').remove();
			$.matchHeight('top-a').remove();
			$.matchHeight('top-b').remove();
			$.matchHeight('bottom-a').remove();
			$.matchHeight('bottom-b').remove();
			$.matchHeight('innertop').remove();
			$.matchHeight('innerbottom').remove();
		}
	});

	var pairs = [];

	$.onMediaQuery('(min-width: 480px) and (max-width: 959px)', {
		valid: function() {
			$.matchHeight('sidebars', '.sidebars-2 #sidebar-a, .sidebars-2 #sidebar-b').match();
			pairs = [];
			$.each(['.sidebars-1 #sidebar-a > .grid-box', '.sidebars-1 #sidebar-b > .grid-box', '#top-a .grid-h', '#top-b .grid-h', '#bottom-a .grid-h', '#bottom-b .grid-h', '#innertop .grid-h', '#innerbottom .grid-h'], function(i, selector) {
				for (var i = 0, elms = $(selector), len = parseInt(elms.length / 2); i < len; i++) {
					var id = 'pair-' + pairs.length;
					$.matchHeight(id, [elms.get(i * 2), elms.get(i * 2 + 1)], '.deepest').match();
					pairs.push(id);
				}
			});
		},
		invalid: function() {
			$.matchHeight('sidebars').remove();
			$.each(pairs, function() { $.matchHeight(this).remove(); });
		}
	});

	$.onMediaQuery('(max-width: 767px)', {
		valid: function() {
			var header = $('#header-responsive');
			if (!header.length) {
				header = $('<div id="header-responsive"/>').prependTo('#header');
				$('#logo').clone().removeAttr('id').addClass('logo').appendTo(header);
				//$('.searchbox').first().clone().removeAttr('id').appendTo(header);
				$('#menu').responsiveMenu().next().addClass('menu-responsive').appendTo(header);
			}
		}
	
	});





  
 
  
 })(jQuery);
 


 (function($){	
  
  // Tabs
  // ------------------------------------------------------------
   jQuery.fn.tabs= function(options) 
	{
		var defaults = {
			tabs:        '.tab',
			tab_content: '.tab-content'
		};
		
		var options = jQuery.extend(defaults, options);
	
		return this.each(function()
		{
		  var tabgroup    = jQuery(this);
			var tabs        = tabgroup.find(options.tabs);
			var tab_content = tabgroup.find(options.tab_content);
			
			// Activate first Tab
			tabs.first().addClass('active');
			tab_content.first().addClass('active');
			
			// Number Tabs and Tab Content
			tabs.each(function(i)        { jQuery(this).addClass('nr_'+(i+1)) });
			tab_content.each(function(i) { jQuery(this).addClass('nr_'+(i+1)) });
			
			tabgroup.prepend('<div class="tab-content-wrapper" />');
			var tab_content_wrapper = jQuery('.tab-content-wrapper', tabgroup);
			
			tab_content.prependTo(tab_content_wrapper);
			
			tabgroup.prepend('<div class="tabs-wrapper" />');
			var tabs_wrapper = jQuery('.tabs-wrapper', tabgroup);
			
			tabs.prependTo(tabs_wrapper).each(function() {
				var cur_tab = jQuery(this);
			
				cur_tab.bind('click', function() {
				  var cur_tab_number  = (jQuery(this).attr('class').split(' ')[1]);
				  var cur_tab_content = tabgroup.find('.'+options.tab_content+'.'+cur_tab_number);
				  
				  if(!cur_tab.is('.active')) {
						jQuery('.active', tabgroup).removeClass('active');
						cur_tab.addClass('active');
						cur_tab_content.addClass('active');
						
						// Ajust Height if Content Height is less than Tabs Height
						var tabs_wrapper_height    = tabs_wrapper.height();
						var cur_tab_content_height = cur_tab_content.height();
						
						if(cur_tab_content_height < tabs_wrapper_height) {
						  cur_tab_content.css('height', tabs_wrapper_height);
						}
					}
					
					return false;
				});
			});
		
		});
	};
  
  
  
  // Toggler
  // ------------------------------------------------------------
  
  jQuery.fn.toggler = function(options) {
  
    var defaults = {
      toggler:         '.toggler', 
      toggler_content: '.toggler-content'
    };
    
    var options = jQuery.extend(defaults, options);
    
    return this.each(function() {
    
  	  var tabgroup        = jQuery(this);
      var toggler         = tabgroup.children().find(options.toggler);
      var toggler_content = tabgroup.children().find(options.toggler_content);
      
      toggler.each(function() {
        var cur_toggler = jQuery(this);
        var cur_toggler_content = cur_toggler.next(toggler_content);
        
        if(cur_toggler_content.is(".active")) {
          cur_toggler_content.show();
        }
        else {
          cur_toggler_content.hide();
        }
        
        cur_toggler.bind('click', function() {
          if(cur_toggler.is('.active')) {
            cur_toggler.removeClass('active');
            cur_toggler_content.removeClass('active').slideUp();
          }
          else {
            if(tabgroup.is('.close-all')) {
              toggler.removeClass('active');
              toggler_content.removeClass('active').slideUp();
            }
            cur_toggler.addClass("active");
            cur_toggler_content.addClass("active").slideDown();
          }
        });
        
      });
      
    });
    
  };
  
  
})(jQuery);
 
 
  
  