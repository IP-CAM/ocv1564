<?php
class ControllerModuleQuickAddOption extends Controller {
    private $error = array();
	
    public function index () {
        $this->load->language('module/quickaddoption');
		
        $this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('module/quickaddoption');
        
	    if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			if (empty($this->request->post['clear_option'])) {
				if (empty($this->request->post['product_selection'])) {	
					//echo 'not clear option and add all product';
					$this->model_module_quickaddoption->addAllProductOptions($this->request->post);
				} else {
					//echo 'not clear option and add selected product';
					foreach ($this->request->post['product_related'] as $products) {	
						if ($products) {
							$this->model_module_quickaddoption->addOptions($products,$this->request->post);
						}
					}
				}
			} else {	
				if (empty($this->request->post['product_selection'])) {	
					//echo 'clear option and add all product';
					$this->model_module_quickaddoption->deleteAllOptions();
					$this->model_module_quickaddoption->addAllProductOptions($this->request->post);
				} else {
					//echo 'clear option and add selected product';
					foreach ($this->request->post['product_related'] as $products) { 
						if ($products) {
							$this->model_module_quickaddoption->deleteOptions($products);
							$this->model_module_quickaddoption->addOptions($products,$this->request->post);
						}
					}
				}				
			}
				
			$this->data['success'] = $this->language->get('text_success');
        }
		
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['warning_clear'] = $this->language->get('warning_clear');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_add_option'] = $this->language->get('button_add_option');
		$this->data['button_add_option_value'] = $this->language->get('button_add_option_value');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['tab_option'] = $this->language->get('tab_option');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
    	$this->data['text_yes'] = $this->language->get('text_yes');
    	$this->data['text_no'] = $this->language->get('text_no');
		$this->data['entry_clear_option'] = $this->language->get('entry_clear_option');
		$this->data['entry_required'] = $this->language->get('entry_required');
		$this->data['entry_option_value'] = $this->language->get('entry_option_value');
		$this->data['entry_weight'] = $this->language->get('entry_weight');
		$this->data['entry_option_points'] = $this->language->get('entry_option_points');
		$this->data['entry_subtract'] = $this->language->get('entry_subtract');
		$this->data['entry_quantity'] = $this->language->get('entry_quantity');
		$this->data['entry_price'] = $this->language->get('entry_price');
		
		$this->data['entry_product_selection'] = $this->language->get('entry_product_selection');
		$this->data['entry_selected_product'] = $this->language->get('entry_selected_product');
		$this->data['text_all_product'] = $this->language->get('text_all_product');
		$this->data['text_selected_product'] = $this->language->get('text_selected_product');
		
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/quickaddoption', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/quickaddoption', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('catalog/category');
		$this->data['categories'] = $this->model_catalog_category->getCategories(0);
		
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_options = $this->model_catalog_product->getProductOptions($this->request->get['product_id']);			
		} else {
			$product_options = array();
		}
		
		$this->data['product_options'] = array();
		
		foreach ($product_options as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();
				
				foreach ($product_option['product_option_value'] as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],						
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']	
					);						
				}
				
				$this->data['product_options'][] = array(
					'product_option_id'    => $product_option['product_option_id'],
					'option_id'            => $product_option['option_id'],
					'name'                 => $product_option['name'],
					'type'                 => $product_option['type'],
					'product_option_value' => $product_option_value_data,
					'required'             => $product_option['required']
				);				
			} else {
				$this->data['product_options'][] = array(
					'product_option_id' => $product_option['product_option_id'],
					'option_id'         => $product_option['option_id'],
					'name'              => $product_option['name'],
					'type'              => $product_option['type'],
					'option_value'      => $product_option['option_value'],
					'required'          => $product_option['required']
				);				
			}
		}
			
		$this->data['modules'] = array();
		
		if (isset($this->request->post['seogen_module'])) {
			$this->data['modules'] = $this->request->post['seogen_module'];
		} elseif ($this->config->get('seogen_module')) { 
			$this->data['modules'] = $this->config->get('seogen_module');
		}			
		
		$this->data['token'] = $this->session->data['token'];		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
        $this->template = 'module/quickaddoption.tpl';
        $this->children = array('common/header', 
								'common/footer');
		
        $this->response->setOutput($this->render());
    }
	
	private function validate () {
        if (! $this->user->hasPermission('modify', 'module/quickaddoption')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if (! $this->error) {
            return true;
        } else {
            return false;
        }
    }
	
	public function category() {
		$this->load->model('module/quickaddoption');

		if (isset($this->request->get['category_id'])) {
			$category_id = $this->request->get['category_id'];
		} else {
			$category_id = 0;
		}

		$product_data = array();

		$results = $this->model_module_quickaddoption->getProductsByCategoryId($category_id);

		foreach ($results as $result) {
			$product_data[] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'model'      => $result['model']
			);
		}

		$this->response->setOutput(json_encode($product_data));

	}
	
	public function option() {
		$output = ''; 
		
		$this->load->model('catalog/option');
		
		$results = $this->model_catalog_option->getOptionValues($this->request->get['option_id']);
		
		foreach ($results as $result) {
			$output .= '<option value="' . $result['option_value_id'] . '"';

			if (isset($this->request->get['option_value_id']) && ($this->request->get['option_value_id'] == $result['option_value_id'])) {
				$output .= ' selected="selected"';
			}

			$output .= '>' . $result['name'] . '</option>';
		}
		
		$this->response->setOutput($output);
	}
	
	
} 