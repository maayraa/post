<?php
//imporatando el contenido de otro archivo
require_once "controllers/template.controller.php";

$template = new TemplateController();
$template->ctrTemplate();
