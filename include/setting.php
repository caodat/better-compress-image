<?php
if ( get_option( "compress_image_quality" ) ) {
    $quality = get_option( "compress_image_quality" );
}
?>

<div class="container">
    <div>
        <div id="save-success" class="alert alert-success alert-dismissible hide">
            <a href="#" class="close">&times;</a>
            <strong>Lưu thành công!</strong>
        </div>
        <div><strong>Chọn chất lượng ảnh sau khi compress</strong></div>
        <br>
        <div class="row">
            <div class="col-lg-4">
                <select class="form-control quality">
                    <?php for ( $i = 5; $i <= 10; $i ++ ) { ?>
                        <option value="<?php echo $i * 10; ?>"
                            <?php if ( $quality ) {
                                if ( $quality == $i * 10 ) {
                                    echo "selected";
                                }
                            } else {
                                if ( $i == 8 ) {
                                    echo "selected"; // Defalt quality == 80%
                                }
                            } ?>
                        ><?php echo $i * 10; ?>%
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <button class="btn btn-success save-setting">Lưu</button>
    </div>
</div>