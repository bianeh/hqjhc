/**
 * 
 */
$(function(){

var kuaidi_anjian='<div id="kuaidishow" style="padding-left:60px;">'
						+'<span class="default1 fl">默认运费：</span>'
						+'<input class="flw" type="hidden" name="default[shipping_way]" value="0"/>'
						+'<input class="flw" type="hidden" name="default[area]" value="1"/>'
						+'<input class="flw" type="text" name="default[first_num]" value="1"/>'
						+'<span class="fl">件内</span>'
						+'<input class="flw" type="text"  name="default[first_fee]"  value="1"/>'
						+'<span class="fl">元，每增加：</span>'
						+'<input class="flw" type="text" name="default[continue_num]" value="1"/>'
						+'<span class="fl">件，增加运费:</span>'
						+'<input class="flw" type="text"  name="default[continue_fee]"  value="1"/>'
						+'<span class="fl">元</span>'
						+'</div>'
						+'<p>&nbsp;</p>'
						+'<span id="kuaidispan" style="margin-left:60px;" ><a class="link" onclick="add_table(this)" >为指定地区设置运费</a></span>';;
var kuaidi_anzhong='<div id="kuaidishow" style="padding-left:60px;display:none">'
					+'<span class="default1 fl">默认运费：</span>'
					+'<input class="flw" type="hidden" name="default[area]" value="1"/>'
					+'<input class="flw" type="text" name="default[first_num]" value="1"/>'
					+'<span class="fl">kg内</span>'
					+'<input class="flw" type="text"  name="default[first_fee]"  value="1"/>'
					+'<span class="fl">元，每增加：</span>'
					+'<input class="flw" type="text" name="default[continue_num]" value="1"/>'
					+'<span class="fl">kg，增加运费:</span>'
					+'<input class="flw" type="text"  name="default[continue_fee]"  value="1"/>'
					+'<span class="fl">元</span>'
					+'</div>'
					+'<p>&nbsp;</p>'
					+'<span id="kuaidispan" style="margin-left:60px;" ><a class="link" onclick="add_table(this)" >为指定地区设置运费</a></span>';;
var kuaidi_antiji='<div id="kuaidishow" style="padding-left:60px;display:none">'
	+'<span class="default1 fl">默认运费：</span>'
	+'<input class="flw" type="hidden" name="default[area]" value="1"/>'
	+'<input class="flw" type="hidden" name="default[is_default]" value="1"/>'
	+'<input class="flw" type="text" name="default[first_num]" value="1"/>'
	+'<span class="fl">㎥内</span>'
	+'<input class="flw" type="text"  name="default[first_fee]"  value="1"/>'
	+'<span class="fl">元，每增加：</span>'
	+'<input class="flw" type="text" name="default[continue_num]" value="1"/>'
	+'<span class="fl">㎥，增加运费:</span>'
	+'<input class="flw" type="text"  name="default[continue_fee]"  value="1"/>'
	+'<span class="fl">元</span>'
	+'</div>'
	+'<p>&nbsp;</p>'
	+'<span id="kuaidispan" style="margin-left:60px;" ><a class="link" onclick="add_table()" >为指定地区设置运费</a></span>';

var kuaidi_anjian_table='<table class="table" id="table">'
	+'<tr>'
		+'<th width="200">运送到</th>'
		+'<th width="70">首件（个）</th>'
		+'<th width="70">首费（元）</th>'
		+'<th width="70">续件（个）</th>'
		+'<th width="70">续费（元）</th>'
		+'<th width="50">操作</th>'
	+'</tr>'
	+'<tr>'
		+'<td style="text-algin:right;">'
			+'<div class="area-group">'
				+'<p id="a">未指定区域</p>'
			+'</div>'
			+'<a href="#myModal2" class="link area-edit" data-toggle="modal" onclick="fn(this)">编辑</a>'
			+'<input id="aname" name="other[0][area_name]" type="hidden" value="">'
			+'<input type="hidden" id="aid" name="other[0][area]" value="" >'
		+'</td>'
		+'<td>'
			+'<input class="flw" type="hidden" name="other[0][shipping_way]" value="0"/>'
			+'<input type="text" name="other[0][first_num]" value="1" class="input-text">'
		+'</td>'
		+'<td><input type="text" name="other[0][first_fee]" value="1" class="input-text"></td>'
		+'<td><input type="text" name="other[0][continue_num]" value="1" class="input-text"></td>'
		+'<td><input type="text" name="other[0][continue_fee]" value="1" class="input-text"></td>'
		+'<td><a class="link" onclick="removeDiv(this)">删除</a></td>'
	+'</tr>'
	+'</table>';

var kuaidi_anjian_tr='<tr>'
	+'<td style="text-algin:right;">'
		+'<div class="area-group">'
			+'<p id="a+a+">未指定区域</p>'
			+'<input id="a+a+name" name="other[+a+][area_name]" type="hidden" value="">'
		+'</div>'
		+'<a href="#myModal2" class="link area-edit" data-toggle="modal" onclick="fn(this)">编辑</a>'
		+'<input type="hidden" id="a+a+id" name="other[+a+][area]" value="" >'
	+'</td>'
	+'<td><input type="text" name="other[+a+][first_num]" value="1" class="input-text"></td>'
	+'<td><input type="text" name="other[+a+][first_fee]" value="1" class="input-text"></td>'
	+'<td><input type="text" name="other[+a+][continue_num]" value="1" class="input-text"></td>'
	+'<td><input type="text" name="other[+a+][continue_fee]" value="1" class="input-text"></td>'
	+'<td><a class="link" onclick="removeDiv(this)">删除</a></td>'
	+'</tr>';					
					
$(":checkbox[name='shipping_way[]']").change(function show_shipping(){
	var id=$(this).attr("id");
	var price_way=$(this).attr("price_way");
	if(id=="kuaidi"){
		if(price_way==0){
			$("#jifeifangshi_kuaidi").html(kuaidi_anjian);
		}
		if(price_way==1){
			$("#jifeifangshi_kuaidi").html(kuaidi_anjian);
		}
		if(price_way==2){
			$("#jifeifangshi_kuaidi").html(kuaidi_anjian);
		}
		
	}
	if(id=="ems"){
		if(price_way==0){
			$("#jifeifangshi_kuaidi").html(kuaidi_anjian);
		}
		if(price_way==1){
			$("#jifeifangshi_kuaidi").html(kuaidi_anjian);
		}
		if(price_way==2){
			$("#jifeifangshi_kuaidi").html(kuaidi_anjian);
		}
		
	}
	if(id=="pingyou"){
		if(price_way==0){
			$("#jifeifangshi_kuaidi").html(kuaidi_anjian);
		}
		if(price_way==1){
			$("#jifeifangshi_kuaidi").html(kuaidi_anjian);
		}
		if(price_way==2){
			$("#jifeifangshi_kuaidi").html(kuaidi_anjian);
		}
		
	}
	
})					
					
function add_tables(event){
	alert('111');
	$(event).parent().parent().find("div").eq(0).after(kuaidi_anjian_table);	
}					
function add_tr(data){
	$(data).parent().parent().find("table").append(kuaidi_anjian_tr);	
}					
					
});					
					