<?php
/**
 * Created by PhpStorm.
 * User: wilson
 * Date: 16/6/17
 * Time: 18:44
 */
require_once ("../lib/YopClient.php");
require_once ("../lib/YopClient3.php");
require_once ("../lib/Util/YopSignUtils.php");

//Get请求 对称秘钥
function get_aes(){
    $secretKey = "PdZ74F6sxapgOWJ31QKmYw==";
    $request = new YopRequest("yop-boss", $secretKey);
    $request->setSignAlg("sha256");

    //加入请求参数
    $request->addParam("request_flow_id", "12345678");//请求流水标识
    $request->addParam("name", "张文康");//请求流水标识
    $request->addParam("id_card_number", "370982199101186691");//请求流水标识
    //提交Get请求
    $response = YopClient::get("/rest/v3.0/auth/idcard", $request);
    //取得返回结果
    print_r($response);
}


//Post请求 对称秘钥
function post_aes(){
    $secretKey = "PdZ74F6sxapgOWJ31QKmYw==";
    $request = new YopRequest("yop-boss", $secretKey);
    $request->setSignAlg("sha256");

    //加入请求参数
    $request->addParam("request_flow_id", "12345678");//请求流水标识
    $request->addParam("name", "张文康");//请求流水标识
    $request->addParam("id_card_number", "370982199101186691");//请求流水标识
    //提交Post请求
    $response = YopClient::post("/rest/v3.0/auth/idcard", $request);
    //取得返回结果
    print_r($response);
}

//Get请求 非对称秘钥
function get_rsa(){
    /*商户私钥*/
    $private_key ="MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCXsKWWClznZbdTwp9183e4Ygu/twbQhuS6LPpu/TZ+OFwwauvIZnOyKu+rFh6apKyVxiLEkssnTsBjLjUIlypEGU2SdLGkswWAPvVdunLjjWEz37W2w4VNkGf8bGCQ9fIxMynoBCTeeWcQz896e1y2p5YZHygUhXGLM/9q5mr3iQQgrEPdFEAdlfLexkbVIF2bS02NsDFLNvqKNk7219cefxWPgJfN7RukUIZyy4nbeevbMAAFpNUFh1NlAh4qzwocOfbZ3NgtwJDf29jibpM3dacS7tqYGwpeGpKazS9tZgTAYcX2kLT7s+G6vVzVQR61pvvDs5ubyfsw/KFR8KDDAgMBAAECggEAShSE6Z+p+4AbZhaYVbxPbYbEgh5af6BBOAMbUvTqlf3kV+j/uWD/g7WgUod87r0ZZBPdiu69tDarkkRQth9NDvDkh2/iCbM8LoOQxPN3hFXZcMICNn2KLnUls4siJelXHFwGTT8o2lWj1fwHMaPphXKWxTIIGu2IpBkC1iwtdTF8mqe2HH+H2djBE96JXVZIf3/FgGu8ppmXa/xG4DfrTxFnGEJzgaadT3Z+ybXbqjYgFgmmBnZOaTx1XPQfLGQVYJz9BunDhwhrqBUM+QuLr1jUsMsj/Yud52cNXjwq9z8FfkKUdVVfE4VrzH8JpKKk7Vim7RWBQER29jlEnV+ysQKBgQDjMWxZz4AveXxWSx7MgXN9PEzxzmGWSApseDskSi5PAmXa4ut5XyNJUiGJ8Zf+cssPfWFNtB7suJBuoMTtrQSap2tgoo70y7QSO0ZlZ0v5Ny9LYh8oHvDgBJVNmS5HWv1U1/VHxNHczNmQ05smXNo1bzMYe5Xo10J2W47UUTgOHwKBgQCq7G6B5RfD+O1jdmYWlilh5oi1XGdYJGnzhs9DmAUN5plQ3VxpUFxxQCgOwXCskfT9QUVYhsIpQIs2iCylwuNDuxxiEQyRpeBirRaqmxvosv08Trwsr1Vs/Cuh17ZZOS+OUehN0fDZCiruK4e2btVfv8LlE1KMuoiUsn1X2gWQ3QKBgCyqBrcRSA4NQBhm5EMoH+A6/pV7EUxOFV6FtHrJ6pi1y/hgLBLMVU+Qye8og80OHEWLTJnOE1ZOYnadPJnNLd6Jk16IFrqhYWFELe65hAIWi0GypJVqn8gqnn+G4cY9aRhI7HuTgf56dzs1nobIMk3W8qCZizsfNn22OjobTX3ZAoGBAJsTusvF1IMs5g05DjTt9wvpQx3xgZ46I5sdNA3q7qMHFxGEVeUDUWw7Plzs61LXdoUU5FsGoUEWW3iVopSett3r9TuQpmu7KVO+IXOXGYJOa259LUQJrKMeRGQpuDtJpDknXXLFyRTSodLH0fEWrCecb7KxjlM6ptLrAshjemtNAoGBAMzGo6aNER8VZfET8Oy0i5G8aVBp6yrMiQsNOj4S1VPoHI+Pc6ot5rDQdjek9PRzF9xeCU4K7+KLaOs6fVmTfsFpPbDafCTTmos9LGr5FIyXpU7LQCl3QPHWPDd5ezsu9SPVjzsEPX3WTSOJuUA8hE7pJnAzMHLGAFpIXJRu3Z/y";

    /*YOP公钥*/
    $yop_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6p0XWjscY+gsyqKRhw9MeLsEmhFdBRhT2emOck/F1Omw38ZWhJxh9kDfs5HzFJMrVozgU+SJFDONxs8UB0wMILKRmqfLcfClG9MyCNuJkkfm0HFQv1hRGdOvZPXj3Bckuwa7FrEXBRYUhK7vJ40afumspthmse6bs6mZxNn/mALZ2X07uznOrrc2rk41Y2HftduxZw6T4EmtWuN2x4CZ8gwSyPAW5ZzZJLQ6tZDojBK4GZTAGhnn3bg5bBsBlw2+FLkCQBuDsJVsFPiGh/b6K/+zGTvWyUcu+LUj2MejYQELDO3i2vQXVDk7lVi2/TcUYefvIcssnzsfCfjaorxsuwIDAQAB";

    $request = new YopRequest("yop-boss", $private_key, $yop_public_key);
    //加入请求参数
    $request->addParam("request_flow_id", "12345678");//请求流水标识
    $request->addParam("name", "张文康");//请求流水标识
    $request->addParam("id_card_number", "370982199101186691");//请求流水标识
    //提交Post请求
    $response = YopClient3::get("/rest/v3.0/auth/idcard", $request);
    //取得返回结果
    print_r($response);
}

