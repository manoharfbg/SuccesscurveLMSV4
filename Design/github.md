repo: manoharfbg/SuccesscurveLMSV4
branch: main
path: resources/views

## Last sync
date: 2026-09-12T11:36:15Z

### Updated in this project
- Built admin Create Mock Test + question-bank-entry page (2-step: test details → add questions) from addTest / addQuestion / testQuestions blades
- Added ID numbers, sorting, pagination and Spam/New-lead labels to admin contact inbox
- Built SME, Faculty (with earnings), admin dashboards and Contact Us + admin contact inbox

## Screen map
| Screen | Built from |
| --- | --- |
| redesign-plan.dc.html | resources/views/** (full inventory), app/*.php models, routes/web.php |
| homepage-b-bold.dc.html | resources/views/home.blade.php, homelayout.blade.php |
| admin-dashboard.dc.html | Admin/dashboard.blade.php, Admin/adminSidebar.blade.php, Admin/payments/*, Admin/questions/*, Admin/coupons/*, Admin/users/* |
| admin-create-test.dc.html | Admin/addTest.blade.php, Admin/questions/addQuestion.blade.php, Admin/tests/testQuestions.blade.php |
| sme-dashboard.dc.html | qas/dashboard.blade.php, qas/sidebar.blade.php, Admin/questions/* (review scope) |
| faculty-dashboard.dc.html | Faculty/dashboard.blade.php, Faculty/sidebar.blade.php, Faculty/courses/*, Faculty/payments/* |
| contact-us.dc.html | contact.blade.php |
| admin-contacts.dc.html | Admin/contacts.blade.php, Admin/contactDetails.blade.php |

## Sync history
- 2026-09-12T08:33:11Z — built SME, Faculty, contact pages
- 2026-09-12T07:58:40Z — analyzed full Admin/Faculty/QAS panels; built admin dashboard
- 2026-09-11T09:02:35Z — initial inventory of 223 views; homepage directions built
