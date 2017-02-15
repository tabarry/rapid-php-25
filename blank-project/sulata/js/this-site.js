/* 
 * Javascript library for this site only. Framework Javascript library is in sulata.js file *
 */
//Media category show hide
function doCatType(arg) {
    if (arg.selectedIndex == 1) {
        $('#divDimensions').show();
    } else {
        $('#divDimensions').hide();
        $('#mediacat__Thumbnail_Width').val('');
        $('#mediacat__Thumbnail_Height').val('');
        $('#mediacat__Image_Width').val('');
        $('#mediacat__Image_Height').val('');
    }
}

