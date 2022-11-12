<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/home';
$route['home'] = 'auth/home';
$route['dashboard'] = 'admin/dashboard';
$route['adminpanel'] = 'admin/login';;
$route['adminlogin'] = 'admin/loginme';
$route['student'] = 'student/studentListing';
$route['faculty'] = 'faculty/facultyListing';
$route['strand'] = 'admin/strandListing';
$route['schoolyear'] = 'admin/schoolyearListing';
$route['jhsubject'] = 'subject/jhsubjectListing';
$route['shsubject'] = 'subject/shsubjectListing';
$route['section'] = 'admin/sectionListing';
$route['schedule'] = 'schedule/scheduleListing';
$route['enrollment'] = 'enrollment/enrollmentListing';
$route['preregistration'] = 'student/prestudentListing';
$route['preenrollmentlist'] = 'enrollment/preenrollmentListing';
$route['semester'] = 'admin/semesterListing';
$route['changepassword'] = 'admin/changepassword';
$route['account'] = 'admin/account';

$route['archivedstudent'] = 'student/studentArchivedListing';
$route['archivestudent'] = 'student/archivestudent';    
$route['retrievestudent'] = 'student/retrievestudent';

$route['archivedfaculty'] = 'faculty/facultyArchivedListing';
$route['archivefaculty'] = 'faculty/archivefaculty';
$route['retreievefaculty'] = 'faculty/retreievefaculty';

$route['archivedschedule'] = 'schedule/scheduleArchivedListing';
$route['archiveschedule'] = 'schedule/archiveschedule/$1';
$route['retreieveschedule'] = 'schedule/retreieveschedule';

$route['archivedenrollment'] = 'enrollment/enrollmentArchivedListing';
$route['archiveenrollment'] = 'enrollment/archiveenrollment';
$route['retreieveenrollment'] = 'enrollment/retreieveenrollment';

$route['archivedpreregistration'] = 'student/registrationArchivedListing';

$route['archivedpreenrollment'] = 'enrollment/preenrollmentArchivedListing';

$route['archivedstrand'] = 'admin/strandArchivedListing';
$route['archivestrand'] = 'admin/archivestrand';
$route['retrievestrand'] = 'admin/retrievestrand';

$route['approvedrequest'] = 'student/approvedRequest';
$route['declinedrequest'] = 'student/declinedRequest';

$route['approvedenrollment'] = 'enrollment/approvedRequest';
$route['declinedenrollment'] = 'enrollment/declinedRequest';

$route['login'] = 'admin/login';
$route['signup'] = 'auth/signup';
$route['about'] = 'auth/about';
$route['admission'] = 'auth/admission';
$route['academics'] = 'auth/academics';
$route['registration'] = 'auth/registration';
$route['forgotpassword'] = 'auth/forgotpassword';
$route['sendlinkEmail'] = 'auth/sendlinkEmail';
$route['authentication/(:any)'] = 'auth/authentication/$1';
$route['resetpassword/(:any)'] = 'auth/resetpassword/$1';
$route['addAccount'] = 'auth/addAccount';

$route['studentdashboard'] = 'auth/studentdashboard';
$route['studentaccount'] = 'auth/studentaccount';
$route['registrationrequest'] = 'auth/registrationrequest';
$route['preenrollment'] = 'auth/preenrollment';
$route['studentenrollment'] = 'auth/studentenrollment';
$route['studentrecords'] = 'auth/studentrecords';

$route['teacherdashboard'] = 'auth/teacherdashboard';
$route['myschedule'] = 'faculty/myschedule';
$route['myrecord'] = 'faculty/myrecord';
$route['studentlist/(:any)'] = 'faculty/studentlist/$1';
$route['dropstudent'] = 'faculty/dropstudent';
$route['restorestudent'] = 'faculty/restorestudent';

$route['addNewStudent'] = 'student/addnewstudent';
$route['addStudent'] = 'student/addstudent';
$route['editStudent/(:any)'] = 'student/editStudent/$1';
$route['editOldStudent'] = 'student/editOldStudent';

$route['addNewFaculty'] = 'faculty/addNewFaculty';
$route['addFaculty'] = 'faculty/addFaculty';
$route['editFaculty/(:any)'] = 'faculty/editFaculty/$1';
$route['editOldFaculty'] = 'faculty/editOldFaculty';

$route['addNewStrand'] = 'admin/addNewStrand';
$route['addStrand'] = 'admin/addStrand';
$route['editStrand/(:any)'] = 'admin/editStrand/$1';
$route['editOldStrand'] = 'admin/editOldStrand';

$route['addNewSchoolYear'] = 'admin/addNewSchoolYear';
$route['addSchoolYear'] = 'admin/addSchoolYear';
$route['editSchoolYear/(:any)'] = 'admin/editSchoolYear/$1';
$route['editOldSchoolYear'] = 'admin/editOldSchoolYear';
$route['activesemester/(:any)'] = 'admin/activeSemester/$1';
$route['activeschoolyear/(:any)'] = 'admin/activeSchoolyear/$1';

$route['addNewJHSubject'] = 'subject/addNewJHSubject';
$route['addJHSubject'] = 'subject/addJHSubject';
$route['editJHSubject/(:any)'] = 'subject/editJHSubject/$1';
$route['editOldJHSubject'] = 'subject/editOldJHSubject';

$route['addNewSHSubject'] = 'subject/addNewSHSubject';
$route['addSHSubject'] = 'subject/addSHSubject';
$route['editSHSubject/(:any)'] = 'subject/editSHSubject/$1';
$route['editOldSHSubject'] = 'subject/editOldSHSubject';

$route['addNewSection'] = 'admin/addNewSection';
$route['addSection'] = 'admin/addSection';
$route['editSection/(:any)'] = 'admin/editSection/$1';
$route['editOldSection'] = 'admin/editOldSection';

$route['addNewSchedule'] = 'schedule/addNewSchedule';
$route['addSchedule'] = 'schedule/addSchedule';
$route['editSchedule/(:any)'] = 'schedule/editSchedule/$1';
$route['editOldSchedule'] = 'schedule/editOldSchedule';

$route['addNewEnrollment'] = 'enrollment/addNewEnrollment';
$route['addEnrollment'] = 'enrollment/addEnrollment';
$route['editEnrollment/(:any)'] = 'enrollment/editEnrollment/$1';
$route['editOldEnrollment'] = 'enrollment/editOldEnrollment';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
