<?php 

function session($key){
 
    return array_get($_SESSION, $key);

    return null;
}

function user(){
    if(isset($_SESSION['user']))
        return $_SESSION['user'];

    return null;
}

function is_logged(){
    return App\Core\Session::check();
}

function redirect($url=null){
    $url = $url?$url:'/';

    header("Location: " . $url);

    exit;
}

function excerpt($string, $length=120){
    return substr(strip_tags(html_entity_decode($string)), 0, 100);
}

function sanitize_richtext($input){
    $input = strip_tags($input, "<i>,<strong>,<p>,<b>,<img>");

    // encode all html and special chars

    return htmlentities($input);
}

function sanitize_string($string){
    return filter_var(trim($string), FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
}

function form_value($key, $model=null){
    if(array_get($_SESSION, 'post.' . $key))
        return array_get($_SESSION, 'post.' . $key);

    if($model)
        return $model->$key;

    return '';
}

function validation_error($data, $url=null){
    $_SESSION['post'] = $data['post'];
    $_SESSION['error'] = $data;
}

function d($var){
	if(is_array($var) || is_object($var))
		return parr($var);
		
	var_dump($var);
}

function dd($var){
	die(d($var));
}

function parr($array){
	echo "<pre>"; var_dump($array); echo "</pre>";
}

function pat($d){
    echo '<pre>'; print_r($d->getAttributes()); echo '</pre>';
}

function value($value, $default=''){
	return isset($value)?$value:$default;
}

function config($key=false){
    return array_get(App\Core\Config::all(), $key);

}

function format_class_name($uf_class){
    $class = str_replace('_', ' ', $uf_class);

    $class =ucwords($class);

    $class = str_replace(' ', '', $class);

    return $class;
}

function array_get($array, $key, $default = null)
{
    if (is_null($key)) return $array;
    if (isset($array[$key])) return $array[$key];

    if(strpos($key, '.')===false) return [];
    foreach (explode('.', $key) as $segment)
    {
        if ( ! is_array($array) || ! array_key_exists($segment, $array))
        {
            return $default;
        }
        $array = $array[$segment];
    }
    
    return $array;
}

function view($file, $data = []){

    $file = str_replace('.', '/', $file);

    extract($data);

    ob_start();
        require dir_root . 'views/' . $file  . '.php';
        $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}

function inc($file){
    $file = str_replace('.', '/', $file);
    include dir_view . $file  . '.php';
}

function get_int($key, $default=false){
    return filter_input(INPUT_GET, $key, FILTER_VALIDATE_INT, [
        "options" => [
            "default" => $default
        ]
    ]);
}

function get_string($key, $default=false){
    return filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING, [
        "options" => [
            "default" => $default
        ]
    ]);
}

function get_array($key){
    return filter_input(INPUT_GET, $key, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
}

function post_int($key, $default=false){
    return filter_input(INPUT_POST, $key, FILTER_VALIDATE_INT, [
        "options" => [
            "default" => $default
        ]
    ]);
}

function post_string($key, $default=false){
    return filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING, [
        "options" => [
            "default" => $default
        ]
    ]);
}

function post_array($key){
    return filter_input(INPUT_POST, $key, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
}


function alpha_numeric($str,$ap=""){
    return preg_replace('/[^a-zA-z0-9'.$ap.']/i','',$str);
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function csrf_token_field(){
    return '<input type="hidden" name="token" value="' . session('_token') . '">';
}

function forbidden(){
    die('You must be logged in');
    exit;
}

function cout($m){
    echo "\n-------------------------\n";
    echo $m;
    echo "\n-------------------------\n";
}

function _o($m){
    echo "\n-------------------------\n";
    echo $m;
    echo "\n-------------------------\n";
}
