<?php
 class Uploadedfile extends CI_Controller{
    function __construct()
    {
        parent::__construct();
		IsLogin();
        
    } 
    
    function mp3()
    {
        ListUserUploadedFiles("mp3");

        die();
        $data['allFiles'] = $this->Productgallery_model->get_all_productgallery();
        
        $data['_view'] = 'productgallery/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new productgallery
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'IsFeatured' => $this->input->post('IsFeatured'),
				'ProductId' => $this->input->post('ProductId'),
				'ImagePath' => $this->input->post('ImagePath'),
            );
            
            $productgallery_id = $this->Productgallery_model->add_productgallery($params);
            redirect('productgallery/index');
        }
        else
        {
			$this->load->model('Product_model');
			$data['all_product'] = $this->Product_model->get_all_product();
            
            $data['_view'] = 'productgallery/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a productgallery
     */
    function edit($ProductGalleryId)
    {   
        // check if the productgallery exists before trying to edit it
        $data['productgallery'] = $this->Productgallery_model->get_productgallery($ProductGalleryId);
        
        if(isset($data['productgallery']['ProductGalleryId']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'IsFeatured' => $this->input->post('IsFeatured'),
					'ProductId' => $this->input->post('ProductId'),
					'ImagePath' => $this->input->post('ImagePath'),
                );

                $this->Productgallery_model->update_productgallery($ProductGalleryId,$params);            
                redirect('productgallery/index');
            }
            else
            {
				$this->load->model('Product_model');
				$data['all_product'] = $this->Product_model->get_all_product();

                $data['_view'] = 'productgallery/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The productgallery you are trying to edit does not exist.');
    } 

    /*
     * Deleting productgallery
     */
    function remove($ProductGalleryId)
    {
        $productgallery = $this->Productgallery_model->get_productgallery($ProductGalleryId);

        // check if the productgallery exists before trying to delete it
        if(isset($productgallery['ProductGalleryId']))
        {
            $this->Productgallery_model->delete_productgallery($ProductGalleryId);
            redirect('productgallery/index');
        }
        else
            show_error('The productgallery you are trying to delete does not exist.');
    }
    
}
