<?php

class HomeController extends BaseController {


	public function showWelcome()
	{

		$control = Control::find(1);

		$articles = Article::orderBy('id', 'desc')->paginate($control->paginate);
		return View::make('index', compact('articles'));

	}

	public function sitemap()
	{

		$articles = Article::orderBy('updated_at', 'desc')->get();
		$categories = Category::all();
		$pages = Page::all();

        $content = View::make('sitemap', compact('categories', 'articles', 'pages'));
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');
        
	}

	public function close()
	{
		$control = Control::find(1);

		if ($control->close_site == 0) {
			return Redirect::route('home');
		} 
		else {
			$msg = $control->closing_msg;
			return View::make('close', compact('msg'));
		}
		

	}

	public function page($id)
	{
		$page = Page::find($id);

		if ($page !== null) {
			return View::make('page', compact('page'));
		} else {
			return View::make('404');
		}
		
	}


	public function contact()
	{	
		return View::make('contact');
		
	}

	protected $contact_rules = [

			'name'=>'required',
			'email'=>'required|email',
			'message'=>'required|min:10'

	];

	public function contact_store()
	{	
		
		$inputs = Input::all();

		$validation = Validator::make($inputs, $this->contact_rules);

		if ($validation->fails()) {
			return Redirect::back()->withInput()->withErrors($validation);
		} 

		else {

			$control = Control::find(1);
			$school_email = $control->email;

			$inputs = Input::all();
			$name = e(Input::get('name'));
			$email = e(Input::get('email'));
			$textMsg = e(Input::get('message'));

			$data = [
           		'name' => $name,
           		'email' => $email,
           		'textMsg' => $textMsg,
           		'date' => date('Y-m-d')
			];

			// email to school
			Mail::send('emails.contact', $data, function($message) use ($email, $name, $school_email) {
			    $message->to($school_email, 'contact form')->subject('EasySchool Pro - New message');
			    $message->from($email, $name);
			});

			$path = Session::get('language');
			return Redirect::back()->withSuccess(Lang::get($path.'.message_send_with_success'));

		}
		
	}


	public function language()
	{

		$inputs = Input::all();
		$language = e($inputs['set']);

		$validation = Validator::make($inputs, ['set'=>'in:ar,fr,en']); 

		if ($validation->fails()) {
			return Redirect::route('home');
		} 

		else {
			Session::put('language',$language);
	        App::setLocale($language);
	        return Redirect::back();
		}

	}


/*----------------------------------------------------------------*/


	public function install()
	{

		$errors = array();
		$success = array();

		// Check PHP version
		if (phpversion() < "5.4") {
			$errors[] = 'You are running PHP old version!';
		} else {
			$phpversion = phpversion();
			$success[] = ' You are running PHP '.$phpversion;
		}
		// Check Mcrypt PHP exention
		if(!extension_loaded('mcrypt')) {
			$errors[] = 'Mcriypt PHP exention unloaded!';
		} else {
			$success[] = 'Mcriypt PHP exention loaded!';
		}

		// Check fileinfo PHP exention
		if(!extension_loaded('fileinfo')) {
			$errors[] = 'Fileinfo PHP exention unloaded!';
		} else {
			$success[] = 'Fileinfo PHP exention loaded!';
		}

	
		// Check Mysql PHP exention
		if(!extension_loaded('mysqli')) {
			$errors[] = 'Mysqli PHP exention unloaded!';
		} else {
			$success[] = 'Mysqli PHP exention loaded!';
		}

		// Check Mysql PHP exention
		if(!class_exists('PDO')) {
			$errors[] = 'Install PDO (mandatory for Eloquent)!';
		} else {
			$success[] = 'PDO is installed!';
		}

		if (count($errors) == 0) {
			
			return View::make('install.step_1', compact('success'));

		} else {
			return View::make('install.step_1', compact('errors'));
		}

	
	}


	public function install_s2()
	{
		return View::make('install.step_2');

	}

