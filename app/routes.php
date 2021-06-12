<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
	


// ------> language
Route::get('/lang', ['uses'=>'HomeController@language']);

// ------> sitemap
Route::get('/sitemap.xml', 'HomeController@sitemap');


Route::group(['before'=>'closed'], function(){
	
	// ------> home
	Route::get('/', ['as'=>'home', 'uses'=>'HomeController@showWelcome']);
	
	// ------> page
	Route::get('/p-{id}/{slug}', ['as'=>'page', 'uses'=>'HomeController@page']);
	
	// ------> article
	Route::get('/a-{id}/{slug}', ['as'=>'article', 'uses'=>'ArticlesController@show']);
	
	// ------> category
	Route::get('/catg_{id}/{slug}', ['as'=>'category', 'uses'=>'ArticlesController@category']);
	
	
	// ------> contact
	Route::get('contact', ['as'=>'contact', 'uses'=>'HomeController@contact']);
	Route::post('contact/store', ['as'=>'contact_store', 'uses'=>'HomeController@contact_store']);

	
});

Route::get('logout', ['as'=>'users.logout', 'uses'=>'UserController@logout']);

//--------> if users in auth redirect to home
Route::group(['before'=>'user_in_auth'], function(){

		// ------> login
		Route::get('login', ['as'=>'users.login', 'uses'=>'UserController@login']);
		Route::post('check', ['as'=>'users.check', 'uses'=>'UserController@check']);

		// ------> register
		Route::get('register', ['as'=>'users_register', 'uses'=>'UserController@register']);
		
		Route::post('register/store', ['as'=>'users_register_store', 'uses'=>'UserController@register_store']);

		// ------> password
		Route::get('password/reset', ['as'=>'remind_users_reset', 'uses'=>'PasswordController@remind']);
		Route::post('password/reset', ['as'=>'remind_password_request', 'uses'=>'PasswordController@request']);
		Route::get('password/reset/{token}', ['as'=>'remind_password_reset', 'uses'=>'PasswordController@reset']);
		Route::post('password/reset/{token}', ['as'=>'remind_password_update', 'uses'=>'PasswordController@update']);



});




Route::group(['before'=>'db_connected'], function(){
	Route::get('install', ['as'=>'install', 'uses'=>'HomeController@install']);
	Route::get('install/step2', ['as'=>'install_s2', 'uses'=>'HomeController@install_s2']);
});
Route::post('install/step2', ['as'=>'install_s2_db', 'uses'=>'HomeController@install_s2_db']);
Route::group(['before'=>'installed'], function(){
	Route::get('install/step3', ['as'=>'install_s3', 'uses'=>'HomeController@install_s3']);
	Route::post('install/step3', ['as'=>'install_s3_db', 'uses'=>'HomeController@install_s3_db']);
});
Route::get('install/step4', ['as'=>'install_s4', 'uses'=>'HomeController@install_s4']);




// ------> closing mode
Route::get('close', ['as'=>'close', 'uses'=>'HomeController@close']);


//--> only users can access
Route::group(['before'=>'auth'], function(){

	Route::post('/p-{id}/comment/store', ['as'=>'comment_store', 'uses'=>'ArticlesController@comment_store']);
	Route::post('/comment/{id}/delete', ['as'=>'comment_delete', 'uses'=>'ArticlesController@comment_delete']);


	Route::get('/ajax-class',function () {

		$class_id = Input::get('class_id');
		$classes = DB::table('users')->where('class_id','>',0)->where('class_id','=',$class_id)->lists('id', 'fullname');
		return Response::json($classes);
	});



});






