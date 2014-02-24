<?php

/**
* Init
*
* @internal Let the rest of the template access the magic
*
*/

// Grab slug for use in creation question loops

$ebrands->config = eBconfig::get_config();
$ebrands->conditional = eBconditional::get_conditional();
$ebrands->portfolio = eBportfolio::get_portfolio();




function register_my_menus() {
  register_nav_menus(
    array(
      'navigation' => __( 'Navigation' ),
      'footer' => __( 'Footer' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"nav\">\n";
  }
}


/* Portfolio */

add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'portfolio',
        array(
            'labels' => array(
                'name' => __( 'Portfolio' ),
                'singular_name' => __( 'Portfolios' )
            ),
        'public' => true,
        'has_archive' => true,
        )
    );
}

/**
* Exceprts 
*
*
**/

/* Posts */
function excerpt_read_more_link($output) {
    global $post;
    return $output . '<a href="'. get_permalink($post->ID) . '"> Read More...</a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');

/* Pages */
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

/* Porfolio */
add_action( 'init', 'my_add_excerpts_to_portfolio' );
function my_add_excerpts_to_portfolio() {
    add_post_type_support( 'portfolio', 'excerpt' );
}



/**
* Config
*
* @internal This sets the environment stuff based on the subdomain
*
*/

class eBconfig
{

    // Singleton
    private static $me;
    public static function get_config()
    {
        if(is_null(self::$me)) {
            self::$me = new eBconfig();
        }
        return self::$me;
    }

    // Valid subdomains
    private $subdomains = array(
        'www'   => 'production',
        'stage' => 'staging',
        'dev'   => 'local'
    );

    // Keep it secret
    private $subdomain = null;
    private $env       = null;
    private $template  = null;

    private function __construct()
    {
        $this->set();
        $this->{'setup_'.$this->env}();
    }

    public function set()
    {
        list($subdomain) = explode('.', getenv('HTTP_HOST'));
        $this->subdomain = $subdomain;
        $this->env       = $this->subdomains[$subdomain];
        $this->template  = $this->template_url();
    }

    public function get($key = null)
    {
        $store = array(
            'subdomain' => $this->subdomain,
            'env'       => $this->env,
            'template'  => $this->template
        );
        if ($key == null) {
            return $store;
        } else {
            return $store[$key];
        }
    }

    private function template_url()
    {
        return str_replace('http:', null, get_template_directory_uri());
    }

    // Add code/variables to be run only on production
    private function setup_production()
    {
        ini_set('display_errors', '0');
        define('WEB_ROOT', '/');
    }

    // Add code/variables to be run only on stage
    private function setup_staging()
    {
        ini_set('display_errors', '1');
        ini_set('error_reporting', E_ALL);
        define('WEB_ROOT', '');
    }

    // Add code/variables to be run only on local (testing) servers
    private function setup_local()
    {
        ini_set('display_errors', '1');
        ini_set('error_reporting', E_ALL);
        define('WEB_ROOT', '');
    }
}


/**
* Conditional
*
* @internal All the kinda if/elsey stuff we don't want in the template itself
*
*/

class eBconditional
{
    // Singleton
    private static $me;
    public static function get_conditional()
    {
        if(is_null(self::$me)) {
            self::$me = new eBconditional();
        }
        return self::$me;
    }

    // Shhhhh
    private $meta = null;
    private $css = null;
    private $js_head = null;
    private $js_foot = null;
    private $classes = null;

    private function __construct()
    {
        $this->set();
    }

