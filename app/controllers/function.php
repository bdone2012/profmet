<?php
function getPages(){
  global $wp_query, $wp_rewrite;
  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
  $pagination = array(
      'base' => @add_query_arg('paged','%#%'),
      'format' => '',
      'total' => $wp_query->max_num_pages,
      'current' => $current,
      'prev_next' => false,
      'type' => 'array'
  );
  if( $wp_rewrite->using_permalinks() )
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
  if( !empty($wp_query->query_vars['s']) )
    $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
  return paginate_links( $pagination );
};
add_filter('show_admin_bar', '__return_false');
function pagination(){
  $pagination = getPages();
    foreach ($pagination as $page_number) {
      if($page_number[1]=='s'){
        echo "<span class='page current'>" . strip_tags($page_number) . "</span>";
      } else{
        echo "<span class='page'>" . $page_number . "</span>";
      }
    }
};
function nextAndPrev(){
  $pages = getPages();
  if(sizeof($pages) == 1 || $pages == null){
    return false;
  }else{
    return true;
  }
};
function pageOne(){
  $pages = getPages();
  foreach ($pages as $page_number) {
    if($page_number[1]=='s'){
      if(strip_tags($page_number) == 1){
        return true;
      } else{
      return false;
      }
    }
  }
};
function lastPage(){
  $pages = getPages();
  $last = sizeof($pages);
  foreach ($pages as $page_number) {
    if($page_number[1]=='s'){
      if(strip_tags($page_number) == $last){
        return true;
      } else{
      return false;
      }
    }
  }
}
function category_color($category){
  if($category == "Future of Content"){
    echo "future";
  }elseif($category== "Brand Publishing"){
    echo "brand";
  }elseif($category == "Storytelling"){
    echo "storytelling";
  }else{
    echo "other";
  };
}
function source_avatar($author_id){
  $avatar = get_avatar_url(get_avatar($author_id));
  if($avatar != ""){
    return $avatar;
  }else{
    return bloginfo('template_directory').'/images/pandamouse.png';
  }
}
function get_avatar_url($get_avatar){
    preg_match('/src="(.*?)"/i', $get_avatar, $matches);
    return $matches[1];
}
add_theme_support( 'post-thumbnails' );
add_image_size( 'popular-thumb', 460, 9999 );
add_image_size( 'small-thumb', 200, 9999 );
add_image_size( 'related-thumb', 280, 9999 );
add_image_size( 'sponsored-thumb', 600, 485 );
add_image_size( 'featured-thumb', 1024, 500 );
add_image_size( 'full-thumb', 2400, 9999 );
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
function get_post_attachment_url($id){
  $attachments = new Attachments( 'attachments' );
  if( $attachments->exist() ){
    while( $attachments->get() ) :
      return $attachments->url();
    endwhile;
  } else {
    return get_permalink($id);
  }
}
function navItem($title, $url){
  $class = "";
  if($title == get_the_title()){
    $class = ' class="active"';
  }
  echo "<li><a".$class." href='".get_bloginfo("url")."/".$url."/'>".$title."</a></li>";
}
function custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length');

function new_excerpt_more( $more ) {
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function get_the_twitter_excerpt(){
$excerpt = get_the_excerpt();
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$the_str = substr($excerpt, 0, 140);
return $the_str;
}
function get_excerpt(){
$excerpt = get_the_excerpt();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, 140);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
$excerpt = $excerpt.'...';
return $excerpt;
}
function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}
add_filter('pre_get_posts','SearchFilter');
// Custom WordPress Login Logo
function login_css() {
  wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/login.css' );
}
add_action('login_head', 'login_css');
?>
<?php
// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');
function baw_create_menu() {
  //create new top-level menu
  add_menu_page('Weekly Top Posts', 'Weekly Top Posts', 'administrator', __FILE__, 'baw_settings_page',plugins_url('images/favicon.png', __FILE__));
  //call register settings function
  add_action( 'admin_init', 'register_mysettings' );
}
function register_mysettings() {
  //register our settings
  register_setting( 'baw-settings-group', 'weekly_post_1' );
  register_setting( 'baw-settings-group', 'weekly_post_1_url' );
  register_setting( 'baw-settings-group', 'weekly_post_2' );
  register_setting( 'baw-settings-group', 'weekly_post_2_url' );
  register_setting( 'baw-settings-group', 'weekly_post_3' );
  register_setting( 'baw-settings-group', 'weekly_post_3_url' );
  register_setting( 'baw-settings-group', 'weekly_post_4' );
  register_setting( 'baw-settings-group', 'weekly_post_4_url' );
  register_setting( 'baw-settings-group', 'weekly_post_5' );
  register_setting( 'baw-settings-group', 'weekly_post_5_url' );
}
function get_cat_slug($cat_id) {
  $cat_id = (int) $cat_id;
  $category = &get_category($cat_id);
  return $category->slug;
}
// Custom mobile detection
function isMobilePhone() {
  $useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
  return true;
}
function baw_settings_page() {
?>
<div class="wrap">
<h2>The top posts of the week, yo!</h2>
<p><em>Enter the SLUG of the posts you want to display at the bottom of posts:</em></p>
<form method="post" action="options.php">
    <?php settings_fields( 'baw-settings-group' ); ?>
    <?php do_settings_sections( 'baw-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Top Post Number 1</th>
        <td><input type="text" name="weekly_post_1" value="<?php echo esc_attr( get_option('weekly_post_1') ); ?>" />« Headline&nbsp;&nbsp;Link »<input type="text" name="weekly_post_1_url" value="<?php echo esc_attr( get_option('weekly_post_1_url') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Top Post Number 2</th>
        <td><input type="text" name="weekly_post_2" value="<?php echo esc_attr( get_option('weekly_post_2') ); ?>" />« Headline&nbsp;&nbsp;Link »<input type="text" name="weekly_post_2_url" value="<?php echo esc_attr( get_option('weekly_post_2_url') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Top Post Number 3</th>
        <td><input type="text" name="weekly_post_3" value="<?php echo esc_attr( get_option('weekly_post_3') ); ?>" />« Headline&nbsp;&nbsp;Link »<input type="text" name="weekly_post_3_url" value="<?php echo esc_attr( get_option('weekly_post_3_url') ); ?>" /></td>
        </tr>
  <tr valign="top">
        <th scope="row">Top Post Number 4</th>
        <td><input type="text" name="weekly_post_4" value="<?php echo esc_attr( get_option('weekly_post_4') ); ?>" />« Headline&nbsp;&nbsp;Link »<input type="text" name="weekly_post_4_url" value="<?php echo esc_attr( get_option('weekly_post_4_url') ); ?>" /></td>
        </tr>
  <tr valign="top">
        <th scope="row">Top Post Number 5</th>
        <td><input type="text" name="weekly_post_5" value="<?php echo esc_attr( get_option('weekly_post_5') ); ?>" />« Headline&nbsp;&nbsp;Link »<input type="text" name="weekly_post_5_url" value="<?php echo esc_attr( get_option('weekly_post_5_url') ); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php } ?>

<?php

function my_mce_buttons_2($buttons) {
  /**
   * Add in a core button that's disabled by default
   */
  $buttons[] = 'superscript';
  $buttons[] = 'subscript';

  return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');

add_filter( 'tiny_mce_before_init', 'myformatTinyMCE' );
function myformatTinyMCE( $in ) {

$in['wordpress_adv_hidden'] = FALSE;

return $in;
}
 ?>
