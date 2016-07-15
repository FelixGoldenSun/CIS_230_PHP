<?php

$page_title = "Test";

require "templates/header.php";
require "templates/functions.php";

?>

<p>DOOR</p>

<?php

  $bill = $_POST["bill"];
  $percent = $_POST["percent"];
  $tip = $bill * $percent;
  $question = $_POST["question"];
  $email = $_POST["email"];
  $product = $_POST["product"];
  $products = array("phone" => 1, "tablet" => 2, "PC" => 3, "PSP" => 4);
  $text_questions = $_POST["question"];

    //<select name="product">
      //<option value=1>Phone</option>
      //<option value=2 selected>Tablet</option>
     // <option value=3>PC</option>
    //</select>


 if( empty($email)){
   $email_error = "Email is required!";
 }
 else{
   $email_error = "none";
 }

 if( empty($bill)){
   $bill_error = "bill amount is required";
 }
 else{
   $bill_error = "none";
 }

echo "<p>PRODUCT: " . $product . "</p>";



echo "<P>The tip is: $" . money_format("%i", $tip) . "</P>";

$menu_string = selectMenu($products, $product);

$form = <<<END_OF_FORM
  <form method="post" action="/test.php">
    <label>Enter tip bill</label>
    <input type="text" name="bill" value="$bill" size="50"> Error: $bill_error <br/>
    <label>Enter tip percent</label>
    <input type="text" name="percent" value="$percent" size="50">
    <label>EEEEMAIIIIL</label>
    <input type="email" name="email" value="$email">Error: $email_error <br/>
    <input type="submit" name="Calculate"> <br/>

    <textarea name="question">$text_questions</textarea>

    $menu_string
  </form>

END_OF_FORM;
echo $form;

?>

<?php

require "templates/footer.php"

?>

