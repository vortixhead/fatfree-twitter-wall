<?php

// Kickstart the framework
$f3=require('lib/base.php');

// Twitter API
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;


$f3->set('UPLOADS','uploads/');

$f3->set('DEBUG',3);

// Database 

$f3->set('DB',
	new DB\SQL(
		'mysql:host=localhost;port=3306;dbname=twitter-wall',
		'root',
		''
		)
	);



if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

// Load configuration
$f3->config('config.ini');

$f3->route('GET /',
	function($f3) {
		$classes=array(
			'Base'=>
			array(
				'hash',
				'json',
				'session'
				),
			'Cache'=>
			array(
				'apc',
				'memcache',
				'wincache',
				'xcache'
				),
			'DB\SQL'=>
			array(
				'pdo',
				'pdo_dblib',
				'pdo_mssql',
				'pdo_mysql',
				'pdo_odbc',
				'pdo_pgsql',
				'pdo_sqlite',
				'pdo_sqlsrv'
				),
			'DB\Jig'=>
			array('json'),
			'DB\Mongo'=>
			array(
				'json',
				'mongo'
				),
			'Auth'=>
			array('ldap','pdo'),
			'Bcrypt'=>
			array(
				'mcrypt',
				'openssl'
				),
			'Image'=>
			array('gd'),
			'Lexicon'=>
			array('iconv'),
			'SMTP'=>
			array('openssl'),
			'Web'=>
			array('curl','openssl','simplexml'),
			'Web\Geo'=>
			array('geoip','json'),
			'Web\OpenID'=>
			array('json','simplexml'),
			'Web\Pingback'=>
			array('dom','xmlrpc')
			);
		$f3->set('classes',$classes);
		$f3->set('content','inicio.htm');
		echo View::instance()->render('layout.htm');
	}
	);

$f3->route('GET /userref',
	function($f3) {
		$f3->set('content','userref.htm');
		echo View::instance()->render('layout.htm');
	}
	);


$f3->route('GET /login',
	function($f3) {
		$f3->set('content','admin/login.html');
		echo \Template::instance()->render('admin/layout.html');
	}
	);

$f3->route('GET /logout',
	function($f3) {
		$f3->clear('SESSION');
		$f3->reroute('/login');
	}
	);

$f3->route('POST /login',
	function($f3) {
		//assign a mapper to the user table
		$user=new DB\SQL\Mapper($f3->get('DB'),'users');

		$username = $f3->get('POST.username');
		$password = $f3->get('POST.password');

		error_log('Datos ingresados: '.$username.' '.$password);
		// $f3->set('username',$f3->get('DB')->exec('SELECT * FROM users WHERE username=?', $username));


		$user->load(array('username=? AND password=?',$username,$password ));
		// error_log('Usuario encontrado: '.$user->username);

		if ($user->dry()){
			$f3->set('mensaje','El usuario o la contraseña es incorrecto.');
			$f3->reroute('/login');
		}else{
			F3::set('SESSION.user',$user->username);
			$f3->reroute('/admin');
		}
		
	}
	);


$f3->route('GET /admin',
	function($f3) {

		if (!$f3->get('SESSION.user')) $f3->reroute('/login');

		$images=new DB\SQL\Mapper($f3->get('DB'),'images');
		$images->load();
		$f3->set('img_count', $images->loaded());
		$f3->set('images',$f3->get('DB')->exec('SELECT * FROM images ORDER BY id DESC'));
		$f3->set('content','admin/tables.html');
		echo \Template::instance()->render('admin/layout.html');
	}
	);

