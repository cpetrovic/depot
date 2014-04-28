<? class  Depot_model extends CI_Model {

	public function __construct() {
	
		$this->load->database();
	}
	
	public function get_artists_list() {
		
		$query = $this->db->get('artists');
		
		$artists = $query->result_array();
		
		$artist_list = array();
		
		foreach ($artists as $artist) {
			
			$artist_name = $artist['fname'].' '.$artist['lname'];
			array_push($artist_list, $artist_name);
		}
		
		return $artist_list;
	}
	
	public function get_artist($name)
	 {
		$name = explode('-', $name);
		
		// corrects for hyphenated name
		if (count($name)>2) {
			$new_name = array();
			$new_name[0] = $name[0];
			$new_name[1] = $name[1].'-'.$name[2];
			$name = $new_name;
		}
		$query = $this->db->get_where('artists', array('fname' => $name[0], 'lname' => $name[1]));
		$temp = $query->result_array();
		$artirt = array();
		$artist = $temp[0];
		
		return $artist;
	}
	
	public function get_artistID($name) {
		
		$name = explode(' ', $name);
		
		// corrects for hyphenated name
		if (count($name)>2) {
			$new_name = array();
			$new_name[0] = $name[0];
			$new_name[1] = $name[1].'-'.$name[2];
			$name = $new_name;
		}
		$query = $this->db->get_where('artists', array('fname' => $name[0], 'lname' => $name[1]));
		$temp = $query->result_array();
		$artirt = array();
		$artistID = $temp[0]['artistID'];
		
		return $artistID;
		
		
	}
	
	
	public function get_artists_array() {
		$query = $this->db->get('artists');
		$artists_get = $query->result_array();
		$artists = array();
		 
		foreach ($artists_get as $key => $artist_array) {
			
			$new_key = $artist_array['fname'].'-'.$artist_array['lname'];
			$artists[$new_key] = $artist_array;
		} 
		
		return $artists;
	}
	
	public function get_portfolios($name) {
		
		$artist= $this->depot_model->get_artist($name);
		
		$query = $this->db->get_where('portfolio', array('artistID' => $artist['artistID']));
		$ports_get = $query->result_array();
		$portfolios = array();
		
		foreach ($ports_get as $key => $portfolio) {
			$new_key = $portfolio['name'];
			$portfolios[$new_key] = $portfolio;
		}
		
		return $portfolios;
	}
	
	public function get_portfolio_names($name) {
		
		$artist= $this->depot_model->get_artist($name);
		
		$query = $this->db->get_where('portfolio', array('artistID' => $artist['artistID']));
		$ports_get = $query->result_array();
		$portfolios = array();
		$portnames = array();
		
		foreach ($ports_get as $key => $portfolio) {
			$new_key = $portfolio['name'];
			$portfolios[$new_key] = $portfolio;
		}
		
		foreach($portfolios as $port){array_push($portnames, $port['name']);}
		
		return $portnames;
	}

	public function get_portfolio_id($name) {
		
		$artist= $this->depot_model->get_artist($name);
		
		$query = $this->db->get_where('portfolio', array('artistID' => $artist['artistID']));
		$ports_get = $query->result_array();
		$portfolios = array();
		$portids = array();
		
		return $ports_get;
	}


	
	public function get_images($name, $port) {
		$ports = $this->get_portfolios($name);
		$portfolioID = $ports[$port]['portfolioID'];
		$query = $this->db->get_where('images', array('portfolioID' => $portfolioID));
		return $query->result_array();
	}
	
	public function get_all_images($name) {
		$artist = $this->get_artist($name);
		$artistID = $artist['artistID'];
		$query = $this->db->get_where('images', array('artistID' => $artistID));
		return $query->result_array();
	}

	public function get_image($imageID)
	{
		$query = $this->db->get_where('images', array('imageID'=> $imageID));
		return $query->result_array();
	}
	
	
	public function get_landing_image($name) {
	
		$images = $this->get_all_images($name);
		
		return $images[rand(0, count($images)-1)];
		 
	}
	
	public function add_image_to_table($form_data)
	{
		$this->db->insert('images', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}

	
} ?>