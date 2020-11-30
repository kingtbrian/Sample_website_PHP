<?php

include_once "template.php";
include_once ".env.php";

if (is_array($_POST) && !empty($_POST)) {
    if (isset($_POST['addClass'])) {
        insert_course();
    }
}

if (is_array($_GET) && !empty($_GET)) {
    if (isset($_GET['d'])) {
        delete_course();
    }
}


html_top("Courses", array("homepage_courses.css"));
show_courses();
html_bottom();


function show_courses() {
    echo "<div>
            <a href=\"index.php\">Back to Homepage</a>
          </div>
          ";
    show_add_course_form();
    show_courses_table();
    echo "<hr>
         ";
}

function show_add_course_form() {
    echo "<div class=\"coursesHeader\">
            <hr>
            <h2>Add Class</h2>
            <hr>
		  </div>
		  <table>
			<form action=\"courses.php\" method=\"post\">
				<tr>
					<div>
						<th>
							<label for=\"cname\">Course Name</label>
						</th>
						<th>
							<label for=\"cnum\">Course Number</label>
						</th>
						<th>
							<label for=\"desc\">Description</label>
						</th>
						<th>
							<label for=\"fgrade\">Final Grade</label>
						</th>
						<th>
							<label for=\"enrolled\">Enrolled?</label>
						</th>
					</div>
				</tr>
				<tr>
					<div>
						<td>
							<input type=\"text\" id=\"cname\" name=\"cname\" placeholder=\"Enter Name...\">
						</td>
						<td>
							<input type=\"text\" id=\"cnum\" name=\"cnum\" placeholder=\"Enter up to four numbers...\" pattern=\"[0-9]{0,4}\" title=\"Input must be numbers 0 to 9 with a maximum of four total.\">
						</td>
						<td>
							<textarea type=\"text\" id=\"desc\" name=\"desc\" rows=\"1\" cols=\"35\" placeholder=\"Max 1024 character description...\"></textarea>
						</td>
						<td>
							<input type=\"text\" id=\"fgrade\" name=\"fgrade\" placeholder=\"Enter single letter grade\" pattern=\"^[a-zA-Z]{1}\" title=\"Input must be a single letter.\">
						</td>
						<td>
							<input type=\"checkbox\" id=\"enrolled\" name=\"enrolled\" value=\"1\">
						</td>
						<td>
							<input type=\"submit\" name=\"addClass\" value=\"Add Class\">
						</td>
					</div>
				</tr>
			</form>
		</table>
		";
}

function show_courses_table() {
    echo "<div class=\"coursesTitle\">
            
                <hr>
                <h2>Current Courses</h2>
                <hr>
          </div>
          <div class=\"coursesList\">
		  <table>
		  ";

    echo "<tr>
            <div>
                <th>
                    Course Name
                </th>
                <th>
                    Course Number
                </th>
                <th>
                    Description
                </th>
                <th>
                    Grade
                </th>
                <th>
                    Delete
                </th>
            </div> 
          </tr>
          ";

    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);

    if (!$con)
        exit("<p>Connection Error: " . mysqli_connect_error() . "</p>");

    $query = "select * from courses";
    $result = mysqli_query($con, $query);

    if (!$result)
        exit("<p>Error selecting: " . mysqli_error($con) . "</p>");

    while ($row = mysqli_fetch_assoc($result)) {
        $status = ($row['course_enrolled'])? "enrolled" : "";
        $link = "/courses.php?d=" . $row[id];
        echo "<tr class=\"$status\"> 
                <td>
                    $row[course_name]
                </td>
                <td>
                    $row[course_number]
                </td>
                <td>
                    $row[course_description]
                </td>
                <td>
                    $row[course_final_grade]
                </td>
                <td>
                    <a href=\"$link\">Delete Course</a>
                </td>
              </tr>";
    }
    echo "</table>
         </div>";

    mysqli_close($con);
}

function insert_course() {
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
    if (!con)
        exit("<p>Connection Error: " . mysqli_connect_error() . "</p>");

    $stmt = mysqli_stmt_init($con);
    if (!$stmt)
        exit("<p>Failed to initialize statement</p>");

    $query = "insert into courses (course_name, course_number, course_description, course_final_grade, course_enrolled)
                          values  (?, ?, ?, ?, ?)";
    if (!mysqli_stmt_prepare($stmt, $query))
        exit("<p>Failed to prepare statement</p>");

    $name = mysqli_real_escape_string($con, $_POST['cname']);

    $number = preg_replace("/[^0-9]/",'', mysqli_real_escape_string($con, $_POST['cnum']));
    if (strlen($number) > 4)
        $number = substr($number, 0, 4);

    $description = mysqli_real_escape_string($con, $_POST['desc']);

    $grade = preg_replace("/[^A-Za-z]/",'', mysqli_real_escape_string($con, $_POST['fgrade']));
    if (strlen($grade) > 1)
        $grade = substr($grade, 0, 1);

    $enrolled = (isset($_POST['enrolled']))? 1 : 0;

    mysqli_stmt_bind_param($stmt, "ssssi", $name, $number, $description, $grade, $enrolled);

    if (!mysqli_stmt_execute($stmt))
        exit("<p>Failed to execute statement</p>");

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

function delete_course() {
    if (!is_numeric($_GET['d']))
        return;

    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
    if (!con)
        exit("<p>Connection Error: " . mysqli_connect_error() . "</p>");

    $stmt = mysqli_stmt_init($con);
    if (!$stmt)
        exit("<p>Failed to initialize statement</p>");

    $query = "delete from courses where id = ?";
    if (!mysqli_stmt_prepare($stmt, $query))
        exit("<p>Failed to prepare statement</p>");

    $course_id = mysqli_real_escape_string($con, $_GET['d']);
    mysqli_stmt_bind_param($stmt, "i", $course_id);

    if (!mysqli_stmt_execute($stmt))
        exit("<p>Failed to execute statement</p>");

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
// create database course
// use course
/*
create table courses (
    id int unsigned not null auto_increment,
    course_number char(4),
    course_name varchar(128),
    course_description varchar(1024),
    course_final_grade char(1),
    course_enrolled bool,
    primary key (id)
);
*/

// create user 'registrar'@'webtech' identified by 'okpassword';
// grant all privileges on course.* to 'registrar'@'webtech';
// flush privileges;
