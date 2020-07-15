<?
include 'config.php';




if ($_GET['del']) {
				setcookie("user_id", $token['user_id'],time()-1987200);
            setcookie("access_token", $token['access_token'],time()-1987200);
            header ('Location:'.RESPONS);
}

if (!$_GET['code']) {
	header ('Location:'.RESPONS);
} else {



$token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code']), true);

if (!$token) {
	exit('error token');
}


			setcookie("user_id", $token['user_id'],time()+1987200);
            setcookie("access_token", $token['access_token'],time()+1987200);
            header ('Location:'.RESPONS);

	}
?>