//Post请求 非对称秘钥
function post_rsa(){
    /*商户私钥*/
    $private_key ="MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCXsKWWClznZbdTwp9183e4Ygu/twbQhuS6LPpu/TZ+OFwwauvIZnOyKu+rFh6apKyVxiLEkssnTsBjLjUIlypEGU2SdLGkswWAPvVdunLjjWEz37W2w4VNkGf8bGCQ9fIxMynoBCTeeWcQz896e1y2p5YZHygUhXGLM/9q5mr3iQQgrEPdFEAdlfLexkbVIF2bS02NsDFLNvqKNk7219cefxWPgJfN7RukUIZyy4nbeevbMAAFpNUFh1NlAh4qzwocOfbZ3NgtwJDf29jibpM3dacS7tqYGwpeGpKazS9tZgTAYcX2kLT7s+G6vVzVQR61pvvDs5ubyfsw/KFR8KDDAgMBAAECggEAShSE6Z+p+4AbZhaYVbxPbYbEgh5af6BBOAMbUvTqlf3kV+j/uWD/g7WgUod87r0ZZBPdiu69tDarkkRQth9NDvDkh2/iCbM8LoOQxPN3hFXZcMICNn2KLnUls4siJelXHFwGTT8o2lWj1fwHMaPphXKWxTIIGu2IpBkC1iwtdTF8mqe2HH+H2djBE96JXVZIf3/FgGu8ppmXa/xG4DfrTxFnGEJzgaadT3Z+ybXbqjYgFgmmBnZOaTx1XPQfLGQVYJz9BunDhwhrqBUM+QuLr1jUsMsj/Yud52cNXjwq9z8FfkKUdVVfE4VrzH8JpKKk7Vim7RWBQER29jlEnV+ysQKBgQDjMWxZz4AveXxWSx7MgXN9PEzxzmGWSApseDskSi5PAmXa4ut5XyNJUiGJ8Zf+cssPfWFNtB7suJBuoMTtrQSap2tgoo70y7QSO0ZlZ0v5Ny9LYh8oHvDgBJVNmS5HWv1U1/VHxNHczNmQ05smXNo1bzMYe5Xo10J2W47UUTgOHwKBgQCq7G6B5RfD+O1jdmYWlilh5oi1XGdYJGnzhs9DmAUN5plQ3VxpUFxxQCgOwXCskfT9QUVYhsIpQIs2iCylwuNDuxxiEQyRpeBirRaqmxvosv08Trwsr1Vs/Cuh17ZZOS+OUehN0fDZCiruK4e2btVfv8LlE1KMuoiUsn1X2gWQ3QKBgCyqBrcRSA4NQBhm5EMoH+A6/pV7EUxOFV6FtHrJ6pi1y/hgLBLMVU+Qye8og80OHEWLTJnOE1ZOYnadPJnNLd6Jk16IFrqhYWFELe65hAIWi0GypJVqn8gqnn+G4cY9aRhI7HuTgf56dzs1nobIMk3W8qCZizsfNn22OjobTX3ZAoGBAJsTusvF1IMs5g05DjTt9wvpQx3xgZ46I5sdNA3q7qMHFxGEVeUDUWw7Plzs61LXdoUU5FsGoUEWW3iVopSett3r9TuQpmu7KVO+IXOXGYJOa259LUQJrKMeRGQpuDtJpDknXXLFyRTSodLH0fEWrCecb7KxjlM6ptLrAshjemtNAoGBAMzGo6aNER8VZfET8Oy0i5G8aVBp6yrMiQsNOj4S1VPoHI+Pc6ot5rDQdjek9PRzF9xeCU4K7+KLaOs6fVmTfsFpPbDafCTTmos9LGr5FIyXpU7LQCl3QPHWPDd5ezsu9SPVjzsEPX3WTSOJuUA8hE7pJnAzMHLGAFpIXJRu3Z/y";

    /*YOP公钥*/
    $yop_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6p0XWjscY+gsyqKRhw9MeLsEmhFdBRhT2emOck/F1Omw38ZWhJxh9kDfs5HzFJMrVozgU+SJFDONxs8UB0wMILKRmqfLcfClG9MyCNuJkkfm0HFQv1hRGdOvZPXj3Bckuwa7FrEXBRYUhK7vJ40afumspthmse6bs6mZxNn/mALZ2X07uznOrrc2rk41Y2HftduxZw6T4EmtWuN2x4CZ8gwSyPAW5ZzZJLQ6tZDojBK4GZTAGhnn3bg5bBsBlw2+FLkCQBuDsJVsFPiGh/b6K/+zGTvWyUcu+LUj2MejYQELDO3i2vQXVDk7lVi2/TcUYefvIcssnzsfCfjaorxsuwIDAQAB";

    $request = new YopRequest("yop-boss", $private_key, $yop_public_key);
    //加入请求参数
    $request->addParam("request_flow_id", "12345678");//请求流水标识
    $request->addParam("name", "张文康");//请求流水标识
    $request->addParam("id_card_number", "370982199101186691");//请求流水标识
    //提交Post请求
    $response = YopClient3::post("/rest/v3.0/auth/idcard", $request);
    //取得返回结果
    print_r($response);
}

