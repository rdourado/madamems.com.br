/*Fashion Eye CMS main Javascript file.
* version 1.0
*/

/*Main variables*/
var folderLocation = location.host == 'localhost' ? '/kokfashion/madamems/www/' : '/novo/logado/';
var serverLocation = location.host == 'localhost' ? location.protocol + '//' + location.host + folderLocation : location.protocol + '//' + location.host + folderLocation;

$(document).ready(function()
{
    $('#logout').click(function()
    {
        $.ajax({
              url: serverLocation + 'index.php?/services/cmsauth/logout',
              async: false,
              success: function(data) {
                    window.location = serverLocation + "index.php?/cms/auth/";
              }
        });
    });
});


function configureFlashOutput( ev )
{
	var editor = ev.editor,
		dataProcessor = editor.dataProcessor,
		htmlFilter = dataProcessor && dataProcessor.htmlFilter;

	// Out self closing tags the HTML4 way, like <br>.
	dataProcessor.writer.selfClosingEnd = '>';

	// Make output formatting match Flash expectations
	var dtd = CKEDITOR.dtd;
	for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) )
	{
		dataProcessor.writer.setRules( e,
			{
				indent : false,
				breakBeforeOpen : false,
				breakAfterOpen : false,
				breakBeforeClose : false,
				breakAfterClose : false
			});
	}
	dataProcessor.writer.setRules( 'br',
		{
			indent : false,
			breakBeforeOpen : false,
			breakAfterOpen : false,
			breakBeforeClose : false,
			breakAfterClose : false
		});

	// Output properties as attributes, not styles.
	htmlFilter.addRules(
		{
			elements :
			{
				$ : function( element )
				{
					var style, match, width, height, align;

					// Output dimensions of images as width and height
					if ( element.name == 'img' )
					{
						style = element.attributes.style;

						if ( style )
						{
							// Get the width from the style.
							match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec( style );
							width = match && match[1];

							// Get the height from the style.
							match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec( style );
							height = match && match[1];

							if ( width )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)width\s*:\s*(\d+)px;?/i , '' );
								element.attributes.width = width;
							}

							if ( height )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)height\s*:\s*(\d+)px;?/i , '' );
								element.attributes.height = height;
							}
						}
					}

					// Output alignment of paragraphs using align
					if ( element.name == 'p' )
					{
						style = element.attributes.style;

						if ( style )
						{
							// Get the align from the style.
							match = /(?:^|\s)text-align\s*:\s*(\w*);?/i.exec( style );
							align = match && match[1];

							if ( align )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)text-align\s*:\s*(\w*);?/i , '' );
								element.attributes.align = align;
							}
						}
					}

					if ( element.attributes.style === '' )
						delete element.attributes.style;

					return element;
                        }
                }

        } );
}