(function($) {
	var themecountry = {
		initAll: function() {
			this.selectExportData();
			this.showHideShowMetaInfo();
			this.saveTypoGrapography();
			this.preventNumberofSlide();
		},
		preventNumberofSlide: function() {
			$('#section_option_home_slider #number-of-post').blur(function() {
				if( $(this).val() == '0' ) {
					alert('Not allow 0 value!');
					$(this).val('5');
				}
			});
		},
		showHideShowMetaInfo: function() {
			themecountry.customizeShowHideShowMetaInfo();

			$('#setting_enable-post-meta-info .radio').click(function() {

				themecountry.customizeShowHideShowMetaInfo();
			});
		},
		customizeShowHideShowMetaInfo: function() {
			$('#setting_enable-post-meta-info').find('input[type="radio"]').each(function(){
				if ( $(this).is(':checked') && $(this).attr('id') == 'enable-post-meta-info-0' ) {

					$('#setting_post-meta-info').show();
				} else if ( $(this).is(':checked') && $(this).attr('id') == 'enable-post-meta-info-1' ) {

					$('#setting_post-meta-info').hide();
				}
			});
		},
		selectExportData: function() {
			$("#tab_option_import_export").on('click', function(){
				$('.tc-export-data').focus().select();
			});

			$('#export_data').on('click', function(){
				$(this).select()
			});
		},
		saveTypoGrapography: function() {
			
			$("#option-tree-sub-header > button, #option-tree-settings-api > .option-tree-ui-buttons > button").on('click', function(e) {
				e.preventDefault();

				var collectionData = new Array();
			i=0;
      
			$("#google_typography").find(".collections .collection").each(function() {
        
				/*if(showLoading != false) {
					collection.find(".save_collection").addClass("saving").html("Saving...");
				}*/

				previewText  = $(this).find(".preview_text").val();
				previewColor = $(this).find(".preview_color li.current a").attr("class");
				fontFamily   = $(this).find(".font_family").val();
				fontVariant  = $(this).find(".font_variant").val();
				fontSize     = $(this).find(".font_size").val();
				fontColor    = $(this).find(".font_color").val();
				cssSelectors = $(this).find(".css_selectors").val();
				isDefault    = $(this).attr("data-default");
        
				collectionData[i] = {
					uid           : i+1,
					preview_text  : previewText,
					preview_color : previewColor,
					font_family   : fontFamily,
					font_variant  : fontVariant, 
					font_size     : fontSize,
					font_color    : fontColor,
					css_selectors : cssSelectors,
					default       : isDefault
				};
  
				i++;
        
			});

			$.ajax({
	        	url: ajaxurl,
		        type:'POST',
		        data: {  'action' : 'save_user_fonts',  'collections' : collectionData },
		        beforeSend : function() {
		        	$('.option-tree-ui-buttons .spinner, #option-tree-sub-header .spinner').show();
		        }
		        
		    }).done(function(html) {
		    	setTimeout(function() {
		    		$('.option-tree-ui-buttons .spinner, #option-tree-sub-header .spinner').hide();
		    	}, 4000);
		    	$("#option-tree-settings-api").submit();
		    });
			//saveCollections(collection, container);
					
			});
		}
	}

	$(document).ready(function() {
        themecountry.initAll();
    });
})(jQuery);