<?php
if (!defined('KS')) {
    die('Tidak boleh diakses langsung.');
}
function myPre($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

define('BOT_TOKEN', '1107717637:AAEdiYuxlIXI-EW7Ut4TKoxS9KiPyCe4DCY'); 
// versi official telegram bot
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
define('myVERSI','0.03');

$debug = false;
function exec_curl_request($handle) {
  $response = curl_exec($handle);
  if ($response === false) {
    $errno = curl_errno($handle);
    $error = curl_error($handle);
    error_log("Curl returned error $errno: $error\n");
    curl_close($handle);
    return false;
  }
  $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
  curl_close($handle);
  if ($http_code >= 500) {
    // do not wat to DDOS server if something goes wrong
    sleep(10);
    return false;
  } else if ($http_code != 200) {
    $response = json_decode($response, true);
    error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
    if ($http_code == 401) {
      throw new Exception('Invalid access token provided');
    }
    return false;
  } else {
    $response = json_decode($response, true);
    if (isset($response['description'])) {
      error_log("Request was successfull: {$response['description']}\n");
    }
    $response = $response['result'];
  }
  return $response;
}
function apiRequest($method, $parameters=null) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = API_URL.$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
  return exec_curl_request($handle);
}
function apiRequestJson($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  $parameters["method"] = $method;
  $handle = curl_init(API_URL);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
  curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
  return exec_curl_request($handle);
}
// jebakan token, klo ga diisi akan mati
if (strlen(BOT_TOKEN)<20) 
    die(PHP_EOL."-> -> Token BOT API nya mohon diisi dengan benar!\n");

//fungsi kirim pesan
function sendApiMsg($chatid, $text, $msg_reply_id = false, $parse_mode = true, $disablepreview = false)
{
    $method = 'sendMessage';
    $data = ['chat_id' => $chatid, 'text' => $text];
    if ($msg_reply_id) {
        $data['reply_to_message_id'] = $msg_reply_id;
    }
    if ($parse_mode) {
        $data['parse_mode'] = 'Markdown';
    }
    else{
        $data['parse_mode'] = 'HTML';
    }
    
    if ($disablepreview) {
        $data['disable_web_page_preview'] = $disablepreview;
    }
    
    $result = apiRequest($method, $data);
    return $result;
}

//kirim foto
function sendApiPhoto($chatid, $photo, $caption = null, $reply_to_message_id = null, $reply_markup = null)
{
    $method = 'sendPhoto';
    $data = ['chat_id' => $chatid, 
    'photo'  => $photo];
    $result = apiRequest($method, $data);
    return $result;
}


function sendApiAction($chatid, $action)
{
    $method = 'sendChatAction';
    $data = [
        'chat_id' => $chatid,
        'action'  => $action,
    ];
    $result = apiRequest($method, $data);
    return $result;
}

function sendApiKeyboard($chatid, $text, $keyboard = [], $inline = false, $msg_reply_id = false)
{
    $method = 'sendMessage';
    $replyMarkup = [
        'keyboard'        => $keyboard,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
    ];
    $data = [
        'chat_id'    => $chatid,
        'text'       => $text,
        'parse_mode' => 'Markdown',
    ];
    if ($msg_reply_id) {
        $data['reply_to_message_id'] = $msg_reply_id;
    }
    $inline
    ? $data['reply_markup'] = json_encode(['inline_keyboard' => $keyboard])
    : $data['reply_markup'] = json_encode($replyMarkup);
    $result = apiRequest($method, $data);
    return $result;
}

function editMessageText($chatid, $message_id, $text, $keyboard = [], $inline = false)
{
    $method = 'editMessageText';
    $replyMarkup = [
        'keyboard'        => $keyboard,
        'resize_keyboard' => true,
    ];
    $data = [
        'chat_id'    => $chatid,
        'message_id' => $message_id,
        'text'       => $text,
        'parse_mode' => 'Markdown',
    ];
    $inline
    ? $data['reply_markup'] = json_encode(['inline_keyboard' => $keyboard])
    : $data['reply_markup'] = json_encode($replyMarkup);
    $result = apiRequest($method, $data);
    return $result;
}

function sendApiHideKeyboard($chatid, $text)
{
    $method = 'sendMessage';
    $data = [
        'chat_id'       => $chatid,
        'text'          => $text,
        'parse_mode'    => 'Markdown',
        'reply_markup'  => json_encode(['hide_keyboard' => true]),
    ];
    $result = apiRequest($method, $data);
    return $result;
}

function sendApiSticker($chatid, $sticker, $msg_reply_id = false)
{
    $method = 'sendSticker';
    $data = [
        'chat_id'  => $chatid,
        'sticker'  => $sticker,
    ];
    if ($msg_reply_id) {
        $data['reply_to_message_id'] = $msg_reply_id;
    }
    $result = apiRequest($method, $data);
    return $result;
}

function deleteMsg($chatid, $msgid)
{
    $method = 'deleteMessage';
    $data = [
        'chat_id' => $chatid,
        'message_id'  => $msgid,
    ];
    $result = apiRequest($method, $data);
    return $result;
}

function sendLocation($chatid, $lat, $long, $msg_reply_id = false)
{
    $method = 'sendLocation';
    $data = [
        'chat_id' => $chatid,
        'latitude' => $lat,
        'longitude' => $long,
    ];
    if ($msg_reply_id) {
        $data['reply_to_message_id'] = $msg_reply_id;
    }
    $result = apiRequest($method, $data);
    return $result;
}
function kickChatMember($chatid, $user_id)
{
    $method = 'kickChatMember';
    $data = [
        'chat_id' => $chatid,
        'user_id' => $user_id,
    ];
    $result = apiRequest($method, $data);
    return $result;
}
function getChatMember($chatid, $user_id)
{
    $method = 'getChatMember';
    $data = [
        'chat_id' => $chatid,
        'user_id' => $user_id,
    ];
    $result = apiRequest($method, $data);
    return $result;
}
function pinChatMessage($chatid, $msg_id)
{
    $method = 'pinChatMessage';
    $data = [
        'chat_id' => $chatid,
        'message_id' => $msg_id,
    ];
    $result = apiRequest($method, $data);
    return $result;
}
function unpinChatMessage($chatid)
{
    $method = 'unpinChatMessage';
    $data = [
        'chat_id' => $chatid,
    ];
    $result = apiRequest($method, $data);
    return $result;
}
function getChatAdministrators($chatid)
{
    $method = 'getChatAdministrators';
    $data = [
        'chat_id' => $chatid,
    ];
    $result = apiRequest($method, $data);
    return $result;
}
function leaveChat($chatid)
{
    $method = 'leaveChat';
    $data = [
        'chat_id' => $chatid,
    ];
    $result = apiRequest($method, $data);
    return $result;
}

?>