    public function set()
    {
        $ebrands->config = eBconfig::get_config();

        // Get WP body classes, add in our own, then convert array to string
        $body_class_array = get_body_class(array($ebrands->config->get('env')));
        $body_classes = implode(' ', $body_class_array);


        // CSS and JS stuff
        $env = $ebrands->config->get('env');
        $template = $ebrands->config->get('template');
        if ($env == 'local') {
            $css_type = 'text/less';
            $css = array(
                $template.'/assets/css/network.less'
            );
            $js_head = array(
                //$template.'/assets/js/vendors/modernizr/modernizr.js',
                $template.'/assets/js/vendors/less.js/less-1.4.1.min.js',
                $template.'/assets/js/vendors/todo/jquery.js',
                $template.'/assets/js/vendors/todo/html5shiv.js'
            );
            $js_foot = array(
                $template.'/assets/js/vendors/bootstrap/transition.js',
                $template.'/assets/js/vendors/bootstrap/alert.js',
                $template.'/assets/js/vendors/bootstrap/modal.js',
                $template.'/assets/js/vendors/bootstrap/dropdown.js',
                $template.'/assets/js/vendors/bootstrap/scrollspy.js',
                $template.'/assets/js/vendors/bootstrap/tab.js',
                $template.'/assets/js/vendors/bootstrap/tooltip.js',
                $template.'/assets/js/vendors/bootstrap/popover.js',
                $template.'/assets/js/vendors/bootstrap/button.js',
                $template.'/assets/js/vendors/bootstrap/collapse.js',
                $template.'/assets/js/vendors/bootstrap/carousel.js',
                $template.'/assets/js/vendors/bootstrap/affix.js'
            );
        }
        else {
            $css_type = 'text/css';
            $css = array(
                $template.'/assets/css/network.css'
            );
            $js_head = array(
                $template.'/assets/js/vendors/modernizr/modernizr.min.js'
            );
            $js_foot = array(
                $template.'/assets/js/vendors/bootstrap/bootstrap.min.js'
            );
        }
     
        $this->js_head[] = '<script>less = {env:"development"};</script>';
        $this->js_head[] = '<script src="http://code.jquery.com/jquery.js"></script>';
           
        // Now wrap that stuff with this stuff!
        foreach ($css as $href) {
            $this->css[] = '<link rel="stylesheet" type="'.$css_type.'" href="'.$href.'" media="all" />';
        }
        foreach ($js_head as $src) {
            $this->js_head[] = '<script src="'.$src.'"></script>';
        }
        foreach ($js_foot as $src) {
            $this->js_foot[] = '<script src="'.$src.'"></script>';
        }


        
        // Everything is now good, cept the meta...
        $this->css     = implode(PHP_EOL, $this->css).PHP_EOL;
        $this->js_head = implode(PHP_EOL, $this->js_head).PHP_EOL;
        $this->js_foot = implode(PHP_EOL, $this->js_foot).PHP_EOL;
        $this->classes = $body_classes;

        // This cool chunk runs through all the WP conditionals, and runs subsequent functions (if they exist)
        $conditionals = array(
            '404'           => is_404(),
            'admin'         => is_admin(),
            'archive'       => is_archive(),
            'author'        => is_author(),
            'category'      => is_category(),
            'date'          => is_date(),
            'front_page'    => is_front_page(),
            'home'          => is_home(),
            'ssl'           => is_ssl(),
            'page'          => is_page(),
            'paged'         => is_paged(),
            'search'        => is_search(),
            'single'        => is_single(),
            'singular'      => is_singular(),
            'tag'           => is_tag()
        );

        foreach ($conditionals as $key => $conditional) {
            if ($conditional) {
                $function = 'setup_is_'.$key;
            } else {
                $function = 'setup_is_not_'.$key;
            }
            if (method_exists('eBconditional', $function)) {
                $this->{$function}();
            }
        }
    }
    private function setup_is_search()
    {
        $this->meta .= '<meta name="robots" content="noarchive" />'.PHP_EOL;
    }

    private function setup_is_not_search()
    {
        $this->meta .= '<meta name="robots" content="noindex, nofollow" />'.PHP_EOL;
    }

    // private function setup_is_singular()
    // {
    //     //global $post;
    //     $am->post               = AmPost::get_post();
    //     $short_title            = $am->post->title;
    //     $title                  = $short_title.$this->postfix;
    //     $description            = $am->post->excerpt_meta;
    //     $image                  = get_image_data($am->post->image_main, "xlarge");
    //     $image_path             = $image['variant_url'];
    //     $author                 = $am->post->author;
    //     $permalink              = $am->post->permalink;
        
