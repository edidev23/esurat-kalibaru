/***************************************************************************
- File: magic_charts.js
- Version: 12.5.18
***************************************************************************/

$m.trick.magic_charts={};
$m.t.magic_charts={name:"magic_charts",colors:["#007ABD","#38A818","#EE3C0D","#E9ED00","#00C1E0","#47E256","#FF803E","#FFF043","#4AFBB4","#9FD6FF","#C0C0C0"],construct:function(){},column:{name:"column",data_att:"column",construct:function(a){for(var c=0,b=a.length;c<b;c++)$m.t.magic_charts.column.draw(a[c])},draw:function(a){if($m.is.alive(a)===!1||$m.is.alive(a.data)===!1)return!1;var c=$m.id(a.canvas_id);if($m.is.alive(c)===!1&&!c.getContext)return!1;if($m.is.alive(a.background_color)===!1)a.background_color=
"#fff";if($m.is.alive(a.bar_color)===!1)a.bar_color="maroon";if($m.is.alive(a.bar_margin)===!1)a.bar_margin=5;if($m.is.alive(a.bar_width)===!1)a.bar_width=50;if($m.is.alive(a.text_color)===!1)a.text_color="#262626";if(a.x_axis_data_lines===!1)a.x_axis_data_lines=!1;else if($m.is.alive(a.x_axis_data_lines)===!1)a.x_axis_data_lines=!0;else if(a.x_axis_data_lines===!0)a.x_axis_data_lines=!0;if($m.is.alive(a.x_axis_color)===!1)a.x_axis_color="#c0c0c0";if($m.is.alive(a.x_axis_width)===!1)a.x_axis_width=
2;if(a.x_axis_width==="none")a.x_axis_width=1.0E-6;if(a.x_show_names===!1)a.x_show_names=!1;else if($m.is.alive(a.x_show_names)===!1)a.x_show_names=!0;else if(a.x_show_names===!0)a.x_show_names=!0;a.x_show_values=$m.is.alive(a.x_show_values)===!1?!1:!0;if($m.is.alive(a.y_axis_color)===!1)a.y_axis_color="#c0c0c0";if($m.is.alive(a.y_axis_width)===!1)a.y_axis_width=2;if(a.y_axis_width==="none")a.y_axis_width=1.0E-6;if(a.y_show_increments===!1)a.y_show_increments=!1;else if($m.is.alive(a.y_show_increments)===
!1)a.y_show_increments=!0;else if(a.y_show_increments===!0)a.y_show_increments=!0;if($m.is.alive(a.y_increments)===!1)a.y_increments=50;var c=$m.id(a.canvas_id),b=c.getContext("2d"),g=a.data,c=c.height-20,j=a.y_increments,f=a.y_show_increments===!0?35:-1,d=a.bar_width,h=0,l=0,m=0,i="",k="",n="";b.fillStyle=a.background_color;b.fillRect(0,0,b.canvas.width,b.canvas.height);for(var e=0,o=g.length;e<o;e++)i=g[e].split(":"),parseInt(i[1])>parseInt(h)&&(h=i[1]);b.strokeStyle=a.x_axis_color;b.lineWidth=
a.x_axis_width;b.textAlign="right";b.fillStyle=a.text_color;h=Math.ceil(h/j);for(e=0;e<h;e++)a.y_show_increments===!0&&b.fillText(l,f-5,c-l+3,50),a.x_axis_data_lines===!0&&$m.t.magic_charts.draw.line(b,f,c-l,b.canvas.width,c-l),l+=j;e=0;for(o=g.length;e<o;e++)m+=a.bar_margin,i=g[e].split(":"),k="",a.x_show_names===!0&&(k+=i[0]),a.x_show_names===!0&&a.x_show_values===!0&&(k+=": "),a.x_show_values===!0&&(k+=i[1]),n=parseInt(i[1]),b.fillStyle=$m.is.alive(i[2])===!0?i[2]:a.bar_color,$m.t.magic_charts.draw.rect(b,
f+e*d+m,c-n,d,n,!0),b.textAlign="left",b.fillStyle=a.text_color,b.fillText(k,f+e*d+m+1,c+14,200);b.strokeStyle=a.y_axis_color;b.lineWidth=a.y_axis_width;$m.t.magic_charts.draw.line(b,f,380,f,0)}},pie:{name:"pie",data_att:"pie",construct:function(a){for(var c=0,b=a.length;c<b;c++)$m.t.magic_charts.pie.draw(a[c])},draw:function(a){if($m.is.alive(a)===!1||$m.is.alive(a.data)===!1)return!1;var c=$m.id(a.canvas_id);if($m.is.alive(c)===!1&&!c.getContext)return!1;if($m.is.alive(a.text_color)===!1)a.text_color=
"#000";if($m.is.alive(a.text_style)===!1)a.text_style="bold 13px sans-serif";var c=$m.id(a.canvas_id),b=c.getContext("2d"),g=a.data,j=Math.min(c.width,c.height)/2*0.9,f={x:c.width/2,y:c.height/2},d=0,h=0,l=h=0,m=[],i=[],k=[],n=15;c.width+=150;b.fillStyle="#fff";b.fillRect(0,0,b.canvas.width,b.canvas.height);b.font=a.text_style;b.strokeStyle="#fff";b.lineWidth=2;for(var e=0,o=g.length;e<o;e++)values=g[e].split(":"),h=parseFloat(values[1]),l+=h,m[m.length]=h,k[k.length]=$m.is.alive(values[2])===!0?
values[2]:$m.t.magic_charts.colors[e],i[i.length]=values[0];e=0;for(o=m.length;e<o;e++)h=m[e]/l,b.beginPath(),b.moveTo(f.x,f.y),b.arc(f.x,f.y,j,Math.PI*(-0.65+2*d),Math.PI*(-0.65+2*(d+h)),!1),b.lineTo(f.x,f.y),b.closePath(),b.stroke(),b.fillStyle=k[e],b.fill(),d+=h,b.fillText("\u2022",c.height+10,n*2),b.fillStyle=a.text_color,b.fillText(Math.floor(100*h)+"% "+i[e],c.height+22,n*2),n+=10}},line_graph:{name:"line_graph",data_att:"line_graph",x_padding:30,y_padding:30,construct:function(a){for(var c=
0,b=a.length;c<b;c++)$m.t.magic_charts.line_graph.draw(a[c])},get_x_pixel:function(a,c){return(c-$m.t.magic_charts.line_graph.x_padding)/$m.t.magic_charts.line_graph.draw.chart_data_len*a+$m.t.magic_charts.line_graph.x_padding*1.5},get_y_pixel:function(a,c){var b=$m.t.magic_charts.line_graph.get_max_y();return c-(c-$m.t.magic_charts.line_graph.y_padding)/b*a-$m.t.magic_charts.line_graph.y_padding},get_max_y:function(){for(var a=0,c=0;c<$m.t.magic_charts.line_graph.draw.chart_data_len;c++)$m.t.magic_charts.line_graph.draw.chart_data[c]>
a&&(a=$m.t.magic_charts.line_graph.draw.chart_data[c]);a+=10-a%10;return a},draw:function(a){if($m.is.alive(a)===!1||$m.is.alive(a.data)===!1)return!1;var c=$m.id(a.canvas_id);if($m.is.alive(c)===!1&&!c.getContext)return!1;if($m.is.alive(a.dot_color)===!1)a.dot_color="#333";if($m.is.alive(a.line_color)===!1)a.line_color="#f00";if($m.is.alive(a.text_color)===!1)a.text_color="#333";if($m.is.alive(a.text_style)===!1)a.text_style="normal 12px sans-serif";if($m.is.alive(a.y_increments)===!1)a.y_increments=
10;var c=$m.id(a.canvas_id),b=c.getContext("2d"),g=a.data,j=a.y_increments,f=[];$m.t.magic_charts.line_graph.draw.chart_data=[];$m.t.magic_charts.line_graph.draw.chart_data_len=g.length;b.fillStyle="#fff";b.fillRect(0,0,b.canvas.width,b.canvas.height);b.lineWidth=2;b.strokeStyle="#333";b.font=a.text_style;b.textAlign="center";b.beginPath();b.moveTo($m.t.magic_charts.line_graph.x_padding,0);b.lineTo($m.t.magic_charts.line_graph.x_padding,c.height-$m.t.magic_charts.line_graph.y_padding);b.lineTo(c.width,
c.height-$m.t.magic_charts.line_graph.y_padding);b.stroke();b.fillStyle=a.text_color;for(var d=0;d<$m.t.magic_charts.line_graph.draw.chart_data_len;d++)f=g[d].split(":"),$m.t.magic_charts.line_graph.draw.chart_data.push(parseInt(f[1])),b.fillText(f[0],$m.t.magic_charts.line_graph.get_x_pixel(d,c.width),c.height-$m.t.magic_charts.line_graph.y_padding+20);b.fillStyle=a.text_color;b.textAlign="right";b.textBaseline="middle";g=$m.t.magic_charts.line_graph.get_max_y();for(d=0;d<g;d+=j)b.fillText(d,$m.t.magic_charts.line_graph.x_padding-
10,$m.t.magic_charts.line_graph.get_y_pixel(d,c.height));b.strokeStyle=a.line_color;b.beginPath();b.moveTo($m.t.magic_charts.line_graph.get_x_pixel(0,c.width),$m.t.magic_charts.line_graph.get_y_pixel($m.t.magic_charts.line_graph.draw.chart_data[0],c.height));for(d=1;d<$m.t.magic_charts.line_graph.draw.chart_data_len;d++)b.lineTo($m.t.magic_charts.line_graph.get_x_pixel(d,c.width),$m.t.magic_charts.line_graph.get_y_pixel($m.t.magic_charts.line_graph.draw.chart_data[d],c.height));b.stroke();b.fillStyle=
a.dot_color;for(d=0;d<$m.t.magic_charts.line_graph.draw.chart_data_len;d++)b.beginPath(),b.arc($m.t.magic_charts.line_graph.get_x_pixel(d,c.width),$m.t.magic_charts.line_graph.get_y_pixel($m.t.magic_charts.line_graph.draw.chart_data[d],c.height),4,0,Math.PI*2,!0),b.fill()}},draw:{line:function(a,c,b,g,j){a.beginPath();a.moveTo(c,b);a.lineTo(g,j);a.closePath();a.stroke()},rect:function(a,c,b,g,j,f){a.beginPath();a.rect(c,b,g,j);a.closePath();f&&a.fill()}}};