function addControls(obj)
{
	var def_name = jQuery(obj).parents('form').find('#links-table').data('defaultname');
	jQuery('#links-table tbody').append('<tr><td><input type="text" name="' + def_name + '[title][]" /></td><td><input type="text" name="' + def_name + '[url][]" /></td></tr>');
}