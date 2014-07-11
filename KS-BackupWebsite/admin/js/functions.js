/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
function open_win(url_add,width,height)
   {
   window.open(url_add,'welcome','width='+width+',height='+height+',menubar=no,status=yes,location=no,toolbar=no,scrollbars=yes');
   }

	function ShowHelp(img, title, desc)
	{
		img = document.getElementById(img);
		div = document.createElement('div');
		div.id = 'help';

		div.style.display = 'inline';
		div.style.position = 'absolute';
		div.style.width = '350';

		div.style.backgroundColor = '#FEFCD5';
		div.style.border = 'solid 1px #E7E3BE';
		div.style.padding = '10px';
		div.innerHTML = '<span class=helpTip><strong>' + title + '<\/strong><\/span><br /><img src=/images/1x1.gif width=1 height=5><br /><div style="padding-left:10; padding-right:5; width:350px;" class=helpTip>' + desc + '<\/div>';

		//img.parentNode.appendChild(div);
		var parent = img.parentNode;
		if(img.nextSibling)
			parent.insertBefore(div, img.nextSibling);
		else
			parent.appendChild(div)
	}

	function HideHelp(img)
	{
		img = document.getElementById(img);
		div = document.getElementById('help');
		if (div) {
			img.parentNode.removeChild(div);
		}
	}
