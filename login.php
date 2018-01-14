<?php
const inviteCode = 119497;
const dialcode = 86;

const destination = 'https://candy.one/i/119497';
$phone = '135' . mt_rand(1000, 9999) . mt_rand(1000, 9999);
$cookie = dirname(__FILE__) . '/candy';

for ($i = 0; $i < 1000; $i++) {
    $phone = '135' . mt_rand(1000, 9999) . mt_rand(1000, 9999);
    $cookie = dirname(__FILE__) . '/candy' . $phone . '.txt';
    $post = [
        'phone' => $phone,
        'status' => 'login',
        'dialcode' => dialcode,
        'enroll_id' => inviteCode,
    ];
    login_post(destination, $cookie, $post);
    sleep(2);
    get_content(destination, $cookie);
    echo '请求次数：第' . $i . '次,' . '手机号：' . $phone . PHP_EOL;
    sleep(2);

}

function login_post($url, $cookie, $post)
{
    $curl = curl_init();//初始化curl模块
    curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址
    curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);//是否自动显示返回的信息
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中
    curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息
    curl_exec($curl);//执行cURL
    curl_close($curl);//关闭cURL资源，并且释放系统资源
}

//登录成功后获取数据
function get_content($url, $cookie)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie
    $rs = curl_exec($ch); //执行cURL抓取页面内容
    curl_close($ch);
    return $rs;
}
