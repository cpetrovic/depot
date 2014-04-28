<? 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Depot extends CI_Controller {
		
		public function __construct() {
		
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('depot_model');
			$this->load->library('session');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('upload');

		}
		
		public function index() {
					
			// fill the $data[]
			$data['title'] = 'The Depot';
			$data['artists'] = $this->depot_model->get_artists_list();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/nav-home', $data);
			$this->load->view('index', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function about()	{
		
			$data['title'] = 'About';
			$data['artists'] = $this->depot_model->get_artists_list();
			
			$data['artistsarray'] = $this->depot_model->get_artists_array();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/nav-home', $data);
			$this->load->view('about', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function artists($name) {
			
			$data['artists'] = $this->depot_model->get_artists_list();
			$data['artist_info'] = $this->depot_model->get_artist($name);
			$data['title'] = $data['artist_info']['fullname'];
			$data['ports'] = $this->depot_model->get_portfolios($name);
			$data['landing_image'] = $this->depot_model->get_landing_image($name);
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/nav-artist', $data);
			$this->load->view('templates/artist_landing', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function gallery($name, $port) {
			
			$data['artist_name'] = url_title($name);
			$data['port_name'] = $port;
			$data['artists'] = $this->depot_model->get_artists_list();
			$data['artist_info'] = $this->depot_model->get_artist($name);
			$data['title'] = $data['artist_info']['fullname'];
			$data['url_head'] = $name.'/'.$port;
			$data['ports'] = $this->depot_model->get_portfolios($name);
			$data['images'] = $this->depot_model->get_images($name, $port);
			$data['gallery_width'] = count($data['images']);
			
			$this->load->view('templates/header-gal', $data);
			$this->load->view('templates/nav-artist', $data);
			$this->load->view('templates/gallery', $data);
			$this->load->view('templates/footer', $data);
			
		}
		
		public function datatest($name, $port) {
		
			$data['artists'] = $this->depot_model->get_artists_list();
			$data['artist'] = $this->depot_model->get_artist($name);
			$data['artists_array'] = $this->depot_model->get_artists_array();
			$data['ports'] = $this->depot_model->get_portfolios($name);
			$data['images'] = $this->depot_model->get_images($name, $port);
			$data['all_images'] = $this->depot_model->get_all_images($name);
			
			$this->load->view('datatest', $data);
			
		}
		

public function addtoportfolio(){
		
			//Making a call to the model to get an array of artists from the DB
			$data['title'] = 'Account';
			$data['artists'] = $this->depot_model->get_artists_list();
			
			$thisdata = $this->depot_model->get_artists_list();
			
			$this->form_validation->set_rules('artist', 'Artist');// Commenting this out for now, 'required');
			$this->form_validation->set_rules('ports', 'Portfolios', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				
				//Building the artists dropdown form
				$thisdata['data'] = form_open('addtoportfolio', 'class="superform"')
				. form_label('Artist<br/>', 'artist')
				. form_dropdown('artist', $thisdata)
				. form_submit('mysubmit', 'Submit')
				. form_close();
				
				$this->session->set_userdata('artist', $thisdata[$this->input->post('artist')]);

				$ports = $this->depot_model->get_portfolio_names(url_title($thisdata[$this->input->post('artist')]));
			
				//Building the artist's portfolio dropdown
				$newdata['data'] = form_open('addtoportfolio', 'class="superform"')//, '', $hidden)
				. form_label('Portfolios<br/>', 'ports')
				. form_dropdown('ports', $ports)
				. form_submit('mysubmit', 'Submit')
				. form_close();

				

				$this->load->view('templates/header', $data);
				$this->load->view('templates/nav-home', $data);
				$this->load->view('addtoportfolio', $thisdata);
				$this->load->view('addtoportfolio', $newdata);
				$this->load->view('templates/footer', $data);
				

			}
			else
			{
				$this->session->set_userdata('portfolio', $this->input->post('ports'));

				$portfoliosAndIds = $this->depot_model->get_portfolio_id(url_title($this->session->userdata('artist')));

				$artistportfolio = $portfoliosAndIds[$this->session->userdata('portfolio')];

				$this->session->set_userdata('artistport', $artistportfolio['portfolioID']);
				
				
				$this->form_validation->set_rules('title', 'title', 'required|max_length[50]');			
				$this->form_validation->set_rules('caption', 'caption', 'required|max_length[200]');			
				$this->form_validation->set_rules('media', 'Media', 'required|max_length[50]');			
				$this->form_validation->set_rules('size', 'Size', 'required|max_length[6]');			
				$this->form_validation->set_rules('price', 'Price', 'required|max_length[8]');
				
				if($this->form_validation->run() == FALSE)
				{

				$thisdata['data'] = form_open_multipart('moreform')
				. form_label('Upload Image<br/><br/>', 'upload')
				. form_label('Title: ')
				. form_input('title')
				
				. form_label('<br/>Caption: ')
				. form_input('caption')
				
				. form_label('<br/>Medium: ')
				. form_input('media')
				
				. form_label('<br/>Size: ')
				. form_input('size')
				
				. form_label('<br/>Price: ')
				. form_input('price')
								
				. form_label('<br/>Filename: ')
				. form_input('pathto')
				
				. form_submit('upload', 'Submit')
				. form_close();
				
				$this->load->view('templates/header', $data);
				$this->load->view('templates/nav-home', $data);
				$this->load->view('imageupload', $thisdata);
				$this->load->view('templates/footer', $data);
				
				}
			}
			
					
		}	
		
		public function moreform()
		{
			$data['title'] = 'Account';
			$data['artists'] = $this->depot_model->get_artists_list();
			
			
			$form_data = array
					(
						'creator' => $this->session->userdata('artist'),
						'portfolioID' => $this->session->userdata('artistport'),
				       	'title' => $this->input->post('title'),
				       	'caption' => $this->input->post('caption'),
				       	'media' => $this->input->post('media'),
				       	'size' => $this->input->post('size'),
				       	'price' => $this->input->post('price'),
				       	'pathto' => "/images/" . $this->input->post('pathto'),
				       	'artistID' => $this->depot_model->get_artistID($this->session->userdata('artist'))
					);
	
			$this->depot_model->add_image_to_table($form_data);
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/nav-home', $data);
			$this->load->view('moreform', $data);
			$this->load->view('templates/footer', $data);
			
		}

		public function account()
		{
			$data['title'] = 'Account';

			$data['artists'] = $this->depot_model->get_artists_list();
			
			$this->form_validation->set_rules('username', 'user', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$loginform['data'] = form_open('addtoportfolio', 'class="superform"')
				. form_label('User<br/>')
				. form_input('username')
				. form_label('<br/>Password<br/>')
				. form_input('password')
				. form_submit('mysubmit', 'Submit')
				. form_close();

				$this->load->view('templates/header', $data);
				$this->load->view('templates/nav-home', $data);
				$this->load->view('account', $loginform);
				$this->load->view('templates/footer', $data);
				
			}
			else
			{
				$this->load->view('templates/header', $data);
				$this->load->view('templates/nav-home', $data);
				$this->load->view('addtoportfolio', $thisdata);
				$this->load->view('templates/footer', $data);
			}

		}


		public function cart()
		{
			$data['title'] = 'Cart';
			$data['artists'] = $this->depot_model->get_artists_list();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/nav-home', $data);
			$this->load->view('cart', $data);
		}

		//contact page
		public function contact()
		{	
			//pass the title and artists info for the nav bar
			$data['title'] = 'Contact';
			$data['artists'] = $this->depot_model->get_artists_list();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/nav-home', $data);
			$this->load->view('contact', $data);
		}
		
		public function upcoming()
		{
			$data['title'] = 'Upcoming';
			$data['artists'] = $this->depot_model->get_artists_list();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/nav-home', $data);
			$this->load->view('upcoming', $data);
			$this->load->view('templates/footer', $data);
		}
		
		//view image page
		public function viewimage($imageID)
		{
			//set the data to be passed to view image
			$data['title'] = 'View Image';
			//we need to pass the image that we just clicked on to the viewimage page
			$iarray = $this->depot_model->get_image($imageID);
			$data['image'] = $iarray[0];
			//this is how we get the "previous" url since we can't be confident that we actually
			//arrived here from auxiliotech.com/gallery/portfolio... otherwise using redirect would work
			$prev = $this->uri->uri_to_assoc(1);
			array_pop($prev);
			//pass previous to view image
			$data['prev'] = $this->uri->assoc_to_uri($prev);
			
			
			$this->load->library('session');
			$this->load->view('imageview', $data);
		}
		
	}
?>
