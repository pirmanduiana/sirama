<?php
if(isset($_GET['format']) &amp;amp;amp;amp;&amp;amp;amp;amp; intval($_GET['num'])) {
    //Set our variables
    $format = strtolower($_GET['format']);
    $num = intval($_GET['num']);
    //Connect to the Database
    $con = mysqli_connect('localhost', 'root', '') or die ('MySQL Error.');
    mysqli_select_db('api', $con) or die('MySQL Error.');
    //Run our query
    $result = mysqli_query('SELECT * FROM recipes ORDER BY `recipe_id` DESC LIMIT ' . $num, $con) or die('MySQL Error.');
    //Preapre our output
    if($format == 'json') {
        $recipes = array();
        while($recipe = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $recipes[] = array('post'=>$recipe);
        }
        $output = json_encode(array('posts' => $recipes));
    } elseif($format == 'xml') {
        header('Content-type: text/xml');
        $outputÂ  = "<?xml version=\"1.0\"?>\n";
        $output .= "<recipes>\n";
        for($i = 0 ; $i < mysql_num_rows($result) ; $i++){
            $row = mysqli_fetch_assoc($result);
            $output .= "<recipe> \n";
            $output .= "<recipe_id>" . $row['recipe_id'] . "</recipe_id> \n";
            $output .= "<recipe_name>" . $row['recipe_name'] . "</recipe_name> \n";
            $output .= "<recipe_poster>" . $row['recipe_poster'] . "</recipe_poster> \n";
            $output .= "<recipe_quick_info>" . $row['recipe_quick_info'] . "</recipe_quick_info> \n";
            $output .= "<recipe_link>" . $row['recipe_link'] . "</recipe_link> \n";
            $output .= "</recipe> \n";
        }
        $output .= "</recipes>";
    } else {
        die('Improper response format.');
    }
    //Output the output.
    echo $output;
}
?>