$f3->route('GET /admin/buscar',
	function($f3) {

		if (!$f3->get('SESSION.user')) $f3->reroute('/login');

		$tw_consumer = UPDATE_THIS_TOKENS;
		$tw_consumer_secret = UPDATE_THIS_TOKENS;
		$tw_accesstoken = UPDATE_THIS_TOKENS;
		$tw_accesstoken_secret = UPDATE_THIS_TOKENS;
		$tw_connection = new TwitterOAuth($tw_consumer, $tw_consumer_secret, $tw_accesstoken, $tw_accesstoken_secret);
		$tweets = $tw_connection->get("search/tweets", ["q" => "%23dogs", "count" => "15"]);
		print_r($tweets);

		foreach ($tweets as $tweet) {
			foreach ($tweet as $t) {
				$media_url = $t->entities->media[0]->media_url;

				$imageURL=$media_url;
				//get extension of image
				$ext = pathinfo($imageURL, PATHINFO_EXTENSION);
				$destiny = 'uploads/file'.  rand(1, 9999).'.'.$ext ;
				$downloadTo = fopen($destiny, 'wb');
				//Download and save image
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $imageURL);
				curl_setopt($ch, CURLOPT_FILE, $downloadTo);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$output = curl_exec($ch);
				curl_close($ch);

				$datetime = new DateTime($t->created_at);
				$datetime->setTimezone(new DateTimeZone('America/New_York'));
				$datetime_formatted = $datetime->format('Y-m-d H:i:s');
				if($media_url!=''){
					$image=new DB\SQL\Mapper($f3->get('DB'),'images');
					$image->load(array('url=?', $media_url));
					if ($image->dry()){
						$image->title=$t->id;
						$image->url=$destiny;
						$image->category='twitter';
						$image->status='pendiente';
						$image->created=$datetime_formatted;
						$image->modified=$datetime_formatted;
						$image->save();
					} else {
						echo 'Ya existe la imagen';
					}
				}
			}
		}
		$f3->reroute('/admin');
	}
	);


$f3->route('POST /admin/subir',
	function($f3) {

		if (!$f3->get('SESSION.user')) $f3->reroute('/login');

	    $web = new \Web();
	  
		$overwrite = true; // set to true, to overwrite an existing file; Default: false
		$slug = true; // rename file to filesystem-friendly version
		$formFieldName = 'archivo';
		// $files = $web->receive(NULL,$overwrite,$slug);
		$files = $web->receive(function($file,$formFieldName){
		        var_dump($file);
		        $f3=Base::instance();
		        $image=new DB\SQL\Mapper($f3->get('DB'),'images');
		        $image_url = $file["name"];
		        $image_title = $file["name"];
		        $f3->set('current_time','Current date: {0,datetime}');

		        $image->title=$image_title;
		        // $image->title="asdasdas";
				$image->url=$image_url;
				// $image->url="asdasdasd";
				$image->category='manual';
				$image->status='aprobada';
				$image->created=$f3->get('var1',time());;
				// $image->modified=$datetime_formatted;
				$image->save(); 
		    },
		    $overwrite,
		    $slug
		);
	    var_dump($files);

		$f3->reroute('/admin');
	}
	);

$f3->route('GET /admin/aprobar/@id',

	function($f3) {

		$id = $f3->get('PARAMS.id');
		$image=new DB\SQL\Mapper($f3->get('DB'),'images');

		if ($id) $image->load(array('id=?',$id));

		$image->modified=date("Y-m-d H:i:s");
		$image->status="aprobada";
		$image->save();

		$f3->reroute('/admin');
	}
	);

$f3->route('GET /admin/rechazar/@id',

	function($f3) {

		$id = $f3->get('PARAMS.id');
		$image=new DB\SQL\Mapper($f3->get('DB'),'images');

		if ($id) $image->load(array('id=?',$id));

		$image->modified=date("Y-m-d H:i:s");
		$image->status="rechazada";
		$image->save();

		$f3->reroute('/admin');
	}
	);

$f3->route('GET /admin/borrar/@id',

	function($f3) {

		$id = $f3->get('PARAMS.id');
		$image=new DB\SQL\Mapper($f3->get('DB'),'images');

		if ($id) $image->load(array('id=?',$id));

		$image->erase();

		$f3->reroute('/admin');
	}
	);

$f3->route('GET /fotos',

	function($f3) {

		$f3->set( 'title' , 'Proyección de fotos' );

		$f3->set( 'content' , 'proyeccion/fotos.htm' );

		$f3->set('images',$f3->get('DB')->exec('SELECT * FROM images WHERE status="aprobada" ORDER BY RAND()'));

		echo \Template::instance() -> render ( 'proyeccion/pantallalayout.htm' );
	}
	);


$f3->run();