//结果通知返回原文数据
function T4(){
    //返回的密文
    $source='UcX0j2pzSXBCIFefBTO09Bka8S3mG6nLzuT7GnMZZKNGKL9mj7TKJZmnCSahUnsEYf_rsGi_KqTuM1w0g9y-fbkLW1epCQYCyxelxqgjlRwyGQDB6XzG4yJKTI9GwXaxolbj63PUtU8Gi6BBmTOoAtldHWtlcuX_tQI-pcUpzXl0I7VxdApUXD6ya8I9ByhQXhCm5gwO5Fn0Apv9Fh67AL1kkhye8A7_0lCzKEkHzpMkGAtVw6mCoOJw1x5Bj48vRLUikCxRtp4lOqePPa2KK5X5AkOBZiieGiPCBfRJvhGX6P5HK57zzeKaa_fu1To30fx83ajcPcj_MldOFEhckA$uyOQyTvXEOg0zIPzy8UnuWtgeIuFCkr_NLPmS8C1yVkcEpqPtyXs5BFjVt5tF51g0LZ4fvmpZc2PQGuEbBzdl3ojP5SvKkUXYaVXzXR8HqCQoIHVwaTl4SUl86JzJsx8hR0mFB_ViswxdWYk1vUuiiid17LCEOV-R6ZP360bs8Lhu9JdgR--EcYiLnZ-tOQ2GSFFN2zmiAUyTlk_jKXccrvXxEoM2J81DGVvFOLb29SYALs5o8NmRaMboUBx0azoylLxWVTbPudfUrBDlm_YmJvgtZJbl0hTv8bSKWMr7y_aMqjVjKMRY6ThbT-yY8xsS2KQLHQS6i2ed5O1kb3DZ1vRgzDcmnWNSb7rVLcJMj-TpeG47bj2f7-Bw3IBS_7YxOBpqyBUfhoCcAeCK8uY5AyHl6KdpMFUo6--RE_h1W2TUmlFarPmXNX40BIgSsEy15Llrp156uuqArTy06keusNjRJ5sUy6h_P6DT8DDhhef96F7AYwWi8a6R5dhNfq2hBs5-OaK2AUCRgMtys46o8BDN4rWtkeAYhnARD8dylvnRKhocI3xqp6tg7AVdCxcbEf1GypnwgOOuTVRxFLpzE7_7mUDWFFZIAYSE_gD1bTFUHwSrb_sqA5eNdimxHuZfbfPgS9nca0he1QVRFGtRp8hKe0nFMb68Iu3p5WEJuoflAu-lliWhl-KyBNOb4z0xOrACxsnrpiG4TrNehkHtgAjzkh5iRbzQTK87lAzpdGhqPv_ADLzr3iFcardOOkEmkVkiRyIhgXMuDMancsNVX_V7HOZLpLM-0r4n-9wVCk-QqIeyFtknpqrDkYjlZSjg1badf19c8-7DYLLFtJrmkTp0gkDZN0Y-LDf-AxbsvoMMdndE9DqGF9Li4Y_8OMwEjfIEmiho_XC4gviBVX6R8ZB-zErDqa0-U_QgmSu209rjy40CGNMNZaOeMUXDHVkuZvmivAPeYMaBi0iEi2RA0Xu2sf2VjoLXg0pVekGKMojHDsLm3y66hmcJaYCJ-VW7ONv0gMAhA249oR8okfaNjcU5RhjbZuTSMS-Rcw16vEgV3fP9lNEaqKhwB-ctZrR0kcGYDQ2ZE1i55RSOMNgWJfVmChfcvdoeSqbfzYjO0CFnVAJM-yVK4Mcn-cdQ0KA06wLJASvUHqhRGhUN4ulY1txTlznZXsnPu2nhoXLRw1Y6KcQgMB6qYbL5k50mGPKuOO0ABC3OygbWwrdfzX32LNk07BHJo99wTZxKybQ71idBy5FPsIZVMqP0e_xSeH-XMmTaBH6M2TdkH9gLJFTY9aqIpMd4pAQYmbTUiZYA8z-BkqZKz32sepkOw7MQ4jf4SLkOZGW0lj2njZqE6vkiLGVUx3jJVr3yWsxz0JTxhHDeaHZoW9sMNTycJk4UAg5CFvz3on20AVpErsXt7O2_80GgEBffGd5VDWCUjsxQh3SYhYPtcwk_vukosaNW2x5bn_fB1B55kTVyO9V29c1IWBvSeMmk3Zo7gdA6UKCv7frkxVqHiRdu7oZinxU8pM48aqWXk-I8iuiufgjTPwmmvpY8Zj_MOi7j7BlWyrz40XbjLuqnewDMY4Lb1JQL80Sv5yfgerPTqrY2bhw1S69PCF8Xsb1DdU2egTzkNBsBfVzyptiZjsXzdjYe6bviLUhQQgsEkLhNhRuxaxckTXJZspo1GvZHt1u9qdZ-1BEtLtnWVSV5ZvCAZ7eeSS8h89JY-erl-gVRT3qjstaNANYWlyJd3Re-fad2pAnUj_IB3LkgDyOXBZvO8j5RvHRrdf2ihM-u2S15X4F5-5CBFiciuOYvFijiuq0BM2ieY2WJMg3DMI_VtBbfxuynMGc3ayH0pBDebQ7FK7NrrPbjvJVrvcpRy5kpSfxoPsjiUZgdeb-CaBBMtmmL1yeDatcRa2JghqYOsXYLjQ8XEzDiygV5Z-F8QwLKyaAj7neyegVJ96dmvPv94_Ku8_prb6p3-ZpjHpe_e1h1qUM-q0nVKOVKSz8j36IwjmzwHF6q4tempImRjmmxMiJvSi1cvOPCJVzoyY9EB1DHgtbw6Q6jzA-ngiTyZD9K0HZ6u-e4iHOhWeWg6VPF_DE77MCdiNz5jlgt7XY7u99kyg_nYBhHKjcrQJU0Kd2Q4UiPh02hsiqx5LKV7VXKPz4-0ANEizUKrdorNaK8k95bnGesoR1ebdx4TbsjpPL4Xx-bChdn8BLcmKPkuKB4vzEpKmup01FQkQhHKzVtNoWpbmeITkUsp1pc5Fcxn6MyMptOA8z8qXR6X2VYuEbBgEi_Atv5gtl9LgFX3qZoLubHxxYw6_LtmeNTLzCHro4oElloCgyZw9A6DFe3C2id6cuyZFaqVjK26WSB40gokffnvk5cWhk7MfVKegNvkeC0OOiyQbRJUwONqi4uymt_GA5NpcEjVrgbVWAnWrJfBmmjmc_xbigvAu43KVleBLmD8Xjwrj674jM7P51BzS6V2EgdIhlK1tPZux2NhS0MN8DuOwOse2QOwW2QxXRtV605ldrRC0y2yWD_xVxbngoa3RNB6fe-_xeNu_yPIk_ZmTyJI6qlY8SvM70gEJndLwFW_mJkXurgl-LK-SndGMHYm93TEDoei0lIs81TuBK1YeiMrhMwM_ve8G_FfxrVhPLCuY43ApqwVtS-MSLQ2gywPOg2K8NIN1OY71fzJaHrZHQq4AKUimXUsJSNVoBeLDE6mVxu1V3gOEvA6JqVEVeOkLpo-VuBO770RgKqIRS6ypp__ZRoGdxFJhL6usvIwQeHaaOewisqOj-yQC0yxyMvMmpPApsVzzSsqYM59ABbXkZlfZT4S6_jWkQUqty_HUMQyOUa_8a2C3Xrm4-CNB_WEPLjpAdcDTB6yOWX_7D1vum4YZBEnXGEfDC48J945Kxq5rsQ_BOzGIeSecQS8u_zbcQF0AkcvaUTXNrHZgSLLCwA7mPnyfIRpK-2dqtVXJAaDBmorMfCHACek9AqC1Z3PIUKVKPSiCVC5TmApBgsrWvto_LwknV7X7rbQVQHARn0ux1fPMNZD5EgbU3eDqShp0yGyuC8Pih7zEClDe9TnmQtKvJ3gFo3NrB_gROMIW7u110aeghQ8Wm1HkUNz1EBYkzgHZhKDh0crDxEY8SjUYKLBw-ebCrqEpoPzbJ95I-276M7l_ynwlpTeoPKJQuddIQsEhnursT5A5AaJSFTgya6vP2BlqvAV0U8TryFeJDlOGp8dYdBXNhHL3Xk6IDfNZuhB2PN-uC1mh9-elDkj9Pv7ZU8Lmlad9CHytfS7pFhY2QW2dElcQpIpL1ki3YYY7emAqexefGI-ONXl47CzRUtTbXOlTXWb99KPhTNpzRRis6DwP9OPyvr-NzSC8_0zQQXotjiuig_DsJChzd3HEmXAlP1cGAIybY3LmYvO32-J9d8GibW1wPdHyB2VOQuYqwLKwJbAtcoEQ3H1Jnd2Pc3E1zEVtxg2GVwQSD5HmYc3DNHgRrRN46PJQMmflNdjzX6HQ4SZ-zxJ-cYJ_iVbU-YYskrq4IwD7friTfIquoPw58XXq-6d91dpwDNvveTGl_LX0tiMsmjawt9z549EL8Yvvnui_brQw0VaNhCvaUV3ig0nHlioUJRCL-dkkJz3uH9ny1sGHrJaBzkHwzx0BDvR9-_CX2ARrDFdnJiMRAwWVglv4FQWxlZ7w0vjlG5G17zNqQCMQItk4107lxWLft5HEuHENJefu9o4D3z_318-ePh6wS1n3cXhiZ_cZ4DuVQOdaWC-4_bxKv3u0s64_d_R6HS0aQlRGv5wP8NILG056BbYb8fhEhG9sKfUHbsoKUXHO8eHj33oExrcXeeR7HWa4n7u4KYbGRoPFArk-ZAejRn-whcuIPtYs1xLxomSGVMSsIvwP17o3AWpHXiJWTicUG0jOpKDQ9giqFTKcptHZAacWlcRungFTK8Xeu6R3QdbDsYA1wefGD6Dc_hJhOTBu10gselvpfJnUOCfwqYnFZ6fa28QWuwkI7V72fJPkAvZCTCG8cP8vEGlJqZww_CAyGbA_spgPtF446wlCB4DOmtfjMS-z2ATI5XYUsukCZabAYjb1hOmNzDEQe5mFra6v-8cPaeRNu7HBqmv9W9zy7oVRIpbaDJ32dVR0cc7JOWtlDkyUR6w58YH9HsPM54rMl5TYsxH9t9bECbisUfxJreExgSN_FMtp-8W_rbaysfaN-aG36HuaHp2w9nYydgVhVARmw5I8Mrsj5j9dFgqnW6vZhoHiN_0-mGBz8ssCq-T9yB5oOz2nYrgLiSBPBYZ-g4nCYq8BjI7zQ5Di7db8sSDgJp8_iC1YgfkHQMR9IThGP4spVS3cC7N97OztOFIPD_sbJxfMm0eFEiXYZTeHlOh5Dg7I9Si84DgJgDnP8vyflT1nMBRIuybYK6eXbO6gWIzGxcpIEAr8qEnamFaP4wfSbhUJqdbCr8C8pbkQLHt9HSUpQqvGlXjUp75HpczVEIX1Acm7eiPJ4Pu140JOgijylb0tvFBvl7IYtfY2zjQTOD9xSTK_NPZFy3UBrySSGdq-UqhVYSMPNXHf9fd069KnxrR6KMf-WNG4m0HGTLwuB4B5oLqhs-6YA3AixcK9fMda6nhnE69CmHzHmfmIJgDX6jisSpThylUrYN0oVsvhh1Ywg-xa2S1mFiJGnvRNH2yVDsA_ZnyyyMG77exyaL1Z37IC5egVm50QVJwfDGZcF4s0rB1Y2J69QFD64KChvtsK7Y7y3l1rOl3YWwy2dKEv5miZROmZ-G_4HJcQdQvzrZADwvESSbOuL6SWFNvF3h8NEPgZFg1OWus-7fybhOgNbXtRtCEu00tyvUsrHOn17-6tsXooMQe6rVdYRXvFxM_C3hQTKF9OexpnzWvTx8aAtGPy60uxLWYWIkae9E0fbJUOwD9mfLLIwbvt7HJovVnfsgLl6BWbnRBUnB8MZlwXizSsHVjYnr1AUPrgoKG-2wrtjvLeXWs6XdhbDLZ0oS_maJlE6Zn4b_gclxB1C_OtkAPC8RJJLQUdSGjPlvCeEpxC2eeXOmMj_LS411prmEak3KxoOSzdtD2Szf8opHLjfRrnPU6cQpuBjFB4GWF3QUYEgmRZmsyObCxknHXN0h33ZlE1V83UfQBWg-W2aSJMTUpcuSx_q2anInpOzPbTsU6zx_tSeCEvJQGagSusSK0j5JZlDADrziCrjbGTsgUzB7V1qh1Wvv-0v6wW5W-ypiDVm3P6PTr9_uk0OwMeW0ZsucyQ2UHCEIYIIi1GfrsqsS1BUO3c06HZGSSyQMWSlyebUgUVjAYtNDex-qMXmZuBm_FKa6HaURMW8jCANk79PwrQh9dh9EBHjVkcutfeZV1byFopbZmXF0TLbOOlxfi_Qta7LSMKfj8DAn0Tx4X9S_RJP6xPHuMeLVYdtA__nM7ZQTJxjix1zv4wFWXvRw8fTEh351lwNoHiaQY1fujsLmKu_ntQetPTaXWGpj7_9iN5RdVXCTDRvJ9MgPCtFco6fWWdlCh4NoCa3U5W6_6Kg0dmqq0b3y8zh6gBD3vm9eVhDdFdw9hV6Fq-CcyWFxe50OtPS8pPAk8m10nBue5ToQAPZuD4wGP1sfq9cAQ2_SnAw6-BHwkies62dTJcpWI2j2z3SlO880qL8NVDscaPKnL6eK0msFRYUKysx4511Avj3kpTf0a50JsgSHCL5Ji-MO2gpD2SULwXw3XwNF6K6HdKbbMwox3epNPSqCdxZlYxVYlQMkS80mzCs2NygcuAG1JHFNO25jCj2udPgrZ0ZVctZawGBvxBf5kITz3kXUcW9y20J6XBNJnWcjKcyX_8qfJI-HW5WHYwjGcbQt0OAfjGpPfkaaGhtVxLslXU5ZIaH24Z9AhW-DhF-MtSGYHp_My6NApz90AspfaCf0pXkkDK7HfjznbMAeg4Z79fh3Grv_6Nz$AES$SHA512';
    /*商户私钥*/
    $private_Key='MIIEpAIBAAKCAQEAhWf5Bkq9+JsHDQkqEV8be+0Zm6AjU/6w7dw8c7iDDh3F1Q9cJkSb3MBrxD0HFQSF/Lh65Yj8U041hYi4mDs9sYLfoIZEVpXgOXd2OLsPJR/pFl32xpQddsRznMyyEsoQPPBg782dgP3Ly0QWJmfulpOzDSA6DTO3Q+aeySMiYs/VR1pr0Z4yrSvZCTyP+xFH8zys2uUxIG/LsUSsaivy9M/0WyNMG7caWc6oblWMqdcbk9wv0Ry0BRxIUGzl63tYNUf8Z1TqDpFAsG4C4+JZGSRNDCnFVAh4GcnJsRqpyDwqnaB1mbF9W+8Zoh4sOLmR+V0HjzIrB3AzS9wvIlCHFQIDAQABAoIBABPo+ZSD0ShqUroSVRH0pNBxCXJdiwg9KcDGLsuCjSStMtpiiXk4oh5nJW5LQWRUoX6fNdBOCoKQWJKOXiZyKPn2M1Ps1gQqKCXLe3xqBo+e3JW2/l6SuncASNTtA+Kj/5posb74a/pVZnX2umuO9V/JuV5LIf7YahCbObWBJd+jNiUgXYpwDB5GsosjvYoE/Limc41vmrnvpTV6s9WiipJO+P6zm4xEJqPEgFJ6QjX7NkkyN4sPvbDGB5hz/97LT3H+aAWvjEwDj4Z85irOkBnEW9BWn2vM2fLoA4cmGhROZ81SSMTzX/O7wrqXDVUyQzcMa7FIzF9QXd9tyjzqwEECgYEA7XGbClhgjLt5cuZCO4UraU07FnjIxKe+d3vBEuy3bJWtKu3AvVZ0WTsQVorbilQi4zxClkoUVku5G+uXhvljn4CZunApufLucX6ZfF20oQqik4gjmDGpvJFrfT09Z5S6ENXIKZAJXmTfgg/1tnlPT/Il2XghZt0D/4j9Pa+0OdECgYEAj9Ty8149qOteJvV0in0A1bue6MDT5L/SWxAqz9fLkk9/ChVmr8CIAtfWKUtlKEDinj/6hp+F+k4O9u+CeM9okHGGL6RQzJvjarbo5bKTTK+DH3ErAh7hwxpjuzaaP88K9R6AiTLFYpgB5DJlZKZuJZ9D4X0nflve42OBLF8IhgUCgYEA7UbwyybD3P7ff62QFFCgsAsIeA1de/+w+0/FAjdhmPX95X9PcyW5AQ5f5ku+1f38Gx414F/I8O+c3MTSWIRRRKxLcx7w46xbETmVAc3WWnP5QPrzrvw6BYFAbBfNi/v48CfibX5NjnG5VQzD24RgeKCfqDE/F77XZv2rK4Cw1nECgYBU48JgkQajZAc1xzj5Y73SZ+HqTaTCJdTpmikqcprbx7+bG/Z3VJLx2qGzzaPulh0qeWhLfGt+yANdCw9ebkuwtNAV3k0x9e/LVBkxOKxnXk9th0VzAvcMR88E970iW/iDo3UJhMWq4zx6iqP9O51W5yERPOTKVz69xkS/A3fsYQKBgQC4tYGtRYaZN5RbR9BTIoeuCJKD6qDf89xeEKLpvwIe62JVlqDW3uo7cLVOqlzV59dtuMpEC+L9NdLyb+6Fs/tOuSaT1DK8na3BOYzPWgrBPdz1sjsrRcxsVNPKU9byxMJWU0YGq5ZVUPT3w1S/Bw530SxHnheKOzEQSQZ/KXt5Bg==';
    /*YOP公钥*/
    $yop_public_Key='MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4g7dPL+CBeuzFmARI2GFjZpKODUROaMG+E6wdNfv5lhPqC3jjTIeljWU8AiruZLGRhl92QWcTjb3XonjaV6k9rf9adQtyv2FLS7bl2Vz2WgjJ0FJ5/qMaoXaT+oAgWFk2GypyvoIZsscsGpUStm6BxpWZpbPrGJR0N95un/130cQI9VCmfvgkkCaXt7TU1BbiYzkc8MDpLScGm/GUCB2wB5PclvOxvf5BR/zNVYywTEFmw2Jo0hIPPSWB5Yyf2mx950Fx8da56co/FxLdMwkDOO51Qg3fbaExQDVzTm8Odi++wVJEP1y34tlmpwFUVbAKIEbyyELmi/2S6GG0j9vNwIDAQAB';
    //还原出原文
    $response = YopSignUtils::decrypt($source, $private_Key, $yop_public_Key);

    print_r($response);
}

