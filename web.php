<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    IndexController,
    FlashcardCategoryController,
    FlashcardController,
    MasterManageController,
    StandardController,
    SchoolController,
    ChapterManageController,
    ChapterCategoryController
};

use App\Http\Controllers\School\{
    PrincipalController,
    SetPeriodsController,
    AssignPeriodsController,
    ExamtypeController
};

use App\Http\Controllers\Principal\{
    TeacherController,
    StudentController,
    NotificationController,
    AssignSubjectTeacherController,
    AssignClassTeacherController,
    PassmarkController
};
use App\Http\Controllers\Teacher\{
    DiscussionForumController,
    StudentActivitiesController,
    PeriodsTableController,
    SyllabusStatusController,
    MarkEntryController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'login']);
Route::get('/login', [IndexController::class, 'login']);
Route::post('user-check', [IndexController::class, 'CheckUserlogin'])->name('user-check');
Route::group(['middleware' => 'user.check'], function () {
    Route::get('/dashboard', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('dashboard', compact('datas'));
    });
    Route::get('/rolemanagement', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('rolemanage', compact('datas'));
    });
    Route::get('/usermanagement', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('usermanage', compact('datas'));
    });

    Route::get('/flashcart', [FlashcardCategoryController::class, 'index']);
    Route::get('get-flashcard-category', [FlashcardCategoryController::class, 'getCardCategory'])->name('flashcard-category.get');
    Route::post('create-flashcard-category', [FlashcardCategoryController::class, 'createCardCategory'])->name('flashcard-category.create');
    Route::post('update-flashcard-category', [FlashcardCategoryController::class, 'updateCardCategory'])->name('flashcard-category.update');
    Route::post('delete-flashcard-category', [FlashcardCategoryController::class, 'deleteCardCategory'])->name('flashcard-category.delete');

    Route::get('/addflashcart', [FlashcardController::class, 'index']);
    Route::get('get-flashcard', [FlashcardController::class, 'getFlashcard'])->name('flashcard.get');
    Route::get('/create-flashcard', [FlashcardController::class, 'CreatePage'])->name('flashcard.create_page');
    Route::post('get-flash-subject', [FlashcardController::class, 'getFlashCardSubject'])->name('flashcard-subject.flashcard');
    Route::post('get-flash-category', [FlashcardController::class, 'getFlashCardCategory'])->name('flashcard-category.flashcard');
    Route::post('create-flashcards', [FlashcardController::class, 'createFlashcard'])->name('flashcard.create');
    Route::get('/editflashcard/{category}', [FlashcardController::class, 'flashcardEditPage'])->name('editflashcard.flashcard');
    Route::post('delete-flashcard-one', [FlashcardController::class, 'deleteFlashcardOne'])->name('flashcard-one.delete');
    Route::get('/editflashcard-final/{card_id}', [FlashcardController::class, 'flashcardFinalEditPage'])->name('editflashcard-final.edit_page');
    Route::post('update-flashcard-final', [FlashcardController::class, 'flashcardFinalUpdate'])->name('update-flashcard-final.update');

    Route::get('/subject', [MasterManageController::class, 'SubjectPage']);
    Route::post('update-subjects', [MasterManageController::class, 'UpdateSubjects'])->name('update-subjects.subject');

    Route::get('/standard', [StandardController::class, 'index']);
    Route::get('get-standard-subjects', [StandardController::class, 'getStandardSubjects'])->name('get-standard-subjects.get');
    Route::post('create-standard-subjects', [StandardController::class, 'createStandardSubjects'])->name('standard-subjects.create');
    Route::post('update-standard-subjects', [StandardController::class, 'updateStandardSubjects'])->name('standard-subjects.update');
    Route::post('delete-standard-subjects', [StandardController::class, 'deleteStandardSubjects'])->name('standard-subjects.delete');

    Route::get('/school', [SchoolController::class, 'index']);
    Route::get('get-schools', [SchoolController::class, 'getSchools'])->name('schools.get');
    Route::post('create-schools', [SchoolController::class, 'createSchool'])->name('schools.create');
    Route::post('update-schools', [SchoolController::class, 'updateSchool'])->name('schools.update');
    Route::post('delete-schools', [SchoolController::class, 'deleteSchool'])->name('schools.delete');
    
    Route::get('/chapter_category', [ChapterCategoryController::class, 'index']);
    Route::get('get-chapters-category', [ChapterCategoryController::class, 'getChapterCategories'])->name('chapters-category.get');
    Route::post('create-chapter-category', [ChapterCategoryController::class, 'createChapterCategory'])->name('chapter-category.create');
    Route::post('update-chapter-category', [ChapterCategoryController::class, 'updateChapterCategory'])->name('chapter-category.update');
    Route::post('delete-chapter-category', [ChapterCategoryController::class, 'deleteChapterCategory'])->name('chapter-category.delete');

    Route::get('/chaptermanagement', [ChapterManageController::class, 'index']);
    Route::get('get-chapters', [ChapterManageController::class, 'getChapters'])->name('chapters.get');
    Route::post('get-chapter-categorytype', [ChapterManageController::class, 'getChapterCategorytype'])->name('chapter-categorytype.get');
    Route::post('get-chapter-categorytype-foredit', [ChapterManageController::class, 'getChapterCategorytypeForEdit'])->name('chapter-categorytype-foredit.get');
    Route::get('/add-chapter', [ChapterManageController::class, 'ChapterCreatePage']);
    Route::get('/edit-chapter/{id}', [ChapterManageController::class, 'ChapterEditPage'])->name('chapter.edit');
    Route::post('get-chapter-subjects', [ChapterManageController::class, 'getChapterSubjects'])->name('get-chapter-subjects.chapter');
    Route::post('create-chapter', [ChapterManageController::class, 'createChapter'])->name('chapter.create');
    Route::post('update-chapter', [ChapterManageController::class, 'updateChapter'])->name('chapter.update');
    Route::post('delete-chapter', [ChapterManageController::class, 'deleteChapter'])->name('chapter.delete');

    Route::get('/principal', [PrincipalController::class, 'index']);
    Route::post('create-principal', [PrincipalController::class, 'createPrincipal'])->name('principal.create');
    Route::post('update-principal', [PrincipalController::class, 'updatePrincipal'])->name('principal.update');

    Route::get('/teacher', [TeacherController::class, 'index']);
    Route::get('get-teachers', [TeacherController::class, 'getTeachers'])->name('teachers.get');
    Route::post('create-teachers', [TeacherController::class, 'createTeacher'])->name('teachers.create');
    Route::post('update-teacher', [TeacherController::class, 'updateTeacher'])->name('teacher.update');
    Route::post('delete-teacher', [TeacherController::class, 'deleteTeacher'])->name('teacher.delete');

    Route::get('/student', [StudentController::class, 'index']);
    Route::get('get-students', [StudentController::class, 'getStudents'])->name('students.get');
    Route::get('/add-student', [StudentController::class, 'studentCreatePage']);
    Route::post('create-student', [StudentController::class, 'createStudent'])->name('student.create');
    Route::get('/edit-student/{id}', [StudentController::class, 'StudentrEditPage'])->name('student.edit');
    Route::post('update-student', [StudentController::class, 'updateStudent'])->name('student.update');
    Route::post('delete-student', [StudentController::class, 'deleteStudent'])->name('student.delete');

    Route::get('/notifyit', [NotificationController::class, 'index']);
    Route::get('get-sent-notifications', [NotificationController::class, 'getMyNotifications'])->name('sent-notifications.get');
    Route::post('sent-notifications', [NotificationController::class, 'sentNotifications'])->name('notifications.sent');
    Route::post('/notifications/delete', [NotificationController::class, 'deleteNotifications'])->name('notifications.delete');
    Route::post('get-student-drop', [NotificationController::class, 'GetStudentForDrop'])->name('get-student-drop.get');
    
    Route::get('/forum', [DiscussionForumController::class, 'index']);
    Route::get('get-questions', [DiscussionForumController::class, 'getQuestions'])->name('questions.get');
    Route::post('create-questions', [DiscussionForumController::class, 'createQuestions'])->name('questions.create');
    Route::get('/forum-questions', [DiscussionForumController::class, 'QuestionsPage']);
    Route::get('get-questions-bystssub', [DiscussionForumController::class, 'getQuestionsByStdSub'])->name('questions-bystssub.get');
    Route::get('/discussionForumRepList/{id}', [DiscussionForumController::class, 'RepliesPage'])->name('replies-page.get');
    Route::get('get-replies', [DiscussionForumController::class, 'getReplies'])->name('replies.get');
    Route::post('create-replies', [DiscussionForumController::class, 'createReplies'])->name('replies.create');
    
    Route::get('/Standard_Section', [AssignSubjectTeacherController::class, 'index']);
    Route::get('get-subject-assigned-teachers', [AssignSubjectTeacherController::class, 'getSubjectAssignedTeachers'])->name('get-subject-assigned-teachers.get');
    Route::post('create-subject-assigned-teachers', [AssignSubjectTeacherController::class, 'createSubjectAssignedTeachers'])->name('subject-assigned-teachers.create');
    Route::post('update-subject-assigned-teachers', [AssignSubjectTeacherController::class, 'updateSubjectAssignedTeachers'])->name('subject-assigned-teachers.update');
    Route::post('delete-subject-assigned-teachers', [AssignSubjectTeacherController::class, 'deleteSubjectAssignedTeachers'])->name('subject-assigned-teachers.delete');
    
    Route::get('/Class_Teacher', [AssignClassTeacherController::class, 'index']);
    Route::get('get-class-assigned-teachers', [AssignClassTeacherController::class, 'getClassAssignedTeachers'])->name('get-class-assigned-teachers.get');
    Route::post('create-class-assigned-teachers', [AssignClassTeacherController::class, 'createClassAssignedTeachers'])->name('class-assigned-teachers.create');
    Route::post('update-class-assigned-teachers', [AssignClassTeacherController::class, 'updateClassAssignedTeachers'])->name('class-assigned-teachers.update');
    Route::post('delete-class-assigned-teachers', [AssignClassTeacherController::class, 'deleteClassAssignedTeachers'])->name('class-assigned-teachers.delete');
    
    Route::get('/school_time_table', [SetPeriodsController::class, 'index']);
    Route::get('get-set-periods', [SetPeriodsController::class, 'getSetPeriods'])->name('set-periods.get');
    Route::post('create-set-periods', [SetPeriodsController::class, 'createSetPeriods'])->name('set-periods.create');
    Route::get('/edit-set-periods/{id}', [SetPeriodsController::class, 'SetPeriodsEditPage'])->name('set-periods.edit');
    Route::post('update-set-periods', [SetPeriodsController::class, 'updateSetPeriods'])->name('set-periods.update');
    Route::post('delete-set-periods', [SetPeriodsController::class, 'deleteSetPeriods'])->name('set-periods.delete');
    
    Route::get('/classwasetimetable', [AssignPeriodsController::class, 'index']);
    Route::get('get-periods-prelims', [AssignPeriodsController::class, 'getPriodsPrelims'])->name('periods-prelims.get');
    Route::post('get-daytype', [AssignPeriodsController::class, 'getDayType'])->name('get-daytype.get');
    Route::post('create-assign-periods', [AssignPeriodsController::class, 'createAssignPeriods'])->name('assign-periods.create');
    Route::get('/edit-assign-periods/{id}', [AssignPeriodsController::class, 'AssignPeriodsEditPage'])->name('assign-periods.edit');
    Route::post('update-assign-periods', [AssignPeriodsController::class, 'updateAssignPeriods'])->name('assign-periods.update');
    Route::post('delete-assign-periods', [AssignPeriodsController::class, 'DeleteTheAssignPeriods'])->name('assign-periods.delete');
    Route::post('get-teachers-bysubject', [AssignPeriodsController::class, 'GetTeachersBySubject'])->name('teachers-bysubject.get');
    
    Route::get('/Classwise_Activity_Report', [StudentActivitiesController::class, 'index']);
    Route::post('get-activities-played-subjectwise', [StudentActivitiesController::class, 'getActivitiesPlayedSubjectwise'])->name('activities-played-subjectwise.get');
    Route::get('/Subjectwise_Report', [StudentActivitiesController::class, 'SubjectWiseindex']);
    Route::get('/Subjectwise_Report_view/{id}', [StudentActivitiesController::class, 'StudentActivitiesPage'])->name('Subjectwise_Report_view.get');
    Route::post('get-played-activities-student', [StudentActivitiesController::class, 'getPlayedActivitiesListByStudent'])->name('played-activities-student.get');
    Route::post('get-activities-played-classwise', [StudentActivitiesController::class, 'getActivitiesPlayedClasswise'])->name('activities-played-classwise.get');
    
    Route::get('/timetable', [PeriodsTableController::class, 'index']);
    Route::get('get-timetable-for-teachers', [PeriodsTableController::class, 'MakeTable'])->name('get-timetable-for-teachers.get');
    Route::get('/timetable', [PeriodsTableController::class, 'index']);
    Route::get('/classtimetable', [PeriodsTableController::class, 'index2']);
    Route::post('get-timetable-for-teachers-bystdsec', [PeriodsTableController::class, 'MakeTable2'])->name('get-timetable-for-teachers-bystdsec.get');
    
    Route::get('/passmark', [PassmarkController::class, 'index']);
    Route::post('create-pass-marks', [PassmarkController::class, 'createSubjectPassmarks'])->name('pass-marks.create');
    Route::get('get-pass-marks', [PassmarkController::class, 'getSubjectPassmarks'])->name('pass-marks.get');
    Route::post('update-pass-marks', [PassmarkController::class, 'updateSubjectPassmarks'])->name('pass-marks.update');
    Route::post('delete-pass-marks', [PassmarkController::class, 'deleteSubjectPassmarks'])->name('pass-marks.delete');
    
    Route::get('/exam_type', [ExamtypeController::class, 'index']);
    Route::post('create-exam-type', [ExamtypeController::class, 'createExamType'])->name('exam-type.create');
    Route::get('get-exam-type', [ExamtypeController::class, 'getExamTypes'])->name('exam-type.get');
    Route::post('update-exam-type', [ExamtypeController::class, 'updateExamType'])->name('exam-type.update');
    Route::post('delete-exam-type', [ExamtypeController::class, 'deleteExamType'])->name('exam-type.delete');
    
    Route::get('/syllabusStatus', [SyllabusStatusController::class, 'index']);
    Route::get('get-syllabusStatus', [SyllabusStatusController::class, 'getChaptersCompletion'])->name('syllabusStatus.get');
    Route::post('change-chapter-completion-status', [SyllabusStatusController::class, 'ChangeChapterCompletionStatus'])->name('chapter-completion-status.change');
    Route::post('remarks-chapter-completion-create', [SyllabusStatusController::class, 'createChapterCompletionRemarks'])->name('remarks-chapter-completion-status.create');
    
    Route::get('/activity_mark_master', [MarkEntryController::class, 'index']);
    Route::get('get-mark-entries', [MarkEntryController::class, 'getMarkEntries'])->name('mark-entries.get');
    Route::post('update-mark-entries', [MarkEntryController::class, 'UpdateMarksForStudent'])->name('mark-entries.update');
    
    Route::get('/activity', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('activity', compact('datas'));
    });
    Route::get('/markettingsalesteams', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('markettingsalesteams', compact('datas'));
    });
    Route::get('/franchise', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('franchise ', compact('datas'));
    });
    Route::get('/enquries', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('enqury ', compact('datas'));
    });
    Route::get('/add-level', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('add_level ', compact('datas'));
    });
    Route::get('/login-logout', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('login-logout ', compact('datas'));
    });
    Route::post('logout', [IndexController::class, 'logout']);




    Route::get('/schedule', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.schedule', compact('datas'));
    });
    Route::get('/parents-meetings', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.parents-meetings', compact('datas'));
    });
    Route::get('/Meeting-History', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.Meeting-History', compact('datas'));
    });
    Route::get('/performanceStatus', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.performanceStatus', compact('datas'));
    });
    Route::get('/credits-status', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.credits-status', compact('datas'));
    });
    Route::get('/learning_cumulative_report_KG', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.learning_cumulative_report_KG', compact('datas'));
    });
    Route::get('/Grade1-Grade5', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.Grade1-Grade5', compact('datas'));
    });
    Route::get('/StudentwiseAssessment', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.StudentwiseAssessment', compact('datas'));
    });
    Route::get('/KG_Assessment', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.KG_Assessment', compact('datas'));
    });
    Route::get('/Subjectwise_QuestionPaper', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.Subjectwise_QuestionPaper', compact('datas'));
    });
    Route::get('/Studentwise_Answersheet', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.Studentwise_Answersheet', compact('datas'));
    });
    Route::get('/Monthlywise_Download', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.Monthlywise_Download', compact('datas'));
    });
    Route::get('/Studentwise_Mark Entry', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.Studentwise_Mark Entry', compact('datas'));
    });
    Route::get('/Comments', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.Comments', compact('datas'));
    });
    Route::get('/createGMeet', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.createGMeet', compact('datas'));
    
    });
    Route::get('/General_Notification', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.General_Notification', compact('datas'));
    
    });
    Route::get('/studentwiseComments', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.studentwiseComments', compact('datas'));
    
    });
    Route::get('/schedule_view', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.schedule_view', compact('datas'));
    
    });
    Route::get('/parents-meetings_view', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.parents-meetings_view', compact('datas'));
    
    });
    Route::get('/request_leave', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('teacher.request_leave', compact('datas'));
    
    });

    // PRINCIPAL
    Route::get('/viewGMeet', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('principal.viewGMeet', compact('datas'));
    
    });
    Route::get('/Bulk_Export', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('principal.Bulk_Export', compact('datas'));
    
    });
    Route::get('/leave_Notification', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('principal.leave_Notification', compact('datas'));
    
    });
    Route::get('/work_allocation', function () {
        $datas['sidebar'] = SideBarMenus();
        $datas['headermenu'] = HeaderMenu();
        return view('principal.work_allocation', compact('datas'));
    
    });
    // Route::get('/time_table', function () {
    //     $datas['sidebar'] = SideBarMenus();
    //     $datas['headermenu'] = HeaderMenu();
    //     return view('school.add_time_table', compact('datas'));
    
    // });

});

