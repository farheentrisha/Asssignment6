<?php 
$error='';
$name='';
$email='';
function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}
if(isset($_POST["submit"]))
{
    if(empty($_POST["name"]))
    {
        $error .= '<p><label class ="text-danger">Please enter your name</label></p>';
    }
    else{
        $name = clean_text($_POST["name"]);
        if(!preg_match("/^[a-zA-Z]*$/",$name))
        {
            $error .= '<p><label class ="text-danger">only letters and white spaces are allowed</label></p>';
        }
    }
    if(empty($_POST["email"]))
    {
        $error .= '<p><label class ="text-danger">Please enter your email</label></p>';
    }
    else
    {
        $email = clean_text($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error .= '<p><label class ="text-danger">Invalid format</label></p>';
        }
    }
    if($error == '')
    {
        $file_open = fopen("c:\Users\USER\Desktop\module_3\user.csv", "a");
        $no_rows = count(file("user.csv"));
        if($no_rows >1)
        {
            $no_rows = ($no_rows -1)+1;
        }
        $form_data = array(
            'name' => $name,
            'email' => $email

        );
        fputcsv($file_open, $form_data);
        $error .= '<p><label class ="text-danger">account created successfully</label></p>';
        $name='';
        $email='';
    }

}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> First html</title>
    </head>
    <body>
        <form>
            <table>
                <?php echo $error; ?>
                <tr>
                    <td>
                        Name:
                    </td>
                    <td>
                        <input type="text" name="name">
                        <?php echo $name ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Email:
                    </td>
                    <td>
                        <input type="mail" placeholder="Email" name="email">
                        <?php echo $email; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Profile picture:
                    </td>
                   <td>
                       <input class="file-upload-input" type="file" onchange="readURL(this)" accept="Image/*">
                   </td>
                </tr>
                <tr>
                    <td>
                        <input type="Submit" value="Submit" name="">
                    </td>
                </tr>
                
            </table>
        </form>
    </body>
</html>