	public function install_s2_db()
	{

		$inputs = Input::all();

		$host = $inputs['server'];
		$database = $inputs['database'];
		$username = $inputs['username'];
		$password = $inputs['password'];


		$path = app_path('config/database.php');
		$contents = File::get($path);

		$contents = str_replace('%host%', $host, $contents);
		$contents = str_replace('%database%', $database, $contents);
		$contents = str_replace('%username%', $username, $contents);
		$contents = str_replace('%password%', $password, $contents);

		$data_put = File::put($path, $contents);

		if ($data_put) {

			$sql = DB::unprepared("
CREATE TABLE IF NOT EXISTS `absences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `admin_read_stut` int(1) unsigned NOT NULL DEFAULT '1',
  `guardian_read_stut` int(1) unsigned NOT NULL DEFAULT '1',
  `student_read_stut` int(1) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `absences_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count_comment` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `cahier_de_texte` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `the_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `the_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salle` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `activite` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `read` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;



CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;



CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `control` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `school_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_plus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paginate` int(11) NOT NULL DEFAULT '2',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `news` text COLLATE utf8_unicode_ci NOT NULL,
  `closing_msg` text COLLATE utf8_unicode_ci NOT NULL,
  `close_site` tinyint(1) NOT NULL DEFAULT '0',
  `library_apv` tinyint(1) NOT NULL DEFAULT '0',
  `marquee_rtl` int(1) unsigned NOT NULL DEFAULT '0',
  `slide` int(1) unsigned NOT NULL DEFAULT '0',
  `installed` int(1) unsigned NOT NULL DEFAULT '0',
  `payment_tax` int(11) NOT NULL DEFAULT '0',
  `payment_unit` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;


INSERT INTO `control` (`id`, `school_name`, `email`, `phone`, `address`, `facebook`, `twitter`, `youtube`, `google_plus`, `paginate`, `description`, `keywords`, `news`, `closing_msg`, `close_site`, `library_apv`, `marquee_rtl`, `slide`, `installed`, `payment_tax`, `payment_unit`, `created_at`, `updated_at`) VALUES
(1, 'school name', 'dabach.net@gmail.com', '(+212) 670-941992', 'school address', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.youtube.com', 'http://www.google.com', 10, 'EasySchool Pro is a School management system , characterized by a number of properties and the simplicity and ease of use, it allows the school to move from the traditional paper form to electronic form via the Internet', ' EasySchool, School Management System, laravel, php, MySQL, Bootstrap', 'EasySchool Pro is a School management system , characterized by a number of properties and the simplicity and ease of use, it allows the school to move from the traditional paper form to electronic form via the Internet', 'EasySchool Pro is a School management system , characterized by a number of properties and the simplicity and ease of use, it allows the school to move from the traditional paper form to electronic form via the Internet', 0, 1, 0, 0, 0, 0, 'dhs', '0000-00-00 00:00:00', '2017-06-28 11:22:28');


CREATE TABLE IF NOT EXISTS `days` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;



INSERT INTO `days` (`id`, `name`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'lundi', 'الاثنين', 'Monday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'mardi', 'الثلاثاء', 'Tuesday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'mercredi', 'الأربعاء', 'Wednesday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'jeudi', 'الخميس', 'Thursday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'vendredi', 'الجمعة', 'Friday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'samedi', 'السبت', 'Saturday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'dimanche', 'الأحد', 'Sunday', '0000-00-00 00:00:00', '0000-00-00 00:00:00');



CREATE TABLE IF NOT EXISTS `emploi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `salle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `the_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `the_hour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_hour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parcours` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_end` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;



CREATE TABLE IF NOT EXISTS `emploi_hours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;



INSERT INTO `emploi_hours` (`id`, `hour`, `created_at`, `updated_at`) VALUES
(1, '8h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '9h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '10h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '10h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '11h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '11h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '12h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '12h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '13h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '13h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '14h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '14h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '15h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '15h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '16h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '16h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '17h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '17h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '18h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '18h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00');



CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` int(10) unsigned NOT NULL,
  `class_id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `exam_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exam_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `exams_teacher_id_foreign` (`teacher_id`),
  KEY `exams_class_id_foreign` (`class_id`),
  KEY `exams_subject_id_foreign` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `jointe` text COLLATE utf8_unicode_ci NOT NULL,
  `mention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parcour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(10) unsigned NOT NULL,
  `class_id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `lessons_teacher_id_foreign` (`teacher_id`),
  KEY `lessons_class_id_foreign` (`class_id`),
  KEY `lessons_subject_id_foreign` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;



CREATE TABLE IF NOT EXISTS `lessons_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `read` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;



CREATE TABLE IF NOT EXISTS `library` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `file_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;



CREATE TABLE IF NOT EXISTS `library_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;



CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) unsigned NOT NULL,
  `receiver_id` int(10) unsigned NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `read` int(1) unsigned NOT NULL,
  `sender_statu` int(1) unsigned NOT NULL DEFAULT '0',
  `receiver_statu` int(1) unsigned NOT NULL DEFAULT '0',
  `file_path` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_index` (`sender_id`),
  KEY `messages_receiver_id_index` (`receiver_id`),
  KEY `messages_sender_id_read_index` (`sender_id`,`read`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;



CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `password_reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `payment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_index` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;




CREATE TABLE IF NOT EXISTS `pedagogiques` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `days` int(11) NOT NULL,
  `times` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_end` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `magistrale` int(2) DEFAULT NULL,
  `tp` int(2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `read` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;



CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL,
  `to_parent` tinyint(1) NOT NULL DEFAULT '0',
  `report` text COLLATE utf8_unicode_ci,
  `student_id` int(10) unsigned NOT NULL,
  `admin_read_stut` int(1) unsigned NOT NULL DEFAULT '1',
  `guardian_read_stut` int(1) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `reports_author_id_foreign` (`author_id`),
  KEY `reports_student_id_foreign` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;



CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;


INSERT INTO `slide` (`id`, `img_1`, `url_1`, `img_2`, `url_2`, `img_3`, `url_3`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');



CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;



CREATE TABLE IF NOT EXISTS `teachers_marks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` int(10) unsigned NOT NULL,
  `class_id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `mark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_read_stut` int(1) unsigned NOT NULL DEFAULT '1',
  `guardian_read_stut` int(1) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `teachers_marks_teacher_id_foreign` (`teacher_id`),
  KEY `teachers_marks_class_id_foreign` (`class_id`),
  KEY `teachers_marks_subject_id_foreign` (`subject_id`),
  KEY `teachers_marks_student_id_foreign` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `transport` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `day_id` int(10) unsigned NOT NULL,
  `class_id` int(10) unsigned NOT NULL,
  `time_start` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_return` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_student` tinyint(1) NOT NULL DEFAULT '0',
  `is_teacher` tinyint(1) NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `is_manager` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parcour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat_civil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;



CREATE TABLE IF NOT EXISTS `users_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_student` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parcour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;


ALTER TABLE `absences`
  ADD CONSTRAINT `absences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `exams`
  ADD CONSTRAINT `exams_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `exams_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `exams_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `lessons_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `lessons_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);


ALTER TABLE `reports`
  ADD CONSTRAINT `reports_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reports_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);


ALTER TABLE `teachers_marks`
  ADD CONSTRAINT `teachers_marks_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `teachers_marks_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teachers_marks_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `teachers_marks_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);


");

			return Redirect::route('install_s3');

		}


	}



	public function install_s3()
	{
		return View::make('install.step_3');

	}

	protected $admin_rules = [

			'username'=>'required|min:3',
			'email'=>'email|unique:users',
			'password'=>'required|min:4',
			'password_confirm'=>'required|same:password'

	];


	public function install_s3_db()
	{
		
		$inputs = Input::all();

		$validation = Validator::make($inputs, $this->admin_rules); 

		if ($validation->fails()) {

			return Redirect::back()->withInput()->withErrors($validation);

		} else {

			$user = User::create([
						'is_admin' => 1,
						'fullname' => 'admin',
						'username' => e(Input::get('username')),
						'password' => Hash::make(e(Input::get('password'))),
						'email' => e(Input::get('email'))
			]);
				
			$user->save();

			$control = Control::find(1);
			$control->school_name = e($inputs['school_name']);
			$control->email = e($inputs['email']);
			$control->installed = 1;
			$control->save();

			return Redirect::route('install_s4');
		}

	}

	public function install_s4()
	{
		return View::make('install.setup_complete');

	}





}
