<?php
class ControllerCommonSeoUrl extends Controller {
	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}
		
		// Decode URL
		if (isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);

                        $this_route = $parts;
                        $this_route_multistore = $parts;
                        array_shift($this_route_multistore);
                        
			
			foreach ($parts as $part) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");
				
				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);
					
					if ($url[0] == 'product_id') {
						$this->request->get['product_id'] = $url[1];
					}
					
					if ($url[0] == 'category_id') {
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $url[1];
						} else {
							$this->request->get['path'] .= '_' . $url[1];
						}
					}	
					
					if ($url[0] == 'manufacturer_id') {
						$this->request->get['manufacturer_id'] = $url[1];
					}
					
					if ($url[0] == 'information_id') {
						$this->request->get['information_id'] = $url[1];
					}	
				} else {
					
                        if (is_file(DIR_APPLICATION . 'controller/' . implode("/", $this_route) . '.php'))  {
                        $this->request->get['route'] = implode("/", $this_route);
                        break;
                        } elseif (is_file(DIR_APPLICATION . 'controller/' . implode("/", $this_route_multistore) . '.php'))  {
                        $this->request->get['route'] = implode("/", $this_route_multistore);
                        break;
                        } else {
                        $this->request->get['route'] = 'error/not_found';
                        array_pop($this_route);
                        array_pop($this_route_multistore);
                        }
                        	
				}
			}
			
			
                        if (preg_match("/information\//", $this->request->get['_route_'])) {
				$this->request->get['route'] = $this->request->get['_route_'];
			} elseif (isset($this->request->get['information_id'])) {
				$this->request->get['route'] = 'information/information';
			} elseif (preg_match("/checkout\//", $this->request->get['_route_'])) {
				$this->request->get['route'] = $this->request->get['_route_'];
			} elseif (preg_match("/payment\//", $this->request->get['_route_'])) {
				$this->request->get['route'] = $this->request->get['_route_'];
			} elseif (preg_match("/feed\//", $this->request->get['_route_'])) {
				$this->request->get['route'] = $this->request->get['_route_'];
			} elseif (preg_match("/affiliate\//", $this->request->get['_route_'])) {
				$this->request->get['route'] = $this->request->get['_route_'];
			} elseif (preg_match("/account\//", $this->request->get['_route_'])) {
				$this->request->get['route'] = $this->request->get['_route_'];
			} elseif (preg_match("/total\//", $this->request->get['_route_'])) {
				$this->request->get['route'] = $this->request->get['_route_'];
			}elseif (preg_match("/module\//", $this->request->get['_route_'])) {
				$this->request->get['route'] = $this->request->get['_route_'];
			} elseif (isset($this->request->get['product_id'])) {
				$this->request->get['route'] = 'product/product';
			} elseif (isset($this->request->get['path'])) {
				$this->request->get['route'] = 'product/category';
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$this->request->get['route'] = 'product/manufacturer/product';
			}elseif (isset($this->request->get['news_id'])) {
				$this->request->get['route'] = 'information/news';
			}
			








			
			if (isset($this->request->get['route'])) {
				return $this->forward($this->request->get['route']);
			}
		}
	}
	
	public function rewrite($link) {
		$url_info = parse_url(str_replace('&amp;', '&', $link));
	
		$url = ''; 
		
		$data = array();
		
		parse_str($url_info['query'], $data);
		
		foreach ($data as $key => $value) {
			if (isset($data['route'])) {
				if (($data['route'] == 'product/product' && $key == 'product_id') || (($data['route'] == 'product/manufacturer/info' || $data['route'] == 'product/product') && $key == 'manufacturer_id') || ($data['route'] == 'information/information' && $key == 'information_id')) {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
				
					if ($query->num_rows) {
						$url = '/' . $query->row['keyword'];   //
						
						unset($data[$key]);
					}					
				} elseif ($key == 'path') {
					$categories = explode('_', $value);
					
					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");
				
						if ($query->num_rows) {
							$url .= '/' . $query->row['keyword'];
						}							
					}
					
					unset($data[$key]);
				}
			}
		}
	
		if ($url) {
			unset($data['route']);
		
			$query = '';
		
			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . $key . '=' . $value;
				}
				
				if ($query) {
					$query = '?' . trim($query, '&');
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			
                        return preg_replace("/(index\.php\?route=|common\/home)/", "", $link);
                        
		}
	}	
}
?>