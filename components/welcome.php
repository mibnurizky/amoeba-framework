<?php
DATABASE->select("SELECT * FROM _amoeba_session");
COMPONENT->includeView('welcome');

?>