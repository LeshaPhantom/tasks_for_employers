<? include 'config.php';
if (isset($_COOKIE['access_token'])) {
	$display = 'style="display:none"';
	$container = '';





} else {
$display = '';
$container = 'style="display:none"';

}
        $params = array(
            'user_id'         => $_COOKIE["user_id"],
            'order'	=> 'random',
            'count' => '5',
            'fields' => 'photo_200_orig',
            'access_token' => $_COOKIE["access_token"] ,
            'v' => '5.92'
            );
$userinfo = json_decode(file_get_contents('https://api.vk.com/method/users.get'.'?'.urldecode(http_build_query($params))), true);


$userfriend = json_decode(file_get_contents('https://api.vk.com/method/friends.get'.'?'.urldecode(http_build_query($params))), true);
$userfriend = $userfriend['response'];   
$userfriend = $userfriend['items'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест</title>
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a class="btnflip" href="https://oauth.vk.com/authorize?client_id=<?=ID?>&display=page&redirect_uri=<?=URL?>&scope=offline&response_type=code&v=5.92" <?=$display?>>
        <span class="btnflip-item btnflip__front">Авторизуйся</span>
        <span class="btnflip-item btnflip__center"></span>
        <span class="btnflip-item btnflip__back">Вконтакте</span>
    </a>

    <div <?=$container?>>


    
            <h1>Привет, <?=$userinfo['response'][0]["first_name"]?></h1>
        <div class="content">
            <?
for ($i = 0; $i <= 4; $i++) {
    echo '<div class="friend">
    		<a href="https://vk.com/id'.$userfriend[$i]["id"].'">
            <img src="'.$userfriend[$i]["photo_200_orig"].'" alt="photo_200_orig" class="img-thumbnail border-bottom border-left">
            <h4 class="friends_user">'.$userfriend[$i]["first_name"].'</h4>
            <h4>'.$userfriend[$i]["last_name"].'</h4>
            </a>
        </div>';
}
?>
        </div>
        <div class="button-container">
            <a href="http://cp15401.tmweb.ru">Ещё раз</a>
        </div>
        <div class="button-container">
            <a href="/vk.php?del=true">Выход</a>
        </div>

    </div>


</body>

</html>
