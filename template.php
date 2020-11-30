<?php

function html_top($title, $css_files_array) {
    echo "
    <html lang=\"en-US\">
    <head>
	    <title>
		   $title
	    </title>
	    ";
	    foreach($css_files_array as $value) {
	        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$value\">";
	    }
    echo "</head>
          <body class=\"mainContainer\">";

}



function html_bottom() {
    echo "
    </body>
    </html>
    ";
}