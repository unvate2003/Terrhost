<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Website Đang Bảo Trì</title>

</head>	
<body>
    <center>
    <img src="/assets/images/404.png" height="200px"></br>
    <h1>Website hiện tại đang bảo trì. Bạn vui lòng quay lại sau nha!</h1>
    <h1>Bạn Sẽ Được Tự Động Tải Lại Trang Sau <font color=red><span id="container"></span></font> Giây Nữa!</h1>
    </center>
    
    
    
    
<script type="text/javascript">
var time = 5; //How long (in seconds) to countdown
var page = "/"; //The page to redirect to
function countDown(){
time--;
gett("container").innerHTML = time;
if(time == 0){
window.location = page;
}
}
function gett(id){
if(document.getElementById) return document.getElementById(id);
if(document.all) return document.all.id;
if(document.layers) return document.layers.id;
if(window.opera) return window.opera.id;
}
function init(){
if(gett('container')){
setInterval(countDown, 1000);
gett("container").innerHTML = time;
}
else{
setTimeout(init, 50);
}
}
document.onload = init();
</script>
</body>
</html>