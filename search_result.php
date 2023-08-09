/* For updated document link custom code */

if ($post_type == "document_library") {
		       $term_obj_list = get_the_terms( get_the_ID(), 'document_category' );
		$terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
		$doc_type = get_field( "document_type", get_the_ID());
		$doc_id = get_field( "attach_document", get_the_ID());
    	$doc_obj = get_field( "attach_a_document", get_the_ID());
		$attach_document = "";
		if( $doc_obj && !empty($doc_obj->ID) ){
			$attach_document = get_permalink($doc_obj->ID);
		}
		else{
			$attach_document = home_url("/secure-document-viewer?doc_id=").$doc_id."&doc_type=".$doc_type;
		}

		$download_url = wp_get_attachment_url($doc_id);

		
	}


/* To hide a document for a particular user */

if( ( "bsp_user" != $document_access_by_role && empty($document_access_by_role)  ) ){

/*	if ($post_type == "tribe_events" || $post_type =="memberpressproduct") {
		echo "";
	}*/
?>

<div class="grayblok"></div>

}

else if( ( current_user_can( 'administrator' ) || "invictus_user" == $document_access_by_role ) && !$is_bsp_user ){ ?>

<div class="grayblok"></div>