//非对称RSA签名
function T5(){
    //需要签名的原文内容
    $originaltext='MyData';
    /*商户私钥*/
    $private_Key='MIIEpAIBAAKCAQEAhWf5Bkq9+JsHDQkqEV8be+0Zm6AjU/6w7dw8c7iDDh3F1Q9cJkSb3MBrxD0HFQSF/Lh65Yj8U041hYi4mDs9sYLfoIZEVpXgOXd2OLsPJR/pFl32xpQddsRznMyyEsoQPPBg782dgP3Ly0QWJmfulpOzDSA6DTO3Q+aeySMiYs/VR1pr0Z4yrSvZCTyP+xFH8zys2uUxIG/LsUSsaivy9M/0WyNMG7caWc6oblWMqdcbk9wv0Ry0BRxIUGzl63tYNUf8Z1TqDpFAsG4C4+JZGSRNDCnFVAh4GcnJsRqpyDwqnaB1mbF9W+8Zoh4sOLmR+V0HjzIrB3AzS9wvIlCHFQIDAQABAoIBABPo+ZSD0ShqUroSVRH0pNBxCXJdiwg9KcDGLsuCjSStMtpiiXk4oh5nJW5LQWRUoX6fNdBOCoKQWJKOXiZyKPn2M1Ps1gQqKCXLe3xqBo+e3JW2/l6SuncASNTtA+Kj/5posb74a/pVZnX2umuO9V/JuV5LIf7YahCbObWBJd+jNiUgXYpwDB5GsosjvYoE/Limc41vmrnvpTV6s9WiipJO+P6zm4xEJqPEgFJ6QjX7NkkyN4sPvbDGB5hz/97LT3H+aAWvjEwDj4Z85irOkBnEW9BWn2vM2fLoA4cmGhROZ81SSMTzX/O7wrqXDVUyQzcMa7FIzF9QXd9tyjzqwEECgYEA7XGbClhgjLt5cuZCO4UraU07FnjIxKe+d3vBEuy3bJWtKu3AvVZ0WTsQVorbilQi4zxClkoUVku5G+uXhvljn4CZunApufLucX6ZfF20oQqik4gjmDGpvJFrfT09Z5S6ENXIKZAJXmTfgg/1tnlPT/Il2XghZt0D/4j9Pa+0OdECgYEAj9Ty8149qOteJvV0in0A1bue6MDT5L/SWxAqz9fLkk9/ChVmr8CIAtfWKUtlKEDinj/6hp+F+k4O9u+CeM9okHGGL6RQzJvjarbo5bKTTK+DH3ErAh7hwxpjuzaaP88K9R6AiTLFYpgB5DJlZKZuJZ9D4X0nflve42OBLF8IhgUCgYEA7UbwyybD3P7ff62QFFCgsAsIeA1de/+w+0/FAjdhmPX95X9PcyW5AQ5f5ku+1f38Gx414F/I8O+c3MTSWIRRRKxLcx7w46xbETmVAc3WWnP5QPrzrvw6BYFAbBfNi/v48CfibX5NjnG5VQzD24RgeKCfqDE/F77XZv2rK4Cw1nECgYBU48JgkQajZAc1xzj5Y73SZ+HqTaTCJdTpmikqcprbx7+bG/Z3VJLx2qGzzaPulh0qeWhLfGt+yANdCw9ebkuwtNAV3k0x9e/LVBkxOKxnXk9th0VzAvcMR88E970iW/iDo3UJhMWq4zx6iqP9O51W5yERPOTKVz69xkS/A3fsYQKBgQC4tYGtRYaZN5RbR9BTIoeuCJKD6qDf89xeEKLpvwIe62JVlqDW3uo7cLVOqlzV59dtuMpEC+L9NdLyb+6Fs/tOuSaT1DK8na3BOYzPWgrBPdz1sjsrRcxsVNPKU9byxMJWU0YGq5ZVUPT3w1S/Bw530SxHnheKOzEQSQZ/KXt5Bg==';
    //对原文进行签名的结果
    $response = YopSignUtils::signRsa($originaltext, $private_Key);

    print_r($response);
}

