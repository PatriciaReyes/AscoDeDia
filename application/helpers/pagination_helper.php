<?

if ( ! function_exists('paginate'))
{
  function init_pagination($base_url, $total_rows, $per_page = 5, $uri_segment = 2)
  {
    $CI =& get_instance();
    
    $config['base_url'] = $base_url;
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $per_page; 
    $config['uri_segment'] = $uri_segment;

    $config['full_tag_open'] = '<div class="pagination pagination-right"><ul>';
    $config['full_tag_close'] = '</ul></div>';

    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';
    $config['next_link'] = '&gt;';
    $config['prev_link'] = '&lt;';

    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['first_tag_open'] = $config['last_tag_open']  = $config['num_tag_open'] = $config['prev_tag_open'] = $config['next_tag_open'] = '<li>';
    $config['first_tag_open'] = $config['last_tag_open']  = $config['num_tag_open'] = $config['prev_tag_open'] = $config['next_tag_open'] = '</li>';

    $CI->pagination->initialize($config);
  }
}

if ( ! function_exists('paginate'))
{
  function print_pagination()
  {
    $CI =& get_instance();
    
    return $CI->pagination->create_links();
  }
}