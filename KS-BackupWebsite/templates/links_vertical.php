<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
      <div id="menuwrapper">
          <div id="links">
            <?php $layoutObj->showLinks('links',$current_page); ?>
          </div>
          <div id="contentright">
            <?php $layoutObj->showContent($current_page,$current_module); ?>
          </div>
      </div>