//Post请求 非对称秘钥P12(文件秘钥)
function T6(){
    /*商户秘钥文件存放的绝对路径*/
    $filepath="/Users/yp-tc-7176/Downloads/10015004197.p12";
    /*商户秘钥文件的打开密码*/
    $password="123456";

    /*商户私钥*/
    $private_key =YopSignUtils::getPrivateKey($filepath,$password);

    /*YOP公钥*/
    $yop_public_key = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4g7dPL+CBeuzFmARI2GFjZpKODUROaMG+E6wdNfv5lhPqC3jjTIeljWU8AiruZLGRhl92QWcTjb3XonjaV6k9rf9adQtyv2FLS7bl2Vz2WgjJ0FJ5/qMaoXaT+oAgWFk2GypyvoIZsscsGpUStm6BxpWZpbPrGJR0N95un/130cQI9VCmfvgkkCaXt7TU1BbiYzkc8MDpLScGm/GUCB2wB5PclvOxvf5BR/zNVYywTEFmw2Jo0hIPPSWB5Yyf2mx950Fx8da56co/FxLdMwkDOO51Qg3fbaExQDVzTm8Odi++wVJEP1y34tlmpwFUVbAKIEbyyELmi/2S6GG0j9vNwIDAQAB';

    $request = new YopRequest("regression-test", $private_key, $yop_public_key);
    //加入请求参数
    $request->addParam("request_flow_id", "12345678");//请求流水标识
    $request->addParam("name", "123");//请求流水标识
    $request->addParam("id_card_number", "370982199101186691");//请求流水标识
    //提交Post请求
    $response = YopClient3::post("/rest/v1.0/test/auth2/auth-id-card", $request);

    //取得返回结果
    print_r($response);
}

