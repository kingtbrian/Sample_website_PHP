<?php


function show_homepage($themeOff, $darkmode) {
    $homepageClass = ($darkmode)? "homepageDark" : "homepage";

    echo "<div class=\"$homepageClass\">
           <div class=\"mainContainer\">";

    homepage_header();

    echo "<hr class=\"lineSeparator\">";

    homepage_content_table($themeOff);
    homepage_footer();

    echo "</div>
         </div>";
}

function homepage_header() {
    echo "
    <div class=\"headerContainer\">
			<table>
				<tr>
					<td>
						<div class=\"headerTitle\">
							<h1>Brian King</h1>
							<h2>Software Engineer</h2>
						</div>
					</td>
					<td class=\"pictureCell\">
						<div class=\"headerImage\">
							<img src=\"/utsaimage.jpg\">
						</div>
					</td>
				</tr>
			</table>
		</div>
	";
}

function homepage_content_table($themeOff) {
    echo "
    <div class=\"contentContainer\">
        <table>
            <tr>";
              homepage_left_column($themeOff);
              homepage_middle_column();
              homepage_right_column($themeOff);
    echo "
            </tr>
        </table>
    </div>
    ";
}

function homepage_left_column($themeOff) {
    $leftContentClass = ($themeOff)? "blankTheme" : "leftUtsaTheme";

    echo "
    <td>
    <div class=\"$leftContentClass\">
        <h3>Menu</h3>
        <hr>
        <ul>
            <li>
                <a href=\"https://github.com/\">github</a>
            </li>
            <li>
                <a href=\"/courses.php\">Courses</a>
            </li>
            <li>
                <a href=\"https://www.utsa.edu/\">UTSA</a>
            </li>
        </ul>
    </div>
    </td>
    ";
}

function homepage_middle_column() {
    echo "
    <td>
    <div class=\"centerContentContainer\">
        <h3>About Me</h3>
        <br>
        <div class=\"aboutImg\">
            <img src=\"/AboutMeImage.jpg\">
        </div>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc efficitur, lorem nec mollis vestibulum, 
        sem arcu vehicula sem, non pretium ex ex nec felis. Ut ut ligula quis nulla placerat ultricies 
        elementum sed massa. In hac habitasse platea dictumst. Nulla ut mattis lorem. Proin pellentesque risus 
        in lorem suscipit luctus. Sed malesuada euismod augue. Vestibulum a posuere est, sit amet feugiat tortor. 
        Etiam scelerisque justo nec tristique tristique. Sed malesuada rhoncus vestibulum. Curabitur vehicula venenatis 
        neque, at ultricies elit malesuada sed.Pellentesque non dolor quis est fringilla scelerisque nec a quam. 
        Quisque nec tortor nibh. Phasellus eros massa, finibus ac urna non, congue consequat ligula. Fusce ut augue
        feugiat, pellentesque erat a, pulvinar ligula. Donec vitae eros dui. Nunc in risus vel nibh ullamcorper facilisis. 
        </p>
        <br>
        <p>
        Sed viverra pretium eleifend. Nulla bibendum feugiat augue congue dictum. Cras sit amet mollis urna.Aliquam augue 
        purus, convallis a ornare ac, pellentesque vel tellus. Sed vitae neque a nibh varius vehicula. Aliquam erat 
        volutpat. In hac habitasse platea dictumst. Vestibulum viverra mauris sit amet felis auctor, vitae cursus erat
        imperdiet. Cras venenatis lorem sit amet nibh auctor sodales. Cras mattis et ligula vel finibus. Praesent in massa 
        nec purus ultricies accumsan ut vel sem.
        </p>
    </div>
    </td>
    ";
}

function homepage_right_column($themeOff) {
    $rightContentClass = ($themeOff)? "blankTheme" : "rightUtsaTheme";

    echo "
    <td>
    <div class=\"$rightContentClass\">
        <h4>Enrolled courses</h4>
        <hr>
        <ol>
            <li>CS4413</li>
            <li>CS4833</li>
            <li>CS3713</li>
            <li>CS3313</li>
        </ol>
        <br>
        <div class=\"themeForm\">
            <h4>Theme Toggles</h4>
            <hr>
            <form action=\"index.php\" method=\"post\">
                <input type=\"submit\" id=\"theme\" name=\"utsaThemeToggle\" value=\"UTSA Theme\">
            </form>
            <form action=\"index.php\" method=\"post\">
                <input type=\"submit\" id=\"darkmode\" name=\"darkmodeToggle\" value=\"Dark Mode\">
            </form>

        </div>
    </div>
    </td>
    ";
}

function homepage_footer() {
    echo "
    <div class=\"footerContainer\">
			<p>Copyright 2020 Brain King</p>
	</div>
	";
}