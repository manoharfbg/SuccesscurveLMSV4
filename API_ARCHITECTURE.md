# SuccessCurve Architecture: API-First & Mobile (Android) Roadmap

**Architecture Standard:** Every feature, data model, calculation, and workflow created for the Web UI will also be mirrored as a clean, versioned RESTful API (`/api/v1/...`) with standard JSON contracts, enabling smooth integration for the Android app.

---

## 1. Core API Principles for Android Compatibility
* **Base Route:** `/api/v1/`
* **Response Envelope Standard:**
  ```json
  {
    "status": "success",     // "success" | "error"
    "message": "...",        // Human-readable message
    "data": { ... }          // Payload object or array
  }
  ```
* **Authentication:** Token-based authentication (Laravel Sanctum / API Tokens) returning user session, profile, and active class.
* **Stateless Test Engine:** Timed exam session state, question status palette (visited, answered, marked for review), and submission payload compatible with mobile offline caching/sync.

---

## 2. API Endpoint Matrix

### A. Public & Discovery (`/api/v1/public/`)
* `GET /api/v1/home`: Returns hero banners, live stats counters, class list, subject list, featured courses, recent tests, recent series, and latest blog posts.
* `GET /api/v1/classes`: All classes (5th through PG) with metadata and icons.
* `GET /api/v1/subjects`: Subject catalog with chapter counts and class filters.
* `GET /api/v1/search?name={q}&class_id={id}`: Search courses, mock tests, and test series.

### B. Authentication, User Profile & Student Dashboard (`/api/v1/`)
* `POST /api/v1/auth/login`: Email & password authentication $\to$ returns API token & user profile.
* `POST /api/v1/auth/google`: Google OAuth token exchange.
* `POST /api/v1/auth/register`: Student onboarding with default class selection.
* `POST /api/v1/auth/forget-password`: Password reset email trigger.
* `GET /api/v1/student/profile`: Student profile, selected class, image URL, contact.
* `POST /api/v1/student/update-profile`: Update personal info & change class.
* `GET /api/v1/student/dashboard`: Full 3-band dashboard payload for Web and Android App:
  * **Band 1 (Today):** Resume lecture card, streak & daily goal ring (minutes + lectures + questions), class rank & percentile.
  * **Band 2 (Performance):** Board readiness meter (/100), weak topics drill-down, 8-test score trend, accuracy breakdown (correct/wrong/skipped), subject speed & strengths, marks distribution, and radar chart comparison.
  * **Band 3 (Ahead):** 12-week study heatmap, continue learning enrolled courses, recent activity feed, chapter curriculum roadmap, recommended drills, upcoming scheduled tests, gamification badges, and class leaderboard.

### C. Learning & Courses (`/api/v1/courses/`)
* `GET /api/v1/courses`: Paginated courses list with class & subject filters.
* `GET /api/v1/courses/{id}`: Course syllabus, weekly breakdown, lecture durations, preview flags.
* `GET /api/v1/student/my-courses`: Enrolled courses with completion percentage & resume point.
* `GET /api/v1/courses/{id}/lectures/{lecture_id}`: Video stream URL, attached notes, Q&A doubts, next lecture/test action.

### D. Mock Tests & Exam Engine (`/api/v1/exam/`)
* `GET /api/v1/tests`: List of all mock tests and filters.
* `GET /api/v1/tests/{id}/instructions`: Exam duration, sections, marking scheme, negative marks.
* `POST /api/v1/tests/{id}/start`: Initializes exam attempt $\to$ returns `resultId`, questions payload, section boundaries.
* `POST /api/v1/tests/save-answer`: Saves an individual question answer (supports background sync on mobile).
* `POST /api/v1/tests/submit`: Finalizes exam attempt $\to$ returns immediate calculated summary.
* `GET /api/v1/tests/result/{resultId}`: Deep analytics report (percentile, subject-wise accuracy, speed vs. topper, answer key explanations).

### E. Test Series (`/api/v1/test-series/`)
* `GET /api/v1/test-series`: Available series packages.
* `GET /api/v1/test-series/{id}`: Series tests schedule, completion status, collective rank.

### F. Doubts Forum (`/api/v1/doubts/`)
* `GET /api/v1/doubts`: Filterable doubts list by subject and status.
* `POST /api/v1/doubts/ask`: Post a question attached to a lecture or test question.
* `GET /api/v1/doubts/{id}`: Threaded discussion and instructor response.

### G. Admin Command Center & Management (`/api/v1/admin/`)
* `GET /api/v1/admin/dashboard`: Comprehensive Command Center payload for Web & Management App:
  * **KPI Metrics:** Revenue (YTD), total students, active enrollments, published courses, mock tests, test series, classes, subjects, total questions.
  * **Revenue & Growth:** 8-month historical trend (monthly revenue line + enrollment volume bars), revenue share donut by product type (Courses, Tests, Series).
  * **Trending Catalogs:** Top 5 courses, top 5 mock tests, and top 5 test series by student volume.
  * **Class Enrollment Breakdown:** Monthly signups distribution across classes (Class 5 through PG).
  * **Needs Attention (Action Queues):** Student-flagged question reports, unanswered doubts, contact form admission queries, and pending faculty course drafts.
  * **Operations & Ledger:** Recent payment transactions (Paid, Pending, Failed), question bank health by pattern (MCQ, MSQ, NAT, Paragraph), and question uploader throughput.