//文件上传请求 非对称秘钥
function upload_aes_old(){
    /*商户私钥*/
    $private_key ="MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCXsKWWClznZbdTwp9183e4Ygu/twbQhuS6LPpu/TZ+OFwwauvIZnOyKu+rFh6apKyVxiLEkssnTsBjLjUIlypEGU2SdLGkswWAPvVdunLjjWEz37W2w4VNkGf8bGCQ9fIxMynoBCTeeWcQz896e1y2p5YZHygUhXGLM/9q5mr3iQQgrEPdFEAdlfLexkbVIF2bS02NsDFLNvqKNk7219cefxWPgJfN7RukUIZyy4nbeevbMAAFpNUFh1NlAh4qzwocOfbZ3NgtwJDf29jibpM3dacS7tqYGwpeGpKazS9tZgTAYcX2kLT7s+G6vVzVQR61pvvDs5ubyfsw/KFR8KDDAgMBAAECggEAShSE6Z+p+4AbZhaYVbxPbYbEgh5af6BBOAMbUvTqlf3kV+j/uWD/g7WgUod87r0ZZBPdiu69tDarkkRQth9NDvDkh2/iCbM8LoOQxPN3hFXZcMICNn2KLnUls4siJelXHFwGTT8o2lWj1fwHMaPphXKWxTIIGu2IpBkC1iwtdTF8mqe2HH+H2djBE96JXVZIf3/FgGu8ppmXa/xG4DfrTxFnGEJzgaadT3Z+ybXbqjYgFgmmBnZOaTx1XPQfLGQVYJz9BunDhwhrqBUM+QuLr1jUsMsj/Yud52cNXjwq9z8FfkKUdVVfE4VrzH8JpKKk7Vim7RWBQER29jlEnV+ysQKBgQDjMWxZz4AveXxWSx7MgXN9PEzxzmGWSApseDskSi5PAmXa4ut5XyNJUiGJ8Zf+cssPfWFNtB7suJBuoMTtrQSap2tgoo70y7QSO0ZlZ0v5Ny9LYh8oHvDgBJVNmS5HWv1U1/VHxNHczNmQ05smXNo1bzMYe5Xo10J2W47UUTgOHwKBgQCq7G6B5RfD+O1jdmYWlilh5oi1XGdYJGnzhs9DmAUN5plQ3VxpUFxxQCgOwXCskfT9QUVYhsIpQIs2iCylwuNDuxxiEQyRpeBirRaqmxvosv08Trwsr1Vs/Cuh17ZZOS+OUehN0fDZCiruK4e2btVfv8LlE1KMuoiUsn1X2gWQ3QKBgCyqBrcRSA4NQBhm5EMoH+A6/pV7EUxOFV6FtHrJ6pi1y/hgLBLMVU+Qye8og80OHEWLTJnOE1ZOYnadPJnNLd6Jk16IFrqhYWFELe65hAIWi0GypJVqn8gqnn+G4cY9aRhI7HuTgf56dzs1nobIMk3W8qCZizsfNn22OjobTX3ZAoGBAJsTusvF1IMs5g05DjTt9wvpQx3xgZ46I5sdNA3q7qMHFxGEVeUDUWw7Plzs61LXdoUU5FsGoUEWW3iVopSett3r9TuQpmu7KVO+IXOXGYJOa259LUQJrKMeRGQpuDtJpDknXXLFyRTSodLH0fEWrCecb7KxjlM6ptLrAshjemtNAoGBAMzGo6aNER8VZfET8Oy0i5G8aVBp6yrMiQsNOj4S1VPoHI+Pc6ot5rDQdjek9PRzF9xeCU4K7+KLaOs6fVmTfsFpPbDafCTTmos9LGr5FIyXpU7LQCl3QPHWPDd5ezsu9SPVjzsEPX3WTSOJuUA8hE7pJnAzMHLGAFpIXJRu3Z/y";

    /*YOP公钥*/
    $yop_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6p0XWjscY+gsyqKRhw9MeLsEmhFdBRhT2emOck/F1Omw38ZWhJxh9kDfs5HzFJMrVozgU+SJFDONxs8UB0wMILKRmqfLcfClG9MyCNuJkkfm0HFQv1hRGdOvZPXj3Bckuwa7FrEXBRYUhK7vJ40afumspthmse6bs6mZxNn/mALZ2X07uznOrrc2rk41Y2HftduxZw6T4EmtWuN2x4CZ8gwSyPAW5ZzZJLQ6tZDojBK4GZTAGhnn3bg5bBsBlw2+FLkCQBuDsJVsFPiGh/b6K/+zGTvWyUcu+LUj2MejYQELDO3i2vQXVDk7lVi2/TcUYefvIcssnzsfCfjaorxsuwIDAQAB";

    $request = new YopRequest("yop-boss", $private_key, $yop_public_key);
    //加入请求参数
    $request->addParam("fileType", "IMAGE");//文件类型
    $request->addParam("_file", "/Users/dreambt/Downloads/katon3.jpg");//请求流水标识
     //提交Post请求
    $response = YopClient3::upload("/rest/v1.0/file/upload", $request);

    //取得返回结果
    print_r($response);
}