//--> only admin can access here
Route::group(['before'=>'admin'], function(){
	
	Route::get('admin', ['as'=>'panel.admin', 'uses'=>'AdminController@index']);


	// ------> scolarite
	Route::get('admin/scolarite', ['as'=>'admin_managers', 'uses'=>'ManagerController@index']);
	Route::get('admin/scolarite/new', ['as'=>'create_manager', 'uses'=>'ManagerController@create']);
	Route::post('admin/scolarite/new', ['as'=>'store_manager', 'uses'=>'ManagerController@store']);

	Route::get('admin/scolarite/{id}/edit', ['as'=>'manager_edit', 'uses'=>'ManagerController@edit']);
	Route::post('admin/scolarite/{id}/edit', ['as'=>'update_manager', 'uses'=>'ManagerController@update']);
	Route::post('admin/scolarite/{id}/edit_pass', ['as'=>'update_password_manager', 'uses'=>'ManagerController@update_password']);
	Route::get('admin/scolarite/{id}/delete', ['as'=>'manager_delete', 'uses'=>'ManagerController@destroy']);

	// ------> messages
	Route::get('admin/contact/{id}', ['as'=>'a_contact', 'uses'=>'MessagesController@create']);
	Route::post('admin/contact/{id}/store', ['as'=>'a_contact_store', 'uses'=>'MessagesController@store']);
	Route::get('admin/incoming_messages', ['as'=>'admin_messages_incoming', 'uses'=>'MessagesController@incoming']);
	Route::get('admin/outgoing_messages', ['as'=>'admin_messages_outgoing', 'uses'=>'MessagesController@outgoing']);
	Route::get('admin/message/{id}/delete', ['as'=>'admin_messages_destroy', 'uses'=>'MessagesController@destroy']);

	// -------> students
	Route::get('admin/students', ['as'=>'admin_students', 'uses'=>'StudentsController@all_students']);
	Route::get('admin/students/new', ['as'=>'create_student', 'uses'=>'StudentsController@create']);
	Route::post('admin/students/new', ['as'=>'store_student', 'uses'=>'StudentsController@store']);
	Route::get('admin/student/{id}/profile', ['as'=>'profile_student', 'uses'=>'StudentsController@profile']);
	Route::get('admin/student/{id}/edit', ['as'=>'student_edit', 'uses'=>'StudentsController@edit']);
	Route::post('admin/student/{id}/edit', ['as'=>'update_student', 'uses'=>'StudentsController@update']);
	Route::post('admin/student/{id}/edit_pass', ['as'=>'update_password_student', 'uses'=>'StudentsController@update_password']);
	Route::get('admin/student/{id}/delete', ['as'=>'student_delete', 'uses'=>'StudentsController@destroy']);

	// -------> parents
	Route::get('admin/parents', ['as'=>'admin_parents', 'uses'=>'ParentsController@all_parents']);
	Route::get('admin/parents/new', ['as'=>'create_parent', 'uses'=>'ParentsController@create']);
	Route::post('admin/parents/new', ['as'=>'store_parent', 'uses'=>'ParentsController@store']);
	Route::get('admin/parent/{id}/profile', ['as'=>'profile_parent', 'uses'=>'ParentsController@profile']);
	Route::get('admin/parent/{id}/edit', ['as'=>'parent_edit', 'uses'=>'ParentsController@edit']);
	Route::post('admin/parent/{id}/edit', ['as'=>'update_parent', 'uses'=>'ParentsController@update']);
	Route::post('admin/parent/{id}/edit_pass', ['as'=>'update_password_parent', 'uses'=>'ParentsController@update_password']);
	Route::get('admin/parent/{id}/delete', ['as'=>'parent_delete', 'uses'=>'ParentsController@destroy']);

	Route::get('admin/parents/{id}/childrens', ['as'=>'parent_childrens', 'uses'=>'ParentsController@all_childrens']);


	// -------> teachers
	Route::get('admin/teachers', ['as'=>'admin_teachers', 'uses'=>'TeachersController@all_teachers']);
	Route::get('admin/teachers/new', ['as'=>'create_teacher', 'uses'=>'TeachersController@create']);
	Route::post('admin/teachers/new', ['as'=>'store_teacher', 'uses'=>'TeachersController@store']);
	Route::get('admin/teacher/{id}/profile', ['as'=>'profile_teacher', 'uses'=>'TeachersController@profile']);
	Route::get('admin/teacher/{id}/edit', ['as'=>'teacher_edit', 'uses'=>'TeachersController@edit']);
	Route::post('admin/teacher/{id}/edit', ['as'=>'update_teacher', 'uses'=>'TeachersController@update']);
	Route::post('admin/teacher/{id}/edit_pass', ['as'=>'update_password_teacher', 'uses'=>'TeachersController@update_password']);
	Route::get('admin/teacher/{id}/delete', ['as'=>'teacher_delete', 'uses'=>'TeachersController@destroy']);


	// -------> classes
	Route::get('admin/classes', ['as'=>'admin_classes', 'uses'=>'ClassesController@index']);
	Route::post('admin/classes/new', ['as'=>'store_class', 'uses'=>'ClassesController@store']);
	Route::get('admin/class/{id}/delete', ['as'=>'class_delete', 'uses'=>'ClassesController@destroy']);
	Route::post('admin/classes/{id}/update', ['as'=>'class_update', 'uses'=>'ClassesController@update']);



	// -------> subjects
	Route::get('admin/subjects', ['as'=>'admin_subjects', 'uses'=>'SubjectsController@index']);
	Route::post('admin/subjects/new', ['as'=>'store_subject', 'uses'=>'SubjectsController@store']);
	Route::get('admin/subject/{id}/delete', ['as'=>'subject_delete', 'uses'=>'SubjectsController@destroy']);
	Route::post('admin/subject/{id}/update', ['as'=>'subject_update', 'uses'=>'SubjectsController@update']);

		// ------> register
		Route::get('admin/register', ['as'=>'teacher_register', 'uses'=>'SeController@teacher_register']);

		Route::post('admin/register/store/new', ['as'=>'teacher_register_store', 'uses'=>'SeController@teacher_register_store']);

 //Route::get('admin/subject_data', ['as'=>'subject_data', 'uses'=>'SeController@index']);

	// -------> absences
	Route::get('admin/absences', ['as'=>'admin_absences', 'uses'=>'AdminController@absences']);
	Route::post('admin/absences/store', ['as'=>'admin_absence_store', 'uses'=>'AdminController@absence_store']);


	// -------> reports send by teachers
	Route::get('admin/reports', ['as'=>'admin_reports', 'uses'=>'AdminController@reports']);

	// -------> library
	Route::get('admin/library', ['as'=>'admin_library', 'uses'=>'LibraryController@index']);
	Route::post('admin/library', ['as'=>'admin_library_upload', 'uses'=>'LibraryController@store']);
	Route::get('admin/library/{id}/delete', ['as'=>'admin_library_delete', 'uses'=>'LibraryController@destroy']);

	Route::get('admin/library/catg', ['as'=>'admin_library_catg', 'uses'=>'LibraryController@category']);
	Route::post('admin/library/catg/store', ['as'=>'library_catg_store', 'uses'=>'LibraryController@categorie_store']);
	Route::post('admin/library/catg/{id}/update', ['as'=>'library_catg_update', 'uses'=>'LibraryController@categorie_update']);
	Route::get('admin/library/catg/{id}/delete', ['as'=>'library_catg_delete', 'uses'=>'LibraryController@categorie_destroy']);



	// -------> articles
	Route::get('admin/articles', ['as'=>'admin_articles', 'uses'=>'ArticlesController@index']);
	Route::get('admin/article/new', ['as'=>'create_article', 'uses'=>'ArticlesController@create']);
	Route::post('admin/article/new', ['as'=>'store_article', 'uses'=>'ArticlesController@store']);
	Route::get('admin/article/{id}/edit', ['as'=>'edit_article', 'uses'=>'ArticlesController@edit']);
	Route::post('admin/article/{id}/edit', ['as'=>'update_article', 'uses'=>'ArticlesController@update']);
	Route::get('admin/article/{id}/delete', ['as'=>'delete_article', 'uses'=>'ArticlesController@destroy']);

	// -------> categories
	Route::get('admin/categories', ['as'=>'admin_categories', 'uses'=>'ArticlesController@categories']);
	Route::post('admin/categorie/store', ['as'=>'categorie_store', 'uses'=>'ArticlesController@categorie_store']);
	Route::get('admin/categorie/{id}/delete', ['as'=>'categorie_delete', 'uses'=>'ArticlesController@categorie_destroy']);
	Route::post('admin/categorie/{id}/update', ['as'=>'categorie_update', 'uses'=>'ArticlesController@categorie_update']);


	// -------> settings
	Route::get('admin/settings', ['as'=>'admin_settings', 'uses'=>'AdminController@settings']);
	Route::post('admin/settings/update', ['as'=>'settings_update', 'uses'=>'AdminController@settings_update']);
	Route::post('admin/settings/admin', ['as'=>'update_admin', 'uses'=>'AdminController@update_admin']);
	Route::post('admin/settings/admin/password', ['as'=>'admin_password', 'uses'=>'AdminController@admin_password']);


	// -------> transport
	Route::get('admin/transport', ['as'=>'admin_transport', 'uses'=>'TransportController@index']);
	Route::post('admin/transport/new', ['as'=>'store_transport', 'uses'=>'TransportController@store']);
	Route::get('admin/transport/{id}/delete', ['as'=>'destroy_transport', 'uses'=>'TransportController@destroy']);

	// -------> pages
	Route::get('admin/pages', ['as'=>'admin_pages', 'uses'=>'PagesController@index']);
	Route::get('admin/pages/new', ['as'=>'page_create', 'uses'=>'PagesController@page_create']);
	Route::post('admin/pages/new', ['as'=>'page_store', 'uses'=>'PagesController@page_store']);
	Route::get('admin/page/{id}/edit', ['as'=>'page_edit', 'uses'=>'PagesController@page_edit']);
	Route::post('admin/page/{id}/update', ['as'=>'page_update', 'uses'=>'PagesController@page_update']);
	Route::get('admin/page/{id}/delete', ['as'=>'page_destroy', 'uses'=>'PagesController@page_destroy']);

	// -------> payments
	Route::get('admin/payments', ['as'=>'admin_payments', 'uses'=>'AdminController@payments']);
	Route::post('admin/payments/store', ['as'=>'payments_store', 'uses'=>'AdminController@payments_store']);
	Route::post('admin/payments/{id}/update', ['as'=>'payments_update', 'uses'=>'AdminController@payments_update']);
	Route::get('admin/payments/{id}/delete', ['as'=>'payments_destroy', 'uses'=>'AdminController@payments_destroy']);
	Route::get('admin/payments/invoice_{id}_{index}', ['as'=>'admin_payment_invoice', 'uses'=>'AdminController@payment_invoice']);
	

	// -------> Emploi du temps
	Route::get('admin/emploi', ['as'=>'emploi_du_temps', 'uses'=>'EmploiController@index']);
	Route::get('admin/emploi/add', ['as'=>'create_emploi_du_temps', 'uses'=>'EmploiController@create']);
	Route::post('admin/emploi/store', ['as'=>'store_emploi_du_temps', 'uses'=>'EmploiController@store']);

	Route::get('admin/emploi/{id}/delete', ['as'=>'destroy_emploi', 'uses'=>'EmploiController@destroy']);

	Route::get('admin/emploi/{id}/edit', ['as'=>'edit_emploi', 'uses'=>'EmploiController@edit']);
	Route::post('admin/emploi/{id}/edit', ['as'=>'update_emploi', 'uses'=>'EmploiController@update_emploi']);


	// -------> profile manager
	Route::get('manager/profile', ['as'=>'manager_edit_profile', 'uses'=>'ManagerController@edit_profile']);
	Route::post('manager/profile', ['as'=>'manager_update_profile', 'uses'=>'ManagerController@update_profile']);
	Route::post('manager/profile/password', ['as'=>'manager_update_password', 'uses'=>'ManagerController@manager_update_password']);


	// -------> annuaire
	Route::get('admin/annuaire', ['as'=>'annuaire_teachers', 'uses'=>'TeachersController@annuaire_teachers']);


	// -------> cahier de texte
	Route::get('admin/cahier_de_texte', ['as'=>'admin_cahier_texte', 'uses'=>'TeachersController@admin_cahier_de_texte']);

	// -------> users data
	Route::get('admin/data', ['as'=>'admin_users_data', 'uses'=>'UserController@users_data']);
	
	Route::post('admin/data/store', ['as'=>'users_data_store', 'uses'=>'UserController@users_data_store']);

	Route::post('admin/data/export', ['as'=>'users_data_export', 'uses'=>'UserController@users_data_export']);

	Route::get('admin/data/{id}/delete', ['as'=>'data_student_delete', 'uses'=>'UserController@data_delete']);


	// -------> users data/semestre
	Route::get('admin/datausers', ['as'=>'admin_data', 'uses'=>'SeController@data_users']);
	
	Route::post('admin/datausers/store', ['as'=>'users_data_s_store', 'uses'=>'SeController@users_data_s_store']);

	Route::post('admin/datausers/export', ['as'=>'users_data_s_export', 'uses'=>'SeController@users_data_s_export']);

	Route::get('admin/datausers/{id}/delete', ['as'=>'data_teacher_s_delete', 'uses'=>'SeController@data_s_delete']);


	


	// -------> users emploi
	/*************Route::get('admin/emploi', ['as'=>'admin_users_emploi', 'uses'=>'UsersController@users_emploi']);

	Route::post('admin/emploi/store', ['as'=>'users_emploi_store', 'uses'=>'UsersController@users_emploi_store']);

	Route::post('admin/emploi/export', ['as'=>'users_emploi_export', 'uses'=>'UsersController@users_emploi_export']);

	Route::get('admin/emploi/{id}/delete', ['as'=>'emploi_student_delete', 'uses'=>'UsersController@emploi_delete']);

************/
	// -------> pedagogiques
	Route::get('admin/pedagogiques', ['as'=>'admin_pedagogiques', 'uses'=>'AdminController@pedagogiques']);


});


