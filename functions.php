<?php 
error_reporting(E_ERROR | E_PARSE);
function load_css(){
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap');

    wp_register_style('maincss', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style('maincss');
}


add_action('wp_enqueue_scripts', 'load_css' );

function load_js(){
    wp_enqueue_script('jquery');
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true);
    wp_enqueue_script('bootstrap');
}
add_action('wp_enqueue_scripts', 'load_js' );


//Themes Options
add_theme_support('menus');
add_theme_support( "post-thumbnails");
add_theme_support( "widgets");


//Menus
register_nav_menus(
    array(
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location',
        'footer-menu' => 'Footer Menu Location',
    )
);
    

// custom image sizes

add_image_size( "blog-large", 1000, 500, true );
add_image_size( "blog-small", 400, 200, true );

//Restiter Sidebars

function my_sidebars(){
    register_sidebar( 
        array(
            'name' => 'Page Sidebar',
            'id' => 'page-sidebar',
            "before_title" => '<h4 class="widget-title">',
            'after_title' => '</h4>'
        )

    );

    register_sidebar( 
        array(
            'name' => 'Blog Sidebar',
            'id' => 'blog-sidebar',
            "before_title" => '<h4 class="widget-title">',
            'after_title' => '</h4>'
        )

    );



}
add_action( "widgets_init",'my_sidebars' );

function my_first_post_type(){
    $args = array(
        "labels"=> array(
            "name"=> "Cars",
            "singular_name" => "Car",
        ),
        'hierarchical'=>false,
        "public"=> true,
        "has_archive"=> true,
        "menu_icon"=> "dashicons-images-alt2",
        "supports" => array("title","editor","thumbnail", "custom-fields"),
        "rewrite" => array("slug" => "my-cars")
    );

    register_post_type( "cars", $args);
}
add_action("init","my_first_post_type");


function my_first_taxonomy(){
    $args = array(
        "labels"=> array(
            "name"=> "Brands",
            "singular_name" => "Brand",
        ),
        
        "public"=> true,
        'hierarchical'=> true,

    );
    register_taxonomy( "brands", array("cars"), $args);
}
add_action("init","my_first_taxonomy");



add_action("wp_ajax_enquiry", "enquiry_form");
add_action("wp_ajax_nopriv_enquiry", "enquiry_form");

function enquiry_form(){
    /*if(!wp_verify_nonce( $_POST["nonce"],"ajax-nonce")){
        wp_send_json_error( "Nonce is Incorrect",401 );
        die();
    }
    $formdata = [];
    wp_parse_str($_POST['enquiry-form'], $formdata);

    $admin_email = get_option("admin_email");
    $headers[] = "Content-Type: text/html; charset=UTF-8";
    $headers[] = "From: " . $admin_email;
    $headers[] = "Reply-to: " . $formdata["fname"] . " <" . $formdata["email"] . ">";

    $send_to = $admin_email;
    $subject = "Enquiry form " . $formdata["fname"] . " " . $formdata["lname"];

    $message = "";
    foreach ($formdata as $index => $field) {
        $message .= "<strong>" . $index . "</strong> " . $field . "<br>";
    }

    try {
        if (wp_mail($send_to, $subject, $message, $headers)) {
            wp_send_json_success("Email Sent");
        } else {
            wp_send_json_error("Error");
        }
    } catch (Exception $ev) {
        wp_send_json_error($ev->getMessage());
    }*/
    wp_mail("hemanjini.peddireddi@bridgera.com", "subject", "message");
}

/*add_action('phpmailer_init','custom_mailer');
function custom_mailer( $phpmailer )
{

	$phpmailer->SetFrom('hemanjini@outlook.com', 'Hemanjini Peddireddy');
	$phpmailer->Host = 'smtp-mail.outlook.com';
	$phpmailer->Port = 587;
	$phpmailer->SMTPAuth = true;
	$phpmailer->SMTPSecure = 'tls';
	$phpmailer->Username = "hemanjini@outlook.com";
	$phpmailer->Password = "Anjini@123";
	$phpmailer->IsSMTP();

}*/

function mailtrap($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = '2f7d458fe90d04';
    $phpmailer->Password = 'c2bd6cb1d01a83';
}

add_action('phpmailer_init', 'mailtrap');


function my_shortcode(){
    ob_start();

	print_r($content);

	set_query_var('attributes', $atts);

	get_template_part('includes/latest', 'cars');

	return ob_get_clean();
}
add_shortcode("latest_cars","my_shortcode");