<?php
$uploads_path   = wp_upload_dir( "basedir" )['basedir'];
$uploads_ocject = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $uploads_path ), RecursiveIteratorIterator::SELF_FIRST );

/*Show all image in folder uploads ===============*/
echo '<ul>';
foreach ( $uploads_ocject as $file_name => $upload_ocject ) {
    if ( is_dir( $file_name ) ) {

    } else {
        $image_properties = exif_read_data( $file_name );
        $image_size       = ceil( $image_properties['FileSize'] / 1024 );
        if ( $image_size < 1024 ) {
            $image_size .= " KB";
        } else {
            $image_size = ceil( $image_properties['FileSize'] / ( 1024 * 1024 ) ) . " MB";
        }
        echo '<li>';
        echo $file_name . " (" . $image_size . "," . $image_properties['MimeType'] . ")";
        echo '</li>';
    }
}
echo '</ul>';