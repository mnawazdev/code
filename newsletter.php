/* Newsletter Downloads Custom Code */
/* Newsletter Links updated with new URL using WP Download Manager Pro Plugin */

<?php

$select_documents = get_field( "select_documents", get_the_ID());
		if ($select_documents) {
			foreach ($select_documents as $key => $documents) {
				$doc_type = $documents['document_type'];
				$doc_id = $documents['attach_document'];
				$doc_obj = $documents['attach_document_new'];
				// $doc_url = wp_get_attachment_url($documents['attach_document']);
				// $attach_document = home_url("/secure-document-viewer/?doc_id=").$doc_id."&doc_type=".$doc_type; 

				$attach_document = "";
				if( $doc_obj && !empty($doc_obj->ID) ){
					$attach_document = get_permalink($doc_obj->ID);
				}
				else{
					$attach_document = home_url("/secure-document-viewer?doc_id=").$doc_id."&doc_type=".$doc_type;
				}

				$download_url = wp_get_attachment_url($doc_id);

<?
