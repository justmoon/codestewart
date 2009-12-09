<?php

function cs_show_header($title, $additional_headers = '', $header = 'header_ui.tpl.php')
{
	include('templates/'.$header);
}

function cs_show_footer($footer = 'footer_ui.tpl.php')
{
	include('templates/'.$footer);
}

function cs_res_url($item)
{
	return $qconfig['local_part'].'res/'.$item;
}