//--> only student can access here
Route::group(['before'=>'student'], function(){

	Route::get('students/contact/{id}', ['as'=>'s_contact', 'uses'=>'MessagesController@create']);

	Route::get('students/teacher/{id}/profile', ['as'=>'teacher_p', 'uses'=>'StudentsController@teacher_profile']);

	Route::post('students/contact/{id}/store', ['as'=>'s_contact_store', 'uses'=>'MessagesController@store']);
	Route::get('students/incoming_messages', ['as'=>'student_messages_incoming', 'uses'=>'MessagesController@incoming']);
	Route::get('students/outgoing_messages', ['as'=>'student_messages_outgoing', 'uses'=>'MessagesController@outgoing']);
	Route::get('students/message/{id}/delete', ['as'=>'student_messages_destroy', 'uses'=>'MessagesController@destroy']);

	Route::get('students', ['as'=>'student_panel', 'uses'=>'StudentsController@index']);	
	Route::get('students/subjects', ['as'=>'student_subjects', 'uses'=>'StudentsController@subjects']);	
	Route::get('students/teachers', ['as'=>'student_teachers', 'uses'=>'StudentsController@teachers']);	
	Route::get('students/absence', ['as'=>'student_absence', 'uses'=>'StudentsController@absences']);


	Route::get('students/exams', ['as'=>'student_exams', 'uses'=>'StudentsController@exams']);
	Route::get('students/marks', ['as'=>'student_marks', 'uses'=>'StudentsController@marks']);

	Route::get('students/profile', ['as'=>'student_edit_profile', 'uses'=>'StudentsController@edit_profile']);
	Route::post('students/profile', ['as'=>'student_update_profile', 'uses'=>'StudentsController@update_profile']);
	Route::post('students/profile/password', ['as'=>'student_update_password', 'uses'=>'StudentsController@student_update_password']);

	Route::get('students/lessons', ['as'=>'student_lessons', 'uses'=>'StudentsController@lessons']);
	Route::get('students/lesson/{id}', ['as'=>'student_lesson_show', 'uses'=>'StudentsController@lesson_show']);


	// -------> library
	Route::get('students/library', ['as'=>'student_library', 'uses'=>'LibraryController@index']);
	Route::post('students/library', ['as'=>'student_library_upload', 'uses'=>'LibraryController@store']);
	Route::get('students/library/{id}/delete', ['as'=>'student_library_delete', 'uses'=>'LibraryController@destroy']);

	// -------> transport
	Route::get('students/transport', ['as'=>'student_transport', 'uses'=>'TransportController@student_transport']);

	// -----------> payments
	Route::get('students/payments', ['as'=>'student_payments', 'uses'=>'StudentsController@payments']);
	Route::get('students/payments/invoice_{id}_{index}', ['as'=>'student_payment_invoice', 'uses'=>'StudentsController@payment_invoice']);


	// -------> Emploi du temps
	Route::get('students/emploi', ['as'=>'student_emploi_du_temps', 'uses'=>'EmploiController@student_emploi']);

	// -------> comments lessons
	Route::post('students/lesson/{id}/comment/store', ['as'=>'s_lesson_comment_store', 'uses'=>'StudentsController@comment_store']);
	Route::post('students/lesson/{id}/comment/delete', ['as'=>'s_lesson_comment_delete', 'uses'=>'StudentsController@comment_delete']);


	// -------> lessons search
	Route::get('students/lessons', ['as'=>'student_search_lessons', 'uses'=>'LessonsController@student_search_lessons']);


});

