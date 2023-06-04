<p align="center"><img src="https://github.com/iamrohitsuthar/Quizller/blob/master/images/icons/logo.png"/></p>

<p align="center">
<a href="https://github.com/iamrohitsuthar/Quizller/stargazers"><img src="https://img.shields.io/github/stars/iamrohitsuthar/Quizller"></a>
<a href="https://github.com/iamrohitsuthar/Quizller/network/members"><img src="https://img.shields.io/github/forks/iamrohitsuthar/Quizller"></a>
<a href="https://github.com/iamrohitsuthar/Quizller/blob/master/LICENSE"><img src="https://img.shields.io/github/license/iamrohitsuthar/Quizller"></a>
</p>

# Quizller - Quiz System
<table>
  <tr>
    <td>
       Quizller is a php based open source web application to create and manage online quiz, test, exam. 
    </td>
  </tr>
</table>

## Table of contents

* [Features](#features)
* [ScreenShots](#screenshots)
  - [User Side](#user-side)
  - [Admin Side](#admin-side)
* [Steps to install](#steps)
* [Project Overview](#project-overview)
* [Technology Stack](#technology-stack)
* [Collaborate with us](#collaborate-with-us)
* [Bug / Feature Request](#bug--feature-request)

### Features
- Fully Functional Admin Panel
- Quiz Website with awesome UI
- Admin (teacher) can add class and students from admin panel
- Admin can create new quiz tests and add quiz questions in the test
- Option to add the Quiz questions from a spreadsheet (.xls, .xslx, .ods)
- Admin can view the statistics of the tests such as score of the students and quiz questions tests
- Generate run-time random passwords for users to give test
- Generate pdf option so that admin can directly print the student login credentials for the test

### ScreenShots
#### User Side
<table>
  <tr>
    <td>
      <p><b>Login Page</b></p>
      <p>The Login Page of the website for student</p>
      <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/student_login.png"/>
    </td>
    <td>
      <p><b>Dashboard Page</b></p>
      <p>List of tests for student</p>
      <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/student_dashboard.png"/>
    </td>
  </tr>
  
  <tr>
    <td>
      <p><b>Quiz</b></p>
      <p>Here student have to select the one option from the four options of the Quiz question</p>
      <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/student_quiz_test.png"/>
    </td>
    <td>
      <p><b>Quiz Done</b></p>
      <p>Logout message page displayed when the user finished with the quiz test</p>
      <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/student_test_completed.png"/>
    </td>
  </tr>
</table>

#### Admin Side
<table>
  <tr>
    <td>
      <p><b>Login Page</b></p>
      <p>The Login Page of the website for Admin (Teachers) </p>
      <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/admin_login.png"/>
    </td>
    <td>
      <p><b>Dashboard Page</b></p>
      <p>List of pending tests created by the admin</p>
      <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/admin_dashboard.png"/>
    </td>
  </tr>
  
  <tr>
    <td>
      <p><b>Create New Test</b></p>
      <p>Admin can create new quiz test</p>
      <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/create_new_test.png"/>
    </td>
    <td>
      <p><b>Test Details</b></p>
      <p>Here admin can change the test details</p>
      <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/test_details.png"/>
    </td>
  </tr>
  <tr>
  <td>
    <p><b>Add Question</b></p>
    <p>Admin can add new question to the test</p>
    <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/add_question.png"/>
  </td>
  <td>
    <p><b>Add Question</b></p>
    <p>Admin can add the question into quiz from a spreadsheet</p>
    <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/import_questions.png"/>
  </td>
</tr>
<tr>
<td>
  <p><b>Add Class / Add Students</b></p>
  <p>Admin can add new class and new students to the existing class</p>
  <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/add_class.png"/>
</td>
<td>
  <p><b>View Class Data</b></p>
  <p>Admin can see the list of students present in the class</p>
  <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/class_data.png"/>
</td>
</tr>
<tr>
<td>
  <p><b>Test Questions</b></p>
  <p>Admin can add see the quiz test questions</p>
  <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/test_questions.png"/>
</td>
<td>
  <p><b>Students test data</b></p>
  <p>Admin can print the student roll number and random password list</p>
  <img src="https://github.com/iamrohitsuthar/Quizller/blob/master/readme_images/student_test_creds.png"/>
</td>
</tr>
</table>

### Steps
1. Copy the whole project into your WAMP/LAMP/XAMPP folder.
2. Now create the database and import the `script.sql` file present in the database folder.
    1. If you want sample test data then import the `sampleData.sql` file instead.
    2. Default username:password is `admin:nimda`
3. Modify the database credentials config.php file present in the database folder.
4. Now run the project to enjoy the Awesome Quiz System.

### Project Overview
**The website generates random passwords for students for each test.**
1. Dashboard
    1. Create new tests
    2. See previously created tests
2. New Test ( Needs class data first )
    1. Create new test for a class
    2. Test status:
      2.1 Pending - test won't be shown to students
      2.2 Running - test will be shown and students can give test
3. Add class / student
    1. Add a new class
    2. Add a new student to the class
4. View Data
    1. Shows student user id / roll numbers given a class
5. Test Details ( on clicking a previously created test from dashboard )
    1. Change status of Quiz ( PENDING / RUNNING )
    2. Complete / delete test
    3. Add new student explicitly for the test
    4. Add questions to the test

### Technology Stack
- HTML, CSS, BOOTSTRAP (Front-end)
- PHP (Backend)
- MYSQL Database
  
### Collaborate with us!
Want to contribute? Great!<br/>

To fix a bug or enhance an existing module, follow these steps:

- Fork the repo
- Create a new branch (`git checkout -b improve-feature`)
- Make the appropriate changes in the files
- Add changes to reflect the changes made
- Commit your changes (`git commit -am 'Improve feature'`)
- Push to the branch (`git push origin improve-feature`)
- Create a Pull Request 
  
 
### Bug / Feature Request

If you find a bug (the website couldn't handle the query and / or gave undesired results), kindly open an issue [here](https://github.com/iamrohitsuthar/quizller/issues/new).

If you'd like to request a new function, feel free to do so by opening an issue [here](https://github.com/iamrohitsuthar/quizller/issues/new).