// yos 文件上传请求 非对称秘钥
function upload_aes_yos(){
    /*商户私钥*/
    $private_key ="MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCXsKWWClznZbdTwp9183e4Ygu/twbQhuS6LPpu/TZ+OFwwauvIZnOyKu+rFh6apKyVxiLEkssnTsBjLjUIlypEGU2SdLGkswWAPvVdunLjjWEz37W2w4VNkGf8bGCQ9fIxMynoBCTeeWcQz896e1y2p5YZHygUhXGLM/9q5mr3iQQgrEPdFEAdlfLexkbVIF2bS02NsDFLNvqKNk7219cefxWPgJfN7RukUIZyy4nbeevbMAAFpNUFh1NlAh4qzwocOfbZ3NgtwJDf29jibpM3dacS7tqYGwpeGpKazS9tZgTAYcX2kLT7s+G6vVzVQR61pvvDs5ubyfsw/KFR8KDDAgMBAAECggEAShSE6Z+p+4AbZhaYVbxPbYbEgh5af6BBOAMbUvTqlf3kV+j/uWD/g7WgUod87r0ZZBPdiu69tDarkkRQth9NDvDkh2/iCbM8LoOQxPN3hFXZcMICNn2KLnUls4siJelXHFwGTT8o2lWj1fwHMaPphXKWxTIIGu2IpBkC1iwtdTF8mqe2HH+H2djBE96JXVZIf3/FgGu8ppmXa/xG4DfrTxFnGEJzgaadT3Z+ybXbqjYgFgmmBnZOaTx1XPQfLGQVYJz9BunDhwhrqBUM+QuLr1jUsMsj/Yud52cNXjwq9z8FfkKUdVVfE4VrzH8JpKKk7Vim7RWBQER29jlEnV+ysQKBgQDjMWxZz4AveXxWSx7MgXN9PEzxzmGWSApseDskSi5PAmXa4ut5XyNJUiGJ8Zf+cssPfWFNtB7suJBuoMTtrQSap2tgoo70y7QSO0ZlZ0v5Ny9LYh8oHvDgBJVNmS5HWv1U1/VHxNHczNmQ05smXNo1bzMYe5Xo10J2W47UUTgOHwKBgQCq7G6B5RfD+O1jdmYWlilh5oi1XGdYJGnzhs9DmAUN5plQ3VxpUFxxQCgOwXCskfT9QUVYhsIpQIs2iCylwuNDuxxiEQyRpeBirRaqmxvosv08Trwsr1Vs/Cuh17ZZOS+OUehN0fDZCiruK4e2btVfv8LlE1KMuoiUsn1X2gWQ3QKBgCyqBrcRSA4NQBhm5EMoH+A6/pV7EUxOFV6FtHrJ6pi1y/hgLBLMVU+Qye8og80OHEWLTJnOE1ZOYnadPJnNLd6Jk16IFrqhYWFELe65hAIWi0GypJVqn8gqnn+G4cY9aRhI7HuTgf56dzs1nobIMk3W8qCZizsfNn22OjobTX3ZAoGBAJsTusvF1IMs5g05DjTt9wvpQx3xgZ46I5sdNA3q7qMHFxGEVeUDUWw7Plzs61LXdoUU5FsGoUEWW3iVopSett3r9TuQpmu7KVO+IXOXGYJOa259LUQJrKMeRGQpuDtJpDknXXLFyRTSodLH0fEWrCecb7KxjlM6ptLrAshjemtNAoGBAMzGo6aNER8VZfET8Oy0i5G8aVBp6yrMiQsNOj4S1VPoHI+Pc6ot5rDQdjek9PRzF9xeCU4K7+KLaOs6fVmTfsFpPbDafCTTmos9LGr5FIyXpU7LQCl3QPHWPDd5ezsu9SPVjzsEPX3WTSOJuUA8hE7pJnAzMHLGAFpIXJRu3Z/y";

    /*YOP公钥*/
    $yop_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6p0XWjscY+gsyqKRhw9MeLsEmhFdBRhT2emOck/F1Omw38ZWhJxh9kDfs5HzFJMrVozgU+SJFDONxs8UB0wMILKRmqfLcfClG9MyCNuJkkfm0HFQv1hRGdOvZPXj3Bckuwa7FrEXBRYUhK7vJ40afumspthmse6bs6mZxNn/mALZ2X07uznOrrc2rk41Y2HftduxZw6T4EmtWuN2x4CZ8gwSyPAW5ZzZJLQ6tZDojBK4GZTAGhnn3bg5bBsBlw2+FLkCQBuDsJVsFPiGh/b6K/+zGTvWyUcu+LUj2MejYQELDO3i2vQXVDk7lVi2/TcUYefvIcssnzsfCfjaorxsuwIDAQAB";

    $request = new YopRequest("yop-boss", $private_key, $yop_public_key);

    //加入请求参数
    $request->addFile("file", "/Users/dreambt/Yeepay/yop-sdk/yop-php-sdk/README.md");

    //提交Post请求
    //$response = YopRsaClient::upload("/yos/v1.0/hbird/magic-cube-material/upload", $request);
    $response = YopRsaClient::upload("/yos/v1.0/test123/auth2/auth-id-card", $request);

    //取得返回结果
    print_r($response);
}

