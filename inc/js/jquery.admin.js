/*
 * jquery.admin.js
 * 
 * Custom scripts for XY WordPress Theme by EugeneO.
 * 
 * Copyright 2013 EugeneO
 * http://eugeneo.com
 * http://themeforest.net/user/EugeneO/portfolio
 *
 */

// Show and hide necessary options.
function refreshOptions(optionsArray) {
	
	jQuery.each(optionsArray, function (index, value) {			
		
		if (value !== null && typeof value === "object") {
			
			var options = value;
			
			for (var key in options) {
			
				if (options.hasOwnProperty(key)) {
				
					if (key == 'selector') {
						var selector = options[key];
					}
					
					if (key == 'visible') {
						
						if (options[key] === true) {
							if (jQuery(selector).is(":visible") === false) {
								jQuery(selector).fadeIn();
							}
						} else {							
							jQuery(selector).fadeOut();					
						}
						
					}
				
				}
			
			}
			
		}
		
	});

};

	
jQuery(document).ready(function ($) {

	"use strict";
	
	
/*----------------------------------------------------------------------------------
Template Options
----------------------------------------------------------------------------------*/

	// Only define options variables if we are on the page edit screen.
	if ($('#post_type').val() === 'page') {

		// Template option
		var templateTrigger	= $('#page_template');
		
		// Array of options to be shown / hidden
		var templateOptions	= {
			
			// Archive Options box
			archiveOptions : {
				selector	: "#archive-options-box",
				visible		: false
			},

			// Contact options box
			contactOptions : {
				selector	: "#contact-options-box",
				visible		: false
			},
			
			// Fullscreen options box
			fullscreenOptions : {
				selector	: "#fullscreen-options-box",
				visible		: false
			},
			
			// Portfolio options box
			portfolioOptions : {
				selector	: "#portfolio-options-box",
				visible		: false
			},
			
			// Header options box
			pageHeaderOptions : {
				selector	: "#header-options-box",
				visible		: false
			},
			
			// Header Style options box
			headerStyleOptions : {
				selector	: "tr.cmb_id_soapbox_header_style",
				visible		: false
			},
			
			// Show Title In Header options box
			ShowTitleInHeaderOptions : {
				selector	: "tr.cmb_id_soapbox_show_title_in_header",
				visible		: false
			}
			
		}
		

		// Update options on page load
		if (templateTrigger.val() === 'page-archive.php') {
			
			templateOptions.archiveOptions.visible		= true;
			templateOptions.contactOptions.visible		= false;
			templateOptions.fullscreenOptions.visible	= false;
			templateOptions.portfolioOptions.visible	= false;
			templateOptions.pageHeaderOptions.visible	= false;
			
			templateOptions.headerStyleOptions.visible	= true;
			templateOptions.ShowTitleInHeaderOptions.visible = true;
			
		} else if (templateTrigger.val() === 'page-contact.php') {
			
			templateOptions.archiveOptions.visible		= false;
			templateOptions.contactOptions.visible		= true;
			templateOptions.fullscreenOptions.visible	= false;
			templateOptions.portfolioOptions.visible	= false;
			templateOptions.pageHeaderOptions.visible	= false;
			
			templateOptions.headerStyleOptions.visible	= false;
			templateOptions.ShowTitleInHeaderOptions.visible = false;
			
		} else if (templateTrigger.val() === 'page-fullscreen.php') {
			
			templateOptions.archiveOptions.visible		= false;
			templateOptions.contactOptions.visible		= false;
			templateOptions.fullscreenOptions.visible	= true;
			templateOptions.portfolioOptions.visible	= false;
			templateOptions.pageHeaderOptions.visible	= true;
			
			templateOptions.headerStyleOptions.visible	= true;
			templateOptions.ShowTitleInHeaderOptions.visible = true;
			
		} else if (templateTrigger.val() === 'page-portfolio.php') {
			
			templateOptions.archiveOptions.visible		= false;
			templateOptions.contactOptions.visible		= false;
			templateOptions.fullscreenOptions.visible	= false;
			templateOptions.portfolioOptions.visible	= true;
			templateOptions.pageHeaderOptions.visible	= false;
			
			templateOptions.headerStyleOptions.visible	= true;
			templateOptions.ShowTitleInHeaderOptions.visible = true;
			
		} else {
			
			templateOptions.archiveOptions.visible		= false;
			templateOptions.contactOptions.visible	 	= false;
			templateOptions.fullscreenOptions.visible	= false;
			templateOptions.portfolioOptions.visible 	= false;
			templateOptions.pageHeaderOptions.visible	= true;
			
			templateOptions.headerStyleOptions.visible	= true;
			templateOptions.ShowTitleInHeaderOptions.visible = true;
			
		}
		
		
		// Update visible options
		refreshOptions( templateOptions );
		
		
		// Update options on template option change
		templateTrigger.change( function () {

			if ($(this).val() === 'page-archive.php') {
				
				templateOptions.archiveOptions.visible		= true;
				templateOptions.contactOptions.visible		= false;
				templateOptions.fullscreenOptions.visible	= false;
				templateOptions.portfolioOptions.visible 	= false;
				templateOptions.pageHeaderOptions.visible	= false;
				
				templateOptions.headerStyleOptions.visible	= true;
				templateOptions.ShowTitleInHeaderOptions.visible = true;
				
			} else if ($(this).val() === 'page-contact.php') {				
				
				templateOptions.archiveOptions.visible		= false;
				templateOptions.contactOptions.visible		= true;
				templateOptions.fullscreenOptions.visible	= false;
				templateOptions.portfolioOptions.visible 	= false;
				templateOptions.pageHeaderOptions.visible	= false;
				
				templateOptions.headerStyleOptions.visible	= true;
				templateOptions.ShowTitleInHeaderOptions.visible = true;
				
			} else if ($(this).val() === 'page-fullscreen.php') {				
				
				templateOptions.archiveOptions.visible		= false;
				templateOptions.contactOptions.visible		= false;
				templateOptions.fullscreenOptions.visible	= true;
				templateOptions.portfolioOptions.visible 	= false;
				templateOptions.pageHeaderOptions.visible	= true;
				
				templateOptions.headerStyleOptions.visible	= false;
				templateOptions.ShowTitleInHeaderOptions.visible = false;
			
			} else if ($(this).val() === 'page-portfolio.php') {				
				
				templateOptions.archiveOptions.visible		= false;
				templateOptions.contactOptions.visible		= false;
				templateOptions.fullscreenOptions.visible	= false;
				templateOptions.portfolioOptions.visible 	= true;
				templateOptions.pageHeaderOptions.visible	= false;
				
				templateOptions.headerStyleOptions.visible	= true;
				templateOptions.ShowTitleInHeaderOptions.visible = true;
				
			} else {
				
				templateOptions.archiveOptions.visible		= false;
				templateOptions.contactOptions.visible		= false;
				templateOptions.fullscreenOptions.visible	= false;
				templateOptions.portfolioOptions.visible 	= false;				
				templateOptions.pageHeaderOptions.visible	= true;
				
				templateOptions.headerStyleOptions.visible	= true;
				templateOptions.ShowTitleInHeaderOptions.visible = true;
				
			}
			
			// Update visible options
			refreshOptions( templateOptions );
		
		});		

	}
	

/*----------------------------------------------------------------------------------
 Header
----------------------------------------------------------------------------------*/
	
	// Only define options variables if we are on the page edit screen.
	if ($('#post_type').val() === 'page') {
		
		// ----------------- Header Type --------------------- //
		
		// page header option
		var pageHeader = $('#soapbox_page_header');
		
		// Array of options to be shown / hidden
		var headerOptions = {
			
			// Header Style
			headerStyle : {
				selector	: "tr.cmb_id_soapbox_header_style",
				visible		: false
			},
			
			// Show title in header
			showTitleInHeader: {
				selector	: "tr.cmb_id_soapbox_show_title_in_header",
				visible		: false
			},			
			
			// Text colour
			textColor : {
				selector	: "tr.cmb_id_soapbox_header_text_colour",
				visible		: false
			},
			
			// Background video WebM
			backgroundVideoWebm : {
				selector	: "tr.cmb_id_soapbox_header_video_webm",
				visible		: false
			},
			
			// Background video MP4
			backgroundVideoMP4 : {
				selector	: "tr.cmb_id_soapbox_header_video_mp4",
				visible		: false
			}		
			
		};
		
		// Update options on page load
		if(pageHeader.val() == 'image') {			
			
			headerOptions.textColor.visible				= true;
			headerOptions.backgroundVideoMP4.visible	= false;
			headerOptions.backgroundVideoWebm.visible	= false;
			
			if ($(templateTrigger).val() === 'page-fullscreen.php') {				
				headerOptions.headerStyle.visible			= false;
				headerOptions.showTitleInHeader.visible		= false;				
			} else {				
				headerOptions.headerStyle.visible			= true;
				headerOptions.showTitleInHeader.visible		= true;				
			}
			
		} else if(pageHeader.val() == 'video') {
			
			headerOptions.textColor.visible				= true;
			headerOptions.backgroundVideoMP4.visible	= true;
			headerOptions.backgroundVideoWebm.visible	= true;
			
			if ($(templateTrigger).val() === 'page-fullscreen.php') {				
				headerOptions.headerStyle.visible			= false;
				headerOptions.showTitleInHeader.visible		= false;				
			} else {				
				headerOptions.headerStyle.visible			= true;
				headerOptions.showTitleInHeader.visible		= true;				
			}
			
		} else {
			
			headerOptions.textColor.visible				= false;
			headerOptions.backgroundVideoMP4.visible	= false;
			headerOptions.backgroundVideoWebm.visible	= false;
			headerOptions.headerStyle.visible			= false;
			headerOptions.showTitleInHeader.visible		= false;			
			
		}
	
		
		// Update visible options
		refreshOptions(headerOptions);
		
		
		// Update options on page header option change
		pageHeader.change( function() {
			
			if(pageHeader.val() == 'image') {
				
				headerOptions.textColor.visible				= true;
				headerOptions.backgroundVideoMP4.visible	= false;
				headerOptions.backgroundVideoWebm.visible	= false;
				
				if ($(templateTrigger).val() === 'page-fullscreen.php') {				
					headerOptions.headerStyle.visible			= false;
					headerOptions.showTitleInHeader.visible		= false;				
				} else {				
					headerOptions.headerStyle.visible			= true;
					headerOptions.showTitleInHeader.visible		= true;				
				}
				
			} else if(pageHeader.val() == 'video') {
				
				headerOptions.textColor.visible				= true;
				headerOptions.backgroundVideoMP4.visible	= true;
				headerOptions.backgroundVideoWebm.visible	= true;
				
				if ($(templateTrigger).val() === 'page-fullscreen.php') {				
					headerOptions.headerStyle.visible			= false;
					headerOptions.showTitleInHeader.visible		= false;				
				} else {				
					headerOptions.headerStyle.visible			= true;
					headerOptions.showTitleInHeader.visible		= true;				
				}
					
			} else {
				
				headerOptions.textColor.visible				= false;
				headerOptions.backgroundVideoMP4.visible	= false;
				headerOptions.backgroundVideoWebm.visible	= false;
				headerOptions.headerStyle.visible			= false;
				headerOptions.showTitleInHeader.visible		= false;
			
			}
			
			// Update visible options
			refreshOptions(headerOptions);
		
		});
		
	}

	
/*----------------------------------------------------------------------------------
 Portfolio Options
----------------------------------------------------------------------------------*/

	/* Check we are on a portfolio item edit screen. */
	if ($('#post_type').val() === 'portfolio') {
		
		// Layout option used to determine which options to show / hide
		var portfolioTypeTrigger = $('[name="soapbox_portfolio_item_layout"]');
		
		// Create portfolio options object and set defaults
		var portfolioOptions = {
		
			audioLayoutHelp : {
				selector	: "tr.cmb_id_soapbox_layout_audio_help",
				visible 	: false
			},
			standardHalfLayoutHelp : {
				selector	: "tr.cmb_id_soapbox_layout_standard_half_help",
				visible 	: false
			},
			galleryLayoutHelp : {
				selector	: "tr.cmb_id_soapbox_layout_gallery_help",
				visible 	: false
			},
			excludeFeatureImagOption : {
				selector	: "tr.cmb_id_soapbox_exclude_feature_image",
				visible 	: false
			},
			sliderLayoutHelp : {
				selector	: "tr.cmb_id_soapbox_layout_slider_help",
				visible 	: false
			},
			sliderFX : {
				selector	: "tr.cmb_id_soapbox_slider_fx",
				visible 	: false
			},
			sliderSpeed : {
				selector	: "tr.cmb_id_soapbox_slider_speed",
				visible 	: false
			},
			sliderTimeout : {
				selector	: "tr.cmb_id_soapbox_slider_timeout",
				visible 	: false
			},
			videoLayoutHelp : {
				selector	: "tr.cmb_id_soapbox_layout_video_help",
				visible 	: false
			},
			mediaBackgroundImage : {
				selector	: "tr.cmb_id_soapbox_media_background_image",
				visible 	: false
			}
		
		};
	
		// On page load set relevant options to visible
		if(portfolioTypeTrigger.val() == 'half') {
			
			portfolioOptions.audioLayoutHelp.visible				= false;
			
			portfolioOptions.standardHalfLayoutHelp.visible			= true;
			
			portfolioOptions.galleryLayoutHelp.visible				= false;
			portfolioOptions.excludeFeatureImagOption.visible		= true;
			
			portfolioOptions.sliderLayoutHelp.visible				= false;
			portfolioOptions.sliderFX.visible						= false;
			portfolioOptions.sliderSpeed.visible					= false;
			portfolioOptions.sliderTimeout.visible					= false;
			
			portfolioOptions.videoLayoutHelp.visible				= false;
			portfolioOptions.mediaBackgroundImage.visible			= false;
			
		} else if(portfolioTypeTrigger.val() == 'audio') {
		
			portfolioOptions.audioLayoutHelp.visible				= true;
			
			portfolioOptions.standardHalfLayoutHelp.visible			= false;
			
			portfolioOptions.galleryLayoutHelp.visible				= false;
			portfolioOptions.excludeFeatureImagOption.visible		= true;
			
			portfolioOptions.sliderLayoutHelp.visible				= false;
			portfolioOptions.sliderFX.visible						= false;
			portfolioOptions.sliderSpeed.visible					= false;
			portfolioOptions.sliderTimeout.visible					= false;
			
			portfolioOptions.videoLayoutHelp.visible				= false;
			portfolioOptions.mediaBackgroundImage.visible			= true;
			
		} else if(portfolioTypeTrigger.val() == 'gallery') {
			
			portfolioOptions.audioLayoutHelp.visible				= false;
			
			portfolioOptions.standardHalfLayoutHelp.visible			= false;
			
			portfolioOptions.galleryLayoutHelp.visible				= true;
			portfolioOptions.excludeFeatureImagOption.visible		= true;
			
			portfolioOptions.sliderLayoutHelp.visible				= false;
			portfolioOptions.sliderFX.visible						= false;
			portfolioOptions.sliderSpeed.visible					= false;
			portfolioOptions.sliderTimeout.visible					= false;
			
			portfolioOptions.videoLayoutHelp.visible				= false;
			portfolioOptions.mediaBackgroundImage.visible			= false;
			
		} else if(portfolioTypeTrigger.val() == 'slider') {
			
			portfolioOptions.audioLayoutHelp.visible				= false;
			
			portfolioOptions.standardHalfLayoutHelp.visible			= false;
			
			portfolioOptions.galleryLayoutHelp.visible				= false;
			portfolioOptions.excludeFeatureImagOption.visible		= false;
			
			portfolioOptions.sliderLayoutHelp.visible				= true;
			portfolioOptions.sliderFX.visible						= true;
			portfolioOptions.sliderSpeed.visible					= true;
			portfolioOptions.sliderTimeout.visible					= true;
			
			portfolioOptions.videoLayoutHelp.visible				= false;
			portfolioOptions.mediaBackgroundImage.visible			= false;
			
 		} else if(portfolioTypeTrigger.val() == 'video') {
			
			portfolioOptions.audioLayoutHelp.visible				= false;
			
			portfolioOptions.standardHalfLayoutHelp.visible			= false;
			
			portfolioOptions.galleryLayoutHelp.visible				= false;
			portfolioOptions.excludeFeatureImagOption.visible		= false;
			
			portfolioOptions.sliderLayoutHelp.visible				= false;
			portfolioOptions.sliderFX.visible						= false;
			portfolioOptions.sliderSpeed.visible					= false;
			portfolioOptions.sliderTimeout.visible					= false;
			
			portfolioOptions.videoLayoutHelp.visible				= true;
			portfolioOptions.mediaBackgroundImage.visible			= true;
			
		} else {
			
			portfolioOptions.audioLayoutHelp.visible				= false;
			
			portfolioOptions.standardHalfLayoutHelp.visible			= false;
			
			portfolioOptions.galleryLayoutHelp.visible				= false;
			portfolioOptions.excludeFeatureImagOption.visible		= false;
			
			portfolioOptions.sliderLayoutHelp.visible				= false;
			portfolioOptions.sliderFX.visible						= false;
			portfolioOptions.sliderSpeed.visible					= false;
			portfolioOptions.sliderTimeout.visible					= false;
			
			portfolioOptions.videoLayoutHelp.visible				= false;
			portfolioOptions.mediaBackgroundImage.visible			= false;
			
		}
		
		// Update visible options
		refreshOptions( portfolioOptions );
		
		
		// Update visible options when the layout option value changes.
		portfolioTypeTrigger.change( function() {
			
			if($(this).val() == 'half') {
				
				portfolioOptions.audioLayoutHelp.visible				= false;
				
				portfolioOptions.standardHalfLayoutHelp.visible			= true;
				
				portfolioOptions.galleryLayoutHelp.visible				= false;
				portfolioOptions.excludeFeatureImagOption.visible		= true;
				
				portfolioOptions.sliderLayoutHelp.visible				= false;
				portfolioOptions.sliderFX.visible						= false;
				portfolioOptions.sliderSpeed.visible					= false;
				portfolioOptions.sliderTimeout.visible					= false;
				
				portfolioOptions.videoLayoutHelp.visible				= false;
				portfolioOptions.mediaBackgroundImage.visible			= false;
				
			} else if($(this).val() == 'audio') {
				
				portfolioOptions.audioLayoutHelp.visible				= true;
				
				portfolioOptions.standardHalfLayoutHelp.visible			= false;
				
				portfolioOptions.galleryLayoutHelp.visible				= false;
				portfolioOptions.excludeFeatureImagOption.visible		= false;
				
				portfolioOptions.sliderLayoutHelp.visible				= false;
				portfolioOptions.sliderFX.visible						= false;
				portfolioOptions.sliderSpeed.visible					= false;
				portfolioOptions.sliderTimeout.visible					= false;
				
				portfolioOptions.videoLayoutHelp.visible				= false;
				portfolioOptions.mediaBackgroundImage.visible			= true;
				
			} else if($(this).val() == 'gallery') {
				
				portfolioOptions.audioLayoutHelp.visible				= false;
				
				portfolioOptions.standardHalfLayoutHelp.visible			= false;
				
				portfolioOptions.galleryLayoutHelp.visible				= true;
				portfolioOptions.excludeFeatureImagOption.visible		= true;
				
				portfolioOptions.sliderLayoutHelp.visible				= false;
				portfolioOptions.sliderFX.visible						= false;
				portfolioOptions.sliderSpeed.visible					= false;
				portfolioOptions.sliderTimeout.visible					= false;
				
				portfolioOptions.videoLayoutHelp.visible				= false;
				portfolioOptions.mediaBackgroundImage.visible			= false;
				
			} else if($(this).val() == 'slider') {
				
				portfolioOptions.audioLayoutHelp.visible				= false;
				
				portfolioOptions.standardHalfLayoutHelp.visible			= false;
				
				portfolioOptions.galleryLayoutHelp.visible				= false;
				portfolioOptions.excludeFeatureImagOption.visible		= false;
				
				portfolioOptions.sliderLayoutHelp.visible				= true;
				portfolioOptions.sliderFX.visible						= true;
				portfolioOptions.sliderSpeed.visible					= true;
				portfolioOptions.sliderTimeout.visible					= true;
				
				portfolioOptions.videoLayoutHelp.visible				= false;
				portfolioOptions.mediaBackgroundImage.visible			= false;
				
			} else if($(this).val() == 'video') {
				
				portfolioOptions.audioLayoutHelp.visible				= false;
				
				portfolioOptions.standardHalfLayoutHelp.visible			= false;
				
				portfolioOptions.galleryLayoutHelp.visible				= false;
				portfolioOptions.excludeFeatureImagOption.visible		= false;
				
				portfolioOptions.sliderLayoutHelp.visible				= false;
				portfolioOptions.sliderFX.visible						= false;
				portfolioOptions.sliderSpeed.visible					= false;
				portfolioOptions.sliderTimeout.visible					= false;
				
				portfolioOptions.videoLayoutHelp.visible				= true;
				portfolioOptions.mediaBackgroundImage.visible			= true;
				
			} else {
				
				portfolioOptions.audioLayoutHelp.visible				= false;
				
				portfolioOptions.standardHalfLayoutHelp.visible			= false;
				
				portfolioOptions.galleryLayoutHelp.visible				= false;
				portfolioOptions.excludeFeatureImagOption.visible		= false;
				
				portfolioOptions.sliderLayoutHelp.visible				= false;
				portfolioOptions.sliderFX.visible						= false;
				portfolioOptions.sliderSpeed.visible					= false;
				portfolioOptions.sliderTimeout.visible					= false;
				
				portfolioOptions.videoLayoutHelp.visible				= false;
				portfolioOptions.mediaBackgroundImage.visible			= false;
				
			}
			
			refreshOptions( portfolioOptions );
			
		});
		
	}
	
});