/***************************************************************************
- File: table.js
- Version: 12.12.21
***************************************************************************/

var $me_table={tbl_html:!1,tbl_border:!1,td_border:!1,construct:function(){this.tbl_preview=document.getElementById("tbl_preview");this.tbl_rows=parseInt(document.getElementById("tbl_rows").value);this.tbl_cols=parseInt(document.getElementById("tbl_cols").value);this.tbl_padding=parseInt(document.getElementById("tbl_padding").value);this.tbl_spacing=parseInt(document.getElementById("tbl_spacing").value);this.tbl_width=parseInt(document.getElementById("tbl_width").value);this.tbl_width_in_per=document.getElementById("tbl_width_in_per");
this.tbl_width_in_pix=document.getElementById("tbl_width_in_pix");this.tbl_border_style=document.getElementById("tbl_border_style").value;this.tbl_border_style_solid=document.getElementById("tbl_border_style_solid").value;this.tbl_border_style_double=document.getElementById("tbl_border_style_double").value;this.tbl_border_style_dotted=document.getElementById("tbl_border_style_dotted").value;this.tbl_border_style_dashed=document.getElementById("tbl_border_style_dashed").value;this.tbl_border_style_none=
document.getElementById("tbl_border_style_none").value;this.tbl_border_collapse=document.getElementById("tbl_border_collapse");this.tbl_border_size=parseInt(document.getElementById("tbl_border_size").value);this.tbl_border_size_1=parseInt(document.getElementById("tbl_border_size_1").value);this.tbl_border_size_2=parseInt(document.getElementById("tbl_border_size_2").value);this.tbl_border_size_3=parseInt(document.getElementById("tbl_border_size_3").value);this.tbl_border_size_4=parseInt(document.getElementById("tbl_border_size_4").value);
this.tbl_border_size_5=parseInt(document.getElementById("tbl_border_size_5").value);this.tbl_bo_color=document.getElementById("tbl_bo_color");this.tbl_bo_color_val=this.tbl_bo_color[this.tbl_bo_color.selectedIndex].value},init:function(){for(var b=document.getElementsByTagName("INPUT"),a=0;a<b.length;a++){if(b[a].className=="button_table_border_style")b[a].onclick=$me_table.btn_click_style;if(b[a].className=="button_table_border_size")b[a].onclick=$me_table.btn_click_size;if(b[a].type=="text"||b[a].type==
"radio"||b[a].type=="checkbox")b[a].onclick=$me_table.update_preview,b[a].onchange=$me_table.update_preview,b[a].onkeyup=$me_table.update_preview}},btn_click_style:function(){document.getElementById("tbl_border_style").value=this.value;$me_table.update_preview()},btn_click_size:function(){document.getElementById("tbl_border_size").value=parseInt(this.value);$me_table.update_preview()},update_preview:function(){$me_table.construct();$me_table.tbl_border_style=="None"?($me_table.tbl_border="",$me_table.td_border=
""):($me_table.tbl_border=' border="'+$me_table.tbl_border_size+'"',$me_table.td_border=' style="border: '+$me_table.tbl_border_size+"px "+$me_table.tbl_border_style+" "+$me_table.tbl_bo_color_val+'"');$me_table.tbl_html="<table"+$me_table.tbl_border;$me_table.tbl_html+=' cellpadding="'+$me_table.tbl_padding+'" cellspacing="'+$me_table.tbl_spacing+'" ';$me_table.tbl_html+='style="width: '+$me_table.tbl_width;$me_table.tbl_width_in_per.checked==!0?$me_table.tbl_html+="%;":$me_table.tbl_width_in_pix.checked==
!0&&($me_table.tbl_html+="px;");$me_table.tbl_border_collapse.checked==!0&&($me_table.tbl_html+=" border-collapse: collapse;");$me_table.tbl_html+=" border-color: "+$me_table.tbl_bo_color_val+";";$me_table.tbl_html+='">';for(var b=0;b<$me_table.tbl_rows;b++){$me_table.tbl_html+="\n<tr>";for(var a=0;a<$me_table.tbl_cols;a++)$me_table.tbl_html+="<td"+$me_table.td_border+">"+b+":"+a+"</td>";$me_table.tbl_html+="</tr>"}$me_table.tbl_html+="\n</table>";$me_table.tbl_preview.innerHTML=$me_table.tbl_html},
insert:function(){$me_table.update_preview();parent.$m.t.magic_editor.inject_html($me_table.tbl_html,"block");parent.$m.t.darkroom.hide("mjf_darkroom_iframe_div.link")},cancel:function(){parent.$m.t.darkroom.hide("mjf_darkroom_iframe_div.link")}};window.onload=function(){$me_table.construct();$me_table.init();$me_table.update_preview()};