// yos 文件下载请求 非对称秘钥
function down_aes_yos(){
    /*商户私钥*/
    $private_key ="MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCXsKWWClznZbdTwp9183e4Ygu/twbQhuS6LPpu/TZ+OFwwauvIZnOyKu+rFh6apKyVxiLEkssnTsBjLjUIlypEGU2SdLGkswWAPvVdunLjjWEz37W2w4VNkGf8bGCQ9fIxMynoBCTeeWcQz896e1y2p5YZHygUhXGLM/9q5mr3iQQgrEPdFEAdlfLexkbVIF2bS02NsDFLNvqKNk7219cefxWPgJfN7RukUIZyy4nbeevbMAAFpNUFh1NlAh4qzwocOfbZ3NgtwJDf29jibpM3dacS7tqYGwpeGpKazS9tZgTAYcX2kLT7s+G6vVzVQR61pvvDs5ubyfsw/KFR8KDDAgMBAAECggEAShSE6Z+p+4AbZhaYVbxPbYbEgh5af6BBOAMbUvTqlf3kV+j/uWD/g7WgUod87r0ZZBPdiu69tDarkkRQth9NDvDkh2/iCbM8LoOQxPN3hFXZcMICNn2KLnUls4siJelXHFwGTT8o2lWj1fwHMaPphXKWxTIIGu2IpBkC1iwtdTF8mqe2HH+H2djBE96JXVZIf3/FgGu8ppmXa/xG4DfrTxFnGEJzgaadT3Z+ybXbqjYgFgmmBnZOaTx1XPQfLGQVYJz9BunDhwhrqBUM+QuLr1jUsMsj/Yud52cNXjwq9z8FfkKUdVVfE4VrzH8JpKKk7Vim7RWBQER29jlEnV+ysQKBgQDjMWxZz4AveXxWSx7MgXN9PEzxzmGWSApseDskSi5PAmXa4ut5XyNJUiGJ8Zf+cssPfWFNtB7suJBuoMTtrQSap2tgoo70y7QSO0ZlZ0v5Ny9LYh8oHvDgBJVNmS5HWv1U1/VHxNHczNmQ05smXNo1bzMYe5Xo10J2W47UUTgOHwKBgQCq7G6B5RfD+O1jdmYWlilh5oi1XGdYJGnzhs9DmAUN5plQ3VxpUFxxQCgOwXCskfT9QUVYhsIpQIs2iCylwuNDuxxiEQyRpeBirRaqmxvosv08Trwsr1Vs/Cuh17ZZOS+OUehN0fDZCiruK4e2btVfv8LlE1KMuoiUsn1X2gWQ3QKBgCyqBrcRSA4NQBhm5EMoH+A6/pV7EUxOFV6FtHrJ6pi1y/hgLBLMVU+Qye8og80OHEWLTJnOE1ZOYnadPJnNLd6Jk16IFrqhYWFELe65hAIWi0GypJVqn8gqnn+G4cY9aRhI7HuTgf56dzs1nobIMk3W8qCZizsfNn22OjobTX3ZAoGBAJsTusvF1IMs5g05DjTt9wvpQx3xgZ46I5sdNA3q7qMHFxGEVeUDUWw7Plzs61LXdoUU5FsGoUEWW3iVopSett3r9TuQpmu7KVO+IXOXGYJOa259LUQJrKMeRGQpuDtJpDknXXLFyRTSodLH0fEWrCecb7KxjlM6ptLrAshjemtNAoGBAMzGo6aNER8VZfET8Oy0i5G8aVBp6yrMiQsNOj4S1VPoHI+Pc6ot5rDQdjek9PRzF9xeCU4K7+KLaOs6fVmTfsFpPbDafCTTmos9LGr5FIyXpU7LQCl3QPHWPDd5ezsu9SPVjzsEPX3WTSOJuUA8hE7pJnAzMHLGAFpIXJRu3Z/y";

    /*YOP公钥*/
    $yop_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6p0XWjscY+gsyqKRhw9MeLsEmhFdBRhT2emOck/F1Omw38ZWhJxh9kDfs5HzFJMrVozgU+SJFDONxs8UB0wMILKRmqfLcfClG9MyCNuJkkfm0HFQv1hRGdOvZPXj3Bckuwa7FrEXBRYUhK7vJ40afumspthmse6bs6mZxNn/mALZ2X07uznOrrc2rk41Y2HftduxZw6T4EmtWuN2x4CZ8gwSyPAW5ZzZJLQ6tZDojBK4GZTAGhnn3bg5bBsBlw2+FLkCQBuDsJVsFPiGh/b6K/+zGTvWyUcu+LUj2MejYQELDO3i2vQXVDk7lVi2/TcUYefvIcssnzsfCfjaorxsuwIDAQAB";

    $request = new YopRequest("yop-boss", $private_key, $yop_public_key);

    //加入请求参数
    $request->addFile("file", "/Users/dreambt/Yeepay/yop-sdk/yop-php-sdk/README.md");

    //提交Post请求
    $response = YopRsaClient::get("/yos/v1.0/test123/auth2/auth-id-card", $request);

    //取得返回结果
    print_r($response);
}

get_aes();
//post_aes();

//get_rsa();
//post_rsa();

//④结果通知返回原文数据
//T4();

//⑤非对称RSA签名
//T5();

//⑥Post请求 非对称秘钥P12(文件秘钥)
//T6();

//upload_aes_old();
//upload_aes_yos();

//down_aes_yos();
