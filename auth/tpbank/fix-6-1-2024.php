<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
//header('Content-Type: application/json, text/javascript; charset="utf-8"');

function get_token($username, $password)
	{
		$url = "https://ebank.tpb.vn/gateway/api/auth/login";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
			//"DEVICE_ID: LYjkjqGZ3HhGP5520GxPP2j94RDMC7Xje77MI7" . rand(10000000, 999999999999),
			//"DEVICE_ID: y5oM2yL3edOQgxU4II134wvnis0T5cDuXc3ggR" . rand(10000000, 999999999999),
			"PLATFORM_VERSION: 91",
			"DEVICE_NAME: Chrome",
			"SOURCE_APP: HYDRO",
			"Authorization: Bearer",
			"Content-Type: application/json",
			"Accept: application/json, text/plain, */*",
			// "Referer: https://ebank.tpb.vn/retail/vX/login?returnUrl=%2Fmain",
			"Referer: https://ebank.tpb.vn/retail/vX/",
			"sec-ch-ua-mobile: ?0",
			"User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36",
			"PLATFORM_NAME: WEB",
			"APP_VERSION: 1.3",
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$data = '{"username":"' . $username . '","password":"' . $password . '", "step_2FA":"VERIFY", "deviceId":"y5oM2yL3edOQgxU4II134wvnis0T5cDuXc3ggR'. rand(10000000, 999999999999).'"}';

		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		//for debug only!
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$resp = curl_exec($curl);
		curl_close($curl);
		return $resp;
	}

$username = '06306046';
$password = 'Api#CVH#170303';
$rin1 = get_token($username, $password);
$rin = json_decode($rin1);
if ($rin && isset($rin->access_token)) {
    $rin2 = $rin->access_token;
} else {
    echo "Không thể lấy access token hoặc dữ liệu trả về không hợp lệ.";
}
//$rin->access_token;
echo $rin2;
$token = $rin2;
$stk_tpbank = '33669955555';


echo get_history2($token, $stk_tpbank);
function get_history2($token, $stk_tpbank)
{
    $ngay_bat_dau_check = date("Ymd", time() - 3600 * 720);
    $ngay_ket_thuc_check = date("Ymd");
    $url = "https://ebank.tpb.vn/gateway/api/smart-search-presentation-service/v1/account-transactions/find";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Connection: keep-alive",
        "DEVICE_ID: y5oM2yL3edOQgxU4II134wvnis0T5cDuXc3ggR" . rand(10000000, 999999999999),
        "PLATFORM_VERSION: 91",
        "DEVICE_NAME: Chrome",
        "SOURCE_APP: HYDRO",
        "Authorization: Bearer " . $token,
        "XSRF-TOKEN=3229191c-b7ce-4772-ab93-55a" . rand(10000000, 999999999999),
        "Content-Type: application/json",
        "Accept: application/json, text/plain, */*",
        "sec-ch-ua-mobile: ?0",
        "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36",
        "PLATFORM_NAME: WEB",
        "APP_VERSION: 1.3",
        "Origin: https://ebank.tpb.vn",
        "Sec-Fetch-Site: same-origin",
        "Sec-Fetch-Mode: cors",
        "Sec-Fetch-Dest: empty",
        "Referer: https://ebank.tpb.vn/retail/vX/main/inquiry/account/transaction?id=" . $stk_tpbank,
        "Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
        "Cookie: _ga=GA1.2.1679888794.1623516" . rand(10000000, 999999999999) . "; _gid=GA1.2.580582711.162" . rand(10000000, 999999999999) . "; _gcl_au=1.1.756417552.162" . rand(10000000, 999999999999) . "; Authorization=" . $token,
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = '{"accountNo":"' . $stk_tpbank . '","currency":"VND","fromDate":"' . $ngay_bat_dau_check . '","toDate":"' . $ngay_ket_thuc_check . '","keyword":""}';
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}



function get_history($token, $stk_tpbank)
{
    $url = "https://ebank.tpb.vn/gateway/api/fund-transfer-presentation-service/v2/creditor-info/external/account-number";
    //$url = "https://ebank.tpb.vn/gateway/api/smart-search-presentation-service/v1/account-transactions/find"
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Connection: keep-alive",
        "DEVICE_ID: y5oM2yL3edOQgxU4II134wvnis0T5cDuXc3ggR" . rand(10000000, 999999999999),
        "PLATFORM_VERSION: 91",
        "DEVICE_NAME: Chrome",
        "SOURCE_APP: HYDRO",
        "Authorization: Bearer " . $token,
        "XSRF-TOKEN=3229191c-b7ce-4772-ab93-55a",
        "Content-Type: application/json",
        "Accept: application/json, text/plain, */*",
        "sec-ch-ua-mobile: ?0",
        "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36",
        "PLATFORM_NAME: WEB",
        "APP_VERSION: 1.3",
        "Origin: https://ebank.tpb.vn",
        "Sec-Fetch-Site: same-origin",
        "Sec-Fetch-Mode: cors",
        "Sec-Fetch-Dest: empty",
        "Referer: https://ebank.tpb.vn/retail/vX/main/transfer/interbank",
        "Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
        "Cookie: _ga=GA1.2.1679888794.1623516; _gid=GA1.2.580582711.16277; _gcl_au=1.1.756417552.1626666; Authorization=" . $token,
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = '{"debtorAccountNumber":"' . $stk_tpbank . '","creditorAccountNumber":"0161000891507","creditorBankId":"970436"}';
    //970436 - vietcombank
    //970422 - mbbank
    //970400 - saigonbank
    //970403 - sacombank
    //970405 - Agribank
    //970406 - Đông Á Bank
    //970407 - Techcombank
    //970412 - PVCombank 
    //970415 - Vietinbank
    //970416 - ACB bank
    //970418 - BIDV
    //970401 - BIDV
    //970423 - TienPhongBank
    //970427 - VietABank
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    //echo $resp;
    curl_close($curl);
    return $resp;
}






// khi get chu ý trong transactionInfos có creditDebitIndicator Nếu nó là CRDT là cộng tiền , nếu là DBIT là trừ tiền