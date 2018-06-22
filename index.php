<?php
//imporatando el contenido de otro archivo
require_once "controllers/TemplateController.php";

$template = new TemplateController();
$template->ctrTemplate();
