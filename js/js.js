// 限定輸入的字數
function strlen(obj, len){
  if($(obj).val().length > len){
    var text=$(obj).val().substring(0,len);
    $(obj).val(text);
  }
}