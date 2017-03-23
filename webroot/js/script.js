// Cache ou dévoile des éléments
function hide(id) {
	var element = document.getElementById(id);
	if (element.style.display == 'none' || element.style.display=='null') 
	{
		element.style.display = 'block';
	} 
	else 
	{
	  element.style.display = 'none';
	}
}