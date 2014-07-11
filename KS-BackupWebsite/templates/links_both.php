<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
      <div id="menu">
        <?php $layoutObj->showLinks('links',$current_page,'horizontal'); ?>
      </div>
      <div id="menuwrapper">
          <div id="menuleft">
          	<?php $layoutObj->showLinks('links',$current_page,'vertical'); ?>
	      </div>
          <div id="contentright">
            <?php $layoutObj->showContent($current_page,$current_module); ?>
          </div>
      </div>