    //     $conditional_meta       = '<meta name="author"                       content="'.$author.'" />'.PHP_EOL;
    //     // Facebook
    //     $conditional_meta      .= '<meta property="og:title"                 content="'.$short_title.'" />'.PHP_EOL;
    //     $conditional_meta      .= '<meta property="og:image"                 content="'.$image_path.'" />'.PHP_EOL;
    //     $conditional_meta      .= '<meta property="og:description"           content="'.$description.'" />'.PHP_EOL;
    //     $conditional_meta      .= '<meta property="og:url"                   content="'.$permalink.'" />'.PHP_EOL;
    //     // Google +1
    //     $conditional_meta      .= '<meta itemprop="name"                     content="'.$short_title.'">'.PHP_EOL;
    //     $conditional_meta      .= '<meta itemprop="image"                    content="'.$image_path.'">'.PHP_EOL;
    //     $conditional_meta      .= '<meta itemprop="description"              content="'.$description.'">'.PHP_EOL;
        
    //     $this->title            = $title;
    //     $this->description      = $description;
    //     $this->conditional_meta = $conditional_meta;
    // }

    public function get($key = null)
    {
        $store = array(
            'meta'    => $this->meta,
            'css'     => $this->css,
            'js_head' => $this->js_head,
            'js_foot' => $this->js_foot,
            'classes' => $this->classes
        );
        if ($key == null) {
            return $store;
        } else {
            return $store[$key];
        }
    }

}

/**
* Page/Post
*
* @internal All the kinda if/elsey stuff we don't want in the template itself
*
*/

class eBportfolio
{
    // Singleton
    private static $me;
    public static function get_portfolio()
    {
        if(is_null(self::$me)) {
            self::$me = new eBportfolio();
        }
        return self::$me;
    }

    public function display($slug) {
        $args = array('post_type' => 'portfolio', 'posts_per_page' => -1, 'appearsin' => $slug);
        $loop = new WP_Query($args);
        $count = 1;
        $this->portfolio = '<div id="portfolio" class="accordion">';
        while ($loop->have_posts()) {
            $loop->the_post();
            $this->portfolio .= '<div class="accordion-group">';
            $this->portfolio .= '<div class="accordion-heading">';
            $this->portfolio .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#portfolio" href="#portfolio-'.$count.'">'.get_the_title().'</a>';
            $this->portfolio .= '</div>';
            $this->portfolio .= '<div id="portfolio-'.$count.'" class="accordion-body collapse">';
            $this->portfolio .= '<div class="accordion-inner">';
            $this->portfolio .= '<a href="'.get_permalink().'">'.get_the_content().'</a>';
            $this->portfolio .= '</div>';
            $this->portfolio .= '</div>';
            $this->portfolio .= '</div>';
            $count ++;
        }
        // Reset Post Data
        wp_reset_postdata();
        $this->portfolio .= '</div>';
        return $this->portfolio;
    }
}





/**
* Wordpress Shortcodes
*
* @internal Add shortcodes for use in editor
*
*/


// Define shortcodes
add_shortcode('porfolios', 'display_porfolios');

// Build block shortcode
function display_porfolios($params){
    // Extract parameters and supply default values
    extract(shortcode_atts(array('type' => false, 'id' => false), $params));
    // Only proceed if the shortcode has variables to use
    if ($type && $id) {
        $attr = ($type == 'category') ? 'category_name' : 'tag';
        // Setup variables
        $args = array('post_type' => 'porfolio', 'posts_per_page' => -1, $attr => $id);
        $loop = new WP_Query($args);
        $instance = mt_rand();
        $count = 1;
        $output = '<div id="porfolio-'.$instance.'" class="accordion">';
        while ($loop->have_posts()) {
            $loop->the_post();
            $output .= '<div class="accordion-group">';
            $output .= '<div class="accordion-heading">';
            $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#porfolio-'.$instance.'" href="#portfolio-'.$count.'">'.get_the_title().'</a>';
            $output .= '</div>';
            $output .= '<div id="portfolio-'.$count.'" class="accordion-body collapse">';
            $output .= '<div class="accordion-inner">';
            $output .= '<a href="'.get_permalink().'">'.get_the_content().'</a>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $count ++;
        }
        // Reset Post Data
        wp_reset_postdata();
        $output .= '</div>';
        return $output;
    }
}