//--> only teacher can access here
Route::group(['before'=>'teacher'], function(){

	// ------> messages
	Route::get('teachers/contact/{id}', ['as'=>'t_contact', 'uses'=>'MessagesController@create']);
	Route::post('teachers/contact/{id}/store', ['as'=>'t_contact_store', 'uses'=>'MessagesController@store']);
	Route::get('teachers/incoming_messages', ['as'=>'teacher_messages_incoming', 'uses'=>'MessagesController@incoming']);
	Route::get('teachers/outgoing_messages', ['as'=>'teacher_messages_outgoing', 'uses'=>'MessagesController@outgoing']);
	Route::get('teachers/message/{id}/delete', ['as'=>'teacher_messages_destroy', 'uses'=>'MessagesController@destroy']);

	Route::get('teachers', ['as'=>'teacher_panel', 'uses'=>'TeachersController@index']);


	Route::get('teachers/students', ['as'=>'teacher_students', 'uses'=>'TeachersController@find_students']);

	Route::get('teachers/student/{id}/profile', ['as'=>'teacher_p_student', 'uses'=>'TeachersController@student_profile']);
	Route::get('teachers/parent/{id}/profile', ['as'=>'teacher_p_parent', 'uses'=>'TeachersController@parent_profile']);
	Route::get('teachers/student/{id}/report', ['as'=>'teacher_report_student', 'uses'=>'TeachersController@report_student']);
	Route::post('teachers/student/{id}/report/store', ['as'=>'teacher_report_store', 'uses'=>'TeachersController@report_store']);	

	Route::get('teachers/absence', ['as'=>'teacher_absence', 'uses'=>'TeachersController@absences']);
	Route::post('teachers/absence/new', ['as'=>'teacher_store_absence', 'uses'=>'TeachersController@absence_store']);

	Route::get('teachers/exams', ['as'=>'teacher_exams', 'uses'=>'TeachersController@exams']);
	Route::post('teachers/exams/new', ['as'=>'teacher_store_exam', 'uses'=>'TeachersController@exam_store']);
	Route::get('admin/exams/{id}/delete', ['as'=>'exam_delete', 'uses'=>'TeachersController@exam_destroy']);

	Route::get('teachers/marks', ['as'=>'teacher_marks', 'uses'=>'TeachersController@marks']);
	Route::post('teachers/marks/new', ['as'=>'teacher_store_mark', 'uses'=>'TeachersController@mark_store']);
	Route::get('admin/marks/{id}/delete', ['as'=>'mark_delete', 'uses'=>'TeachersController@mark_destroy']);


	Route::get('teachers/profile', ['as'=>'teacher_edit_profile', 'uses'=>'TeachersController@edit_profile']);
	Route::post('teachers/profile', ['as'=>'teacher_update_profile', 'uses'=>'TeachersController@update_profile']);
	Route::post('teachers/profile/password', ['as'=>'teacher_update_password', 'uses'=>'TeachersController@teacher_update_password']);


	Route::get('teachers/lessons', ['as'=>'teacher_lessons', 'uses'=>'LessonsController@index']);
	Route::get('teachers/lesson/new', ['as'=>'teacher_lesson_create', 'uses'=>'LessonsController@create']);
	Route::post('teachers/lesson/new', ['as'=>'teacher_lesson_store', 'uses'=>'LessonsController@store']);
	Route::get('teachers/lesson/{id}/edit', ['as'=>'edit_lesson', 'uses'=>'LessonsController@edit']);
	Route::post('teachers/lesson/{id}/edit', ['as'=>'update_lesson', 'uses'=>'LessonsController@update']);	
	Route::get('teachers/lesson/{id}/delete', ['as'=>'delete_lesson', 'uses'=>'LessonsController@destroy']);
	Route::get('teachers/lesson/{id}', ['as'=>'teacher_lesson_show', 'uses'=>'LessonsController@show']);

	// -------> library
	Route::get('teachers/library', ['as'=>'teacher_library', 'uses'=>'LibraryController@index']);
	Route::post('teachers/library', ['as'=>'teacher_library_upload', 'uses'=>'LibraryController@store']);
	Route::get('teachers/library/{id}/delete', ['as'=>'teacher_library_delete', 'uses'=>'LibraryController@destroy']);

	// -------> Emploi du temps
	Route::get('teachers/emploi', ['as'=>'teacher_emploi_du_temps', 'uses'=>'EmploiController@teacher_emploi']);


	// -------> comments lessons
	Route::post('teachers/lesson/{id}/comment/store', ['as'=>'t_lesson_comment_store', 'uses'=>'LessonsController@comment_store']);
	Route::post('teachers/lesson/{id}/comment/delete', ['as'=>'t_lesson_comment_delete', 'uses'=>'LessonsController@comment_delete']);


	// -------> subjects
	Route::get('teachers/subjects', ['as'=>'teacher_subjects', 'uses'=>'TeachersController@subjects']);

	Route::post('teachers/subjects/store', ['as'=>'teacher_store_subject', 'uses'=>'TeachersController@subjects_store']);
	Route::get('teachers/subject/{id}/delete', ['as'=>'teacher_subject_delete', 'uses'=>'TeachersController@subjects_destroy']);
	Route::post('teachers/subject/{id}/update', ['as'=>'teacher_subject_update', 'uses'=>'TeachersController@subjects_update']);


	// -------> pedagogiques
	Route::get('teachers/pedagogiques', ['as'=>'teacher_pedagogiques', 'uses'=>'TeachersController@pedagogiques']);

	//Route::get('teachers/pedagogiques', ['as'=>'t_pedagogiques', 'uses'=>'TeachersController@t_pedagogiques']);

	Route::post('teachers/pedagogiques/store', ['as'=>'pedagogiques_store', 'uses'=>'TeachersController@pedagogiques_store']);
	Route::post('teachers/pedagogiques/{id}/update', ['as'=>'pedagogique_update', 'uses'=>'TeachersController@pedagogique_update']);
	Route::get('teachers/pedagogiques/{id}/delete', ['as'=>'pedagogique_delete', 'uses'=>'TeachersController@pedagogiques_destroy']);

	Route::get('teachers/pedagogiques/archive', ['as'=>'teacher_pedagogique_archives', 'uses'=>'TeachersController@teacher_pedagogique_archives']);

	// -------> lessons search
	Route::get('teachers/lessons', ['as'=>'teacher_search_lessons', 'uses'=>'LessonsController@search_lessons']);


	// -------> cahier de texte
	Route::get('teachers/cahier_de_texte', ['as'=>'teacher_cahier_texte', 'uses'=>'TeachersController@cahier_de_texte']);
	Route::post('teachers/cahier_de_texte/store', ['as'=>'cahier_de_texte_store', 'uses'=>'TeachersController@cahier_de_texte_store']);
	Route::get('teachers/cahier_de_texte/{id}/delete', ['as'=>'cahier_de_texte_destroy', 'uses'=>'TeachersController@cahier_de_texte_destroy']);

	Route::get('teachers/cahier_de_texte/{id}/edit', ['as'=>'cahier_de_texte_edit', 'uses'=>'TeachersController@cahier_de_texte_edit']);
	Route::post('teachers/cahier_de_texte/{id}/edit', ['as'=>'cahier_de_texte_update', 'uses'=>'TeachersController@cahier_de_texte_update']);


	// ------> scolarite
	Route::get('teachers/scolarite', ['as'=>'teacher_scolarite', 'uses'=>'TeachersController@scolarite']);

	// ------> annuaire teachers
	Route::get('teachers/annuaire_teachers', ['as'=>'t_annuaire_teachers', 'uses'=>'TeachersController@t_annuaire_teachers']);
	Route::get('teachers/annuaire_teachers/{id}/profile', ['as'=>'teacher_p_teacher', 'uses'=>'TeachersController@annuaire_teacher_profile']);


});




