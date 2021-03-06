<?php
$functions = array(
    'joomdle_user_id' => array(         //web service function name
        'classname'   => 'joomdle_helpers_external',  //class containing the external function
        'methodname'  => 'user_id',          //external function name
        'classpath'   => 'auth/joomdle/helpers/externallib.php',  //file containing the class/external function
        'description' => 'Get user id.',    //human readable description of the web service function
        'type'        => 'read',                  //database rights of the web service function (read, write)
    ),
    'joomdle_list_courses' => array(         //web service function name
        'classname'   => 'joomdle_helpers_external',  //class containing the external function
        'methodname'  => 'list_courses',          //external function name
        'classpath'   => 'auth/joomdle/helpers/externallib.php',  //file containing the class/external function
        'description' => 'List courses',    //human readable description of the web service function
        'type'        => 'read',                  //database rights of the web service function (read, write)
    ),
    'joomdle_my_courses' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'my_courses', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user courses', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_info' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_info', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course info', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_contents' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_contents', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course topics', 
        'type'        => 'read',                 
    ),
    'joomdle_courses_by_category' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'courses_by_category', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get courses from a category', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_categories' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_categories', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course categories', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_editing_teachers' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_editing_teachers', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course editing teachers', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_no' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_no', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get number of courses', 
        'type'        => 'read',                 
    ),
    'joomdle_get_enrollable_course_no' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_enrollable_course_no', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get number of enrollable courses', 
        'type'        => 'read',                 
    ),
    'joomdle_get_student_no' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_student_no', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get number of students', 
        'type'        => 'read',                 
    ),
    'joomdle_get_total_assignment_submissions' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_total_assignment_submissions', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get number of submitted assignments', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_students_no' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_students_no', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get number of students in a course', 
        'type'        => 'read',                 
    ),
    'joomdle_get_assignment_submissions' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_assignment_submissions', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course submitted assignments', 
        'type'        => 'read',                 
    ),
    'joomdle_get_assignment_grades' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_assignment_grades', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get assignments grades', 
        'type'        => 'read',                 
    ),
    'joomdle_get_upcoming_events' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_upcoming_events', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get upcoming events', 
        'type'        => 'read',                 
    ),
    'joomdle_get_news_items' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_news_items', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get news', 
        'type'        => 'read',                 
    ),
    'joomdle_get_user_grades' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_user_grades', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user grades in a course', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_grade_categories' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_grade_categories', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  grades categories of course', 
        'type'        => 'read',                 
    ),
    'joomdle_search_courses' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'search_courses', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Search courses', 
        'type'        => 'read',                 
    ),
    'joomdle_search_categories' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'search_categories', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Search course categories', 
        'type'        => 'read',                 
    ),
    'joomdle_search_topics' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'search_topics', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Search course topics', 
        'type'        => 'read',                 
    ),
    'joomdle_get_my_courses_grades' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_my_courses_grades', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user grades', 
        'type'        => 'read',                 
    ),
    'joomdle_check_moodle_users' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'check_moodle_users', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Check usernames for moodle accounts', 
        'type'        => 'read',                 
    ),
    'joomdle_get_moodle_only_users' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_moodle_only_users', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get users existing only in moodle', 
        'type'        => 'read',                 
    ),
    'joomdle_get_moodle_users' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_moodle_users', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get moodle users', 
        'type'        => 'read',                 
    ),
    'joomdle_get_moodle_users_number' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_moodle_users_number', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get moodle users', 
        'type'        => 'read',                 
    ),
    'joomdle_user_exists' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'user_exists', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Check if username exists', 
        'type'        => 'read',                 
    ),
    'joomdle_create_joomdle_user' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'create_joomdle_user', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Creates user account', 
        'type'        => 'read',                 
    ),
    'joomdle_enrol_user' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'enrol_user', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Enrols user into course', 
        'type'        => 'read',                 
    ),
    'joomdle_user_details' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'user_details', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user details', 
        'type'        => 'read',                 
    ),
    'joomdle_user_details_by_id' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'user_details_by_id', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user details', 
        'type'        => 'read',                 
    ),
    'joomdle_migrate_to_joomdle' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'migrate_to_joomdle', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user details', 
        'type'        => 'read',                 
    ),
    'joomdle_my_events' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'my_events', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user events', 
        'type'        => 'read',                 
    ),
    'joomdle_delete_user' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'delete_user', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user events', 
        'type'        => 'read',                 
    ),
    'joomdle_get_mentees' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_mentees', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user mentees', 
        'type'        => 'read',                 
    ),
    'joomdle_get_roles' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_roles', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get roles', 
        'type'        => 'read',                 
    ),
    'joomdle_get_parents' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_parents', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get roles', 
        'type'        => 'read',                 
    ),
    'joomdle_get_site_last_week_stats' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_site_last_week_stats', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get site stats', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_daily_stats' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_daily_stats', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course stats', 
        'type'        => 'read',                 
    ),
    'joomdle_get_last_user_grades' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_last_user_grades', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course stats', 
        'type'        => 'read',                 
    ),
    'joomdle_system_check' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'system_check', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Joomdle system check', 
        'type'        => 'read',                 
    ),
    'joomdle_add_parent_role' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'add_parent_role', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Adds parent role', 
        'type'        => 'read',                 
    ),
    'joomdle_get_paypal_config' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_paypal_config', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get paypal config', 
        'type'        => 'read',                 
    ),
    'joomdle_update_session' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'update_session', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Updates user session', 
        'type'        => 'read',                 
    ),
    'joomdle_get_cat_name' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_cat_name', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get category name', 
        'type'        => 'read',                 
    ),
    'joomdle_courses_abc' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'courses_abc', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course list for courses starting with chars', 
        'type'        => 'read',                 
    ),
    'joomdle_teachers_abc' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'teachers_abc', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get teachers list for teacher names starting with chars', 
        'type'        => 'read',                 
    ),
    'joomdle_teacher_courses' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'teacher_courses', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get courses teached by user', 
        'type'        => 'read',                 
    ),
    'joomdle_user_custom_fields' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'user_custom_fields', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get custom fields', 
        'type'        => 'read',                 
    ),
    'joomdle_course_enrol_methods' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'course_enrol_methods', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course available enrolment methods', 
        'type'        => 'read',                 
    ),
    'joomdle_quiz_get_question' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'quiz_get_question', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get quiz question', 
        'type'        => 'read',                 
    ),
    'joomdle_quiz_get_correct_answer' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'quiz_get_correct_answer', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get quiz question correct answer', 
        'type'        => 'read',                 
    ),
    'joomdle_quiz_get_answers' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'quiz_get_answers', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get quiz question answers', 
        'type'        => 'read',                 
    ),
	'joomdle_get_course_students' => array(
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_students',
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course students',
        'type'        => 'read',
    ),
	'joomdle_my_teachers' => array(
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'my_teachers',
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user teachers',
        'type'        => 'read',
    ),
	'joomdle_my_classmates' => array(
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'my_classmates',
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user classmates',
        'type'        => 'read',
    ),
   'joomdle_suspend_enrolment' => array(
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'suspend_enrolment',
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Suspend enrolment',
        'type'        => 'read',
    ),
    'joomdle_get_course_resources' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_resources', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course resources', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_mods' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_mods', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course mods', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_completion' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_completion', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course completion', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_quizes' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_quizes', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get course quizes', 
        'type'        => 'read',                 
    ),
    'joomdle_my_certificates' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'my_certificates', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user certificates', 
        'type'        => 'read',                 
    ),
    'joomdle_get_page' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_page', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get Moodle page', 
        'type'        => 'read',                 
    ),
    'joomdle_get_label' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_label', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get Moodle label', 
        'type'        => 'read',                 
    ),
    'joomdle_get_news_item' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_news_item', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get Moodle news item', 
        'type'        => 'read',                 
    ),
    'joomdle_get_my_news' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_my_news', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user news', 
        'type'        => 'read',                 
    ),
    'joomdle_get_my_events' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_my_events', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user events', 
        'type'        => 'read',                 
    ),
    'joomdle_get_my_grades' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_my_grades', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get user grades', 
        'type'        => 'read',                 
    ),
    'joomdle_quiz_get_random_question' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'quiz_get_random_question', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get random question', 
        'type'        => 'read',                 
    ),
    'joomdle_quiz_get_question_categories' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'quiz_get_question_categories', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  question categories', 
        'type'        => 'read',                 
    ),
    'joomdle_multiple_enrol_and_addtogroup' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'multiple_enrol_and_addtogroup', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Enrol user in multiple courses and groups', 
        'type'        => 'read',                 
    ),
    'joomdle_multiple_enrol' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'multiple_enrol', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Enrol user in multiple courses', 
        'type'        => 'read',                 
    ),
    'joomdle_multiple_suspend_enrolment' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'multiple_suspend_enrolment', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Un-enrol user from multiple courses', 
        'type'        => 'read',                 
    ),
    'joomdle_create_joomdle_user_additional' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'create_joomdle_user_additional', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Creates/updates user account using a different data source', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_grade_categories_and_items' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_grade_categories_and_items', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  grades categories and  items of course', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_grades_by_category' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_grades_by_category', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  course grades by category', 
        'type'        => 'read',                 
    ),
    'joomdle_get_my_grades_by_category' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_my_grades_by_category', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  user grades by courses/category', 
        'type'        => 'read',                 
    ),
    'joomdle_get_cohorts' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_cohorts', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  cohorts', 
        'type'        => 'read',                 
    ),
    'joomdle_add_cohort_member' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'add_cohort_member', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Add user to cohort', 
        'type'        => 'read',                 
    ),
    'joomdle_get_rubrics' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_rubrics', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get assignment rubrics', 
        'type'        => 'read',                 
    ),
    'joomdle_get_grade_user_report' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_grade_user_report', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  user grade report for a course', 
        'type'        => 'read',                 
    ),
    'joomdle_get_my_grade_user_report' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_my_grade_user_report', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  user grade report for all courses', 
        'type'        => 'read',                 
    ),
    'joomdle_teacher_get_course_grades' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'teacher_get_course_grades', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  course grades for teacher', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_groups' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_groups', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  course groups', 
        'type'        => 'read',                 
    ),
    'joomdle_get_group_members' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_group_members', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  group members', 
        'type'        => 'read',                 
    ),
    'joomdle_teacher_get_group_grades' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'teacher_get_group_grades', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get  group grades', 
        'type'        => 'read',                 
    ),
    'joomdle_create_course' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'create_course', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Create course', 
        'type'        => 'read',                 
    ),
    'joomdle_update_course' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'update_course', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Update course', 
        'type'        => 'read',                 
    ),
    'joomdle_add_user_role' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'add_user_role', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Add user role', 
        'type'        => 'read',                 
    ),
    'joomdle_get_all_parents' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_all_parents', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get all parent users', 
        'type'        => 'read',                 
    ),
    'joomdle_get_course_parents' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_course_parents', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get all parent users of the course', 
        'type'        => 'read',                 
    ),
    'joomdle_remove_cohort_member' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'remove_cohort_member', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Remove user from cohort', 
        'type'        => 'read',                 
    ),
    'joomdle_multiple_add_cohort_member' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'multiple_add_cohort_member', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Add user to cohorts', 
        'type'        => 'read',                 
    ),
    'joomdle_multiple_remove_cohort_member' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'multiple_remove_cohort_member', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Remove user from cohorts', 
        'type'        => 'read',                 
    ),
    'joomdle_get_courses_and_groups' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_courses_and_groups', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get courses and their groups', 
        'type'        => 'read',                 
    ),
    'joomdle_multiple_enrol_to_course_and_group' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'multiple_enrol_to_course_and_group', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Add user to courses and groups', 
        'type'        => 'read',                 
    ),
    'joomdle_multiple_remove_from_group' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'multiple_remove_from_group', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Removes user from groups', 
        'type'        => 'read',                 
    ),
    'joomdle_my_all_courses' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'my_all_courses', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get all users in which the has a role assgined', 
        'type'        => 'read',                 
    ),
   'joomdle_unenrol_user' => array(
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'unenrol_user',
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Unenrol user',
        'type'        => 'read',
    ),
   'joomdle_multiple_unenrol_user' => array(
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'multiple_unenrol_user',
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Multiple unenrol user',
        'type'        => 'read',
    ),
    'joomdle_get_children_grades' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_children_grades', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get children grades', 
        'type'        => 'read',                 
    ),
    'joomdle_get_children_grade_user_report' => array(        
        'classname'   => 'joomdle_helpers_external',
        'methodname'  => 'get_children_grade_user_report', 
        'classpath'   => 'auth/joomdle/helpers/externallib.php',
        'description' => 'Get children grade report', 
        'type'        => 'read',                 
    ),
);

?>
