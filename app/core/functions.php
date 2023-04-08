<?php

defined('ROOTPATH') OR exit('Access Denied!');

// check for php extensions are active or not
checkExtentions();
function checkExtentions() {
    $required_extensions = [
        'gd',
        'mysqli',
        'pdo_mysql',
        'pdo_sqlite',
        'curl',
        'fileinfo',
        'intl',
        'exif',
        'mbstring',
    ];

    $not_loaded = [];

    foreach ($required_extensions as $ext) {
        // code...
        if (!extension_loaded($ext)) {
            // code...
            $not_loaded[] = $ext;
        }
    }

    if (!empty($not_loaded)) {
        // code...
        cout("Please load the following extensions in you php.ini file: <br>" . implode("<br>", $not_loaded));
    }
}

// Dump and die data
function dnd($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	die();
}

// 
function cout($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

// Make Date Readable
function pretty_date($date){
	return date("M d, Y h:i A", strtotime($date));
}

// GET DATE
// 00th March, 2023. 
function get_date($date) {
    return date("jS M, Y", strtotime($date));
}

// Display money in a readable way
function money($number) {
	return '$' . number_format($number, 2);
}

// escape javascripts
function esc($str) {
	return htmlspecialchars($str);
}

// Check For Incorrect Input Of Data
function sanitize($dirty) {
    $clean = htmlentities($dirty, ENT_QUOTES, "UTF-8");
    return trim($clean);
}

function cleanPost($post) {
    $clean = [];
    foreach ($post as $key => $value) {
      	if (is_array($value)) {
        	$ary = [];
        	foreach($value as $val) {
          		$ary[] = sanitize($val);
        	}
        	$clean[$key] = $ary;
      	} else {
        	$clean[$key] = sanitize($value);
      	}
    }
    return $clean;
}


// REDIRECT PAGE
function redirect($url) {
    if(!headers_sent()) {
      	header("Location: {$url}");
    } else {
      	echo '<script>window.location.href="' . $url . '"</script>';
    }
    exit;
}

function issetElse($array, $key, $default = "") {
    if(!isset($array[$key]) || empty($array[$key])) {
      return $default;
    }
    return $array[$key];
}


// Email VALIDATION
function isEmail($email) {
	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
}

// GET USER IP ADDRESS
function getIPAddress() {  
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  // whether ip is from the proxy
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     } else {  // whether ip is from the remote address 
        $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}

// GET IMAGE
// check if image exist else load placeholder
function getImage(mixed $file = '', string $type = 'post'):string {
    $file = $file ?? '';
    if (file_exists($file)) {
        // code...
        return PROOT . $file;
    }

    if ($type == 'user') {
        // code...
        return PROOT . "assets/media/user.jpg";
    } else {
        return PROOT . "assets/media/no_image.jpg";
    }
}

// PRINT OUT RANDAM NUMBERS
function digit_random($digits) {
  	return rand(pow(10, $digits - 1) - 1, pow(10, $digits) - 1);
}

function js_alert($msg) {
	return '<script>alert("' . $msg . '");</script>';
}

// Return paginations links
// :array - must return an array
function get_pagination_vars():array {
    $vars = [];
    $vars['page']       = $_GET['page'] ?? 1;
    $vars['page']       = (int)$vars['page'];
    $vars['prev_page']  = $vars['page'] <= 1 ? 1 : $vars['page'] - 1;
    $vars['next_page']  = $vars['page'] + 1;

    return $vars;
}

// Saves or display a saved message to the user
function message(string $msg = null, bool $clear = false) {
    $ses = new Core\Session();

    if (!empty($msg)) {
        // code...
        $ses->set('message', $msg);
    } else if (!empty($ses->get('message'))) {
        $msg = $ses->get('message');

        if ($clear) {
            // code...
            $ses->pop('message');
        }
        return $msg;
    }

    return false;
}

// return checkboxes value
function old_checked(string $key, string $value, string $default = ''):string {
    if (isset($_POST[$key])) {
        // code...
        if ($_POST[$key] == $value) {
            // code...
            return ' checked ';
        }
    } else {
        if ($_SERVER['REQUEST_METHOD'] == "GET" && $default == $value) {
            // code...
            return ' checked ';
        }
    }
    return '';
}

// get or posted old text value input
// eg;
// <input value="old_value('email')">
// eg; with default value
// <input value="old_value('email', 'email@email.com')">
function old_value(string $key, mixed $default = "", string $mode = 'post'):mixed {
    $POST = ($mode == 'post') ? $_POST : $_GET;
    if (isset($POST[$key])) {
        // code...
        return $POST[$key];
    }

    return $default;
}

// get the old selected value
function old_select(string $key, mixed $value, mixed $default = "", string $mode = 'post'):mixed {
    $POST = ($mode == 'post') ? $_POST : $_GET;
    if (isset($POST[$key])) {
        // code...
        if ($POST[$key] == $value) {
            // code...
            return " selected ";
        }
    } else if ($default == $value) {
        return " selected ";
    }

    return '';
}

// returns url viables
function URL($key):mixed {
    $URL = $_GET['url'] ?? 'home';
    $URL = explode("/", trim($URL, "/"));

    switch ($key) {
        case 'page':
        case 0:
            // code...
            return $URL[0] ?? null;
            break;
        case 'section':
        case 'slug':
        case 1:
            // code...
            return $URL[1] ?? null;
            break;
        case 'action':
        case 2:
            // code...
            return $URL[2] ?? null;
            break;
        case 'id':
        case 3:
            // code...
            return $URL[3] ?? null;
            break;
        default:
            // code...
            return null;
            break;
    }
}

// convert image paths from relative to absolute
function add_root_to_images($contents) {
    preg_match_all('/<img[^>]+>/', $contents, $matches);
    if (is_array($matches) && count($matches) > 0) {
        // code...
        foreach ($matches[0] as $match) {
            // code...
            preg_match('/src="[^"]/', $match, $matches2);
            if (!strstr($matches2[0], 'http')) {
                // code...
                $contents = str_replace($matches2[0], 'src="' . PROOT . str_replace('src="', "", $matches2[0]), $contents);
            }
        }
    }
    return $contents;
}

//  convert images from text editor content to actual files
function remove_images_from_content($content, $folder = "uploads/") {
    if (!file_exists($folder)) {
        // code...
        mkdir($folder, 0777, true);
        file_put_contents($folder . "index.php", "");
    }

    // remove image from content
    preg_match_all('/<img[^>]+>/', $content, $matches);
    $new_content = $content;

    if (is_array($matches) && count($matches) > 0) {
        // code...
        $image_class = new \Model\Image();
        foreach ($matches[0] as $match) {
            // code...
            if (strstr($match, "http")) {
                // code...
                // ignore images with links already
                continue;
            }

            // get the src
            preg_match('/src="[^"]+/', $match, $matches2);

            // get the filename
            preg_match('/data-filename="[^\"]+/', $match, $matches3);

            if (strstr($matches2[0], 'data:')) {
                // code...
                $parts = explode(",", $matches2[0]);
                $basename = $matches3[0] ?? 'basename.jpg';
                $basename = str_replace('data-filename="', "", $basename);

                $filename = $folder . "img_" . sha1(rand(0, 9999999999)) . $basename;

                $new_content = str_replace($parts[0] . "," . $parts[1], 'src="' . $filename, $new_content);
                file_put_contents($filename, base64_decode($parts[1]));

                // resize image
                $image_Class->resize($filename, 1000);
            }
        }
    }

    return $new_content;
}

// delete images from text editor content
function delete_images_from_content(string $content, string $content_new = ''):void {
    // delete images from content
    if (empty($content_new)) {
        // code...
        preg_match_all('/<img[^>]+>/', $content, $matches);

        if (is_array($matches) && count($matches) > 0) {
            // code...
            foreach ($matches[0] as $match) {
                // code...
                preg_match('/src="[^"]+/', $match, $matches2);
                $matches2[0] = str_replace('src="', "", $matches2[0]);

                if (file_exists($matches2[0])) {
                    // code...
                    unlink($matches2[0]);
                }
            }
        }
    } else {
        // compare old to new and delete from old what inst in the new
        preg_match_all('/<img[^>]+>/', $content, $matches);
        preg_match_all('/<img[^>]+>/', $content_new, $matches_new);

        $old_images = [];
        $new_images = [];

        // collect old images
        if (is_array($matches) && count($matches) > 0) {
            // code...
            foreach ($matches[0] as $match) {
                // code...
                preg_match('/src="[^"]+/', $match, $matches2);
                $matches2[0] = str_replace('src="', "", $matches2[0]);

                if (file_exists($matches2[0])) {
                    // code...
                    $old_images[] = $matches2[0];
                }
            }
        }

        // collect new images
         if (is_array($matches_new) && count($matches_new) > 0) {
            // code...
            foreach ($matches_new[0] as $match) {
                // code...
                preg_match('/src="[^"]+/', $match, $matches2);
                $matches2[0] = str_replace('src="', "", $matches2[0]);

                if (file_exists($matches2[0])) {
                    // code...
                    $new_images[] = $matches2[0];
                }
            }
        }

        // compare and delete all that dont appear in the new array
        foreach ($old_images as $img) {
            // code...
            if (!in_array($img, $new_images)) {
                // code...
                if (file_exists($img)) {
                    // code...
                    unlink($img);
                }
            }
        }
    }
}






